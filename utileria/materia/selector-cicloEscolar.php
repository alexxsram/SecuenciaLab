<?php
include('../operaciones/conexion.php');

try {
  $sql = 'SELECT * FROM cicloescolar';
  $resultado = $baseDatos->prepare($sql);
  $resultado->execute();

  $ciclosEscolares = $resultado->fetchAll(PDO::FETCH_OBJ);
  $ciclos = '';
  foreach ($ciclosEscolares as $cicloEscolar) {
    $ciclos .= '<option value="' . $cicloEscolar->idCicloEscolar . '">'. $cicloEscolar->ciclo . '</option>';
  }
  echo $ciclos;
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
