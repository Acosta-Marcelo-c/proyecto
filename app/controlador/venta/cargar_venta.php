<?php
include ('../app/config.php');


$sql_ventas = "SELECT*FROM ventas  WHERE ped_numero ='$no_get_pedido'";

$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos=$query_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_datos as $ventas_dato){

    $nro_venta = $ventas_dato['id_Ventas'];
    $id_cliente = $ventas_dato['id_Cliente'];

}