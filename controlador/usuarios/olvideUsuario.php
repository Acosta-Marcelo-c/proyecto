<?php

include('../../config.php');

$email = $_POST['email'];
$bytes = random_bytes(5);
$token = bin2hex($bytes);
$codigo = rand(10000, 99999);

$stmt = $pdo->prepare("SELECT par_Tiem_Corr, par_Logo FROM parametro WHERE id_Param = :id");
$stmt->bindParam(':id', $id_param);
$id_param = 1;
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$tiempo = $resultado['par_Tiem_Corr'];
$logo = $resultado['par_Logo'];

// Validar y codificar imagen
$ruta_logo = __DIR__ . "/../../../parametros/imagen/" . $logo;
if (file_exists($ruta_logo)) {

    // Codificar imagen
    $logo_binario = file_get_contents($ruta_logo);
    $logo_base64 = base64_encode($logo_binario);
    $tipo_imagen = pathinfo($ruta_logo, PATHINFO_EXTENSION);
} else {
    $logo1 = __DIR__ . "/../../../parametros/imagen/logo.png";
    $imagen_base64 = base64_encode($logo1); // Imagen por defecto o manejo de error
}
$contador = 0;

$sql = "SELECT * FROM persona WHERE per_Correo='$email'";
$query = $pdo->prepare($sql);
$query->execute();
$usuario = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuario as $usuari) {
    $contador++;
    $email_tabla = $usuari['per_Correo'];
    $nombre_tabla = $usuari['per_Nombre'];
    $id_table = $usuari['id_Persona'];
}

if ($contador > 0) {

    $verifica = $pdo->prepare("INSERT INTO password (id_password, id_Persona, pas_correo, pas_token, pas_codigo, pas_fecha)
                                           VALUES (NULL, :id_persona, :email, :token, :codigo, current_timestamp())");
    $verifica->bindParam(':email', $email_tabla);
    $verifica->bindParam(':token', $token);
    $verifica->bindParam(':codigo', $codigo);
    $verifica->bindParam(':id_persona', $id_table);
    $verifica->execute();

    if ($verifica) {
        // Si el email existe, enviar correo
        $to = $email_tabla;
        $subject = "Recuperación de contraseña";

        // Generar boundary
        $boundary = md5(time());

        // Cabeceras
        $headers = "From: Sistema <no-reply@sistema.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/related; boundary=\"" . $boundary . "\"\r\n";

        // HTML con estilos inline
        $message_body = "--" . $boundary . "\r\n";
        $message_body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message_body .= '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Venta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd; padding: 20px; }
        .header { background-color: #0073e6; color: #ffffff; text-align: center; padding: 20px; }
        .header img { max-width: 150px; height: auto; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { color: #333333; line-height: 1.5; }
        .cta { text-align: center; margin: 20px 0; }
        .cta a { text-decoration: none; background-color: #0073e6; color: #ffffff; padding: 10px 20px; border-radius: 5px; font-weight: bold; }
        .footer { text-align: center; color: #666666; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="cid:logo@sistema.com" alt="Logo de la Empresa" style="max-width:150px;">
            <h1>Recuperacion de contraseña</h1>
        </div>
        <div class="content">
            <p>Hola, ' . $nombre_tabla . '</p>
            <p>Tienes ' . $tiempo . ' horas para confirmar tu cuenta.</p>
            <p>Si tiene alguna duda, no dude en contactarnos.</p>
           <div style="text-align: center; margin: 20px 0;">
    <a href="http://localhost/fin2/app/login/indexCodigo.php?nombre=' . $nombre_tabla . '&id_tabla=' . $id_table . '&email=' . $email_tabla . '&token=' . $token . '" 
       style="display: inline-block;
              background-color: #0073e6;
              color: #ffffff;
              text-decoration: none;
              padding: 12px 25px;
              border-radius: 5px;
              font-weight: bold;
              font-size: 16px;
              border: none;
              cursor: pointer;
              transition: background-color 0.3s ease;" 
       onmouseover="this.style.backgroundColor=\'#0056b3\'" 
       onmouseout="this.style.backgroundColor=\'#0073e6\'"
       target="_blank">
        CONFIRMAR CUENTA
    </a>
</div>
            <p>El código es: ' . $codigo . '</p>
        </div>
        <div class="footer">
            <p>Este mensaje fue enviado automáticamente. Por favor no responda a este mensaje.</p>
    </div>
</body>
</html>' . "\r\n\r\n";


        // Parte Imagen
        $message_body .= "--" . $boundary . "\r\n";
        $message_body .= "Content-Type: image/" . $tipo_imagen . "; name=\"logo." . $tipo_imagen . "\"\r\n";
        $message_body .= "Content-Transfer-Encoding: base64\r\n";
        $message_body .= "Content-ID: <logo@sistema.com>\r\n";
        $message_body .= "Content-Disposition: inline; filename=\"logo." . $tipo_imagen . "\"\r\n\r\n";
        $message_body .= chunk_split($logo_base64) . "\r\n";
        $message_body .= "--" . $boundary . "--";

        // Cerrar boundary
        $message_body .= "--" . $boundary . "--";

        if (mail($to, $subject, $message_body, $headers)) {
            session_start();

?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Correo de recuperacion enviado correctamente',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo $URL; ?>/login/index.php";
                    }
                });
            </script>
        <?php
        } else {
            session_start();

        ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ERROR en envio correo de recuperación.',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo $URL; ?>/login/index.php";
                    }
                });
            </script>
<?php
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al insertar los datos.";
        echo "<script>location.href='{$URL}/login/index.php';</script>";
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "El email no está registrado.";
    echo "<script>location.href='{$URL}/login/index.php';</script>";
}
?>