<?php

if(!function_exists('create')){
    function create(string $table, array $cols ,array $values){
        global $conn;

        $table_cols = '';
        foreach ($cols as $col):
            $table_cols .= "`$col`".',';
        endforeach;
        $table_cols = substr($table_cols, 0, -1);

        $table_values = '';
        foreach ($values as $value):
            $table_values .= "'$value'".',';
        endforeach;
        $table_values = substr($table_values, 0, -1);

        $query = "INSERT INTO `$table` ($table_cols) VALUES ($table_values)";
        $conn->exec($query);
        return alert("success","Created Successfully.");
    }
}

if(!function_exists('select')){
    function select(string $table, $cols = '*'){
        global $conn;

        if(is_array($cols)):
            $table_cols = '';
            foreach ($cols as $key => $col):
                $table_cols .= $col.',';
            endforeach;
            $table_cols = substr($table_cols, 0, -1);
            $slq = "SELECT $table_cols FROM $table";
        else:
            $slq = "SELECT $cols FROM $table";
        endif;

        $query = $conn->prepare($slq);
        $query->execute();
        return $query->fetchAll();
    }
}
