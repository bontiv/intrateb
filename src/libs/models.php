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

    # Defaults models
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

    #Mods models
    foreach (Extend::getInstalledMods() as $mod) {
        $tables = array_merge_recursive($tables, $mod->getModels());
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

    if ($field['type'] == 'file')
        return 'blob';

    if ($field['type'] == 'bool')
        return 'enum(\'true\', \'false\')';

    echo '<br><br><strong>Type field inconnu</strong><br>';
    var_dump($field, $table_info['name']);
    exit();
}

function mdle_sql_fielddef($table, $col) {
    global $pdo;

    $sql = mdle_field_type($table, $col);
    $data = $table['fields'][$col];
    if (!isset($data['null']) || !$data['null'])
        $sql .= ' NOT';
    $sql .= ' NULL';

    if ($data['type'] == 'auto_int')
        $sql .= ' AUTO_INCREMENT';
    if (isset($data['default']))
        $sql .= ' DEFAULT ' . $pdo->quote($data['default']);
    elseif ($data['type'] == 'file')
        $sql .= ' DEFAULT NULL';
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

    if (isset($_mdle_cache[$table])) {
        return $_mdle_cache[$table];
    }

    $file = $root . 'modeles' . DS . $table . '.yml';
    if (is_file($file)) {
        $data = spyc_load_file($file);
        $data['file'] = $table . '.yml';
        if (isset($data['name']) && $data['name'] == $table) {
            //$_mdle_cache[$data['name']] = $data;
            return $data;
        }
    }

    #Recherche modules
    foreach (Extend::getInstalledMods() as $mod) {
        $tables = $mod->getModels();
        if (isset($tables[$table])) {
            return $tables[$table];
        }
    }

    dbg_warning(__FILE__, "Il n'y a pas de fichier portant le nom d'un modèle demandé : $table", 1);
    // Peut-être qu'en chargeant tous les fichiers on va trouver le bon...
    mdle_get_tables();
    if (!isset($_mdle_cache[$table])) {
        dbg_error(__FILE__, "Le modèle demandé ($table) n'existe pas", 1);
    }
    return $_mdle_cache[$table];
}

function mdle_form_var($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="text" size="' . $data['size'] . '" class="form-control input-md" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div></div>';

    return $str;
}

function mdle_form_file($data, $value = null, $error = false) {

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="file" class="form-control input-md" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" ></div></div>';

    return $str;
}

function mdle_form_date_time($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div></div>';

    $str .= "<script type='text/javascript'>\n$(function() {
$( \"#" . $data['name'] . "\" ).datetimepicker({dateFormat: 'yy-mm-dd'});
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
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" id="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div></div>';
    $str .= "<script type='text/javascript'>\n$(function() {
$( \"#" . $data['name'] . "\" ).datepicker({dateFormat: 'yy-mm-dd'});
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
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="text" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div></div>';

    return $str;
}

function mdle_form_tel($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<input type="tel" size="' . $data['size'] . '" class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '" value="' . addslashes($value) . '"></div></div>';

    return $str;
}

function mdle_form_text($data, $value = null, $error = false) {
    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<textarea class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">' . htmlentities($value) . '</textarea>
    </div></div>';

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
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<select class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">';
    while ($opt = $ext->fetch()) {
        $val = $opt[$extDesc['key']];
        $str .= '<option value="' . addslashes($val) . '"';
        if ($val == $value)
            $str .= " selected";
        if (!isset($data['display']))
            $str .= '>' . htmlentities($opt[0]) . '</option>';
        else {
            $display = $data['display'];
            foreach ($opt as $key => $val2)
                $display = str_replace('%' . $key . '%', $val2, $display);
            $str .= '>' . htmlentities($display) . '</option>';
        }
    }
    $str .= '</select>
    </div></div>';

    return $str;
}

function mdle_form_enum($data, $value = null, $error = false) {
    global $pdo;

    if ($value === null && isset($data['default']))
        $value = $data['default'];

    $str = '<div class="form-group';
    if ($error)
        $str .= ' has-error';
    $str .= '"><label class="col-md-4 control-label" for="' . $data['name'] . '">'
            . $data['label'] . '</label>'
            . '<div class="col-md-6">'
            . '<select class="form-control" id="'
            . $data['name'] . '" name="' . $data['name'] . '" placeholder="' . $data['name']
            . '">';
    foreach ($data['items'] as $name => $val) {
        $str .= '<option value="' . addslashes($name) . '"';

        if ($name == $value)
            $str .= " selected";
        $str .= '>' . htmlentities($val) . '</option>';
    }
    $str .= '</select>
    </div></div>';

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
        parent::__construct("No field $colum in $table", 22);
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
    private $iterator;

    function __construct($table, $id = null) {

        #Support pour le clonage
        if ($table instanceof Modele) {
            $id = $table->getKey();
            $table = $table->getName();
        }

        $this->desc = mdle_need_desc($table);
        $this->iterator = false;
        foreach ($this->desc['fields'] as $n => &$v) {
            $v['name'] = $n;
            if (!isset($v['label']))
                $v['label'] = $n;
            if (!isset($v['size']))
                $v['size'] = 30;

            if ($id !== null) {
                $this->fetch($id);
            }
        }
    }

    private function hasRight($field) {
        if (!hasAcl(ACL_ADMINISTRATOR) && isset($this->desc['fields'][$field]['readonly']) && $this->desc['fields'][$field]['readonly'] == 'true')
            return false;
        elseif (!isset($this->desc['fields'][$field]['visible']))
            return true;
        elseif ($this->desc['fields'][$field]['visible'] == 'false')
            return false;
        elseif ($this->desc['fields'][$field]['visible'] == 'admin' && hasAcl(ACL_ADMINISTRATOR))
            return true;
        elseif ($this->desc['fields'][$field]['visible'] == 'true')
            return true;
        elseif ($this->desc['fields'][$field]['visible'] == 'superuser' && hasAcl(ACL_SUPERUSER))
            return true;
        return false;
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

    function edit($fieldlist = null) {
        $form = '';
        foreach (array_keys($this->desc['fields']) as $name)
            if ($this->hasRight($name) && ($fieldlist === null || in_array($name, $fieldlist)))
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

            if ($desc['type'] == 'file' && !is_resource($data[$name]))
                continue;

            if (!isset($data[$name]) && isset($desc['default'])) {
                $data[$name] = $desc['default'];
            } elseif (!isset($data[$name])) {
                continue;
            }

            if ($nbVals != 0)
                $sql .= ', ';

            $sql .= '`' . $name . '`';
            $values[] = array(
                'val' => $data[$name],
                'type' => $desc['type'],
            );
            $nbVals++;
        }
        $sql .= ') VALUES (' . implode(', ', array_fill(0, $nbVals, '?')) . ')';

        $stmt = $pdo->prepare($sql);
        foreach ($values as $index => $val) {
            if ($val['type'] == 'file')
                $stmt->bindValue($index + 1, $val['val'], PDO::PARAM_LOB);
            else
                $stmt->bindValue($index + 1, $val['val']);
        }
        $rst = $stmt->execute();
        if ($rst)
            $this->fetch($pdo->lastInsertId());
        return $rst;
    }

    function modFrom($data, $secure = true) {
        global $pdo;

        $sql = 'UPDATE ' . $this->desc['name'] . ' SET ';
        $nbVals = 0;
        $values = array();

        foreach ($this->desc['fields'] as $name => $desc) {
            if ($desc['type'] == 'auto_int')
                continue;

            if (!$secure && $desc['type'] == 'file')
                continue;

            if (!isset($data[$name]))
                continue;

            if ($desc['type'] == 'file' && !is_resource($data[$name]))
                continue;

            if ($secure && !$this->hasRight($name))
                continue;

            if (!hasAcl(ACL_ADMINISTRATOR) && isset($desc['readonly']) && $desc['readonly'] != 'false')
                continue;

            if ($data[$name] == '' && isset($desc['default'])) {
                $data[$name] = $desc['default'];
            } elseif (!isset($data[$name])) {
                continue;
            }

            if ($nbVals != 0)
                $sql .= ', ';

            $this->instance[$name] = $data[$name];
            $sql .= '`' . $name . '` = ?';

            $values[] = array('val' => $data[$name], 'type' => $desc['type']);
            $nbVals++;
        }

        $sql .= ' WHERE ' . $this->desc['key'] . ' = ?';

        $stmt = $pdo->prepare($sql);
        foreach ($values as $index => $val) {
            if ($val['type'] == 'file') {
                $stmt->bindValue($index + 1, $val['val'], PDO::PARAM_LOB);
            } else
                $stmt->bindValue($index + 1, $val['val']);
        }
        $stmt->bindValue($nbVals + 1, $this->getKey());
        $result = $stmt->execute();

        return $result;
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

    function find($where = false, $order = false) {
        global $pdo;

        $values = array();
        $sql = 'SELECT * FROM `' . $this->desc['name'] . '`';
        $first = true;

        if ($where !== false)
            $sql .= ' WHERE';

        // Vérifie les noms des colones
        if (is_array($where)) {
            foreach ($where as $colum => $value) {
                if (isset($this->desc['fields'][$colum])) {
                    if ($first) {
                        $first = false;
                    } else {
                        $sql .= ' AND';
                    }
                    // TODO : Il faut utiliser LIKE pour les alphabetiques
                    $sql .= ' `' . $colum . '` = ?';
                    $values[] = $value;
                } else {
                    dbg_warning(__FILE__, "Colone $colum invalide dans la table " . $this->desc['name']);
                }
            }
        } else {
            $sql .= ' ' . $where;
        }

        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }

        $stmt = $pdo->prepare($sql);
        for ($i = 0; $i < count($values); $i++) {
            $stmt->bindValue($i + 1, $values[$i]);
        }
        $success = $stmt->execute();

        if ($success) {
            $this->iterator = $stmt;
        } else {
            $this->iterator = false;
        }

        return $success;
    }

    function count() {
        return $this->iterator->rowCount();
    }

    function next() {
        if ($this->iterator) {
            $this->instance = $this->iterator->fetch(PDO::FETCH_ASSOC);
        }
        return $this->instance;
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

        $raw = false;
        if ('raw_' == substr($name, 0, 4)) {
            $raw = true;
            $name = substr($name, 4);
        }

        if (!isset($this->desc['fields'][$name])) {
            throw new ModeleFieldNotFound($this->getName(), $name);
        }
        if (!isset($this->instance[$name]))
            return null;
        if (!$raw && $this->desc['fields'][$name]['type'] == 'enum')
            return $this->desc['fields'][$name]['items'][$this->instance[$name]];
        if (!$raw && $this->desc['fields'][$name]['type'] == 'external' && is_string($this->instance[$name])) {
            $id = $this->instance[$name];
            try {
                $this->instance[$name] = new Modele($this->desc['fields'][$name]['table']);
                $this->instance[$name]->fetch($id);
            } catch (SQLFetchNotFound $e) {
                $this->instance[$name] = false;
            }
        }

        if ($raw && $this->instance[$name] instanceof Modele) {
            return $this->instance[$name]->getKey();
        }

        return $this->instance[$name];
    }

    function __set($name, $value) {
        global $pdo;

        if (!isset($this->desc['fields'][$name]))
            throw new ModeleFieldNotFound($this->getName(), $name);

        if ($this->desc['fields'][$name]['type'] == 'external' && !is_string($value)) {
            $value = $value->getKey();
        }

        if (!$this->modFrom(array($name => $value), false)) {
            var_dump($GLOBALS['pdo']->errorInfo());
            throw new Exception('Field update error', 21);
        }
    }

    function reverse($model) {
        $infos = mdle_need_desc($model);
        foreach ($infos['fields'] as $name => $f) {
            if ($f['type'] == 'external' && $f['table'] == $this->getName()) {
                $mdl = new Modele($model);
                $mdl->find(array($name => $this->getKey()));
                return $mdl;
            }
        }
        return false;
    }

    function toArray() {
        return $this->instance;
    }

    function appendTemplate($varName) {
        global $tpl;

        while ($this->next()) {
            $tpl->append($varName, new Modele($this));
        }
    }

    function assignTemplate($varName) {
        global $tpl;

        $tpl->assign($varName, $this);
    }

}
