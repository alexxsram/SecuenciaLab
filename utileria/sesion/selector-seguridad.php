<?php
include('../operaciones/conexion.php');

try {
  $sql = 'SELECT * FROM preguntaseguridad ';
  $resultado = $baseDatos->prepare($sql);
  $resultado->execute();

  $preguntasSeguridad = $resultado->fetchAll(PDO::FETCH_OBJ);
  $preguntas = '';
  foreach ($preguntasSeguridad as $preguntaSeguridad) {  
    $preguntas .= '<option value="' . $preguntaSeguridad->idPreguntaSeguridad . '">' . $preguntaSeguridad->pregunta . '</option>';
  }
  echo $preguntas;
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
