<?php

session_start();
if (isset($_SESSION['sesion_email'])) {
  //  echo "si existe secion de:   ".$_SESSION['sesion_email'];
  $email_session = $_SESSION['sesion_email'];

  $sql = "SELECT per.id_Persona as id_Persona, per.per_Nombre as per_Nombre,
per.per_Correo as per_Correo, per.per_Estado as per_Estado,
rol.rol_Nombre as rol_nombre, rol.id_Rol as id_Rol, per.id_parametro as id_parametro FROM persona as per INNER JOIN
 rol ON PER.id_Rol= rol.id_Rol WHERE per_Correo='$email_session'";
  $query = $pdo->prepare($sql);
  $query->execute();
  $usuario = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach ($usuario as $usuari) {
    $id_usuario_session = $usuari['id_Persona'];
    $nombre_session = $usuari['per_Nombre'];
    $rol_session = $usuari['rol_nombre'];
    $rol_id = $usuari['id_Rol'];
    $id_param = $usuari['id_parametro'];
  }
} else {
  echo "no existe secion";
  header('Location: ' . $URL . '/login');
}
