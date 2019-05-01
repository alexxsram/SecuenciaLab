<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: utileria/sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
include('utileria/operaciones/conexion.php');
$maxLongNomClase = 45;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('utileria/encabezados/encabezado-css.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">

    <title>Panel de gestión</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <button class="btn btn-sm btn-outline-light navbar-brand" onclick="redireccionarPagina('index.php');">SecuenciaLab</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-list-ul"></i> Opciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearClase" data-codigoprofesor="<?php echo $codigo; ?>"> <i class="fas fa-users"></i> Crear una clase</button>
                            <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalUnirseClase" data-codigoalumno="<?php echo $codigo; ?>"> <i class="fas fa-users"></i> Unirse a una clase</button>
                            <?php } ?>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-alt"></i> <?php echo $nombre . " - " . $codigo; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <button class="dropdown-item" data-toggle="modal" data-target="#modalCambiarPassword" data-codigo="<?php echo $codigo; ?>"><i class="fas fa-key"></i> Cambiar contraseña</button>
                        </div>
                    </li>

                    <li class="form-inline">
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="redireccionarPagina('utileria/sesion/cerrar-sesion.php');">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ESTO ES EL CONTENT QUE ANTES ESTABA EN EL ARCHIVO CONTENT.PHP, AHORA FORMA PARTE DENTRO DE INDEX.PHP -->
    <div class="masthead">
        <div class="container h-100" id="contenidoClase">
            <?php
            if($estado == 'INICIO_SESION_PROFESOR') {
                $sql = "SELECT * FROM clase WHERE ProfesorUsuario_codigoProfesor = :pucp ORDER BY anio DESC, nombreClase ASC, CicloEscolar_idCicloEscolar ASC";
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':pucp', $codigo);
            } else if($estado == 'INICIO_SESION_ALUMNO') {
                $sql = "SELECT * FROM clase WHERE claveAcceso IN (SELECT Clase_claveAcceso FROM clase_has_alumnousuario WHERE AlumnoUsuario_codigoAlumno = :auca) ORDER BY anio DESC, nombreClase ASC, CicloEscolar_idCicloEscolar ASC";
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':auca', $codigo);
            }
            $resultado->execute();

            $numRow = $resultado->rowCount();
            if($numRow == 0) {
            ?>

            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                        <h1 class="font-weight-light">Bienvenido a la página de administración del profesor</h1>
                        <p class="lead">Aquí podrás realizar todo lo necesario para llevar un control de tu(s) clase(s).</p>
                    <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                        <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
                        <p class="lead">Aquí podrás acceder de la(s) clase(s) en la(s) que te inscribiste.</p>
                    <?php } ?>
                </div>
            </div>

            <?php
            } else {
            ?>

            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-4"> <i class="fas fa-users"></i> Listado de clases</h1>
                    <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                        <p class="lead text-justify">
                            En esta sección el profesor podrá administrar las clases que imparte, ingresando a sus grupos, editar los datos generales
                            de la clase en caso de error y/o eliminarla en el momento que desee.
                        </p>
                    <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                        <p class="lead text-justify">
                            En esta sección el alumno podrá acceder a las clases que lleva, lo cual le permite revisar anuncios, subir sus prácticas contestadas
                            y ser evaluado por el profesor.
                        </p>
                    <?php } ?>
                </div>
            </div>

            <div class="row h-100" style="margin-top: -1%;">
                <?php
                $clases = $resultado->fetchAll(PDO::FETCH_OBJ);
                foreach ($clases as $clase) {
                    $sql = "SELECT * FROM clase_has_alumnousuario WHERE Clase_claveAcceso= :Clase_claveAcceso";
                    $resultado = $baseDatos->prepare($sql);
                    $resultado->bindValue(':Clase_claveAcceso', $clase->claveAcceso);
                    $resultado->execute();
                    $numeroAlumnos = $resultado->rowCount();

                    $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
                    $resultado = $baseDatos->prepare($sql);
                    $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
                    $resultado->execute();
                    $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
                ?>

                <!-- Aqui voy a cargar las clases -->
                <div class="col-lg-3 col-md-6 col-sm-12 py-2">
                    <div class="card border-success">
                        <img class="card-img" src="images/index/fondo-card.jpg" alt="Card image">
                        <div class="card-body text-center">
                            <h4 class="card-title border-bottom pb-2" style="font-size: 18.5px; font-family: 'Candara';"> 
                                <i>
                                    <b>
                                        <?php
                                        $longNombreClase = strlen($clase->nombreClase);
                                        $longRelleno = $maxLongNomClase - $longNombreClase;
                                        echo $clase->nombreClase;
                                        $auxiliar="";
                                        for($i=0; $i<$longRelleno; $i++) {$auxiliar .= "_";}
                                        echo $auxiliar;
                                        ?>
                                    </b>
                                </i>
                            </h4>
                            <p class="card-text text-center" style="font-size: 12.5px;">
                                <b>NRC:</b> <?php echo $clase->nrc . " - " . $clase->anio . " " . $ciclo->ciclo; ?> <br>
                                <b>Sección:</b> <?php echo $clase->claveSeccion; ?> <br>
                                <b>Clave:</b> <?php echo $clase->claveAcceso; ?> <br>
                                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                    <b>Alumnos:</b> <?php echo $numeroAlumnos; ?> <br>
                                <?php } ?>
                            </p>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm btn-success" onclick="cargarContenido('utileria/materia/', 'ingresar-materia.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?>);">Entrar <i class="fas fa-door-open"></i></button>
                                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEditarClase"
                                    data-claveacceso="<?php echo $clase->claveAcceso; ?>" data-nombremateria="<?php echo $clase->nombreMateria; ?>"
                                    data-nrc="<?php echo $clase->nrc; ?>" data-claveseccion="<?php echo $clase->claveSeccion; ?>"
                                    data-nombreclase="<?php echo $clase->nombreClase; ?>" data-aula="<?php echo $clase->aula; ?>"
                                    data-anio="<?php echo $clase->anio; ?>" data-codigoprofesor="<?php echo $clase->ProfesorUsuario_codigoProfesor; ?>">Editar <i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminar(<?php echo '\'' . $clase->claveAcceso . '\''; ?>, 'clase');">Eliminar <i class="fas fa-trash"></i></button>
                                <?php } else if($estado == 'INICIO_SESION_ALUMNO'){ ?>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminar(<?php echo '\'' . $clase->claveAcceso . '-' . $codigo . '\''; ?>, 'abandonarClase');">Abandonar <i class="fas fa-trash"></i></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->

                <?php
                }
                ?>
            </div>

            <?php
            }
            ?>
        </div>
    </div>

    <?php include('modals.php'); ?>

    <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
