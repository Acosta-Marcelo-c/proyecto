<?php
include('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];
$descripcion_categoria = $_GET['descripcion_categoria'];

// Verificar si existe la categoría
$stmt = $pdo->prepare("SELECT COUNT(*) FROM categoria WHERE cat_Nombre = :nombre");
$stmt->bindParam(':nombre', $nombre_categoria);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
  session_start();
  $_SESSION['mensaje'] = "La categoría ya existe";
  $_SESSION['tipo_mensaje'] = "error";
?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'La categoría ya existe',
      showConfirmButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo $URL; ?>/../categorias";
      }
    });
  </script>
<?php
  exit();
} else {
}
$sentencia = $pdo->prepare("INSERT INTO categoria
          (cat_Nombre, cat_FechaCreacion, cat_descripcion)
   VALUES (:nombre, :fecha, :descripcion)");

$sentencia->bindParam('nombre', $nombre_categoria);
$sentencia->bindParam('fecha', $fechaHora);
$sentencia->bindParam('descripcion', $descripcion_categoria);

if ($sentencia->execute()) {
  session_start();
  $_SESSION['mensaje'] = "SE REGISTRO LA CATEGORIA CORRECTAMENTE";
 
?>
  <script>
    location.href = "<?php echo $URL; ?>/../categorias";
  </script>

<?php
} else {
  session_start();
  $_SESSION['mensaje'] = "ERROR AL REGISTRAR DE LA CATEGORIA";
 
}

?>