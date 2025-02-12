<?php
header("Content-Type: application/json; charset=UTF-8");

// Habilitar CORS (si es necesario)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

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

    // Validar que los productos tengan los campos requeridos
    $productosValidos = true;
    foreach ($productos as $producto) {
        if (!isset($producto['id_Almacen']) || !isset($producto['per_Cantidad'])) {
            $productosValidos = false;
            break;
        }
    }

    if ($productosValidos) {
        // Mostrar los datos recibidos en la respuesta
        $response = array(
            "status" => "success",
            "message" => "Datos recibidos correctamente",
            "data" => array(
                "id_Persona" => $id_Persona,
                "cli_PagoTotal" => $cli_PagoTotal,
                "productos" => $productos
            )
        );

        // Aquí puedes procesar los datos (por ejemplo, guardarlos en una base de datos)
        // Ejemplo de conexión a una base de datos MySQL
        $servername = "localhost";
        $username = "tu_usuario";
        $password = "tu_contraseña";
        $dbname = "tu_base_de_datos";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
        }

        // Insertar la compra en la tabla de compras
        $sql = "INSERT INTO compras (id_Persona, cli_PagoTotal) VALUES ('$id_Persona', '$cli_PagoTotal')";
        if ($conn->query($sql) === TRUE) {
            $id_Compra = $conn->insert_id; // Obtener el ID de la compra recién insertada

            // Insertar los productos de la compra en la tabla de detalles_compra
            foreach ($productos as $producto) {
                $id_Almacen = $producto['id_Almacen'];
                $per_Cantidad = $producto['per_Cantidad'];

                $sql = "INSERT INTO detalles_compra (id_Compra, id_Almacen, per_Cantidad) 
                        VALUES ('$id_Compra', '$id_Almacen', '$per_Cantidad')";
                $conn->query($sql);
            }

            // Agregar mensaje de éxito a la respuesta
            $response["message"] = "Compra procesada correctamente";
        } else {
            // Respuesta de error
            $response["status"] = "error";
            $response["message"] = "Error al procesar la compra: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        // Respuesta de error si los productos no tienen los campos requeridos
        $response = array(
            "status" => "error",
            "message" => "Los productos deben tener 'id_Almacen' y 'per_Cantidad'"
        );
    }
} else {
    // Respuesta de error si los datos están incompletos
    $response = array(
        "status" => "error",
        "message" => "Datos incompletos o incorrectos"
    );
}

// Enviar la respuesta en formato JSON
echo json_encode($response);
?>