<?php

$id_rol_get = $_GET['id'];

$sql_rol = "SELECT * FROM rol WHERE id_Rol ='$id_rol_get'";
$query_rol = $pdo->prepare($sql_rol);
$query_rol->execute();
$rol_datos = $query_rol->fetchAll(PDO::FETCH_ASSOC);


foreach ($rol_datos as $rol_dato) {
  $id = $rol_dato['id_Rol'];
  $Nombre = $rol_dato['rol_Nombre'];
  $Descripcion = $rol_dato['rol_Descripcion'];
}
?>