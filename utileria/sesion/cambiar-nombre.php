<?php
include('../operaciones/conexion.php');

try {
  $nombrePilaUsuario = htmlentities(addslashes($_POST['nomprePila']));
  $apellidoPaternoUsuario = htmlentities(addslashes($_POST['apellidoPaterno']));
  $apellidoMaternoUsuario = htmlentities(addslashes($_POST['apellidoMaterno']));
  //Para la correcta intrepretación de acentos
  $nombrePilaUsuario = html_entity_decode($nombrePilaUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $apellidoPaternoUsuario = html_entity_decode($apellidoPaternoUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $apellidoMaternoUsuario = html_entity_decode($apellidoMaternoUsuario, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  //Convertir nombre completo del usaurio en mayusculas de usuario a mayusculas
  $nombrePilaUsuario = mb_strtoupper($nombrePilaUsuario,'UTF-8');
  $apellidoPaternoUsuario = mb_strtoupper($apellidoPaternoUsuario,'UTF-8');
  $apellidoMaternoUsuario = mb_strtoupper($apellidoMaternoUsuario,'UTF-8');
  //$passwordHash =  password_hash($passwordUsuario, PASSWORD_DEFAULT, array("cost"=>30)); Ejemplo de como convertir la contraseña en un hash
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $aux = substr($claveUsuario, 0, 1);

  if($aux == 'A' || $aux == 'a') {
    $sql = "SELECT *
    FROM alumnousuario
    WHERE codigoAlumno= :codigoAlumno";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':codigoAlumno', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow!=0){
      $sql = 'UPDATE alumnousuario
      SET nombrePila = :nomP,
      apellidoPaterno = :apePa,
      apellidoMaterno = :apeMa
      WHERE codigoAlumno = :ca';
      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':nomP' => $nombrePilaUsuario,
        ':apePa' => $apellidoPaternoUsuario,
        ':apeMa' => $apellidoMaternoUsuario,
        ':ca' => $claveUsuario
      );
      $resultado->execute($array);
      echo 'success';
    }else{
      echo "Error. El usuario (Alumno) no es valido. " . $claveUsuario;
    }
  } else if($aux == 'P' || $aux == 'p'){
    $sql = "SELECT *
    FROM profesorusuario
    WHERE codigoProfesor = :codigoProfesor";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':codigoProfesor', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow!=0){
      $sql = 'UPDATE profesorusuario
      SET nombrePila = :nomP,
      apellidoPaterno = :apePa,
      apellidoMaterno = :apeMa
      WHERE codigoProfesor = :cp';
      $resultado = $baseDatos->prepare($sql);
      $array = array(
        ':nomP' => $nombrePilaUsuario,
        ':apePa' => $apellidoPaternoUsuario,
        ':apeMa' => $apellidoMaternoUsuario,
        ':cp' => $claveUsuario
      );
      $resultado->execute($array);
      echo 'success';
    }else{
      echo "Error. El usuario (Profesor) no es valido. " . $claveUsuario;
    }
  }else{
    echo "Error. Tipo de usuario desconocido. " . $claveUsuario;
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
