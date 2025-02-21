<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/parametros/listado_parametros.php');


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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <a href="create.php">
            <h1 class="m-0">
              <button type="button" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Creacion nueva empresa o sucursal
              </button>
            </h1>
          </a>
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
          <div class="card card-outline cart-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i><b>Lista de la empresas o sucursales</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                <tr>
                  <th>Nro</th>
                  <th>Nombre</th>
                  <th>Ruc</th>
                  <th>Descripcion</th>
                  <th>Stock Min</th>
                  <th>Stock Max</th>
                  <th>Acciones</th>
                </tr>
                <tbody>

                  <?php
                  $contador = 0;
                  foreach ($parametro_datos as $parametro_dato) {

                    $id_Param = $parametro_dato['id_Param'];
                    $par_Nombre = $parametro_dato['par_Nom_Empre'];
                    $par_Ruc = $parametro_dato['par_Ruc'];
                    $par_Correo = $parametro_dato['par_Correo'];
                    $par_Descripcion = $parametro_dato['par_Descripcion'];
                    $par_Direccion = $parametro_dato['par_Direccion'];
                    $par_Telefono = $parametro_dato['par_Telefono'];
                    $par_Logotipo = $parametro_dato['par_Logo'];
                    $par_stock_min = $parametro_dato['par_stok_min'];
                    $par_stock_max = $parametro_dato['par_stok_max'];
                  ?>
                    <tr>
                      <td> <?php echo $contador = $contador + 1; ?></td>
                      <td> <?php echo $parametro_dato['par_Nom_Empre']; ?></td>
                      <td> <?php echo $parametro_dato['par_Ruc']; ?></td>
                      <td> <?php echo $parametro_dato['par_Descripcion']; ?></td>
                      <td> <?php echo $par_stock_min; ?></td>
                      <td> <?php echo $par_stock_max; ?></td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_Param; ?>"><i class="fa fa-eye"></i> Ver</button>
                        <a href="update.php?id=<?php echo $id_Param ?>"><button type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Editar</button></a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-eliminar<?php echo $id_Param; ?>"><i class="fa fa-trash"></i> Eliminar</button>
                      </td>

                    </tr>
                    <!--/ modal para ver de parametros -->
                    <div class="modal fade" id="modal-ver<?php echo $id_Param; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:rgb(7, 159, 247) ; color: white">
                            <h4 class="modal-title"><?php echo $par_Nombre; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body ">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">Id Rol</label>
                                  <input type="text" name="id_Param" id="id_Param<?php echo $id_Param; ?>" class="form-control" value="<?php echo $id_Param; ?>" disabled>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">Imagen del Local</label>
                                  <center>
                                    <img src="imagen/<?php echo $par_Logotipo; ?>" id=" imagen_parametro" width="60%" alt="">
                                  </center>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Nombre</label>
                                  <input type="text" name="par_Nombre" id="par_Nombre<?php echo $par_Nombre; ?>" class="form-control" value="<?php echo $par_Nombre; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">RUC</label>
                                  <input type="text" name="par_Ruc" id="par_Ruc<?php echo $par_Ruc; ?>" class="form-control" value="<?php echo $par_Ruc; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Correo</label>
                                  <input type="text" name="par_Correo" id="par_Correo<?php echo $par_Correo; ?>" class="form-control" value="<?php echo $par_Correo; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Direccion</label>
                                  <textarea name="Direccion" id="par_Direccion<?php echo $par_Direccion ?>" rows="2" cols="30" class="form-control" disabled><?php echo $par_Direccion; ?></textarea>
                                  <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                  <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Telefono</label>
                                  <input type="text" name="par_Telefono" id="par_Telefono<?php echo $par_Telefono; ?>" class="form-control" value="<?php echo $par_Telefono; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Descripcion</label>
                                  <textarea name="descripcion" id="par_Descripcion<?php echo $par_Descripcion ?>" rows="2" cols="30" class="form-control" disabled><?php echo $par_Descripcion; ?></textarea>
                                  <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                  <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Stock minimo: </label>
                                  <input type="text" name="par_Telefono" id="stack_min" class="form-control" value="<?php echo $par_stock_min; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Stock : </label>

                                  <input type="text" id="stack_max" cols="30" row="3" class="form-control" value="<?php echo $par_stock_max ?>" disabled></input>
                                  <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <!--<button type="button" class="btn btn-success" id="btn_update<?php echo $id_Rol; ?>">Actualizar</button>-->

                          </div>
                          <div id="respuesta"></div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!--/ modal para elimminar de parametos -->
                    <div class="modal fade" id="modal-eliminar<?php echo $id_Param; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:rgb(223, 44, 44) ; color: white">
                            <h4 class="modal-title">Se eliminara: <?php echo $par_Nombre; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body ">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">Id Rol</label>
                                  <input type="text" name="id_Param" id="id_Param<?php echo $id_Param; ?>" class="form-control" value="<?php echo $id_Param; ?>" disabled>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">Imagen del Local</label>
                                  <center>
                                    <img src="imagen/<?php echo $par_Logotipo; ?>" id=" imagen_parametro" width="60%" alt="">
                                  </center>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Nombre</label>
                                  <input type="text" name="par_Nombre" id="par_Nombre<?php echo $par_Nombre; ?>" class="form-control" value="<?php echo $par_Nombre; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">RUC</label>
                                  <input type="text" name="par_Ruc" id="par_Ruc<?php echo $par_Ruc; ?>" class="form-control" value="<?php echo $par_Ruc; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Correo</label>
                                  <input type="text" name="par_Correo" id="par_Correo<?php echo $par_Correo; ?>" class="form-control" value="<?php echo $par_Correo; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Direccion</label>
                                  <textarea name="Direccion" id="par_Direccion<?php echo $par_Direccion ?>" rows="2" cols="30" class="form-control" disabled><?php echo $par_Direccion; ?></textarea>
                                  <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                  <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Telefono</label>
                                  <input type="text" name="par_Telefono" id="par_Telefono<?php echo $par_Telefono; ?>" class="form-control" value="<?php echo $par_Telefono; ?>" disabled>
                                  <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Descripcion</label>
                                  <textarea name="descripcion" id="par_Descripcion<?php echo $par_Descripcion ?>" rows="2" cols="30" class="form-control" disabled><?php echo $par_Descripcion; ?></textarea>
                                  <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                  <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="btn_eliminar<?php echo $id_Param; ?>">Eliminar</button>

                          </div>
                          <div id="respuesta"></div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <script>
                      $('#btn_eliminar<?php echo $id_Param; ?>').click(function() {
                        //  alert("guardar");
                        var id_param = '<?php echo $id_Param; ?>';
                        var url2 = "../app/controlador/parametros/delete_parametro.php";
                        $.post(url2, {
                          id_param: id_param,

                        }, function(datos) {
                          $('#respuesta_delete').html(datos);
                        });

                      });
                    </script>
                    <div id="respuesta_delete"></div>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-tools -->
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include('../layout/parte2.php');
?>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
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