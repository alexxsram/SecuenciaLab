<?php
include('../operaciones/conexion.php');

try {
  $passwordUsuarioViejo = htmlentities(addslashes($_POST['actualPasswordUsuario']));
  $passwordUsuario = htmlentities(addslashes($_POST['nuevoPasswordUsuario']));
  $passwordHash = password_hash($passwordUsuario, PASSWORD_DEFAULT, array('cost' => 13)); 
  $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
  $aux = substr($claveUsuario, 0, 1);

  if($aux == 'A' || $aux == 'a') {
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno= :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if($numRow != 0) {
      $usuarioA = $resultado->fetch(PDO::FETCH_OBJ);
      if(password_verify($passwordUsuarioViejo, $usuarioA->password)) {
      // if($usuario->password == $passwordUsuarioViejo){
        $sql = 'UPDATE alumnousuario SET password = :p WHERE codigoAlumno = :ca';
        $resultado = $baseDatos->prepare($sql);
        $array = array(
          ':p' => $passwordHash,
          ':ca' => $claveUsuario
        );
        $resultado->execute($array);

        echo 'success';
      } else {
        echo 'Error. La contraseña actual es incorrecta. No se ha realizado ningún cambio.';
      }
    } else {
      echo 'Error. El usuario no es válido.';
    }
  } else if(($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor= :cp';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':cp', $claveUsuario);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if($numRow != 0) {
      $usuarioP = $resultado->fetch(PDO::FETCH_OBJ);
      if(password_verify($passwordUsuarioViejo, $usuarioP->password)) {
      // if($usuario->password == $passwordUsuarioViejo){
        $sql = 'UPDATE profesorusuario SET password = :p WHERE codigoProfesor = :cp';
        $resultado = $baseDatos->prepare($sql);
        $array = array(
          ':p' => $passwordHash, 
          ':cp' => $claveUsuario
        );
        $resultado->execute($array);

        echo 'success';
      } else {
        echo 'Error. La contraseña actual es incorrecta. No se ha realizado ningún cambio.';
      }
    } else {
      echo 'Error. El usuario no es válido.';
    }
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
