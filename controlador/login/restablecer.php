<?php

include('../../config.php');

$id_usuario = $_POST['id_tabla'];
//$email = $_POST['email'];
$password = $_POST['password'];
$password_confirme = $_POST['password_confirme'];


if ($password == $password_confirme) {
  $password = password_hash($password, PASSWORD_DEFAULT);

  $verifica = $pdo->prepare("UPDATE persona 
  SET per_Contrase=:password WHERE id_Persona=:id_Persona");

  $verifica->bindParam(':id_Persona', $id_usuario);
  $verifica->bindParam(':password', $password);

  $verifica->execute();

  if ($verifica) {
    $_SESSION['mensaje'] = "Password modificado.";
    echo "<script>location.href='{$URL}/login/index.php';</script>";
  } else {
    $_SESSION['mensaje'] = "ERROR INTENTE NUEVAMENTE.";
    echo "<script>location.href='{$URL}/login/index.php';</script>";
  }
} else {

  $_SESSION['mensaje'] = "ERROR LAS CONTRASEÑAS NO SON IGUALES";

?>
  <script>
    location.href = "<?php echo $URL; ?>/login/index.php";
  </script>
<?php
}

?>