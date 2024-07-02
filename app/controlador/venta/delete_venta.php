<?php
include ('../../config.php');

$id_venta = $_GET['id_venta'];
$nro_pedido = $_GET['nro_pedido'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("DELETE FROM ventas WHERE   id_Ventas=:id_venta");

$sentencia->bindParam('id_venta',$id_venta);

if ($sentencia->execute()) {

    $sentencia2 = $pdo->prepare("DELETE FROM pedido WHERE  ped_numero=:nro_pedido");

    $sentencia2->bindParam('nro_pedido',$nro_pedido);
    $sentencia2->execute();
    $pdo->commit();
    ?>
    <script>
        location.href="<?php echo $URL;?>../../ventas/index.php";
    </script>

    <?php
}else {
    $pdo->rollBack();
    echo "error al intentar borrar";
}
?>