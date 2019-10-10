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

    $botonVisible = '';
    if($permiso == 'pnormal') {
        $botonVisible = 'd-none'; //clase de bootstrap que oculta un elemento, lo mismo que usae el css de "display: none;" pero más práctico
    }
}
include('../operaciones/conexion.php');

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);

try {
    $sql = 'SELECT * FROM clase WHERE claveAcceso = :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveAccesoClase);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    if($numRow == 1) {
        $clase = $resultado->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">

    <title> <?php echo $clase->nombreClase; ?> </title>
</head>
<body>
    <!-- CONTAINER -->
    <div class="container" style="margin-bottom: 6%;">
        <?php
        $sql = 'SELECT * FROM cicloescolar WHERE idCicloEscolar = :ice';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':ice', $clase->CicloEscolar_idCicloEscolar);
        $resultado->execute();
        $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
        ?>

        <!-- JUMBOTRON DE LOS DATOS DE LA CLASE -->
        <div class="jumbotron col-12">
            <!-- CONTAINER DEL JUMBOTRON -->
            <div class="container">
                <blockquote class="blockquote text-center">
                    <h1 class="display-4"> <?php echo $clase->nombreClase; ?> </h1>
                </blockquote>

                <p class="h6">
                    <small class="text-muted"> Materia: <?php echo $clase->nombreMateria; ?> </small>
                </p>

                <p class="h6">
                    <small class="text-muted"> Sección: <?php echo $clase->claveSeccion; ?> </small>
                </p>

                <p class="h6">
                    <small class="text-muted"> Aula: <?php echo $clase->aula; ?> </small>
                </p>

                <p class="h6">
                    <small class="text-muted"> Ciclo: <?php echo $clase->anio . ' ' . $ciclo->ciclo; ?> </small>
                </p>

                <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                    <p class="h6">
                        <small class="text-muted">
                            Clave de acceso: <?php echo $clase->claveAcceso; ?>
                            <button class="btn" style="background-color: transparent;" data-toggle="tooltip" title="Mostrar" onclick="expandirClaveAcceso(<?php echo '\'' . $clase->claveAcceso . '\''; ?>);">
                                <i class="fas fa-sign-in-alt"></i>
                            </button>
                        </small>
                    </p>

                    <p class="lead text-justify">
                        En la siguiente sección, el profesor puede crear las prácticas de laboratorio relacionadas al manual
                    </p>

                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones de la clase
                        </button>

                        <div class="dropdown-menu">
                            <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearAnuncio" data-codigoprofesor="<?php echo $codigo; ?>" data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                <i class="fas fa-info-circle"></i> Agregar anuncio
                            </button>

                            <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearPractica" data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                <i class="fas fa-clipboard"></i> Agregar práctica
                            </button>

                            <?php
                            $sql = 'SELECT * FROM practica WHERE Clase_claveAcceso = :cca ORDER BY fechaLimite ASC';
                            $resultado = $baseDatos->prepare($sql);
                            $resultado->bindValue(':cca', $clase->claveAcceso);
                            $resultado->execute();
                            $numRow = $resultado->rowCount();
                            $yaAsignadaEvaluacionClase = false;

                            if($numRow > 0) {
                                $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
                                foreach($practicas as $practica) {
                                    if($practica->nombre == 'Evaluación difusa de la clase') {
                                        $yaAsignadaEvaluacionClase = true;
                                        break;
                                    }
                                }
                            }

                            if(!$yaAsignadaEvaluacionClase) {
                            ?>

                            <button class="dropdown-item" data-toggle="modal" data-target="#modalAsignarEvaluacionDifusa" data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                <i class="fas fa-user-alt"></i> Evaluación clase
                            </button>

                            <?php } ?>

                            <button class="dropdown-item" onclick="cargarContenido('../../DOCS/examples/', 'reporte-calificaciones-clase.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?>);">
                                <i class="fas fa-file-pdf"></i> PDF calificaciones
                            </button>
                        </div>
                    </div>
                <?php } else if($permiso == 'alumno') { ?>
                    <p class="h6">
                        <small class="text-muted"> Clave de acceso: <?php echo $clase->claveAcceso; ?> </small>
                    </p>
                <?php } ?>

                <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
            </div>
            <!-- FIN DEL CONTAINER DEL JUMBOTRON -->
        </div>
        <!-- FIN DEL JUMBOTRON DE LOS DATOS DE LA CLASE -->

        <!-- PESTAÑAS/TABS DEL CONTENIDO -->
        <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">

            <!-- HEADER DE LOS TAB -->
            <div class="card-header bg-dark border-dark">
                <ul class="nav nav-pills justify-content-end card-header-pills text-white" id="tabsDashboard" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tablero-tab" data-toggle="tab" href="#tablero" role="tab" aria-controls="tablero" aria-selected="true">Tablero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="practica-tab" data-toggle="tab" href="#practica" role="tab" aria-controls="practica" aria-selected="true">Práctica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="alumnos" aria-selected="true">Alumnos</a>
                    </li>
                </ul>
            </div>
            <!-- FIN DEL HEADER DE LOS TAB -->

            <!-- CUERPO DE LOS TAB -->
            <div class="card-body">

                <!-- CONTENIDO DEL TAB -->
                <div class="tab-content" id="myTabContent">

                    <!-- TAB DEL TABLERO/ANUNCIOS -->
                    <div class="tab-pane fade show active" id="tablero" role="tabpanel" aria-labelledby="tablero-tab">
                        <?php
                        if($permiso == 'dba' || $permiso == 'padminss') {
                            $sql = 'SELECT * FROM anuncio
                            WHERE Clase_claveAcceso = :cca 
                            ORDER BY fechaPublicacion DESC';
                            $resultado = $baseDatos->prepare($sql);
                            $array = array(':cca' => $clase->claveAcceso);
                            $resultado->execute($array);
                        } else if($permiso == 'pnormal') {
                            $sql = 'SELECT * FROM anuncio 
                            WHERE ProfesorUsuario_codigoProfesor = :pucp AND Clase_claveAcceso = :cca AND eliminado != true 
                            ORDER BY fechaPublicacion DESC';
                            $resultado = $baseDatos->prepare($sql);
                            $array = array(':pucp' => $codigo, ':cca' => $clase->claveAcceso);
                            $resultado->execute($array);
                        } else if($permiso == 'alumno') {
                            $sql = 'SELECT * FROM anuncio 
                            WHERE Clase_claveAcceso IN ( SELECT Clase_claveAcceso FROM clase_has_alumnousuario WHERE Clase_claveAcceso = :cca AND permiso != false )
                            ORDER BY fechaPublicacion DESC';
                            $resultado = $baseDatos->prepare($sql);
                            $array = array(':cca' => $clase->claveAcceso);
                            $resultado->execute($array);
                        }
                        $numRow = $resultado->rowCount();

                        if($numRow == 0) {
                        ?>

                            <div class="col-12 text-center">
                                <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                                    <h1 class="font-weight-light">La clase no tiene anuncios</h1>
                                    <p class="lead">Se debe crear uno, para revisión de trabajo pendiente.</p>
                                <?php } else if($permiso == 'alumno') { ?>
                                    <h1 class="font-weight-light">La clase no tiene anuncios</h1>
                                    <p class="lead">Esperar anuncios.</p>
                                <?php } ?>
                            </div>

                        <?php
                        } else {
                            $anuncios = $resultado->fetchAll(PDO::FETCH_OBJ);
                            foreach ($anuncios as $anuncio) {
                                $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';
                                $resultado = $baseDatos->prepare($sql);
                                $resultado->bindValue(':cp', $anuncio->ProfesorUsuario_codigoProfesor);
                                $resultado->execute();
                                $profesorAnuncio = $resultado->fetch(PDO::FETCH_OBJ);
                        ?>

                                <!-- EJEMPLO DE CARD PARA ANUNCIOS -->
                                <div class="card gedf-card" style="margin-bottom: 15px;">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mr-2">
                                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                                </div>

                                                <div class="ml-2">
                                                    <div class="h6 m-0 text-muted"> <?php echo $profesorAnuncio->nombrePila . ' ' . $profesorAnuncio->apellidoPaterno . ' ' . $profesorAnuncio->apellidoMaterno; ?> </div>
                                                    <div class="h7 text-muted"> a <?php echo $clase->nombreClase; ?> </div>
                                                </div>
                                            </div>

                                            <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                        <div class="h6 dropdown-header">Configuración</div>

                                                        <button class="dropdown-item" data-toggle="modal"  data-target="#modalEditarAnuncio" data-idanuncio="<?php echo $anuncio->idAnuncio; ?>" data-titulo="<?php echo $anuncio->titulo; ?>" data-contenido="<?php echo $anuncio->contenido; ?>" data-fechapublicacion="<?php echo $anuncio->fechaPublicacion; ?>" data-claveacceso="<?php echo $anuncio->Clase_claveAcceso; ?>">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>

                                                        <button type="button" class="dropdown-item <?php echo $botonVisible; ?>" onclick="confirmarAccion(<?php echo '\'' . $anuncio->idAnuncio . '-' . $anuncio->titulo . '-' . $clase->claveAcceso . '\'';?>, 'anuncio');">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-muted h7 mb-2">
                                            <i class="fas fa-calendar"></i>
                                            <?php
                                            $fecha = date_create($anuncio->fechaPublicacion);
                                            echo date_format($fecha, 'l jS F Y');
                                            ?>
                                        </div>

                                        <p class="card-link">
                                            <h5 class="card-title"> <?php echo $anuncio->titulo; ?> </h5>
                                        </p>

                                        <p class="card-text text-muted">
                                            <?php echo $anuncio->contenido; ?>
                                        </p>
                                    </div>

                                    <div class="card-footer">
                                        <?php
                                        $sql = "SELECT * FROM comentario WHERE Anuncio_idAnuncio = :aia";
                                        $resultado = $baseDatos->prepare($sql);
                                        $resultado->bindValue(':aia', $anuncio->idAnuncio);
                                        $resultado->execute();
                                        $numRow = $resultado->rowCount();
                                        ?>
                                        <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target="#collapseComentariosAnuncio<?php echo $anuncio->idAnuncio; ?>" aria-expanded="false" aria-controls="collapseComentarios">
                                            <i class="fas fa-comment"></i> Comentarios <span class="badge badge-light"><?php echo $numRow; ?></span>
                                        </button>
                                    </div>

                                    <div class="collapse" id="collapseComentariosAnuncio<?php echo $anuncio->idAnuncio; ?>">
                                        <div class="card card-body">
                                            <!-- Aquí van a ir los comentarios y un form para hacer un comentario -->
                                            <?php
                                            $sql = "SELECT * FROM comentario WHERE Anuncio_idAnuncio = :aia";
                                            $resultado = $baseDatos->prepare($sql);
                                            $resultado->bindValue(':aia', $anuncio->idAnuncio);
                                            $resultado->execute();
                                            $numRow = $resultado->rowCount();

                                            if($numRow == 0) {
                                            ?>

                                                <div class="col-12">
                                                    <p class="lead" style="font-size: 12.5px;">
                                                        Sin comentarios disponibles, comentar algo al anuncio.
                                                    </p>
                                                </div>

                                            <?php
                                            } else {
                                                $comentarios = $resultado->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($comentarios as $comentario) {
                                            ?>

                                                    <div class="alert alert-secondary" role="alert" style="margin-bottom: 2px;">
                                                        <?php
                                                        $pos = strpos($comentario->comentario, ': ');
                                                        $nombreComentario = substr($comentario->comentario, 0, $pos);
                                                        $mensajeComentario = substr($comentario->comentario, $pos, strlen($comentario->comentario) - 1);
                                                        ?>

                                                        <strong><?php echo $nombreComentario; ?></strong><?php echo $mensajeComentario; ?>

                                                        <?php if($permiso == 'dba' || $permiso == 'padmin') { ?>
                                                            <button type="button" class="close" onclick="confirmarAccion(<?php echo '\'' . $comentario->idComentario . '-' . $clase->claveAcceso . '\'';?>, 'comentario');">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        <?php } ?>
                                                    </div>

                                            <?php
                                                }
                                            }
                                            ?>

                                            <form id="formComentarAnuncio" name="formComentarAnuncio" method="POST">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="claveAccesoClase" name="claveAccesoClase" value="<?php echo $clase->claveAcceso; ?>" disabled="disabled">
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="comentarioIdAnuncio" name="comentarioIdAnuncio" value="<?php echo $anuncio->idAnuncio; ?>" disabled="disabled">
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="comentarioNombre" name="comentarioNombre" value="<?php echo $nombre; ?>" disabled="disabled">
                                                </div>

                                                <div class="form-group">
                                                    <textarea class="form-control" id="comentario" name="comentario" placeholder="Haz un comentario" required="required"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary float-right">Guardar <i class="fas fa-comment"></i> </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN DEL EJEMPLO DE CARD PARA ANUNCIOS -->

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- FIN DEL TAB DEL TABLERO/ANUNCIOS -->

                    <!-- TAB DE LAS PRACTICAS -->
                    <div class="tab-pane fade" id="practica" role="tabpanel" aria-labelledby="practica-tab">
                        <?php
                        $sql = 'SELECT * FROM practica 
                        WHERE Clase_claveAcceso LIKE :ca AND eliminado != true
                        ORDER BY fechaLimite ASC';
                        
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':ca', $clase->claveAcceso);

                        $resultado->execute();

                        $numRow = $resultado->rowCount();
                        if($numRow == 0) {
                        ?>

                            <div class="col-12 text-center">
                                <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                                    <h1 class="font-weight-light">La clase no cuenta con prácticas</h1>
                                    <p class="lead">Es necesario crear las prácticas para que los alumnos las puedan realizar.</p>
                                <?php } else if($permiso == 'alumno') { ?>
                                    <h1 class="font-weight-light">La clase no cuenta con prácticas</h1>
                                    <p class="lead">Esperar a una práctica.</p>
                                <?php } ?>
                            </div>

                        <?php
                        } else {
                            $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
                            if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') {
                        ?>

                                <div class="card table-responsive" style="border-radius: 5px;">
                                    <table class="table table-hover table-stripped cart-wrap">
                                        <thead class="text-muted">
                                            <tr>
                                                <th scope="col"> 
                                                    Nombre 
                                                </th>
                                                <th scope="col"> 
                                                    Descripción 
                                                </th>
                                                <th scope="col"> 
                                                    Fecha limite de entrega 
                                                </th>
                                                <th scope="col" class="text-center"> 
                                                    Acción 
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach($practicas as $practica) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $practica->nombre; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $longitud = strlen($practica->descripcion);
                                                    if($longitud > 30) { ///SI ES UN TEXTO MUY LARGO QUE EXCEDE MAS DE 30 CARACTERES
                                                        echo substr($practica->descripcion, 0, 30) . '...';
                                                    } else {
                                                        echo $practica->descripcion;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $practica->fechaLimite; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $evaluacionDifusa = 'false';
                                                    $desabilitarBoton = '';
                                                    if($practica->nombre == 'Evaluación difusa de la clase') {
                                                        $evaluacionDifusa = 'true';
                                                        $desabilitarBoton = 'disabled="true"';
                                                    }
                                                    ?>

                                                    <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalEditarPractica"
                                                    data-idpractica="<?php echo $practica->idPractica; ?>"
                                                    data-difusa="<?php echo $evaluacionDifusa; ?>"
                                                    data-nombre="<?php echo $practica->nombre; ?>"
                                                    data-descripcion="<?php echo $practica->descripcion; ?>"
                                                    data-fechalimite="<?php echo $practica->fechaLimite; ?>"
                                                    data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                        Editar <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-outline-danger <?php echo $botonVisible; ?>" <?php echo $desabilitarBoton; ?> onclick="confirmarAccion(<?php echo '\'' . $practica->idPractica . '-' . $practica->nombre . '-' . $clase->claveAcceso . '\''; ?>, 'practica');">
                                                        Eliminar <i class="fas fa-times"></i>
                                                    </button>

                                                    <?php if($evaluacionDifusa == 'false') { ?>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="cargarContenido('../practica/', 'calificar-entrega.php', 'criterioCalificar=' + <?php echo '\'' . base64_encode($practica->idPractica) . '\''; ?>);">
                                                            Calificar <i class="fas fa-edit"></i>
                                                        </button>
                                                    <?php } else  if($evaluacionDifusa == 'true') {?>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="redireccionarPagina('../../panel-info-evaluacion-difusa.php?claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?>);">
                                                            Evaluar <i class="fas fa-edit"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php } else if($permiso == 'alumno') { ?>

                                <div class="card-columns">
                                    <?php
                                    foreach ($practicas as $practica) {
                                        $actividadNoEntregada = false;
                                        $actividadEntregada = false;
                                        $actividadCalificada = false;
                                        $colorBorde = 'success';
                                        $botonEntregarHabilitado = '';
                                        $estadoActividad = 'Ninguno';
                                        $cuestionario = '';
                                        $evaluacion = '';
                                        $fechaActual = date('Y-m-d');
                                        $visualizar = false;

                                        //Buscar todos los cuestionarios de un alumno
                                        $sql = 'SELECT * FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca';
                                        $resultado = $baseDatos->prepare($sql);
                                        $resultado->bindValue(':pip', $practica->idPractica);
                                        $resultado->bindValue(':auca', $codigo);
                                        $resultado->execute();
                                        $numRowCuestionario = $resultado->rowCount();

                                        if($numRowCuestionario == 1) {
                                            $actividadEntregada = true;
                                            $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);

                                            //Comprobar si el cuestionario esta calificado
                                            $sql = 'SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario = :cicu';
                                            $resultado = $baseDatos->prepare($sql);
                                            $array = array(':cicu'=>$cuestionario->idCuestionario);
                                            $resultado->execute($array);
                                            $numRowEvaluacion = $resultado->rowCount();

                                            if($numRowEvaluacion == 1) {
                                                $actividadCalificada = true;
                                                $evaluacion = $resultado->fetch(PDO::FETCH_OBJ);
                                            }
                                        }

                                        if($actividadEntregada && ($fechaActual <= $practica->fechaLimite) && ($cuestionario->Practica_idPractica == $practica->idPractica) && !$actividadCalificada) {
                                            $colorBorde = 'warning';
                                            $botonEntregarHabilitado = '';
                                            $estadoActividad = 'Entregada - Editable';
                                        } else if($actividadEntregada && ($fechaActual > $practica->fechaLimite) && !$actividadCalificada) {
                                            $colorBorde = 'success';
                                            $botonEntregarHabilitado = '';
                                            $estadoActividad = 'Entregada - Finalizada';
                                            $botonEntregarHabilitado = 'disabled=\'true\'';
                                            $visualizar = true;
                                        } else if(!$actividadEntregada && ($fechaActual > $practica->fechaLimite) && !$actividadCalificada) {
                                            $actividadNoEntregada = true;
                                            $colorBorde = 'danger';
                                            $botonEntregarHabilitado = '';
                                            $estadoActividad = 'No Entregada';
                                            $botonEntregarHabilitado = 'disabled=\'true\'';
                                            $visualizar = true;

                                            $noContesto = 'no contestó';
                                            $fechaReciente = date('Y-m-d H:i:s');
                                            $rutaArchivoNoEntrego = '../../images/files/XXXX12345.jpg';
                                            $nombreClaveNoEntrego = 'XXXX12345.jpg';
                                            $nombreOriginalNoEntrego = 'no_entrego.jpg';

                                            // Primero ingreso un cuestionario donde "no contestó" nada y la imagen que dice "No entregó práctica"
                                            $sql = 'INSERT INTO cuestionario (respuestaPregunta1, respuestaPregunta2, respuestaPregunta3, conclusion, fechaEntrega, rutaArchivo, Practica_idPractica, AlumnoUsuario_codigoAlumno, nombreClave, nombreOriginal) VALUES (:rp1, :rp2, :rp3, :c, :fe, :ra, :pip, :auca, :nc, :no)';
                                            $resultado = $baseDatos->prepare($sql);
                                            $array = array(':rp1'=>$noContesto, ':rp2'=>$noContesto, ':rp3'=>$noContesto, ':c'=>$noContesto, ':fe'=>$fechaReciente, ':ra'=>$rutaArchivoNoEntrego, ':pip'=>$practica->idPractica, ':auca'=>$codigo, ':nc'=>$nombreClaveNoEntrego, ':no'=>$nombreOriginalNoEntrego);
                                            $resultado->execute($array);

                                            // Luego consulto el cuestionario que agregué
                                            $sql = 'SELECT * FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca ORDER BY fechaEntrega ASC LIMIT 1';
                                            $resultado = $baseDatos->prepare($sql);
                                            $array = array(':pip'=>$practica->idPractica, ':auca'=>$codigo);
                                            $resultado->execute($array);
                                            $numRowNoEntrego = $resultado->rowCount();

                                            if($numRowNoEntrego != 0) {
                                                $calificacionNoEntrego = 0;
                                                $cuestionarioNoEntrego = $resultado->fetch(PDO::FETCH_OBJ);

                                                // Al final lo califico con 0 al cuestionario
                                                $sql = 'INSERT INTO evaluacion (califiacion, Cuestionario_idCuestionario) VALUES (:c, :cicu)';
                                                $resultado = $baseDatos->prepare($sql);
                                                $array = array(':c'=>$calificacionNoEntrego, ':cicu'=>$cuestionarioNoEntrego->idCuestionario);
                                                $resultado->execute($array);
                                            }
                                        } else if($actividadCalificada) {
                                            $colorBorde = 'primary';
                                            $botonEntregarHabilitado = '';
                                            $estadoActividad = 'Calificada: ' . $evaluacion->califiacion;
                                            if($cuestionario->conclusion == 'no contestó') {
                                                $estadoActividad .= ' - No entregada a tiempo';
                                            }
                                            $botonEntregarHabilitado = '';
                                            $visualizar = true;
                                        } else {
                                            $estadoActividad = 'Pendiente de entrega';
                                            $colorBorde = 'dark';
                                            $botonEntregarHabilitado = '';
                                        }
                                    ?>

                                    <div class="card border-<?php echo $colorBorde; ?> mb-3">
                                        <div class="card-header bg-transparent border-<?php echo $colorBorde; ?>">
                                            <div class="form-group text-center">
                                                <h5><span class="badge badge-<?php echo $colorBorde; ?>"><?php echo $estadoActividad; ?></span></h5>
                                            </div>
                                        </div>

                                        <div class="card-body text-center">
                                            <h5 class="card-title text-center" style="font-size: 12px;">
                                                <?php
                                                $maxLongTituloPractica = 100;
                                                $longNombreClase = strlen($practica->nombre);
                                                $longRelleno = $maxLongTituloPractica - $longNombreClase;
                                                echo $practica->nombre;
                                                $auxiliar = '';
                                                for($i = 0; $i < $longRelleno; $i++) { $auxiliar .= '_'; }
                                                echo $auxiliar;
                                                ?>
                                            </h5>

                                            <p class="card-text">
                                                <?php
                                                $longitud = strlen($practica->descripcion);
                                                if($longitud > 30) { ///SI ES UN TEXTO MUY LARGO QUE EXCEDE MAS DE 30 CARACTERES
                                                    echo substr($practica->descripcion, 0, 30) . '...';
                                                } else {
                                                    echo $practica->descripcion;
                                                }
                                                ?>
                                            </p>

                                            <?php 
                                            if($practica->nombre == 'Evaluación difusa de la clase') {
                                                $visualizarDifusa = false;
                                                if($actividadNoEntregada || $colorBorde == 'primary'){
                                                    $visualizarDifusa = true;
                                                }
                                            ?>
                                                <button type="button" class="btn btn-sm btn-outline-<?php echo $colorBorde; ?>" data-toggle="modal" data-target="#modalEvaluarClase"
                                                data-idpractica="<?php echo $practica->idPractica; ?>";
                                                data-visualizar="<?php echo $visualizarDifusa; ?>";
                                                data-nombre="<?php echo $practica->nombre; ?>";
                                                data-descripcion="<?php echo $practica->descripcion; ?>";
                                                data-fechalimite="<?php echo $practica->fechaLimite; ?>";
                                                data-codigoalumno="<?php echo $codigo; ?>"
                                                data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                    Evaluar <i class="fas fa-check-square"></i>
                                                </button>
                                            <?php } else if(!$visualizar) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-<?php echo $colorBorde; ?>" data-toggle="modal" data-target="#modalEntregaPractica"
                                                data-idpractica="<?php echo $practica->idPractica; ?>";
                                                data-visualizar="false";
                                                data-nombre="<?php echo $practica->nombre; ?>";
                                                data-descripcion="<?php echo $practica->descripcion; ?>";
                                                data-fechalimite="<?php echo $practica->fechaLimite; ?>";
                                                data-codigoalumno="<?php echo $codigo; ?>"
                                                data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                    Entregar <i class="fas fa-check-square"></i>
                                                </button>
                                            <?php } else if($visualizar) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-<?php echo $colorBorde; ?>" data-toggle="modal" data-target="#modalEntregaPractica"
                                                data-idpractica="<?php echo $practica->idPractica; ?>";
                                                data-visualizar="true";
                                                data-nombre="<?php echo $practica->nombre; ?>";
                                                data-descripcion="<?php echo $practica->descripcion; ?>";
                                                data-fechalimite="<?php echo $practica->fechaLimite; ?>";
                                                data-codigoalumno="<?php echo $codigo; ?>"
                                                data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                    Visualizar <i class="fas fa-check-square"></i>
                                                </button>
                                            <?php } ?>
                                        </div>

                                        <div class="card-footer border-<?php echo $colorBorde; ?>">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar"></i> Fecha de entrega: <?php echo $practica->fechaLimite; ?>
                                            </small>
                                        </div>
                                    </div>

                                    <?php } ?>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- FIN DEL TAB DE LAS PRACTICAS -->

                    <!-- TAB DE LA LISTA DE ALUMNOS -->
                    <div class="tab-pane fade" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                        <?php
                        $sql = 'SELECT A.codigoAlumno AS codigo, CONCAT(A.nombrePila, " ", A.apellidoPaterno,  " ", A.apellidoMaterno) AS nombreCompleto, CHAU.permiso as accesoAlumno
                        FROM clase_has_alumnousuario AS CHAU 
                        INNER JOIN alumnousuario A ON CHAU.AlumnoUsuario_codigoAlumno = A.codigoAlumno 
                        WHERE CHAU.Clase_claveAcceso = :ca';
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':ca', $clase->claveAcceso);
                        $resultado->execute();
                        $numRow = $resultado->rowCount();

                        if($numRow == 0) {
                        ?>

                            <div class="col-12 text-center">
                                <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                                    <h1 class="font-weight-light">La clase no tiene alumnos inscritos</h1>
                                    <p class="lead">Es necesario proporcionar a los alumnos el código de acceso para ingresar a la clase.</p>
                                <?php } else if($permiso == 'alumno') { ?>
                                    <h1 class="font-weight-light">La clase no tiene alumnos inscritos</h1>
                                    <p class="lead">Usted es el unico alumno en la clase, dsifrute este espacio libre mientras pueda.</p>
                                <?php } ?>
                            </div>

                        <?php
                        } else {
                            $alumnosClase = $resultado->fetchAll(PDO::FETCH_OBJ);
                        ?>

                            <div class="list-group list-group-flush" id="listaAlumnos" name="listaAlumnos">
                                <h3 class="list-group-item list-group-item-heading"> Lista de Alumnos </h3>
                            </div>

                            <br>

                            <ul class="list-group">
                                <?php foreach ($alumnosClase as $alumnoClase) { ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') {
                                        $sql = 'SELECT AVG(califiacion) AS promedio FROM evaluacion 
                                        WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica IN (SELECT idPractica FROM practica WHERE Clase_claveAcceso = :cca AND eliminado != true) 
                                        AND AlumnoUsuario_codigoAlumno = :auca)';
                                        $resultado = $baseDatos->prepare($sql);
                                        $array = array(':cca'=>$claveAccesoClase, ':auca'=>$alumnoClase->codigo);
                                        $resultado->execute($array);

                                        $data = $resultado->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($data as $row) {
                                            $promedioAlumno = round($row->promedio, 4);
                                        }

                                        if(!$promedioAlumno) {
                                            $promedioAlumno = 0;
                                        }

                                        $botones = '';
                                        $colorEstadoPromedio = '';
                                        $rellenoNumero = '';
                                        if($promedioAlumno >= 0 and $promedioAlumno <= 9) {
                                            $rellenoNumero = '0';
                                        }

                                        if($promedioAlumno == 0) {
                                            $colorEstadoPromedio = 'secondary';
                                        } else if($promedioAlumno >= 1 and $promedioAlumno <= 59) {
                                            $colorEstadoPromedio = 'danger';
                                        } else if($promedioAlumno >= 60 and $promedioAlumno <= 70) {
                                            $colorEstadoPromedio = 'warning';
                                        } else if($promedioAlumno >= 71 and $promedioAlumno <= 90) {
                                            $colorEstadoPromedio = 'primary';
                                        }else if($promedioAlumno >= 91 and $promedioAlumno <= 100) {
                                            $colorEstadoPromedio = 'success';
                                        } else {
                                            $colorEstadoPromedio = 'muted';
                                        }

                                        if($alumnoClase->accesoAlumno) {
                                            $badge = '<span class="badge badge-success"> <b>Activo</b> </span>';
                                        } else {
                                            $badge = '<span class="badge badge-danger"> <b>Inactivo</b> </span>';
                                        }
                                    ?>

                                        <h6 style="font-size: 12px;"> <?php echo $alumnoClase->codigo . ' - ' . $alumnoClase->nombreCompleto . ' ' . $badge; ?> <span class="badge badge-<?php echo $colorEstadoPromedio; ?> badge-pill"> <?php echo $rellenoNumero.$promedioAlumno; ?></span></h6>

                                        <div class="col-sm-4 text-center">
                                            <button type="button" class="btn btn-sm btn-outline-success" onclick="redireccionarPagina('../../panel-info-alumno.php?claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?> + '&codigoAlumno=' + <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>);">
                                                Ver gráficas <i class="fas fa-chart-bar"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="cargarContenido('../practica/', 'calificar-entrega.php', 'criterioCalificar=' + <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>);">
                                                Calificar <i class="fas fa-clipboard-check"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="cargarContenido('../../DOCS/examples/', 'reporte-practicas-alumno.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?> + '&codigoAlumno='+ <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>);">
                                                PDF prácticas <i class="fas fa-file-pdf"></i>
                                            </button>
                                        </div>

                                    <?php } else if($permiso == 'alumno') { ?>
                                        <h6 style="font-size: 12px;"> <?php echo $alumnoClase->codigo . ' - ' . $alumnoClase->nombreCompleto; ?></h6>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                    <!-- FIN DEL TAB DE LA LISTA DE ALUMNOS -->

                </div>
                <!-- FIN DEL CONTENIDO DEL TAB -->

            </div>
            <!-- FIN DEL CUERPO DE LOS TAB  -->

        </div>
        <!-- FIN DE LAS PESTAÑAS/TABS DEL CONTENIDO -->

    </div>
    <!-- FIN DEL CONTAINER -->

    <footer class="footer fixed-bottom py-2 bg-light shadow text-dark-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('../../modals.php'); ?>

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>
</html>

<?php
    } else {
        // echo '<script>window.close();</script>';
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
