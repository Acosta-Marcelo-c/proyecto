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
          icon: "error",
          title: "Error.",
          text: "<?php echo $respuesta; ?>",

        });
      </script>

    <?php
    }
    ?>

    <!-- /.login-logo -->

    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../public/templaes/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema</b>O.G.L</a>
      </div>

      <div class="card-body">
        <p class="login-box-msg">
        <h4>
          <center>Restablecer Contraseña</center>
        </h4>
        </p>

        <form action="../controlador/usuario/verificaUsuario.php" method="post">
          <div class="input-group mb-3">
            <input type="passwor1" name="contrase1" class="form-control" placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="contrase" class="form-control" placeholder="Repita Contraseña">
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
              <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

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

<script>
  $('#btn_create').click(function() {
    // alert("guardar");
    var nombre_usuario = $('#nombre_usuario').val();
    var email_usuario = $('#email_usuario').val();
    var rol_usuario = '27';
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

    } else if (estado_usuario == "") {
      $('#estado_usuario').focus();
      $('#lbl_celular').css('display', 'block');

    } else if (contraseña_usuario == "") {
      $('#contraseña_usuario').focus();
      $('#lbl_contraseña').css('display', 'block');

    } else if (rcontraseña_usuario == "") {
      $('#rcontraseña_usuario').focus();
      $('#lbl_rcontraseña').css('display', 'block');
    } else {

      var url = "../controlador/usuarios/createNuevUsuario.php";
      $.post(url, {
        nombre: nombre_usuario,
        email: email_usuario,
        rol: rol_usuario,
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