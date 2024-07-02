<?php

include('../../config.php');

$email = $_POST['email'];
$contrase = $_POST['contrase'];


$contador = 0;
//echo $contrase;

$sql = "SELECT * FROM persona WHERE per_Correo='$email'";
$query = $pdo->prepare($sql);
$query->execute();
$usuario =$query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuario as $usuari) {
$contador = $contador + 1;
$email_tabla = $usuari['per_Correo'];
$nombre_tabla = $usuari['per_Nombre'];
$password_table = $usuari['per_Contrase'];
}


if (($contador > 0)&&(password_verify($contrase, $password_table))){
  echo "Datos correctos";
  session_start();
  $_SESSION['sesion_email']=$email;
  header ('Location: '.$URL.'/index.php');

  }else{
    echo "Datos incorrextos, vuelva a intentar";
    session_start();
    $_SESSION['mensaje']= "Error datos incorrecto";
    header('Location: '.$URL.'/login');
  }

 ?>
