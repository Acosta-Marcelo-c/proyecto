<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/venta/listado_venta.php');

if (isset($_SESSION['mensaje'])) {
    $respuesta = $_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?php echo $respuesta; ?>',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
<?php
    unset($_SESSION['mensaje']);
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                        <a href="<?php echo $URL; ?>../../pedidos/create.php?pedido=0" class="nav-link" style="color: white">
                            <i class="fa fa-plus-circle"></i>
                            Realizar Pedido
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline cart-primary">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i> <b> REGISTRO DE COMPRAS</b></h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                <tr>
                                    <th>Nro</th>
                                    <th>Nro pedido</th>
                                    <th>Fecha Creacion</th>
                                    <th>Producto</th>
                                    <th>Cliente</th>
                                    <th>Total Pagado</th>
                                    <th>Acciones</th>
                                </tr>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($ventas_datos as $ventas_dato) {
                                        $id_ventas = $ventas_dato['id_Ventas'];
                                        $id_cliente = $ventas_dato['id_Cliente'];
                                        $cli_FechaCreacion = $ventas_dato['cli_FechaCreacion'];
                                        $no_pedido = $ventas_dato['ped_numero'];
                                        $contador = $contador + 1;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador; ?> </center>
                                            </td>
                                            <td>
                                                <center><?php echo $no_pedido; ?></center>
                                            </td>
                                            <td>
                                                <!--<center><?php echo $id_ventas; ?></center>-->
                                                <center><?php echo $cli_FechaCreacion; ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_producto<?php echo $id_ventas; ?>">
                                                        Producto
                                                    </button>
                                                    <!-- Modal producto-->
                                                    <div class="modal fade" id="Modal_producto<?php echo $id_ventas; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Producto de venta No.-<?php echo $ventas_dato['ped_numero']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">No.-</th>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">Producto</th>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">Detalle</th>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">Cantidad</th>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">Precio Unitario</th>
                                                                                    <th style="background-color: #e7e7e7;text-align: center">Precio Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $contador_listaPedido = 0;
                                                                                $cantidad_total = 0;
                                                                                $precio_uni_total = 0;
                                                                                $total_venta = 0;
                                                                                $nro_pedido = $ventas_dato['ped_numero'];
                                                                                $sql_pedido = "SELECT *, alm.id_Almacen as id_Almacen, ped.id_Perdido as id_pedido, alm.alm_Nombre as nombre_producto,
                                                                                    alm.alm_Descripcion as descripcion_producto,
                                                                                    ped.ped_Cantidad as ped_Cantidad,
                                                                                    alm.alm_PrecioVenta as alm_PrecioVenta,
                                                                                    alm.alm_Stock as alm_Stock
                                                                                    FROM pedido as ped INNER JOIN 
                                                                                    almacen as alm ON ped.id_Almacen = alm.id_Almacen
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
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $contador_listaPedido; ?>
                                                                                            <input type="text" id="id_almacen<?php echo $contador_listaPedido; ?>" value="<?php echo $id_almacen; ?>" hidden>
                                                                                        </td>
                                                                                        <td><?php echo $pedido_dato['nombre_producto']; ?></td>
                                                                                        <td><?php echo $pedido_dato['descripcion_producto']; ?></td>
                                                                                        <td>
                                                                                            <center><span id="cantidad_pedido<?php echo $contador_listaPedido; ?>"><?php echo $pedido_dato['ped_Cantidad']; ?></span></center>
                                                                                            <input type="text" id="stock_almacen<?php echo $contador_listaPedido; ?>" value="<?php echo $pedido_dato['alm_Stock']; ?>" hidden>
                                                                                        </td>
                                                                                        <td>
                                                                                            <center><?php echo $pedido_dato['alm_PrecioVenta']; ?></center>
                                                                                        </td>
                                                                                        <td>
                                                                                            <center>
                                                                                                <?php
                                                                                                $cantidad_Pro = floatval($pedido_dato['ped_Cantidad']);
                                                                                                $precio_venta = floatval($pedido_dato['alm_PrecioVenta']);
                                                                                                echo $subTotal = $cantidad_Pro * $precio_venta;
                                                                                                $total_venta = $total_venta + $subTotal;
                                                                                                ?>
                                                                                            </center>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <tr>
                                                                                    <th colspan="3" style="background-color: #e7e7e7;text-align: right">Total</th>
                                                                                    <th>
                                                                                        <center><?php echo $cantidad_total; ?></center>
                                                                                    </th>
                                                                                    <th>
                                                                                        <center><?php echo $precio_uni_total; ?></center>
                                                                                    </th>
                                                                                    <th style="text-align: center; background-color: #ffc61b">
                                                                                        <center><?php echo $total_venta; ?></center>
                                                                                    </th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_cliente<?php echo $id_ventas; ?>">
                                                        <?php echo $ventas_dato['nombre_cliente'] ?>
                                                    </button>
                                                    <!-- Modal Cliente -->
                                                    <div class="modal fade" id="Modal_cliente<?php echo $id_ventas; ?>">
                                                        <div class="modal-dialog modal-fade">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #1d36b6; color: white">
                                                                    <h4 class="modal-title">Cliente:</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">x</span>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                $sql_cliente = "SELECT * FROM cliente WHERE id_Cliente = '$id_cliente'";
                                                                $query_cliente = $pdo->prepare($sql_cliente);
                                                                $query_cliente->execute();
                                                                $cliente_datos = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($cliente_datos as $cliente_dato) {
                                                                    $nombre_cliente = $cliente_dato['cli_nombres'];
                                                                    $tipoDocumento_cliente = $cliente_dato['cli_Tipo_Documento'];
                                                                    $numeroDocumento_cliente = $cliente_dato['cli_NumeroDocumento'];
                                                                    $telefono_cliente = $cliente_dato['cli_Celular'];
                                                                    $email_cliente = $cliente_dato['cli_Email'];
                                                                    $direccion_cliente = $cliente_dato['cli_Direccion'];
                                                                }
                                                                ?>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="">Nombre del cliente</label>
                                                                        <input name="nombre_cliente" type="text" value="<?php echo $nombre_cliente; ?>" class="form-control" disabled>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Tipo de documento</label>
                                                                            <input name="tipo_Documento" value="<?php echo $tipoDocumento_cliente; ?>" type="text" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <label for="">Numero Documento</label>
                                                                            <input name="numero_documento_cliente" value="<?php echo $numeroDocumento_cliente; ?>" type="number" class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Telefono</label>
                                                                            <input name="telefono_cliente" value="<?php echo $telefono_cliente; ?>" type="number" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <label for="">Email</label>
                                                                            <input name="email_cliente" value="<?php echo $email_cliente; ?>" type="email" class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="">Direccion</label>
                                                                            <textarea name="direccion_cliente" rows="2" cols="30" class="form-control" disabled><?php echo $direccion_cliente; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-primary"><?php echo "$  " . $ventas_dato['cli_PagoTotal']; ?></button>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="show.php?no_pedido=<?php echo $no_pedido; ?>" class="btn btn-primary"><i class="fa fa-eye"></i>Ver</a>
                                                    <a href="delete.php?no_pedido=<?php echo $no_pedido; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Borrar</a>
                                                    <a href="factura.php?no_pedido=<?php echo $no_pedido; ?>&id_ventas=<?php echo $id_ventas; ?>&id_param=<?php echo $id_param; ?>&email_cli=<?php echo $email_cliente; ?>" class="btn btn-success"><i class="fa fa-print"></i>Imprimir</a>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>
</div><!-- /.container-fluid -->
<!-- /.content -->
<!-- /.content-wrapper -->
<?php
include('../layout/parte2.php');
?>