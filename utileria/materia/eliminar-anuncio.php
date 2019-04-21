<?php
include('../operaciones/conexion.php');
try {
    $idAnuncio = htmlentities(addslashes($_POST['idAnuncio']));

    $sql = 'SELECT * FROM anuncio WHERE idAnuncio = :idAnuncio';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':idAnuncio', $idAnuncio);
    $resultado->execute();
    if($resultado->execute()) {
        $numRow = $resultado->rowCount();
        if($numRow == 1) {
            $sql = 'DELETE FROM anuncio WHERE idAnuncio = :idAnuncio';
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':idAnuncio', $idAnuncio);
            $resultado->execute();
            echo 'success';
        } else {
            echo 'Error. No existe el ID del anuncio.';
        }
    } else {
        echo 'Error. No se pudo comprobar el anuncio que se desea eliminar.';
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
