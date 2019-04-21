<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  //Estraer datos de una clase
  $sql = "SELECT * FROM practica WHERE Clase_claveAcceso = :Clase_claveAcceso";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':Clase_claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    echo "<li class=\"list-group-item active disabled\">Lista de prácticas</li>";
    //echo "<button type=\"button\" class=\"list-group-item list-group-item-action\">Promedio</button>";
    //echo "<button type=\"button\" class=\"list-group-item list-group-item-action\"></button>";

    echo "<button id=\"info-alumno-btn-promedio-calificacion\"
    name=\"info-alumno-btn-promedio-calificacion\" type=\"button\"
    class=\"list-group-item list-group-item-action\"
    value=-1
    onclick=\"cargarGraficaDePractica('-2', 'Promedio', '$claveUsuario');\">
    Promedio</button>";

    echo "<button id=\"info-alumno-btn-todas-practica\"
    name=\"info-alumno-btn-todas-practica\" type=\"button\"
    class=\"list-group-item list-group-item-action\"
    value=-1
    onclick=\"cargarGraficaDePractica('-1', 'Todas las prácticas', '$claveUsuario');\">
    Todas las prácticas</button>";

    $practicasClase = $resultado->fetchAll(PDO::FETCH_OBJ);
    foreach ($practicasClase as $practica) {
      echo "<button id=\"info-alumno-btn-practica\"
      name=\"info-alumno-btn-practica\" type=\"button\"
      class=\"list-group-item list-group-item-action\"
      value=$practica->idPractica
      onclick=\"cargarGraficaDePractica('$practica->idPractica', '$practica->nombre', '$claveUsuario');\">
      $practica->nombre</button>";
    }
  }else{
    echo "<p class=\"card-text\" id=\"info-alumno-promedio-alumno\" name=\"info-alumno-promedio-alumno\"><b>No hay prácticas relacionadas con la clase.</b></p>";
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
