
<?php
include ('../../config.php');

$id_compras= $_GET['id_compra'];
$id_almacen=$_GET['id_almacen'];
$stock_total=$_GET['stock_Total'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("UPDATE compras SET
      com_Estado='Inactivo'
       WHERE id_Compras=:id_Compras");
   $sentencia->bindParam('id_Compras', $id_compras);

if ($sentencia->execute()) {

  //actulisar el stock desde la contador_compras
  $sentencia = $pdo->prepare("UPDATE almacen SET alm_Stock=:stock_Total WHERE id_Almacen=:id_almacen");
  $sentencia->bindParam('stock_Total', $stock_total);
  $sentencia->bindParam('id_almacen', $id_almacen);
  $sentencia->execute();

  $pdo->commit();

  session_start();
  $_SESSION['mensaje']="SE ELIMINO LA COMPRA CORRECTAMENTE";
  //header('Location: '.$URL.'/../compras/index.php');
?>
  <script>
    location.href="<?php echo $URL;?>/../compras"
  </script>
  <?php
}else{

  $pdo->rollBack();

  session_start();
$_SESSION['mensaje']="ERROR AL ELIMINAR COMPRA";
//header('Location: '.$URL.'/../compras/create.php');
?>
  <script>
    location.href="<?php echo $URL;?>/../compras/update.php"
  </script>
  <?php
}

 ?>
