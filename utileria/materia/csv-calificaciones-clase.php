<?php
include('../operaciones/conexion.php');

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);

try {
    $sql = 'SELECT * FROM practica WHERE Clase_claveAcceso = :cca AND eliminado = 0';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cca', $claveAccesoClase);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if($numRow > 0) {
        $delimitador = ',';
        $nombreArchivo = 'csv_calificaciones_' . $claveAccesoClase . '.csv';
        $archivo = fopen('php://memory', 'w');

        $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);

        $promediosPracticas = array();
        $NumeroDeAlumnosEntregadosPracticas = array();
        $headers = array();
        $headers[] = 'Nombre Alumno';
        foreach($practicas as $practica) {
            $promediosPracticas['\'' . $practica->idPractica . '\''] = 0;
            $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica . '\''] = 0;
            $headers[] = $practica->nombre;
        }
        $headers[] = 'Promedio';
        $headers[] = 'Nivel';

        fputcsv($archivo, $headers, $delimitador);

        // aqui proceso nombres, calificaciones y promedios
        $promedioTotalAlumnos = 0;
        $sql = 'SELECT AU.codigoAlumno as codigo, CONCAT(AU.apellidoPaterno, " ", AU.apellidoMaterno, ", ", AU.nombrePila) as nombre FROM clase_has_alumnousuario CHAU
        INNER JOIN alumnousuario AU ON AU.codigoAlumno = CHAU.AlumnoUsuario_codigoAlumno 
        WHERE CHAU.Clase_claveAcceso = :cca ORDER BY nombre ASC';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':cca', $claveAccesoClase);
        $resultado->execute();

        $numeroDeAlumnos = $resultado->rowCount();
        $alumnos = $resultado->fetchAll(PDO::FETCH_OBJ);

        foreach($alumnos as $alumno) {
            $sql = 'SELECT EV.*, CU.* FROM cuestionario CU 
            INNER JOIN evaluacion EV ON EV.Cuestionario_idCuestionario = CU.idCuestionario 
            WHERE CU.AlumnoUsuario_codigoAlumno = :auca';
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':auca', $alumno->codigo);
            $resultado->execute();

            $numRowCalificadas = $resultado->rowCount();
            if($numRowCalificadas > 0) {
                $data = array();

                $data[] = $alumno->codigo . ' - ' . $alumno->nombre;

                $calificadas = $resultado->fetchAll(PDO::FETCH_OBJ);

                $promedio = 0;
                $numeroDeCalificaciones = 0;
                $PracticaYaCalificada = false;
                foreach($practicas as $practica) {
                    $PracticaYaCalificada = false;
                    foreach ($calificadas as $calificado) {
                        if($calificado->Practica_idPractica == $practica->idPractica) {
                            $promediosPracticas['\'' . $practica->idPractica . '\''] = $promediosPracticas['\'' . $practica->idPractica .'\''] + $calificado->califiacion;
                            $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\''] = $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\''] + 1;
                            $numeroDeCalificaciones++;
                            $promedio = $promedio + $calificado->califiacion;
                            $data[] = $calificado->califiacion;
                            $PracticaYaCalificada = true;
                            break;
                        }
                    }
                    if(!$PracticaYaCalificada) {
                        $promedio = $promedio + 0; 
                        $data[] = 0;
                    }
                }
                if($numeroDeCalificaciones != 0) {
                    $promedio = round($promedio / $numeroDeCalificaciones, 4);
                } else {
                    $promedio = 0;
                }
                $data[] = $promedio;
                if($promedio < 60) {
                    $data[] = 'Insatisfactorio';
                }
                if($promedio >= 60 && $promedio < 70) {
                    $data[] = 'Malo';
                }
                if($promedio >= 70 && $promedio < 80) {
                    $data[] = 'Regular';
                }
                if($promedio >= 80 && $promedio < 90) {
                    $data[] = 'Bueno';
                }
                if($promedio >= 90 && $promedio < 95) {
                    $data[] = 'Muy bueno';
                }
                if($promedio >= 95 && $promedio <= 100) {
                    $data[] = 'Excelente';
                }
                fputcsv($archivo, $data, $delimitador);
            }
        }

        fseek($archivo, 0);
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '";');

        fpassthru($archivo);
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>