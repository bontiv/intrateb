<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function mdle_get_tables() {
    global $root;

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

?>
