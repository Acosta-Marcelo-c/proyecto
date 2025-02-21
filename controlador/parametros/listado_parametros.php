<?php

$sql_parametro = "SELECT * FROM parametro";
$query_parametro = $pdo->prepare($sql_parametro);
$query_parametro->execute();
$parametro_datos = $query_parametro->fetchAll(PDO::FETCH_ASSOC);
?>