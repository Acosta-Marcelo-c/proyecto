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
      unset($_SESSION['mensaje']); // Limpiar el mensaje de sesión después de mostrarlo

    }

    if (isset($_GET['nombre']) && isset($_GET['email']) && isset($_GET['token']) && isset($_GET['id_tabla'])) {
      $nombre = $_GET['nombre'];
      $email = $_GET['email'];
      $token = $_GET['token'];
      $id_tabla = $_GET['id_tabla'];
    }
    ?>

    <!-- /.login-logo -->

    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../public/templaes/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema</b>O.G.L</a>
      </div>
      <h3>
        <center><?php echo $nombre; ?></center>
      </h3>
      <div class="card-body">
        <p class="login-box-msg">
        <h4>
          <center>Ingrese el codigo</center>
        </h4>
        </p>
        <!--<h4><center>Nombre: <?php echo $nombre; ?></center></h4>
        <h4><center>email: <?php echo $email; ?></center></h4>
        <h4><center>token: <?php echo $token; ?></center></h4>-->

        <form action="../controlador/login/verificaUsuario.php" method="post">
          <div class="input-group mb-3">
            <input type="passwor1" name="codigo_usuario" class="form-control" placeholder=" ingrese el codigo">
            <input type="hidden" name="nombre_usuario" value="<?php echo $nombre; ?>">
            <input type="hidden" name="email_usuario" value="<?php echo $email; ?>">
            <input type="hidden" name="token_usuario" value="<?php echo $token; ?>">
            <input type="hidden" name="id_tabla" value="<?php echo $id_tabla; ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <!--<input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>-->
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