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
          <?php if($estado == 'INICIO_SESION_PROFESOR') {?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-list-ul"></i> Opciones
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalCrearClase"> <i class="fas fa-users"></i> Crear una clase</a>
              </div>
            </li>
          <?php }?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-alt"></i> <?php echo $nombre; ?>
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

  <!-- El modal para crear una clase -->
  <div class="modal fade" id="modalCrearClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-header bg-info">
          <h4 class="modal-title text-white">Crear una clase</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <form id="formCrearMateria" name="formCrearMateria" method="POST">
          <div id="mensajeCrearMateria"></div>
          <div class="modal-body">
            
            <div class="alert alert-info text-justify" role="alert"> 
              Aquí los profesores que impartan materias pueden crear sus secciones.
              Todos los campos con (*) son obligatorios.
            </div>

            <div class="form-group">
              <label for="nombreClase">Nombre de la clase:</label>
              <input type="text" class="form-control" id="nombreClase" name="nombreClase"  placeholder="Ej. Laboratorio de Control Secuencial" required="required">
            </div>

            <div class="form-group">
              <label for="seccionClase">Sección:</label>
              <input type="text" class="form-control" id="seccionClase" name="seccionClase" placeholder="Ej. D01" required="required">
            </div>

            <div class="form-group">
              <label for="nrcClase">NRC:</label>
              <input type="number" class="form-control" id="nrcClase" name="nrcClase" placeholder="Ej. 46259" min=1 required="required">
            </div>

            <div class="form-group">
              <label for="materiaClase">Materia:</label>
              <input type="text" class="form-control" id="materiaClase" name="materiaClase" placeholder="Ej. Control Secuencial" required="required">
            </div>

            <div class="form-group">
              <label for="aulaClase">Aula:</label>
              <input type="text" class="form-control" id="aulaClase" name="aulaClase"  placeholder="Ej. X-25" required="required">
            </div>

            <!-- ESTO PODRIA DEJARSE COMO TEXTO Y VALIDARLO CON UN PATRON O USAR UN DATEPICKER -->
            <div class="form-group">
              <label for="anoClase">Año:</label>
              <!-- <input type="number" class="form-control" name="numero" id="anoClase" name="anoClase" value="2019" min="2019"
              max="9999" step="1"> -->
              <input type="date" class="form-control" id="anoClase" name="anoClase" placeholder="">
            </div>

            <div class="form-group">
              <label for="cicloEscolarClase">Ciclo escolar:</label>
              <select id="cicloEscolarClase" name="cicloEscolar" class="custom-select">
                <option value="">Seleccionar...</option>
                <option value="clicloA">A</option>
                <option value="clicloB">B</option>
                <option value="clicloV">V</option>
              </select>
            </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
            <button type="submit" class="btn btn-primary">Crear <i class="fas fa-check-circle"></i> </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Full Page Image Header with Vertically Centered Content -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12 text-center">
          <?php if($estado == 'INICIO_SESION_PROFESOR') {?>
            <h1 class="font-weight-light">Bienvenido a la página de administración del profesor</h1>
            <p class="lead">Aquí podrás realizar todo lo necesario para llevar un control de tu(s) materias.</p>
          <?php } else if($estado == 'INICIO_SESION_ALUMNO') {?>
            <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
            <p class="lead">Aquí podrás realizar tus practicas de tu(s) materias.</p>
          <?php }?>
        </div>
      </div>
    </div>
  </header>

  <!-- Footer -->
  <footer class="page-footer font-small blue fixed-bottom">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
      <a href="https://secuenciaLab.com/"> secuenciaLab.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <?php include('utileria/encabezados/encabezado-js.php'); ?>

</body>
</html>
