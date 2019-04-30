<?php
include('../operaciones/conexion.php');
try {
    $claveAccesoClase = $_POST['claveAccesoClase'];
    $nombreClase = $_POST['nombreClase'];
    $nrcClase = $_POST['nrcClase'];
    $seccionClase = $_POST['seccionClase'];
    $materiaClase = $_POST['materiaClase'];
    $aulaClase = $_POST['aulaClase'];
    $anio = $_POST['anoClase'];
    $anoClase = substr($anio, 0, 4);
    $cicloEscolarClase = $_POST['cicloEscolarClase'];
    $codigoProfesorClase = $_POST['codigoProfesorClase'];

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

    $sql = "UPDATE clase SET nombreMateria = :nm, nrc = :n, claveSeccion = :cs, nombreClase = :nc, aula = :a, anio = :y, CicloEscolar_idCicloEscolar = :ce WHERE claveAcceso = :ca AND ProfesorUsuario_codigoProfesor = :pucp";
    $resultado = $baseDatos->prepare($sql);
    $array = array(':nm'=>$materiaClase, ':n'=>$nrcClase, ':cs'=>$seccionClase, ':nc'=>$nombreClase, ':a'=>$aulaClase, ':y'=>$anoClase, ':ce'=>$cicloEscolarClase, ':ca'=>$claveAccesoClase, ':pucp'=>$codigoProfesorClase);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}

?>
