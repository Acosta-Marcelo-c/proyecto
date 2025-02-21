<?php
include('../../config.php');

$rol = $_POST['rol'];
$nombres = $_POST['nombre'];
$email = $_POST['email'];
$estado = $_POST['estado'];
$password = $_POST['password'];
$password_repite = $_POST['password_repite'];
$empresa_usuario = $_POST['empresa_usuario'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM persona WHERE per_Correo = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
  session_start();
  $_SESSION['mensaje'] = "El correo ya existe";
  $_SESSION['tipo_mensaje'] = "error";
?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'El correo electrónico ya está registrado',
      showConfirmButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo $URL; ?>/../usuarios/index.php";
      }
    });
  </script>
  <?php
  exit();
} else {

  if ($password == $password_repite) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("INSERT INTO persona
          (id_Rol,per_Nombre, per_Correo, per_Contrase, per_Estado, per_Fecha_Creacion, id_parametro)
   VALUES (:rol,:nombre, :email, :password, :estado, :fecha, :empresa_usuario)");

    $sentencia->bindParam('rol', $rol);
    $sentencia->bindParam('nombre', $nombres);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('password', $password);
    $sentencia->bindParam('fecha', $fechaHora);
    $sentencia->bindParam('empresa_usuario', $empresa_usuario);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "SE REGISTRO CORRECTAMENTE";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios/index.php";
    </script>
  <?php
  } else {


    session_start();
    $_SESSION['mensaje'] = "ERROR LAS CONTRASEÑAS NO SON IGUALES";
  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios/index.php";
    </script>
<?php

  }
}
?>