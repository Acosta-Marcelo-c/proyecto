<?php
include('../../config.php');


$id_usuario = $_POST['id_persona'];
$nombres = $_POST['nombre'];
$email = $_POST['email'];
$id_rol = $_POST['rol'];
$estado = $_POST['estado'];
$password = $_POST['password'];
$password_repite = $_POST['password_repite'];
$fecha = $fechaHora;


if ($password == "") {

  if ($password == $password_repite) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("UPDATE persona
       SET per_Nombre=:nombre,
       per_Correo=:email,
       per_FechaActualizacion=:fecha,
       per_Estado=:estado,
       id_Rol=:id_rol
        WHERE id_Persona=:id_Persona");

    $sentencia->bindParam('nombre', $nombres);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('fecha', $fecha);
    $sentencia->bindParam('id_Persona', $id_usuario);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('id_rol', $id_rol);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "SE ACTUALIZO CORRECTAMENTE";
    // header('Location: '.$URL.'/../usuarios/index.php');
?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios";
    </script>

  <?php
  } else {
    session_start();
    $_SESSION['mensaje'] = "ERROR LAS CONTRASEÑAS NO SON IGUALES";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios";
    </script>

  <?php
  }
} else {
  if ($password == $password_repite) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("UPDATE persona
       SET per_Nombre=:nombre,
           per_Correo=:email,
           per_Contrase=:password,
           per_FechaActualizacion=:fecha,
           per_Estado=:estado,
           id_Rol=:id_rol
        WHERE id_Persona=:id_Persona");

    $sentencia->bindParam('nombre', $nombres);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('password', $password);
    $sentencia->bindParam('fecha', $fecha);
    $sentencia->bindParam('id_Persona', $id_usuario);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('id_rol', $id_rol);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "SE ACTUALIZO CORRECTAMENTE";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios";
    </script>

  <?php
  } else {
    session_start();
    $_SESSION['mensaje'] = "ERROR LAS CONTRASEÑAS NO SON IGUALES";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../usuarios";
    </script>

<?php
  }
}

?>