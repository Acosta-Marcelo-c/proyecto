<?php

include('../app/TCPDF-main/tcpdf.php');
include('../app/pdoconfig.php');
include('../app/config.php');

$id_param = $_GET['id_param'];
$nro_pedido = $_GET['no_pedido'];
$id_ventas = $_GET['id_ventas'];
$email_cli = $_GET['email_cli'];

try {
    $sentencia = $pdo->prepare("SELECT * FROM parametro WHERE id_Param = :id_param");
    $sentencia->bindParam(':id_param', $id_param);
    $sentencia->execute();
    $parametros = $sentencia->fetch(PDO::FETCH_ASSOC);

    // $parametros para acceder a los datos
    $nombre_empresa = $parametros['par_Nom_Empre'];
    $logo = "../parametros/imagen/" . $parametros['par_Logo'];
    $ruc = $parametros['par_Ruc'];
    $direccion = $parametros['par_Direccion'];
    // etc...

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$sql_ventas = "SELECT*, cli.cli_nombres as nombre_cliente, 
cli.cli_Tipo_Documento as Tipo_documento, cli.cli_NumeroDocumento as NumeroDocumento
 FROM ventas  as vent INNER JOIN cliente as cli ON cli.id_Cliente = vent.id_Cliente WHERE vent.id_Ventas='$id_ventas' ";

$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);


foreach ($ventas_datos as $ventas_dato) {


    $cli_FechaCreacion = $ventas_dato['cli_FechaCreacion'];
    $Tipo_documento = $ventas_dato['Tipo_documento'];
    $NumeroDocumento = $ventas_dato['NumeroDocumento'];
    $nombre_cliente = $ventas_dato['nombre_cliente'];
}
$fecha = date("d/m/Y", strtotime($cli_FechaCreacion));



$contador_listaPedido = 0;
$cantidad_total = 0;
$precio_uni_total = 0;
$total_venta = 0;
$sql_pedido = "SELECT *, alm.id_Almacen as id_Almacen, ped.id_Perdido as id_pedido,
                         alm.alm_Nombre as nombre_producto, alm.alm_Descripcion as descripcion_producto,
                         ped.ped_Cantidad as ped_Cantidad, alm.alm_PrecioVenta as alm_PrecioVenta,
                         alm.alm_Stock as alm_Stock
                         FROM pedido as ped INNER JOIN 
                         almacen as alm   ON ped.id_Almacen = alm.id_Almacen
                         WHERE ped_numero = $nro_pedido";

$query_pedido = $pdo->prepare($sql_pedido);
$query_pedido->execute();
$pedido_datos = $query_pedido->fetchAll(PDO::FETCH_ASSOC);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema O.G.L.');
$pdf->setTitle('Pedido de Venta');
$pdf->setSubject('Pedido de Venta');
$pdf->setKeywords('pedido de Venta');

//remove default header/fouter
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Set font

$pdf->setFont('Helvetica', '', 7);

// Add a page
$pdf->AddPage();

//create some HTML content
$html = '
<table>
<tr>
    <td style="text-align: center"><img src="' . $logo . '" width="80px"></td>
    <td></td>
    <td style="text-align: center"></td>
</tr>
<tr>
    <td style="text-align: center"><h1>' . $nombre_empresa . '</h1></td>
    <td></td>
    <td style="text-align: center"><h2> PEDIDO </h2></td>
</tr>
<tr>
    <td style="text-align: center"><h2>_____________________________</h2></td>
    <td></td>
    <td style="text-align: center"><h1>RUC: ' . $ruc . '</h1></td>
</tr>
<tr>
    <td ></td>
    <td></td>
    <td style="text-align: center"><h2> Fecha: ' . $fecha . '  </h2></td>
</tr>
<tr>
    <td style="text-align: center">Direccion: ' . $direccion . '</td>
    <td></td>
    <td style="text-align: center"><h3></h3></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td  style="text-align: center">Fecha Envio:' . $fechaHora . '</td>
</tr>
</table>
<hr>
<p style="text-align: center; font-size: 25px">PEDIDO</p>

<div style="border: 1px solid #000000">
<table border="0" cellpadding="6px">
<tr>
<td><h2>Sr. ' . $nombre_cliente . '</h2></td>
<td><h2>' . $Tipo_documento . ':  ' . $NumeroDocumento . '</h2></td>
</tr>
<tr>
<td><h2>Fecha de Emision: ' . $fecha . '</h2></td>
<td><h2>Guía de Remision:</h2></td>
</tr>
</table>
</div>

<hr>
<p></p>

<table border="1" cellpadding="5" style="font-size:10">
<tr style="text-align: center; background-color: #d6d6d6">
<th style="text-align: center; width: 100px"><h2>Cantidad</h2></th>
<th style=" text-align: center; width: 400px"><h2>Descripcion</h2></th>
<th style="text-align: center; width: 110px"><h2>P. Unitario</h2></th>
<th style="text-align: center; width: 110px"><h2>P. Total</h2></th>
</tr>
';

foreach ($pedido_datos as $pedido_dato) {
    $contador_listaPedido = $contador_listaPedido + 1;
    $precio_SubTotal  = $pedido_dato['ped_Cantidad'] * $pedido_dato['alm_PrecioVenta'];
    $total_venta = $total_venta + $precio_SubTotal;

    $html .= '
    <tr style=" text-align: center">
    <td><h2>' . $pedido_dato['ped_Cantidad'] . '</h2></td>
    <td><h2>' . $pedido_dato['descripcion_producto'] . ' codigo: ' . $pedido_dato['alm_Codigo'] . '</h2></td>
    <td><h2>' . $pedido_dato['alm_PrecioVenta'] . '</h2></td>
    <td><h2>' . $precio_SubTotal . '</h2></td>
    </tr>
    
';
}

$html .= '
<tr style="text-align: center">
    <td colspan="3" style="text-align: right; background-color: #c0c0c0"><h2>Total</h2></td>
    <td style="text-align: center"><h2>' . $total_venta . '</h2></td>
    </tr>

</table>

<p style="text-align: right">
<b>Monto total: </b> ' . $total_venta . '
</p>
<p>
<b>monto literal: </b> ' . $total_venta . '

<br>
--------------------------------------------------------------------<br>
<b>USUARIO: </b> Marcelo Acosta Cortez.
';

// output the HTML content
$pdf->writeHTML($html, true, false, true,  false, '');

$style = array(
    'border' => 0,
    'vpdding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, //width of a single module in points
    'module_height' => 1 //height of a single module in points

);
$QR = 'Debes cancelar ' . $nombre_cliente . ' : ' . $total_venta . ' ';
$pdf->write2DBarcode($QR, 'QRCODE,L', 170, 220, 40, 40, $style);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
// Crear directorio si no existe
$dir = __DIR__ . '/../facturas/';

// Generar nombre del archivo
$fecha_actual = date('Y-m-d-H-i-s');
$nombre_pdf = 'factura_' . $fecha_actual . '.pdf';

// Ruta absoluta del archivo
$ruta_guardado = $dir . $nombre_pdf;

// Guardar PDF
try {
    // Guardar PDF
    $pdf->Output($ruta_guardado, 'F');

    // Preparar correo
    $to = $email_cli;
    $subject = " de Venta #" . $nro_pedido;

    // Obtener imagen del logo y codificarla
    $ruta_logo = __DIR__ . '/../parametros/imagen/' . $parametros['par_Logo'];
    $logo_binario = file_get_contents($ruta_logo);
    $logo_base64 = base64_encode($logo_binario);
    $tipo_imagen = pathinfo($ruta_logo, PATHINFO_EXTENSION);

    // Generar boundary único
    $boundary = md5(time());

    // Cabeceras
    $headers = "From: Sistema Ventas <no-reply@sistema.com>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/related; boundary=\"" . $boundary . "\"\r\n";

    // Parte 1: HTML
    // HTML Content
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
            <img src="cid:logo" alt="Logo de la Empresa" style="max-width:150px;">
            <h1>Pedido No.- ' . $nro_pedido . '</h1>
        </div>
        <div class="content">
            <p>Hola, ' . $nombre_cliente . '</p>
            <p>Adjunto encontrará su pedido correspondiente No.- ' . $nro_pedido . '.</p>
            <p>Si tiene alguna duda, no dude en contactarnos.</p>
            <div class="cta">
                <a href="cid:pedido" style="text-decoration: none; background-color: #0073e6; color: #ffffff; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Descargar Pedido PDF</a>
            </div>
            <p>Atentamente,<br>El equipo de ' . $nombre_empresa . '</p>
        </div>
        <div class="footer">
            <p>&copy; ' . date('Y') . ' ' . $nombre_empresa . '. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>' . "\r\n\r\n";

    // Parte 2: Imagen Logo
    $message_body .= "--" . $boundary . "\r\n";
    $message_body .= "Content-Type: image/" . $tipo_imagen . "; name=\"logo." . $tipo_imagen . "\"\r\n";
    $message_body .= "Content-Transfer-Encoding: base64\r\n";
    $message_body .= "Content-ID: <logo>\r\n";
    $message_body .= "Content-Disposition: inline; filename=\"logo." . $tipo_imagen . "\"\r\n\r\n";
    $message_body .= chunk_split($logo_base64) . "\r\n";

    // Parte 3: PDF
    $message_body .= "--" . $boundary . "\r\n";
    $message_body .= "Content-Type: application/pdf; name=\"" . $nombre_pdf . "\"\r\n";
    $message_body .= "Content-Transfer-Encoding: base64\r\n";
    $message_body .= "Content-ID: <pedido>\r\n";
    $message_body .= "Content-Disposition: attachment; filename=\"" . $nombre_pdf . "\"\r\n\r\n";
    $message_body .= chunk_split(base64_encode(file_get_contents($ruta_guardado))) . "\r\n";

    // Cerrar boundary
    $message_body .= "--" . $boundary . "--";

    // Enviar correo
    if (mail($to, $subject, $message_body, $headers)) {
        $_SESSION['mensaje'] = "Factura enviada correctamente";
        $pdf->Output($nombre_pdf, 'I');
    } else {
        throw new Exception("Error al enviar el correo");
    }
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    die("Error: " . $e->getMessage());
}

//============================================================+
// END OF FILE
//============================================================
