<?php
include('../operaciones/conexion.php');

try {
  $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $cadena_base .= '0123456789';
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
  $anio = htmlentities(addslashes($_POST['anoClase']));
  $anoClase = substr($anio, 0, 4);
  $cicloEscolarClase = htmlentities(addslashes($_POST['cicloEscolarClase']));
  $codigoProfesorClase = htmlentities(addslashes($_POST['codigoProfesorClase']));

  //Convertir elementos de texto en codificación UTF-8
  $nombreClase = html_entity_decode($nombreClase, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $nrcClase = html_entity_decode($nrcClase, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $seccionClase = html_entity_decode($seccionClase, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $materiaClase = html_entity_decode($materiaClase, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $cicloEscolarClase = html_entity_decode($cicloEscolarClase, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $codigoProfesorClase = html_entity_decode($codigoProfesorClase, ENT_QUOTES | ENT_HTML401, "UTF-8");

  //Convertir información de cadena a mayusculas
  $nombreClase = mb_strtoupper($nombreClase,'UTF-8');
  $materiaClase = mb_strtoupper($materiaClase,'UTF-8');

  $sql = 'SELECT * FROM clase WHERE claveAcceso = :claveAcceso';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAccesoClase);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow == 0) {
    $sql = 'INSERT INTO clase (claveAcceso, nombreMateria, nrc, claveSeccion, nombreClase, aula, anio, CicloEscolar_idCicloEscolar, ProfesorUsuario_codigoProfesor) VALUES (:ca, :nm, :n, :cs, :nc, :a, :y, :ce, :pucp)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':ca'=>$claveAccesoClase, ':nm'=>$materiaClase, ':n'=>$nrcClase, ':cs'=>$seccionClase, ':nc'=>$nombreClase, ':a'=>$aulaClase, ':y'=>$anoClase, ':ce'=>$cicloEscolarClase, ':pucp'=>$codigoProfesorClase);
    $resultado->execute($array);
    echo 'success';
  } else {
    echo 'Error. La clase no se pudo crear intentelo de nuevo.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
