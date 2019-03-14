<?php
include('../operaciones/conexion.php');

try {
    $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
    $passwordUsuario = htmlentities(addslashes($_POST['passwordUsuario']));


    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :codigoProfesor';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':codigoProfesor', $claveUsuario);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    if($numRow != 0) {
        session_start();
        $profesor = $resultado->fetch(PDO::FETCH_OBJ);
        if($profesor->password == $passwordUsuario) {
            $_SESSION['codigo'] = $profesor->codigoProfesor;
            $_SESSION['nombre'] = $profesor->nombrePila . ' ' . $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno;
            $_SESSION['estado'] = 'INICIO_SESION_PROFESOR';
            echo "success";
        }
        else {
            echo 'Contraseña incorrecta, intente de nuevo.';
        }
    }
    else {
        echo 'Clave de profesor no encontrada.';
    }
} catch(Exception $exec) {
    die("Error en la base de datos: " . $exec->getMessage());
}

?>