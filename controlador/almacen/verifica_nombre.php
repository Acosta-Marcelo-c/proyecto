<?php
include('../../config.php');

$nombre = $_POST['nombre'];
$stmt = $pdo->prepare("SELECT COUNT(*) FROM almacen WHERE alm_Nombre = :nombre");
$stmt->bindParam(':nombre', $nombre);
$stmt->execute();

echo ($stmt->fetchColumn() > 0) ? 'existe' : 'no_existe';
