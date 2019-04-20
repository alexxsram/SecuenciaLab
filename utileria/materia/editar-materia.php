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

    //Convertir dinformación de cadena a mayusculas
    $nombreClase = strtoupper($nombreClase);
    $materiaClase = strtoupper($materiaClase);

    $sql = "UPDATE clase SET nombreMateria = :nm, nrc = :n, claveSeccion = :cs, nombreClase = :nc, aula = :a, anio = :y, CicloEscolar_idCicloEscolar = :ce WHERE claveAcceso = :ca AND ProfesorUsuario_codigoProfesor = :pucp";
    $resultado = $baseDatos->prepare($sql);
    $array = array(':nm'=>$materiaClase, ':n'=>$nrcClase, ':cs'=>$seccionClase, ':nc'=>$nombreClase, ':a'=>$aulaClase, ':y'=>$anoClase, ':ce'=>$cicloEscolarClase, ':ca'=>$claveAccesoClase, ':pucp'=>$codigoProfesorClase);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}

?>
