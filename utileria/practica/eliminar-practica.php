<?php
include('../operaciones/conexion.php');
try {
  $idPractica = htmlentities(addslashes($_POST['idPractica']));
  $sql = 'SELECT * FROM practica
  WHERE idPractica = :idPractica AND eliminado != true';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':idPractica', $idPractica);
  $resultado->execute();
  if($resultado->execute()) {
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
      /*$sql = 'DELETE FROM practica
      WHERE idPractica = :idPractica';*/
      $sql = 'UPDATE practica SET eliminado = true
      WHERE idPractica = :idPractica';
      $resultado = $baseDatos->prepare($sql);
      $resultado->bindValue(':idPractica', $idPractica);
      $resultado->execute();
      echo 'success';
    } else {
      echo 'Error. No existe el ID de la práctica.';
    }
  } else {
    echo 'Error. No se pudo comprobar la práctica que se desea eliminar.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
