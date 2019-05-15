<?php
include('../operaciones/conexion.php');

$calificacion = htmlentities(addslashes($_POST['calificacion']));
$idCuestionario = htmlentities(addslashes($_POST['idCuestionario']));
$idPractica = htmlentities(addslashes($_POST['idPractica']));

try {
    $sql = 'INSERT INTO evaluacion (califiacion, Cuestionario_idCuestionario) VALUES (:c, :cic)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':c'=>$calificacion, ':cic'=>$idCuestionario);
    // $resultado->execute($array);
    // echo 'success';
    if($resultado->execute($array)) {
        header('Location: calificar-entrega.php?criterioCalificar=' . base64_encode($idPractica));
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage() . ' idCues = ' . $idCuestionario . ' idPra = ' . $idPractica);
}
?>
