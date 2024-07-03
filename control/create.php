<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
//include ('../app/controlador/roles/listado_Roles.php');
include ('../app/controlador/control/listado_modulo.php');
include ('../app/controlador/control/cargar_control.php');

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
          <h1 class="m-0">ROL <?php echo $control_rol_nombre;?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <form action="../app/controlador/usuarios/crearUsuario.php" method="post">
                    <div class="card card-outline cart-primary">
                        <div class="card-header">
                        <h3 class="card-title">Asignacion de modulos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                <tr>
                                <h4 class="m-0">Modulos Activos: </h4>
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                <tbody>

                                    <?php
                                    $contador = 0;
                                    foreach ($modulo_datos as $modulo_dato) {

                                    $id_Mod = $modulo_dato['id_mod'];
                                    //$id_Rol = $modulo_dato['id_Rol'];
                                    $nombre_Mod = $modulo_dato['mod_Nombre'];
                                    $estado_Mod = $modulo_dato['mod_Estado'];
                                    ?>
                                    <tr>
                                        <td> <?php echo $contador=$contador+1;?></td>
                                        <td> <?php echo $modulo_nombre3=$modulo_dato['mod_Nombre'];?></td>
                                        <td> <?php echo $modulo_dato['mod_Estado'];?></td>
                                        <td>
                                        <input type="checkbox"  name="nombre_rol_actu" id="nombre_rol_actu" 
                                        <?php
                                        foreach ($modulo2_datos as $modulo2_dato) {
                                          $control_rol_nombre2= $modulo2_dato['mod_Nombre'];
                                          $control_rol_nombre2;
                                          if($control_rol_nombre2== $modulo_nombre3){
                                            echo "checked />";
                                          }else{
                                            echo "";
                                          }
                                        }
                                        ?>
                                        
                                    </tr>   
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                
                            </table>
                            <br> 
                            <div class="form-group">
                              <a href="index.php" class="btn btn-secondary">Cancelar</a>
                              <button  type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card-tools -->
              </div>
           </div>
        </div>
      <!-- /.container-fluid -->
    </div>
  <!-- /.content -->
</div>


<?php
include ('../layout/parte2.php');
 ?>
