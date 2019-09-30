<?php
include('../operaciones/conexion.php');
include('Evaluacion-clase-fuzzy.php');

try {
  $evalClase = new SistemaFuzzyEvalucionClase();
  $ColorFondo = "success";
  $ColorTexto = "white";
  $resultadoNitido = "";
  $resultadoDifuso = "";

  $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));
  $tipoDatosDifuso = htmlentities(addslashes($_POST['tipoDatosDifuso']));

  $sql = "SELECT * FROM practica WHERE
  Clase_claveAcceso = :claveAcceso
  AND nombre = :nom";

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->bindValue(':nom', "Evaluación difusa de la clase");
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow==1){
    $practica = $resultado->fetch(PDO::FETCH_OBJ);
    $data = $baseDatos->query("SELECT
      AVG(dificulSimuNitido) as promedioDificulSimuNitido,
      AVG(apoyoSimuNitido) as promedioApoyoSimuNitido,
      AVG(CalMatApoNitido) as promedioCalMatApoNitido,
      AVG(ClarMatApoNitido) as promedioClarMatApoNitido,
      AVG(CantMatApoNitido) as promedioCantMatApoNitido,
      AVG(CalContNitido) as promedioCalContNitido,
      AVG(ClarContNitido) as promedioClarContNitido,
      AVG(CantContNitido) as promedioCantContNitido,
      AVG(nivelAprendizajeNitido) as promedioNivelAprendizajeNitido,
      AVG(calificacionClaseNitido) as promedioCalificacionClaseNitido
      FROM evaluaciondifusa
      WHERE evaluaciondifusa.Practica_idPractica = $practica->idPractica
      AND evaluaciondifusa.dificulSimuDifuso != 'no_contestado'")->fetchAll();
      foreach ($data as $row) {
        $promedioDificulSimuNitido = $row["promedioDificulSimuNitido"];
        $apoyoSimuNitido = $row["promedioApoyoSimuNitido"];
        $promedioCalMatApoNitido = $row["promedioCalMatApoNitido"];
        $promedioClarMatApoNitido = $row["promedioClarMatApoNitido"];
        $promedioCantMatApoNitido = $row["promedioCantMatApoNitido"];
        $promedioCalContNitido = $row["promedioCalContNitido"];
        $promedioClarContNitido = $row["promedioClarContNitido"];
        $promedioCantContNitido = $row["promedioCantContNitido"];
        $promedioNivelAprendizajeNitido = $row["promedioNivelAprendizajeNitido"];
        $promedioCalificacionClaseNitido = $row["promedioCalificacionClaseNitido"];
        $evalClase->inferir($promedioDificulSimuNitido, $apoyoSimuNitido,
        $promedioCalMatApoNitido, $promedioClarMatApoNitido,
        $promedioCantMatApoNitido, $promedioCalContNitido, $promedioClarContNitido,
        $promedioCantContNitido, $promedioNivelAprendizajeNitido, false);
      }

      if($tipoDatosDifuso == "dificulSimuDifuso"){
        $resultadoDifuso = $evalClase->dificulSimuDifuso;
        $resultadoNitido = $evalClase->dificulSimuNitido;
      }else if($tipoDatosDifuso == "apoyoSimuDifuso"){
        $resultadoDifuso = $evalClase->apoyoSimuDifuso;
        $resultadoNitido = $evalClase->apoyoSimuNitido;
      }else if($tipoDatosDifuso == "CalMatApoDifuso"){
        $resultadoDifuso = $evalClase->CalMatApoDifuso;
        $resultadoNitido = $evalClase->CalMatApoNitido;
      }else if($tipoDatosDifuso == "ClarMatApoDifuso"){
        $resultadoDifuso = $evalClase->ClarMatApoDifuso;
        $resultadoNitido = $evalClase->ClarMatApoNitido;
      }else if($tipoDatosDifuso == "CantMatApoDifuso"){
        $resultadoDifuso = $evalClase->CantMatApoDifuso;
        $resultadoNitido = $evalClase->CantMatApoNitido;
      }else if($tipoDatosDifuso == "CalContDifuso"){
        $resultadoDifuso = $evalClase->CalContDifuso;
        $resultadoNitido = $evalClase->CalContNitido;
      }else if($tipoDatosDifuso == "ClarContDifuso"){
        $resultadoDifuso = $evalClase->ClarContDifuso;
        $resultadoNitido = $evalClase->ClarContNitido;
      }else if($tipoDatosDifuso == "CantContDifuso"){
        $resultadoDifuso = $evalClase->CantContDifuso;
        $resultadoNitido = $evalClase->CantContNitido;
      }else if($tipoDatosDifuso == "nivelAprendizajeDifuso"){
        $resultadoDifuso = $evalClase->nivelAprendizajeDifuso;
        $resultadoNitido = $evalClase->nivelAprendizajeNitido;
      }else if($tipoDatosDifuso == "calificacionClaseDifuso"){
        $resultadoDifuso = $evalClase->calificacionClaseDifuso;
        $resultadoNitido = $evalClase->CalificacionClaseNitidaFinal;
      }

      $resultadoNitido = round($resultadoNitido, 2);
      if($resultadoNitido >= 0 && $resultadoNitido <= 20){
        $ColorFondo = "dark";
      }else if($resultadoNitido >= 21 && $resultadoNitido <= 40){
        $ColorFondo = "danger";
      }else if($resultadoNitido >= 41 && $resultadoNitido <= 60){
        $ColorFondo = "warning";
      }else if($resultadoNitido >= 61 && $resultadoNitido <= 80){
        $ColorFondo = "primary";
      }else if($resultadoNitido >= 80 && $resultadoNitido <= 100){
        $ColorFondo = "success";
      }
      if($tipoDatosDifuso == "calificacionClaseDifuso"){
        $ColorFondo = "white";
        $ColorTexto = "black";
        //$resultadoNitido = "";
      }
      echo "<li type=\"button\" class=\"list-group-item d-flex
      justify-content-between align-items-center p-3 mb-2 bg-$ColorFondo
      text-$ColorTexto\"><h5>$resultadoDifuso - ($resultadoNitido)</h5></li>";
    }
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
