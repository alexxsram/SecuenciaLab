<?php
include('../operaciones/conexion.php');

try {
  $tituloAnuncio = htmlentities(addslashes($_POST['tituloAnuncio']));
  $contenidoAnuncio = htmlentities(addslashes($_POST['contenidoAnuncio']));
  $fechaCreacionAnuncio = date('Y-m-d');
  $codigoProfesor = htmlentities(addslashes($_POST['codigoProfesor']));
  $claveAccesoClase = htmlentities(addslashes($_POST['claveAccesoClase']));

  //Convertir elementos de texto en codificación UTF-8
  $tituloAnuncio = html_entity_decode($tituloAnuncio, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $contenidoAnuncio = html_entity_decode($contenidoAnuncio, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  $sql = 'SELECT *
  FROM anuncio
  WHERE titulo = :t AND eliminado != true';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':t', $tituloAnuncio);
  $resultado->execute();
  $numRow = $resultado->rowCount();

  //if(true && $numRow == 0) {
    $sql = 'INSERT INTO anuncio
    (titulo, contenido, fechaPublicacion, ProfesorUsuario_codigoProfesor, Clase_claveAcceso)
    VALUES (:t, :c, :fp, :pucp, :cca)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(
      ':t' => $tituloAnuncio,
      ':c' => $contenidoAnuncio,
      ':fp' => $fechaCreacionAnuncio,
      ':pucp' => $codigoProfesor,
      ':cca' => $claveAccesoClase
    );

    $resultado->execute($array);
    echo 'success';
  //} else {
    //echo 'Ya existe la publicación, se debe crear otra con un título diferente.';
  //}
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
