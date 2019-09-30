<?php
include('../operaciones/conexion.php');
try {
  $idComentario = htmlentities(addslashes($_POST['idComentario']));

  $sql = 'SELECT *
  FROM comentario
  WHERE idComentario = :ic';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':ic', $idComentario);
  $resultado->execute();
  if($resultado->execute()) {
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
      $sql = 'DELETE FROM comentario
      WHERE idComentario = :ic';
      $resultado = $baseDatos->prepare($sql);
      $resultado->bindValue(':ic', $idComentario);
      $resultado->execute();
      echo 'success';
    } else {
      echo 'Error. No existe el ID del comentario.';
    }
  } else {
    echo 'Error. No se pudo comprobar el comentario que se desea eliminar.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
