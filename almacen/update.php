<?php
include('../app/pdoconfig.php');
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controlador/almacen/cargar_productos.php');
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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Actualizacion de nuevo producto</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Actualizacion del producto:  <?php echo $nombre?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-dody" style="display: block;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-12">
                    <form action="../app/controlador/almacen/update_almacen.php" method="post" enctype="multipart/form-data">
                      <input type="text" value="<?php echo $id_almacen;?>" name="id_almacen" hidden/>
                      <div class="row">
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Codigo</label>

                                <input type="text" class="form-control" id=""
                                value="<?php echo $codigo;?>" disabled>

                                <input type="text" class="form-control" name="codigo"
                                value="<?php echo $codigo;?>" hidden>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Categoria del producto:</label>
                                <div  style="display: flex">
                                  <select name="id_categoria"  class="form-control" required>
                                    <?php
                                    foreach ($categorias_datos as $categorias_dato) {
                                      $nombre_categoria_tabla = $categorias_dato['cat_Nombre'];
                                      $id_categoria = $categorias_dato['id_Categoria'];
                                      ?>
                                      <option value="<?php echo $id_categoria;?>"<?php if ($nombre_categoria_tabla ==$Nombre_categoria) {?> selected="select" <?php } ?>>
                                        <?php echo $nombre_categoria_tabla;?>
                                      </option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Nombre del producto:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>" placeholder="" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Usuario</label>
                                <input type="text" class="form-control" id="" value="<?php echo $email;?>" disabled>
                                <input type="text" name="id_usuario" value="<?php echo $id_persona;?>" hidden>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="">Descripcion del producto:</label>
                                <textarea name="descripcion" rows="2" cols="30" class="form-control"><?php echo $decripcion;?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock:</label>
                                <input type="number" name="stock"  value="<?php echo $stock ?>" class="form-control" id="" placeholder="" >
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock minimo:</label>
                                <input type="number" name="stock_minimo" class="form-control" value="<?php echo $stock_minimo; ?>" id="" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Stock maximo:</label>
                                <input type="number" name="stock_maximo" class="form-control" id="" placeholder=""value="<?php echo $stock_maximo; ?>">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Compra:</label>
                                <input type="number" name="precio_compra" class="form-control" id="" placeholder="" value="<?php echo $precio_compra; ?>">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Precio Venta:</label>
                                <input type="number" name="precio_venta" class="form-control" id="" placeholder="" value="<?php echo $precio_venta; ?>">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">fecha Ingreso:</label>
                                <input type="date" name="fecha_ingreso" value="<?php echo $fecha_ingreso?>" class="form-control" id="" placeholder="" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Imagen del producto</label>
                            <input type="file"  name="imagen" class="form-control" id="file">
                            <input type="text"  name="imagen_text" value="<?php echo $imagen;?>" hidden>
                            <br>
                            <output id="list" style="text-align: center;">
                            <img src="<?php echo  "img_productos/".$imagen?>"  width="180px" alt="asdf" />
                            </output>
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
                        <button  type="submit" class="btn btn-success">Actualizar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.card-tools -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
include ('../layout/parte2.php');
?>
