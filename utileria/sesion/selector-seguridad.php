<?php
include('../operaciones/conexion.php');

try {
  $sql = "SELECT * FROM preguntaseguridad WHERE idPreguntaSeguridad = :idPreguntaSeguridad";
  $data = $baseDatos->query("SELECT * FROM preguntaseguridad")->fetchAll();
  foreach ($data as $row) {
    $pregunta = $row['pregunta'];
    $numPregunta = $row['idPreguntaSeguridad'];
    echo "<option value='{$numPregunta}'>{$pregunta}</option>";
  }
  // Cerrar la conexión
  mysql_close($baseDatos);
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
