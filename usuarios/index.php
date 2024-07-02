<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/usuarios/listado_usuarios.php');
//include ('../app/controlador/usuarios/update_usuario.php');
include ('../app/controlador/roles/listado_roles.php');

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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Registro de nuevo usuario
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
            <i class="fa fa-plus"></i> Agregar Nuevo
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
            <div class="card-header" >
              <h3 class="card-title" >usuario Regitrados</h3>
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
                      <th>Correo</th>
                      <!--<th>Fecha Creacion</th>-->
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                  <tbody>

                      <?php
                      $contador = 0;
                      foreach ($usuarios_datos as $usuarios_dato) {

                        $id_usuario = $usuarios_dato['id_Persona'];
                        $nombre = $usuarios_dato['per_Nombre'];
                        $Fecha_Creacion=$usuarios_dato['per_Fecha_Creacion'];
                        $Rol=$usuarios_dato['rol_nombre'];
                        $Estado=$usuarios_dato['per_Estado'];
                        ?>

                        <tr>
                          <td> <?php echo $contador= $contador+1;?></td>
                          <td> <?php echo $usuarios_dato['per_Nombre']?></td>
                          <td> <?php echo $usuarios_dato['per_Correo']?></td>
                          <!--<td> <?php //echo $usuarios_dato['per_Contrase']?></td>-->
                          <!--<td> <?php echo $usuarios_dato['per_Fecha_Creacion']?></td>-->
                          <td> <?php echo $usuarios_dato['rol_nombre']?></td>
                          <td> <?php echo $usuarios_dato['per_Estado']?>
                          <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_usuario;?>"><i class="fa fa-eye"></i> Ver</button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editar<?php echo $id_usuario;?>"><i class="fa fa-pencil-alt"></i> Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-eliminar<?php echo $id_usuario;?>"><i class="fa fa-trash"></i> Eliminar</button>
                            <!--<div class="btn-group">
                            <a href="show.php?id=<?php echo $id_usuario;?>" type="button" class="btn btn-info"><i class="fa fa-eye"></i>Ver</a>
                                <a href="update.php?id=<?php echo $id_usuario;?>" type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                <a href="delete.php?id=<?php echo $id_usuario;?>" type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Eliminar</a>
                            </div>-->
                          </td>

                        </tr>
                        <!--/ modal para ver de usuarios -->
                        <div class="modal fade" id="modal-ver<?php echo $id_usuario;?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #1d36b6 ; color: white">
                                <h4 class="modal-title">Usuario:  <?php echo $usuarios_dato['per_Nombre'];?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body ">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">ID</label>
                                        <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario;?>"  disabled>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Nombres</label>
                                        <input type="text" name="nombre" class="form-control" value="<?php echo $usuarios_dato['per_Nombre']?>" disabled>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email"  name="email" class="form-control" value="<?php echo $usuarios_dato['per_Correo'];?>" disabled >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Rol</label>
                                        <input type="text"  name="rol" class="form-control" value="<?php echo $usuarios_dato['rol_nombre'];?>" disabled >
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Estado</label>
                                        <input type="text"  name="estado" class="form-control" value="<?php echo $usuarios_dato['per_Estado'];?>" disabled >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Tiempo de Creación</label>
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
                                    </div>
                                  </div>
                                      <!--</form> -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <!--/ modal para editar de usuarios -->
                        <div class="modal fade" id="modal-editar<?php echo $id_usuario;?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #116f4a ; color: white">
                                <h4 class="modal-title"> Actualizar usuario:  <?php echo $usuarios_dato['per_Nombre'];?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body ">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">ID</label>
                                        <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario;?>" disabled>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="">Nombres</label>
                                          <input type="text" id="nombre_edit<?php echo $id_usuario;?>" class="form-control" value="<?php echo $nombre?>">
                                          <small style="color: red; display: none" id="lbl_nombre<?php echo $id_usuario;?>">*Este campo es requerido</small>
                                      </div>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Email</label>
                                      <input type="email"  id="email<?php echo $id_usuario;?>" class="form-control" value="<?php echo $usuarios_dato['per_Correo'];?>">
                                      <small style="color: red; display: none" id="lbl_email<?php echo $id_usuario;?>">*Este campo es requerido</small>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Rol</label>
                                      <select id="rol<?php echo $id_usuario;?>" id="" class="form-control">
                                        <small style="color: red; display: none" id="lbl_rol<?php echo $id_usuario;?>">*Este campo es requerido</small>
                                        <?php
                                            foreach ($rol_datos as $rol_dato) {

                                              $rol_tabla = $rol_dato['rol_Nombre'];
                                              $id_rol = $rol_dato['id_Rol'];?>

                                          <option value="<?php echo $id_rol;?>"<?php if ($rol_tabla == $Rol) {?> selected="select" <?php } ?>>
                                            <?php echo $rol_tabla;?>
                                          </optio>
                                          <?php } ?>
                                      </select>

                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Estado</label>
                                      <select id="estado<?php echo $id_usuario;?>"  class="form-control">
                                          <option value="Activo" <?php if ($Estado == "Activo") {?> selected="select" <?php } ?>>Activo</option>
                                          <option value="Activo" <?php if ($Estado == "Inactivo") {?> selected="select" <?php } ?>>Inactivo</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Tiempo de Creación</label>
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

                                      <input type="text" name="tiempo" class="form-control" value="<?php echo $interval->format('%a d&iacute;as');?>"   disabled>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Contraseña</label>
                                          <input type="text" id="password<?php echo $id_usuario;?>" class="form-control" placeholder="Nueva contraseña">
                                          <small style="color: red; display: none" id="lbl_password<?php echo $id_usuario;?>">*Este campo es requerido</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="">Repita Contraseña</label>
                                          <input type="text" id="passwordRepite<?php echo $id_usuario;?>" class="form-control" placeholder="Repita la contraseña">
                                          <small style="color: red; display: none" id="lbl_passwordRepite<?php echo $id_usuario;?>">*Este campo es requerido</small>
                                      </div>
                                    </div>
                                </div>
                                      <!--</form> -->
                                      <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-success" id="btn_updateusuario<?php echo $id_usuario;?>">Actualizar</button>
                                      </div>
                              </div>

                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->

                        </div>
                        <!-- /.modal -->
                          <script>
                          //scrip de modal de actualizacion
                          $('#btn_updateusuario<?php echo $id_usuario;?>').click(function(){

                            var id_persona = '<?php echo $id_usuario;?>';
                            var nombre_edit = $('#nombre_edit<?php echo $id_usuario;?>').val();
                            var email_edit = $('#email<?php echo $id_usuario;?>').val();
                            var rol_edit = $('#rol<?php echo $id_usuario;?>').val();
                            var estado_edit = $('#estado<?php echo $id_usuario;?>').val();
                            var password_edit = $('#password<?php echo $id_usuario;?>').val();
                            var password_repite_edit = $('#passwordRepite<?php echo $id_usuario;?>').val();

                            if (nombre_edit == ""){
                              $('#nombre_edit<?php echo $id_usuario;?>').focus();
                              $('#lbl_nombre<?php echo $id_usuario;?>').css('display','block');
                            }else if (email_edit == ""){
                              $('#email<?php echo $id_usuario;?>').focus();
                              $('#lbl_email<?php echo $id_usuario;?>').css('display','block');
                            } /*else if (password_edit ==""){
                              $('#password<?php echo $id_usuario;?>').focus();
                              $('#lbl_password<?php echo $id_usuario;?>').css('display','block');
                            }else if (password_repite_edit ==""){
                              $('#passwordRepite<?php echo $id_usuario;?>').focus();
                              $('#lbl_passwordRepite<?php echo $id_usuario;?>').css('display','block');
                            }*/
                              else{
                                var url="../app/controlador/usuarios/update.php";
                                $.post(url,{id_persona:id_persona,
                                  nombre:nombre_edit,
                                  email:email_edit,
                                  rol:rol_edit,
                                  estado:estado_edit,
                                  password:password_edit,
                                  password_repite:password_repite_edit
                                  },function (datos) {
                                  $('#respuesta').html(datos);
                                });
                              }
                            });

                          </script>
                        <div id="respuesta_update<?php echo $id_usuario;?>"></div>

                        <!--/ modal para elliminar de usuarios -->
                          <div class="modal fade" id="modal-eliminar<?php echo $id_usuario;?>">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #ca0a0b; ; color: white">
                                  <h4 class="modal-title">Eliminar Usuario:  <?php echo $usuarios_dato['per_Nombre'];?></h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body ">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">ID</label>
                                            <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario;?>"  disabled>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombre" class="form-control" value="<?php echo $usuarios_dato['per_Nombre']?>" disabled>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email"  name="email" class="form-control" value="<?php echo $usuarios_dato['per_Correo'];?>" disabled >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Rol</label>
                                        <input type="text"  name="rol" class="form-control" value="<?php echo $usuarios_dato['rol_nombre'];?>" disabled >
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Estado</label>
                                        <input type="text"  name="estado" class="form-control" value="<?php echo $usuarios_dato['per_Estado'];?>" disabled >
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Tiempo de Creación</label>
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
                                        <input type="text" name="tiemmpo" class="form-control" value="<?php echo $interval->format('%a d&iacute;as');?>"   disabled>
                                      </div>
                                    </div>
                                  </div>
                                        <!--</form> -->
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                          <button type="button" class="btn btn-danger" id="btn_eliminar<?php echo $id_usuario;?>"> Eliminar</button>
                                        </div>
                                </div>

                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        <!-- /.modal -->
                        <script>
                        $('#btn_eliminar<?php echo $id_usuario;?>').click(function(){

                          var id_usuario = '<?php echo $id_usuario;?>';
                        //alert(id_usuario);

                        var url2="../app/controlador/usuarios/delete_usuario.php";
                          $.post(url2,{id_persona:id_usuario
                                    },function (datos) {
                            $('#respuesta').html(datos);
                          });

                          });

                        </script>
                        <div id="respuesta"></div>
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
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



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

 <!--/ modal para registro de usuarios -->
 <div class="modal fade" id="modal-create">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header" style="background-color: #1d36b6 ; color: white">
         <h4 class="modal-title">Creacion de Usuario</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
        </div>
        <div class="modal-body ">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nombres<b>*</b></label>
                <input type="text" id="nombre_usuario" class="form-control">
                <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Email<b>*</b></label>
                  <input type="email" id="email_usuario" class="form-control">
                  <small style="color: red; display: none" id="lbl_email">*Este campo es requerido</small>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Rol del Usuario<b>*</b></label>
                  <select name="rol" id="rol_usuario" class="form-control">
                    <?php
                        foreach ($rol_datos as $rol_dato) {?>

                      <option value="<?php echo $rol_dato['id_Rol'];?>" >
                        <?php echo $rol_dato['rol_Nombre'];?>
                      </option>
                      <?php } ?>
                  </select>
                  <small style="color: red; display: none" id="lbl_rol">*Este campo es requerido</small>
                </div>
              </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Estado<b>*</b></label>
                    <select name="estado" id="estado_usuario" class="form-control">
                      <option value="ACTIVO">Activo</option>
                      <option value="INACTIVO">Inactivo</option>
                    </select>
                    <small style="color: red; display: none" id="lbl_estado">*Este campo es requerido</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Contraseña<b>*</b></label>
                    <input type="text" id="contraseña_usuario" class="form-control">
                    <small style="color: red; display: none" id="lbl_contraseña">*Este campo es requerido</small>
                  </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Repita la contraseña<b>*</b></label>
                      <input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>
                      <small style="color: red; display: none" id="lbl_rcontraseña">*Este campo es requerido</small>
                    </div>
                  </div>
              </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn_create">Guardar Usuario</button>
        </div>
       <div id="respuesta"></div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->

  <script>
      $('#btn_create').click(function(){
      //  alert("guardar");
      var nombre_usuario = $('#nombre_usuario').val();
      var email_usuario = $('#email_usuario').val();
      var rol_usuario = $('#rol_usuario').val();
      var estado_usuario = $('#estado_usuario').val();
      var contraseña_usuario = $('#contraseña_usuario').val();
      var rcontraseña_usuario = $('#rcontraseña_usuario').val();


      if (nombre_usuario == "") {
        $('#nombre_usuario').focus();
        $('#lbl_nombre').css('display','block');

      }else if (email_usuario== "") {
        $('#email_usuario').focus();
        $('#lbl_email').css('display','block');

      }else if (rol_usuario=="") {
        $('#rol_usuario').focus();
        $('#lbl_rol').css('display','block');

      }else if (estado_usuario=="") {
          $('#estado_usuario').focus();
          $('#lbl_celular').css('display','block');

        }else if (contraseña_usuario=="") {
          $('#contraseña_usuario').focus();
          $('#lbl_contraseña').css('display','block');

        }else if (rcontraseña_usuario=="") {
          $('#rcontraseña_usuario').focus();
          $('#lbl_rcontraseña').css('display','block');
        }else {

      var url="../app/controlador/usuarios/crearUsuario.php";
      $.post(url,{nombre:nombre_usuario,
                email:email_usuario,
                rol:rol_usuario,
                password:contraseña_usuario,
                password_repite:rcontraseña_usuario
                },function (datos) {
        $('#respuesta').html(datos);
      });
      }

      });
 </script>
