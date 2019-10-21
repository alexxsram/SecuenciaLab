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
$claveAccesoClase =   base64_decode($_GET['claveAccesoClase']);
$claveUsuario = base64_decode($_GET['codigoAlumno']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Panel de información alumno</title>
  <meta charset="utf-8" />
  <?php include('utileria/encabezados/encabezado-js.php'); ?>
  <?php include('utileria/encabezados/encabezado-css.php'); ?>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
  <!-- optional -->
  <script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
  <script src="http://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
  <!--<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">-->
  <style type="text/css">
  p {
    margin-top: 0;
    margin-bottom: 0rem;
  }
  </style>
</head>
<body>

  <div class="form-group" id="graficas-informativas-alumno" name="graficas-informativas-alumno">
    <div class="form-group">
      <input type="hidden" class="form-control" id="info-alumno-claveAcceso" name="info-alumno-claveAcceso" disabled="disabled" value=<?php echo $claveAccesoClase;?>>
      <input type="hidden" class="form-control" id="info-alumno-codigo-alumno" name="info-alumno-codigo-alumno" disabled="disabled" value=<?php echo $claveUsuario;?>>

  <blockquote class="blockquote text-center"> <h1 class="display-4">Gráficas informativas</h1></blockquote>
  <div class="card" id="info-alumno-datos-clase" name="info-alumno-datos-clase">
    <h5 class="card-header">Datos de la clase</h5>
    <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-clase" name="info-alumno-cuerpo-tarjeta-datos-clase">
    </div>
  </div>

  <div class="card" id="info-alumno-datos-alumno" name="info-alumno-datos-alumno">
    <h5 class="card-header">Datos del alumno</h5>
    <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-alumno" name="info-alumno-cuerpo-tarjeta-datos-alumno">
    </div>
  </div>
  <div class="card" id="info-alumno-listado-practicas" name="info-alumno-listado-practicas">
    <h5 class="card-header">Listado de prácticas</h5>
    <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-practicas" name="info-alumno-cuerpo-tarjeta-datos-practicas">
      <ul class="list-group" style="height: 300px; overflow-y: auto;" id="info-alumno-lista-practicas" name="info-alumno-lista-practicas">
      </ul>
    </div>
  </div>
  <div class="card" id="info-alumno-grafica-practica" name="info-alumno-grafica-practica">
    <h5 class="card-header">Datos y estadísticas de la práctica</h5>
    <div class="card-body" id="info-alumno-cuerpo-tarjeta-estadisticas" name="info-alumno-cuerpo-tarjeta-datos-practicas">
      <p class="card-text" id="info-alumno-descripcion-practica" name="info-alumno-descripcion-practica"><b>Sección de graficación.</b></p>
      <div id="container" name="container" style="width:100%; height:400px;"></div>
    </div>
  </div>

<script src="js/validation-form-plugin/panel-info-alumno.js"></script>
</body>
</html>
