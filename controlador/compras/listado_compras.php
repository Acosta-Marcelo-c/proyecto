<?php


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
            com.com_NumeroCompra as NumeroCompra
            FROM compras as com
            INNER JOIN almacen as alm   ON com.id_Almacen = alm.id_Almacen
            INNER JOIN categoria as cat ON cat.id_Categoria = alm.id_Categoria
            INNER JOIN persona as per ON com.id_persona = per.id_persona
            INNER JOIN Proveedor AS pro ON com.id_Proveedor =pro.id_Proveedor";

$query_compras = $pdo->prepare($sql_compras);
$query_compras->execute();
$compras_datos = $query_compras->fetchAll(PDO::FETCH_ASSOC);
