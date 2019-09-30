<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));
  $eliminadoPor = htmlentities(addslashes($_POST['eliminadoPor']));
  $timeAt = date('Y-m-d H:i:s');

  $eliminadoPor = html_entity_decode($eliminadoPor, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  $sql = 'SELECT * FROM clase
  WHERE claveAcceso = :claveAcceso AND eliminado != true';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->execute();
  if($resultado->execute()) {
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
      /*$sql = 'DELETE FROM clase
      WHERE claveAcceso = :claveAcceso';*/
      $sql = 'UPDATE clase SET eliminado = true, eliminadoPor = :ep, updatedAt = :uat
      WHERE claveAcceso = :ca';

      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':ep' => $eliminadoPor,
        ':uat' => $timeAt,
        ':ca' => $claveAcceso
      );
      $resultado->execute($array);
      echo 'success';
    } else {
      echo 'Error. No existe la clase o ya esta inactiva.';
    }
  } else {
    echo 'Error. No se pudo comprobar la clase que se desea eliminar.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
