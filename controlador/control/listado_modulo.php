<?php

$sql_modulo = "SELECT * FROM modulo";
$query_modulo = $pdo->prepare($sql_modulo);
$query_modulo->execute();
$modulo_datos = $query_modulo->fetchAll(PDO::FETCH_ASSOC);
?>