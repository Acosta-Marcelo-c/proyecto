<?php
include ('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria =$_GET['id_categoria'];
$fecha=$fechaHora;

 $sentencia = $pdo->prepare("UPDATE categoria SET
      cat_Nombre=:nombre_categoria,
      cat_FechaActualizacion=:fecha
      WHERE id_Categoria=:id_categoria");

     $sentencia->bindParam('id_categoria', $id_categoria);
     $sentencia->bindParam('nombre_categoria', $nombre_categoria);
     $sentencia->bindParam('fecha', $fecha);

     if ($sentencia->execute()) {
       session_start();
       $_SESSION['mensaje']="El ROL SE ACTUALIZO CORRECTAMENTE";
       //header('Location: '.$URL.'/../roles/index.php');
       ?>
       <script>

         location.href="<?php echo $URL;?>/../categorias";
       </script>

       <?php
     }else {
       session_start();
       $_SESSION['mensaje']="ERROR ENLA ACTUALIZACION";
      // header('Location: '.$URL.'../../roles/update.php?id='.$id_usuario);
      ?>
      <script>

        location.href="<?php echo $URL;?>/../categorias";
      </script>

      <?php
     }




 ?>
