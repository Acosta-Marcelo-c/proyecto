<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/almacen/listado_productos.php');
include ('../app/controlador/categorias/listado_categorias.php');

if (isset($_SESSION['mensaje'])) {
  $respuesta=$_SESSION['mensaje']; ?>
  <script>
    Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: '<?php  echo $respuesta;?>',
    showConfirmButton: false,
    timer:2000
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
                                    function ceros($numero){
                                      $len=0;
                                      $cantidad_ceros = 5;
                                      $aux=$numero;
                                      $pos=strlen($numero);
                                      $len=$cantidad_ceros-$pos;
                                      for ($i=0; $i <$len ; $i++) {
                                        $aux="0".$aux;
                                      }
                                      return $aux;
                                    }
                                    $contador_id_producto=1;
                                    foreach ($producto_datos as $producto_dato) {
                                      $contador_id_producto=$contador_id_producto+1;
                                    }
                                  ?>
                                <input type="text" class="form-control" id=""
                                  value="<?php echo "P-" .ceros($contador_id_producto)?>" disabled>

                                <input type="text" class="form-control" name="codigo"
                                  value="<?php echo "P-" .ceros($contador_id_producto)?>" hidden>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Categoria del producto:</label>
                                <div  style="display: flex">
                                  <select name="id_categoria"  class="form-control" required>
                                    <?php
                                      foreach ($categorias_datos as $categorias_dato) { ?>
                                        <option value="<?php echo $categorias_dato['id_Categoria'];?>">
                                          <?php echo $categorias_dato['cat_Nombre']; ?>
                                        </option>
                                    <?php } ?>
                                  </select>
                                  <a href="<?php echo $URL;?>/../categorias/index.php"  class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
                                <input type="text" class="form-control" id="" value="<?php echo $email_session;?>" disabled>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_session;?>" hidden>
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
                                <label for="">Stock:</label>
                                <input type="number" name="stock" class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock minimo:</label>
                                <input type="number" name="stock_minimo"class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock maximo:</label>
                                <input type="number" name="stock_maximo"class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Compra:</label>
                                <input type="number" name="precio_compra" class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Venta:</label>
                                <input type="number" name="precio_venta" class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">fecha Ingreso:</label>
                                <input type="date" name="fecha_ingreso" class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Imagen del producto</label>
                            <input type="file"  name="imagen" class="form-control" id="file">
                            <br>
                            <output id="list"></output>
                            <script>
                                function archivo(evt){
                                        var files = evt.target.files; //Files object
                                      //obtencion de la imagen de campo "file"
                                        for (var i = 0, f; f = files[i]; i++) {
                                        //Solo se admite imagenes
                                            if (!f.type.match('image.*')) {
                                              continue;
                                            }
                                              var reader = new FileReader();
                                              reader.onload = (function (theFile){
                                              return function (e){
                                              //insertar imagen
                                              document.getElementById("list").innerHTML = ['<img class"trum thumbnail" src="',e.target.result,'" width="100%" tiles="',escape(theFile.name), '"/>'].join('');
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
                        <button  type="submit" class="btn btn-primary">Guardar</button>
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
include ('../layout/parte2.php');
 ?>
