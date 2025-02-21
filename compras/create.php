<?php
include('../app/pdoconfig.php');
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controlador/almacen/listado_productos.php');
include('../app/controlador/proveedores/listado_proveedores.php');
include('../app/controlador/proveedores/listado_proveedor_act.php');
include('../app/controlador/compras/listado_compras.php');

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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Registro de nueva compra</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->



  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-9">
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
                <hr />
                <div style="display: flex">
                  <h5>Datos del producto</h5>
                  <div style="width: 20px"></div>
                  <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modal-buscar_produto">
                    <i class="fa fa-search"></i>
                    Buscar Producto
                  </button>
                  <!--/ modal para mostrar producto -->
                  <div class="modal fade" id="modal-buscar_produto">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #1d36b6; color: white">
                          <h4 class="modal-title">Busqueda del Producto: </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                          </button>
                        </div>
                        <div class="modal-body ">
                          <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                              <tr>
                                <th>Nro</th>
                                <th>Codigo</th>
                                <th>Seleccionar</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                                <th>Precio Venta</th>
                                <th>Fecha compra</th>
                                <!--<th>Usuario</th>-->
                              </tr>
                              <tbody>
                                <?php
                                $contador = 0;
                                foreach ($producto_datos as $producto_dato) {
                                  $id_Almacen = $producto_dato['id_Almacen'];
                                ?>
                                  <tr>
                                    <td> <?php echo $contador = $contador + 1; ?></td>
                                    <td> <?php echo $producto_dato['alm_Codigo']; ?></td>
                                    <td>
                                      <button class="btn btn-info" id="btn_seleccionar<?php echo $id_Almacen; ?>">
                                        Seleccionar
                                      </button>
                                      <script>
                                        $('#btn_seleccionar<?php echo $id_Almacen; ?>').click(function() {

                                          var id_producto = "<?php echo $id_Almacen; ?>";
                                          $('#id_producto').val(id_producto);
                                          var codigo1 = "<?php echo $producto_dato['alm_Codigo']; ?>";
                                          $(' #codigo').val(codigo1);
                                          var categoria = "<?php echo $producto_dato['cat_Nombre']; ?>";
                                          $('#categoria').val(categoria);
                                          var nombre = "<?php echo $producto_dato['alm_Nombre']; ?>";
                                          $('#nombre_producto').val(nombre);
                                          var usuario = "<?php echo $producto_dato['per_Correo']; ?>";
                                          $('#usuario_producto').val(usuario);
                                          var descripcion = "<?php echo $producto_dato['alm_Descripcion']; ?>";
                                          $('#descripcion_producto').val(descripcion);
                                          var stock = "<?php echo $producto_dato['alm_Stock']; ?>";
                                          $('#stock').val(stock);
                                          $('#stock_actual').val(stock);

                                          var stock_minimo = "<?php echo $producto_dato['alm_StockMinimo']; ?>";
                                          $('#stock_minimo').val(stock_minimo);
                                          var stock_maximo = "<?php echo $producto_dato['alm_StokMaximo']; ?>";
                                          $('#stock_maximo').val(stock_maximo);
                                          var precio_compra = "<?php echo $producto_dato['alm_PrecioCompra']; ?>";
                                          $('#precio_compra').val(precio_compra);
                                          var precio_venta = "<?php echo $producto_dato['alm_PrecioVenta']; ?>";
                                          $('#precio_venta').val(precio_venta);
                                          var fecha_ingreso = "<?php echo $producto_dato['alm_FechaIngreso']; ?>";
                                          $('#fecha_ingreso').val(fecha_ingreso);

                                          var fecha_ingreso = "<?php echo $producto_dato['alm_FechaIngreso']; ?>";
                                          $('#fecha_ingreso').val(fecha_ingreso);

                                          var ruta_img = "<?php echo  "../almacen/img_productos/" . $producto_dato['alm_Imagen'] ?>";
                                          $('#imagen_producto').attr({
                                            src: ruta_img
                                          });

                                          $('#modal-buscar_produto').modal('toggle');
                                        });
                                      </script>
                                    </td>
                                    <td> <?php echo $producto_dato['cat_Nombre']; ?></td>
                                    <td>
                                      <img src="<?php echo  "../almacen/img_productos/" . $producto_dato['alm_Imagen'] ?>" width="50px" alt="asdf" />
                                    </td>
                                    <td> <?php echo $producto_dato['alm_Nombre']; ?></td>
                                    <td> <?php echo $producto_dato['alm_Descripcion']; ?></td>
                                    <td> <?php echo $producto_dato['alm_Stock']; ?></td>
                                    <td> <?php echo $producto_dato['alm_PrecioVenta']; ?></td>
                                    <td> <?php echo $producto_dato['alm_FechaIngreso']; ?></td>
                                    <!--<td> <?php echo $producto_dato['per_Correo']; ?></td>-->
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  <h5>Datos del proveedor</h5>
                  <div style="width: 20px"></div>
                  <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modal-buscar_proveedor">
                    <i class="fa fa-search"></i>
                    Buscar proveedor
                  </button>
                  <!--/ modal buscar proveedores -->
                  <div class="modal fade" id="modal-buscar_proveedor">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #1d36b6; color: white">
                          <h4 class="modal-title">Busqueda del Producto: </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                          </button>
                        </div>
                        <div class="modal-body ">
                          <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                              <tr>
                                <th>Nro</th>
                                <th>Seleccionar</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Ruc</th>

                              </tr>
                              <tbody>
                                <?php
                                $contador = 0;
                                foreach ($proveedor_act_datos as $proveedor_act_dato) {
                                  $id_Proveedor = $proveedor_act_dato['id_Proveedor'];
                                  $nombre_Proveedor = $proveedor_act_dato['pro_Nombre'];
                                  $telefono_Proveedor = $proveedor_act_dato['pro_Telefono'];
                                ?>
                                  <tr>
                                    <td> <?php echo $contador = $contador + 1; ?></td>
                                    <td> <button class="btn btn-info" id="btn_seleccionar_proveedor<?php echo $id_Proveedor; ?>">
                                        Seleccionar
                                      </button>
                                      <script>
                                        $('#btn_seleccionar_proveedor<?php echo $id_Proveedor; ?>').click(function() {

                                          var id_proveedor = "<?php echo $id_Proveedor; ?>";
                                          $('#id_provee').val(id_proveedor);
                                          var nombre_proveedor = "<?php echo $nombre_Proveedor; ?>";
                                          $('#nombre_pro').val(nombre_proveedor);
                                          var celular = "<?php echo $proveedor_act_dato['pro_Celular']; ?>";
                                          $('#celular_pro').val(celular);
                                          var telefono = "<?php echo $proveedor_act_dato['pro_Telefono']; ?>";
                                          $('#telefono_pro').val(telefono);
                                          var ruc = "<?php echo $proveedor_act_dato['pro_Ruc']; ?>";
                                          $('#ruc_pro').val(ruc);
                                          var email = "<?php echo $proveedor_act_dato['pro_Email']; ?>";
                                          $('#email_pro').val(email);
                                          var direccion = "<?php echo $proveedor_act_dato['pro_Direccion']; ?>";
                                          $('#direccion_pro').val(direccion);
                                          $('#modal-buscar_proveedor').modal('toggle');
                                        });
                                      </script>
                                    </td>
                                    <td> <?php echo $proveedor_act_dato['pro_Nombre']; ?></td>
                                    <td> <?php echo $proveedor_act_dato['pro_Direccion']; ?></td>
                                    <td>
                                      <a href="https://wa.me/593<?php echo $proveedor_act_dato['pro_Celular']; ?>" target="-_blank">
                                        <i class="fa fa-phone"><?php echo $proveedor_act_dato['pro_Celular']; ?></i>
                                      </a>
                                    </td>
                                    <td> <?php echo $proveedor_act_dato['pro_Email']; ?></td>
                                    <td> <?php echo $proveedor_act_dato['pro_Ruc']; ?></td>


                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
              </div>
              <hr />
              <div class="row" style="font-size: 12px">
                <div class="col-md-9">
                  <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" id="id_producto" hidden>
                        <label for="">Codigo:</label>
                        <input type="text" class="form-control" id="codigo" disabled>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Categoria del producto:</label>
                        <div style="display: flex">
                          <input type="text" class="form-control" id="categoria" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Nombre del producto:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre_producto" disabled>
                      </div>
                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Usuario</label>
                        <input type="text" class="form-control" id="usuario_producto" disabled>

                      </div>

                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="">Descripcion del producto:</label>
                        <textarea name="descripcion" id="descripcion_producto" rows="2" cols="30" class="form-control" disabled></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Stock:</label>
                        <input type="number" name="stock" class="form-control" placeholder="" id="stock" style="background-color: #fff819" disabled>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Stock Min:</label>
                        <input type="number" name="stock_minimo" class="form-control" id="stock_minimo" disabled>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Stock Max:</label>
                        <input type="number" name="stock_maximo" class="form-control" id="stock_maximo" disabled>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Precio Com:</label>
                        <input type="number" name="precio_compra" class="form-control" id="precio_compra" disabled>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Precio Ven:</label>
                        <input type="number" name="precio_venta" class="form-control" id="precio_venta" disabled>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Fecha Ingreso:</label>
                        <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Imagen del producto</label>
                    <center>
                      <img src=" <?php echo  "img_productos/" . $imagen ?>" id="imagen_producto" width="50%" alt="">
                    </center>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="modal-buscar_proveedor">
                Proveedor
              </button>
              <div class="container-fluid" style="font-size: 12px">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" id="id_provee" hidden>
                      <label for="">Nombre Proveedor:</label>
                      <input type="text" class="form-control" id="nombre_pro" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Celular:</label>
                      <div style="display: flex">
                        <input type="text" class="form-control" id="celular_pro" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Telefono:</label>
                      <input type="text" class="form-control" name="nombre" id="telefono_pro" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">RUC:</label>
                      <input type="text" class="form-control" id="ruc_pro" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">email:</label>
                      <input type="text" class="form-control" id="email_pro" disabled>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Direccion:</label>
                      <textarea name="descripcion" id="direccion_pro" rows="2" cols="30" class="form-control" disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">datos</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <?php
                        $contador_compras = 1;
                        foreach ($compras_datos as $compras_datos) {
                          $contador_compras = $contador_compras + 1;
                        }
                        ?>
                        <label for="">numero de compra</label>
                        <input type="text" value="<?php echo $contador_compras ?>" class="form-control" style="text-align: center" disabled>
                        <input value="<?php echo $contador_compras ?>" id="nro_compra" hidden>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">fecha de compra</label>
                        <input type="date" class="form-control" id="fecha_compra">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Comprovante de compra</label>
                        <input type="text" class="form-control" id="comprovante">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">precio compra</label>
                        <input type="number" class="form-control" id="precio_com">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Stock actual</label>
                        <input type="text" style="background-color: #fff819" id="stock_actual" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Stock total</label>
                        <input type="text" id="stock_total" style="text-align: center" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Cantidad de compra</label>
                        <input type="number" id="cantidad_compra" style="text-align: center" class="form-control">
                      </div>
                      <script>
                        $('#cantidad_compra').keyup(function() {
                          //alert('holas');
                          var stock_actual = $('#stock_actual').val();
                          var stock_compra = $('#cantidad_compra').val();

                          var total = parseInt(stock_actual) + parseInt(stock_compra);
                          $('#stock_total').val(total);
                        });
                      </script>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Usuario</label>
                        <input type="text" value="<?php echo $email_session ?>" class="form-control" disabled>
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block" id="btn_guardar_compra">Guardar Compra </button>
                      </div>
                    </div>
                    <script>
                      $('#btn_guardar_compra').click(function() {
                        var id_prod = $('#id_producto').val();
                        var nro_compra = $('#nro_compra').val();
                        var fecha_compra = $('#fecha_compra').val();
                        var id_provee = $('#id_provee').val();
                        var comprovante = $('#comprovante').val();
                        var id_usuario = '<?php echo $id_usuario_session ?>';
                        var precio_compra = $('#precio_com').val();
                        var cantidad_compra = $('#cantidad_compra').val();
                        var stock_total = $('#stock_total').val();
                        alert(stock_total);
                        if (id_prod == "") {
                          $('#id_producto').focus();
                          alert('debe escojer un producto');
                        } else if (id_provee == "") {
                          $('#id_provee').focus();
                          alert('debe escojer el proveedor');
                        } else if (fecha_compra == "") {
                          $('#fecha_compra').focus();
                          alert('debe escojer la fecha');
                        } else if (comprovante == "") {
                          $('#comprovante').focus();
                          alert('debe llenar el tipo de comprovante');
                        } else if (precio_compra == "") {
                          $('#precio_com').focus();
                          alert('debe llenar el precio total de compra');
                        } else if (cantidad_compra == "") {
                          $('#cantidad_compra').focus();
                          alert('debe llenar la cantidad de compra');
                        } else {

                          var url = "../app/controlador/compras/create.php";
                          $.get(url, {
                            nro_Compra: nro_compra,
                            id_Almacen: id_prod,
                            com_Fecha: fecha_compra,
                            id_Proveedor: id_provee,
                            com_Comprobante: comprovante,
                            id_pers: id_usuario,
                            com_Precio: precio_compra,
                            com_Cantidad: cantidad_compra,
                            stock_Total: stock_total
                          }, function(datos) {
                            $('#respuesta_create').html(datos);
                          });
                        }

                      });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="respuesta_create">

    </div>
  </div>

</div>


<?php
include('../layout/parte2.php');
?>