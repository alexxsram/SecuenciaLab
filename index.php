<?php
session_start(); //Reanudamos la sesión
//Comprobamos si el usuario está logueado
//Si no lo está, se le redirecciona a login
//Si lo está, definimos el botón de cerrar sesión y la duración de la sesión
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
  header('Location: utileria/sesion/sesion.php');
} else {
  $codigo = $_SESSION['codigo'];
  $nombre = $_SESSION['nombre'];
  $estado = $_SESSION['estado'];
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

  <title>Panel de gestión</title>
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
                <?php if($estado == 'INICIO_SESION_PROFESOR') {?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalCrearClase"> <i class="fas fa-users"></i> Crear una clase</a>
              <?php } else{?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUnirseClase"> <i class="fas fa-users"></i> Unirse a una clase</a>
                <?php }?>
              </div>
            </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-alt"></i> <?php echo $nombre . " - " . $codigo; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#"><i class="fas fa-key"></i> Cambiar contraseña</a>
            </div>
          </li>
          <li class="form-inline">
            <button onclick="window.location = 'utileria/sesion/cerrar-sesion.php';" class="btn btn-outline-danger btn-sm" type="button">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php include('modals.php'); ?>

  <?php include('content.php'); ?>

  <!--<footer class="page-footer font-small blue fixed-bottom">
    <div class="footer-copyright text-center">
      <h2>
        <span class="badge badge-light">
          © 2019 Copyright: <a href="https://secuenciaLab.com/"> secuenciaLab.com</a>
        </span>
      </h2>
    </div>
  </footer>-->

  <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
