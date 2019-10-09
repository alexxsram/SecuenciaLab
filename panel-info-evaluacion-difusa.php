<!DOCTYPE html>
<?php
include('utileria/operaciones/conexion.php');
$claveAccesoClase =   base64_decode($_GET['claveAccesoClase']);
?>
<html lang="es">
<head>
  <title>Panel de información alumno</title>
  <meta charset="utf-8" />
  <?php include('utileria/encabezados/encabezado-js.php'); ?>
  <?php include('utileria/encabezados/encabezado-css.php'); ?>
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
      <blockquote class="blockquote text-center"> <h1 class="display-4">Evaluación difusa de la clase</h1></blockquote>
      <div class="card" id="info-alumno-datos-clase" name="info-alumno-datos-clase">
        <h5 class="card-header">Datos de la clase</h5>
        <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-clase" name="info-alumno-cuerpo-tarjeta-datos-clase">
        </div>
      </div>
      <div class="card" id="info-evaluacion-encuesta-no-contestada" name="info-evaluacion-encuesta-no-contestada" style="display: none;">
        <h5 class="card-header">Encuestas no contestadas</h5>
        <div class="card-body" id="info-alumno-cuerpo-tarjeta-encuesta-no-contestada" name="info-alumno-cuerpo-tarjeta-encuesta-no-contestada">
        </div>
      </div>
      <div class="card" id="info-evaluacion-calificacion-clase" name="info-evaluacion-calificacion-clase">
        <h1 class="card-header">Calificación de la clase</h1>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-calificacion-clase" name="info-evaluacion-cuerpo-tarjeta-nivel-calificacion-clase">
        </div>
      </div>
      <div class="card" id="info-evaluacion-difu-simulador" name="info-evaluacion-difu-simulador">
        <h5 class="card-header">Dificultad utilización simulador</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-difu-simulador" name="info-evaluacion-cuerpo-tarjeta-difu-simulador">
        </div>
      </div>
      <div class="card" id="info-evaluacion-apoyo-aprendizaje" name="info-evaluacion-apoyo-aprendizaje">
        <h5 class="card-header">Apoyo en el aprendizaje del simulador</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-apoyo-aprendizaje" name="info-evaluacion-cuerpo-tarjeta-apoyo-aprendizaje">
        </div>
      </div>
      <div class="card" id="info-evaluacion-calidad-apoyo" name="info-evaluacion-calidad-apoyo">
        <h5 class="card-header">Calidad del material de apoyo</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-calidad-apoyo" name="info-evaluacion-cuerpo-tarjeta-calidad-apoyo">
        </div>
      </div>
      <div class="card" id="info-evaluacion-claridad-apoyo" name="info-evaluacion-claridad-apoyo">
        <h5 class="card-header">Claridad del material de apoyo</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-claridad-apoyo" name="info-evaluacion-cuerpo-tarjeta-claridad-apoyo">
        </div>
      </div>
      <div class="card" id="info-evaluacion-cantidad-apoyo" name="info-evaluacion-cantidad-apoyo">
        <h5 class="card-header">Cantidad del material de apoyo</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-cantidad-apoyo" name="info-evaluacion-cuerpo-tarjeta-cantidad-apoyo">
        </div>
      </div>
      <div class="card" id="info-evaluacion-calidad-contenido" name="info-evaluacion-calidad-contenido">
        <h5 class="card-header">Calidad del contenido de la clase</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-calidad-contenido" name="info-evaluacion-cuerpo-tarjeta-calidad-contenido">
        </div>
      </div>
      <div class="card" id="info-evaluacion-claridad-contenido" name="info-evaluacion-claridad-contenido">
        <h5 class="card-header">Claridad del contenido de la clase</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-claridad-contenido" name="info-evaluacion-cuerpo-tarjeta-claridad-contenido">
        </div>
      </div>
      <div class="card" id="info-evaluacion-cantidad-contenido" name="info-evaluacion-cantidad-contenido">
        <h5 class="card-header">Cantidad del contenido de la clase</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-cantidad-contenido" name="info-evaluacion-cuerpo-tarjeta-cantidad-contenido">
        </div>
      </div>
      <div class="card" id="info-evaluacion-nivel-aprendizaje" name="info-evaluacion-nivel-aprendizaje">
        <h5 class="card-header">Nivel de aprendizaje</h5>
        <div class="card-body" id="info-evaluacion-cuerpo-tarjeta-nivel-aprendizaje" name="info-evaluacion-cuerpo-tarjeta-nivel-aprendizaje">
        </div>
      </div>
    </div>

    <script src="js/validation-form-plugin/panel-info-alumno.js"></script>
  </body>
  </html>
