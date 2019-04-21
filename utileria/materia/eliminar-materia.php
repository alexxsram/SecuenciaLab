<?php
include('../operaciones/conexion.php');
try {
    $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));

    $sql = 'SELECT * FROM clase WHERE claveAcceso = :claveAcceso';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':claveAcceso', $claveAcceso);
    $resultado->execute();
    if($resultado->execute()) {
      $numRow = $resultado->rowCount();
      if($numRow == 1) {
        $sql = 'DELETE FROM clase WHERE claveAcceso = :claveAcceso';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':claveAcceso', $claveAcceso);
        $resultado->execute();
        echo 'success';
      } else {
        echo 'Error. No existe la clase.';
      }
    } else {
      echo 'Error. No se pudo comprobar la clase que se desea eliminar.';
    }




} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
