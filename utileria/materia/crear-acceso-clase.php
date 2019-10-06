<?php
include('../operaciones/conexion.php');

try {
    $claveAccesoClase = htmlentities(addslashes($_POST['claveAccesoClase']));
    $selectAccesoAlumno = htmlentities(addslashes($_POST['selectAccesoAlumno']));
    
    $sql = 'UPDATE clase_has_alumnousuario SET permiso = true
    WHERE Clase_claveAcceso = :cca AND AlumnoUsuario_codigoAlumno = :auca';
    $resultado = $baseDatos->prepare($sql);
    $array = array(
        ':cca' => $claveAccesoClase, 
        ':auca' => $selectAccesoAlumno
    );
    $resultado->execute($array);

    echo 'success';
} catch (Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}

?>