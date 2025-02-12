<?php
header('Content-Type: application/json');

include('../app/pdoconfig.php');
include('../app/config.php');

$response = array();

$email = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!empty($email) && !empty($password)) {
    $sql = "SELECT * FROM persona WHERE per_Correo = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Depurar datos obtenidos
        error_log("Datos del usuario: " . print_r($user, true));

        if (password_verify($password, $user['per_Contrase'])) {
            // Verificar si id_Persona realmente existe
            if (!isset($user['id_Persona'])) {
                error_log("Error: id_Persona no encontrado en la consulta SQL.");
            }

            // Login exitoso
            $response['status'] = 'success';
            $response['message'] = 'Login exitoso';
            $response['user'] = array(
                'UserId' => intval($user['id_Persona']),  // Convertir a int
                'Username' => $user['per_Nombre'],
                'email' => $user['per_Correo']
            );
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Nombre de usuario o contraseña incorrectos';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Usuario no encontrado';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Faltan parámetros de acceso';
    $response['usuar'] = $email;
    $response['password'] = $password;
}

echo json_encode($response);
?>
