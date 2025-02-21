<?php
include('../../config.php');

$rol = $_POST['rol'];
$parametro = '1';
$nombres = $_POST['nombre'];
$email = $_POST['email'];
$estado = $_POST['estado'];
$password = $_POST['password'];
$password_repite = $_POST['password_repite'];

$consulta = $pdo->prepare("SELECT * FROM persona WHERE per_Correo=:email");
$consulta->bindParam('email', $email);
$consulta->execute();

if ($consulta->rowCount() > 0) {

    $_SESSION['mensaje'] = "ERROR EL CORREO YA EXISTE";
    $_SESSION['tipo_mensaje'] = "error";

?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El correo ya existe',
            showConfirmButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo $URL; ?>/login/index.php";
            }
        });
    </script>
    <?php

} else {

    $stmt = $pdo->prepare("SELECT* FROM parametro WHERE id_Param = :id");
    $stmt->bindParam(':id', $id_param);
    $id_param = 1;
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $email_emp = $resultado['par_Correo'];
    $empresa = $resultado['par_Nom_Empre'];
    $logo = $resultado['par_Logo'];

    // Codificar imagen
    $ruta_logo = __DIR__ . "/../../../parametros/imagen/" . $logo;
    $logo_binario = file_get_contents($ruta_logo);
    $logo_base64 = base64_encode($logo_binario);
    $tipo_imagen = pathinfo($ruta_logo, PATHINFO_EXTENSION);

    if ($password == $password_repite) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("INSERT INTO persona
                  (id_Rol, id_parametro, per_Nombre, per_Correo, per_Contrase, per_Estado, per_Fecha_Creacion)
          VALUES (:rol, :parametro, :nombre, :email, :password, :estado, :fecha)");

        $sentencia->bindParam('rol', $rol);
        $sentencia->bindParam('parametro', $parametro);
        $sentencia->bindParam('nombre', $nombres);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('estado', $estado);
        $sentencia->bindParam('password', $password);
        $sentencia->bindParam('fecha', $fechaHora);
        $sentencia->execute();

        if ($sentencia) {

            //si de registro correctamente se envia un correo
            $to = $email;
            $subject = "Creacion de usuario";

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
                    <h1>Creacion de Usuario</h1>

                </div>
                <div class="content">
                    <p>Hola, ' . $nombres . '</p>
                    <p>Se a creado correctamente tu usuario al acceso al sistema de la empresa: ' . $empresa . '</p>
                    <p>Tu usuarios para el ingreso al sistema es tu correo</p>
                    <p>Para los accesos correspondiente al sistema se debe tomar contacto con el Administrador de sistema al correo: ' . $email_emp . ' </p>
                    
                    <p>Gracias por tu registro</p>

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

            mail($to, $subject, $message_body, $headers);
        }



        //session_start();
        $_SESSION['mensaje'] = "SE REGISTRO CORRECTAMENTE";

    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'SE REGISTRO CORRECTAMENTE',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo $URL; ?>/login/index.php";
                }
            });
        </script>
    <?php
    } else {

        $_SESSION['mensaje'] = "ERROR LAS CONTRASEÑAS NO SON IGUALES";


    ?>
        <script>
            location.href = "<?php echo $URL; ?>/login/index.php";
        </script>
<?php
    }
}
?>