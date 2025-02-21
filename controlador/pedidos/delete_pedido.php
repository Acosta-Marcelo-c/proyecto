<?php
include('../../config.php');

$ped_numero = $_POST['ped_numero'];
$id_pedido = $_POST['id_pedido'];

try {
    $sentencia = $pdo->prepare("DELETE FROM pedido WHERE id_Perdido = :id_pedido");
    $sentencia->bindParam(':id_pedido', $id_pedido);

    if ($sentencia->execute()) {
?>
        <script>
            window.location.href = "<?php echo $URL; ?>/../pedidos/create.php?pedido=<?php echo $ped_numero; ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location.href = "<?php echo $URL; ?>/../pedidos/?pedido=0";
        </script>
    <?php
    }
} catch (PDOException $e) {
    error_log("Error en delete_pedido: " . $e->getMessage());
    ?>
    <script>
        window.location.href = "<?php echo $URL; ?>/../pedidos/?error=1";
    </script>
<?php
}
?>