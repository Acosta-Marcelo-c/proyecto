<?php

$id_compra= $_GET['id'];

$sql_compras = "SELECT *,
            alm.id_Almacen as id_Almacen, alm.alm_Codigo as alm_Codigo,
            alm.alm_Nombre as nombre_producto,
            alm.alm_Descripcion as descripcion_producto, alm.alm_Stock as alm_Stock,
            alm.alm_StockMinimo as alm_StockMinimo, alm.alm_StokMaximo as alm_StokMaximo,
            alm.alm_PrecioCompra as alm_PrecioCompra, alm.alm_PrecioVenta as alm_PrecioVenta,
            alm.alm_FechaIngreso as alm_FechaIngreso, alm.alm_Imagen as alm_Imagen,
            cat.cat_Nombre as cat_Nombre, per.per_Nombre as per_Nombre,
            pro.pro_Nombre as pro_Nombre, pro.pro_Celular as pro_Celular,
            pro.pro_Ruc as pro_Ruc, pro.pro_Telefono as pro_Telefono,
            pro.pro_Direccion as pro_Direccion, pro.pro_Email as pro_Email,
            pro.id_Proveedor as id_Proveedor, pro.pro_Estado as pro_Estado,
            pro.pro_FechaCreacion as pro_FechaCreacion, per.per_Nombre as per_Nombre,
            com.id_Almacen as id_Almacen
            FROM compras as com
            INNER JOIN almacen as alm   ON com.id_Almacen = alm.id_Almacen
            INNER JOIN categoria as cat ON cat.id_Categoria = alm.id_Categoria
            INNER JOIN persona as per ON com.id_persona = per.id_persona
            INNER JOIN Proveedor AS pro ON com.id_Proveedor =pro.id_Proveedor
            WHERE com.id_Compras= '$id_compra'";

$query_compras = $pdo->prepare($sql_compras);
$query_compras->execute();
$compras_datos=$query_compras->fetchAll(PDO::FETCH_ASSOC);

foreach ($compras_datos as $compras_dato) {
  $show_id_Proveedor= $compras_dato['id_Proveedor'];
  $show_id_Almacen = $compras_dato['id_Almacen'];
  $show_id_compra = $compras_dato['id_Compras'];
  $show_nro_compra = $compras_dato['com_NumeroCompra'];
  $show_persona = $compras_dato['per_Nombre'];
  $show_usuario = $compras_dato['per_Correo'];
  $show_codigo = $compras_dato['alm_Codigo'];
  $show_categoria = $compras_dato['cat_Nombre'];
  $show_nombreProdu = $compras_dato['nombre_producto'];
  $show_descripcion = $compras_dato['descripcion_producto'];
  $show_stock = $compras_dato['alm_Stock'];
  $show_StockMinimo = $compras_dato['alm_StockMinimo'];
  $show_StokMaximo = $compras_dato['alm_StokMaximo'];
  $show_precioCompra = $compras_dato['alm_PrecioCompra'];
  $show_precioVenta = $compras_dato['alm_PrecioVenta'];
  $show_fechaAlm = $compras_dato['alm_FechaIngreso'];
  $show_imagen = $compras_dato['alm_Imagen'];
  $show_nomProveedor = $compras_dato['pro_Nombre'];
  $show_celProveedor = $compras_dato['pro_Celular'];
  $show_tefProveedor = $compras_dato['pro_Telefono'];
  $show_rucProveedor = $compras_dato['pro_Ruc'];
  $show_emailProveedor = $compras_dato['pro_Email'];
  $show_direccionProveedor = $compras_dato['pro_Direccion'];
  $show_fecha = $compras_dato['com_Fecha'];
  $show_comprobante = $compras_dato['com_Comprobante'];
  $show_precioCompra = $compras_dato['com_Precio'];
  $show_cantidadCompra = $compras_dato['com_Cantidad'];

}
 ?>
