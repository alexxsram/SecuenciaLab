<?php
include('../operaciones/conexion.php');

try {
    $codigoProfesor = $_POST['codigoProfesor'];
    $permiso = $_POST['permiso'];

    $sql = 'UPDATE profesorusuario SET permiso = :p WHERE codigoProfesor = :cp';
    $resultado = $baseDatos->prepare($sql);
    $array = array(
        ':p' => $permiso,
        ':cp' => $codigoProfesor
    );
    $resultado->execute($array);

    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>