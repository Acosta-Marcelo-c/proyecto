<?php

$sql_producto = "SELECT *, al.alm_Imagen as alm_Imagen, ca.cat_Nombre as cat_Nombre, per.per_Correo as per_Correo
 FROM almacen as al INNER JOIN
 categoria as ca ON al.id_Categoria= ca.id_Categoria
 INNER JOIN persona as per ON per.id_Persona = al.id_Usuario ";
$query_producto = $pdo->prepare($sql_producto);
$query_producto->execute();
$producto_datos = $query_producto->fetchAll(PDO::FETCH_ASSOC);
