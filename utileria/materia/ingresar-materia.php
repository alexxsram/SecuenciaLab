<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
  header('Location: ../sesion/sesion.php');
} else {
  $codigo = $_SESSION['codigo'];
  $nombre = $_SESSION['nombre'];
  $estado = $_SESSION['estado'];
}
include('../operaciones/conexion.php');

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);
$maxLongTituloPractica = 100;

try {
  $sql = "SELECT * FROM clase WHERE claveAcceso = :claveAcceso";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAccesoClase);
  $resultado->execute();
  $clase = $resultado->fetch(PDO::FETCH_OBJ);
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">

    <title> <?php echo $clase->nombreClase; ?> </title>
  </head>

  <body>
    <!-- CONTAINER -->
    <div class="container">
      <?php
      $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
      $resultado = $baseDatos->prepare($sql);
      $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
      $resultado->execute();
      $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
      ?>

      <!-- JUMBOTRON DE LOS DATOS DE LA CLASE -->
      <div class="jumbotron col-12">
        <div class="container">
          <blockquote class="blockquote text-center">
            <h1 class="display-4"> <?php echo $clase->nombreClase; ?> </h1>
          </blockquote>

          <p class="h6">
            <small class="text-muted"> Materia: <?php echo $clase->nombreMateria; ?> </small>
          </p>

          <p class="h6">
            <small class="text-muted"> Sección: <?php echo $clase->claveSeccion; ?> </small>
          </p>

          <p class="h6">
            <small class="text-muted"> Aula: <?php echo $clase->aula; ?> </small>
          </p>

          <p class="h6">
            <small class="text-muted"> Ciclo: <?php echo $clase->anio . " " . $ciclo->ciclo; ?> </small>
          </p>

          <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
            <p class="h6"> <small class="text-muted">
              Clave de acceso: <?php echo $clase->claveAcceso; ?>
              <button class="btn " style="background-color:transparent;" data-toggle="tooltip" title="Mostrar" onclick="expandirClaveAcceso(<?php echo '\''.$clase->claveAcceso.'\'' ?>);">
                <i class="fas fa-sign-in-alt"></i>
              </button>
            </p>

            <p class="lead text-justify">
              En la siguiente sección, el profesor puede crear las prácticas de laboratorio relacionadas al manual
            </p>

            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones de la clase
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearAnuncio" data-codigoprofesor="<?php echo $codigo; ?>" data-claveacceso="<?php echo $clase->claveAcceso; ?>"><i class="fas fa-info-circle"></i> Agregar anuncio</button>
                <button class="dropdown-item" data-toggle="modal" data-target="#modalCrearPractica" data-claveacceso="<?php echo $clase->claveAcceso; ?>"><i class="fas fa-clipboard"></i> Agregar práctica</button>
              </div>
            </div>
          <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
            <p class="h6"> <small class="text-muted">
              Clave de acceso: <?php echo $clase->claveAcceso; ?>
            </p>
          <?php } ?>
          <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
        </div>
      </div>
      <!-- FIN DEL JUMBOTRON DE LOS DATOS DE LA CLASE -->

      <!-- PESTAÑAS/TABS DEL CONTENIDO QUE VOY A MOSTRAR -->
      <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">
        <!-- HEADER DE LOS TAB -->
        <div class="card-header bg-dark border-dark">
          <ul class="nav nav-pills justify-content-end card-header-pills text-white" id="tabsDashboard" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="tablero-tab" data-toggle="tab" href="#tablero" role="tab" aria-controls="tablero" aria-selected="true">Tablero</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="practica-tab" data-toggle="tab" href="#practica" role="tab" aria-controls="practica" aria-selected="true">Práctica</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="alumnos" aria-selected="true">Alumnos</a>
            </li>
          </ul>
        </div>
        <!-- FIN DEL HEADER DE LOS TAB -->

        <!-- CUERPO DE LOS TAB -->
        <div class="card-body">
          <!-- CONTENIDO DEL TAB -->
          <div class="tab-content" id="myTabContent">
            <!-- TAB DEL TABLERO/ANUNCIOS -->
            <div class="tab-pane fade show active" id="tablero" role="tabpanel" aria-labelledby="tablero-tab">
              <?php
              if($estado == 'INICIO_SESION_PROFESOR') {
                $sql = 'SELECT * FROM anuncio WHERE ProfesorUsuario_codigoProfesor = :pucp AND Clase_claveAcceso = :cca ORDER BY fechaPublicacion DESC';
                $resultado = $baseDatos->prepare($sql);
                $array = array(':pucp'=>$codigo, ':cca'=>$claveAccesoClase);
                $resultado->execute($array);
              } else if($estado == 'INICIO_SESION_ALUMNO') {
                $sql = 'SELECT * FROM anuncio WHERE Clase_claveAcceso IN (SELECT Clase_claveAcceso FROM clase_has_alumnousuario WHERE Clase_claveAcceso = :cca) ORDER BY fechaPublicacion DESC';
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':cca', $claveAccesoClase);
                $resultado->execute();
              }

              $numRow = $resultado->rowCount();
              if($numRow == 0) {
                ?>

                <div class="col-12 text-center">
                  <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                    <h1 class="font-weight-light">La clase no tiene anuncios</h1>
                    <p class="lead">Se debe crear uno, para revisión de trabajo pendiente.</p>
                  <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                    <h1 class="font-weight-light">La clase no tiene anuncios</h1>
                    <p class="lead">Esperar anuncios.</p>
                  <?php } ?>
                </div>

                <?php
              } else {
                $anuncios = $resultado->fetchAll(PDO::FETCH_OBJ);
                foreach ($anuncios as $anuncio) {
                  $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';
                  $resultado = $baseDatos->prepare($sql);
                  $resultado->bindValue(':cp', $anuncio->ProfesorUsuario_codigoProfesor);
                  $resultado->execute();
                  $profesorAnuncio = $resultado->fetch(PDO::FETCH_OBJ);
                  ?>

                  <!-- Ejemplo de card para anuncios -->
                  <div class="card gedf-card" style="margin-bottom: 15px;">
                    <div class="card-header">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="mr-2">
                            <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                          </div>
                          <div class="ml-2">
                            <div class="h6 m-0 text-muted"> <?php echo $profesorAnuncio->nombrePila . ' ' . $profesorAnuncio->apellidoPaterno . ' ' . $profesorAnuncio->apellidoMaterno; ?> </div>
                            <div class="h7 text-muted"> a <?php echo $clase->nombreClase; ?> </div>
                          </div>
                        </div>
                        <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                          <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                              <div class="h6 dropdown-header">Configuración</div>
                              <button class="dropdown-item" data-toggle="modal"  data-target="#modalEditarAnuncio" data-idanuncio="<?php echo $anuncio->idAnuncio; ?>" data-titulo="<?php echo $anuncio->titulo; ?>" data-contenido="<?php echo $anuncio->contenido; ?>" data-fechapublicacion="<?php echo $anuncio->fechaPublicacion; ?>" data-claveacceso="<?php echo $anuncio->Clase_claveAcceso; ?>">
                                <i class="fas fa-edit"></i> Editar
                              </button>
                              <button type="button" class="dropdown-item" onclick="confirmarEliminar(<?php echo '\'' . $anuncio->idAnuncio . '-' . $anuncio->titulo . '-' . $clase->claveAcceso . '\'';?>, 'anuncio');">
                                <i class="fas fa-trash"></i> Eliminar
                              </button>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="text-muted h7 mb-2">
                        <i class="fas fa-calendar"></i> <?php $fecha = date_create($anuncio->fechaPublicacion); echo date_format($fecha, 'l jS F Y'); ?>
                      </div>

                      <p class="card-link">
                        <h5 class="card-title"> <?php echo $anuncio->titulo; ?> </h5>
                      </p>

                      <p class="card-text text-muted">
                        <?php echo $anuncio->contenido; ?>
                      </p>
                    </div>

                    <div class="card-footer">
                      <?php
                      $sql = "SELECT * FROM comentario WHERE Anuncio_idAnuncio = :aia";
                      $resultado = $baseDatos->prepare($sql);
                      $resultado->bindValue(':aia', $anuncio->idAnuncio);
                      $resultado->execute();
                      $numRow = $resultado->rowCount();
                      ?>
                      <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target="#collapseComentariosAnuncio<?php echo $anuncio->idAnuncio; ?>" aria-expanded="false" aria-controls="collapseComentarios">
                        <i class="fas fa-comment"></i> Comentarios <span class="badge badge-light"><?php echo $numRow; ?></span>
                      </button>
                    </div>

                    <div class="collapse" id="collapseComentariosAnuncio<?php echo $anuncio->idAnuncio; ?>">
                      <div class="card card-body">
                        <!-- Aquí van a ir los comentarios y un form para hacer un comentario -->
                        <?php
                        $sql = "SELECT * FROM comentario WHERE Anuncio_idAnuncio = :aia";
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':aia', $anuncio->idAnuncio);
                        $resultado->execute();

                        $numRow = $resultado->rowCount();
                        if($numRow == 0) {
                          ?>

                          <div class="col-12">
                            <p class="lead" style="font-size: 12.5px;">
                              Sin comentarios disponibles, comentar algo al anuncio.
                            </p>
                          </div>

                          <?php
                        } else {
                          $comentarios = $resultado->fetchAll(PDO::FETCH_OBJ);
                          foreach ($comentarios as $comentario) {
                            ?>

                            <div class="alert alert-secondary" role="alert" style="margin-bottom: 2px;">
                              <?php
                              $pos = strpos($comentario->comentario, ': ');
                              $nombreComentario = substr($comentario->comentario, 0, $pos);
                              $mensajeComentario = substr($comentario->comentario, $pos, strlen($comentario->comentario) - 1);
                              ?>

                              <strong><?php echo $nombreComentario; ?></strong><?php echo $mensajeComentario; ?>

                              <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                                <button type="button" class="close" onclick="confirmarEliminar(<?php echo '\'' . $comentario->idComentario . '-' . $clase->claveAcceso . '\'';?>, 'comentario');">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              <?php } ?>
                            </div>

                            <?php
                          }
                        }
                        ?>

                        <form id="formComentarAnuncio" name="formComentarAnuncio" method="POST">
                          <div class="form-group">
                            <input type="hidden" class="form-control" id="claveAccesoClase" name="claveAccesoClase" value="<?php echo $clase->claveAcceso; ?>" disabled="disabled">
                          </div>

                          <div class="form-group">
                            <input type="hidden" class="form-control" id="comentarioIdAnuncio" name="comentarioIdAnuncio" value="<?php echo $anuncio->idAnuncio; ?>" disabled="disabled">
                          </div>

                          <div class="form-group">
                            <input type="hidden" class="form-control" id="comentarioNombre" name="comentarioNombre" value="<?php echo $nombre; ?>" disabled="disabled">
                          </div>

                          <div class="form-group">
                            <textarea class="form-control" id="comentario" name="comentario" placeholder="Haz un comentario" required="required"></textarea>
                          </div>

                          <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary float-right">Guardar <i class="fas fa-comment"></i> </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <?php
                }
              }
              ?>
            </div>
            <!-- FIN DEL TAB DEL TABLERO/ANUNCIOS -->

            <!-- TAB DE LAS PRACTICAS -->
            <div class="tab-pane fade" id="practica" role="tabpanel" aria-labelledby="practica-tab">
              <?php
              $sql = "SELECT * FROM practica WHERE Clase_claveAcceso LIKE :claveAcceso ORDER BY fechaLimite ASC";
              $resultado = $baseDatos->prepare($sql);
              $resultado->bindValue(':claveAcceso', $clase->claveAcceso);
              $resultado->execute();

              $numRow = $resultado->rowCount();
              if($numRow == 0) {
                ?>

                <div class="col-12 text-center">
                  <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                    <h1 class="font-weight-light">La clase no cuenta con prácticas</h1>
                    <p class="lead">Es necesario crear las prácticas para que los alumnos las puedan realizar.</p>
                  <?php } if($estado == 'INICIO_SESION_ALUMNO') { ?>
                    <h1 class="font-weight-light">La clase no cuenta con prácticas</h1>
                    <p class="lead">Esperar a una práctica.</p>
                  <?php } ?>
                </div>

                <?php
              } else {
                $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
                if($estado == 'INICIO_SESION_PROFESOR') {
                  ?>

                  <div class="card" style="border-radius: 5px;">
                    <table class="table table-hover table-stripped cart-wrap">
                      <thead class="text-muted">
                        <tr>
                          <th scope="col">
                            Nombre
                          </th>
                          <th scope="col">
                            Descripción
                          </th>
                          <th scope="col">
                            Fecha limite de entrega
                          </th>
                          <th scope="col" class="text-center">
                            Acción
                          </th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php foreach($practicas as $practica) { ?>
                          <tr>
                            <td>
                              <?php echo $practica->nombre; ?>
                            </td>

                            <td>
                              <?php
                              $longitud = strlen($practica->descripcion);
                              if($longitud > 30) { ///SI ES UN TEXTO MUY LARGO QUE EXCEDE MAS DE 30 CARACTERES
                                echo substr($practica->descripcion, 0, 30) . '...';
                              } else {
                                echo $practica->descripcion;
                              }
                              ?>
                            </td>

                            <td>
                              <?php echo $practica->fechaLimite; ?>
                            </td>

                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalEditarPractica"
                                data-idpractica="<?php echo $practica->idPractica; ?>"
                                data-nombre="<?php echo $practica->nombre; ?>"
                                data-descripcion="<?php echo $practica->descripcion; ?>"
                                data-fechalimite="<?php echo $practica->fechaLimite; ?>"
                                data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                                Editar <i class="fas fa-edit"></i>
                              </button>

                              <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminar(<?php echo '\'' . $practica->idPractica . '-' . $practica->nombre . '-' . $clase->claveAcceso . '\''; ?>, 'practica');">
                                Eliminar <i class="fas fa-times"></i>
                              </button>

                              <button type="button" class="btn btn-sm btn-outline-primary" onclick="cargarContenido('../practica/', 'calificar-entrega.php', 'criterioCalificar=' + <?php echo '\'' . base64_encode($practica->idPractica) . '\''; ?>
                                );">
                                Calificar <i class="fas fa-edit"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

                <?php
              } else if($estado == 'INICIO_SESION_ALUMNO') {
                ?>

                <div class="card-columns">
                  <?php
                  $actividadNoEntregada = false;
                  $actividadEntregada = false;
                  $actividadCalificada = false;
                  $colorBorde = 'success';
                  $botonEntregarHabilitado = '';
                  $estadoActidad = 'Ninguno';
                  $cuestionario = "";
                  $evaluacion = "";

                  foreach ($practicas as $practica) {
                    //Buscar todos los cuestionarios de un alumno
                    $sql = "SELECT * FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca";
                    $resultado = $baseDatos->prepare($sql);
                    //$array = array(':pip'=>$practica->idPractica, ':auca'=>$codigo);
                    $resultado->bindValue(':pip', $practica->idPractica);
                    $resultado->bindValue(':auca', $codigo);
                    $resultado->execute();
                    //$resultado->execute($array);
                    $numRowCuestionario = 0;
                    $numRowCuestionario = $resultado->rowCount();
                    if($numRowCuestionario == 1) {
                      $actividadEntregada = true;
                      $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);
                      //Comprobar si el cuestionario esta calificado
                      $sql = "SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario = :cicu";
                      $resultado = $baseDatos->prepare($sql);
                      $array = array(':cicu'=>$cuestionario->idCuestionario);
                      $resultado->execute($array);
                      $numRowEvaluacion = $resultado->rowCount();
                      if($numRowEvaluacion == 1) {
                        $actividadCalificada = true;
                        $evaluacion = $resultado->fetch(PDO::FETCH_OBJ);
                      }
                    }

                    if($actividadEntregada && (date('Y-m-d') < $practica->fechaLimite) && $cuestionario->Practica_idPractica==$practica->idPractica && !$actividadCalificada) { // Si la actividad no ha sido entregada y no pasa de la fecha limite
                      $colorBorde = "warning";
                      $botonEntregarHabilitado = "";
                      $estadoActidad = "Entregada - Editable";
                    } else if($actividadEntregada && date('Y-m-d') > $practica->fechaLimite) {
                      $colorBorde = "success";
                      $botonEntregarHabilitado = "";
                      $estadoActidad = "Entregada - Finalizada";
                      $botonEntregarHabilitado = "disabled=\"true\"";
                    } else if(date('Y-m-d') > $practica->fechaLimite) { // Si la practica pasa de la fecha limite
                      $actividadNoEntregada = true;
                      $colorBorde = "danger";
                      $botonEntregarHabilitado = "";
                      $estadoActidad = "No Entregada";
                      $botonEntregarHabilitado = "disabled=\"true\"";
                    } else if($actividadCalificada) {
                      $colorBorde = "primary";
                      $botonEntregarHabilitado = "";
                      $estadoActidad = "Calificada: " . $evaluacion->califiacion;
                      $botonEntregarHabilitado = "disabled=\"true\"";
                    } else {
                      $estadoActidad = "Pendiente de entrega";
                      $colorBorde = "dark";
                      $botonEntregarHabilitado = "";
                    }
                    ?>
                    <div class="card border-<?php echo $colorBorde; ?> mb-3">
                      <div class="card-header bg-transparent border-<?php echo $colorBorde; ?>">
                        <div class="form-group text-center">
                          <h5><span class="badge badge-<?php echo $colorBorde; ?>"><?php echo $estadoActidad; ?></span></h5>
                        </div>
                      </div>
                      <div class="card-body text-center">
                        <h5 class="card-title text-center">
                          <?php
                          $longNombreClase = strlen($practica->nombre);
                          $longRelleno = $maxLongTituloPractica - $longNombreClase;
                          echo $practica->nombre;
                          $auxiliar="";
                          for($i=0; $i<$longRelleno; $i++) {$auxiliar .= "_";}
                          echo $auxiliar;
                          ?>
                        </h5>

                        <p class="card-text">
                          <?php
                          $longitud = strlen($practica->descripcion);
                          if($longitud > 30) { ///SI ES UN TEXTO MUY LARGO QUE EXCEDE MAS DE 30 CARACTERES
                            echo substr($practica->descripcion, 0, 30) . '...';
                          } else {
                            echo $practica->descripcion;
                          }
                          ?>
                        </p>

                        <button type="button" class="btn btn-sm btn-outline-<?php echo $colorBorde; ?>" data-toggle="modal" <?php echo $botonEntregarHabilitado; ?> data-target="#modalEntregaPractica"
                          data-idpractica="<?php echo $practica->idPractica; ?>";
                          data-nombre="<?php echo $practica->nombre; ?>";
                          data-descripcion="<?php echo $practica->descripcion; ?>";
                          data-fechalimite="<?php echo $practica->fechaLimite; ?>";
                          data-codigoalumno="<?php echo $codigo; ?>"
                          data-claveacceso="<?php echo $clase->claveAcceso; ?>">
                          Entregar <i class="fas fa-check-square"></i>
                        </button>
                      </div>

                      <div class="card-footer border-<?php echo $colorBorde; ?>">
                        <small class="text-muted"><i class="fas fa-calendar"></i> Fecha de entrega: <?php echo $practica->fechaLimite; ?></small>
                      </div>
                    </div>

                    <?php
                  }
                  ?>
                </div>

                <?php
              }
            }
            ?>
          </div>
          <!-- FIN DEL TAB DE LAS PRACTICAS -->

          <!-- TAB DE LA LISTA DE ALUMNOS -->
          <div class="tab-pane fade" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
            <?php
            $sql = 'SELECT A.codigoAlumno AS codigo, CONCAT(A.nombrePila, " ", A.apellidoPaterno, " ", A.apellidoMaterno) AS nombreCompleto ';
            $sql .= 'FROM clase_has_alumnousuario AS C ';
            $sql .= 'INNER JOIN alumnousuario A ON C.AlumnoUsuario_codigoAlumno = A.codigoAlumno ';
            $sql .= 'WHERE C.Clase_claveAcceso = :claveAcceso';
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':claveAcceso', $claveAccesoClase);
            $resultado->execute();

            $numRow = $resultado->rowCount();
            if($numRow == 0) {
              ?>

              <div class="col-12 text-center">
                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                  <h1 class="font-weight-light">La clase no tiene alumnos inscritos</h1>
                  <p class="lead">Es necesario proporcionar a los alumnos el código de acceso para ingresar a la clase.</p>
                <?php } if($estado == 'INICIO_SESION_ALUMNO') { ?>
                  <h1 class="font-weight-light">La clase no tiene alumnos inscritos</h1>
                  <p class="lead">Usted es el unico alumno en la clase, dsifrute este espacio libre mientras pueda.</p>
                <?php } ?>
              </div>

              <?php
            } else {
              $alumnosClase = $resultado->fetchAll(PDO::FETCH_OBJ);
              ?>

              <div class="list-group list-group-flush" id="listaAlumnos" name="listaAlumnos">
                <h3 class="list-group-item list-group-item-heading">
                  Lista de Alumnos
                </h3>
              </div>

              <br>

              <ul class="list-group">
                <?php foreach ($alumnosClase as $alumnoClase) { ?>
                  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <?php if($estado == 'INICIO_SESION_ALUMNO') {
                      echo $alumnoClase->codigo . ' - ' . $alumnoClase->nombreCompleto;
                    }else if($estado == 'INICIO_SESION_PROFESOR') {
                      $data = $baseDatos->query("SELECT AVG(califiacion) as promedio FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica IN (SELECT Practica_idPractica FROM practica WHERE Clase_claveAcceso = '$claveAccesoClase') and AlumnoUsuario_codigoAlumno = '$alumnoClase->codigo')")->fetchAll();
                      foreach ($data as $row) {
                        $promedioAlumno = round($row['promedio'], 4);
                      }
                      if(!$promedioAlumno){
                        $promedioAlumno = 0;
                      }
                      $botones = "";
                      $colorEstadoPromedio = "";
                      $rellenoNumero = "";
                      if($promedioAlumno>=0 and $promedioAlumno<=9){
                        $rellenoNumero="0";
                      }
                      if($promedioAlumno==0){
                        $colorEstadoPromedio = "secondary";
                        //echo "<span class=\"badge badge-secondary badge-pill\">$promedioAlumno</span>";
                      }else if($promedioAlumno>=1 and $promedioAlumno<=59){
                        $colorEstadoPromedio = "danger";
                        //echo "<span class=\"badge badge-danger badge-pill\">";
                      }else if($promedioAlumno>=60 and $promedioAlumno<=70){
                        $colorEstadoPromedio = "warning";
                        //echo "<span class=\"badge badge-warning badge-pill\">";
                      }else if($promedioAlumno>=71 and $promedioAlumno<=90){
                        $colorEstadoPromedio = "primary";
                        //echo "<span class=\"badge badge-primary badge-pill\">";
                      }else if($promedioAlumno>=91 and $promedioAlumno<=100){
                        $colorEstadoPromedio = "success";
                        //echo "<span class=\"badge badge-success badge-pill\">";
                      }else{
                        $colorEstadoPromedio = "muted";
                        //echo "<span class=\"badge badge-muted badge-pill\">";
                      }
                      echo "<h5><span class=\"badge badge-$colorEstadoPromedio badge-pill\">$rellenoNumero$promedioAlumno</span></h5>";
                      echo $alumnoClase->codigo . ' - ' . $alumnoClase->nombreCompleto;
                      ?>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="redireccionarPagina('../../panel-info-alumno.php?claveAccesoClase=' + <?php echo '\'' . base64_encode($clase->claveAcceso) . '\''; ?> + '&claveUsuario=' + <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>);">
                          Ver gráficas <i class="fas fa-chart-bar"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="cargarContenido('../practica/', 'calificar-entrega.php', 'criterioCalificar=' + <?php echo '\'' . base64_encode($alumnoClase->codigo) . '\''; ?>
                          );"> Calificar <i class="fas fa-clipboard-check"></i>
                        </button>
                      </div>
                    <?php } ?>
                  </li>
                <?php } ?>
              </ul>
              <?php
            }
            ?>
          </div>
          <!-- FIN DEL TAB DE LA LISTA DE ALUMNOS -->
        </div>
        <!-- FIN DEL CONTENIDO DEL TAB -->
      </div>
      <!-- FIN DEL CUERPO DE LOS TAB  -->
    </div>
    <!-- TERMINA LAS PESTAÑAS/TABS DEL CONTENIDO -->
  </div>
  <!-- FIN DEL CONTAINER -->

  <?php include('../../modals.php'); ?>

  <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>
</html>

<?php
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
