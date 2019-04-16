<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  //Estraer datos de una clase
  //Extraer datos del alumno
  $sql = "SELECT * FROM alumnousuario WHERE codigoAlumno = :codigoAlumno";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':codigoAlumno', $claveUsuario);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $alumno = $resultado->fetch(PDO::FETCH_OBJ);
    echo "<p class=\"card-text\" id=\"info-alumno-nombre-alumno\" name=\"info-alumno-nombre-alumno\"><b>Nombre:</b>" . " " . $alumno->apellidoPaterno . " " . $alumno->apellidoMaterno . " " . $alumno->nombrePila . "</p>";
    echo "<p class=\"card-text\" id=\"info-alumno-codigo-alumno\" name=\"info-alumno-codigo-alumno\"><b>Código:</b> $alumno->codigoAlumno </p>";
    echo "<p class=\"card-text\" id=\"info-alumno-promedio-alumno\" name=\"info-alumno-promedio-alumno\"><b>Promedio:</b> 89.6</p>";
  }else{
    echo "<p class=\"card-text\" id=\"info-alumno-promedio-alumno\" name=\"info-alumno-promedio-alumno\"><b>Error:</b> El alumno no se encuentra registrado en el sistema.</p>";
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
