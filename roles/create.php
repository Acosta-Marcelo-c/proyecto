<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/roles/listado_roles.php');

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
          <h1 class="m-0">LLene los Datos</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->



  <!-- Main content -->
<div class="content">
<div class="container-fluid">

<div class="row">

  <div class="col-md-5">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Creacion de Rol</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>


        <div class="card-dody" style="display: block;">
          <div class="row">
            <div class="col-md-12">
              <form action="../app/controlador/roles/create_rol.php" method="post">
                <div class="form-group">
                  <label for="">Nombre del Rol</label>
                  <input type="text" name="nombre" class="form-control"  placeholder="Nombre de Rol..." required>
                </div>
                <div class="form-group">
                  <label for="">Descripcion</label>
                  <input type="text"  name="descripcion" class="form-control"  placeholder="Descripcion del Rol..."required>
                </div>

                <div class="form-group">
                  <a href="index.php" class="btn btn-secondary">Cancelar</a>
                  <button  type="submit" class="btn btn-primary">Actualizar</button>
                </div>
              </form>

            </div>
          </div>

          </div>

        </div>

                      <!-- /.card-tools -->
  </div>
</div>
</div>
</div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

<!-- /.content-wrapper -->


<?php
include ('../layout/parte2.php');
 ?>
