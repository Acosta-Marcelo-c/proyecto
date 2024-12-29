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
    text: "<?php   echo $respuesta;?>",

  });

  </script>
  <?php
}

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
          <input type="email" name="email"class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="contrase"class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingreso</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>-->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Olvidé mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Creación una nueva cuenta</a>
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
