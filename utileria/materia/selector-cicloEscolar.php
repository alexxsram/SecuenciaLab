<?php
include('../operaciones/conexion.php');

try {
  $data = $baseDatos->query("SELECT * FROM cicloescolar")->fetchAll();
  foreach ($data as $row) {
    $idCiclo = $row['idCicloEscolar'];
    $cilo = $row['ciclo'];
    echo "<option value='{$idCiclo}'>{$cilo}</option>";
  }
  // Cerrar la conexión
  mysql_close($baseDatos);
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
