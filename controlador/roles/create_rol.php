<?php
include('../../config.php');

$nombres = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

// Verificar si existe el rol
$stmt = $pdo->prepare("SELECT COUNT(*) FROM rol WHERE rol_Nombre = :nombre");
$stmt->bindParam(':nombre', $nombres);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
  session_start();
  $_SESSION['mensaje'] = "El rol ya existe";
  $_SESSION['tipo_mensaje'] = "error";
?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'El rol ya existe en el sistema',
      showConfirmButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo $URL; ?>/../roles";
      }
    });
  </script>
  <?php
  exit();
} else {


  $sentencia = $pdo->prepare("INSERT INTO rol
          (rol_Nombre, rol_Descripcion, rol_fecha_Creacion)
   VALUES (:nombre, :descripcion, :fecha)");

  $sentencia->bindParam('nombre', $nombres);
  $sentencia->bindParam('descripcion', $descripcion);
  $sentencia->bindParam('fecha', $fechaHora);

  if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "SE REGISTRO EL ROL CORRECTAMENTE";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../roles";
    </script>

  <?php
  } else {
    session_start();
    $_SESSION['mensaje'] = "ERROR AL REGISTRAR EL ROL";

  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../roles";
    </script>

<?php
  }
}
?>