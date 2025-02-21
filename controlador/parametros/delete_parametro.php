<?php
include('../../config.php');
$fecha = $fechaHora;

$id_param = $_POST['id_param'];


$sentencia = $pdo->prepare("DELETE FROM parametro WHERE id_Param =:id_Param ");

$sentencia->bindParam('id_Param', $id_param);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE ELIMINO CORRECTAMENTE";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../parametros";
  </script>

<?php
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR EN LA ELIMINACION";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../almacen";
  </script>

<?php
}

?>