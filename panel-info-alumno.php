<!DOCTYPE html>
<?php
include('utileria/operaciones/conexion.php');
$claveAccesoClase = $_GET['claveAccesoClase'];
$claveUsuario = $_GET['claveUsuario'];
/*//Estraer datos de una clase
$sql = "SELECT * FROM clase WHERE claveAcceso = :claveAcceso";
$resultado = $baseDatos->prepare($sql);
$resultado->bindValue(':claveAcceso', $claveAccesoClase);
$resultado->execute();
$numRow = $resultado->rowCount();
if($numRow != 0)
$clase = $resultado->fetch(PDO::FETCH_OBJ);
//Extraer datos del alumno
$sql = "SELECT * FROM alumnousuario WHERE codigoAlumno = :codigoAlumno";
$resultado = $baseDatos->prepare($sql);
$resultado->bindValue(':codigoAlumno', $claveUsuario);
$resultado->execute();
$numRow = $resultado->rowCount();
if($numRow != 0)
$alumno = $resultado->fetch(PDO::FETCH_OBJ);

//Extraer datos de las prácticas de una clase
$sql = "SELECT * FROM practica WHERE Clase_claveAcceso = :Clase_claveAcceso";
$resultado = $baseDatos->prepare($sql);
$resultado->bindValue(':Clase_claveAcceso', $claveAccesoClase);
$resultado->execute();
$numRow = $resultado->rowCount();
if($numRow != 0)
$practicasClase = $resultado->fetchAll(PDO::FETCH_OBJ);*/
//$practicasClase = $alumno;
?>
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
      <!--    </div>
      <ul class="list-group" id="listgroup22" name="listgroup22">
      <li class="list-group-item active disabled">Lista de alumnos</li>
      <button type="button" class="list-group-item list-group-item-action">DATOS GENERALES</button>
    </ul>
    <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modalEvaluarClase">
    Evaluar materia <i class="fas fa-edit"></i>
  </button>
  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEvaluarClase"> <i class="fas fa-users"></i> Unirse a una clase</a>
-->

<blockquote class="blockquote text-center"> <h1 class="display-4">Gráficas informativas</h1></blockquote>
<div class="card" id="info-alumno-datos-clase" name="info-alumno-datos-clase">
  <h5 class="card-header">Datos de la clase</h5>
  <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-clase" name="info-alumno-cuerpo-tarjeta-datos-clase">
    <!--<p class="card-text" id="info-alumno-clase" name="info-alumno-clase"><b>Clase:</b> <?php echo $clase->nombreClase; ?></p>
    <p class="card-text" id="info-alumno-materia" name="info-alumno-materia"><b>Materia:</b> <?php echo $clase->nombreMateria; ?></p>
    <p class="card-text" id="info-alumno-seccion" name="info-alumno-seccion"><b>Sección:</b> <?php echo $clase->claveSeccion; ?></p>
    <p class="card-text" id="info-alumno-ciclo" name="info-alumno-ciclo"><b>Ciclo:</b> <?php echo $clase->anio; ?> B</p>
    <p class="card-text" id="info-alumno-claveAcceso" name="info-alumno-claveAcceso"><b>Clave de acceso: </b><?php echo $clase->claveAcceso; ?></p>
    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
  </div>
</div>

<div class="card" id="info-alumno-datos-alumno" name="info-alumno-datos-alumno">
  <h5 class="card-header">Datos del alumno</h5>
  <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-alumno" name="info-alumno-cuerpo-tarjeta-datos-alumno">
    <!--<p class="card-text" id="info-alumno-nombre-alumno" name="info-alumno-nombre-alumno"><b>Nombre:</b> <?php echo $alumno->apellidoPaterno." ".$alumno->apellidoMaterno." ".$alumno->nombrePila ; ?></p>
    <p class="card-text" id="info-alumno-codigo-alumno" name="info-alumno-codigo-alumno"><b>Código:</b> <?php echo $alumno->codigoAlumno; ?></p>
    <p class="card-text" id="info-alumno-promedio-alumno" name="info-alumno-promedio-alumno"><b>Promedio:</b> 89.6</p>-->
    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
  </div>
</div>
<div class="card" id="info-alumno-listado-practicas" name="info-alumno-listado-practicas">
  <h5 class="card-header">Listado de practicas</h5>
  <div class="card-body" id="info-alumno-cuerpo-tarjeta-datos-practicas" name="info-alumno-cuerpo-tarjeta-datos-practicas">
    <ul class="list-group" style="height: 300px; overflow-y: auto;" id="info-alumno-lista-practicas" name="info-alumno-lista-practicas">
    </ul>
  </div>
</div>
<div class="card" id="info-alumno-grafica-practica" name="info-alumno-grafica-practica">
  <h5 class="card-header">Datos y estadísticas de la práctica</h5>
  <div class="card-body" id="info-alumno-cuerpo-tarjeta-estadisticas" name="info-alumno-cuerpo-tarjeta-datos-practicas">
    <p class="card-text"><b>Descripción:</b> knasjkjdajkñdkjlaskmlkmlsadkmldsklm</p>
    <div id="container" style="width:100%; height:400px;"></div>
  </div>
</div>


<!-- El modal para editar una practica -->
<div class="modal fade" id="modalEvaluarClase" name="modalEvaluarClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title text-white">Evaluar clase</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formEvaluarClase" name="formEvaluarClase" method="POST">
        <div class="modal-body">
          <div class="alert alert-info text-justify" role="alert">
            En está sección se realiza la evalución de la clase.
            Estos datos son de suma importancia para mejorar la calidad del curso y del aprendisaje obtenido.
          </div>

          <div class="form-group">
            <label for="editarNombrePractica">Calidad del contenido</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCalidadCont" name="evalCalidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Claridad del contenido</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalClaridadCont" name="evalClaridadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Cantidad del contenido</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCantidadCont" name="evalCantidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>

          <div class="form-group">
            <label for="editarNombrePractica">Calidad del material de apoyo</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCalidadMatApoyo" name="evalCalidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Claridad del material de apoyo</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalClaridadMatApoyo" name="evalClaridadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Cantidad del material de apoyo</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCantidadMatApoyo" name="evalCantidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Ayuda en el aprendizaje del simulador de control secuencial</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalSimulador" name="evalClaridadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">Facilidad de utilización simulador de control secuencial</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalFacilidadSimulador" name="evalCantidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <div class="form-group">
            <label for="editarNombrePractica">¿Cuanto aprendió?</label>
            <div class="form-group">
              <input type="range" class="custom-range" min="0" max="100" step="1" id="evalAprendizaje" name="evalCantidadCont">
              <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
            </div>
          </div>
          <!--<div class="container">
          <h1>Bootstap Slider Sample Project</h1>
          <p>This is a sample project for bootstrap slider</p>
          <input id="ex13" name="ex13" type="text"/>
          <script>
          // With JQuery
          $("#ex13").slider({
          ticks: [0, 20, 40, 60, 80, 100],
          ticks_labels: ['Nada claro', 'Poco claro', 'Claro', 'Muy claro', 'Clarisimo',"sepa"],
          ticks_snap_bounds: 1,
          orientation: 'horizontal',
          value: 20,
          handle: 'triangle'
        });
      </script>
    </div>-->
  </div>


  <!-- Modal footer -->
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
    <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-save"></i> </button>
  </div>
</form>
</div>
</div>
</div>

<!--<div class="container" style="margin-top: 60px">
<form class="well col-xs-6 col-xs-offset-3">
<div class="form-group">
<label id="commentTitle" for="comment">Comment:</label>
<textarea   class="form-control" rows="5" id="comment" name="comment"></textarea>
</div>
<button type="button" class="btn btn-primary " id="btn22" name="btn22">submit</button>
</form>
</div>-->
</div>
</body>
</html>
