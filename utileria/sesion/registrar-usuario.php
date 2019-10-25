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

  //Convertir elementos de texto en codificación UTF-8
  $nombrePilaUsuario = html_entity_decode($nombrePilaUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $apellidoPaternoUsuario = html_entity_decode($apellidoPaternoUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $apellidoMaternoUsuario = html_entity_decode($apellidoMaternoUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $respuestaSeguridad = html_entity_decode($respuestaSeguridad, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $passwordUsuario = html_entity_decode($passwordUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $emailUsuario = html_entity_decode($emailUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  //Convertir nombre completo del usaurio en mayusculas de usuario a mayusculas
  $nombrePilaUsuario = mb_strtoupper($nombrePilaUsuario,'UTF-8');
  $apellidoPaternoUsuario = mb_strtoupper($apellidoPaternoUsuario,'UTF-8');
  $apellidoMaternoUsuario = mb_strtoupper($apellidoMaternoUsuario,'UTF-8');
  $claveUsuario = mb_strtoupper($claveUsuario,'UTF-8');

  $respuestaHash = hash('sha1', $preguntaSeguridad, false);
  $passwordHash = password_hash($passwordUsuario, PASSWORD_DEFAULT, array('cost' => 13));
  
  $aux = substr($claveUsuario, 0, 1);
  $claveUsuario = substr($claveUsuario, 1); //Código del usaurio

  if(is_numeric($claveUsuario)) { //Validar codigo profesor y alumno
    $sql = 'SELECT email FROM (SELECT email FROM alumnousuario UNION SELECT email FROM profesorusuario) as unionEmail WHERE email = :e';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':e', $emailUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow == 0) {
      if($aux == 'P' || $aux == 'p') { //Comprobar profesor
        $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';

        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':cp', $aux.$claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 0) {
          $sql = 'INSERT INTO profesorusuario (codigoProfesor, nombrePila, apellidoPaterno, apellidoMaterno, email, PreguntaSeguridad_idPreguntaSeguridad, respuestaSeguridad, password, permiso) VALUES (:cp, :np, :ap, :am, :e, :psidps, :rs, :p, :pe)';
          $resultado = $baseDatos->prepare($sql);
          $array = array(
            ':cp' => $aux.$claveUsuario,
            ':np' => $nombrePilaUsuario,
            ':ap' => $apellidoPaternoUsuario,
            ':am' => $apellidoMaternoUsuario,
            ':e' => $emailUsuario,
            ':psidps' => $preguntaSeguridad,
            ':rs' => $respuestaHash,
            ':p' => $passwordHash,
            ':pe' => 'pnormal'
          );
          $resultado->execute($array);
          echo 'success';
        } else {
          echo 'Error. El código del profesor ya se encuentra registrado en el sistema.';
        }
      } else if($aux == 'A' || $aux == 'a') { //Comprobar Alumno
        $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :codigoAlumno';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoAlumno', $aux.$claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 0) {
          $sql = 'INSERT INTO alumnousuario (codigoAlumno, nombrePila, apellidoPaterno, apellidoMaterno, email, PreguntaSeguridad_idPreguntaSeguridad, respuestaSeguridad, password) VALUES (:cp, :np, :ap, :am, :e, :psidps, :rs, :p)';
          $resultado = $baseDatos->prepare($sql);
          $array = array(
            ':cp' => $aux.$claveUsuario,
            ':np' => $nombrePilaUsuario,
            ':ap' => $apellidoPaternoUsuario,
            ':am' => $apellidoMaternoUsuario,
            ':e' => $emailUsuario,
            ':psidps' => $preguntaSeguridad,
            ':rs' => $respuestaHash,
            ':p' => $passwordHash
          );
          $resultado->execute($array);
          echo 'success';
        } else {
          echo 'Error. El código del alumno ya se encuentra registrado en el sistema.';
        }
      } else {
        echo 'Error. Para registrar un código de usuario dentro de la plataforma debe iniciar con una letra (Ej. A123456789)';
      }
    } else {
      echo 'Error. El correo electrónico ya se encuentra en el sistema. Introduzca otro correo.';
    }
  } else {
    echo 'Error. Su código es inválido. Debe estar compuesto únicamente de dígitos.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
