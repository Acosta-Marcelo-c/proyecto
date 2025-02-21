<?php
include('../app/config.php');

$id_Rol = $_GET['id'];


$sql_modulo3 = "SELECT rol_Nombre  FROM rol WHERE id_Rol = $id_Rol;";

$query_modulo3 = $pdo->prepare($sql_modulo3);
$query_modulo3->execute();
$modulo3_datos = $query_modulo3->fetchAll(PDO::FETCH_ASSOC);


foreach ($modulo3_datos as $modulo3_dato) {

    $control_rol_nombre = $modulo3_dato['rol_Nombre'];
}
?>