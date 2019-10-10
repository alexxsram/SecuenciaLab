<?php
session_start();
if(!isset($_SESSION['codigo']) && $_SESSION['permiso'] == '') {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $permiso = $_SESSION['permiso'];
    // $tiempo = $_SESSION['tiempo_sesion'];
    // if(time() - $tiempo >= 10){
    //     header('Location: utileria/sesion/cerrar-sesion.php');
    // }
    // else {
    //     $_SESSION['tiempo_sesion'] = time();
    // }
}
include('../operaciones/conexion.php');

$criterioCalificar = base64_decode($_GET['criterioCalificar']);

try {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">

    <title> Evaluar práctica </title>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container" style="margin-bottom: 6%;">
        <!-- JUMBOTRON DE LOS DATOS DE LA CLASE -->
        <div class="jumbotron col-12">
            <div class="container">
                <?php
                if(substr($criterioCalificar, 0, 1) != 'A') { // es decir, que si se califica desde las practicas
                    $idPractica = $criterioCalificar;
                    $sql = 'SELECT * FROM practica WHERE idPractica = :ip';
                    $resultado = $baseDatos->prepare($sql);
                    $resultado->bindValue(':ip', $idPractica);
                    $resultado->execute();
                    $numRow = $resultado->rowCount();
                    if($numRow == 1) {
                        $practica = $resultado->fetch(PDO::FETCH_OBJ);
                ?>

                        <blockquote class="blockquote text-center">
                            <h1 class="display-4"> Calificar practica "<?php echo $practica->nombre; ?>" </h1>
                        </blockquote>

                        <p class="lead text-justify">
                            En la siguiente sección el profesor puede calificar la práctica a aquellos alumnos que han realizado su entrega
                            de forma correspondiente, esto se revisa mediante un filtro y lista a aquellos alumnos que han entregado dicha práctica.
                        </p>

                        <div class="form-inline">
                            <?php
                            $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno IN (SELECT AlumnoUsuario_codigoAlumno FROM cuestionario WHERE Practica_idPractica = :pip)';
                            $resultado = $baseDatos->prepare($sql);
                            $resultado->bindValue(':pip', $practica->idPractica);
                            $resultado->execute();
                            $numRow = $resultado->rowCount();
                            if($numRow != 0) {
                                $entregados = $resultado->fetchAll(PDO::FETCH_OBJ);
                            ?>

                                <div class="form-group">
                                    <label class="mr-sm-2" for="alumnoEntregado">Entregas realizadas</label>
                                    <select class="custom-select mr-sm-2" id="alumnoEntregado" name="alumnoEntregado" onchange="insercionPorAjax('GET', 'cargar-detalle-entrega.php?codigoAlumno=' + this.value + '&idPractica=' + <?php echo $practica->idPractica; ?> + '&criterio=P', '#detalleEntrega');">
                                        <option value="" selected>Seleccionar alumno...</option>
                                        <?php
                                        foreach ($entregados as $entregado) {
                                            $sql = 'SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca)';
                                            $resultado = $baseDatos->prepare($sql);
                                            $resultado->bindValue(':pip', $practica->idPractica);
                                            $resultado->bindValue(':auca', $entregado->codigoAlumno);
                                            $resultado->execute();

                                            $numRowSiYaCalificaron = $resultado->rowCount();

                                            if($numRowSiYaCalificaron == 0) {
                                        ?>

                                                <option value="<?php echo $entregado->codigoAlumno; ?>"><?php echo '(NCAL) ' . $entregado->codigoAlumno . ' - ' . $entregado->apellidoPaterno . ' ' . $entregado->apellidoMaterno . ' ' . $entregado->nombrePila; ?></option>

                                            <?php } else { ?>

                                                <option value="<?php echo $entregado->codigoAlumno; ?>"><?php echo '(SCAL) ' . $entregado->codigoAlumno . ' - ' . $entregado->apellidoPaterno . ' ' . $entregado->apellidoMaterno . ' ' . $entregado->nombrePila; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            <?php } ?>
                            <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
                        </div>

                <?php
                    } else {
                        echo '<script>window.close();</script>';
                    }
                } else { // es decir, que si se califica desde la lista de alumnos
                    $codigoAlumno = $criterioCalificar;
                    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
                    $resultado = $baseDatos->prepare($sql);
                    $resultado->bindValue(':ca', $codigoAlumno);
                    $resultado->execute();
                    $numRow = $resultado->rowCount();
                    if($numRow == 1) {
                        $alumno = $resultado->fetch(PDO::FETCH_OBJ);
                ?>

                        <blockquote class="blockquote text-center">
                            <h1 class="display-4"> Calificar alumno "<?php echo $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno . ' ' . $alumno->nombrePila; ?>" </h1>
                        </blockquote>

                        <p class="lead text-justify">
                            En la siguiente sección el profesor puede calificar al alumno que ha realizado la entrega de las prácticas
                            de forma correspondiente, esto se revisa mediante un filtro y lista aquellas prácticas que el alumno ha entregado.
                        </p>

                        <div class="form-inline">
                            <?php
                            $sql = 'SELECT * FROM practica WHERE idPractica IN (SELECT Practica_idPractica FROM cuestionario WHERE AlumnoUsuario_codigoAlumno = :auca AND practica.nombre != :n)';
                            $resultado = $baseDatos->prepare($sql);
                            $resultado->bindValue(':auca', $alumno->codigoAlumno);
                            $resultado->bindValue(':n', "Evaluación difusa de la clase");
                            $resultado->execute();
                            $numRow = $resultado->rowCount();
                            if($numRow != 0) {
                                $entregados = $resultado->fetchAll(PDO::FETCH_OBJ);
                            ?>

                                <div class="form-group">
                                    <label class="mr-sm-2" for="practicaEntregado">Entregas realizadas</label>
                                    <select class="custom-select mr-sm-2" id="practicaEntregado" name="practicaEntregado" onchange="insercionPorAjax('GET', 'cargar-detalle-entrega.php?codigoAlumno=' + <?php echo '\'' . $alumno->codigoAlumno . '\''; ?> + '&idPractica=' + this.value + '&criterio=A', '#detalleEntrega');">
                                        <option value="" selected>Seleccionar práctica...</option>
                                        <?php
                                        foreach ($entregados as $entregado) {
                                            $sql = 'SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca)';
                                            $resultado = $baseDatos->prepare($sql);
                                            $resultado->bindValue(':pip', $entregado->idPractica);
                                            $resultado->bindValue(':auca', $alumno->codigoAlumno);
                                            $resultado->execute();
                                            $numRowSiYaCalificaron = $resultado->rowCount();
                                            if($numRowSiYaCalificaron == 0) {
                                        ?>

                                                <option value="<?php echo $entregado->idPractica; ?>"><?php echo '(NCAL) ' . $entregado->nombre; ?></option>

                                            <?php } else { ?>

                                                <option value="<?php echo $entregado->idPractica; ?>"><?php echo '(SCAL) ' . $entregado->nombre; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            <?php } ?>
                            <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
                        </div>

                <?php
                    } else {
                        echo '<script>window.close();</script>';
                    }
                }
                ?>
            </div>
        </div>
        <!-- FIN DEL JUMBOTRON DE LOS DATOS DE LA CLASE -->

        <!-- CONTENIDO PARA CALIFICAR LA PRACTICA -->
        <div id="detalleEntrega"></div>
        <!-- FIN DEL CONTENIDO PARA CALIFICAR UNA PRACTICA -->
    </div>
    <!-- FIN DEL CONTAINER -->

    <footer class="footer fixed-bottom py-2 bg-light shadow text-dark-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>
</html>

<?php
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
