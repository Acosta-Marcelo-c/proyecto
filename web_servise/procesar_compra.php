<?php
header("Content-Type: application/json; charset=UTF-8");

// Habilitar CORS (si es necesario)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include('../app/pdoconfig.php');
include('../app/config.php');

try {
    // Decodificar los datos JSON recibidos
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si los datos están completos
    if (
        isset($data['id_Persona']) &&
        isset($data['cli_PagoTotal']) &&
        isset($data['productos']) && is_array($data['productos'])
    ) {
        $id_Persona = $data['id_Persona'];
        $cli_PagoTotal = $data['cli_PagoTotal'];
        $productos = $data['productos'];

        // Obtener el número de pedido más alto y sumarle 1
        $stmt = $pdo->prepare("SELECT MAX(ped_numero) AS num_Pedido FROM `pedido`;");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num_Pedido = isset($row['num_Pedido']) ? (int)$row['num_Pedido'] + 1 : 1;

        // Obtener datos del usuario
        $sql_usuarios = "SELECT per_Nombre as nombre_cli, per_Correo as email_cli 
                        FROM persona WHERE id_Persona=:id_persona";
        $query_usuarios = $pdo->prepare($sql_usuarios);
        $query_usuarios->bindParam(':id_persona', $id_Persona);
        $query_usuarios->execute();
        $usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

        if (empty($usuarios_datos)) {
            throw new Exception("Usuario no encontrado.");
        }

        foreach ($usuarios_datos as $usuarios_dato) {
            $nombre_cli = $usuarios_dato['nombre_cli'];
            $email_cli = $usuarios_dato['email_cli'];
        }

        // Insertar cliente
        $fechaHora = date('Y-m-d H:i:s'); // Definir fecha y hora
        $sente = $pdo->prepare("INSERT INTO cliente 
            (cli_nombres, cli_Email, cli_FchaCreacion) 
        VALUES (:nombre_cli, :email_cli, :fecha)");

        $sente->bindParam(':nombre_cli', $nombre_cli);
        $sente->bindParam(':email_cli', $email_cli);
        $sente->bindParam(':fecha', $fechaHora);
        $sente->execute();
        $id_Cliente = $pdo->lastInsertId();

        // Insertar productos en el pedido y actualizar Stock
        foreach ($productos as $producto) {
            $id_producto = $producto['id_Almacen'];
            $cantidad = $producto['per_Cantidad'];

            // Obtener datos del producto
            $sql_productos = "SELECT alm_Stock FROM almacen WHERE id_Almacen=:id_producto";     
            $query_productos = $pdo->prepare($sql_productos);
            $query_productos->bindParam(':id_producto', $id_producto);
            $query_productos->execute();
            $producto_dato = $query_productos->fetch(PDO::FETCH_ASSOC);

            if (!$producto_dato) {
                throw new Exception("Producto no encontrado.");
            }

            $alm_stock = $producto_dato['alm_Stock'];

            if ($alm_stock < $cantidad) {
                throw new Exception("Stock insuficiente para el producto con ID: $id_producto.");
            }

            $almNuevo = $alm_stock - $cantidad;

            $sentencia = $pdo->prepare("INSERT INTO pedido (
                ped_numero, id_Almacen, ped_Cantidad, ped_FechaCreacion)
            VALUES (:ped_numero, :id_producto, :cantidad, :fecha) ");

            $sentencia->bindParam('ped_numero', $num_Pedido);
            $sentencia->bindParam('id_producto', $id_producto);
            $sentencia->bindParam('cantidad', $cantidad);
            $sentencia->bindParam('fecha', $fechaHora);
            $sentencia->execute();

            $senProdu = $pdo->prepare("UPDATE almacen SET 
                alm_Stock=:stock 
                WHERE id_Almacen=:id_almacen");

            $senProdu->bindParam('stock', $almNuevo);
            $senProdu->bindParam('id_almacen', $id_producto);
            $senProdu->execute();
        }

        // Insertar venta
        $sen = $pdo->prepare("INSERT INTO ventas
            (id_Cliente, ped_numero, cli_PagoTotal, cli_FechaCreacion)  
        VALUES (:id_cliente, :nro_pedido, :total_venta, :fecha) ");

        $sen->bindParam('id_cliente', $id_Cliente);
        $sen->bindParam('nro_pedido', $num_Pedido);
        $sen->bindParam('total_venta', $cli_PagoTotal);
        $sen->bindParam('fecha', $fechaHora);
        $sen->execute();

        // Respuesta de éxito
        $response = array(
            "status" => "success",
            "message" => "Compra procesada correctamente",
            "data" => array(
                "id_Cliente" => $id_Cliente,
                "num_Pedido" => $num_Pedido,
                "cli_PagoTotal" => $cli_PagoTotal
            )
        );
        echo json_encode($response);
    } else {
        // Respuesta de error si los datos están incompletos
        $response = array(
            "status" => "error",
            "message" => "Datos incompletos o incorrectos"
        );
        echo json_encode($response);
    }
} catch (Exception $e) {
    // Respuesta de error en caso de excepción
    $response = array(
        "status" => "error",
        "message" => "Error en el servidor: " . $e->getMessage()
    );
    echo json_encode($response);
}
?>