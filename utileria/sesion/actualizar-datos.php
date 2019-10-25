<?php
include('../operaciones/conexion.php');
try {
    $users = $_GET['usuarios'];

    if($users == 'profesores') {
        $sql = 'SELECT * FROM profesorusuario';
        $resultado = $baseDatos->prepare($sql);
        $resultado->execute();

        $pUsuarios = $resultado->fetchAll(PDO::FETCH_OBJ);

        foreach($pUsuarios as $usuario) {
            $respuestaHash = hash('sha1', $usuario->respuestaSeguridad, false);
            $passwordHash = password_hash(substr($usuario->codigoProfesor, 1), PASSWORD_DEFAULT, array('cost' => 13));
            $sql = 'UPDATE profesorusuario SET respuestaSeguridad = :rs, password = :p WHERE codigoProfesor = :cp';
            $resultado = $baseDatos->prepare($sql);
            $array = array(':rs' => $respuestaHash, ':p' => $passwordHash, ':cp' => $usuario->codigoProfesor);
            $resultado->execute($array);
            echo 'Contraseña profesor { '.$usuario->codigoProfesor.' } actualizada.<br>';
        }
    }

    if($users == 'alumnos') {
        $sql = 'SELECT * FROM alumnousuario';
        $resultado = $baseDatos->prepare($sql);
        $resultado->execute();

        $aUsuarios = $resultado->fetchAll(PDO::FETCH_OBJ);

        foreach($aUsuarios as $usuario) {
            $respuestaHash = hash('sha1', $usuario->respuestaSeguridad, false);
            $passwordHash = password_hash(substr($usuario->codigoAlumno, 1), PASSWORD_DEFAULT, array('cost' => 13)); 
            $sql = 'UPDATE alumnousuario SET respuestaSeguridad = :rs, password = :p WHERE codigoAlumno = :ca';
            $resultado = $baseDatos->prepare($sql);
            $array = array(':rs' => $respuestaHash, ':p' => $passwordHash, ':ca' => $usuario->codigoAlumno);
            $resultado->execute($array);
            echo 'Contraseña alumno { '.$usuario->codigoAlumno.' } actualizada.<br>';
        }
    }
} catch(Exception $exec) {
    die('Error: ' . $exec->getMessage());
}
?>