<?php
include('../../config.php');

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$decripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$imagen = $_POST['imagen'];
$id_usuario = $_POST['id_usuario'];
$id_categoria = $_POST['id_categoria'];

// Verificar si el nombre del producto ya existe
$verificar_nombre = $pdo->prepare("SELECT COUNT(*) FROM almacen WHERE alm_Nombre = :nombre");
$verificar_nombre->bindParam(':nombre', $nombre);
$verificar_nombre->execute();
$nombre_existente = $verificar_nombre->fetchColumn();

if ($nombre_existente > 0) {
    session_start();
    $_SESSION['mensaje'] = "EL NOMBRE DEL PRODUCTO YA EXISTE";
    header('Location: ' . $URL . '/../almacen/create.php');
    exit();
}

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo . "__" . $_FILES['imagen']['name'];
$location = "../../../almacen/img_productos/" . $filename;

move_uploaded_file($_FILES['imagen']['tmp_name'], $location);

$sentencia = $pdo->prepare("INSERT INTO almacen(alm_Codigo, alm_Nombre, alm_Descripcion,
                              alm_Stock, alm_StockMinimo, alm_StokMaximo, alm_PrecioCompra,
                              alm_PrecioVenta, alm_FechaIngreso, alm_Imagen, alm_FechaCreacion,
                              id_Usuario, id_Categoria)
                              VALUES (:alm_Codigo, :alm_Nombre, :alm_Descripcion,
                             :alm_Stock, :alm_StockMinimo, :alm_StokMaximo, :alm_PrecioCompra,
                             :alm_PrecioVenta, :alm_FechaIngreso, :alm_Imagen, :alm_FechaCreacion,
                             :id_Usuario, :id_Categoria)");

$sentencia->bindParam('alm_Codigo', $codigo);
$sentencia->bindParam('alm_Nombre', $nombre);
$sentencia->bindParam('alm_Descripcion', $decripcion);
$sentencia->bindParam('alm_Stock', $stock);
$sentencia->bindParam('alm_StockMinimo', $stock_minimo);
$sentencia->bindParam('alm_StokMaximo', $stock_maximo);
$sentencia->bindParam('alm_PrecioCompra', $precio_compra);
$sentencia->bindParam('alm_PrecioVenta', $precio_venta);
$sentencia->bindParam('alm_FechaIngreso', $fecha_ingreso);
$sentencia->bindParam('alm_Imagen', $filename);
$sentencia->bindParam('alm_FechaCreacion', $fechaHora);
$sentencia->bindParam('id_Usuario', $id_usuario);
$sentencia->bindParam('id_Categoria', $id_categoria);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "SE REGISTRO EL PRODUCTO CORRECTAMENTE";
    header('Location: ' . $URL . '/../almacen/index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "ERROR AL REGISTRAR EL PRODUCTO";
    header('Location: ' . $URL . '/../almacen/create.php');
}
