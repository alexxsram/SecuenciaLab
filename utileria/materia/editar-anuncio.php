<?php
include('../operaciones/conexion.php');

try {
  $idAnuncio = htmlentities(addslashes($_POST['idAnuncio']));
  $tituloAnuncio = htmlentities(addslashes($_POST['tituloAnuncio']));
  $contenidoAnuncio = htmlentities(addslashes($_POST['contenidoAnuncio']));
  $fechaCreacionAnuncio = htmlentities(addslashes($_POST['fechaCreacionAnuncio']));

  //Convertir elementos de texto en codificación UTF-8
  $tituloAnuncio = html_entity_decode($tituloAnuncio, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $contenidoAnuncio = html_entity_decode($contenidoAnuncio, ENT_QUOTES | ENT_HTML401, "UTF-8");

  $sql = 'UPDATE anuncio
  SET titulo = :t,
  contenido = :c,
  fechaPublicacion = :fp
  WHERE idAnuncio = :i';

  $resultado = $baseDatos->prepare($sql);
  $array = array(':t'=>$tituloAnuncio,
  ':c'=>$contenidoAnuncio,
  ':fp'=>$fechaCreacionAnuncio,
  ':i'=>$idAnuncio);
  $resultado->execute($array);
  echo 'success';
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
