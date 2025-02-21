<?php
include('../../config.php');


$nro_compras = $_GET['nro_Compra'];
$id_almacen = $_GET['id_Almacen'];
$id_proveedor = $_GET['id_Proveedor'];
$id_Persona = $_GET['id_pers'];
$com_fecha = $_GET['com_Fecha'];
$com_Comprobante = $_GET['com_Comprobante'];
$com_precio = $_GET['com_Precio'];
$com_cantidad = $_GET['com_Cantidad'];
$stock_total = $_GET['stock_Total'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO compras(
     com_NumeroCompra, id_Almacen,id_Proveedor,
     id_persona, com_Fecha, com_Comprobante,
     com_Precio,com_Cantidad,com_Estado)
     VALUES (:com_numerocompra, :id_almacen,
             :id_proveedor,:id_persona,
             :com_fecha, :com_comprobante,
             :com_precio, :com_cantidad,
             'Activo'
             )");


$sentencia->bindParam('com_numerocompra', $nro_compras);
$sentencia->bindParam('id_almacen', $id_almacen);
$sentencia->bindParam('id_proveedor', $id_proveedor);
$sentencia->bindParam('id_persona', $id_Persona);
$sentencia->bindParam('com_fecha', $com_fecha);
$sentencia->bindParam('com_comprobante', $com_Comprobante);
$sentencia->bindParam('com_precio', $com_precio);
$sentencia->bindParam('com_cantidad', $com_cantidad);

if ($sentencia->execute()) {

  //actulisar el stock desde la contador_compras
  $sentencia = $pdo->prepare("UPDATE almacen SET alm_Stock=:stock_Total WHERE id_Almacen=:id_almacen");
  $sentencia->bindParam('stock_Total', $stock_total);
  $sentencia->bindParam('id_almacen', $id_almacen);
  $sentencia->execute();

  $pdo->commit();

  session_start();
  $_SESSION['mensaje'] = "SE REGISTRO LA COMPRA CORRECTAMENTE";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../compras"
  </script>
<?php
} else {

  $pdo->rollBack();

  session_start();
  $_SESSION['mensaje'] = "ERROR AL REGISTRAR COMPRA";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../compras/create.php"
  </script>
<?php
}

?>