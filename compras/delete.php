<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/almacen/listado_productos.php');
include ('../app/controlador/proveedores/listado_proveedores.php');
include ('../app/controlador/compras/cargar_compras.php');

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
              <h1 class="m-0">Compra No.- <?php echo $show_nro_compra;?>   realizada por: <?php echo $show_persona; ?>  </h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->



  <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

          <div class="row">
              <div class="col-md-9">
                <div class="col-md-12">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">Eliminacion de compra</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                     </div>

                     <div class="row" style="font-size: 12px">
                           <div class="col-md-9">
                             <div class="row">

                               <div class="col-md-4">
                                 <div class="form-group">
                                   <input type="text" id="id_producto" value="<?php echo $show_id_Almacen ?>" hidden>
                                   <label for="">Codigo:</label>
                                   <input type="text" class="form-control" value="<?php echo $show_codigo;?>"id="codigo"  disabled>
                                 </div>
                               </div>

                               <div class="col-md-4">
                                 <div class="form-group">
                                   <label for="">Categoria del producto:</label>
                                   <div  style="display: flex">
                                       <input type="text" class="form-control"  value="<?php echo $show_categoria;?>"id="categoria"  disabled>
                                   </div>
                                 </div>
                               </div>

                               <div class="col-md-4">
                                 <div class="form-group">
                                   <label for="">Nombre del producto:</label>
                                   <input type="text" class="form-control" name="nombre"  value="<?php echo $show_nombreProdu;?>"id="nombre_producto" disabled>
                                 </div>
                               </div>


                             </div>
                             <div class="row">
                               <div class="col-md-4">
                                 <div class="form-group">
                                   <label for="">Usuario</label>
                                   <input type="text" class="form-control"  value="<?php echo $show_persona; ?>" id="usuario_producto"  disabled>

                                 </div>

                               </div>

                             <div class="col-md-8">
                               <div class="form-group">
                                 <label for="">Descripcion del producto:</label>
                                 <textarea name="descripcion" id="descripcion_producto" rows="2" cols="30" class="form-control" disabled><?php echo $show_descripcion;?></textarea>
                               </div>
                             </div>
                             </div>

                             <div class="row">
                               <div class="col-md-2">
                                 <div class="form-group">
                                   <label for="">Stock:</label>
                                   <input type="number" name="stock" value="<?php echo $show_stock;?>" class="form-control" placeholder="" id="stock" style="background-color: #fff819" disabled>
                                 </div>
                               </div>
                               <div class="col-md-2">
                                 <div class="form-group">
                                   <label for="">Stock Min:</label>
                                   <input type="number" name="stock_minimo" value="<?php echo $show_StockMinimo;?>"class="form-control" id="stock_minimo" disabled>
                                 </div>
                               </div>
                               <div class="col-md-2">
                                 <div class="form-group">
                                   <label for="">Stock Max:</label>
                                   <input type="number" name="stock_maximo" value="<?php echo $show_StokMaximo;?>" class="form-control" id="stock_maximo" disabled>
                                 </div>
                               </div>
                             <div class="col-md-2">
                               <div class="form-group">
                                 <label for="">Precio Com:</label>
                                 <input type="number" name="precio_compra" value="<?php echo $show_precioCompra; ?>"class="form-control" id="precio_compra" disabled>
                               </div>
                             </div>
                             <div class="col-md-2">
                               <div class="form-group">
                                 <label for="">Precio Ven:</label>
                                 <input type="number" name="precio_venta"  value="<?php echo $show_precioVenta; ?>" class="form-control" id="precio_venta" disabled>
                               </div>
                             </div>
                             <div class="col-md-2">
                               <div class="form-group">
                                 <label for="">Fecha Ingreso:</label>
                                 <input type="date" name="fecha_ingreso"  value="<?php echo $show_fechaAlm;?>"class="form-control" id="fecha_ingreso" disabled>
                               </div>
                             </div>
                           </div>
                           </div>
                           <div class="col-md-3">
                             <div class="form-group">
                               <label for="">Imagen del producto</label>
                               <center>
                                 <img src=" <?php echo  "../almacen/img_productos/".$show_imagen?>"  id="imagen_producto" width="50%" alt="">
                               </center>
                           </div>
                           </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                              data-target="#modal-buscar_produto">
                              Proveedor
                    </button>
                    <div class="container-fluid" style="font-size: 12px">
                          <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text"  id="id_provee" hidden>
                                  <label for="">Nombre Proveedor:</label>
                                  <input type="text" class="form-control"  value="<?php echo $show_nomProveedor; ?>"id="nombre_pro"  disabled>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Celular:</label>
                                  <div  style="display: flex">
                                      <input type="text" class="form-control"  value="<?php echo $show_celProveedor; ?>"id="celular_pro"  disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Telefono:</label>
                                  <input type="text" class="form-control" name="nombre" value="<?php echo $show_tefProveedor; ?>" id="telefono_pro" disabled>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">RUC:</label>
                                  <input type="text" class="form-control" value="<?php echo $show_rucProveedor; ?>"id="ruc_pro"  disabled>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">email:</label>
                                  <input type="text" class="form-control"value="<?php echo $show_emailProveedor; ?>" id="email_pro"  disabled>
                                </div>
                              </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Direccion:</label>
                                <textarea name="descripcion"  id="direccion_pro" rows="2" cols="30" class="form-control" disabled><?php echo $show_direccionProveedor ?></textarea>
                              </div>
                            </div>
                            </div>
                        <hr />
                        <div class="form-group">
                          <a href="index.php" class="btn btn-secondary">Cancelar</a>

                        </div>
                   </div>

                  </div>
                </div>

                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-danger">
                          <div class="card-header">
                            <h3 class="card-title">datos</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">numero de compra</label>
                                  <input type="text"  value="<?php echo $show_nro_compra;?>"class="form-control" style="text-align: center" disabled>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">fecha de compra</label>
                                  <input type="date" class="form-control"  value="<?php echo $show_fecha; ?>"id="fecha_compra" disabled>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Comprovante de compra</label>
                                  <input type="text" value="<?php echo $show_comprobante; ?>" class="form-control" id="comprovante" disabled>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">precio compra</label>
                                  <input type="number" value="<?php echo $show_precioCompra ?>"class="form-control" id="precio_com" disabled>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Stock Actual</label>
                                  <input type="text" id="stock_total" style="text-align: center" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Stock Nuevo</label>
                                  <input type="text"  id="stock_anterior" value="<?php echo ($show_stock - $show_cantidadCompra); ?>" class="form-control"  disabled>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Cantidad de compra</label>
                                  <input type="number" id="cantidad_compra" value="<?php echo $show_cantidadCompra; ?>" style="text-align: center" class="form-control" disabled>
                                </div>
                                <script>
                                    $('#cantidad_compra').keyup(function(){
                                      //alert('holas');
                                      sumacantidades();
                                    });
                                    sumacantidades();
                                    function sumacantidades(){
                                      var stock_anterior =$('#stock_anterior').val();
                                      var stock_compra =$('#cantidad_compra').val();

                                      var total =  parseInt(stock_anterior) + parseInt(stock_compra);
                                      $('#stock_total').val(total);
                                    }
                                </script>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Usuario</label>
                                  <input type="text" value="<?php echo $email_session ?>" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-danger btn-block" id="btn_eliminar"><i class="fa fa-trash"></i>Eliminar</button>
                                </div>
                            </div>
                            <div id="respuesta_delete">

                            </div>
                            <script>
                              $('#btn_eliminar').click(function(){
                                var id_compra ='<?php echo $id_compra;?>';
                                var id_almacen=$('#id_producto').val();
                                var stock_Total=$('#stock_anterior').val();

                              //  Swal.fire({
                              //    title:'Eliminacion de compra',
                              //    icon:'question',
                              //    showCancelButton:true,
                              //    confirmButtonColor:'#3085d6',
                              //    cancelButtonColor:'#d33',
                              //    confrmButtonText:'Eliminar'
                              //  }).then((result)=>{
                              //    if(result.isConfirmed){
                              //      Swal.fire(
                              //        eliminar(),
                              //        'Compra eliminada',
                              //        'succes'
                              //      )
                              //    }
                              //  });
                              //  function eliminar(){
                                  var url="../app/controlador/compras/delete_compras.php";
                                  $.get(url,{id_compra:id_compra,id_almacen:id_almacen,
                                    stock_Total:stock_Total},function(datos){
                                    $('#respuesta_delete').html(datos);
                                  });
                                //}
                              });

                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="respuesta_create">

              </div>
          </div>

        </div>





<!-- /.container-fluid -->

  <!-- /.content -->

<!-- /.content-wrapper -->


<?php
include ('../layout/parte2.php');
 ?>
