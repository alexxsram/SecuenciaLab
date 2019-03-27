<?php
session_start(); 
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
  header('Location: utileria/sesion/sesion.php');
} else {
  $codigo = $_SESSION['codigo'];
  $nombre = $_SESSION['nombre'];
  $estado = $_SESSION['estado'];
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
              <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalCrearClase"> <i class="fas fa-users"></i> Crear una clase</a>
              <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUnirseClase"> <i class="fas fa-users"></i> Unirse a una clase</a>
              <?php } ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-alt"></i> <?php echo $nombre . " - " . $codigo; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" data-toggle="modal" href="#modalCambiarPassword" data-codigo="<?php echo $codigo; ?>"><i class="fas fa-key"></i> Cambiar contraseña</a>
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

  <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
