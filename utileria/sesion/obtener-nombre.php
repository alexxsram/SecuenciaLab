<?php
include('../operaciones/conexion.php');

try {
  //$passwordHash =  password_hash($passwordUsuario, PASSWORD_DEFAULT, array("cost"=>30)); Ejemplo de como convertir la contraseña en un hash
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $aux = substr($claveUsuario, 0, 1);

  if($aux == 'A' || $aux == 'a') {
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno= :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    
    if($numRow != 0) {
      $usuario = $resultado->fetch(PDO::FETCH_OBJ);
      $array = array();
      $array['nombrePila'] = $usuario->nombrePila;
      $array['apellidoPaterno'] = $usuario->apellidoPaterno;
      $array['apellidoMaterno'] = $usuario->apellidoMaterno;
      echo json_encode($array);
    } else {
      echo 'Error. El usuario (Alumno) no es valido. ' . $claveUsuario;
    }
  } else if(($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')){
    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor= :cp';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cp', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();

    if($numRow != 0) {
      $usuario = $resultado->fetch(PDO::FETCH_OBJ);
      $array = array();
      $array['nombrePila'] = $usuario->nombrePila;
      $array['apellidoPaterno'] = $usuario->apellidoPaterno;
      $array['apellidoMaterno'] = $usuario->apellidoMaterno;
      echo json_encode($array);
    } else {
      echo 'Error. El usuario (Profesor) no es valido. ' . $claveUsuario;
    }
  } else {
    echo 'Error. Tipo de usuario desconocido. ' . $claveUsuario;
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
