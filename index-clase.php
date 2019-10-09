<?php
session_start();
if(!isset($_SESSION['codigo']) && $_SESSION['permiso'] == '') {
    header('Location: utileria/sesion/sesion.php');
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
include('utileria/operaciones/conexion.php');

$aux = substr($codigo, 0, 1);

if(($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
    $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';
    $val = ':cp';
}
if($aux == 'A' || $aux == 'a') {
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
    $val = ':ca';
}
$resultado = $baseDatos->prepare($sql);
$resultado->bindValue($val, $codigo);
$resultado->execute();
$usuario = $resultado->fetch(PDO::FETCH_OBJ);
$nombreUsuario = $usuario->nombrePila . ' ' . $usuario->apellidoPaterno . ' ' . $usuario->apellidoMaterno;

if($nombre != $nombreUsuario) {
    $nombre = $nombreUsuario;
}
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
            <button class="btn btn-sm btn-outline-light navbar-brand" onclick="redireccionarPagina('index-clase.php');">
                SecuenciaLab
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 13px;">
                            <i class="fas fa-list-ul"></i> Opciones
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearClase" data-codigoprofesor="<?php echo $codigo; ?>">
                                    <i class="fas fa-chalkboard"></i> Crear una clase
                                </button>
                                <?php if($permiso == 'dba' || $permiso == 'padmin') {?>
                                    <button class="dropdown-item" onclick="cargarPagina('utileria/sesion/permiso-usuarios.php');">
                                        <i class="fas fa-users"></i> Permisos a usuarios profesor
                                    </button>
                                    <?php if($permiso == 'dba') { ?>
                                        <button class="dropdown-item" onclick="cargarPagina('utileria/respaldo/respaldos-bd.php');">
                                            <i class="fas fa-database"></i> Respaldos
                                        </button>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else if($permiso == 'alumno') { ?>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalUnirseClase" data-codigoalumno="<?php echo $codigo; ?>">
                                    <i class="fas fa-users"></i> Unirse a una clase
                                </button>
                            <?php } ?>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 13px;">
                            <i class="fas fa-user-alt"></i> <?php echo $nombre . " - " . $codigo; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <button class="dropdown-item" data-toggle="modal" data-target="#modalCambiarPassword" data-codigo="<?php echo $codigo; ?>">
                                <i class="fas fa-key"></i> Actualizar contraseña
                            </button>
                            <button class="dropdown-item" data-toggle="modal" data-target="#modalCambiarNombre" data-codigo="<?php echo $codigo; ?>">
                                <i class="fas fa-signature"></i> Actualizar nombre
                            </button>
                        </div>
                    </li>

                    <li class="form-inline">
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="redireccionarPagina('utileria/sesion/cerrar-sesion.php');">
                            Cerrar sesión <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ESTO ES EL CONTENT QUE ANTES ESTABA EN EL ARCHIVO CONTENT.PHP, AHORA FORMA PARTE DENTRO DE INDEX.PHP -->
    <div class="masthead">
        <div class="container h-100">
            <?php
            if($permiso == 'dba' || $permiso == 'padmin') {
                $sql = 'SELECT C.*, PU.* FROM clase AS C
                INNER JOIN profesorusuario AS PU ON C.ProfesorUsuario_codigoProfesor = PU.codigoprofesor
                ORDER BY C.anio DESC, C.nombreClase ASC, C.CicloEscolar_idCicloEscolar ASC';
                $resultado = $baseDatos->prepare($sql);
            } else if($permiso == 'pnormal') {
                $sql = 'SELECT * FROM clase 
                WHERE ProfesorUsuario_codigoProfesor = :pucp AND eliminado != true
                ORDER BY anio DESC, nombreClase ASC, CicloEscolar_idCicloEscolar ASC';
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':pucp', $codigo);
            } else if($permiso == 'alumno') {
                $sql = 'SELECT C.*, CHAU.permiso FROM clase AS C
                INNER JOIN clase_has_alumnousuario AS CHAU ON CHAU.Clase_claveAcceso = C.claveAcceso
                WHERE C.eliminado != true AND CHAU.AlumnoUsuario_codigoAlumno = :auca
                ORDER BY C.anio DESC, C.nombreClase ASC, C.CicloEscolar_idCicloEscolar ASC';
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':auca', $codigo);
            }
            $resultado->execute();
            $numRow = $resultado->rowCount();

            if($numRow == 0) {
            ?>

                <div class="row h-100 align-items-center">
                    <div class="col-12 text-center">
                        <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') { ?>
                            <h1 class="font-weight-light">Bienvenido a la página de administración</h1>
                            <p class="lead">Aquí podrás realizar todo lo necesario para llevar un control de la(s) clase(s).</p>
                        <?php } else if($permiso == 'alumno') { ?>
                            <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
                            <p class="lead">Aquí podrás acceder de la(s) clase(s) en la(s) que te inscribiste.</p>
                        <?php } ?>
                    </div>
                </div>

            <?php } else { ?>

                <div class="jumbotron">
                    <div class="container">
                        <h1 class="display-4"> <i class="fas fa-users"></i> Listado de clases</h1>
                        <?php if($permiso == 'dba' || $permiso == 'padmin') { ?>
                            <p class="lead text-justify">
                                En esta sección el administrador podrá ver las clases activas e inacticas, podrá acceder a los grupos, editar los datos generales
                                de la clase en caso de error y/o dar de baja algún curso en caso de que el profesor lo requiera.
                            </p>
                        <?php } else if($permiso == 'pnormal') { ?>
                            <p class="lead text-justify">
                                En esta sección el profesor podrá administrar las clases que imparte, ingresando a sus grupos y editar los datos generales
                                de la clase en caso de error.
                            </p>
                        <?php } else if($permiso == 'alumno') { ?>
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
                        $sql = 'SELECT * FROM clase_has_alumnousuario
                        WHERE Clase_claveAcceso= :cca';
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':cca', $clase->claveAcceso);
                        $resultado->execute();
                        $numeroAlumnos = $resultado->rowCount();

                        $sql = 'SELECT * FROM cicloescolar
                        WHERE idCicloEscolar = :ice';
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':ice', $clase->CicloEscolar_idCicloEscolar);
                        $resultado->execute();
                        $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
                    ?>

                        <div class="col-lg-4 col-md-8 col-sm-12 py-2">
                            <div class="card border-success">
                                <img class="card-img" src="images/index/fondo-card.jpg" alt="Card image">
                                <div class="card-body text-center">
                                    <h4 class="card-title border-bottom pb-2" style="font-size: 18.5px; font-family: 'Candara';">
                                        <i>
                                            <b>
                                                <?php
                                                $maxLongNomClase = 45;
                                                $longNombreClase = strlen($clase->nombreClase);
                                                $longRelleno = $maxLongNomClase - $longNombreClase;
                                                echo $clase->nombreClase;
                                                $auxiliar = '';
                                                for($i = 0; $i < $longRelleno; $i++) { $auxiliar .= '_'; }
                                                echo $auxiliar;
                                                ?>
                                            </b>
                                        </i>
                                    </h4>

                                    <p class="card-text text-center" style="font-size: 12.5px;">
                                        <b> NRC: </b> <?php echo $clase->nrc . ' - ' . $clase->anio . ' ' . $ciclo->ciclo; ?> <br>
                                        <b> Sección: </b> <?php echo $clase->claveSeccion; ?> <br>
                                        <b> Clave: </b> <?php echo $clase->claveAcceso; ?> <br>
                                        <?php if($permiso == 'pnormal') { ?>
                                            <b> Alumnos: </b> <?php echo $numeroAlumnos; ?> <br>
                                        <?php } else if($permiso == 'dba' || $permiso == 'padmin') { ?>
                                            <b> Alumnos: </b> <?php echo $numeroAlumnos; ?> <br>
                                            <b> Creado por: </b> <?php echo $clase->apellidoPaterno . ' ' . $clase->apellidoMaterno . ' ' . $clase->nombrePila; ?> <br>
                                        <?php if(!$clase->eliminado) { ?>
                                            <b> Estado materia: </b> <span class="badge badge-success"> <b>Activo</b> </span>
                                        <?php } else { ?>
                                            <b> Estado materia: </b> <span class="badge badge-danger"> <b>Inactivo</b> </span> <br>
                                            <b> Eliminado por: </b> <?php echo $clase->eliminadoPor; ?> <br>
                                            <b> Fecha de eliminación: </b> <?php echo $clase->updatedAt; ?> <br>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </p>

                                    <div class="text-center">
                                        <?php if($permiso == 'dba' || $permiso == 'padmin' || $permiso == 'pnormal') {
                                            $botonVisible = '';
                                            if($permiso == 'pnormal') {
                                                $botonVisible = 'd-none'; //clase de bootstrap que oculta un elemento, lo mismo que usae el css de "display: none;" pero más práctico
                                            }
                                        ?>

                                            <button type="button" class="btn btn-sm btn-success" onclick="cargarContenido('utileria/materia/', 'index-materia.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?>);">
                                                Entrar <i class="fas fa-door-open"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEditarClase"
                                            data-claveacceso="<?php echo $clase->claveAcceso; ?>" data-nombremateria="<?php echo $clase->nombreMateria; ?>"
                                            data-nrc="<?php echo $clase->nrc; ?>" data-claveseccion="<?php echo $clase->claveSeccion; ?>"
                                            data-nombreclase="<?php echo $clase->nombreClase; ?>" data-aula="<?php echo $clase->aula; ?>"
                                            data-anio="<?php echo $clase->anio; ?>" data-codigoprofesor="<?php echo $clase->ProfesorUsuario_codigoProfesor; ?>">
                                                Editar <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger <?php echo $botonVisible; ?>" onclick="confirmarAccion(<?php echo '\'' . $clase->claveAcceso . '-' . $nombre . '\''; ?>, 'clase');">
                                                Eliminar <i class="fas fa-trash"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalAccesoClase" data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                                Permiso alumnos <i class="fas fa-key"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-secondary <?php echo $botonVisible; ?>" onclick="confirmarAccion(<?php echo '\'' . $clase->claveAcceso . '\''; ?>, 'activarClase');">
                                                Activar clase <i class="fas fa-check"></i>
                                            </button>
                                        <?php } else if($permiso == 'alumno') {
                                            if($clase->permiso) {
                                                $mensaje = 'Alumno matriculado, permiso de acceso concedido.';
                                                $color = 'success';
                                                $disabled = '';
                                            } else {
                                                $mensaje = 'Alumno matriculado, esperando aprobación de permiso de acceso a la clase.';
                                                $color = 'warning';
                                                $disabled = 'disabled="true"';
                                            }
                                        ?>
                                            <p class="card-text text-center" style="font-size: 12.5px;">
                                                <b> Estatus del alumno: </b> <?php echo $mensaje; ?>
                                            </p>

                                            <button type="button" class="btn btn-sm btn-<?php echo $color; ?>" <?php echo $disabled; ?> onclick="cargarContenido('utileria/materia/', 'index-materia.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?>);">
                                                Entrar <i class="fas fa-door-open"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger" <?php echo $disabled; ?> onclick="confirmarAccion(<?php echo '\'' . $clase->claveAcceso . '-' . $codigo . '\''; ?>, 'abandonarClase');">
                                                Abandonar <i class="fas fa-trash"></i>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            <?php } ?>
        </div>
    </div>

    <footer class="footer fixed-bottom py-2 bg-light shadow text-dark-50">
        <div class="container text-center">
        <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('modals.php'); ?>

    <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
