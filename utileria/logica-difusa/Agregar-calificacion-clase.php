<?php
include('../operaciones/conexion.php');
include('Evaluacion-clase-fuzzy.php');

try {
  /*$evalClase = new SistemaFuzzyEvalucionClase();
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
  $evalCalidadCont,$evalClaridadCont,$evalCantidadCont,$evalAprendizaje);*/
  $evalClase->inferir(100,100,100,100,100,100,100,100,100);

  echo "dificulSimuNitido: $evalClase->dificulSimuNitido<br/>";
  echo "apoyoSimuNitido: $evalClase->apoyoSimuNitido<br/>";
  echo "CalMatApoNitido: $evalClase->CalMatApoNitido<br/>";
  echo "ClarMatApoNitido: $evalClase->ClarMatApoNitido<br/>";
  echo "CantMatApoNitido: $evalClase->CantMatApoNitido<br/>";
  echo "CalContNitido: $evalClase->CalContNitido<br/>";
  echo "ClarContNitido: $evalClase->ClarContNitido<br/>";
  echo "CantContNitido: $evalClase->CantContNitido<br/>";
  echo "nivelAprendizajeNitido: $evalClase->nivelAprendizajeNitido<br/>";
  echo "dificulSimuDifuso: $evalClase->dificulSimuDifuso<br/>";
  echo "apoyoSimuDifuso: $evalClase->apoyoSimuDifuso<br/>";
  echo "CalMatApoDifuso: $evalClase->CalMatApoDifuso<br/>";
  echo "ClarMatApoDifuso: $evalClase->ClarMatApoDifuso<br/>";
  echo "CantMatApoDifuso: $evalClase->CantMatApoDifuso<br/>";
  echo "CalContDifuso: $evalClase->CalContDifuso<br/>";
  echo "ClarContDifuso: $evalClase->ClarContDifuso<br/>";
  echo "CantContDifuso: $evalClase->CantContDifuso<br/>";
  echo "nivelAprendizajeDifuso: $evalClase->nivelAprendizajeDifuso<br/>";
  echo "interSimuladorDifuso: $evalClase->interSimuladorDifuso<br/>";
  echo "interMaterialApoyoDifuso: $evalClase->interMaterialApoyoDifuso<br/>";
  echo "interContenidoClaseDifuso: $evalClase->interContenidoClaseDifuso<br/>";
  echo "interCalidadClaseDifuso: $evalClase->interCalidadClaseDifuso<br/>";
  echo "calificacionClaseDifuso: $evalClase->calificacionClaseDifuso<br/>";
  echo "interSimuladorNitido: $evalClase->interSimuladorNitido<br/>";
  echo "interMatApoNitido: $evalClase->interMatApoNitido<br/>";
  echo "interContNitido: $evalClase->interContNitido<br/>";
  echo "interCaliClaseNitido: $evalClase->interCaliClaseNitido<br/>";
  echo "CalidadClaseNitido: $evalClase->CalidadClaseNitido<br/>";
  echo "CalificacionClaseNitidaFinal: $evalClase->CalificacionClaseNitidaFinal<br/>";
  echo("<script>console.log('PHP: ".$evalClase->CalificacionClaseNitidaFinal."');</script>");
  if($evalClase->calificacionClaseDifuso != "Error"){
    $sql = 'INSERT INTO difuso (calificacionDifuso, CalificacionNitido) VALUES (:calDifu, :calNiti)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':calDifu'=>$evalClase->calificacionClaseDifuso, ':calNiti'=>$evalClase->CalificacionClaseNitidaFinal);
    $resultado->execute($array);
    echo 'success';
  }else{
    echo 'Error. Algo salio mal. El proceso de fuzzificación fallo.';
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
