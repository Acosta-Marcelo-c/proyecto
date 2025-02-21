<?php
$id_Param = $_GET['id'];

$sql_param = "SELECT * FROM parametro WHERE id_Param = '$id_Param'";

$query_param = $pdo->prepare($sql_param);
$query_param->execute();
$param_datos = $query_param->fetchAll(PDO::FETCH_ASSOC);

foreach ($param_datos as $param_dato) {

  $nombre = $param_dato['par_Nom_Empre'];
  $logo = $param_dato['par_Logo'];
  $ruc = $param_dato['par_Ruc'];
  $descripcion = $param_dato['par_Descripcion'];
  $correo = $param_dato['par_Correo'];
  $direccion = $param_dato['par_Direccion'];
  $telefono = $param_dato['par_Telefono'];
  $fecha_ingreso = $param_dato['par_Fecha_Crea'];
  $fecha_modificacion = $param_dato['par_Fecha_Mod'];
  $hora = $param_dato['par_Tiem_Corr'];
  $stock_min = $param_dato['par_stok_min'];
  $stock_max = $param_dato['par_stok_max'];
}
?>