<?php
include('../operaciones/conexion.php');

try {
    $respuestaPregunta1 = htmlentities(addslashes($_POST['respuestaPregunta1']));
    $respuestaPregunta2 = htmlentities(addslashes($_POST['respuestaPregunta2']));
    $respuestaPregunta3 = htmlentities(addslashes($_POST['respuestaPregunta3']));
    $conclusion = htmlentities(addslashes($_POST['conclusion']));
    $fechaFinalizacion = date('Y-m-d');
    $idPractica = htmlentities(addslashes($_POST['idPractica']));
    $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));

    $sql = 'INSERT INTO cuestionario (respuestaPregunta1, respuestaPregunta2, respuestaPregunta3, conclusion, fechaFinalizacion, Practica_idPractica, AlumnoUsuario_codigoAlumno) VALUES (:rp1, :rp2, :rp3, :c, :ff, :pip, :auca)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':rp1'=>$respuestaPregunta1, ':rp2'=>$respuestaPregunta2, ':rp3'=>$respuestaPregunta3, ':c'=>$conclusion, ':ff'=>$fechaFinalizacion, ':pip'=>$idPractica, ':auca'=>$codigoAlumno);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}

?>
