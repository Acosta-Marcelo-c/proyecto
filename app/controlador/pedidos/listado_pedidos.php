<?php
include ('../app/config.php');

$sql_pedido = "select max(ped_numero) as maximo from pedido";

$query_pedido = $pdo->prepare($sql_pedido);
$query_pedido->execute();
$pedido_datos=$query_pedido->fetchAll(PDO::FETCH_ASSOC);

foreach ($pedido_datos as $pedido_dato){
    $max= $pedido_dato['maximo'];
}

?>