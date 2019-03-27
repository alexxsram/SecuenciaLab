<?php
include('../operaciones/conexion.php');

try {
    $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
    $passwordUsuario = htmlentities(addslashes($_POST['passwordUsuario']));

    $aux = substr($claveUsuario, 0, 1);

    if($aux == "P" || $aux == "p") {
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
    } else {
        $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :codigoAlumno';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoAlumno', $claveUsuario);
        $resultado->execute();

        $numRow = $resultado->rowCount();
        if($numRow != 0) {
            session_start();
            $alumno = $resultado->fetch(PDO::FETCH_OBJ);
            if($alumno->password == $passwordUsuario) {
                $_SESSION['codigo'] = $alumno->codigoAlumno;
                $_SESSION['nombre'] = $alumno->nombrePila . ' ' . $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno;
                $_SESSION['estado'] = 'INICIO_SESION_ALUMNO';
                echo "success";
            }
            else {
                echo 'Contraseña incorrecta, intente de nuevo.';
            }
        }
        else {
            echo 'Clave de alumno no encontrada.';
        }
    }
} catch(Exception $exec) {
    die("Error en la base de datos: " . $exec->getMessage());
}

?>
