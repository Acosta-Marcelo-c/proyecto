<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/proveedores/listado_proveedores.php');

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
          <h1 class="m-0">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
              <i class="fa fa-truck" aria-hidden="true"></i> Nuevo Proveedor
            </button>
          </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div> <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline cart-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Proveedores Regitrados</b></h3>
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
                  <th>Direccion</th>
                  <th>Celular</th>
                  <th>Email</th>
                  <th>Ruc</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                <tbody>

                  <?php
                  $contador = 0;
                  foreach ($proveedor_datos as $proveedor_dato) {
                    $id_Proveedor = $proveedor_dato['id_Proveedor'];
                    $nombre_Proveedor = $proveedor_dato['pro_Nombre'];
                    $telefono_Proveedor = $proveedor_dato['pro_Telefono']; ?>
                    <tr>
                      <td> <?php echo $contador = $contador + 1; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Nombre']; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Direccion']; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Celular']; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Email']; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Ruc']; ?></td>
                      <td> <?php echo $proveedor_dato['pro_Estado']; ?></td>
                      <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_Proveedor; ?>">
                          <i class="fa fa-pencil-alt"></i> Editar
                        </button>

                      </td>

                      <!--/ modal para editar categorias -->
                      <div class="modal fade" id="modal-update<?php echo $id_Proveedor; ?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: #116f4a ; color: white">
                              <h4 class="modal-title">Actualilzar del proveedor</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Nombre<b>*</b></label>
                                    <input type="text" id="nombre_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $nombre_Proveedor; ?>" class="form-control">
                                    <small style="color: red; display: none" id="lbl_nombre<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">RUC<b>*</b></label>
                                    <input type="number" id="ruc_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Ruc']; ?>" class="form-control">
                                    <small style="color: red; display: none" id="lbl_ruc<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Telefono<b>*</b></label>
                                    <input type="number" id="telefono_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $telefono_Proveedor; ?>" class="form-control">
                                    <small style="color: red; display: none" id="lbl_telefono<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Telefono celular<b>*</b></label>
                                    <input type="number" id="celular_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Celular']; ?>" class="form-control">
                                    <small style="color: red; display: none" id="lbl_celular<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Email<b>*</b></label>
                                    <input type="email" id="email_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Email']; ?>" class="form-control">
                                    <small style="color: red; display: none" id="lbl_email<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Direccion<b>*</b></label>
                                    <textarea type="text" id="direccion_proveedor<?php echo $id_Proveedor; ?>" cols="30" row="3" class="form-control"><?php echo $proveedor_dato['pro_Direccion']; ?></textarea>
                                    <small style="color: red; display: none" id="lbl_direccion<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="estado_proveedor<?php echo $id_Proveedor; ?>">Estado<b>*</b></label>
                                    <select class="form-control" id="estado_proveedor<?php echo $id_Proveedor; ?>">
                                      <option value="ACTIVO" <?php echo ($proveedor_dato['pro_Estado'] == 'ACTIVO') ? 'selected' : ''; ?>>Activo</option>
                                      <option value="INACTIVO" <?php echo ($proveedor_dato['pro_Estado'] == 'INACTIVO') ? 'selected' : ''; ?>>Inactivo</option>
                                    </select>
                                    <small style="color: red; display: none" id="lbl_estado<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" id="btn_update<?php echo $id_Proveedor; ?>">Actualizar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <script>
                          $('#btn_update<?php echo $id_Proveedor; ?>').click(function() {

                            var id_proveedor = '<?php echo $id_Proveedor; ?>';
                            var nombre_proveedor = $('#nombre_proveedor<?php echo $id_Proveedor; ?>').val();
                            var ruc_proveedor = $('#ruc_proveedor<?php echo $id_Proveedor; ?>').val();
                            var telefono_proveedor = $('#telefono_proveedor<?php echo $id_Proveedor; ?>').val();
                            var celular_proveedor = $('#celular_proveedor<?php echo $id_Proveedor; ?>').val();
                            var email_proveedor = $('#email_proveedor<?php echo $id_Proveedor; ?>').val();
                            var direccion_proveedor = $('#direccion_proveedor<?php echo $id_Proveedor; ?>').val();
                            var estado_proveedor = $('#estado_proveedor<?php echo $id_Proveedor; ?>').val();

                            // alert(estado_proveedor);

                            if (nombre_proveedor == "") {
                              $('#nombre_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_nombre<?php echo $id_Proveedor; ?>').css('display', 'block');

                            } else if (ruc_proveedor == "") {
                              $('#ruc_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_ruc<?php echo $id_Proveedor; ?>').css('display', 'block');

                            } else if (telefono_proveedor == "") {
                              $('#telefono_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_telefono<?php echo $id_Proveedor; ?>').css('display', 'block');

                            } else if (celular_proveedor == "") {
                              $('#celular_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_celular<?php echo $id_Proveedor; ?>').css('display', 'block');

                            } else if (direccion_proveedor == "") {
                              $('#direccion_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_direccion<?php echo $id_Proveedor; ?>').css('display', 'block');

                            } else if (email_proveedor == "") {
                              $('#email_proveedor<?php echo $id_Proveedor; ?>').focus();
                              $('#lbl_email<?php echo $id_Proveedor; ?>').css('display', 'block');
                            } else {

                              var url = "../app/controlador/proveedores/update_proveedores.php";
                              $.get(url, {
                                id_proveedor: id_proveedor,
                                nombre_proveedor: nombre_proveedor,
                                ruc_proveedor: ruc_proveedor,
                                telefono_proveedor: telefono_proveedor,
                                celular_proveedor: celular_proveedor,
                                direccion_proveedor: direccion_proveedor,
                                email_proveedor: email_proveedor,
                                estado_proveedor: estado_proveedor
                              }, function(datos) {
                                $('#respuesta').html(datos);
                              });
                            }
                          });
                        </script>

                        <div id="respuesta_update<?php echo $id_Proveedor; ?>">
                        </div>

                        <!--/ modal para elliminar proveedores -->
                        <div class="modal fade" id="modal-delete<?php echo $id_Proveedor; ?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #ca0a0b; color: white">
                                <h4 class="modal-title">Eliminar proveedor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body ">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Nombre<b>*</b></label>
                                      <input type="text" id="nombre_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $nombre_Proveedor; ?>" class="form-control" disabled>
                                      <small style="color: red; display: none" id="lbl_nombre<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">RUC<b>*</b></label>
                                      <input type="number" id="ruc_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Ruc']; ?>" class="form-control" disabled>
                                      <small style="color: red; display: none" id="lbl_ruc<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Telefono<b>*</b></label>
                                      <input type="number" id="telefono_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $telefono_Proveedor; ?>" class="form-control" disabled>
                                      <small style="color: red; display: none" id="lbl_telefono<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Telefono celular<b>*</b></label>
                                      <input type="number" id="celular_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Celular']; ?>" class="form-control" disabled>
                                      <small style="color: red; display: none" id="lbl_celular<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Email<b>*</b></label>
                                      <input type="email" id="email_proveedor<?php echo $id_Proveedor; ?>" value="<?php echo $proveedor_dato['pro_Email']; ?>" class="form-control" disabled>
                                      <small style="color: red; display: none" id="lbl_email<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Direccion<b>*</b></label>
                                      <textarea type="text" id="direccion_proveedor<?php echo $id_Proveedor; ?>" cols="30" row="3" class="form-control" disabled><?php echo $proveedor_dato['pro_Direccion']; ?></textarea>
                                      <small style="color: red; display: none" id="lbl_direccion<?php echo $id_Proveedor; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btn_eliminar<?php echo $id_Proveedor; ?>"> Eliminar</button>
                              </div>
                              <div id="respuesta_detete<?php echo $id_Proveedor; ?>">
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <script>
                          $('#btn_eliminar<?php echo $id_Proveedor; ?>').click(function() {

                            var id_proveedor = '<?php echo $id_Proveedor; ?>';
                            //alert(id_proveedor);

                            var url2 = "../app/controlador/proveedores/delete_proveedores.php";
                            $.get(url2, {
                              id_proveedor: id_proveedor
                            }, function(datos) {
                              $('#respuesta').html(datos);
                            });

                          });
                        </script>

                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div><!-- /.card-tools -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div><!-- /.content -->
</div><!-- /.content-wrapper -->



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

<!--/ modal para registro de proveedores -->
<div class="modal fade" id="modal-create">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1d36b6 ; color: white">
        <h4 class="modal-title">Creacion de un nuevo proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nombre<b>*</b></label>
              <input type="text" id="nombre_proveedor" class="form-control">
              <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">RUC<b>*</b></label>
              <input type="number" id="ruc_proveedor" class="form-control">
              <small style="color: red; display: none" id="lbl_ruc">*Este campo es requerido</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Telefono<b>*</b></label>
              <input type="number" id="telefono_proveedor" class="form-control">
              <small style="color: red; display: none" id="lbl_telefono">*Este campo es requerido</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Telefono celular<b>*</b></label>
              <input type="number" id="celular_proveedor" class="form-control">
              <small style="color: red; display: none" id="lbl_celular">*Este campo es requerido</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Email<b>*</b></label>
              <input type="email" id="email_proveedor" class="form-control">
              <small style="color: red; display: none" id="lbl_email">*Este campo es requerido</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Direccion<b>*</b></label>
              <textarea type="text" id="direccion_proveedor" cols="30" row="3" class="form-control"></textarea>
              <small style="color: red; display: none" id="lbl_direccion">*Este campo es requerido</small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_create">Guardar categoria</button>
      </div>
      <div id="respuesta">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $('#btn_create').click(function() {
    //  alert("guardar");
    var nombre_proveedor = $('#nombre_proveedor').val();
    var ruc_proveedor = $('#ruc_proveedor').val();
    var telefono_proveedor = $('#telefono_proveedor').val();
    var celular_proveedor = $('#celular_proveedor').val();
    var direccion_proveedor = $('#direccion_proveedor').val();
    var email_proveedor = $('#email_proveedor').val();


    if (nombre_proveedor == "") {
      $('#nombre_proveedor').focus();
      $('#lbl_nombre').css('display', 'block');

    } else if (ruc_proveedor == "") {
      $('#ruc_proveedor').focus();
      $('#lbl_ruc').css('display', 'block');

    } else if (telefono_proveedor == "") {
      $('#telefono_proveedor').focus();
      $('#lbl_telefono').css('display', 'block');

    } else if (celular_proveedor == "") {
      $('#celular_proveedor').focus();
      $('#lbl_celular').css('display', 'block');

    } else if (direccion_proveedor == "") {
      $('#direccion_proveedor').focus();
      $('#lbl_direccion').css('display', 'block');

    } else if (email_proveedor == "") {
      $('#email_proveedor').focus();
      $('#lbl_email').css('display', 'block');
    } else {

      var url = "../app/controlador/proveedores/create_proveedores.php";
      $.get(url, {
        nombre_proveedor: nombre_proveedor,
        ruc_proveedor: ruc_proveedor,
        telefono_proveedor: telefono_proveedor,
        celular_proveedor: celular_proveedor,
        direccion_proveedor: direccion_proveedor,
        email_proveedor: email_proveedor
      }, function(datos) {
        $('#respuesta').html(datos);
      });
    }

  });
</script>