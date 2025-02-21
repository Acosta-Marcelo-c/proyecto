<?php
// filepath: /c:/xampp/htdocs/fin2/login_service.php
header('Content-Type: application/json');

include('../app/pdoconfig.php');
include('../app/config.php');

$response = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // $username = isset($_POST['username']) ? $_POST['username'] : '';
   // $password = isset($_POST['password']) ? $_POST['password'] : '';

    //$username = $_POST['username'] ?? '';
   // $password = $_POST['password'] ?? '';
    //$username = 'kira@gmail.com';
    //$password = '1';
    $username = $_POST['username'] ?? $_GET['username'] ?? '';
    $password = $_POST['password'] ?? $_GET['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Consulta para verificar las credenciales del usuario
        $stmt = $pdo->prepare("SELECT * FROM persona WHERE per_Correo = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['per_Contrase'])) {
            // Login exitoso
            $response['status'] = 'success';
            $response['message'] = 'Login exitoso';
            $response['user'] = array(
                'id' => $user['id_Persona'],
                'username' => $user['per_Nombre'],
                'email' => $user['per_Correo']
            );
        } else {
            // Credenciales incorrectas
            $response['status'] = 'error';
            $response['message'] = 'Nombre de usuario o contraseña incorrectos';
        }
    } else {
        // Faltan parámetros
        $response['status'] = 'error';
        $response['message'] = 'Faltan parámetros';
        
    }
} else {
    // Método de solicitud no permitido
    $response['status'] = 'error';
    $response['message'] = 'Método de solicitud no permitido';
}

echo json_encode($response);
?>