<?php
include('../../config.php');

$contador = (int)$_POST['contador'];
$id_rol = (int)$_POST['id_rol'];
$control = $_POST['control'];


if (isset($id_rol)) {
  $sentencia1 = $pdo->prepare("DELETE FROM rol_mod WHERE id_Rol=(:id_rol)");
  $sentencia1->bindParam(':id_rol', $id_rol);
  $sentencia1->execute();

  $sentencia = $pdo->prepare("INSERT INTO rol_mod (id_Rol, id_mod) VALUES (:id_rol, :id_mod)");

  foreach ($control as $valor) {
    $valor1 = $valor;

    $sentencia->bindParam(':id_mod', $valor1);
    $sentencia->bindParam(':id_rol', $id_rol);

    $sentencia->execute();
  }
} else {
  $sentencia = $pdo->prepare("INSERT INTO rol_mod (id_Rol, id_mod) VALUES (:id_rol, :id_mod)");

  foreach ($control as $valor) {
    $valor1 = $valor;

    $sentencia->bindParam(':id_mod', $valor1);
    $sentencia->bindParam(':id_rol', $id_rol);

    $sentencia->execute();
  }
}
?>
<script>
  location.href = "<?php echo $URL; ?>/../control/index.php";
</script>
