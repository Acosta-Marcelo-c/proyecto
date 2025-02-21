<?php
include('../../config.php');
$fecha = $fechaHora;

$id_almacen = $_POST['id_almacen'];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$decripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$estado = $_POST['estado'];
$imagen_text = $_POST['imagen_text'];
$id_usuario = $_POST['id_usuario'];
$id_categoria = $_POST['id_categoria'];

if ($_FILES['imagen']['name'] != null) {

  $nombreDelArchivo = date("Y-m-d-h-i-s");
  $imagen_text = $nombreDelArchivo . "__" . $_FILES['imagen']['name'];
  $location = "../../../almacen/img_productos/" . $imagen_text;
  move_uploaded_file($_FILES['imagen']['tmp_name'], $location);
} else {

}

$sentencia = $pdo->prepare("UPDATE almacen SET

      alm_Nombre =:nombre,
      alm_Descripcion=:descripcion,
      alm_Stock=:stock,
      alm_StockMinimo=:stock_minimo,
      alm_StokMaximo=:stock_maximo,
      alm_PrecioCompra=:precio_compra,
      alm_PrecioVenta=:precio_venta,
      alm_FechaIngreso=:fecha_ingreso,
      alm_Imagen=:imagen,
      alm_FechaActualizacion=:fecha_actualizacion,
      id_Usuario=:id_usuario,
      id_Categoria=:id_categoria, 
      alm_Estado=:estado
WHERE   id_Almacen=:id_almacen");

$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('descripcion', $decripcion);
$sentencia->bindParam('stock', $stock);
$sentencia->bindParam('stock_minimo', $stock_minimo);
$sentencia->bindParam('stock_maximo', $stock_maximo);
$sentencia->bindParam('precio_compra', $precio_compra);
$sentencia->bindParam('precio_venta', $precio_venta);
$sentencia->bindParam('fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam('imagen', $imagen_text);
$sentencia->bindParam('fecha_actualizacion', $fecha);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('id_almacen', $id_almacen);
$sentencia->bindParam('estado', $estado);


if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE ACTUALIZO CORRECTAMENTE";
  
?>
  <script>
    location.href = "<?php echo $URL; ?>/../almacen";
  </script>

<?php
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR ENLA ACTUALIZACION";
  
?>
  <script>
    location.href = "<?php echo $URL; ?>/../almacen";
  </script>

<?php
}

?>