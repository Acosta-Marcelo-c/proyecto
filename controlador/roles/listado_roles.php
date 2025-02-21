<?php

$sql_rol = "SELECT * FROM rol";
$query_rol = $pdo->prepare($sql_rol);
$query_rol->execute();
$rol_datos = $query_rol->fetchAll(PDO::FETCH_ASSOC);
?>