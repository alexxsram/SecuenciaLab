<?php
include('../operaciones/conexion.php');

try {
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $nombrePilaUsuario = htmlentities(addslashes($_POST['nombrePilaUsuario']));
  $apellidoPaternoUsuario = htmlentities(addslashes($_POST['apellidoPaternoUsuario']));
  $apellidoMaternoUsuario = htmlentities(addslashes($_POST['apellidoMaternoUsuario']));
  $emailUsuario = htmlentities(addslashes($_POST['emailUsuario']));
  $preguntaSeguridad = htmlentities(addslashes($_POST['preguntaSeguridad']));
  $respuestaSeguridad = htmlentities(addslashes($_POST['respuestaSeguridad']));
  $passwordUsuario = htmlentities(addslashes($_POST['passwordUsuario']));
  $confirmPasswordUsuario = htmlentities(addslashes($_POST['confirmPasswordUsuario']));

  $aux = substr($claveUsuario, 0, 1);
  $claveUsuario = substr($claveUsuario, 1);

  if(is_numeric($claveUsuario)) { //Validar codigo profesor y alumno
    $sql = 'SELECT email FROM (SELECT email FROM alumnousuario UNION SELECT email FROM profesorusuario) as unionEmail WHERE email = :email';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':email', $emailUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if($numRow == 0) {
      if($aux == 'P' || $aux == 'p') { //Comprobar profesor
        $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :codigoProfesor';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoProfesor', $claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 0) {
          $sql = 'INSERT INTO profesorusuario (codigoProfesor, nombrePila, apellidoPaterno, apellidoMaterno, email, PreguntaSeguridad_idPreguntaSeguridad, respuestaSeguridad, password) VALUES (:cp, :np, :ap, :am, :e, :psidps, :rs, :p)';
          $resultado = $baseDatos->prepare($sql);
          $array = array(':cp'=>$aux.$claveUsuario, ':np'=>$nombrePilaUsuario, ':ap'=>$apellidoPaternoUsuario, ':am'=>$apellidoMaternoUsuario, ':e'=>$emailUsuario, ':psidps'=>$preguntaSeguridad, ':rs'=>$respuestaSeguridad, ':p'=>$passwordUsuario);
          $resultado->execute($array);
          echo 'success';
        } else {
          echo 'Error. El código del profesor ya se encuentra registrado en el sistema.';
        }
      } else if($aux == 'A' || $aux == 'a') { //Comprobar Alumno
        $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :codigoAlumno';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoAlumno', $claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();

        if($numRow == 0) {
          $sql = 'INSERT INTO alumnousuario (codigoAlumno, nombrePila, apellidoPaterno, apellidoMaterno, email, PreguntaSeguridad_idPreguntaSeguridad, respuestaSeguridad, password) VALUES (:cp, :np, :ap, :am, :e, :psidps, :rs, :p)';
          $resultado = $baseDatos->prepare($sql);
          $array = array(':cp'=>$aux.$claveUsuario, ':np'=>$nombrePilaUsuario, ':ap'=>$apellidoPaternoUsuario, ':am'=>$apellidoMaternoUsuario, ':e'=>$emailUsuario, ':psidps'=>$preguntaSeguridad, ':rs'=>$respuestaSeguridad, ':p'=>$passwordUsuario);
          $resultado->execute($array);
          echo 'success';
        } else {
          echo 'Error. El código del profesor ya se encuentra registrado en el sistema';
        }
      } else {
        echo "Error. Si es un alumno debe anteponer a su código de estudiante la letra A. Ej. A215861738.";
      }
    } else {
      echo "Error. El corro electrónico ya se encuentra en el sistema. Introduzca otro correo.";
    }
  } else {
    echo "Error. Su código es invalido. Debe estar compuesto unicamente de dígitos.";
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
