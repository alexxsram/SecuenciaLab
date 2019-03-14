<?php
session_start(); //Reanudamos la sesión

//Comprobamos si el usario está logueado
//Si no lo está, se le redirecciona a login
//Si lo está, definimos el botón de cerrar sesión y la duración de la sesión
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: utileria/sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
	//require('utileria/sesion/duracion-sesion.php');
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

    <title>Inicio</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">SecuenciaLab</a>
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
                            <a class="dropdown-item" href="#">Agregar sección</a>
                            <a class="dropdown-item" href="#">Agregar alumnos</a>
                            <a class="dropdown-item" href="#">Agregar prácticas</a>
                            <a class="dropdown-item" href="#">Calificar prácticas</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-alt"></i> <?php echo $_SESSION['nombre']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Cambiar contraseña <i class="fas fa-key"></i></a>
                        </div>
                    </li>                
                    <li class="form-inline">
                        <button onclick="window.location = 'utileria/sesion/cerrar-sesion.php';" class="btn btn-outline-danger btn-sm" type="button">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Full Page Image Header with Vertically Centered Content -->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="font-weight-light">Bienvenido a la página de administración profesor</h1>
                    <p class="lead">Aquí podrás realizar todo lo necesario para llevar un control de tu(s) materias.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
        <div class="container">
            <h2 class="font-weight-light">Algún texto de pie de página</h2>
            <p>Prediseñado solo por muestra.</p>
        </div>
    </section>

    <?php include('utileria/encabezados/encabezado-js.php'); ?>
    <script type="text/javascript">
        $('.btn-expand-collapse').click(function(e) {
            $('.navbar-primary').toggleClass('collapsed');
        });
    </script>
</body>
</html>