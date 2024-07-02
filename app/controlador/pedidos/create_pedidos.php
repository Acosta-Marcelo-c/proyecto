<?php
include ('../../config.php');

$ped_numero = $_GET['id_pedido'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];


$sentencia = $pdo->prepare("INSERT INTO pedido (
            ped_numero,id_Almacen, ped_Cantidad,ped_FechaCreacion)
   VALUES (:ped_numero,:id_producto,:cantidad,:fecha) ");

$sentencia->bindParam('ped_numero', $ped_numero );
$sentencia->bindParam('id_producto', $id_producto);
$sentencia->bindParam('cantidad', $cantidad);
$sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
    //session_start();
    //$_SESSION['mensaje']="SE REGISTRO El  CORRECTAMENTE";
    //  header('Location: '.$URL.'/../categorias/index.php');
    ?>
    <script>

        location.href="<?php echo $URL;?>/../pedidos/create.php?pedido=<?php echo $ped_numero;?>";

    </script>

    <?php
}else{
    //session_start();
    //$_SESSION['mensaje']="ERROR AL REGISTRAR DE PEDIDOS";
//header('Location: '.$URL.'/../categorias/index.php');

    ?>
    <script>

        location.href="<?php echo $URL;?>/../pedidos/create_pedidos.php";
    </script>

    <?php
}

?>