<?php

include('../../config.php');
session_start();

$stmt = $pdo->prepare("SELECT par_Tiem_Corr FROM parametro WHERE id_Param = :id");
$stmt->bindParam(':id', $id_param);
$id_param = 1;
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$tiempo = $resultado['par_Tiem_Corr'];

$email = $_POST['email_usuario'];
$token = $_POST['token_usuario'];
$codigo = $_POST['codigo_usuario'];
$fecha = date('Y-m-d H:i:s'); // Definir la variable $fechaHora
$fechaFin = date('Y-m-d H:i:s', strtotime($fecha . '+' . $tiempo . 'hours')); // Definir la variable $fechaFin
$nombre = $_POST['nombre_usuario'];
$id_tabla = $_POST['id_tabla'];

$contador = 0;

$verifica = $pdo->prepare("SELECT * 
FROM password
WHERE pas_correo = :email
  AND pas_token = :token
  AND pas_codigo = :codigo
  AND pas_fecha <= :fecha
  AND :pas_fecha_fin >= pas_fecha");

$verifica->bindParam(':email', $email);
$verifica->bindParam(':token', $token);
$verifica->bindParam(':codigo', $codigo);
$verifica->bindParam(':fecha', $fecha);
$verifica->bindParam(':pas_fecha_fin', $fechaFin);

$verifica->execute();


$resultado = $verifica->fetch(PDO::FETCH_ASSOC);


if ($resultado) {
  $_SESSION['mensaje'] = "Confirmacion correcta.";

  echo "<form id='redirectForm' action='{$URL}/login/indexRecupera.php' method='post'>
          <input type='hidden' name='email' value='" . htmlspecialchars($email) . "'>
          <input type='hidden' name='nombre' value='" . htmlspecialchars($nombre) . "'> 
          <input type='hidden' name='id_tabla' value='" . htmlspecialchars($id_tabla) . "'>
        </form>
        <script type='text/javascript'>
          document.getElementById('redirectForm').submit();
        </script>";
} else {
  $_SESSION['mensaje'] = "ERROR INTENTE NUEVAMENTE.";
  echo "<script>location.href='{$URL}/login/index.php';</script>";
}
?>