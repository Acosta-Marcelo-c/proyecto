<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/almacen/listado_productos.php');

// Obtener todas las categorías
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);

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
          <h1 class="m-0">
            <a href="create.php">
              <button type="button" class="btn btn-primary">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Nuevo Producto
              </button>
            </a>
          </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline cart-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list-alt" aria-hidden="true"></i> <b>LISTA DE PRODUCTOS</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <!-- Filtro por categoría -->
              <form method="GET" action="">
                <div class="form-group">
                  <label for="categoria">Filtrar por Categoría:</label>
                  <select name="categoria" id="categoria" class="form-control">
                    <option value="">Todas las Categorías</option>
                    <?php foreach ($categorias as $categoria) { ?>
                      <option value="<?php echo $categoria['id_Categoria']; ?>" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id_Categoria']) echo 'selected'; ?>>
                        <?php echo $categoria['cat_Nombre']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
              </form>
              <br>
              <!--<div class="table table-responsive" >-->
              <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                <tr>
                  <th>Nro</th>
                  <th>Codigo</th>
                  <th>Categoria</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Precio Venta</th>
                  <th>Estado</th>
                  <th>Usuario</th>
                  <th>Acciones</th>
                </tr>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($producto_datos as $producto_dato) {
                    // Filtrar por categoría si se seleccionó una
                    if (isset($_GET['categoria']) && $_GET['categoria'] != '' && $producto_dato['id_Categoria'] != $_GET['categoria']) {
                      continue;
                    }

                    $id_Almacen = $producto_dato['id_Almacen']; ?>

                    <tr>
                      <td> <?php echo $contador = $contador + 1; ?></td>
                      <td> <?php echo $producto_dato['alm_Codigo']; ?></td>
                      <td> <?php echo $producto_dato['cat_Nombre']; ?></td>
                      <td>
                        <img src="<?php echo  "img_productos/" . $producto_dato['alm_Imagen'] ?>" width="50px" alt="asdf" />

                        <!--<?php echo $URL . "../almacen/img_productos/" . $producto_dato['alm_Imagen'] ?>-->
                      </td>
                      <td> <?php echo $producto_dato['alm_Nombre']; ?></td>
                      <td> <?php echo $producto_dato['alm_Descripcion']; ?></td>
                      <?php
                      $stock_actual = $producto_dato['alm_Stock'];
                      $stock_minimo = $producto_dato['alm_StockMinimo'];
                      $stock_maximo = $producto_dato['alm_StokMaximo'];

                      //COLORES
                      if ($stock_actual > $stock_maximo) { ?>
                        <td style="background-color: #FFA07A"> <?php echo $producto_dato['alm_Stock']; ?></td>
                      <?php
                      } else if ($stock_actual < $stock_minimo) { ?>
                        <td style="background-color: #FFA07A"> <?php echo $producto_dato['alm_Stock']; ?></td>
                      <?php   } else { ?>
                        <td style="background-color: #98FB98"> <?php echo $producto_dato['alm_Stock']; ?></td>

                      <?php  } ?>

                      <td> <?php echo $producto_dato['alm_PrecioVenta']; ?></td>
                      <td> <?php echo $producto_dato['alm_Estado']; ?></td>
                      <td> <?php echo $producto_dato['per_Correo']; ?></td>


                      <td>
                        <center>
                          <a href="show.php?id=<?php echo $id_Almacen ?>"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</button></a>
                          <a href="update.php?id=<?php echo $id_Almacen ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Editar</button></a>
                          <a href="delete.php?id=<?php echo $id_Almacen ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button></a>
                        </center>
                      </td>

                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <!--</div>-->
            </div><!-- /.card-tools -->
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div><!-- /.content -->
</div><!-- /.content-wrapper -->



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