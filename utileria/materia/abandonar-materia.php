<?php
include('../operaciones/conexion.php');
try {
  $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));
  $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));
  $timeAt = date('Y-m-d H:i:s');

  $sql = 'SELECT * FROM clase_has_alumnousuario
  WHERE Clase_claveAcceso = :ca AND AlumnoUsuario_codigoAlumno = :auca';

  $resultado = $baseDatos->prepare($sql);
  $array = array(
    ':ca' => $claveAcceso,
    ':auca' => $codigoAlumno
  );
  $resultado->execute($array);
  if($resultado->execute($array)) {
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
      /*$sql = 'DELETE FROM clase_has_alumnousuario
      WHERE Clase_claveAcceso = :claveAcceso
      AND AlumnoUsuario_codigoAlumno = :codigoAlumno';*/
      $sql = 'UPDATE clase_has_alumnousuario SET matriculado = false, permiso = false, updatedAt = :uat 
      WHERE Clase_claveAcceso = :ca AND AlumnoUsuario_codigoAlumno = :auca';

      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':uat' => $timeAt,
        ':ca' => $claveAcceso,
        ':auca' => $codigoAlumno
      );
      $resultado->execute($array);
      echo 'success';
    } else {
      echo 'Error. El alumno no se encuentra inscrito a la clase.';
    }
  } else {
    echo 'Error. No se pudo comprobar el codigo del alumno que desea abandonar la clase.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
