<?php
include('../operaciones/conexion.php');

try {
  $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $cadena_base .= '0123456789';
  $limite = strlen($cadena_base) - 1;
  $claveAcceso = '';
  for($i = 0; $i < 10; $i++) {
    $claveAcceso .= $cadena_base[rand(0, $limite)];
  }
  $claveAcceso = trim($claveAcceso);
  $nombreMateria = htmlentities(addslashes($_POST['materiaClase']));
  $nrc = htmlentities(addslashes($_POST['nrcClase']));
  $seccion = htmlentities(addslashes($_POST['seccionClase']));
  $nombreClase = htmlentities(addslashes($_POST['nombreClase']));
  $aula = htmlentities(addslashes($_POST['aulaClase']));
  $anio = htmlentities(addslashes($_POST['anioClase']));
  $anio = substr($anio, 0, 4);
  $eliminadoPor = '';
  $timeAt = date('Y-m-d H:i:s');
  $cicloEscolar = htmlentities(addslashes($_POST['cicloEscolarClase']));
  $codigoProfesor = htmlentities(addslashes($_POST['codigoProfesorClase']));

  //Convertir elementos de texto en codificación UTF-8
  
  $nombreMateria = html_entity_decode($nombreMateria, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $nrc = html_entity_decode($nrc, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $seccion = html_entity_decode($seccion, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $nombreClase = html_entity_decode($nombreClase, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $eliminadoPor = html_entity_decode($eliminadoPor, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $cicloEscolar = html_entity_decode($cicloEscolar, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $codigoProfesor = html_entity_decode($codigoProfesor, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  //Convertir información de cadena a mayusculas
  $nombreMateria = mb_strtoupper($nombreMateria, 'UTF-8');
  $nombreClase = mb_strtoupper($nombreClase, 'UTF-8');

  $sql = 'SELECT * FROM clase
  WHERE claveAcceso = :claveAcceso';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow == 0) {
    $sql = 'INSERT INTO clase
    (claveAcceso, nombreMateria, nrc, claveSeccion, 
    nombreClase, aula, anio, eliminadoPor, 
    createdAt, updatedAt, CicloEscolar_idCicloEscolar, ProfesorUsuario_codigoProfesor)
    VALUES (:ca, :nm, :n, :cs, :nc, :a, :y, :ep, :cat, :uat, :ce, :pucp)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(
      ':ca' => $claveAcceso,
      ':nm' => $nombreMateria,
      ':n' => $nrc,
      ':cs' => $seccion,
      ':nc' => $nombreClase,
      ':a' => $aula,
      ':y' => $anio,
      ':ep' => $eliminadoPor,
      ':cat' => $timeAt,
      ':uat' => $timeAt,
      ':ce' => $cicloEscolar,
      ':pucp' => $codigoProfesor
    );
    $resultado->execute($array);
    
    echo 'success';
  } else {
    echo 'Error. La clase no se pudo crear, intentelo de nuevo.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
