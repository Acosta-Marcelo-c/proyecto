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
                <h1 class="m-0">Registro de roles
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                  <i class="fa fa-plus"></i> Agregar Nuevo Rol
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
                      <h3 class="card-title" >Roles Regitrados</h3>
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
                                <th>Descripcion</th>
                                <th>Acciones</th>
                              </tr>
                              <tbody>

                                <?php
                                $contador = 0;
                                foreach ($rol_datos as $rol_dato) {

                                  $id_Rol = $rol_dato['id_Rol'];
                                  $nombre_rol = $rol_dato['rol_Nombre'];
                                  $descripcion_rol = $rol_dato['rol_Descripcion'];
                                  ?>
                                  <tr>
                                    <td> <?php echo $contador= $contador+1;?></td>
                                    <td> <?php echo $rol_dato['rol_Nombre'];?></td>
                                    <td> <?php echo $rol_dato['rol_Descripcion'];?></td>
                                    <td>
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editar<?php echo $id_Rol;?>"><i class="fa fa-pencil-alt"></i> Editar</button>
                                      <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-eliminar<?php echo $id_Rol;?>"><i class="fa fa-trash"></i> Eliminar</button>
                                      <div class="btn-group">
                                          <a href="update.php?id=<?php echo $id_Rol?>" type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                      </div>-->
                                    </td>

                                  </tr>
                                    <!--/ modal para Editar de rol -->
                                     <div class="modal fade" id="modal-editar<?php echo $id_Rol;?>">
                                       <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                           <div class="modal-header" style="background-color: #116f4a ; color: white">
                                             <h4 class="modal-title">Editar Rol</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                             </button>
                                           </div>
                                           <div class="modal-body ">
                                                 <div class="row">
                                                   <div class="col-md-3">
                                                     <div class="form-group">
                                                       <label for="">Id Rol</label>
                                                       <input type="text" name="id_rol_actu" id="id_rol_actu<?php echo $id_Rol?>" class="form-control" value="<?php echo $id_Rol;?>" disabled>
                                                     </div>
                                                   </div>
                                                 </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="">Nombre</label>
                                                      <input type="text"  name="nombre_rol_actu" id="nombre_rol_actu<?php echo $id_Rol?>" class="form-control" value="<?php echo $nombre_rol;?>">
                                                      <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                                    </div>
                                                   </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="">Descripcion</label>
                                                        <textarea name="descripcion" id="descripcion_rol_actu<?php echo $id_Rol?>" rows="2" cols="30" class="form-control"><?php echo $descripcion_rol;?></textarea>
                                                        <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                                        <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                                      </div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="modal-footer justify-content-between">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                             <button type="button" class="btn btn-success" id="btn_update<?php echo $id_Rol;?>">Actualizar</button>

                                           </div>
                                           <div id="respuesta"></div>
                                         </div>
                                         <!-- /.modal-content -->
                                       </div>
                                       <!-- /.modal-dialog -->
                                     </div>
                                     <!-- /.modal -->

                                     <script>

                                          $('#btn_update<?php echo $id_Rol;?>').click(function(){
                                          //  alert("guardar");
                                          var id_rol_actu = '<?php echo $id_Rol;?>';
                                          var nombre_rol = $('#nombre_rol_actu<?php echo $id_Rol?>').val();
                                          var descripcion_rol = $('#descripcion_rol_actu<?php echo $id_Rol?>').val();

                                          if (nombre_rol == "") {
                                            $('#nombre_rol_actu').focus();
                                            $('#lbl_nombre').css('display','block');

                                          }else if (descripcion_rol== "") {
                                            $('#descripcion_rol_actu').focus();
                                            $('#lbl_descripcion').css('display','block');

                                          }else {

                                          var url2="../app/controlador/roles/update.php";
                                          $.post(url2,{id_rol_actu:id_rol_actu,
                                                     nombre_rol:nombre_rol,
                                                     descripcion_rol:descripcion_rol
                                                    },function (datos) {
                                            $('#respuesta_update').html(datos);
                                          });
                                          }

                                          });

                                     </script>
                                      <div id="respuesta_update"></div>


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

 <!--/ modal para registro de rol -->
 <div class="modal fade" id="modal-create">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header" style="background-color: #1d36b6 ; color: white">
         <h4 class="modal-title">Creacion de Rol</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body ">
             <div class="row">
               <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Nombre</label>
                   <input type="text" id="nombre_rol" class="form-control">
                   <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                 </div>
               </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="">Descripcion</label>
                     <textarea name="descripcion" id="descripcion_rol" rows="2" cols="30" class="form-control" ></textarea>
                     <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                     <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                   </div>
                 </div>
            </div>

       </div>
       <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="button" class="btn btn-primary" id="btn_create">Guardar Rol</button>

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
      var nombre_rol = $('#nombre_rol').val();
      var descripcion_rol = $('#descripcion_rol').val();

      if (nombre_rol == "") {
        $('#nombre_usuario').focus();
        $('#lbl_nombre').css('display','block');

      }else if (descripcion_rol== "") {
        $('#descripcion_rol').focus();
        $('#lbl_descripcion').css('display','block');

      }else {

      var url="../app/controlador/roles/create_rol.php";
      $.post(url,{nombre:nombre_rol,
                descripcion:descripcion_rol
                },function (datos) {
        $('#respuesta').html(datos);
      });
      }

      });

 </script>
