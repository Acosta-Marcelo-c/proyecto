<?php
include('../../config.php');

$nombre = $_POST['nombre_rol'];
echo $nombre;
$descripcion = $_POST['descripcion_rol'];
$id_rol = $_POST['id_rol_actu'];
$fecha = $fechaHora;

$sentencia = $pdo->prepare("UPDATE rol SET
      rol_Nombre=:nombre, rol_Descripcion=:descripcion,
      rol_Fecha_Actulalizacion=:fecha
      WHERE id_Rol=:id");

$sentencia->bindParam('id', $id_rol);
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('fecha', $fecha);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "El ROL SE ACTUALIZO CORRECTAMENTE";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../roles";
  </script>

<?php
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR EN LA ACTUALIZACION";


?>
  <script>
    location.href = "<?php echo $URL; ?>/../roles";
  </script>

<?php
}

?>