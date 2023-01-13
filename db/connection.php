<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "br_task";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
