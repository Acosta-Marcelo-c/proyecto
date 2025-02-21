<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/control/listado_modulo.php');
include('../app/controlador/creacion/listado_icono.php');

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
                    <h4 class="m-0">CREACION DE MODULOS
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo Modulo
                        </button>
                    </h4>
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
                            <h3 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i><b> ROLES DESIGNADOS</b></h3>
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
                                    <th>Estado</th>
                                    <th>Modulos Icono</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                </tr>
                                <tbody>

                                    <?php
                                    $contador = 0;
                                    foreach ($modulo_datos as $modulo_dato) {

                                        $id_mod = $modulo_dato['id_mod'];
                                        $nombre_mod = $modulo_dato['mod_Nombre'];
                                        $mod_Estado = $modulo_dato['mod_Estado'];
                                        $mod_Ruta = $modulo_dato['mod_Ruta'];
                                        $mod_Icono = $modulo_dato['mod_Icono'];
                                        $mod_Descripcion = $modulo_dato['mod_Descripcion'];
                                    ?>
                                        <tr>
                                            <td> <?php echo $contador = $contador + 1; ?></td>
                                            <td> <?php echo $nombre_mod; ?></td>
                                            <td>
                                                <?php
                                                $estado = $modulo_dato['mod_Estado'] ?? 0;
                                                echo ($estado == 1) ?
                                                    '<h4><span class="badge badge-success p-2" style="font-size: 16px;">Activo</span></h4>' :
                                                    '<h4><span class="badge badge-danger p-2" style="font-size: 16px;">Inactivo</span></h4>';
                                                ?>
                                            </td>

                                            <td> <?php echo $mod_Icono; ?></td>
                                            <td> <?php echo $mod_Descripcion; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-editar<?php echo $id_mod; ?>"><i class="fa fa-pencil-alt"></i> Editar</button>
                                            </td>

                                        </tr>
                                        <!--/ modal para Editar de modulo -->
                                        <div class="modal fade" id="modal-editar<?php echo $id_mod; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #116f4a ; color: white">
                                                        <h4 class="modal-title">Editar Modulo</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Id modulo</label>
                                                                    <input type="text" name="id_mod_actu" id="id_mod_actu<?php echo $id_mod ?>" class="form-control" value="<?php echo $id_mod; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Nombre</label>
                                                                    <input type="text" name="nombre_mod_actu" id="nombre_mod_actu<?php echo $nombre_mod ?>" class="form-control" value="<?php echo $nombre_mod; ?>">
                                                                    <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Estado</label>
                                                                    <select name="estado_mod_actu" id="estado_mod_actu<?php echo $id_mod ?>" class="form-control">
                                                                        <?php if ($mod_Estado == 1) { ?>
                                                                            <option value="1" selected>Activo</option>
                                                                            <option value="0">Inactivo</option>
                                                                        <?php } else { ?>
                                                                            <option value="1">Activo</option>
                                                                            <option value="0" selected>Inactivo</option>
                                                                        <?php } ?>
                                                                        <
                                                                            </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Icono</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <?php echo $mod_Icono; ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Descripcion</label>
                                                                    <textarea name="descripcion_mod_actu" id="descripcion_mod_actu<?php echo $id_mod ?>" rows="2" cols="30" class="form-control"><?php echo $mod_Descripcion; ?></textarea>
                                                                    <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                                                                    <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_mod; ?>">Actualizar</button>

                                                    </div>
                                                    <div id="respuesta"></div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                        <script>
                                            $('#btn_update<?php echo $id_mod; ?>').click(function() {
                                                //  alert("guardar");
                                                var id_mod_actu = $('#id_mod_actu<?php echo $id_mod ?>').val();
                                                //alert(id_mod_actu);
                                                var nombre_nod_act = $('#nombre_mod_actu<?php echo $nombre_mod ?>').val();
                                                //alert(nombre_nod_act);
                                                var estado_mod_actu = $('#estado_mod_actu<?php echo $id_mod ?>').val();
                                                //alert(estado_mod_actu);
                                                var descripcion_mod_act = $('#descripcion_mod_actu<?php echo $id_mod ?>').val();
                                                //alert(descripcion_mod_act);

                                                if (nombre_nod_act == "") {
                                                    $('#nombre_mod_actu').focus();
                                                    $('#lbl_nombre').css('display', 'block');

                                                } else if (descripcion_mod_act == "") {
                                                    $('#descripcion_mod_actu').focus();
                                                    $('#lbl_descripcion').css('display', 'block');

                                                } else {

                                                    var url2 = "../app/controlador/creacion/update_creacion.php";
                                                    $.post(url2, {
                                                        id_mod_actu: id_mod_actu,
                                                        nombre_mod_actu: nombre_nod_act,
                                                        estado_mod_actu: estado_mod_actu,
                                                        descripcion_mod_actu: descripcion_mod_act
                                                    }, function(datos) {
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

<!--/ modal para registro de modulol -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6 ; color: white">
                <h4 class="modal-title">Creacion de Modulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" id="nombre_mod" class="form-control">
                            <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="estado_mod" id="estado_mod" class="form-control">
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mod_icono">Icono</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i id="iconPreview" class="fas fa-home"></i>
                                    </span>
                                </div>
                                <select id="mod_icono" class="form-control" onchange="actualizarVistaPrevia()">
                                    <option value="fas fa-home">Home</option>
                                    <option value="fas fa-user">Usuario</option>
                                    <option value="fas fa-users">Usuarios</option>
                                    <option value="fas fa-shopping-cart">Carrito</option>
                                    <option value="fas fa-cog">Configuración</option>
                                    <option value="fas fa-file">Archivo</option>
                                    <option value="fas fa-chart-bar">Gráfico</option>
                                    <option value="fas fa-box">Producto</option>
                                    <option value="fas fa-truck">Envío</option>
                                    <option value="fas fa-warehouse">Almacén</option>
                                </select>
                            </div>
                            <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
                        </div>

                        <script>
                            function actualizarVistaPrevia() {
                                const select = document.getElementById('mod_icono');
                                const preview = document.getElementById('iconPreview');
                                preview.className = select.value;
                            }
                        </script>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea name="descripcion" id="descripcion_mod" rows="2" cols="30" class="form-control"></textarea>
                            <!--<input type="text" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>-->
                            <small style="color: red; display: none" id="lbl_descripcion">*Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar modulo</button>

            </div>
            <div id="respuesta"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function() {
        var nombre_mod = $('#nombre_mod').val();
        var estado_mod = $('#estado_mod').val();
        var mod_icono = $('#mod_icono').val();
        var descripcion_mod = $('#descripcion_mod').val();

        var valid = true;

        if (nombre_mod == "") {
            $('#nombre_mod').focus();
            $('#lbl_nombre').css('display', 'block');
            valid = false;
        } else {
            $('#lbl_nombre').css('display', 'none');
        }

        if (mod_icono == "") {
            $('#mod_icono').focus();
            $('#lbl_icono').css('display', 'block');
            valid = false;
        } else {
            $('#lbl_icono').css('display', 'none');
        }

        if (descripcion_mod == "") {
            $('#descripcion_mod').focus();
            $('#lbl_descripcion').css('display', 'block');
            valid = false;
        } else {
            $('#lbl_descripcion').css('display', 'none');
        }

        if (valid) {
            var url = "../app/controlador/creacion/create_mod.php";
            $.post(url, {
                nombre_mod: nombre_mod,
                estado_mod: estado_mod,
                mod_icono: mod_icono,
                descripcion_mod: descripcion_mod
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>