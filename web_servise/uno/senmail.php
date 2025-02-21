<?php

//include('/app/controlador/usuarios/olvideUsuario.php');

$to = 'acosta.cortez.luis@gmail.com';
$subject = 'hola desdde xam';
//$message  = $hashedPassword;
$headers = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 20px;
        }
        .header {
            background-color: #0073e6;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            color: #333333;
            line-height: 1.5;
        }
        .cta {
            text-align: center;
            margin: 20px 0;
        }
        .cta a {
            text-decoration: none;
            background-color: #0073e6;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            color: #666666;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://via.placeholder.com/150x50.png?text=Tu+Logo" alt="Logo de la Empresa">
            <h1>Bienvenido a Nuestro Servicio</h1>
        </div>
        <div class="content">
            <p>Hola [Nombre],</p>
            <p>Gracias por registrarte en nuestro servicio. Estamos emocionados de tenerte con nosotros.</p>
            <p>Si tienes alguna duda, no dudes en contactarnos.</p>
            <div class="cta">
                <a href="#">Comienza Ahora</a>
            </div>
            <p>Atentamente,<br>El equipo de [Tu Empresa]</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 [Tu Empresa]. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
';
if(mail($to, $subject, $message, $headers)){
echo "SU CORREO SE HA ENVIADO ";


}ELSE
{
    echo "SU CORREO NOOOOOO SE HA ENVIADO ";
}

?>