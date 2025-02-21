<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


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
          <h1 class="m-0">Registro de nueva empresa o sucursal</h1>
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
              <h3 class="card-title">Creacion </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-dody" style="display: block;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-12">
                    <form action="../app/controlador/parametros/create_parametros.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">RUC:</label>
                                <input type="number" class="form-control" name="ruc" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Correo:</label>
                                <input type="email" class="form-control" name="correo" placeholder="" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="number" class="form-control" name="telefono" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="">Direccion:</label>
                                <textarea name="direccion" rows="1" cols="100" class="form-control"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="">Descripcion:</label>
                                <textarea name="descripcion" rows="1" cols="100" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Tiempo de recuperacion de usuario :</label>
                                <input type="number" name="hora" class="form-control" id="" placeholder="" min="1" max="10" value="2" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Stock Minimo:</label>
                                <input type="number" name="stock_min" class="form-control" id="" placeholder="" min="1" value="1" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Stock Maximo:</label>
                                <input type="number" name="stock_max" class="form-control" id="" placeholder="" min="1" value="1" required>
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
                                      document.getElementById("list").innerHTML = ['<img class"trum thumbnail" src="', e.target.result, '" width="50%" tiles="', escape(theFile.name), '"/>'].join('');
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