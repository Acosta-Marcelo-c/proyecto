<?php

$id_almacen = $_GET['id'];

$sql_producto = "SELECT *, al.alm_Imagen as alm_Imagen,
ca.cat_Nombre as cat_Nombre, per.per_Correo as per_Correo
 FROM almacen as al INNER JOIN
 categoria as ca ON al.id_Categoria= ca.id_Categoria
 INNER JOIN persona as per ON per.id_Persona = al.id_Usuario
 WHERE id_Almacen= '$id_almacen'";

$query_producto = $pdo->prepare($sql_producto);
$query_producto->execute();
$producto_datos = $query_producto->fetchAll(PDO::FETCH_ASSOC);

foreach ($producto_datos as $producto_dato) {

  $codigo = $producto_dato['alm_Codigo'];
  $nombre = $producto_dato['alm_Nombre'];
  $email = $producto_dato['per_Correo'];
  $id_persona = $producto_dato['id_Persona'];
  $decripcion = $producto_dato['alm_Descripcion'];
  $stock = $producto_dato['alm_Stock'];
  $stock_minimo = $producto_dato['alm_StockMinimo'];
  $stock_maximo = $producto_dato['alm_StokMaximo'];
  $precio_compra = $producto_dato['alm_PrecioCompra'];
  $precio_venta = $producto_dato['alm_PrecioVenta'];
  $fecha_ingreso = $producto_dato['alm_FechaIngreso'];
  $imagen = $producto_dato['alm_Imagen'];
  $id_usuario = $producto_dato['id_Usuario'];
  $id_categoria = $producto_dato['id_Categoria'];
  $Nombre_categoria = $producto_dato['cat_Nombre'];
  $estado = $producto_dato['alm_Estado'];
}
