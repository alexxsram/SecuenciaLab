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

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);

try {
    $sql = "SELECT * FROM clase WHERE claveAcceso = :claveAcceso";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':claveAcceso', $claveAccesoClase);
    $resultado->execute();
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
    <div class="container">
      <input type="hidden" class="form-control" id="ingresar-materia-claveAcceso" name="ingresar-materia-claveAcceso" disabled="disabled" value=<?php echo $claveAccesoClase;?>>
        <?php
            $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
            $resultado->execute();
            $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
        ?>
            <!-- JUMBOTRON DONDE MUESTRO LOS DATOS DE LA CLASE -->
            <div class="jumbotron">
                <div class="container">
                    <blockquote class="blockquote text-center"> <h1 class="display-4"> <?php echo $clase->nombreClase; ?> </h1></blockquote>
                    <p class="h6"> <small class="text-muted"> Materia: <?php echo $clase->nombreMateria; ?> </small> </p>
                    <p class="h6"> <small class="text-muted"> Sección: <?php echo $clase->claveSeccion; ?> </small> </p>
                    <p class="h6"> <small class="text-muted"> Aula: <?php echo $clase->aula; ?> </small> </p>
                    <p class="h6"> <small class="text-muted"> Ciclo: <?php echo $clase->anio . " " . $ciclo->ciclo; ?> </small> </p>
                    <p class="h6"> <small class="text-muted"> Clave de acceso: <?php echo $clase->claveAcceso; ?>
                        <button class="btn " style="background-color:transparent;" data-toggle="tooltip" title="Mostrar" onclick="expandirClaveAcceso(<?php echo '\''.$clase->claveAcceso.'\'' ?>);">
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </p>
                    <p class="lead text-justify">
                        En la siguiente sección, el profesor puede crear las prácticas de laboratorio relacionadas al manual
                    </p>
                    <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones de la clase
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-toggle="modal" href="#modalCrearAnuncio" data-codigoprofesor="<?php echo $codigo; ?>" data-claveacceso="<?php echo $clase->claveAcceso; ?>"><i class="fas fa-info-circle"></i> Agregar anuncio</a>
                            <a class="dropdown-item" data-toggle="modal" href="#modalCrearPractica" data-claveacceso="<?php echo $clase->claveAcceso; ?>"><i class="fas fa-clipboard"></i> Agregar práctica</a>
                        </div>
                    </div>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
                </div>
            </div>

            <!-- PESTAÑAS/TABS DEL CONTENIDO QUE VOY A MOSTRAR -->
            <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">
                <div class="card-header bg-dark border-dark">
                    <ul class="nav nav-tabs justify-content-end card-header-tabs text-white" id="tabsDashboard" role="tablist">
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

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tablero" role="tabpanel" aria-labelledby="tablero-tab">
                            <?php
                                $sql = 'SELECT * FROM anuncio WHERE ProfesorUsuario_codigoProfesor = :codigo AND Clase_claveAcceso = :claveAcceso';
                                $resultado = $baseDatos->prepare($sql);
                                $array = array(':codigo'=>$codigo, ':claveAcceso'=>$claveAccesoClase);
                                $resultado->execute($array);

                                $numRow = $resultado->rowCount();
                                if($numRow == 0) {
                            ?>

                            <div class="col-12 text-center">
                                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                    <h1 class="font-weight-light">La clase no tiene anuncios</h1>
                                    <p class="lead">Se debe crear uno, para revisión de trabajo pendiente.</p>
                                <?php } ?>
                            </div>

                            <?php
                                } else {
                                    $anuncios = $resultado->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($anuncios as $anuncio) {
                            ?>

                            <!-- Ejemplo de card para anuncios -->
                            <div class="card gedf-card" style="margin-bottom: 15px;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="mr-2">
                                                <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                            </div>
                                            <div class="ml-2">
                                                <div class="h5 m-0 text-muted"> <?php echo $nombre; ?> </div>
                                                <div class="h7 text-muted"> a <?php echo $clase->nombreClase; ?> </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                    <div class="h6 dropdown-header">Configuración</div>
                                                    <a class="dropdown-item" data-toggle="modal"  href="#modalEditarAnuncio" data-idanuncio="<?php echo $anuncio->idAnuncio; ?>"
                                                    data-titulo="<?php echo $anuncio->titulo; ?>"
                                                    data-contenido="<?php echo $anuncio->contenido; ?>"
                                                    data-fechapublicacion="<?php echo $anuncio->fechaPublicacion; ?>"
                                                    data-claveacceso="<?php echo $anuncio->Clase_claveAcceso; ?>"> <i class="fas fa-edit"></i> Editar</a>
                                                    <button type="button" class="dropdown-item" onclick="confirmarEliminar(<?php echo '\'' . $anuncio->idAnuncio . '-' . $anuncio->titulo . '-' . $clase->claveAcceso . '\'';?>, 'anuncio');"> <i class="fas fa-trash"></i> Eliminar</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="text-muted h7 mb-2"> <i class="fas fa-calendar"></i> <?php $fecha = date_create($anuncio->fechaPublicacion); echo date_format($fecha, 'l jS F Y'); ?> </div>
                                    <a class="card-link" href="#">
                                        <h5 class="card-title"> <?php echo $anuncio->titulo; ?> </h5>
                                    </a>
                                    <p class="card-text">
                                        <?php echo $anuncio->contenido; ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <!-- <a href="#" class="card-link float-right"><i class="fa fa-comment"></i> Comentarios</a> -->
                                    <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target="#collapseComentariosAnuncio<?php echo $anuncio->idAnuncio; ?>" aria-expanded="false" aria-controls="collapseComentarios">
                                        <i class="fas fa-comment"></i> Comentarios
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

                                        No hay comentarios

                                        <?php
                                            } else {
                                                $comentarios = $resultado->fetchAll(PDO::FETCH_OBJ);

                                                foreach ($comentarios as $comentario) {
                                        ?>

                                        <div class="alert alert-secondary" role="alert">
                                            <?php
                                                $pos = strpos($comentario->comentario, ': ');
                                                $nombreComentario = substr($comentario->comentario, 0, $pos);
                                                $mensajeComentario = substr($comentario->comentario, $pos, strlen($comentario->comentario) - 1);
                                            ?>
                                            <strong> <?php echo $nombreComentario; ?></strong><?php echo $mensajeComentario; ?>
                                            <button type="button" class="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                            <!-- Post /////-->

                            <?php
                                    }
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="practica" role="tabpanel" aria-labelledby="practica-tab">
                            <?php
                                $sql = "SELECT * FROM practica WHERE Clase_claveAcceso LIKE :claveAcceso";
                                $resultado = $baseDatos->prepare($sql);
                                $resultado->bindValue(':claveAcceso', $clase->claveAcceso);
                                $resultado->execute();

                                $numRow = $resultado->rowCount();
                                if($numRow == 0) {
                            ?>

                            <div class="col-12 text-center">
                                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                    <h1 class="font-weight-light">La clase no cuenta con prácticas</h1>
                                    <p class="lead">Es necesario que cree por lo menos una práctica para que la puedan visualizar sus alumnos.</p>
                                <?php } ?>
                            </div>

                            <?php
                                } else {
                                    $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <div class="card" style="border-radius: 5px;">
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
                                                Accion
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
                                                if($longitud > 30) { ///SI ES UN TEXTO MUY LARGO
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
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalCalificarPractica"
                                                    data-idpractica="<?php echo $practica->idPractica; ?>"
                                                    data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                        Calificar <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalEditarPractica"
                                                    data-idpractica="<?php echo $practica->idPractica; ?>"
                                                    data-nombre="<?php echo $practica->nombre; ?>"
                                                    data-descripcion="<?php echo $practica->descripcion; ?>"
                                                    data-fechalimite="<?php echo $practica->fechaLimite; ?>"
                                                    data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                        Editar <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminar(<?php echo '\'' . $practica->idPractica . '-' . $practica->nombre . '-' . $clase->claveAcceso . '\''; ?>, 'practica');">
                                                        Eliminar <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                            <div class="list-group list-group-flush" id="listaAlumnos" name="listaAlumnos">
                                <h3 href="#" class="list-group-item list-group-item-heading">
                                    Lista de Alumnos
                                </h3>
                            </div>
                            <br>
                            <ul class="list-group" id="listaAlumnos-lista" name="listaAlumnos-lista">
                                <?php
                                $sql = 'SELECT A.codigoAlumno AS codigo, CONCAT(A.nombrePila, " ", A.apellidoPaterno, " ", A.apellidoMaterno) AS nombreCompleto ';
                                $sql .= 'FROM clase_has_alumnousuario AS C ';
                                $sql .= 'INNER JOIN alumnousuario A ON C.AlumnoUsuario_codigoAlumno = A.codigoAlumno ';
                                $sql .= 'WHERE C.Clase_claveAcceso = :claveAcceso';
                                $resultado = $baseDatos->prepare($sql);
                                $resultado->bindValue(':claveAcceso', $claveAccesoClase);
                                $resultado->execute();

                                $numRow = $resultado->rowCount();
                                if($numRow != 0) {
                                    $alumnosClase = $resultado->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($alumnosClase as $alumnoClase) {
                                ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <?php echo $alumnoClase->codigo . ' - ' . $alumnoClase->nombreCompleto; ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-success" onclick="redireccionarPagina('../../panel-info-alumno.php?claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?> + '&claveUsuario=' + <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>);"> Ver gráficas <i class="fas fa-chart-bar"></i> </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary"> Calificar <i class="fas fa-clipboard-check"></i> </button>
                                    </div>
                                </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } catch(Exception $exec) {
            die('Error en la base de datos: ' . $exec->getMessage());
        }
        ?>
    </div>

    <?php include('../../modals.php'); ?>

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>
</html>
