<?php

$sql_proveedor = "SELECT * FROM proveedor WHERE pro_Estado = 'ACTIVO'";
$query_proveedor = $pdo->prepare($sql_proveedor);
$query_proveedor->execute();
$proveedor_act_datos = $query_proveedor->fetchAll(PDO::FETCH_ASSOC);
?>