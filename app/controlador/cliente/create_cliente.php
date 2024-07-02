<?php
include ('../../config.php');

$id_Pedidos = $_POST['id_pedidos'];
$nombre_cli = $_POST['nombre_cliente'];
$tipo_doc_cli = $_POST['tipo_documento_cliente'];
$numero_doc_cli = $_POST['numero_documento_cliente'];
$telefono_cli = $_POST['telefono_cliente'];
$email_cli = $_POST['email_cliente'];
$direccion_cli = $_POST['direccion_cliente'];


$sentencia = $pdo->prepare("INSERT INTO cliente
    (cli_nombres, cli_Tipo_Documento, 
     cli_NumeroDocumento, cli_Celular, cli_Direccion,
     cli_Email, cli_FchaCreacion) 
VALUES (:nombre_cli,:tipo_doc_cli,:numero_doc_cli,:telefono_cli,:direccion_cli,:email_cli,:fecha) ");

$sentencia->bindParam('nombre_cli', $nombre_cli);
$sentencia->bindParam('tipo_doc_cli', $tipo_doc_cli);
$sentencia->bindParam('numero_doc_cli', $numero_doc_cli);
$sentencia->bindParam('telefono_cli', $telefono_cli);
$sentencia->bindParam('email_cli', $email_cli);
$sentencia->bindParam('direccion_cli', $direccion_cli);
$sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
    //session_start();
    //$_SESSION['mensaje']="SE REGISTRO El  CORRECTAMENTE";
    //  header('Location: '.$URL.'/../categorias/index.php');
    ?>
    <script>

        location.href="<?php echo $URL;?>/../pedidos/create.php?=<?php echo $id_Pedidos;?>";

    </script>

    <?php
}else{
    //session_start();
    //$_SESSION['mensaje']="ERROR AL REGISTRAR DE PEDIDOS";
//header('Location: '.$URL.'/../categorias/index.php');

    ?>
    <script>

        location.href="<?php echo $URL;?>/../pedidos/create_pedidos.php?=<?php echo $id_Pedidos;?>";
    </script>

    <?php
}

?>