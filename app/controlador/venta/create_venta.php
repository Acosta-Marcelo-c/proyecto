<?php
include ('../../config.php');

$nro_Pedidos = $_GET['nro_pedido'];
$id_cliente = $_GET['id_cliente'];
$total_venta = $_GET['total_venta'];


$sentencia = $pdo->prepare("INSERT INTO ventas
        (id_Cliente, ped_numero, cli_PagoTotal, cli_FechaCreacion)  
VALUES (:id_cliente,:nro_pedido,:total_venta,:fecha) ");

$sentencia->bindParam('id_cliente', $id_cliente);
$sentencia->bindParam('nro_pedido', $nro_Pedidos);
$sentencia->bindParam('total_venta', $total_venta);
$sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje']="SE REGISTRO El  CORRECTAMENTE";
    //  header('Location: '.$URL.'/../categorias/index.php');
    ?>
    <script>

        location.href="<?php echo $URL;?>/../ventas/index.php";

    </script>

    <?php
}else{
    session_start();
    $_SESSION['mensaje']="ERROR AL REGISTRAR DE PEDIDOS";
    //header('Location: '.$URL.'/../categorias/index.php');

    ?>
    <script>

        location.href="<?php echo $URL;?>/../pedidos/create_pedidos.php?=<?php echo $id_Pedidos;?>";
    </script>

    <?php
}

?>