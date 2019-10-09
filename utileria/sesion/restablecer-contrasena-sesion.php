<?php
include('../operaciones/conexion.php');

try {
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $respuestaSeguridad = htmlentities(addslashes($_POST['respuestaSeguridad']));
  /* $nuevoPasswordUsuario = htmlentities(addslashes($_POST['nuevoPasswordUsuario']));
  $confirmNuevoPasswordUsuario = htmlentities(addslashes($_POST['confirmNuevoPasswordUsuario'])); */

  //Convertir elementos de texto en codificación UTF-8
  $claveUsuario = html_entity_decode($claveUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $respuestaSeguridad = html_entity_decode($respuestaSeguridad, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  /* $nuevoPasswordUsuario = html_entity_decode($nuevoPasswordUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $confirmNuevoPasswordUsuario = html_entity_decode($confirmNuevoPasswordUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8'); */

  //Convertir nombre completo del usaurio en mayusculas de usuario a mayusculas
  $claveUsuario = mb_strtoupper($claveUsuario, 'UTF-8');
  $respuestaSeguridad = mb_strtoupper($respuestaSeguridad, 'UTF-8');

  $aux = substr($claveUsuario, 0, 1);
  if ($aux == 'A' || $aux == 'a') {
    $sql = 'SELECT * FROM alumnousuario
    WHERE codigoAlumno = :codigoAlumno AND respuestaSeguridad = :respuestaSeguridad';

    $resultado = $baseDatos->prepare($sql);
    $array = array(
      ':codigoAlumno' => $claveUsuario,
      ':respuestaSeguridad' => $respuestaSeguridad
    );
    $resultado->execute($array);

    $numRow = $resultado->rowCount();
    if ($numRow != 0) {
      $alumno = $resultado->fetch(PDO::FETCH_OBJ);

      // SI EN DADO CASO FUERAMOS A ENVIAR LA CONTRASEÑA DE ALUMNOS A SU CORREO
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $destinatario = 'soporte@secuencialab.x10host.com';
      $remitente = $alumno->email;
      $asunto = 'Restablecimiento  de contraseña.';
      $texto = 'Hola usuario ' . $alumno->nombrePila . ' ' . $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno . ' ';
      $texto = 'con código ' . $alumno->codigoAlumno . ' ';
      $texto = 'tu contraseña es: ' . $alumno->password;
      $message = $texto;
      $headers = 'From: ' . $destinatario;
      @mail($remitente, $asunto, $message, $headers);
      echo 'Correo exitosamente enviado a: ' . $remitente;

      /* $sql = 'UPDATE alumnousuario SET password = :nuevoPasswordUsuario
      WHERE codigoAlumno = :codigoAlumno';

      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':nuevoPasswordUsuario' => $nuevoPasswordUsuario,
        ':codigoAlumno' => $alumno->codigoAlumno
      );
      $resultado->execute($array);
      echo 'success'; */
    } else {
      echo 'Error. No se encontró un alumno con ese código.';
    }
  } else if (($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
    $sql = 'SELECT * FROM profesorusuario
    WHERE codigoProfesor = :codigoProfesor AND respuestaSeguridad = :respuestaSeguridad';

    $resultado = $baseDatos->prepare($sql);
    $array = array(
      ':codigoProfesor' => $claveUsuario,
      ':respuestaSeguridad' => $respuestaSeguridad
    );
    $resultado->execute($array);

    $numRow = $resultado->rowCount();
    if ($numRow != 0) {
      $profesor = $resultado->fetch(PDO::FETCH_OBJ);

      // SI EN DADO CASO FUERAMOS A ENVIAR LA CONTRASEÑA DE PROFESORES A SU CORREO
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $destinatario = 'soporte@secuencialab.x10host.com';
      $remitente = $profesor->email;
      $asunto = 'Restablecimiento de contraseña.';
      $texto = 'Hola usuario <b>' . $profesor->nombrePila . ' ' . $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno . '</b> ';
      $texto .= 'con código de usuario <b>' . $profesor->codigoProfesor . '</b> ';
      $texto .= 'tu contraseña es: ' . $profesor->password;
      $message = $texto;
      $headers = 'DE: ' . $destinatario;
      @mail($remitente, $asunto, $message, $headers);
      echo 'Correo exitosamente enviado a: ' . $remitente;

      /* $sql = 'UPDATE profesorusuario
      SET password = :nuevoPasswordUsuario
      WHERE codigoProfesor = :codigoProfesor';

      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':nuevoPasswordUsuario' => $nuevoPasswordUsuario,
        ':codigoProfesor' => $profesor->codigoProfesor
      );
      $resultado->execute($array);
      echo 'success'; */
    } else {
      echo 'Error. No se encontró un profesor con ese código.';
    }
  } else {
    echo 'No se encontró un usuario con el prefijo "' . $aux . '".';
  }
} catch (Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
