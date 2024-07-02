<?php
$no_get_pedido =$_GET['no_pedido'];
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controlador/almacen/listado_productos.php');
include('../app/controlador/pedidos/listado_pedidos.php');
include('../app/controlador/cliente/listado_cliente.php');
include('../app/controlador/venta/cargar_venta.php');
include('../app/controlador/cliente/cargar_cliente.php');

include ('../app/config.php');
if (isset($_SESSION['mensaje'])) {
    $respuesta=$_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '<?php  echo $respuesta;?>',
            showConfirmButton: false,
            timer:2000

        })

    </script>

    <?php
    unset($_SESSION['mensaje']);
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminacion de Ventas No.- <?php echo $nro_venta;?></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <div class="content">
<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i>  Venta No.-
                                <input  type="text" id="nro_venta" style="text-align: center" value="<?php echo $nro_venta;?>" disabled></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class ="table-responsive">
                            <table class="table table-bordered table-sm table">
                                <thead>
                                <tr>
                                    <th style="background-color: #e7e7e7;text-alig: center">No.-</th>
                                    <th style="background-color: #e7e7e7;text-alig: center">Producto</th>
                                    <th style="background-color: #e7e7e7;text-alig: center">Detalle</th>
                                    <th style="background-color: #e7e7e7;text-alig: center">Cantidad</th>
                                    <th style="background-color: #e7e7e7;text-alig: center">Precio Unitario</th>
                                    <th style="background-color: #e7e7e7;text-alig: center">Precio Total</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_listaPedido= 0;
                                $cantidad_total=0;
                                $precio_uni_total =0;
                                $total_venta= 0;
                                $nro_pedido= $ventas_dato['ped_numero'];
                                $sql_pedido = "SELECT *, alm.id_Almacen as id_Almacen, ped.id_Perdido as id_pedido, alm.alm_Nombre as nombre_producto,
                                                                                alm.alm_Descripcion as descripcion_producto,
                                                                                ped.ped_Cantidad as ped_Cantidad,
                                                                                alm.alm_PrecioVenta as alm_PrecioVenta,
                                                                                alm.alm_Stock as alm_Stock
                                                                                FROM pedido as ped INNER JOIN 
                                                                                almacen as alm   ON ped.id_Almacen = alm.id_Almacen
                                                                                WHERE ped_numero = $nro_pedido";
                                $query_pedido = $pdo->prepare($sql_pedido);
                                $query_pedido->execute();
                                $pedido_datos=$query_pedido->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($pedido_datos as $pedido_dato){
                                    $contador_listaPedido= $contador_listaPedido+1;
                                    $id_almacen =$pedido_dato['id_Almacen'];
                                    $id_pedido= $pedido_dato['id_pedido'];
                                    $cantidad_total= $cantidad_total+$pedido_dato['ped_Cantidad'];
                                    $precio_uni_total= $precio_uni_total+$pedido_dato['alm_PrecioVenta'];

                                    ?>
                                    <tr>
                                        <td> <?php echo $contador_listaPedido;?>
                                            <input type="text"  id="id_almacen<?php echo $contador_listaPedido;?>" value="<?php echo $id_almacen;?>">
                                        </td>
                                        <td> <?php echo $pedido_dato['nombre_producto'];?></td>
                                        <td> <?php echo $pedido_dato['descripcion_producto'];?></td>
                                        <td><center><span id="cantidad_pedido<?php echo $contador_listaPedido;?>"><?php echo $pedido_dato['ped_Cantidad'];?></span></center>
                                            <input type="text"  id="stock_almacen<?php echo $contador_listaPedido;?>" value="<?php echo $pedido_dato['alm_Stock'];?>" >
                                        </td>
                                        <td><center><?php echo $pedido_dato['alm_PrecioVenta'];?></center> </td>
                                        <td><center>
                                                <?php
                                                $cantidad_Pro= floatval($pedido_dato['ped_Cantidad']);
                                                $precio_venta= floatval($pedido_dato['alm_PrecioVenta']);
                                                echo $subTotal = $cantidad_Pro * $precio_venta;
                                                $total_venta= $total_venta+$subTotal;
                                                ?>
                                            </center> </td>
                                    </tr>

                                    <?php
                                }
                                ?>
                                <tr>
                                    <th colspan="3" style="background-color: #e7e7e7;text-align: right">Total</th>
                                    <th><center><?php echo $cantidad_total;?></center></th>
                                    <th><center><?php echo $precio_uni_total;?></center></th>
                                    <th style="text-align: center; background-color: #ffc61b"><center><?php echo $total_venta;?></center></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card  card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user-check"></i>  Datos del cliente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <br>
                            <?php
                            foreach ($cliente_datos as $cliente_dato){

                                $nombre_cliente = $cliente_dato['cli_nombres'];
                                $tipo_documento = $cliente_dato['cli_Tipo_Documento'];
                                $documento_nume = $cliente_dato['cli_NumeroDocumento'];
                                $telefono=$cliente_dato['cli_Celular'];
                                $email=$cliente_dato['cli_Email'];
                                $direccion=$cliente_dato['cli_Direccion'];
                            }
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label  for="">Nombre</label>
                                            <input type="text" value="<?php echo $nombre_cliente;?>" class="form-control" id="nombre_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="">Documento</label>
                                            <input type="text" value="<?php echo $tipo_documento;?>" class="form-control" id="tipo_documento" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label  for="">No.- Documento</label>
                                            <input type="text" value="<?php echo $documento_nume;?>" class="form-control" id="numero_documento" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label  for="">Telefono</label>
                                            <input type="text"  value="<?php echo $telefono;?>" class="form-control" id="celular_cliente" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  for="">Direccion:</label>
                                            <input type="text" value="<?php echo $direccion;?>" class="form-control" id="direccion_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  for="">Email:</label>
                                            <input type="text" value="<?php echo $email;?>" class="form-control" id="email_cliente" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-shopping-basket"></i>Monto a cancelar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Monto a cancelar</label>
                                    <input type="number" class="form-control" style="text-align: center; background-color: #ffc61b" value="<?php echo $total_venta;?>" disabled>
                                </div>
                                <div class="form-group">
                                    <button  id="btn_borrar_venta" class="btn btn-danger btn-block"> Borrar venta</button>
                                   <div id="btn_borrar-venta">
                                </div>
                                    <script>
                                        $('#btn_borrar_venta').click(function (){
                                            var nro_pedido ='<?php echo $no_get_pedido;?>';
                                             // alert(nro_pedido);
                                            var id_venta ='<?php echo $nro_venta;?>';
                                             // alert(nro_venta);
                                            actualizar_stock();
                                            borrar_venta();
                                            function actualizar_stock(){
                                                var i = 1;
                                                var n = '<?php echo $contador_listaPedido?>';
                                                for (i=1; i<=n; i++){
                                                   var a ='#stock_almacen'+i;
                                                   var stock_almacen =$(a).val();

                                                   var b='#cantidad_pedido'+i;
                                                   var stock_pedido=$(b).html();

                                                   var c ='#id_almacen'+i;
                                                   var id_almacen =$(c).val();

                                                   var stock_calculado= parseFloat(parseFloat(stock_almacen)+parseFloat(stock_pedido));
                                                   alert(id_almacen+"; stock almacen "+stock_almacen+" stock pedido;"+stock_pedido+" stock calculado; "+stock_calculado);

                                                   var ur12="../app/controlador/venta/actualizar_stock.php";
                                                   $.get(ur12,{id_almacen:id_almacen, stock_calculado:stock_calculado}, function(datos){

                                                   });
                                                }
                                            }
                                            function borrar_venta(){

                                            var url15="../app/controlador/venta/delete_venta.php";
                                            $.get(url15,{nro_pedido:nro_pedido, id_venta:id_venta}, function (datos){
                                                $('#btn_borrar_venta').html(datos);
                                            });
                                            }
                                        });
                            </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!--Modal para ingresar nuevos clientes-->





    <!-- /.container-fluid -->

    <!-- /.content -->

    <!-- /.content-wrapper -->


    <?php
    include('../layout/parte2.php');
    ?>
