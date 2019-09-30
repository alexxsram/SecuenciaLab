<?php
include('../operaciones/conexion.php');

try {
  $nombre = htmlentities(addslashes($_POST['nombrePractica']));
  $descripcion = htmlentities(addslashes($_POST['descripcionPractica']));
  $fechaLimite = htmlentities(addslashes($_POST['fechaLimitePractica']));
  $claveAcceso = htmlentities(addslashes($_POST['claveAccesoClase']));

  //Convertir elementos de texto en codificación UTF-8
  $nombre = html_entity_decode($nombre, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $descripcion = html_entity_decode($descripcion, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  $sql = 'INSERT INTO practica (nombre, descripcion, fechaLimite, Clase_claveAcceso)
  VALUES (:n, :d, :fl, :cca)';

  $resultado = $baseDatos->prepare($sql);
  $array = array(
    ':n' => $nombre,
    ':d' => $descripcion,
    ':fl' => $fechaLimite,
    ':cca' => $claveAcceso
  );

  $resultado->execute($array);
  echo 'success';
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
