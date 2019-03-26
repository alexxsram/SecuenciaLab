<?php
include('../operaciones/conexion.php');

try {
  $unirseClaveAcceso = htmlentities(addslashes($_POST['claveClase']));
  $codigoAlumnoUnirse = htmlentities(addslashes($_POST['codigoAlumno']));
  //Comprobar si la clave de acceso existe.
  $sql = 'SELECT * FROM clase WHERE claveAcceso = :claveAcceso';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $unirseClaveAcceso);
  if($resultado->execute()){
    $numRow = $resultado->rowCount();
    if($numRow == 1){
      $noPreviamente = true;
      $data = $baseDatos->query("SELECT * FROM clase_has_alumnousuario")->fetchAll();
      foreach ($data as $row) {
        $idAlumno = $row['AlumnoUsuario_codigoAlumno'];
        $claveAcceso = $row['Clase_claveAcceso'];
        if($idAlumno == $codigoAlumnoUnirse && $claveAcceso == $unirseClaveAcceso){
          $noPreviamente = false;
          break;
        }
      }
      if($noPreviamente){
        $sql = 'INSERT INTO clase_has_alumnousuario (Clase_claveAcceso, AlumnoUsuario_codigoAlumno) VALUES (:ca, :cal)';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':ca'=>$unirseClaveAcceso, ':cal'=>$codigoAlumnoUnirse);
        if($resultado->execute($array)){
          echo 'success';
        }else{
          echo "Error. No se pudo unir a la clase. Intentelo de nuevo más tarde.";
        }
      }else{
        echo "Error. Usted ya se encuentra enrolado a dicha clase.
        No se puede unir más de una vez a la misma clase.
        Intente otro codigo.";
      }
    }else{
      echo "La clave de acceso es incorrecta. Compruebe que haya escrito correctamento la clave.";
    }
  }else{
        echo "Error. No se pudo comprobar las claves de acceso de las clases.";
  }

} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
