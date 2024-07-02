<?php
include ('../../config.php');

$rol=$_POST['rol'];
$nombres =$_POST['nombre'];
$email =$_POST['email'];
$password=$_POST['password'];
$password_repite =$_POST['password_repite'];

if($password == $password_repite) {
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sentencia = $pdo->prepare("INSERT INTO persona
          (id_Rol,per_Nombre, per_Correo, per_Contrase, per_Fecha_Creacion)
   VALUES (:rol,:nombre, :email, :password, :fecha)");

   $sentencia->bindParam('rol',$rol );
   $sentencia->bindParam('nombre', $nombres);
   $sentencia->bindParam('email', $email);
   $sentencia->bindParam('password', $password);
   $sentencia->bindParam('fecha', $fechaHora);
   $sentencia->execute();

   session_start();
   $_SESSION['mensaje']="SE REGISTRO CORRECTAMENTE";
   //header('Location: '.$URL.'/../usuarios/index.php');
?>
   <script>

     location.href="<?php echo $URL;?>/../usuarios/index.php";
   </script>
   <?php
}else{
  //echo "contraseñas no son iguales";

session_start();
$_SESSION['mensaje']="ERROR LAS CONTRASEÑAS NO SON IGUALES";
header('Location: '.$URL.'/../usuarios/create.php');
}

 ?>
