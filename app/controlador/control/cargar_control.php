<?php
include ('../app/config.php');

$id_Rol = $_GET['id'];

/*$sql_modulo2 = "SELECT* 
FROM rol
WHERE rol.id_Rol = '$id_Rol';";*/

$sql_modulo2 = "SELECT* 
FROM modulo INNER JOIN rol_mod ON modulo.id_mod= rol_mod.id_mod
INNER JOIN rol ON rol.id_Rol= rol_mod.id_Rol 
WHERE rol.id_Rol = '$id_Rol';";

$query_modulo2 = $pdo->prepare($sql_modulo2);
$query_modulo2->execute();
$modulo2_datos=$query_modulo2->fetchAll(PDO::FETCH_ASSOC);


foreach ($modulo2_datos as $modulo2_dato) {

    $control_rol_nombre= $modulo2_dato['rol_Nombre'];
    

}

?>