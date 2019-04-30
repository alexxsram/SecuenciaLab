<?php
include('../operaciones/conexion.php');

try {
  $nombrePractica = htmlentities(addslashes($_POST['nombrePractica']));
  $descripcionPractica = htmlentities(addslashes($_POST['descripcionPractica']));
  $fechaLimitePractica = htmlentities(addslashes($_POST['fechaLimitePractica']));
  $claveAccesoClase = htmlentities(addslashes($_POST['claveAccesoClase']));

  //Convertir elementos de texto en codificación UTF-8
  $nombrePractica = html_entity_decode($nombrePractica, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $descripcionPractica = html_entity_decode($descripcionPractica, ENT_QUOTES | ENT_HTML401, "UTF-8");

  $sql = 'INSERT INTO practica (nombre, descripcion, fechaLimite, Clase_claveAcceso) VALUES (:n, :d, :fl, :cca)';
  $resultado = $baseDatos->prepare($sql);
  $array = array(':n'=>$nombrePractica, ':d'=>$descripcionPractica, ':fl'=>$fechaLimitePractica, ':cca'=>$claveAccesoClase);
  $resultado->execute($array);
  echo 'success';
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
