<?php
include('../operaciones/conexion.php');

try {
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $respuestaSeguridad = htmlentities(addslashes($_POST['respuestaSeguridad']));

  //Convertir elementos de texto en codificación UTF-8
  $claveUsuario = html_entity_decode($claveUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $respuestaSeguridad = html_entity_decode($respuestaSeguridad, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  //Convertir nombre completo del usaurio en mayusculas de usuario a mayusculas
  $claveUsuario = mb_strtoupper($claveUsuario, 'UTF-8');
  $respuestaHash = hash('sha1', $respuestaSeguridad, false);

  $aux = substr($claveUsuario, 0, 1);
  if ($aux == 'A' || $aux == 'a') {
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if ($numRow != 0) {
      $alumno = $resultado->fetch(PDO::FETCH_OBJ);
      if($alumno->respuestaSeguridad == $respuestaHash) {
        // SI EN DADO CASO FUERAMOS A ENVIAR LA CONTRASEÑA DE ALUMNOS A SU CORREO
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $para = $alumno->email;
        $asunto = 'Restablecimiento  de contraseña.';
        $mensaje = 'Que tal estimado usuario: ' . $alumno->nombrePila . ' ' . $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno . ' ';
        $mensaje .= 'con el siguiente código: ' . $alumno->codigoAlumno . ' ';
        $mensaje .= 'para actualizar tu contraseña, haz clic en el siguiente enlace: https://secuencialab1.hostingerapp.com/SecuenciaLab/utileria/sesion/reestablecer-contrasena.php?cu=\'' . base64_encode($alumno->codigoAlumno) . '\'';
        $cabecera = 'From: soportesecuencialab@secuencialab.com' . "\r\n" . 'Reply-To: soportesecuencialab@secuencialab.com' . "\r\n" . 'X-Mailer: HELLO-' . $para;
        mail($para, $asunto, $mensaje, $cabecera);
        echo 'Correo exitosamente enviado a: ' . $para;
      }
    } else {
      echo 'Error. No se encontró un alumno con ese código.';
    }
  } else if (($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cp', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    if ($numRow != 0) {
      $profesor = $resultado->fetch(PDO::FETCH_OBJ);
      if($profesor->respuestaSeguridad == $respuestaHash) {
        // SI EN DADO CASO FUERAMOS A ENVIAR LA CONTRASEÑA DE PROFESORES A SU CORREO
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $para = $profesor->email;
        $asunto = 'Restablecimiento  de contraseña.';
        $mensaje = 'Que tal estimado usuario: ' . $profesor->nombrePila . ' ' . $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno . ' ';
        $mensaje .= 'con el siguiente código: ' . $profesor->codigoProfesor . ' ';
        $mensaje .= 'para actualizar tu contraseña, haz clic en el siguiente enlace:  https://secuencialab1.hostingerapp.com/SecuenciaLab/utileria/sesion/reestablecer-contrasena.php?cu=\'' . base64_encode($profesor->codigoProfesor) . '\'';
        $cabecera = 'From: soportesecuencialab@secuencialab.com' . "\r\n" . 'Reply-To: soportesecuencialab@secuencialab.com' . "\r\n" . 'X-Mailer: HELLO-' . $para;
        mail($para, $asunto, $mensaje, $cabecera);
        echo 'Correo exitosamente enviado a: ' . $para;
      }
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
