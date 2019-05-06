<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
include('../operaciones/conexion.php');

$idPractica = base64_decode($_GET['idPractica']);

try {
    $sql = 'SELECT * FROM practica WHERE idPractica = :ip';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ip', $idPractica);
    $resultado->execute();

    $practica = $resultado->fetch(PDO::FETCH_OBJ);
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
    <div class="container">

        <!-- JUMBOTRON DE LOS DATOS DE LA CLASE -->
        <div class="jumbotron col-12">
            <div class="container">
                <blockquote class="blockquote text-center">
                    <h1 class="display-4"> Calificar practica "<?php echo $practica->nombre; ?>" </h1>
                </blockquote>

                <p class="lead text-justify">
                    En la siguiente sección el profesor puede califiar la practica a aquellos alumnos que han realizado su entrega
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
                        <select class="custom-select mr-sm-2" id="alumnoEntregado" name="alumnoEntregado" onchange="insercionPorAjax('GET', 'cargar-detalle-entrega.php?codigoAlumno=' + this.value + '&idPractica=' + <?php echo $practica->idPractica; ?>, '#respuestasPractica');">
                            <option value="" selected>Seleccionar alumno...</option>
                            <?php foreach ($entregados as $entregado) { ?>
                                <option value="<?php echo $entregado->codigoAlumno?>"><?php echo $entregado->apellidoPaterno . ' ' . $entregado->apellidoMaterno . ' ' . $entregado->nombrePila; ?></option>      
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
                </div>
            </div>
        </div>
        <!-- FIN DEL JUMBOTRON DE LOS DATOS DE LA CLASE -->

        <!-- CONTENIDO PARA CALIFICAR LA PRACTICA -->
        <div class="card border-dark mb-3">
            <div class="card-header border-dark">Información de la práctica</div>
            <div class="card-body text-dark">
                <h5 class="card-title">Descripcion del problema</h5>
                <p class="card-text"><?php echo $practica->descripcion; ?></p>
                <hr>
                <div id="respuestasPractica"></div>
            </div>
        </div>
        <!-- FIN DEL CONTENIDO PARA CALIFICAR UNA PRACTICA -->
    </div>
    <!-- FIN DEL CONTAINER -->

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>

</html>

<?php
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
