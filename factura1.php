<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
include('../app/TCPDF-main/tcpdf.php');
include('../app/pdoconfig.php');
include('../app/config.php');

$id_param = $_GET['id_param'];
$nro_pedido = $_GET['no_pedido'];
$id_ventas = $_GET['id_ventas'];

try {
    $sentencia = $pdo->prepare("SELECT * FROM parametro WHERE id_Param = :id_param");
    $sentencia->bindParam(':id_param', $id_param);
    $sentencia->execute();
    $parametros = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Ahora puedes usar $parametros para acceder a los datos
    $nombre_empresa = $parametros['par_Nom_Empre'];
    $logo = $parametros['par_Logo'];
    $ruc = $parametros['par_Ruc'];
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



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sisitema O.G.L.');
$pdf->setTitle('Factura de Venta');
$pdf->setSubject('Factura de Venta');
$pdf->setKeywords('Factura de Venta');

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
<table >
<tr>
    <td style="text-align: center"><img src="../almacen/img_productos/2024-01-26-01-14-02__conty1.jpeg" width="80px"></td>
    <td></td>
    <td style="text-align: center"></td>
</tr>
<tr>
    <td style="text-align: center"><h1>Sistema de Ventas O.L.G.</h1></td>
    <td></td>
    <td style="text-align: center"><h2>Ruc: 1713200580001</h2></td>
</tr>
<tr>
    <td style="text-align: center"><h2>Luis Marcelo Acosta cortez</h2></td>
    <td></td>
    <td style="text-align: center"><h1>Factura</h1></td>
</tr>
<tr>
    <td ></td>
    <td></td>
    <td style="text-align: center"><h2> No.-' . $fecha . '  </h2></td>
</tr>
<tr>
    <td style="text-align: center">Direccion: Comite de Pueblo Antonio Favara y Ramon Jimenez #171</td>
    <td></td>
    <td style="text-align: center"><h3>AUT.SRI: 1234567890</h3></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td  style="text-align: center">Fecha Autorización: 02-02-2014</td>
</tr>
</table>
<hr>
<p style="text-align: center; font-size: 25px">FACTURA</p>

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
foreach ($pedido_datos as $pedido_dato) {
    $contador_listaPedido = $contador_listaPedido + 1;
    $id_almacen = $pedido_dato['id_Almacen'];
    $id_pedido = $pedido_dato['id_pedido'];
    $cantidad_total = $cantidad_total + $pedido_dato['ped_Cantidad'];
    $precio_uni_total = $precio_uni_total + $pedido_dato['alm_PrecioVenta'];
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
<b>monto literal: </b> cuatrocientos 

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
$QR = 'Emily Acosta debes pagar: ' . $total_venta . ' ';
$pdf->write2DBarcode($QR, 'QRCODE,L', 170, 220, 40, 40, $style);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
