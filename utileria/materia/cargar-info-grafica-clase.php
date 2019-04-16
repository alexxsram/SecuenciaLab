<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  //Estraer datos de una clase
  $sql = "SELECT * FROM clase WHERE claveAcceso = :claveAcceso";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $clase = $resultado->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow != 0){
      $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
      echo "<p class=\"card-text\" id=\"info-alumno-clase\" name=\"info-alumno-clase\"><b>Clase:</b> $clase->nombreClase</p>";
      echo "<p class=\"card-text\" id=\"info-alumno-materia\" name=\"info-alumno-materia\"><b>Materia:</b> $clase->nombreMateria - $clase->nrc</p>";
      echo "<p class=\"card-text\" id=\"info-alumno-seccion\" name=\"info-alumno-seccion\"><b>Sección:</b> $clase->claveSeccion</p>";
      echo "<p class=\"card-text\" id=\"info-alumno-ciclo\" name=\"info-alumno-ciclo\"><b>Ciclo:</b> $clase->anio-$ciclo->ciclo</p>";
      echo "<p class=\"card-text\" id=\"info-alumno-claveAcceso\" name=\"info-alumno-claveAcceso\"><b>Clave de acceso: </b> $clase->claveAcceso</p>";
    }
  }else{
    echo "<p class=\"card-text\" id=\"info-alumno-promedio-alumno\" name=\"info-alumno-promedio-alumno\"><b>Error:</b> La clase no es valida.</p>";
  }


  /*$data = $baseDatos->query("SELECT * FROM alumnousuario WHERE codigoAlumno IN
    (SELECT AlumnoUsuario_codigoAlumno FROM clase_has_alumnousuario WHERE
      Clase_claveAcceso = 'vtdVjgoSc7') ORDER BY apellidoPaterno ASC, apellidoMaterno ASC, nombrePila ASC;")->fetchAll();
  foreach ($data as $row) {
    $codAlumno = $row['codigoAlumno'];
    $apellidoPaterno = $row['apellidoPaterno'];
    $apellidoMaterno = $row['apellidoMaterno'];
    $nombrePila = $row['nombrePila'];*/
    //echo "<button type=\"button\" class=\"list-group-item d-flex justify-content-between align-items-center\">$claveAcceso $claveUsuario<span class=\"badge badge-primary badge-pill\">Promedio estudiante</span></button>";
    //echo "$codAlumno";
  //}
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
