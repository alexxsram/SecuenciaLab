<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = htmlentities(addslashes($_POST['claveClase']));
  $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));
  $timeAt = date('Y-m-d H:i:s');
  
  //Comprobar si existe la clave de acceso y si se encuentra activa.
  $sql = 'SELECT * FROM clase
  WHERE claveAcceso = :claveAcceso AND eliminado != true';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  if($resultado->execute()) {
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
      $noPreviamente = true;
      
      $sql = 'SELECT * FROM clase_has_alumnousuario 
      WHERE Clase_claveAcceso = :cca AND AlumnoUsuario_codigoAlumno = :auca';
      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':cca' => $claveAcceso,
        ':auca' =>$codigoAlumno
      );
      $resultado->execute($array);
      $count = $resultado->rowCount();
      if($count > 0) {
        $noPreviamente = false;
      }

      if($noPreviamente) {
        $sql = 'INSERT INTO clase_has_alumnousuario (Clase_claveAcceso, AlumnoUsuario_codigoAlumno, createdAt, updatedAt)
        VALUES (:ca, :cal, :cat, :uat)';
        
        $resultado = $baseDatos->prepare($sql);
        $array = array(
          ':ca' => $claveAcceso,
          ':cal' => $codigoAlumno,
          ':cat' => $timeAt,
          ':uat' => $timeAt
        );
        
        if($resultado->execute($array)) {
          echo 'success';
        } else {
          echo 'Error. No se pudo unir a la clase. Intentelo de nuevo más tarde.';
        }
      } else {
        echo 'Error. Usted ya se encuentra enrolado a dicha clase. No se puede unir más de una vez a la misma clase.
        Intente con otra clave de acceso.';
      }
    } else {
      echo 'Clave de acceso incorrecta o clase inactiva. 
      Compruebe que haya escrito correctamente la clave.';
    }
  } else {
    echo 'Error. No se pudo comprobar las claves de acceso de las clases.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
