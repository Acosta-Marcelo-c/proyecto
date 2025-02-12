
<?php


include('../app/pdoconfig.php');
include('../app/config.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Consulta para obtener productos
        $stmt = $pdo->prepare("SELECT id_Almacen, alm_Codigo, alm_Nombre, alm_Descripcion, alm_Imagen, alm_PrecioVenta, alm_Stock FROM `almacen`;");
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($productos) {
            $response['status'] = 'success';
            $response['message'] = 'Productos encontrados';
            $response['productos'] = $productos;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No se encontraron productos';
        }
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Método no permitido';
}

echo json_encode($response);
?>