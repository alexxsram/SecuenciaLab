<?php
include('../operaciones/conexion.php');

try {
    $claveAccesoClase = $_GET['claveAccesoClase'];

    $sql = 'SELECT CHAU.*, AU.* FROM clase_has_alumnousuario CHAU
    INNER JOIN alumnousuario AU ON CHAU.AlumnoUsuario_codigoAlumno = AU.codigoAlumno
    WHERE CHAU.Clase_claveAcceso = :cca AND CHAU.acceso != true';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cca', $claveAccesoClase);
    $resultado->execute();

    $numRowAlumnos = $resultado->rowCount();
    $optionAlumno = '';
    if($numRowAlumnos > 0) {
        $alumnos = $resultado->fetchAll(PDO::FETCH_OBJ);
        foreach ($alumnos as $alumno) {
            $optionAlumno .= '<option value="' . $alumno->codigoAlumno . '">' . $alumno->codigoAlumno . " - ". $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno . ' ' . $alumno->nombrePila . '</option>';
        }
    } else {
        $optionAlumno .= '<option value="">No hay alumnos en espera de acceso a la clase</option>';
    }

    echo $optionAlumno;
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
