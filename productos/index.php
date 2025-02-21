<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/almacen/listado_productos.php');

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
              <form method="GET" action="">
                <div class="form-group">
                  <label for="categoria">Seleccionar Categoría:</label>
                  <select name="categoria" id="categoria" class="form-control">
                    <option value="">Todas</option>
                    <?php
                    // Obtener categorías de la base de datos
                    $sql = "SELECT DISTINCT cat_Nombre FROM categoria";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categorias as $categoria) {
                      echo "<option value='{$categoria['cat_Nombre']}'>{$categoria['cat_Nombre']}</option>";
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
              </form>
              <br>
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
                  <th>Acciones</th>
                </tr>
                <tbody>
                  <?php
                  $contador = 0;
                  $categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                  foreach ($producto_datos as $producto_dato) {
                    if ($categoria_seleccionada == '' || $producto_dato['cat_Nombre'] == $categoria_seleccionada) {
                      $id_Almacen = $producto_dato['id_Almacen']; ?>

                      <tr>
                        <td> <?php echo $contador = $contador + 1; ?></td>
                        <td> <?php echo $producto_dato['alm_Codigo']; ?></td>
                        <td> <?php echo $producto_dato['cat_Nombre']; ?></td>
                        <td>
                          <img src="<?php echo  "../almacen/img_productos/" . $producto_dato['alm_Imagen'] ?>" width="80px" alt="asdf" />

                          <!--<?php echo $URL . "../almacen/img_productos/" . $producto_dato['alm_Imagen'] ?>-->
                        </td>
                        <td> <?php echo $producto_dato['alm_Nombre']; ?></td>
                        <td> <?php echo $producto_dato['alm_Descripcion']; ?></td>
                        <?php
                        $stock_actual = $producto_dato['alm_Stock'];
                        $stock_minimo = $producto_dato['alm_StockMinimo'];
                        $stock_maximo = $producto_dato['alm_StokMaximo'];

                        //STOCK COLORES
                        if ($stock_actual > $stock_maximo) { ?>
                          <td style="background-color: #FFA07A"> <?php echo $producto_dato['alm_Stock']; ?></td>
                        <?php
                        } else if ($stock_actual < $stock_minimo) { ?>
                          <td style="background-color: #FFA07A"> <?php echo $producto_dato['alm_Stock']; ?></td>
                        <?php   } else { ?>
                          <td style="background-color: #98FB98"> <?php echo $producto_dato['alm_Stock']; ?></td>

                        <?php  } ?>

                        <td> <?php echo $producto_dato['alm_PrecioVenta']; ?></td>

                        <td>
                          <center>
                            <a href="show.php?id=<?php echo $id_Almacen ?>"><button type="button" class="btn btn-info btn-md"><i class="fa fa-eye"></i> Ver</button></a>

                          </center>
                        </td>

                      </tr>
                  <?php
                    }
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