<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/usuarios/show_usuario.php');

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
          <h1 class="m-0">Eliminar Usuario</h1>
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
    <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">¿Esta seguro de eliminar usuario?</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>


        <div class="card-dody" style="display: block;">
          <div class="row">
            <div class="col-md-12">
            <form action="../app/controlador/usuarios/delete_usuario.php" method="post">
              <div class="form-group">
                <label for="">ID</label>
                <input type="text" name="id_persona" class="form-control" value="<?php echo $id_usuario_get;?>" readonly></imput>
              </div>
                <div class="form-group">
                  <label for="">Nombres</label>
                  <input type="text" name="nombre" class="form-control" value="<?php echo $Nombre;?>" disabled>
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email"  name="email" class="form-control" value="<?php echo $Correo;?>" disabled >
                </div>
                <div class="form-group">
                  <label for="">Rol</label>
                  <input type="email"  name="email" class="form-control" value="<?php echo $Rol;?>" disabled >
                </div>

                <div class="form-group">
                  <label for="">Tiempo de creacion</label>
                  <?php
                  //$fechaInicio= $fechaHora;
                  //$fechaFin=$Fecha_Creacion;
                //  $diff = $fechaInicio->diff($fechaFin);
                //  $intervalo = $fechaInicio->diff($fechaFin);
                $datetime1 = $fechaHora;
                $datetime2 = $Fecha_Creacion;
                $interval = new DateTime();
                $interval = date_diff(date_create($datetime1),date_create($datetime2));

                  ?>
                  <input type="text" name="password_repite" class="form-control" value="<?php echo $interval->format('%a d&iacute;as');?>"   disabled>
                </div>
                <div class="form-group">
                  <a href="index.php" class="btn btn-secondary">Volver</a>
                  <button  type="submit" class="btn btn-danger">Eliminar</button>
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
