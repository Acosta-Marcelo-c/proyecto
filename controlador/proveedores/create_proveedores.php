<?php
include('../../config.php');

$nombre_proveedor = $_GET['nombre_proveedor'];
$ruc_proveedor = $_GET['ruc_proveedor'];
$telefono_proveedor = $_GET['telefono_proveedor'];
$celular_proveedor = $_GET['celular_proveedor'];
$direccion_proveedor = $_GET['direccion_proveedor'];
$email_proveedor = $_GET['email_proveedor'];

// Verificar nombre o RUC duplicado
$stmt = $pdo->prepare("SELECT * FROM proveedor WHERE pro_Nombre = :nombre OR pro_Ruc = :ruc");
$stmt->bindParam(':nombre', $nombre_proveedor);
$stmt->bindParam(':ruc', $ruc_proveedor);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);
  $mensaje = ($proveedor['pro_Nombre'] == $nombre_proveedor) ?
    "El nombre del proveedor ya existe" :
    "El RUC ya está registrado";

  session_start();
  $_SESSION['mensaje'] = $mensaje;
  $_SESSION['tipo_mensaje'] = "error";
?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '<?php echo $mensaje; ?>',
      showConfirmButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo $URL; ?>/../proveedores";
      }
    });
  </script>
<?php
  exit();
}

$sentencia = $pdo->prepare("INSERT INTO proveedor (pro_Nombre, pro_Celular,
   pro_Telefono, pro_Email, pro_Direccion, pro_Ruc, pro_FechaCreacion)
   VALUES (:nombre,:celular,:telefono,:email,:direccion,:ruc,:fecha)");

$sentencia->bindParam('nombre', $nombre_proveedor);
$sentencia->bindParam('celular', $celular_proveedor);
$sentencia->bindParam('telefono', $telefono_proveedor);
$sentencia->bindParam('email', $email_proveedor);
$sentencia->bindParam('direccion', $direccion_proveedor);
$sentencia->bindParam('ruc', $ruc_proveedor);
$sentencia->bindParam('fecha', $fechaHora);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE REGISTRO El  CORRECTAMENTE";

?>
  <script>
    location.href = "<?php echo $URL; ?>/../proveedores";
  </script>

<?php
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR AL REGISTRAR DE LA CATEGORIA";
}

?>