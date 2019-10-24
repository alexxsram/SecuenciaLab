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
            $passwordHash = password_hash(substr($usuario->codigoProfesor, 1), PASSWORD_DEFAULT, array('cost' => 13));
            $sql = 'UPDATE profesorusuario SET password = :p WHERE codigoProfesor = :cp';
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':p', $passwordHash); 
            $resultado->bindValue(':cp', $usuario->codigoProfesor);
            $resultado->execute();
            echo 'Contraseña profesor { '.$usuario->codigoProfesor.' } actualizada.<br>';
        }
    }

    if($users == 'alumnos') {
        $sql = 'SELECT * FROM alumnousuario';
        $resultado = $baseDatos->prepare($sql);
        $resultado->execute();

        $aUsuarios = $resultado->fetchAll(PDO::FETCH_OBJ);

        foreach($aUsuarios as $usuario) {
            $passwordHash = password_hash(substr($usuario->codigoAlumno, 1), PASSWORD_DEFAULT, array('cost' => 13)); 
            $sql = 'UPDATE alumnousuario SET password = :p WHERE codigoAlumno = :ca';
            $resultado = $baseDatos->prepare($sql);
            $array = array(':p' => $passwordHash, ':ca' => $usuario->codigoAlumno);
            $resultado->execute($array);
            echo 'Contraseña alumno { '.$usuario->codigoAlumno.' } actualizada.<br>';
        }
    }
} catch(Exception $exec) {
    die('Error: ' . $exec->getMessage());
}
?>