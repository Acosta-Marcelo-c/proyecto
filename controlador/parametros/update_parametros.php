<?php
include ('../../config.php');
$fecha=$fechaHora;

$id_param =$_POST['id_Param'];
$ruc =$_POST['ruc'];
$nombre =$_POST['nombre'];
$correo =$_POST['correo'];
$telefono =$_POST['telefono'];
$direccion =$_POST['direccion'];
$descripcion =$_POST['descripcion'];
$imagen_actual =$_POST['imagen_actual'];
$stock_min =$_POST['stock_min'];
$stock_max =$_POST['stock_max'];
$hora =$_POST['hora'];


if ($_FILES['imagen']['name'] != null) {

  $nombreDelArchivo =date("Y-m-d-h-i-s");
  $imagen_actual = $nombreDelArchivo."__".$_FILES['imagen']['name'];
  $location = "../../../parametros/imagen/".$imagen_actual;
  move_uploaded_file($_FILES['imagen']['tmp_name'],$location);

}else{
//echo $filename;

}
$sentencia = $pdo->prepare("UPDATE parametro SET 
    
    par_Nom_Empre =:par_nombre,
    par_Logo =:par_logo,
    par_Ruc=:par_ruc,
    par_Descripcion=:par_descripcion,
    par_Correo=:par_correo,
    par_Direccion=:par_direccion,
    par_Telefono=:par_telefono,
    par_Fecha_Mod=:par_fecha,
    par_stok_min=:par_stock_min,
    par_stok_max=:par_stock_max,
    par_Tiem_Corr=:par_hora
     WHERE id_Param =:id_param"); 


   $sentencia->bindParam('par_nombre', $nombre); 
   $sentencia->bindParam('par_logo', $imagen_actual);
   $sentencia->bindParam('par_ruc', $ruc);
   $sentencia->bindParam('par_descripcion', $descripcion);
   $sentencia->bindParam('par_correo', $correo);
   $sentencia->bindParam('par_direccion', $direccion);
   $sentencia->bindParam('par_telefono', $telefono);
   $sentencia->bindParam('par_fecha', $fechaHora);
   $sentencia->bindParam('id_param',$id_param);
   $sentencia->bindParam('par_stock_min', $stock_min);
   $sentencia->bindParam('par_stock_max', $stock_max);
   $sentencia->bindParam('par_hora', $hora);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje']="SE REGISTRO CORRECTAMENTE";
  header('Location: '.$URL.'/../parametros/index.php');
}else{
  session_start();
$_SESSION['mensaje']="ERROR AL REGISTRAR ";
header('Location: '.$URL.'/../parametros/create.php');
}

 ?>
