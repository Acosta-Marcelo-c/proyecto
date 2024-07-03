<?php


$sql_rol = "SELECT ROL.rol_Nombre, modulo.mod_Nombre 
FROM modulo INNER JOIN rol_mod ON modulo.id_mod= rol_mod.id_mod 
INNER JOIN rol ON rol.id_Rol= rol_mod.id_Rol WHERE rol.id_Rol = $;";
$query_rol = $pdo->prepare($sql_rol);
$query_rol->execute();
$rol_datos=$query_rol->fetchAll(PDO::FETCH_ASSOC);


 ?>
