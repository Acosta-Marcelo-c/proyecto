<?php

require_once 'pdoconfig.php';

try {

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
   //echo "Connected to $dbname at $host successfully.";

} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
    echo "Error de conexion de base de datos";
}

date_default_timezone_set("America/Bogota");
$fechaHora = date('Y-m-d H:i:s');

 ?>
