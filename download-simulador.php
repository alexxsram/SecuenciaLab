<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include('utileria/encabezados/encabezado-css.php'); ?>
  <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

  <title> SecuenciaLab - Descargar Simulador </title>
</head>

<body> 
 
  <!-- Page Content -->
  <div class="container">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h2 class="font-weight-light"> <i class="fas fa-laptop"></i> <strong>SecuenciaLab: Laboratorio Virtual</strong> </h2>
        <hr>
        <p class="lead text-justify">
          SecuenciaLab es un simulador virtual que ha sido diseñado y desarrollado para la realización de las prácticas relacionadas a la materia de Laboratorio de Sistemas de Control Secuencial,
          el cual consiste en el uso de componentes, conexión de cables de un aparato real para el arranque de motores de 220V.
        </p>
        <br>
        
        <p class="lead"> <i class="fas fa-image"></i> <strong>Imagenes de muestra</strong> </p>
        <hr>
        <!--  carousel -->
        <div class="bd-example">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/download/1.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 1</h5>
                  <p>Conexión de cables entre componentes</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/2.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 2</h5>
                  <p>Cambio de color a los cables</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/3.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 3</h5>
                  <p>Cambio de módulos por otros existentes</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/4.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 4</h5>
                  <p>Simulación de fallo en algún componente</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/5.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 5</h5>
                  <p>Asignación de valores límite en ciertos componentes</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/6.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 6</h5>
                  <p>Información de estado del motor</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/download/7.png" class="d-block w-100" alt="imagen de muestra">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Muestra 7</h5>
                  <p>Visualización del aparato real y sus componentes en un entorno virtual</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <!-- end carousel -->
        <br>
        
        <p class="lead"> <i class="fas fa-feather"></i> <strong>Características de SecuenciaLab</strong> </p>
        <hr>
        <h3 class="lead text-justify">
          El usuario dentro del simulador tiene la posibilidad de realizar lo siguiente:
        </h3>
        <ul class="list-group">
          <li class="list-group-item list-group-item-secondary">Cambiar los componentes del sistema por cualquiera de los que se encuentran existentes.</li>
          <li class="list-group-item list-group-item-secondary">Realizar conexiones de cables entre componentes.</li>
          <li class="list-group-item list-group-item-secondary">Accionar los comportamientos necesarios al presionar botones y/o girar perillas.</li>
          <li class="list-group-item list-group-item-secondary">Asignar valores límite en ciertos componentes.</li>
          <li class="list-group-item list-group-item-secondary">Guardar un archivo de estado del simulador.</li>
          <li class="list-group-item list-group-item-secondary">Cargar archivo de estado del simulador.</li>
        </ul>
        <br>
        <h3 class="lead text-justify">
          Otras características que brinda el simulador son:
        </h3>
        <ul class="list-group">
          <li class="list-group-item list-group-item-secondary">Menu de configuración del simulador.</li>
          <li class="list-group-item list-group-item-secondary">Paneles de ayuda al cambiar cada componente.</li>
        </ul>
        <br>

        <p class="lead"> <i class="fas fa-download"></i> <strong>Opciones de descarga</strong> </p>
        <hr>
        <h3 class="lead text-justify">
          El simulador se encuentra disponible para los siguientes sistemas operativos:
        </h3>
        <div class="btn-toolbar" role="toolbar" aria-label="Opciones de descarga">
          <button type="button" class="btn btn-success btn-block" onclick="cargarPagina('http://tiny.cc/0no0dz');"> <i class="fab fa-windows"></i> Descarga para <br>Windows x32 - 32 bits</button>
          <button type="button" class="btn btn-success btn-block" onclick="cargarPagina('http://tiny.cc/8oo0dz');"> <i class="fab fa-windows"></i> Descarga para <br>Windows x64 - 64 bits</button>
          
          <button type="button" class="btn btn-warning btn-block" onclick="cargarPagina('http://tiny.cc/qqo0dz');"> <i class="fab fa-linux"></i> Descarga para <br>Linux x32 - 32 bits</button>
          <button type="button" class="btn btn-warning btn-block" onclick="cargarPagina('http://tiny.cc/ppo0dz');"> <i class="fab fa-linux"></i> Descarga para <br>Linux x64 - 64 bits</button>
        
          <button type="button" class="btn btn-danger btn-block" onclick="cargarPagina('http://tiny.cc/kro0dz');"> <i class="fab fa-apple"></i> Descarga para <br>Mac x32 - 32 bits</button>
          <button type="button" class="btn btn-danger btn-block" onclick="cargarPagina('http://tiny.cc/fro0dz');"> <i class="fab fa-apple"></i> Descarga para <br>Mac x64 - 64 bits</button>
          
          <button class="btn btn-sm btn-outline-primary btn-block" type="button" onclick="redireccionarPagina('index.php');">
            Regresar <i class="fas fa-arrow-left"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer fixed-bottom py-2 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; SecuenciaLab</small>
    </div>
  </footer>

  <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>

</html>