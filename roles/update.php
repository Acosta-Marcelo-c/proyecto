<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/roles/update_rol.php');

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

  <div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Modificacion de Rol</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>


        <div class="card-dody" style="display: block;">
          <div class="row">
            <div class="col-md-12">
              <form action="../app/controlador/roles/update.php" method="post">
                <div class="form-group">
                  <label for="">ID</label>
                  <input type="text" name="id_rol" class="form-control" value="<?php echo $id;?>" readonly></imput>
                </div>
                <div class="form-group">
                  <label for="">Nombre del Rol</label>
                  <input type="text" name="nombre" class="form-control"  value="<?php echo $Nombre;?>" >
                </div>
                <div class="form-group">
                  <label for="">Descripcion</label>
                  <input type="text"  name="descripcion" class="form-control"  value="<?php echo $Descripcion;?>">
                </div>

                <div class="form-group">
                  <a href="index.php" class="btn btn-secondary">Cancelar</a>
                  <button  type="submit" class="btn btn-success">Actualizar</button>
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
