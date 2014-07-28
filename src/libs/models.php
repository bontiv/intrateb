<?php

/**
 * Fichier utilisé pour la gestion des modèles
 * @package frametool
 */
/**
 * Cette variable contient un cache avec les informations de structure des
 * tables
 */
$_mdle_cache = null;

/**
 * Permet de récupérer un tableau avec les informations de toutes les modèles
 * @global type $root
 * @return type
 */
function mdle_get_tables() {
    global $root, $_mdle_cache;

    if ($_mdle_cache !== null)
        return $_mdle_cache;

    $files = scandir($root . 'modeles');
    $tables = array();
    foreach ($files as $name) {
        $file = $root . 'modeles' . DS . $name;
        if (is_file($file)) {
            $data = spyc_load_file($file);
            $data['file'] = $name;
            if (isset($data['name']))
                $tables[$data['name']] = $data;
        }
    }

    $_mdle_cache = $tables;
    return $tables;
}

function mdle_field_type($table_info, $field) {
    $field = $table_info['fields'][$field];

    if ($field['type'] == 'auto_int' || $field['type'] == 'external')
        return 'int(10) unsigned';

    if ($field['type'] == 'var')
        return 'varchar(' . (isset($field['size']) ? $field['size'] : 30) . ')';

    if ($field['type'] == 'enum')
        return 'enum(\'' . implode('\',\'', array_keys($field['items'])) . '\')';

    if ($field['type'] == 'text')
        return 'text';

    if ($field['type'] == 'date_time')
        return 'datetime';

    if ($field['type'] == 'tel')
        return 'varchar(20)';

    if ($field['type'] == 'date')
        return 'date';

    if ($field['type'] == 'int')
        return 'int(' . (isset($field['size']) ? $field['size'] : 10) . ')';

    echo '<br><br><strong>Type field inconnu</strong><br>';
    var_dump($field);
    exit();
}

function mdle_sql_fielddef($table, $col) {
    global $pdo;

    $sql = mdle_field_type($table, $col);
    $data = $table['fields'][$col];
    if (!isset($data['null']) || $data['null'] == 'no')
        $sql .= ' NOT';
    $sql .= ' NULL';

    if ($data['type'] == 'auto_int')
        $sql .= ' AUTO_INCREMENT';
    if (isset($data['default']))
        $sql .= ' DEFAULT ' . $pdo->quote($data['default']);
    return $sql;
}

function mdle_sql_create($table) {
    $sql = 'CREATE TABLE `' . $table['name']
            . "` (\n";
    $first = true;
    foreach (array_keys($table['fields']) as $col) {
        if ($first)
            $first = false;
        else
            $sql .= ",\n";

        $sql .= '    `' . $col . '` ' . mdle_sql_fielddef($table, $col);
    }
    if (isset($table['key']))
        $sql .= ",\n    PRIMARY KEY(`$table[key]`)";
    if (isset($table['indexes'])) {
        foreach ($table['indexes'] as $name => $index) {
            $sql .= ",\n    ";
            if ($index['type'] == 'unique')
                $sql .= 'UNIQUE KEY';
            elseif ($index['type'] == 'index')
                $sql .= 'KEY';
            else {
                echo '<br><br><strong>Type index inconnu</strong><br>';
                var_dump($index);
            }
            $sql .= ' `' . $name . '`';
            if (is_array($index['fields']))
                $sql .= ' (`' . implode('`, `', $index['fields']) . '`)';
            else
                $sql .= ' (`' . $index['fields'] . '`)';
        }
    }
    $sql .= "\n)";
    return $sql;
}

function mdle_need_desc($table) {
    global $_mdle_cache, $root;

    if (isset($_mdle_cache[$table]))
        return $_mdle_cache[$table];

    $file = $root . 'modeles' . DS . $table . '.yml';
    if (is_file($file)) {
        $data = spyc_load_file($file);
        $data['file'] = $table . '.yml';
        if (isset($data['name']) && $data['name'] == $table) {
            $_mdle_cache[$data['name']] = $data;
            return $data;
        }
    }
    dbg_warning(__FILE__, "Il n'y a pas de fichier portant le nom d'une classe demandé : $table", 1);
    // Peut-être qu'en chargeant tous les fichiers on va trouver le bon...
    mdle_get_tables();
    if (!isset($_mdle_cache[$table]))
        dbg_error(__FILE__, "Le modèle demandé ($table) n'existe pas", 1);
    return $_mdle_cache[$table];
}

function mdle_form_var($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div>';
    
    return $str;
}

function mdle_form_date_time($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div>';
    
    $str .= "<script type='text/javascript'>\n$(function() {
$( \"#". $data['name'] ."\" ).datetimepicker({dateFormat: 'yy-mm-dd'});
});
</script>";
    return $str;
}

function mdle_form_date($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" id="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div>';
    $str .= "<script type='text/javascript'>\n$(function() {
$( \"#". $data['name'] ."\" ).datepicker({dateFormat: 'yy-mm-dd'});
});
</script>";
    return $str;
}

function mdle_form_int($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div>';
    
    return $str;
}

function mdle_form_tel($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<input type="tel" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div>';
    
    return $str;
}

function mdle_form_text($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<textarea class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">' . htmlentities($value) . '</textarea>
    </div>';

    return $str;
}

function mdle_form_external($data, $value = null, $error = false) {
    global $pdo;
    
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $ext = $pdo->query("SELECT * FROM `" . $data['table'] . "`");
    $extDesc = mdle_need_desc($data['table']);
    
    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<select class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">';
    while ($opt = $ext->fetch()) {
        $val = $opt[$extDesc['key']];
        $str .= '<option value="' . addslashes($val) . '"';
        if ($val == $value) $str .= " selected";
        if (!isset($data['display']))
            $str .= '>' . htmlentities($opt[0]) . '</option>';
        else {
            $display = $data['display'];
            foreach ($opt as $key => $value)
                $display = str_replace ('%'.$key.'%', $value, $display);
            $str .= '>' . htmlentities($display) . '</option>';
        }
    }
    $str .= '</select>
    </div>';

    return $str;
}

function mdle_form_enum($data, $value = null, $error = false) {
    global $pdo;
    
    if ($value === null && isset($data['default']))
        $value = $data['default'];
    
    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<select class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">';
    foreach ($data['items'] as $name => $val) {
        $str .= '<option value="' . addslashes($name) . '"';
        if ($name == $value) $str .= " selected";
        $str .= '>' . htmlentities($val) . '</option>';
    }
    $str .= '</select>
    </div>';

    return $str;
}

class SQLFetchException extends Exception {
    
}

class SQLFetchNotFound extends Exception {
    
}

class ModeleFieldNotFound extends Exception {
    private $table;
    private $colum;
    
    public function __construct($table, $colum) {
        parent::__construct("No field $colum in $table", 22, 0);
        $this->colum = $colum;
        $this->table = $table;
    }
    
    public function getTable() {
        return $this->colum;
    }
    
    public function getColum() {
        return $this->colum;
    }
}

class Modele {

    private $desc;
    private $instance;

    function __construct($table) {
        $this->desc = mdle_need_desc($table);
        foreach ($this->desc['fields'] as $n => &$v) {
            $v['name'] = $n;
            if (!isset($v['label']))
                $v['label'] = $n;
            if (!isset($v['size']))
                $v['size'] = 30;
        }
    }

    function getName() {
        return $this->desc['name'];
    }

    function getFile() {
        return $this->desc['file'];
    }

    function getKey() {
        return $this->instance[$this->desc['key']];
    }
    
    function displayField($name) {
        if (!isset($this->desc['fields'][$name]))
            dbg_error(__FILE__, 'Oups ! On me demande l\'affichage du champ ' . $name . ' mais il n\'existe pas dans le modèle ' . $this->getName() . '.');

        // Pas de champs pour une inscrémentation auto
        if ($this->desc['fields'][$name]['type'] == 'auto_int')
            return '';
        
        $func = 'mdle_form_' . $this->desc['fields'][$name]['type'];

        if (function_exists($func))
            return call_user_func($func, $this->desc['fields'][$name], isset($this->instance, $this->instance[$name]) ? $this->instance[$name] : null);
        else
            dbg_error(__FILE__, 'L\'affichage des champs de type ' . $this->desc['fields'][$name]['type'] . ' n\'est pas encore implémenté.');
    }

    function edit() {
        $form = '';
        foreach (array_keys($this->desc['fields']) as $name)
            $form .= $this->displayField($name);
        return $form;
    }

    function addFrom($data) {
        global $pdo;
        
        $sql = 'INSERT INTO ' . $this->desc['name'] . ' (';
        $nbVals = 0;
        $values = array();

        foreach ($this->desc['fields'] as $name => $desc) {
            if ($desc['type'] == 'auto_int')
                continue;

            if ($nbVals != 0)
                $sql .= ', ';
            
            if (!isset($data[$name]) && isset($desc['default'])) {
                $data[$name] = $desc['default'];
            } elseif (!isset($data[$name])) {
                continue;
            }
            $sql .= '`' . $name . '`';
            $values[] = $data[$name];            
            $nbVals++;
        }
        $sql .= ') VALUES (' . implode(', ', array_fill(0, $nbVals, '?')) . ')';

        $stmt = $pdo->prepare($sql);
        foreach ($values as $index => $val) {
            $stmt->bindValue($index + 1, $val);
        }
        return $stmt->execute();
    }
    
    function modFrom($data) {
        global $pdo;
        
        $sql = 'UPDATE ' . $this->desc['name'] . ' SET ';
        $nbVals = 0;
        $values = array();

        foreach ($this->desc['fields'] as $name => $desc) {
            if ($desc['type'] == 'auto_int')
                continue;

            if ($nbVals != 0)
                $sql .= ', ';
            
            if (!isset($data[$name]) && isset($desc['default'])) {
                $data[$name] = $desc['default'];
            } elseif (!isset($data[$name])) {
                continue;
            }
            $this->instance[$name] = $data[$name];
            $sql .= '`' . $name . '` = ?';
            $values[] = $data[$name];            
            $nbVals++;
        }

        $sql .= ' WHERE ' . $this->desc['key'] . ' = ?';
        
        $stmt = $pdo->prepare($sql);
        foreach ($values as $index => $val) {
            $stmt->bindValue($index + 1, $val);
        }
        $stmt->bindValue($nbVals + 1, $this->getKey());
        return $stmt->execute();
    }

    function fetch($id) {
        global $pdo;
        
        $sql = 'SELECT * FROM `' . $this->desc['name'] . '` WHERE `'
                . $this->desc['key'] . '` = ?';
        $rst = $pdo->prepare($sql);
        $rst->bindValue(1, $id);
        if (!$rst->execute()) {
            throw new SQLFetchException();
        }
        $this->instance = $rst->fetch();
        if (!$this->instance) {
            throw new SQLFetchNotFound();
        }
    }
    
    function delete() {
        global $pdo;
        
        $sql = 'DELETE FROM `' . $this->desc['name'] . '` WHERE `'
                . $this->desc['key'] . '` = ?';
        $rst = $pdo->prepare($sql);
        $rst->bindValue(1, $this->instance[$this->desc['key']]);
        if (!$rst->execute()) {
            throw new Exception();
        }
    }
    
    /**
     * Récupère la valeur d'un champ
     * @param type $name
     */
    function __get($name) {
        if (!isset($this->instance[$name]))
            throw new ModeleFieldNotFound($this->getName (), $name);
        return $this->instance[$name];
    }
}
