<?php
include('../operaciones/conexion.php');

try {
  $codigoAlumno = htmlentities(addslashes($_GET['codigoAlumno']));
  $idPractica = htmlentities(addslashes($_GET['idPractica']));
  $criterio = htmlentities(addslashes($_GET['criterio']));

  if($codigoAlumno != '' && $idPractica != '') {
    $sql = 'SELECT P.*, C.* FROM cuestionario C
    INNER JOIN practica P ON P.idPractica = C.Practica_idPractica
    WHERE C.Practica_idPractica = :pip AND C.AlumnoUsuario_codigoAlumno = :auca';

    $resultado = $baseDatos->prepare($sql);
    $array = array(
      ':pip' => $idPractica,
      ':auca' => $codigoAlumno
    );
    $resultado->execute($array);

    $numRow = $resultado->rowCount();
    if($numRow != 0) {
      $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);

      $sql = 'SELECT * FROM evaluacion
      WHERE Cuestionario_idCuestionario = :cicu';

      $resultado = $baseDatos->prepare($sql);
      $resultado->bindValue(':cicu', $cuestionario->idCuestionario);
      $resultado->execute();
      $numRowEvaluacion = $resultado->rowCount();
      $evaluacion = $resultado->fetch(PDO::FETCH_OBJ);
      ?>

      <div class="card border-dark mb-3">
        <div class="card-header border-dark">
          Información de la práctica
        </div>

        <div class="card-body text-dark">
          <h5 class="card-title">Descripción del problema</h5>
          <p class="card-text"><?php echo $cuestionario->descripcion; ?></p>

          <hr>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Respuesta de la pregunta 1</h5>
            <p><?php echo $cuestionario->respuestaPregunta1; ?></p>
          </div>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Respuesta de la pregunta 2</h5>
            <p><?php echo $cuestionario->respuestaPregunta2; ?></p>
          </div>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Respuesta de la pregunta 3</h5>
            <p><?php echo $cuestionario->respuestaPregunta3; ?></p>
          </div>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Conclusión</h5>
            <p><?php echo $cuestionario->conclusion; ?></p>
          </div>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Diagrama de control</h5>
            <button type="button" class="btn btn-sm btn-outline-success" onclick="descargarArchivo(<?php echo '\'' . $cuestionario->rutaArchivo . '\''; ?> , <?php echo '\'' . $cuestionario->nombreOriginal . '\''; ?> );">
              Descargar archivo
            </button>
          </div>

          <div class="alert alert-light text-justify" role="alert">
            <h5 class="alert-heading">Reporte práctica</h5>

            <button type="button" class="btn btn-sm btn-outline-dark" onclick="cargarContenido('../../DOCS/examples/', 'reporte-una-practica-alumno.php', 'claveAccesoClase=' + <?php echo '\'' . base64_encode($cuestionario->Clase_claveAcceso) . '\''; ?> + '&codigoAlumno='+ <?php echo '\'' . base64_encode($codigoAlumno) . '\''; ?> + '&idPractica='+ <?php echo '\'' . base64_encode($idPractica) . '\''; ?>);">
              Reporte práctica <i class="fas fa-file-pdf"></i>
            </button>
          </div>

        <form id="formCalificarPractica" name="formCalificarPractica" method="POST">
          <div class="alert alert-light text-justify" role="alert">
            <div class="form-group">
              <label for="calificacion">Calificación de la práctica *</label>
              <?php if($numRowEvaluacion == 0) { ?>
                <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="0-100" min="0" max="100" required="required">
              <?php } else { ?>
                <input type="text" class="form-control" id="calificacion" name="calificacion" value="<?php echo $evaluacion->califiacion; ?>" placeholder="0-100" min="0" max="100" required="required">
              <?php } ?>
            </div>

            <div class="form-group">
              <input type="hidden" class="form-control" id="idCuestionario" name="idCuestionario" value="<?php echo $cuestionario->idCuestionario; ?>" disabled="disabled">
            </div>

            <?php if($criterio == 'P') { ?>
              <div class="form-group">
                <input type="hidden" class="form-control" id="criterioCalificar" name="criterioCalificar" value="<?php echo $cuestionario->Practica_idPractica; ?>" disabled="disabled">
              </div>
            <?php } else { ?>
              <div class="form-group">
                <input type="hidden" class="form-control" id="criterioCalificar" name="criterioCalificar" value="<?php echo $codigoAlumno; ?>" disabled="disabled">
              </div>
            <?php } ?>

            <div class="form-group ">
              <button type="submit" class="btn btn-sm btn-outline-primary float-right">
                Calificar <i class="fas fa-save"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
    include('../encabezados/encabezado-js.1.php'); // con esto funciona el form
  }
}
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
