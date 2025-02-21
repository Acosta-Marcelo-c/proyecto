<?php
include('../../config.php');

$ruc = $_POST['ruc'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$descripcion = $_POST['descripcion'];
$hora = $_POST['hora'];
$stock_min = $_POST['stock_min'];
$stock_max = $_POST['stock_max'];
//$fecha_ingreso =$_POST['fecha_ingreso'];


$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo . "__" . $_FILES['imagen']['name'];
$location = "../../../parametros/imagen/" . $filename;

move_uploaded_file($_FILES['imagen']['tmp_name'], $location);

//echo $filename;


$sentencia = $pdo->prepare("INSERT INTO parametro 
        ( par_Nom_Empre, par_Logo, par_Ruc, par_Descripcion, par_Correo, par_Direccion, par_Telefono, par_Tiem_Corr, par_stok_min, par_stok_max, par_Fecha_Crea)
 VALUES (:par_Nombre, :par_Logo, :par_Ruc,  :par_Descripcion, :par_Correo, :par_Direccion, :par_telefono, :par_Tiem_Corr, :par_stock_min, :stock_max, :par_FechaIngreso)");


$sentencia->bindParam('par_Nombre', $nombre);
$sentencia->bindParam('par_Logo', $filename);
$sentencia->bindParam('par_Ruc', $ruc);
$sentencia->bindParam('par_Correo', $correo);
$sentencia->bindParam('par_Direccion', $direccion);
$sentencia->bindParam('par_telefono', $telefono);
$sentencia->bindParam('par_Descripcion', $descripcion);
$sentencia->bindParam('par_FechaIngreso', $fechaHora);
$sentencia->bindParam('par_Tiem_Corr', $hora);
$sentencia->bindParam('par_stock_min', $stock_min);
$sentencia->bindParam('stock_max', $stock_max);


if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE REGISTRO CORRECTAMENTE";
  header('Location: ' . $URL . '/../parametros/index.php');
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR AL REGISTRAR ";
  header('Location: ' . $URL . '/../parametros/create.php');
}
?>