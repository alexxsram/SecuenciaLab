<?php
include('../operaciones/conexion.php');

try {
    $idPractica = htmlentities(addslashes($_POST['idPractica']));
    $nombrePractica = htmlentities(addslashes($_POST['nombrePractica']));
    $descripcionPractica = htmlentities(addslashes($_POST['descripcionPractica']));
    $fechaLimitePractica = htmlentities(addslashes($_POST['fechaLimitePractica']));

    $sql = 'UPDATE practica SET nombre = :n, descripcion = :d, fechaLimite = :fl WHERE idPractica = :i';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':n'=>$nombrePractica, ':d'=>$descripcionPractica, ':fl'=>$fechaLimitePractica, ':i'=>$idPractica);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>