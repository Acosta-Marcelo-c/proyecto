<?php
include('../../config.php');
$id_almacen = $_GET['id_almacen'];
$alm_stock = $_GET['stock_calculado'];

$sentencia = $pdo->prepare("UPDATE almacen SET 
            alm_Stock=:stock 
               WHERE   id_Almacen=:id_almacen");


$sentencia->bindParam('stock', $alm_stock);
$sentencia->bindParam('id_almacen', $id_almacen);


if ($sentencia->execute()) {
?>
    <script>
        location.href = "<?php echo $URL; ?>../../ventas/delete.php";
    </script>

<?php
} else {
    echo "error al actualizar";
}

?>