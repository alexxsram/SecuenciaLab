<?php
include('../operaciones/conexion.php');

try {
  $nombrePractica = htmlentities(addslashes($_POST['nombrePractica']));
  $descripcionPractica = htmlentities(addslashes($_POST['descripcionPractica']));
  $fechaLimitePractica = htmlentities(addslashes($_POST['fechaLimitePractica']));
  $claveAccesoClase = htmlentities(addslashes($_POST['claveAccesoClase']));

  $sql = 'INSERT INTO practica (nombre, descripcion, fechaLimite, Clase_claveAcceso) VALUES (:n, :d, :fl, :cca)';
  $resultado = $baseDatos->prepare($sql);
  $array = array(':n'=>$nombrePractica, ':d'=>$descripcionPractica, ':fl'=>$fechaLimitePractica, ':cca'=>$claveAccesoClase);
  $resultado->execute($array);
  echo 'success';
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
