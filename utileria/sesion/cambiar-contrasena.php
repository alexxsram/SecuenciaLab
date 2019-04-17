<?php
include('../operaciones/conexion.php');

try {
  $passwordUsuarioViejo = htmlentities(addslashes($_POST['actualPasswordUsuario']));
  $passwordUsuario = htmlentities(addslashes($_POST['nuevoPasswordUsuario']));
  //$passwordHash =  password_hash($passwordUsuario, PASSWORD_DEFAULT, array("cost"=>30)); Ejemplo de como convertir la contraseña en un hash
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $aux = substr($claveUsuario, 0, 1);

  if($aux == 'A' || $aux == 'a') {
    $sql = "SELECT * FROM alumnousuario WHERE codigoAlumno= :codigoAlumno";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':codigoAlumno', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow!=0){
      $usuario = $resultado->fetch(PDO::FETCH_OBJ);
      if($usuario->password == $passwordUsuarioViejo){
        $sql = 'UPDATE alumnousuario SET password = :p WHERE codigoAlumno = :ca';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':p'=>$passwordUsuario, ':ca'=>$claveUsuario);
        $resultado->execute($array);
        echo 'success';
      }else{
        echo "Error. La contraseña actual es incorrecta. No se a realizado ningun cambio.";
      }
    }else{
      echo "Error. El usuario no es valido.";
    }
  } else {
    $sql = "SELECT * FROM profesorusuario WHERE codigoProfesor= :codigoProfesor";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':codigoProfesor', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow!=0){
      $usuario = $resultado->fetch(PDO::FETCH_OBJ);
      if($usuario->password == $passwordUsuarioViejo){
        $sql = 'UPDATE profesorusuario SET password = :p WHERE codigoProfesor = :cp';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':p'=>$passwordUsuario, ':cp'=>$claveUsuario);
        $resultado->execute($array);
        echo 'success';
      }else{
        echo "Error. La contraseña actual es incorrecta. No se a realizado ningun cambio.";
      }
    }else{
      echo "Error. El usuario no es valido.";
    }
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
