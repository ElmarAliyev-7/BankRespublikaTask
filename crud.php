<?php

if(!function_exists('create')){
    function create(string $table, array $cols ,array $values){

        $table_cols = '';
        foreach ($cols as $key => $col):
            $table_cols .= "`$col`".',';
        endforeach;
        $table_cols = substr($table_cols, 0, -1);

        $table_values = '';
        foreach ($values as $key => $value):
            $table_values .= "'$value'".',';
        endforeach;
        $table_values = substr($table_values, 0, -1);

        $query = "INSERT INTO `$table` ($table_cols) VALUES ($table_values)";
        $conn = new PDO("mysql:host=localhost;dbname=br_task", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec($query);
        return success("Created Successfully");
    }
}
