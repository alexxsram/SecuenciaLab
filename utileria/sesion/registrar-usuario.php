<?php
include('../operaciones/conexion.php');

try {
    $claveUsuario = htmlentities(addslashes($_POST['claveUsuario']));
    $nombrePilaUsuario = htmlentities(addslashes($_POST['nombrePilaUsuario']));
    $apellidoPaternoUsuario = htmlentities(addslashes($_POST['apellidoPaternoUsuario']));
    $apellidoMaternoUsuario = htmlentities(addslashes($_POST['apellidoMaternoUsuario']));
    $emailUsuario = htmlentities(addslashes($_POST['emailUsuario']));
    $preguntaSeguridad = htmlentities(addslashes($_POST['preguntaSeguridad']));
    $respuestaSeguridad = htmlentities(addslashes($_POST['respuestaSeguridad']));
    $password = htmlentities(addslashes($_POST['password']));
    $confirPassword = htmlentities(addslashes($_POST['confirPassword']));
    $aux = substr($claveUsuario, 0, 1);
    echo "entra al funcionamiento"
    if($aux == "P" || $aux == "p") {
        $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :codigoProfesor';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoProfesor', $claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 0) {
          $sql = "INSERT INTO profesorusuario (codigoProfesor, nombrePila, apellidoPaterno,
                       apellidoMaterno, password)
                       VALUES ('$claveUsuario', '$nombrePilaUsuario', '$apellidoPaternoUsuario', '$apellidoMaternoUsuario', '$password')";
                       if ($baseDatos->query($sql) === TRUE) {
                           echo "New record created successfully";
                       } else {
                           echo "Error: " . $sql . "<br>" . $conn->error;
                       }
                       echo "success";
            }
            else {
                echo 'Contraseña incorrecta, intente de nuevo.';
            }
        }
        else {
            echo 'La clave del profesor ya se encuentra registrada.';
        }
    } else if($aux == "A") {
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
    }else{
      echo 'Error. Falta el prefijo en el codigo.'
    }
} catch(Exception $exec) {
    die("Error en la base de datos: " . $exec->getMessage());
}

?>
