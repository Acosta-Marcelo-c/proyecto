<?php


$sql_usuarios = "SELECT 
    per.id_Persona as id_Persona, 
    per.per_Nombre as per_Nombre,
    per.per_Correo as per_Correo, 
    per.per_Estado as per_Estado,
    rol.rol_Nombre as rol_nombre, 
    per.per_Fecha_Creacion as per_Fecha_Creacion, 
    par.par_Nom_Empre as Empresa 
FROM persona as per 
INNER JOIN rol ON per.id_Rol = rol.id_Rol 
INNER JOIN parametro as par ON per.id_parametro = par.id_Param";

$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
?>