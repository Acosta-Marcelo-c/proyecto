<?php
include ('../../config.php');


        $sentencia = $pdo->prepare("DELETE FROM pedido 
                                WHERE   id_Perdido=:id_pedido");

        $sentencia->bindParam('id_pedido',$id_pedido);

        if ($sentencia->execute()) {
    ?>
        <script>
                location.href="<?php echo $URL;?>/../pedidos/create.php?pedido=0";
        </script>

    <?php
}else {
        ?>
        <script>
                location.href="<?php echo $URL;?>/../pedidos/?pedido=0";
        </script>
    <?php
    }
    ?>
