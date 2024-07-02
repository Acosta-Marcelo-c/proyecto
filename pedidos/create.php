<?php
global $ventas_datos;
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controlador/almacen/listado_productos.php');
include('../app/controlador/pedidos/listado_pedidos.php');
include('../app/controlador/cliente/listado_cliente.php');
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
              <h1 class="m-0">PEDIDOS</h1>
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
                      <div class="card  card-outline card-primary">
                        <div class="card-header">
                            <?php
                            $num_ped=0;
                            $num_ped=$_GET['pedido'];

                            if($max==0 && $num_ped==0){
                                $contadorPedido = 1;
                            }else if($max == $num_ped) {
                            $contadorPedido= $max;
                            }else if($num_ped==0){
                                $contadorPedido = $max+1;
                            }
                            ?>
                          <h3 class="card-title"><i class="fa fa-shopping-bag"></i>  Pedidos No.-
                            <input  type="text" style="text-align: center" value="<?php echo  $contadorPedido;?>" disabled>contador</h3>
                            <input  type="text" style="text-align: center" value="<?php echo  $num_ped;?>" >nume</h3>
                            <input  type="text" style="text-align: center" value="<?php echo  $max;?>" >maxi</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                      </div>
                          <div class="card-body">
                            <b>Pedido</b>

                              <button type="button" class="btn btn-primary" data-toggle="modal"
                                      data-target="#modal-buscar_produto">
                                  <i class="fa fa-search"></i>
                                  Buscar Producto
                              </button>
                              <!--/ modal para mostrar producto -->
                              <div class="modal fade" id="modal-buscar_produto">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header" style="background-color: #1d36b6; color: white" >
                                              <h4 class="modal-title">Busqueda del Producto: </h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">x</span>
                                              </button>
                                          </div>
                                          <div class="modal-body ">
                                              <div class="table table-responsive">
                                                  <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                                      <tr>
                                                          <th>Nro</th>
                                                          <th>Codigo</th>
                                                          <th>Seleccionar</th>
                                                          <th>Categoria</th>
                                                          <th>Imagen</th>
                                                          <th>Nombre</th>
                                                          <th>Descripcion</th>
                                                          <th>Stock</th>
                                                          <th>Precio Venta</th>
                                                          <th>Fecha Ingreso</th>
                                                          <!--<th>Usuario</th>-->
                                                      </tr>
                                                      <tbody>
                                                      <?php
                                                      $contador = 0;
                                                      foreach ($producto_datos as $producto_dato) {
                                                          $id_Almacen = $producto_dato['id_Almacen'];
                                                                       ?>
                                                          <tr>
                                                              <td> <?php echo $contador= $contador+1;?></td>
                                                              <td> <?php echo $producto_dato['alm_Codigo'];?></td>
                                                              <td>
                                                                  <button class="btn btn-info" id="btn_seleccionar<?php echo $id_Almacen;?>">
                                                                      Seleccionar
                                                                  </button>
                                                                  <script>
                                                                      $('#btn_seleccionar<?php echo $id_Almacen;?>').click(function(){

                                                                          var id_Almacen ="<?php echo $id_Almacen;?>";
                                                                          $('#id_almacen').val(id_Almacen);
                                                                          var nombre ="<?php echo $producto_dato['alm_Nombre'];?>";
                                                                          $('#producto').val(nombre);
                                                                          var descripcion ="<?php echo $producto_dato['alm_Descripcion'];?>";
                                                                          $('#descripcion').val(descripcion);
                                                                          var precio_venta ="<?php echo $producto_dato['alm_PrecioVenta'];?>";
                                                                          $('#precio_venta').val(precio_venta);
                                                                          $('#cantidad').focus();
                                                                      });
                                                                  </script>
                                                              </td>
                                                              <td> <?php echo $producto_dato['cat_Nombre'];?></td>
                                                              <td>
                                                                  <img src="<?php echo  "../almacen/img_productos/".$producto_dato['alm_Imagen']?>" width="50px" alt="asdf" />
                                                              </td>
                                                              <td> <?php echo $producto_dato['alm_Nombre'];?></td>
                                                              <td> <?php echo $producto_dato['alm_Descripcion'];?></td>
                                                              <td> <?php echo $producto_dato['alm_Stock'];?></td>
                                                              <td> <?php echo $producto_dato['alm_PrecioVenta'];?></td>
                                                              <td> <?php echo $producto_dato['alm_FechaIngreso'];?></td>
                                                              <!--<td> <?php echo $producto_dato['per_Correo'];?></td>-->
                                                          </tr>
                                                          <?php
                                                      }
                                                      ?>
                                                      </tbody>
                                                  </table>
                                                  <div class="row">
                                                          <div class="col-md-3">
                                                              <div class="form-group"></div>
                                                              <input type="text" id="id_almacen" class="form-control" hidden>
                                                              <label for="">Producto</label>
                                                              <input type="text" id="producto" class="form-control" disabled>
                                                          </div>
                                                          <div class="col-md-5">
                                                              <div class="form-group"></div>
                                                              <label for="">Descripcion</label>
                                                              <input type="text" id="descripcion" class="form-control" disabled>
                                                          </div>
                                                          <div class="col-md-2">
                                                              <div class="form-group"></div>
                                                              <label for="">Cantidad</label>
                                                              <input type="number" id="cantidad" class="form-control">
                                                          </div>
                                                          <div class="col-md-2">
                                                              <div class="form-group"></div>
                                                              <label for="">Precio Untario</label>
                                                              <input type="text"  id="precio_venta" class="form-control" disabled>
                                                          </div>
                                                  </div>
                                                  <br>
                                                  <button class="btn btn-info"  id="registro_venta" style="float: right">Registrar</button>
                                                        <div id="respuesta_pedido"></divid>
                                                  <script>
                                                            $('#registro_venta').click(function (){

                                                                var id_pedido ='<?php echo $contadorPedido;?>';
                                                                var id_producto =$('#id_almacen').val();
                                                                var cantidad =$('#cantidad').val();

                                                                if (id_producto==""){
                                                                         alert("debe llenar los campos");
                                                                }else if(cantidad==""){
                                                                    alert("debe llenar la cantidad del producto");
                                                                }else{
                                                                    //alert("listo para el control");
                                                                    var url="../app/controlador/pedidos/create_pedidos.php";
                                                                    $.get(url,{
                                                                        id_pedido:id_pedido,
                                                                        id_producto:id_producto,
                                                                        cantidad:cantidad
                                                                    },function (datos) {
                                                                        $('#respuesta_pedido').html(datos);
                                                                    });

                                                                }

                                                            });
                                                        </script>
                                                  <br><br>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
                          </div>
                    </div>
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
                                      <th style="background-color: #e7e7e7;text-alig: center">Accion</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                        <?php
                                        $contador_listaPedido= 0;
                                        $cantidad_total=0;
                                        $precio_uni_total =0;
                                        $total_venta= 0;
                                        $sql_pedido = "SELECT *, alm.id_Almacen as id_Almacen, ped.id_Perdido as id_pedido, alm.alm_Nombre as nombre_producto,
                                        alm.alm_Descripcion as descripcion_producto,
                                        ped.ped_Cantidad as ped_Cantidad,
                                        alm.alm_PrecioVenta as alm_PrecioVenta,
                                        alm.alm_Stock as alm_Stock
                                        FROM pedido as ped INNER JOIN 
                                        almacen as alm   ON ped.id_Almacen = alm.id_Almacen
                                        WHERE ped_numero = $contadorPedido";
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
                                                    <input type="text"  id="id_almacen<?php echo $contador_listaPedido;?>" value="<?php echo $id_almacen;?>" hidden>
                                                </td>
                                                <td> <?php echo $pedido_dato['nombre_producto'];?></td>
                                                <td> <?php echo $pedido_dato['descripcion_producto'];?></td>
                                                <td><center><span id="cantidad_pedido<?php echo $contador_listaPedido;?>"><?php echo $pedido_dato['ped_Cantidad'];?></span></center>
                                                    <input type="text"  id="stock_almacen<?php echo $contador_listaPedido;?>" value="<?php echo $pedido_dato['alm_Stock'];?>" hidden >
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
                                                <td><center>
                                                        <form action="../app/controlador/pedidos/delete_pedido.php" method="post">
                                                            <input type="text"  name="id_pedido" value="<?php echo $id_pedido;?>" hidden>
                                                            <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</button>
                                                        </form>
                                                    </center></td>
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
             <div class="row">
                   <div class="col-md-9">
                       <div class="card  card-outline card-primary">
                           <div class="card-header">
                                 <h3 class="card-title"><i class="fa fa-user-check"></i>  Datos del cliente</h3>
                                   <div class="card-tools">
                                       <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                         <i class="fas fa-minus"></i>
                                       </button>
                                   </div>
                           </div>
                             <div class="card-body">
                                 <b> Cliente</b>
                                 <button type="button" class="btn btn-primary" data-toggle="modal"
                                         data-target="#modal-buscar_cliente">
                                     <i class="fa fa-search"></i>
                                     Buscar Cliente
                                 </button>
                                 <!--/ modal para mostrar cliente -->
                                 <div class="modal fade" id="modal-buscar_cliente">
                                     <div class="modal-dialog modal-xl">
                                         <div class="modal-content">
                                             <div class="modal-header" style="background-color: #1d36b6; color: white" >
                                                 <h4 class="modal-title">Busqueda del Cliente:</h4>
                                                 <div style="width: 10px"></div>
                                                 <button type="button" class="btn btn-warning" data-toggle="modal"
                                                         data-target="#modal_agregar_cliente">
                                                     <i class="fa fa-users"></i>
                                                     Nuevo cliente
                                                 </button>
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                     <span aria-hidden="true">x</span>
                                                 </button>

                                             </div>
                                             <div class="modal-body ">
                                                 <div class="table table-responsive">
                                                     <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                                         <tr>
                                                             <th>Nro</th>
                                                             <th>Seleccionar</th>
                                                             <th>Nombre del Cliente</th>
                                                             <th>Tipo de Documento</th>
                                                             <th>Numero de Documento</th>
                                                             <th>Email</th>
                                                             <th>Direcccion</th>
                                                             <th>Celular</th>
                                                         </tr>
                                                         <tbody>
                                                         <?php
                                                         $contador = 0;
                                                         foreach ($cliente_datos as $cliente_dato) {
                                                             $id_cliente = $cliente_dato['id_Cliente'];
                                                             ?>
                                                             <tr>
                                                                 <td> <?php echo $contador= $contador+1;?></td>
                                                                 <td>
                                                                     <button class="btn btn-info" id="btn_selec_cli<?php echo $id_cliente;?>">
                                                                         Seleccionar
                                                                     </button>
                                                                     <script>
                                                                         $('#btn_selec_cli<?php echo $id_cliente;?>').click(function(){

                                                                             var id_cliente ="<?php echo $id_cliente;?>";
                                                                             $('#id_cliente').val(id_cliente);
                                                                             var nombre_cliente ="<?php echo $cliente_dato['cli_nombres'];?>";
                                                                             $('#nombre_cliente').val(nombre_cliente);
                                                                             var TipoDocumento ="<?php echo $cliente_dato['cli_Tipo_Documento'];?>";
                                                                             $('#tipo_documento').val(TipoDocumento);
                                                                             var NumeroDocumento ="<?php echo $cliente_dato['cli_NumeroDocumento'];?>";
                                                                             $('#numero_documento').val(NumeroDocumento);
                                                                             var Email ="<?php echo $cliente_dato['cli_Email'];?>";
                                                                             $('#email_cliente').val(Email);
                                                                             var direccion_cliente ="<?php echo $cliente_dato['cli_Direccion'];?>";
                                                                             $('#direccion_cliente').val(direccion_cliente);
                                                                             var celular_cliente ="<?php echo $cliente_dato['cli_Celular'];?>";
                                                                             $('#celular_cliente').val(celular_cliente);

                                                                             $('#modal-buscar_cliente').modal('toggle');
                                                                         });
                                                                     </script>
                                                                 </td>
                                                                 <td> <?php echo $cliente_dato['cli_nombres'];?></td>
                                                                 <td><?php echo $cliente_dato['cli_Tipo_Documento'];?></td>
                                                                 <td> <?php echo $cliente_dato['cli_NumeroDocumento'];?></td>
                                                                 <td> <?php echo $cliente_dato['cli_Email'];?></td>
                                                                 <td> <?php echo $cliente_dato['cli_Direccion'];?></td>
                                                                 <td> <?php echo $cliente_dato['cli_Celular'];?></td>
                                                                 </tr>
                                                             <?php
                                                         }
                                                         ?>
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
                                         </div>
                                             <!-- /.modal-content -->
                                     </div>
                                         <!-- /.modal-dialog -->
                                 </div><!-- /.modal -->
                             </div>
                                <br>
                                     <div class="row">
                                             <div class="col-md-4">
                                                 <div class="form-group">
                                                     <label  for="">Nombre</label>
                                                     <input type="text" class="form-control" id="nombre_cliente">
                                                 </div>
                                             </div>
                                             <div class="col-md-2">
                                                 <div class="form-group">
                                                     <label  for="">Documento</label>
                                                     <input type="text" class="form-control" id="id_cliente" hidden>
                                                     <input type="text" class="form-control" id="tipo_documento">
                                                 </div>
                                             </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label  for="">No.- Documento</label>
                                                 <input type="text" class="form-control" id="numero_documento">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label  for="">Telefono</label>
                                                 <input type="text" class="form-control" id="celular_cliente">
                                             </div>
                                         </div>
                                     </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label  for="">Direccion:</label>
                                       <input type="text" class="form-control" id="direccion_cliente">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label  for="">Email:</label>
                                       <input type="text" class="form-control" id="email_cliente">
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                 <div class="col-md-3">
                     <div class="card  card-outline card-primary">
                         <div class="card-header">
                             <h3 class="card-title"><i class="fa fa-shopping-basket"></i>   Registrar venta</h3>
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
                         </div>
                         <hr>
                         <div class="form-group" style="text-align: center">
                             <button  id="btn_guardar_venta" class="btn btn-primary">Guardar Venta</button>
                             <div id="respuesta_venta"></div>
                             <script>
                                 $('#btn_guardar_venta').click(function (){
                                     var  nro_pedido = '<?php echo $contadorPedido;?>';
                                     var  id_cliente = $('#id_cliente').val();
                                     var  total_venta = '<?php echo $total_venta;?>';
                                     //alert(total_venta);
                                     if (id_cliente==""){
                                         alert("Debe llenar los datos del cliente");

                                     }else{
                                         stock_actualizar();
                                         guardar_venta();
                                     }

                                     function stock_actualizar(){
                                         var i =1;
                                         var n = '<?php echo $contador_listaPedido;?>'

                                       for ( i =1; i<=n ; i++){
                                        var a = '#stock_almacen'+i;
                                        var stock_inventario = $(a).val();

                                        var b ='#cantidad_pedido'+i;
                                        var cantidad_pedido = $(b).html();
                                        var stock_calculado = parseFloat(stock_inventario-cantidad_pedido);

                                        var c='#id_almacen'+i;
                                        var id_almacen = $(c).val();

                                        //alert(stock_inventario + " - " + cantidad_pedido + " = " + stock_calculado + " id " + id_almacen  );

                                           var url4="../app/controlador/venta/actualizar_stock.php";
                                            $.get(url4,{
                                                id_almacen:id_almacen,
                                                stock_calculado:stock_calculado
                                            },function (datos) {
                                            // $('#respuesta_stock_actualizado').html(datos);

                                             });
                                       }
                                     }
                                     function guardar_venta(){
                                         var url5="../app/controlador/venta/create_venta.php";
                                         $.get(url5,{
                                             nro_pedido:nro_pedido,
                                             id_cliente:id_cliente,
                                             total_venta:total_venta
                                         },function (datos) {
                                             $('#respuesta_venta').html(datos);
                                         });
                                     }
                                 });
                             </script>
                         </div>
                     </div>
             </div>
        </div>
    </div>
        <!--Modal para ingresar nuevos clientes-->
        <div class="modal fade" id="modal_agregar_cliente">
            <div class="modal-dialog modal-fade">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1d36b6; color: white" >
                        <h4 class="modal-title">Busqueda del Cliente:</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>

                    </div>
                    <div class="modal-body ">
                        <form action="../app/controlador/cliente/create_cliente.php" method="post">
                            <div class="form-group">
                                <label for="">Nombre del cliente</label>
                                <input name="id_pedidos" value="<?php echo $contadorPedido;?>" type="text" class="form-control" hidden="">
                                <input name="nombre_cliente" type="text" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tipo de documento</label>
                                    <select name="tipo_documento_cliente" class="form-control">
                                        <option value="ruc">RUC.</option>
                                        <option value="cedula">Cedula</option>
                                        <option value="pasaporte">Pasaporte</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Numero Documento</label>
                                    <input name="numero_documento_cliente" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Telefono</label>
                                    <input name="telefono_cliente" type="number" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label for="">Email</label>
                                    <input name="email_cliente" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Direccion</label>
                                    <textarea name="direccion_cliente" rows="2" cols="30" class="form-control" ></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block"> Guardar Cliente </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div><!-- /.modal -->




<!-- /.container-fluid -->

  <!-- /.content -->

<!-- /.content-wrapper -->


<?php
include('../layout/parte2.php');
 ?>
