<?php
include ('../../config.php');

$id_usuario=$_POST['id_persona'];
$fecha=$fechaHora;

  $sentencia = $pdo->prepare("UPDATE persona
     SET per_Estado='Inactivo', per_FechaActualizacion=:fecha
      WHERE id_Persona=:id_Persona");

   $sentencia->bindParam('fecha', $fecha);
   $sentencia->bindParam('id_Persona', $id_usuario);

if($sentencia->execute()) {

   session_start();
   $_SESSION['mensaje']="SE ELIMINO USUARIO";
  // header('Location: '.$URL.'/../usuarios/index.php');
  ?>
  <script>

    location.href="<?php echo $URL;?>/../usuarios";
  </script>

  <?php
}else{

session_start();
$_SESSION['mensaje']="ERROR EN LA ELIMINACION";
//header('Location: '.$URL.'../../usuarios/delete.php?id='.$id_usuario);
?>
<script>

  location.href="<?php echo $URL;?>/../usuarios/index.php";
</script>

<?php
}

 ?>
