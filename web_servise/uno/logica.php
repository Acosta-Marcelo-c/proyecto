
Copy
<?php
// Incluir la configuración de la base de datos
include('app/config.php');

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar que los datos necesarios estén presentes
    if (isset($data['email']) && isset($data['contrase'])) {
        $email = $data['email'];
        $contrase = $data['contrase'];

        // Consulta para obtener el usuario por correo
        $sql = "SELECT * FROM persona WHERE per_Correo = :email";
        $query = $pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($contrase, $usuario['per_Contrase'])) {
            // Iniciar sesión y almacenar datos en la sesión
            session_start();
            $_SESSION['sesion_email'] = $usuario['per_Correo'];
            $_SESSION['sesion_nombre'] = $usuario['per_Nombre'];

            // Respuesta JSON en caso de éxito
            echo json_encode([
                'status' => 'success',
                'message' => 'Datos correctos',
                'user' => [
                    'email' => $usuario['per_Correo'],
                    'nombre' => $usuario['per_Nombre']
                ]
            ]);
        } else {
            // Respuesta JSON en caso de credenciales incorrectas
            echo json_encode([
                'status' => 'error',
                'message' => 'Datos incorrectos, vuelva a intentar'
            ]);
        }
    } else {
        // Respuesta JSON si faltan datos
        echo json_encode([
            'status' => 'error',
            'message' => 'Faltan datos obligatorios (email y contraseña)'
        ]);
    }
} else {
    // Respuesta JSON si el método no es POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Método de solicitud no permitido'
    ]);
}
?>