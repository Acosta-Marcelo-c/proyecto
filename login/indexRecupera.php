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


<?php
$email = isset($_POST['email']) ? $_POST['email'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$id_tabla = isset($_POST['id_tabla']) ? $_POST['id_tabla'] : '';

?>
  
<body class="hold-transition login-page">
<div class="login-box">
<!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../public/templaes/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema</b>O.G.L</a>
    </div>
    <p></p>
    <h5> <b> <center>Usuario:       <?php echo htmlspecialchars($nombre); ?></center></b></h5>
    
    <h5>  <center><?php echo htmlspecialchars($email); ?></center></h5>  
    <h5>  <center><?php echo $id_tabla; ?></center></h5>
          <div class="card-body">
      <p class="login-box-msg"><h4><center>Recupere la contraseña</center></h4> </p>
      
        <form id="recuperaForm" action="../controlador/login/restablecer.php" method="post">
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder=" Ingrese el password">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                <input type="hidden" name="id_tabla" value="<?php echo htmlspecialchars($id_tabla); ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>    
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password_confirme" id="password_confirme" class="form-control" placeholder=" Confirme el password">
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
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </div>
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

<script>
  document.getElementById('recuperaForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var passwordConfirme = document.getElementById('password_confirme').value;
    if (password !== passwordConfirme) {
      event.preventDefault();
      alert('Las contraseñas no coinciden. Por favor, inténtelo de nuevo.');
    }
  });
</script>
</body>
</html>