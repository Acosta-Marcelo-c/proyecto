<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/compras/listado_compras.php');

if (isset($_SESSION['mensaje'])) {
  $respuesta=$_SESSION['mensaje']; ?>
  <script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: '<?php  echo $respuesta;?>',
    showConfirmButton: false,
    timer:2000
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
          <h1 class="m-0">Listado de Compras</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline cart-primary">
            <div class="card-header" >
              <h3 class="card-title" >Compras Regitrados</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                  <tr>
                    <th>Nro</th>
                    <th>Compra</th>
                    <th>Produto</th>
                    <th>Fecha compra</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <!--<th>Usuario</th>-->
                    <th>precio Compra</th>
                    <th>Cantidades</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  <tbody>
                    <?php
                    $contador = 0;
                    foreach ($compras_datos as $compras_dato) {
                      $id_compras = $compras_dato['id_Compras'];?>
                      <tr>
                        <td> <?php echo $contador= $contador+1;?></td>
                        <td> <?php echo $compras_dato['NumeroCompra'];?></td>
                        <td>
                          <button type="button" class="btn btn-info" data-toggle="modal"
                                  data-target="#modal-producto<?php echo $compras_dato['id_Almacen'];?>">
                                  <?php echo $compras_dato['nombre_producto'];?>
                          </button>
                          <!--/ modal para mostrar producto -->
                          <div class="modal fade" id="modal-producto<?php echo $compras_dato['id_Almacen'];?>" >
                            <div class="modal-dialog modal-lg" >
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #07b0d6; color: white" >
                                  <h4 class="modal-title">Datos del producto: <?php echo $compras_dato['nombre_producto'];?> </h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body ">
                                  <div class="row">
                                    <div class="col-md-9">
                                      <div class="row">
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="">Codigo</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_Codigo'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">Nombre Producto</label>
                                            <input type="text" value="<?php echo $compras_dato['nombre_producto'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">Descripcion Producto</label>
                                            <input type="text" value="<?php echo $compras_dato['descripcion_producto'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="">Stock</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_Stock'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="">Minimo S.</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_StockMinimo'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="">Maximo S.</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_StokMaximo'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="">Pecio Compra</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_PrecioCompra'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="">Precio venta</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_PrecioVenta'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="">Fecha</label>
                                            <input type="text" value="<?php echo $compras_dato['alm_FechaIngreso'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-5">
                                          <div class="form-group">
                                            <label for="">Nombre Categoria</label>
                                            <input type="text" value="<?php echo $compras_dato['cat_Nombre'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">Nombre Usuario</label>
                                            <input type="text" value="<?php echo $compras_dato['per_Nombre'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="">Imagen Producto</label>
                                        <img src="<?php echo  "../almacen/img_productos/".$compras_dato['alm_Imagen']?>" width="100%" alt="asdf" />
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td> <?php echo $compras_dato['com_Fecha'];?></td>
                        <td>
                          <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#modal-proveedor<?php echo $compras_dato['id_Proveedor'];?>">
                                    <?php echo $compras_dato['pro_Nombre'];?>
                          </button>
                          <!--/ modal para mostrar producto -->
                          <div class="modal fade" id="modal-proveedor<?php echo $compras_dato['id_Proveedor'];?>" >
                            <div class="modal-dialog modal-lg" >
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #07b0d6; color: white" >
                                  <h4 class="modal-title">Datos del proveedor: <?php echo $compras_dato['pro_Nombre'];?> </h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body ">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Nombre'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">RUC</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Ruc'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">Telefono</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Telefono'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Email'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Direccion'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="">Celular</label>
                                            <br>
                                            <a href="https://wa.me/593<?php echo $compras_dato['pro_Celular'];?>" target="_blank" class="btn btn-success">
                                              <i class="fa fa-phone"></i>
                                              <?php echo $compras_dato['pro_Celular'];?>
                                            </a>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="">Estado</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_Estado'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="">Fecha Creacion</label>
                                            <input type="text" value="<?php echo $compras_dato['pro_FechaCreacion'];?>" class="form-control" id="" disabled>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                        <td> <?php echo $compras_dato['com_Comprobante'];?></td>
                        <!--<td> <?php echo $compras_dato['per_Nombre'];?></td>-->
                        <td> <?php echo $compras_dato['com_Precio'];?></td>
                        <td> <?php echo $compras_dato['com_Cantidad'];?></td>
                          <?php
                          $Estado =$compras_dato['com_Estado'];
                          if ($Estado=='Inactivo') {?>
                            <td style="background-color: #FF3F33; border-radius: 5px" > <center><?php echo $Estado;?></center></td>
                            <center> <a type="button" ></a></center>
                            <?php
                          }else {?>
                              <td style="background-color: #A5FF33; border-radius: 5px"><center> <?php echo $Estado;?></center></td>
                            <?php } ?>
                        <td>
                          <center>
                            <!--<div class="btn-group">-->
                              <a href="show.php?id=<?php echo $id_compras?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>Ver</a>
                              <a href="update.php?id=<?php echo $id_compras?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                              <a href="delete.php?id=<?php echo $id_compras?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>
                            </div>
                          </center>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include ('../layout/parte2.php');
 ?>
 <script>
   $(function () {
     $("#example1").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     $('#example2').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": false,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "responsive": true,
     });
   });
 </script>
