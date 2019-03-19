<?php
include('../operaciones/conexion.php');

try {
  // FALTA LA CLAVE DE ACCESO QUE NO SE CUAL ES
  $nombreClase = htmlentities(addslashes($_POST['nombreClase']));
  $nrcClase = htmlentities(addslashes($_POST['nrcClase']));
  $seccionClase = htmlentities(addslashes($_POST['seccionClase']));
  $materiaClase = htmlentities(addslashes($_POST['materiaClase']));
  $aulaClase = htmlentities(addslashes($_POST['aulaClase']));
  $anoClase = htmlentities(addslashes($_POST['anoClase']));
  $cicloEscolar = htmlentities(addslashes($_POST['cicloEscolarClase']));

  //echo 'console.log('. json_encode( $data ) .')';

  $sql = 'SELECT * FROM clase WHERE nrc = :nrc';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':nrc', $nrcClase);
  $resultado->execute();
  $numRow = $resultado->rowCount();

  if($numRow == 0) {
    $sql = 'INSERT INTO clase (claveAcceso, nombreMateria, nrc, claveSeccion, nombreClase, aula, anio, cicloEscolar) VALUES ()';
  } else {
    echo 'Error. La clase con el nrc ' . $nrcClase . ' ya existe.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
