<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAccesoClase'];
  $nombreMateria = $_POST['materiaClase'];
  $nrc = $_POST['nrcClase'];
  $seccion = $_POST['seccionClase'];
  $nombreClase = $_POST['nombreClase'];
  $aula = $_POST['aulaClase'];
  $anio = $_POST['anoClase'];
  $anio = substr($anio, 0, 4);
  $cicloEscolar = $_POST['cicloEscolarClase'];
  $codigoProfesor = $_POST['codigoProfesorClase'];

  //Convertir elementos de texto en codificación UTF-8
  $nombreMateria = html_entity_decode($nombreMateria, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $nrc = html_entity_decode($nrc, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $seccion = html_entity_decode($seccion, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $nombreClase = html_entity_decode($nombreClase, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $cicloEscolar = html_entity_decode($cicloEscolar, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $codigoProfesor = html_entity_decode($codigoProfesor, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  //Convertir información de cadena a mayusculas
  $nombreMateria = mb_strtoupper($nombreMateria,'UTF-8');
  $nombreClase = mb_strtoupper($nombreClase,'UTF-8');

  $sql = 'UPDATE clase SET nombreMateria = :nm, nrc = :n, claveSeccion = :cs, nombreClase = :nc, 
  aula = :a, anio = :y, CicloEscolar_idCicloEscolar = :ce
  WHERE claveAcceso = :ca AND ProfesorUsuario_codigoProfesor = :pucp';

  $resultado = $baseDatos->prepare($sql);
  $array = array(
    ':nm' => $nombreMateria,
    ':n' => $nrc,
    ':cs' => $seccion,
    ':nc' => $nombreClase,
    ':a' => $aula,
    ':y' => $anio,
    ':ce' => $cicloEscolar,
    ':ca' => $claveAcceso,
    ':pucp'=> $codigoProfesor
  );
  $resultado->execute($array);

  echo 'success';
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
