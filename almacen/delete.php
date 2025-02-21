<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/almacen/cargar_productos.php');


if (isset($_SESSION['mensaje'])) {
  $respuesta = $_SESSION['mensaje']; ?>
  <script>
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: '<?php echo $respuesta; ?>',
      showConfirmButton: false,
      timer: 2000

    })
  </script>
<?php
  unset($_SESSION['mensaje']);
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Producto a ser eliminado: <?php echo $nombre ?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Datos del producto a ser eliminado</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-dody" style="display: block;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-12">
                    <form action="../app/controlador/almacen/delete_almacen.php" method="post" enctype="multipart/form-data">
                      <input type="text" name="id_almacen" value="<?php echo $id_almacen ?>" hidden>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Codigo:</label>
                                <input type="text" class="form-control" id="" value="<?php echo $codigo; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Categoria del producto:</label>
                                <div style="display: flex">
                                  <input type="text" class="form-control" id="" value="<?php echo $Nombre_categoria; ?>" disabled>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Nombre del producto:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" disabled>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Usuario</label>
                                <input type="text" class="form-control" id="" value="<?php echo $email_session; ?>" disabled>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_session; ?>" hidden>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="">Descripcion del producto:</label>
                                <textarea name="descripcion" rows="2" cols="30" class="form-control" disabled><?php echo $decripcion; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock:</label>
                                <input type="number" name="stock" class="form-control" placeholder="" value="<?php echo $stock; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock minimo:</label>
                                <input type="number" name="stock_minimo" class="form-control" value="<?php echo $stock_minimo; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock maximo:</label>
                                <input type="number" name="stock_maximo" class="form-control" value="<?php echo $stock_maximo; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Compra:</label>
                                <input type="number" name="precio_compra" class="form-control" value="<?php echo $precio_compra; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Venta:</label>
                                <input type="number" name="precio_venta" class="form-control" value="<?php echo $precio_venta; ?>" disabled>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">fecha Ingreso:</label>
                                <input type="date" name="fecha_ingreso" class="form-control" value="<?php echo $fecha_ingreso; ?>" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Imagen del producto</label>
                            <img src=" <?php echo  "img_productos/" . $imagen ?>" width="180px" alt="asdf">
                          </div>
                        </div>
                      </div>
                      <hr />
                      <div class="form-group">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-danger"><i class="fa fa-trash"></i>Borrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include('../layout/parte2.php');
?>