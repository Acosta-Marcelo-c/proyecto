<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Gestion Logistica </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php

use function PHPSTORM_META\type;

 echo $URL;?>/public/templaes/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/dist/css/adminlte.min.css">

<!--Libreria sweetalert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- jQuery -->
<script src="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>


</head>
<body class="hold-transition sidebar-mini">

<!--  <script>
  Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Bienvenidos al sistema <?php echo $email_session;?>",
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
        <a href="#" class="nav-link">Sistema de ventas</a>
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
    <a href="<?php echo $URL?>" class="brand-link">
      <img src="<?php echo $URL;?>/public/imagenes/Logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIS. VENTAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $URL;?>/public/templaes/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombre_session;?></a>
          <a href="#" class="d-block"><?php echo $rol_session?></a>
          <?php
             $sql_mod="SELECT modu.mod_Nombre FROM rol_mod as rolMod 
                  INNER JOIN modulo as modu ON ROLMod.id_mod = modu.id_mod WHERE id_Rol = $rol_id";
                  
                  $query_mod=$pdo->prepare($sql_mod);
                  $query_mod->execute();
                  $mod_datos=$query_mod->fetchAll(PDO::FETCH_ASSOC);

              foreach($mod_datos as $mod_dato){
                    $mod_nombre=$mod_dato['mod_Nombre'];
                      //echo $mod_nombre,'/';
                  }  ?>
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
                    $esto1 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Usuario"){
                      $esto1 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto1==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
               <i class="nav-icon fas fa-users" ></i>
                <p>
                   Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo $URL;?>../../usuarios/index.php" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Listado Usuario</p>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="<?php echo $URL;?>../../usuarios/create.php" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    <p>Creacion de Usuarios</p>
                  </a>
                </li> -->
              </ul>
          </li>
          <?php 
                    $esto2 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Control"){
                      $esto2 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto2==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="fa fa-cog fa-1x fa-fw"></i>
              <p>
                Control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../control/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Control</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="<?php echo $URL;?>../../roles/create.php" class="nav-link">
                  <i class="fa fa-address-book"></i>
                  <p>Creacion de Roles</p>
                </a>
              </li> -->
            </ul>
          </li>

          <?php 
                    $esto3 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Roles"){
                      $esto3 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto3==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="nav-icon fas fa-address-card" ></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../roles/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado Roles</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="<?php echo $URL;?>../../roles/create.php" class="nav-link">
                  <i class="fa fa-address-book"></i>
                  <p>Creacion de Roles</p>
                </a>
              </li> -->
            </ul>
          </li>

          <?php 
                    $esto4 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Categoria"){
                      $esto4 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto4==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="nav-icon fas fa-tags" ></i>
              <p>
                Categorias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../categorias/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado Categorias</p>
                </a>
              </li>
            </ul>
          </li>

          <?php 
                    $esto5 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Almacen"){
                      $esto5 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto5==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >

            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="fa fa-store" ></i>
              <p>
                Almacen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../almacen/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado de Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../almacen/create.php" class="nav-link">
                  <i class="fa fa-plus-circle"></i>
                  <p>Creacion de Productos</p>
                </a>
              </li>
            </ul>
          </li>

          <?php 
                    $esto6 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Compras"){
                      $esto6 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto6==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="fas fa-shopping-cart" ></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../compras/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado de Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../compras/create.php" class="nav-link">
                  <i class="fas fa-cart-plus"></i>
                  <p>Creacion de Compras</p>
                </a>
              </li>
            </ul>
          </li>

          <?php 
                    $esto7 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Proveedores"){
                      $esto7 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto7==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
          
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="fa fa-truck" ></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../proveedores/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado de Proveedores</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="<?php echo $URL;?>../../proveedores/create.php" class="nav-link">
                  <i class="fa fa-plus-circle"></i>
                  <p>Creacion Proveedores</p>
                </a>
              </li> -->
            </ul>
          </li>

          <?php 
                    $esto8 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Pedido"){
                      $esto8 = "1";
                  }   
                } 
                ?> 
                
          <li class="nav-item" <?php  if ($esto8==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <a href="#" class="nav-link" style="background-color: #0000ff">
              <i class="nav-econ fas fa-shopping-basket" ></i>
              <p>
                Pedido
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../ventas/index.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Listado Pedido</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>../../pedidos/create.php?pedido=0" class="nav-link">
                  <i class="fa fa-plus-circle"></i>
                  <p>Realizar Pedido</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo $URL;?>/controlador/login/cerrar_session.php" class="nav-link" style="background-color: #ca0a0b">
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
