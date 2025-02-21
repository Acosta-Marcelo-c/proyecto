<?php
include('../../config.php');

$nombres_mod = $_POST['nombre_mod'];
$estado_mod = $_POST['estado_mod'];
$icono_mod = $_POST['mod_icono'];
$descripcion_mod = $_POST['descripcion_mod'];

$ruta_mod = '../../' . $nombres_mod . '/index.php';
$icono = '<i class="' . $icono_mod . '" ></i>';

// Verificar si existe el modulo
$stmt = $pdo->prepare("SELECT COUNT(*) FROM modulo WHERE mod_Nombre = :nombre");
$stmt->bindParam(':nombre', $nombres_mod);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
  session_start();
  $_SESSION['mensaje'] = "El modulo ya existe";
  $_SESSION['tipo_mensaje'] = "error";
?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'El modulo ya existe en el sistema',
      showConfirmButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo $URL; ?>/../creacion/index.php";
      }
    });
  </script>
  <?php
  exit();
} else {


  $sentencia = $pdo->prepare("INSERT INTO modulo
          (mod_Nombre, mod_Estado, mod_Ruta, mod_Icono, mod_Descripcion, mod_fecha)
   VALUES (:nombre, :estado, :ruta, :icono, :descripcion, :fecha)");


  $sentencia->bindParam('nombre', $nombres_mod);
  $sentencia->bindParam('estado', $estado_mod);
  $sentencia->bindParam('ruta', $ruta_mod);
  $sentencia->bindParam('icono', $icono);
  $sentencia->bindParam('descripcion', $descripcion_mod);
  $sentencia->bindParam('fecha', $fechaHora);

  if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "SE REGISTRO EL MODULO CORRECTAMENTE";
   
  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../creacion/index.php";
    </script>

  <?php
  } else {
    session_start();
    $_SESSION['mensaje'] = "ERROR AL REGISTRAR EL ROL";
   
  ?>
    <script>
      location.href = "<?php echo $URL; ?>/../creacion/index.php";
    </script>

<?php
  }
}
?>