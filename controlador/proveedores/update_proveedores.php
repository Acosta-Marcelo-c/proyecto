<?php
include('../../config.php');

$id_proveedor = $_GET['id_proveedor'];
$nombre_proveedor = $_GET['nombre_proveedor'];
$ruc_proveedor = $_GET['ruc_proveedor'];
$telefono_proveedor = $_GET['telefono_proveedor'];
$celular_proveedor = $_GET['celular_proveedor'];
$direccion_proveedor = $_GET['direccion_proveedor'];
$email_proveedor = $_GET['email_proveedor'];
$estado_proveedor = $_GET['estado_proveedor'];


$sentencia = $pdo->prepare("UPDATE proveedor
   SET   pro_Nombre=:nombre,
         pro_Celular=:celular,
         pro_Telefono=:telefono,
         pro_Email=:email,
         pro_Direccion=:direccion,
         pro_Ruc=:ruc,
         pro_FechaActualizacion=:fecha,
         pro_Estado=:estado
   WHERE id_Proveedor=:id_proveedor");

$sentencia->bindParam('id_proveedor', $id_proveedor);
$sentencia->bindParam('nombre', $nombre_proveedor);
$sentencia->bindParam('celular', $celular_proveedor);
$sentencia->bindParam('telefono', $telefono_proveedor);
$sentencia->bindParam('email', $email_proveedor);
$sentencia->bindParam('direccion', $direccion_proveedor);
$sentencia->bindParam('ruc', $ruc_proveedor);
$sentencia->bindParam('fecha', $fechaHora);
$sentencia->bindParam('estado', $estado_proveedor);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE ACTUALIZAR El  CORRECTAMENTE";

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