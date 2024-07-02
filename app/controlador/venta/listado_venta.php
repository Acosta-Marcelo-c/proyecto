<?php
include ('../app/config.php');

$sql_ventas = "SELECT*, cli.cli_nombres as nombre_cliente FROM ventas  as vent INNER JOIN cliente as cli ON cli.id_Cliente = vent.id_Cliente";

$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos=$query_ventas->fetchAll(PDO::FETCH_ASSOC);
