<?php
include('../operaciones/conexion.php');

$calificacion = htmlentities(addslashes($_POST['calificacion']));
$idCuestionario = htmlentities(addslashes($_POST['idCuestionario']));

try {
    $sql = 'INSERT INTO evaluacion (califiacion, Cuestionario_idCuestionario) VALUES (:c, :cic)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':c'=>$calificacion, ':cic'=>$idCuestionario);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
