<?php
include('../operaciones/conexion.php');

try {
  //$claveAccesoClase = $_POST['claveAccesoClase'];
  $data = $baseDatos->query("SELECT * FROM alumnousuario WHERE codigoAlumno IN
    (SELECT AlumnoUsuario_codigoAlumno FROM clase_has_alumnousuario WHERE
      Clase_claveAcceso = 'vtdVjgoSc7') ORDER BY apellidoPaterno ASC, apellidoMaterno ASC, nombrePila ASC;")->fetchAll();
  foreach ($data as $row) {
    $codAlumno = $row['codigoAlumno'];
    $apellidoPaterno = $row['apellidoPaterno'];
    $apellidoMaterno = $row['apellidoMaterno'];
    $nombrePila = $row['nombrePila'];
    echo "<button type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-primary badge-pill\">Promedio estudiante</span></button>";
    //echo "$codAlumno";
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
