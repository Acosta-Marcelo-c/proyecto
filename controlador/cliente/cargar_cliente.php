<?php
include('../app/config.php');


$sql_cliente = "SELECT*FROM cliente  WHERE id_Cliente ='$id_cliente'";
$query_cliente = $pdo->prepare($sql_cliente);
$query_cliente->execute();
$cliente_datos = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
?>
