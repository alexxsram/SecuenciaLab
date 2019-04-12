<?php
include('../operaciones/conexion.php');

try {
    $passwordUsuario = htmlentities(addslashes($_POST['passwordUsuario']));
    //$passwordHash =  password_hash($passwordUsuario, PASSWORD_DEFAULT, array("cost"=>30)); Ejemplo de como convertir la contraseña en un hash
    $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));

    $aux = substr($claveUsuario, 0, 1);

    if($aux == 'A' || $aux == 'a') {
        $sql = 'UPDATE alumnousuario SET password = :p WHERE codigoAlumno = :ca';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':p'=>$passwordUsuario, ':ca'=>$claveUsuario);
        $resultado->execute($array);
        echo 'success';
    } else {
        $sql = 'UPDATE profesorusuario SET password = :p WHERE codigoProfesor = :cp';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':p'=>$passwordUsuario, ':cp'=>$claveUsuario);
        $resultado->execute($array);
        echo 'success';
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>