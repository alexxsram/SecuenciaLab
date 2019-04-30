<?php
include('../operaciones/conexion.php');

try {
    $respuestaPregunta1 = htmlentities(addslashes($_POST['respuestaPregunta1']));
    $respuestaPregunta2 = htmlentities(addslashes($_POST['respuestaPregunta2']));
    $respuestaPregunta3 = htmlentities(addslashes($_POST['respuestaPregunta3']));
    $conclusion = htmlentities(addslashes($_POST['conclusion']));
    $fechaFinalizacion = date('Y-m-d');
    $nombreArchivo = htmlentities(addslashes($_POST['nombreArchivo'])); // ESTE DEBE SER $_FILES PARA AGARRAR LOS ARCHIVOS
    $idPractica = htmlentities(addslashes($_POST['idPractica']));
    $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));

    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $codigoAlumno);
    $resultado->execute();

    $numRow = $resultado->rowCount();

    if($numRow == 0) {
        echo 'Error. No se pudo encontrar al alumno, no es posible subir la práctica.';
    } else {
        $directorio = '../../images/files/';

        $alumno = $resultado->fetch(PDO::FETCH_OBJ);
        $nombreAlumno = $alumno->apellidoPaterno . '-' . $alumno->apellidoMaterno . '-' . $alumno->nombrePila;

        $directorio = $directorio . $nombreAlumno;

        if(!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // FALTA HACER QUE MUEVA LOS ARCHIVOS AL DIRECTORIO CREADO

        // $sql = 'INSERT INTO cuestionario (respuestaPregunta1, respuestaPregunta2, respuestaPregunta3, conclusion, fechaFinalizacion, rutaArchivo, Practica_idPractica, AlumnoUsuario_codigoAlumno) VALUES (:rp1, :rp2, :rp3, :c, :ff, :ra, :pip, :auca)';
        // $resultado = $baseDatos->prepare($sql);
        // $array = array(':rp1'=>$respuestaPregunta1, ':rp2'=>$respuestaPregunta2, ':rp3'=>$respuestaPregunta3, ':c'=>$conclusion, ':ff'=>$fechaFinalizacion, ':ra'=>$directorio, ':pip'=>$idPractica, ':auca'=>$codigoAlumno);
        // $resultado->execute($array);
        // echo 'success';

        echo $nombreArchivo;
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}

?>
