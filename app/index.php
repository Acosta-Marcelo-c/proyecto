
<?php
include('pdoconfig.php');
include ('config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('controlador/usuarios/listado_usuarios.php');
include ('controlador/roles/listado_roles.php');
include ('controlador/categorias/listado_categorias.php');
include ('controlador/almacen/listado_productos.php');
include ('controlador/proveedores/listado_proveedores.php');
include ('controlador/compras/listado_compras.php');
include ('controlador/venta/listado_venta.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Bienvenidos Sistema de Ventas <?php echo $rol_session;?>.</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <?php
             $sql_mod="SELECT modu.mod_Nombre FROM rol_mod as rolMod 
                  INNER JOIN modulo as modu ON ROLMod.id_mod = modu.id_mod WHERE id_Rol = $rol_id";
                  
                  $query_mod=$pdo->prepare($sql_mod);
                  $query_mod->execute();
                  $mod_datos=$query_mod->fetchAll(PDO::FETCH_ASSOC);

              foreach($mod_datos as $mod_dato){
                    $mod_nombre=$mod_dato['mod_Nombre'];
                     // echo $mod_nombre,'/';
                  }  ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">


Contenido del sistema
      <!-- /.row -->
<br>
<br>
<div class="row">
                <?php 
                    $esto1 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Usuario"){
                      $esto1 = "1";
                  }   
                } 
                ?> 
          <!-- ./col -->
          <div class="col-lg-3 col-6" <?php  if ($esto1==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">

                <?php
                $contador_de_usuarios =0;
                foreach ($usuarios_datos as $usuarios_dato) {
                $contador_de_usuarios= $contador_de_usuarios+1;
                }
                ?>
                <h3><?php echo $contador_de_usuarios;?></h3>

                <p>Usuarios Registrados</p>
              </div>
                  <a href="<?php echo $URL;?>/../usuarios/create.php">
                    <div class="icon">
                      <i class="fas fa-user-plus"></i>
                    </div>
                  </a>
              <a href="<?php echo $URL;?>/../usuarios/index.php" class="small-box-footer">
                Mas Detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <?php 
                    $esto2 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Roles"){
                      $esto2 = "1";
                  }   
                } 
                ?> 
          <div class="col-lg-3 col-6" <?php  if ($esto2==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?> >
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">

                <?php
                $contador_de_roles =0;
                foreach ($rol_datos as $rol_dato) {
                $contador_de_roles= $contador_de_roles+1;
                }
                ?>
                <h3><?php echo $contador_de_roles;?></h3>

                <p>Roles registrados</p>
              </div>
                  <a href="<?php echo $URL;?>/../roles/create.php">
                    <div class="icon">
                      <i class="fas fa-address-card"></i>
                    </div>
                  </a>
              <a href="<?php echo $URL;?>/../roles/index.php" class="small-box-footer">
                Mas Detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <?php 
                  $esto3 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Categoria"){
                      $esto3 = "1";
                  }   
                } 
                ?> 
          <div class="col-lg-3 col-6" <?php  if ($esto3==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?>>
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $contador_de_categorias =0;
                foreach ($categorias_datos as $categorias_dato) {
                $contador_de_categorias= $contador_de_categorias+1;
                }
                ?>
                <h3><?php echo $contador_de_categorias;?><sup style="font-size: 20px"></sup></h3>

                <p>Categorias Registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-tags"></i>
              </div>
              <a href="<?php echo $URL;?>/../categorias/index.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- ./col -->
          <?php 
                    $esto4 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Almacen"){
                      $esto4 = "1";
                  }   
                } 
                ?>
          <div class="col-lg-3 col-6"<?php  if ($esto4==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?>>
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <?php
                $contador_de_productos =0;
                foreach ($producto_datos as $producto_dato) {
                $contador_de_productos= $contador_de_productos+1;
                }
                ?>
                <h3><?php echo $contador_de_productos;?><sup style="font-size: 20px"></sup></h3>

                <p>Productos Registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-store"></i>
              </div>
              <a href="<?php echo $URL;?>/../almacen/index.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- ./col -->
          <?php 
                    $esto5 =0;
                  foreach($mod_datos as $mod_dato){
                    $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
                    if($mod_nombre1=="Proveedores"){
                      $esto5 = "1";
                  }   
                } 
                ?> 
          <div class="col-lg-3 col-6" <?php  if ($esto5==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?>>
            <!-- small card -->
            <div class="small-box bg-dark">
              <div class="inner">
                <?php
                $contador_de_proveedor =0;
                foreach ($proveedor_datos as $proveedor_dato) {
                $contador_de_proveedor= $contador_de_proveedor+1;
                }
                ?>
                <h3><?php echo $contador_de_proveedor;?><sup style="font-size: 20px"></sup></h3>

                <p>Proveedores Registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-truck"></i>
              </div>
              <a href="<?php echo $URL;?>/../proveedores/index.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
<!-- ./col -->

<!-- ./col -->
      <?php 
         $esto6 =0;
          foreach($mod_datos as $mod_dato){
          $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
          if($mod_nombre1=="Compras"){
           $esto6 = "1";
                  }   
                } 
        ?>
<div class="col-lg-3 col-6"<?php  if ($esto6==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?>>
  <!-- small card -->
  <div class="small-box bg-danger">
    <div class="inner">
      <?php
      $contador_de_proveedor =0;
      foreach ($compras_datos as $compras_dato) {
      $contador_de_proveedor= $contador_de_proveedor+1;
      }
      ?>
      <h3><?php echo $contador_de_proveedor;?><sup style="font-size: 20px"></sup></h3>

      <p>Compras Registradas</p>
    </div>
    <div class="icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    <a href="<?php echo $URL;?>/../compras/index.php" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<!-- ./col -->

<!-- ./col -->
        <?php 
          $esto7 =0;
           foreach($mod_datos as $mod_dato){
            $mod_nombre1=$mod_dato['mod_Nombre'];
                                 
            if($mod_nombre1=="Pedido"){
            $esto7 = "1";
            }   
           } 
        ?> 
<div class="col-lg-3 col-6"<?php  if ($esto7==1){
                  echo "";
                }else {echo "hidden";}
                  
                ?>>
  <!-- small card -->
  <div class="small-box bg-secondary">
    <div class="inner">
      <?php
      $contador_de_venta =0;
      foreach ($ventas_datos as $ventas_dato) {
      $contador_de_venta= $contador_de_venta+1;
      }
      ?>
      <h3><?php echo $contador_de_venta;?><sup style="font-size: 20px"></sup></h3>

      <p>Ventas Registradas</p>
    </div>
    <div class="icon">
      <i class="nav-econ fas fa-shopping-basket"></i>
    </div>
    <a href="<?php echo $URL;?>/../ventas/index.php" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<!-- ./col -->




    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include ('../layout/parte2.php');
 ?>
