<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso= $_POST['claveAcceso'];
  $data = $baseDatos->query("SELECT * FROM alumnousuario WHERE codigoAlumno IN
    (SELECT AlumnoUsuario_codigoAlumno FROM clase_has_alumnousuario WHERE
      Clase_claveAcceso = '$claveAcceso') ORDER BY apellidoPaterno ASC, apellidoMaterno ASC, nombrePila ASC;")->fetchAll();
  foreach ($data as $row) {
    $codAlumno = $row['codigoAlumno'];
    $apellidoPaterno = $row['apellidoPaterno'];
    $apellidoMaterno = $row['apellidoMaterno'];
    $nombrePila = $row['nombrePila'];
    //Calcular promedio del alumno
    $data = $baseDatos->query("SELECT AVG(califiacion) as promedio FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica IN (SELECT Practica_idPractica FROM practica WHERE Clase_claveAcceso = '$claveAcceso') and AlumnoUsuario_codigoAlumno = '$codAlumno')")->fetchAll();
    foreach ($data as $row) {
      $promedioAlumno = round($row['promedio'],4);
    }
    if(!$promedioAlumno){
      $promedioAlumno = 0;
    }
    //Clasificar a los alumnos por promedio
    $codAlumnoBase64 = base64_encode($codAlumno);
    $claveAccesoBase64 = base64_encode($claveAcceso);
    $botones = "<div class=\"btn-group\">
        <button type=\"button\" class=\"btn btn-sm btn-outline-success\" onclick=\"redireccionarPagina('panel-info-alumno.php?claveAccesoClase=$claveAccesoBase64&claveUsuario=$codAlumnoBase64');\"> Ver gráficas <i class=\"fas fa-chart-bar\"></i> </button>
        <button type=\"button\" class=\"btn btn-sm btn-outline-primary\" onclick=\"cargarContenido('utileria/practica/', 'calificar-entrega.php', 'criterioCalificar=$codAlumnoBase64');\"> Calificar <i class=\"fas fa-clipboard-check\"></i> </button>
    </div>";

    if($promedioAlumno==0){
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-secondary badge-pill\">$promedioAlumno</span>$botones</li>";
    }else if($promedioAlumno>=1 and $promedioAlumno<=59){
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-danger badge-pill\">$promedioAlumno</span>$botones</li>";
    }else if($promedioAlumno>=60 and $promedioAlumno<=70){
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-warning badge-pill\">$promedioAlumno</span>$botones</li>";
    }else if($promedioAlumno>=71 and $promedioAlumno<=90){
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-primary badge-pill\">$promedioAlumno</span>$botones</li>";
    }else if($promedioAlumno>=91 and $promedioAlumno<=100){
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-success badge-pill\">$promedioAlumno</span>$botones</li>";
    }else{
      echo "<li type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">{$apellidoPaterno} {$apellidoMaterno} {$nombrePila} - {$codAlumno}<span class=\"badge badge-muted badge-pill\">Error en calculo: $promedioAlumno</span>$botones</li>";
    }
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
