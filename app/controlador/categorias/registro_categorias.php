<?php
include ('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];

$sentencia = $pdo->prepare("INSERT INTO categoria
          (cat_Nombre, cat_FechaCreacion)
   VALUES (:nombre, :fecha)");

   $sentencia->bindParam('nombre', $nombre_categoria);
   $sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje']="SE REGISTRO LA CATEGORIA CORRECTAMENTE";
//  header('Location: '.$URL.'/../categorias/index.php');
?>
<script>

  location.href="<?php echo $URL;?>/../categorias";
</script>

<?php
}else{
  session_start();
$_SESSION['mensaje']="ERROR AL REGISTRAR DE LA CATEGORIA";
//header('Location: '.$URL.'/../categorias/index.php');
}

 ?>
