<?php

$sql_icono = "SELECT * FROM icono";
$query_icono = $pdo->prepare($sql_icono);
$query_icono->execute();
$icono_datos = $query_icono->fetchAll(PDO::FETCH_ASSOC);
?>