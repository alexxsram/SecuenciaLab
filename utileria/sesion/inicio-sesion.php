<?php
include('../operaciones/conexion.php');

try {
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $passwordUsuario = htmlentities(addslashes($_POST['passwordUsuario']));

  $aux = substr($claveUsuario, 0, 1);

  if(($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cp', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    if($numRow != 0) {
      session_start();
      $profesor = $resultado->fetch(PDO::FETCH_OBJ);
      //if(password_verify($passwordUsuario, $profesor->password)) { Esta linea solo se descomenta y se borra la de abajo, con esto se verifica la contraseña con la del hash
      if($profesor->password == $passwordUsuario) {
        $_SESSION['codigo'] = $profesor->codigoProfesor;
        $_SESSION['nombre'] = $profesor->nombrePila . ' ' . $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno;
        // if($profesor->permiso == 'dba') {
        //   $_SESSION['estado'] = 'INICIO_SESION_ADMIN';
        // } else {
        //   $_SESSION['estado'] = 'INICIO_SESION_PROFESOR';
        // }
        $_SESSION['permiso'] = $profesor->permiso;
        $_SESSION['tiempo_sesion'] = time();
        echo 'success';
      } else {
        echo 'Contraseña incorrecta, intente de nuevo.';
      }
    } else {
      echo 'Clave de profesor no encontrada.';
    }
  } else {
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    if($numRow != 0) {
      session_start();
      $alumno = $resultado->fetch(PDO::FETCH_OBJ);
      if($alumno->password == $passwordUsuario) {
        $_SESSION['codigo'] = $alumno->codigoAlumno;
        $_SESSION['nombre'] = $alumno->nombrePila . ' ' . $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno;
        // $_SESSION['estado'] = 'INICIO_SESION_ALUMNO';
        $_SESSION['permiso'] = 'alumno';
        $_SESSION['tiempo_sesion'] = time();
        echo 'success';
      } else {
        echo 'Contraseña incorrecta, intente de nuevo.';
      }
    } else {
      echo 'Clave de alumno no encontrada.';
    }
  }
} catch(Exception $exec) {
  die("Error en la base de datos: " . $exec->getMessage());
}
?>
