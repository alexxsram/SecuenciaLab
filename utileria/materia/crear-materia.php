<?php
include('../operaciones/conexion.php');

try {
  $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $cadena_base .= '0123456789';
  $cadena_base .= '!@#%^&*()_,./<>?;:[]{}\|=+';
  $limite = strlen($cadena_base) - 1;
  $claveAccesoClase = '';
  for($i=0; $i < 10; $i++) { 
    $claveAccesoClase .= $cadena_base[rand(0, $limite)];
  }
  $nombreClase = htmlentities(addslashes($_POST['nombreClase']));
  $nrcClase = htmlentities(addslashes($_POST['nrcClase']));
  $seccionClase = htmlentities(addslashes($_POST['seccionClase']));
  $materiaClase = htmlentities(addslashes($_POST['materiaClase']));
  $aulaClase = htmlentities(addslashes($_POST['aulaClase']));
  $anoClase = htmlentities(addslashes($_POST['anoClase']));
  $anoClase = substr($anoClase, 0, 4);
  $cicloEscolarClase = htmlentities(addslashes($_POST['cicloEscolarClase']));

  //echo 'console.log('. json_encode( $data ) .')';
  $sql = 'SELECT * FROM clase WHERE nrc = :nrc';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':nrc', $nrcClase);
  $resultado->execute();
  $numRow = $resultado->rowCount();

  if($numRow == 0) {
    $sql = 'INSERT INTO clase (claveAcceso, nombreMateria, nrc, claveSeccion, nombreClase, aula, anio, cicloEscolar) VALUES (:ca, :nm, :n, :cs, :nc, :a, :y, :ce)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':ca'=>$claveAccesoClase, ':nm'=>$nombreClase, ':n'=>$nrcClase, ':cs'=>$seccionClase, ':nc'=>$materiaClase, ':a'=>$aulaClase, ':y'=>$anoClase, ':ce'=>$cicloEscolarClase);
    $resultado->execute($array);
    echo 'success';
  } else {
    echo 'Error. La clase con el nrc ' . $nrcClase . ' ya existe.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
