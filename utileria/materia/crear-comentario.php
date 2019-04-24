<?php
include('../operaciones/conexion.php');

try {
    $idAnuncio = htmlentities(addslashes($_POST['idAnuncio']));
    $nombre = htmlentities(addslashes($_POST['nombre']));
    $aux = htmlentities(addslashes($_POST['comentario']));
    $comentario = $nombre . ': ' . $aux;

    $sql = 'INSERT INTO comentario (comentario, Anuncio_idAnuncio) VALUES (:c, :aia)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':c'=>$comentario, ':aia'=>$idAnuncio);
    $resultado->execute($array);
    echo 'success';
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
