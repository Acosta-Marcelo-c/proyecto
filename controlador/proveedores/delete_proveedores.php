<?php
include('../../config.php');

$id_proveedor = $_GET['id_proveedor'];


$sentencia = $pdo->prepare("UPDATE proveedor
   SET   pro_Estado='INACTIVO', pro_FechaActualizacion=:fecha
   WHERE id_Proveedor=:id_proveedor");


$sentencia->bindParam('id_proveedor', $id_proveedor);
$sentencia->bindParam('fecha', $fechaHora);


if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE ELIMINO El  CORRECTAMENTE";

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