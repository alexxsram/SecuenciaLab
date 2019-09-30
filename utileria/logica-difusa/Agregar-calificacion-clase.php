<?php
include('../operaciones/conexion.php');
include('Evaluacion-clase-fuzzy.php');

try {
  $evalClase = new SistemaFuzzyEvalucionClase();
  $idPractica = htmlentities(addslashes($_POST['idPractica']));
  $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));
  $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));
  $evalCalidadCont = htmlentities(addslashes($_POST['evalCalidadCont']));
  $evalClaridadCont = htmlentities(addslashes($_POST['evalClaridadCont']));
  $evalCantidadCont = htmlentities(addslashes($_POST['evalCantidadCont']));
  $evalCalidadMatApoyo = htmlentities(addslashes($_POST['evalCalidadMatApoyo']));
  $evalClaridadMatApoyo = htmlentities(addslashes($_POST['evalClaridadMatApoyo']));
  $evalCantidadMatApoyo = htmlentities(addslashes($_POST['evalCantidadMatApoyo']));
  $evalSimulador = htmlentities(addslashes($_POST['evalSimulador']));
  $evalFacilidadSimulador = htmlentities(addslashes($_POST['evalFacilidadSimulador']));
  $evalAprendizaje = htmlentities(addslashes($_POST['evalAprendizaje']));
  $evalClase->inferir($evalFacilidadSimulador,$evalSimulador,
  $evalCalidadMatApoyo,$evalClaridadMatApoyo,$evalCantidadMatApoyo,
  $evalCalidadCont,$evalClaridadCont,$evalCantidadCont,$evalAprendizaje, false);

  if($evalClase->calificacionClaseDifuso != 'Error') {
    $sql = "SELECT * FROM evaluaciondifusa WHERE Practica_idPractica = :idPrac
    AND AlumnoUsuario_codigoAlumno = :codAlum";

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':idPrac', $idPractica);
    $resultado->bindValue(':codAlum', $codigoAlumno);
    $resultado->execute();
    $numRow = $resultado->rowCount();

    if($numRow > 0) {
      $evaluacionDifusa = $resultado->fetch(PDO::FETCH_OBJ);
      $sql = 'UPDATE evaluaciondifusa SET dificulSimuNitido = :difiSimuNiti,
      apoyoSimuNitido = :apoSimuNiti,
      CalMatApoNitido = :CalMatApoNiti,
      ClarMatApoNitido = :ClarMatApoNiti,
      CantMatApoNitido = :CantMatApoNiti,
      CalContNitido = :CalContNiti,
      ClarContNitido = :ClarContNiti,
      CantContNitido = :CantContNiti,
      nivelAprendizajeNitido = :nivelAprendiNiti,
      calificacionClaseNitido = :califClaseNiti,
      calificacionClaseDifuso = :califClaseDifu,
      dificulSimuDifuso = :difiSimuDifu,
      apoyoSimuDifuso = :apoSimuDifu,
      CalMatApoDifuso = :CalMatApoDifu,
      ClarMatApoDifuso = :ClarMatApoDifu,
      CantMatApoDifuso = :CantMatApoDifu,
      CalContDifuso = :CalContDifu,
      ClarContDifuso = :ClarContDifu,
      CantContDifuso = :CantContDifu,
      nivelAprendizajeDifuso = :nivelAprendiDifu,
      Practica_idPractica = :practIdPract,
      AlumnoUsuario_codigoAlumno = :AlumCodAlum,
      calificacion = :califi
      WHERE idEvaluacionDifusa = :idEvalDifusa';
      $resultado = $baseDatos->prepare($sql);
      $array = array(':difiSimuNiti'=>$evalClase->dificulSimuNitido,
      ':apoSimuNiti'=>$evalClase->apoyoSimuNitido,
      ':CalMatApoNiti'=>$evalClase->CalMatApoNitido,
      ':ClarMatApoNiti'=>$evalClase->ClarMatApoNitido,
      ':CantMatApoNiti'=>$evalClase->CantMatApoNitido,
      ':CalContNiti'=>$evalClase->CalContNitido,
      ':ClarContNiti'=>$evalClase->ClarContNitido,
      ':CantContNiti'=>$evalClase->CantContNitido,
      ':nivelAprendiNiti'=>$evalClase->nivelAprendizajeNitido,
      ':califClaseNiti'=>$evalClase->CalificacionClaseNitidaFinal,
      ':califClaseDifu'=>$evalClase->calificacionClaseDifuso,
      ':difiSimuDifu'=>$evalClase->dificulSimuDifuso,
      ':apoSimuDifu'=>$evalClase->apoyoSimuDifuso,
      ':CalMatApoDifu'=>$evalClase->CalMatApoDifuso,
      ':ClarMatApoDifu'=>$evalClase->ClarMatApoDifuso,
      ':CantMatApoDifu'=>$evalClase->CantMatApoDifuso,
      ':CalContDifu'=>$evalClase->ClarMatApoDifuso,
      ':ClarContDifu'=>$evalClase->ClarContDifuso,
      ':CantContDifu'=>$evalClase->CantContDifuso,
      ':nivelAprendiDifu'=>$evalClase->nivelAprendizajeDifuso,
      ':practIdPract'=>$idPractica,
      ':AlumCodAlum'=>$codigoAlumno,
      ':califi' => 100,
      ':idEvalDifusa' => $evaluacionDifusa->idEvaluacionDifusa);
      $resultado->execute($array);
    }else{
      $sql = 'INSERT INTO evaluaciondifusa
      (dificulSimuNitido, apoyoSimuNitido, CalMatApoNitido, ClarMatApoNitido,
        CantMatApoNitido, CalContNitido, ClarContNitido, CantContNitido,
        nivelAprendizajeNitido, calificacionClaseNitido, calificacionClaseDifuso,
        dificulSimuDifuso, apoyoSimuDifuso, CalMatApoDifuso,ClarMatApoDifuso,
        CantMatApoDifuso, CalContDifuso, ClarContDifuso, CantContDifuso,
        nivelAprendizajeDifuso, Practica_idPractica, AlumnoUsuario_codigoAlumno,
        calificacion) VALUES
        (:difiSimuNiti, :apoSimuNiti, :CalMatApoNiti, :ClarMatApoNiti,
          :CantMatApoNiti, :CalContNiti, :ClarContNiti, :CantContNiti,
          :nivelAprendiNiti, :califClaseNiti, :califClaseDifu, :difiSimuDifu,
          :apoSimuDifu, :CalMatApoDifu, :ClarMatApoDifu, :CantMatApoDifu,
          :CalContDifu, :ClarContDifu, :CantContDifu, :nivelAprendiDifu,
          :practIdPract, :AlumCodAlum, :califi)';
          $resultado = $baseDatos->prepare($sql);
          $array = array(':difiSimuNiti'=>$evalClase->dificulSimuNitido,
          ':apoSimuNiti'=>$evalClase->apoyoSimuNitido,
          ':CalMatApoNiti'=>$evalClase->CalMatApoNitido,
          ':ClarMatApoNiti'=>$evalClase->ClarMatApoNitido,
          ':CantMatApoNiti'=>$evalClase->CantMatApoNitido,
          ':CalContNiti'=>$evalClase->CalContNitido,
          ':ClarContNiti'=>$evalClase->ClarContNitido,
          ':CantContNiti'=>$evalClase->CantContNitido,
          ':nivelAprendiNiti'=>$evalClase->nivelAprendizajeNitido,
          ':califClaseNiti'=>$evalClase->CalificacionClaseNitidaFinal,
          ':califClaseDifu'=>$evalClase->calificacionClaseDifuso,
          ':difiSimuDifu'=>$evalClase->dificulSimuDifuso,
          ':apoSimuDifu'=>$evalClase->apoyoSimuDifuso,
          ':CalMatApoDifu'=>$evalClase->CalMatApoDifuso,
          ':ClarMatApoDifu'=>$evalClase->ClarMatApoDifuso,
          ':CantMatApoDifu'=>$evalClase->CantMatApoDifuso,
          ':CalContDifu'=>$evalClase->ClarMatApoDifuso,
          ':ClarContDifu'=>$evalClase->ClarContDifuso,
          ':CantContDifu'=>$evalClase->CantContDifuso,
          ':nivelAprendiDifu'=>$evalClase->nivelAprendizajeDifuso,
          ':practIdPract'=>$idPractica,
          ':AlumCodAlum'=>$codigoAlumno,
          ':califi' => 100);
          $resultado->execute($array);

          //Insertar evaluación dentro de los cuestionarios contestados
          $mensajeEvalaucion = 'Evaluación difusa';
          $fechaReciente = date('Y-m-d H:i:s');
          $rutaArchivoEvaluacion = '../../images/files/XXXX67890.jpg';
          $nombreClaveEvaluacion = 'XXXX67890.jpg';
          $nombreOriginalEvaluacion = 'evaluacion_difusa_clase.jpg';
          $sql = 'INSERT INTO cuestionario (respuestaPregunta1,
            respuestaPregunta2, respuestaPregunta3, conclusion, fechaEntrega,
            rutaArchivo, Practica_idPractica, AlumnoUsuario_codigoAlumno,
            nombreClave, nombreOriginal) VALUES (:rp1, :rp2, :rp3, :c, :fe,
              :ra, :pip, :auca, :nc, :no)';

              $resultado = $baseDatos->prepare($sql);
              $array = array(':rp1'=>$mensajeEvalaucion,
              ':rp2'=>$mensajeEvalaucion,
              ':rp3'=>$mensajeEvalaucion,
              ':c'=>$mensajeEvalaucion,
              ':fe'=>$fechaReciente,
              ':ra'=>$rutaArchivoEvaluacion,
              ':pip'=>$idPractica,
              ':auca'=>$codigoAlumno,
              ':nc'=>$nombreClaveEvaluacion,
              ':no'=>$nombreOriginalEvaluacion);
              $resultado->execute($array);

              // Luego consulto el cuestionario que agregué
              $sql = 'SELECT * FROM cuestionario WHERE
              Practica_idPractica = :pip AND
              AlumnoUsuario_codigoAlumno = :auca
              ORDER BY fechaEntrega ASC LIMIT 1';

              $resultado = $baseDatos->prepare($sql);
              $array = array(':pip'=>$idPractica, ':auca'=>$codigoAlumno);
              $resultado->execute($array);
              $numRowNoEntrego = $resultado->rowCount();

              if($numRowNoEntrego != 0) {
                //Calificar evaluaciónd difusa contestada
                $cuestionarioDifuso = $resultado->fetch(PDO::FETCH_OBJ);
                $sql = 'INSERT INTO evaluacion
                (califiacion, Cuestionario_idCuestionario)
                VALUES (:c, :cicu)';

                $resultado = $baseDatos->prepare($sql);
                $array = array(':c'=>100, ':cicu'=>$cuestionarioDifuso->idCuestionario);
                $resultado->execute($array);
              }

            }
            echo 'success';
          }else{
            echo 'Error. Algo salio mal. El proceso de fuzzificación fallo.';
          }
        } catch(Exception $exec) {
          die('Error en la base de datos: ' . $exec->getMessage());
        }
        ?>
