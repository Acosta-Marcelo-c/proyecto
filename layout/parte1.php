<!DOCTYPE html>
<?php
include('../app/config.php');

try {
  $sentencia = $pdo->prepare("SELECT * FROM parametro WHERE id_Param = :id_param");
  $sentencia->bindParam(':id_param', $id_param);
  $sentencia->execute();
  $parametros = $sentencia->fetch(PDO::FETCH_ASSOC);

  // Ahora puedes usar $parametros para acceder a los datos
  $nombre_empresa = $parametros['par_Nom_Empre'];
  $logo = $parametros['par_Logo'];
  $ruc = $parametros['par_Ruc'];
  $direccion = $parametros['par_Direccion'];
  $telefono = $parametros['par_Telefono'];
  $email = $parametros['par_Correo'];
  $stock_minimo = $parametros['par_stok_min'];
  $stock_maximo = $parametros['par_stok_max'];
  // etc...

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>

<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Gestion Logistica </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <!-- Libreria sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- jQuery -->
  <script src="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">

  <!--  <script>
  Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Bienvenidos al sistema <?php echo $email_session; ?>",
  showConfirmButton: false,
  timer: 1500

})
</script> -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <b><a href="#" class="nav-link"><?php echo $nombre_empresa; ?></a></b>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo $URL ?>" class="brand-link">
        <img src="../parametros/imagen/<?php echo $logo ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="60" height="60">
        <br>
        <!--<span class="brand-text font-weight-light"><?php echo $nombre_empresa; ?></span>-->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="<?php echo $URL; ?>/public/templaes/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
          </div>
          <div class="info">
            <h4 style="color:white"><?php echo $nombre_session; ?> </h4>
            <!--<a href="#" class="d-block"><?php echo $nombre_session; ?></a>
          <a href="#" class="d-block"><?php echo $rol_session ?></a>
          <a href="#" class="d-block"><?php echo $id_param ?></a>-->
            <?php
            $contador = 0;
            $sql_mod = "SELECT modu.mod_Nombre, modu.mod_Icono, modu.mod_Ruta FROM rol_mod as rolMod 
                        INNER JOIN modulo as modu ON rolMod.id_mod = modu.id_mod WHERE id_Rol = :rol_id AND modu.mod_Estado = '1'";
            $query_mod = $pdo->prepare($sql_mod);
            $query_mod->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
            $query_mod->execute();
            $mod_datos = $query_mod->fetchAll(PDO::FETCH_ASSOC);

            foreach ($mod_datos as $mod_dato) {
              $contador++;
            }
            ?>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <?php
            foreach ($mod_datos as $mod_dato) {
              $mod_nombre = $mod_dato['mod_Nombre'];
              $mod_icono = $mod_dato['mod_Icono'];
              $mod_ruta = $mod_dato['mod_Ruta'];
            ?>
              <li class="nav-item">

                <a href="<?php echo $URL; ?><?php echo $mod_ruta; ?>" class="nav-link" style="background-color: #0000ff">
                  <?php echo $mod_icono; ?>
                  <p> <?php echo $mod_nombre; ?> </p>
                </a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a href="<?php echo $URL; ?>/controlador/login/cerrar_session.php" class="nav-link" style="background-color: #ca0a0b">
                <i class="nav-icon fas fa-door-closed"></i>
                <p>Cierre de Sesion</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</body>

</html>