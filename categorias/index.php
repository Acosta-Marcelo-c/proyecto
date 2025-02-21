<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../app/controlador/categorias/listado_categorias.php');

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
              <i class="fa fa-cogs" aria-hidden="true"></i> Nueva Categoria
            </button>

          </h1>

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
              <h3 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i> <b> LISTA DE CATEGORIAS DE PRODUCTOS</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="card-body" style="display: block;">
              <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                <tr>
                  <th>Nro</th>
                  <th>Nombre Categoria</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
                <tbody>

                  <?php
                  $contador = 0;
                  foreach ($categorias_datos as $categorias_dato) {

                    $id_Categoria = $categorias_dato['id_Categoria'];
                    $nombre_Categoria = $categorias_dato['cat_Nombre'];
                    $descripcion_Categoria = $categorias_dato['cat_descripcion'];
                  ?>

                    <tr>
                      <td> <?php echo $contador = $contador + 1; ?></td>
                      <td> <?php echo $categorias_dato['cat_Nombre'] ?></td>
                      <td> <?php echo $categorias_dato['cat_descripcion'] ?></td>
                      <td>
                        <!-- <div class="btn-group">-->

                        <button type="button" class="btn btn-success" data-toggle="modal"
                          data-target="#modal-update<?php echo $id_Categoria; ?>">
                          <i class="fa fa-pencil-alt"></i>Editar
                        </button>


                        <!--/ modal para editar categorias -->
                        <div class="modal fade" id="modal-update<?php echo $id_Categoria; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #116f4a ; color: white">
                                <h4 class="modal-title">Actualilzar la categoria</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for=""> Nombre de la categoria</label>
                                      <input type="text" id="nombre_categoria<?php echo $id_Categoria; ?>" value="<?php echo $nombre_Categoria; ?>" class="form-control">
                                      <small style="color: red; display: none" id="lbl_update<?php echo $id_Categoria; ?>">*Este campo es requerido</small>
                                      <label for=""> Descripcion de la categoria</label>
                                      <textarea name="descripcion" id="descripcion_categoria<?php echo $id_Categoria; ?>" rows="2" cols="30" class="form-control"><?php echo $descripcion_Categoria; ?></textarea>
                                      <small style="color: red; display: none" id="lbl_update_descripcion<?php echo $id_Categoria; ?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" id="btn_update<?php echo $id_Categoria; ?>">Actualizar</button>

                              </div>

                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <script>
                          $('#btn_update<?php echo $id_Categoria; ?>').click(function() {

                            var nombre_categoria = $('#nombre_categoria<?php echo $id_Categoria; ?>').val();
                            var id_categoria = '<?php echo $id_Categoria; ?>';
                            var descripcion_categoria = $('#descripcion_categoria<?php echo $id_Categoria; ?>').val();
                            //alert(id_categoria);
                            if (nombre_categoria == "") {
                              $('#nombre_categoria<?php echo $id_Categoria; ?>').focus();
                              $('#lbl_update<?php echo $id_Categoria; ?>').css('display', 'block');
                            } else if (descripcion_categoria == "") {
                              $('#descripcion_categoria<?php echo $id_Categoria; ?>').focus();
                              $('#lbl_update_descripcion<?php echo $id_Categoria; ?>').css('display', 'block');
                            } else {
                              var url = "../app/controlador/categorias/update_categorias.php";
                              $.get(url, {
                                nombre_categoria: nombre_categoria,
                                id_categoria: id_categoria,
                                descripcion_categoria: descripcion_categoria
                              }, function(datos) {
                                $('#respuesta_update<?php echo $id_Categoria; ?>').html(datos);
                              });
                            }
                          });
                        </script>

                        <div id="respuesta_update<?php echo $id_Categoria; ?>"></div>

                        <!--</div>-->
                      </td>

                    </tr>
                  <?php
                  }
                  ?>

            </div>
            </tbody>


            </table>

          </div>
          <!-- /.card-tools -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
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

<!--/ modal para registro de categorias -->
<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1d36b6 ; color: white">
        <h4 class="modal-title">Creacion de una nueva categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for=""> Nombre de la categoria*</label>
              <input type="text" id="nombre_categoria" class="form-control">
              <small style="color: red; display: none" id="lbl_create_nombre">*Este campo es requerido</small>
              <label for=""> Descripcion de la categoria*</label>
              <textarea type="text" id="descripcion_categoria" class="form-control"></textarea>
              <small style="color: red; display: none" id="lbl_create_descripcion">*Este campo es requerido</small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_create">Guardar categoria</button>

      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $('#btn_create').click(function() {
    //  alert("guardar");
    var nombre_categoria = $('#nombre_categoria').val();
    var descripcion_categoria = $('#descripcion_categoria').val();

    if (nombre_categoria == "") {
      $('#nombre_categoria').focus();
      $('#lbl_create_nombre').css('display', 'block');
    } else if (descripcion_categoria == "") {
      $('#descripcion_categoria').focus();
      $('#lbl_create_descripcion').css('display', 'block');
    } else {

      var url = "../app/controlador/categorias/registro_categorias.php";
      $.get(url, {
        nombre_categoria: nombre_categoria,
        descripcion_categoria: descripcion_categoria
      }, function(datos) {
        $('#respuesta').html(datos);
      });
    }

  });
</script>
<div id="respuesta"></div>