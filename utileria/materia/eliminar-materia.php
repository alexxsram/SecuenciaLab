<?php
include('../operaciones/conexion.php');
try {
    $nrcClase = htmlentities(addslashes($_POST['nrcClase']));

    $sql = 'DELETE FROM clase WHERE nrc = :nrc';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':nrc', $nrcClase);
    $resultado->execute();
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>