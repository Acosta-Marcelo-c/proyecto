<?php
include ('../../config.php');
$fecha=$fechaHora;

$id_almacen =$_POST['id_almacen'];


$sentencia = $pdo->prepare("UPDATE almacen SET
      alm_Estado ='INACTIVO',
      alm_FechaActualizacion=:fecha_actualizacion
      WHERE   id_Almacen=:id_almacen");

$sentencia->bindParam('fecha_actualizacion',$fecha);
$sentencia->bindParam('id_almacen',$id_almacen);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje']="SE ELIMINO CORRECTAMENTE";
  //header('Location: '.$URL.'/../roles/index.php');
  ?>
  <script>

    location.href="<?php echo $URL;?>/../almacen";
  </script>

  <?php
}else {
  session_start();
  $_SESSION['mensaje']="ERROR EN LA ELIMINACION";
 // header('Location: '.$URL.'../../roles/update.php?id='.$id_usuario);
 ?>
 <script>

   location.href="<?php echo $URL;?>/../almacen";
 </script>

 <?php
}

 ?>
