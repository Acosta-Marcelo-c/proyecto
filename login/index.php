<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/templaes/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../public/templaes/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/templaes/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <!--Libreria sweetalert2-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition login-page">
  <div class="login-box">

    <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
      $respuesta = $_SESSION['mensaje']; ?>
      <script>
        Swal.fire({
          icon: "advertencia",
          title: "Error.",
          text: "<?php echo $respuesta; ?>",

        });
      </script>

    <?php
    }
    session_destroy();

    ?>

    <!-- /.login-logo -->
    <center>
      <img src="https://img.freepik.com/vector-gratis/fondo-optimizacion-marketing_23-2148009592.jpg?w=740&t=st=1704060284~exp=1704060884~hmac=3a6097654d9d1aeab83baa9cb7ce9f1dfce9f7e3aebbc5cbe7186101bd3998c5" width="150px" />
    </center>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../public/templaes/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema</b>O.G.L</a>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Incio de sesion</p>

        <form action="../controlador/login/ingreso.php" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="contrase" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Ingreso</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-1">
          <a class="text-center" data-toggle="modal" data-target="#modal-olvide">Olvidé mi contraseña</a>
        </p>
        <p class="mb-0">
          <a class="text-center" data-toggle="modal" data-target="#modal-create">Creación una nueva cuenta</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../public/templaes/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../public/templaes/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/templaes/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>


<!--/ modal para registro de usuarios -->
<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1d36b6 ; color: white">
        <h4 class="modal-title">Creacion de Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nombres<b>*</b></label>
              <input type="text" id="nombre_usuario" class="form-control">
              <small style="color: red; display: none" id="lbl_nombre">*Este campo es requerido</small>
            </div>

            <div class="form-group">
              <label for="">Email<b>*</b></label>
              <input type="email" id="email_usuario" class="form-control">
              <small style="color: red; display: none" id="lbl_email">*Este campo es requerido</small>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Contraseña<b>*</b></label>
              <input type="password" id="contraseña_usuario" class="form-control">
              <small style="color: red; display: none" id="lbl_contraseña">*Este campo es requerido</small>
            </div>

            <div class="form-group">
              <label for="">Repita la contraseña<b>*</b></label>
              <input type="password" id="rcontraseña_usuario" cols="30" row="3" class="form-control"></input>
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

<!--/ modal olvide contraseña -->
<div class="modal fade" id="modal-olvide">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1d36b6 ; color: white">
        <h4 class="modal-title">Recuperacion de contraseña</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="email_olvide">Ingrese su Email<b>:</b></label>
              <input type="email" id="email_olvide" class="form-control">
              <small style="color: red; display: none" id="lbl_olvide">*Este campo es requerido</small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_olvide">Enviar</button>
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
    // alert("guardar");
    var nombre_usuario = $('#nombre_usuario').val();
    var email_usuario = $('#email_usuario').val();
    var rol_usuario = '6';
    var parametro_usuario = '1';
    var estado_usuario = "Inactivo";
    var contraseña_usuario = $('#contraseña_usuario').val();
    var rcontraseña_usuario = $('#rcontraseña_usuario').val();


    if (nombre_usuario == "") {
      $('#nombre_usuario').focus();
      $('#lbl_nombre').css('display', 'block');

    } else if (email_usuario == "") {
      $('#email_usuario').focus();
      $('#lbl_email').css('display', 'block');

    } else if (rol_usuario == "") {
      $('#rol_usuario').focus();
      $('#lbl_rol').css('display', 'block');

    } else if (parametro_usuario == "") {
      $('#parametro_usuario').focus();
      $('#parametro_usuario').css('display', 'block');

    } else if (estado_usuario == "") {
      $('#estado_usuario').focus();
      $('#lbl_celular').css('display', 'block');

    } else if (contraseña_usuario == "") {
      $('#contraseña_usuario').focus();
      $('#lbl_contraseña').css('display', 'block');

    } else if (rcontraseña_usuario == "") {
      $('#rcontraseña_usuario').focus();
      $('#lbl_rcontraseña').css('display', 'block');

    } else if (contraseña_usuario !== rcontraseña_usuario) {
      alert('Las contraseñas no coinciden. Por favor, inténtelo de nuevo.');
    } else {

      var url = "../controlador/usuarios/createNuevUsuario.php";
      $.post(url, {
        nombre: nombre_usuario,
        email: email_usuario,
        rol: rol_usuario,
        parametro: parametro_usuario,
        estado: estado_usuario,
        password: contraseña_usuario,
        password_repite: rcontraseña_usuario
      }, function(datos) {
        $('#respuesta').html(datos);
      });
    }

  });

  $('#btn_olvide').click(function() {
    var email_olvide = $('#email_olvide').val();

    if (email_olvide == "") {
      $('#email_olvide').focus();
      $('#lbl_olvide').css('display', 'block');
    } else {

      var url = "../controlador/usuarios/olvideUsuario.php";
      $.post(url, {
        email: email_olvide
      }, function(datos) {
        $('#respuesta').html(datos);
        // Cerrar el modal si el correo se envió correctamente
        if (datos.includes("Correo de recuperación enviado.")) {
          $('#modal-olvide').modal('hide');
        }
      });
    }

  });
</script>