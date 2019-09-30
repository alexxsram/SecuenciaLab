<?php
include('../operaciones/conexion.php');

try {
    $claveAcceso = $_POST['claveAcceso'];

    $sql = 'SELECT * FROM clase
    WHERE claveAcceso = :ca AND eliminado = true';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveAcceso);
    $resultado->execute();
    if($resultado->execute()) {
        $numRow = $resultado->rowCount();
        if($numRow == 1) {
            $sql = 'UPDATE clase SET eliminado = false
            WHERE claveAcceso = :ca';

            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':ca', $claveAcceso);
            $resultado->execute();
            echo 'success';
        } else {
            echo 'La clase ya se encuentra activa, no se puede volver a activar.';
        }
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>