<?php

$sql_cliente = "SELECT * FROM cliente";
$query_cliente = $pdo->prepare($sql_cliente);
$query_cliente->execute();
$cliente_datos = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
?>