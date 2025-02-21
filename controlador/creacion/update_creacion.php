
<?php
include ('../../config.php');

$id_mod =$_POST['id_mod_actu'];
$nombre =$_POST['nombre_mod_actu'];
$estado =$_POST['estado_mod_actu'];
$descripcion =$_POST['descripcion_mod_actu'];
$fecha=$fechaHora;

 $sentencia = $pdo->prepare("UPDATE modulo SET
      mod_Nombre=:nombre, mod_Descripcion=:descripcion, mod_Estado=:estado,
      mod_fecha=:fecha
      WHERE id_mod=:id");

     $sentencia->bindParam('id', $id_mod);
     $sentencia->bindParam('nombre', $nombre);
     $sentencia->bindParam('descripcion', $descripcion);
     $sentencia->bindParam('estado', $estado);
     $sentencia->bindParam('fecha', $fecha);

     if ($sentencia->execute()) {
       session_start();
       $_SESSION['mensaje']="El MODULO SE ACTUALIZO CORRECTAMENTE";
       
       ?>
       <script>

         location.href="<?php echo $URL;?>/../creacion/index.php";
       </script>

       <?php
     }else {
       session_start();
       $_SESSION['mensaje']="ERROR EN LA ACTUALIZACION";
       

       ?>
       <script>

         location.href="<?php echo $URL;?>/../creacion/index.php";
       </script>

       <?php
     }

 ?>