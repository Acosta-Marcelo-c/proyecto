<?php
include ('../../config.php');

$nombres =$_POST['nombre'];
$descripcion =$_POST['descripcion'];


  $sentencia = $pdo->prepare("INSERT INTO rol
          (rol_Nombre, rol_Descripcion, rol_fecha_Creacion)
   VALUES (:nombre, :descripcion, :fecha)");

   $sentencia->bindParam('nombre', $nombres);
   $sentencia->bindParam('descripcion', $descripcion);
   $sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje']="SE REGISTRO EL ROL CORRECTAMENTE";
//  header('Location: '.$URL.'/../roles/index.php');
?>
<script>

  location.href="<?php echo $URL;?>/../roles";
</script>

<?php
}else{
  session_start();
$_SESSION['mensaje']="ERROR AL REGISTRAR EL ROL";
//header('Location: '.$URL.'/../roles/create.php');
?>
<script>

  location.href="<?php echo $URL;?>/../roles";
</script>

<?php
}

 ?>
