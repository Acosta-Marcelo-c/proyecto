<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../app/controlador/almacen/listado_productos.php');
include('../app/controlador/categorias/listado_categorias.php');

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
          <h1 class="m-0">Registro de nuevo producto</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Creacion de Producto</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-dody" style="display: block;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-12">
                    <form action="../app/controlador/almacen/create_alamacen.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Codigo:</label>
                                <?php
                                function ceros($numero)
                                {
                                  $len = 0;
                                  $cantidad_ceros = 5;
                                  $aux = $numero;
                                  $pos = strlen($numero);
                                  $len = $cantidad_ceros - $pos;
                                  for ($i = 0; $i < $len; $i++) {
                                    $aux = "0" . $aux;
                                  }
                                  return $aux;
                                }
                                // Obtener ID máximo
                                $stmt = $pdo->prepare("SELECT MAX(id_Almacen) as max_id FROM almacen");
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $ultimo_id = $resultado['max_id'];

                                // Nuevo ID será el máximo + 1
                                $nuevo_id = $ultimo_id + 1;

                                ?>
                                <input type="text" class="form-control" id=""
                                  value="<?php echo "P-" . ceros($nuevo_id) ?>" disabled>

                                <input type="text" class="form-control" name="codigo"
                                  value="<?php echo "P-" . ceros($nuevo_id) ?>" hidden>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Categoria del producto:</label>
                                <div style="display: flex">
                                  <select name="id_categoria" class="form-control" required>
                                    <?php
                                    foreach ($categorias_datos as $categorias_dato) { ?>
                                      <option value="<?php echo $categorias_dato['id_Categoria']; ?>">
                                        <?php echo $categorias_dato['cat_Nombre']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                                  <a href="<?php echo $URL; ?>/../categorias/index.php" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Nombre del producto:</label>
                                <input type="text" class="form-control" name="nombre" placeholder="" required>
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
                                <textarea name="descripcion" rows="2" cols="30" class="form-control"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Ingreso Stock:</label>
                                <input type="number" id="stock" name="stock" class="form-control" min="0">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock minimo:</label>
                                <input type="number" name="stock_minimo" class="form-control" id="" placeholder="" value="<?php echo $stock_minimo; ?>" min="<?php echo $stock_minimo; ?>" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock maximo:</label>
                                <input type="number" name="stock_maximo" class="form-control" id="" value="<?php echo $stock_maximo; ?>" min="<?php echo $stock_minimo; ?>" max="<?php echo $stock_maximo; ?>" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="precio">Precio Compra:</label>
                                <input type="number"
                                  id="precio"
                                  name="precio_compra"
                                  class="form-control"
                                  min="0.1"
                                  step="0.01"
                                  placeholder="0.01"
                                  required>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="porcentaje">% de Ganancia:</label>
                                <input type="number"
                                  id="porcentaje"
                                  name="porcentaje"
                                  class="form-control"
                                  step="0.01"
                                  min="1"
                                  max="100"
                                  value="1"
                                  placeholder="1.0"
                                  required>
                              </div>
                            </div>

                            <script>
                              $(document).ready(function() {
                                function calcularPrecioVenta() {
                                  var precio = parseFloat($('#precio').val()) || 0;
                                  var porcentaje = parseFloat($('#porcentaje').val()) || 0;
                                  var total = precio + (precio * (porcentaje / 100));
                                  $('#precio_venta').val(total.toFixed(2));
                                }

                                $('#precio, #porcentaje').on('input', function() {
                                  calcularPrecioVenta();
                                });
                              });
                            </script>

                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="precio_venta">Precio Venta:</label>
                                <input type="number"
                                  id="precio_venta"
                                  name="precio_venta"
                                  class="form-control"
                                  step="0.01"
                                  placeholder="0.00"
                                  readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">fecha Ingreso: <?php echo $fechaHora; ?></label>
                                <input type="date" name="fecha_ingreso" class="form-control" id="" placeholder="" value="<?php echo $fechaHora; ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Imagen del producto</label>
                            <input type="file" name="imagen" class="form-control" id="file">
                            <br>
                            <output id="list"></output>
                            <script>
                              function archivo(evt) {
                                var files = evt.target.files; //Files object
                                //obtencion de la imagen de campo "file"
                                for (var i = 0, f; f = files[i]; i++) {
                                  //Solo se admite imagenes
                                  if (!f.type.match('image.*')) {
                                    continue;
                                  }
                                  var reader = new FileReader();
                                  reader.onload = (function(theFile) {
                                    return function(e) {
                                      //insertar imagen
                                      document.getElementById("list").innerHTML = ['<img class"trum thumbnail" src="', e.target.result, '" width="100%" tiles="', escape(theFile.name), '"/>'].join('');
                                    };
                                  })(f);
                                  reader.readAsDataURL(f);
                                }
                              }
                              document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                          </div>
                        </div>
                      </div>
                      <hr />
                      <div class="form-group">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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
<?php
include('../layout/parte2.php');
?>