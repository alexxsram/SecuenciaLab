<?php
include('../../operaciones/conexion.php');

try {
  $codigoAlumno = $_POST['codigoAlumno'];
  $idPractica = $_POST['idPractica'];
  $claveDeAcceso = $_POST['claveAcceso'];
  //Estraer datos de una clase
  $sql = "SELECT *
  FROM evaluaciondifusa
  WHERE Practica_idPractica = :idPrac
  AND AlumnoUsuario_codigoAlumno = :codAlum";
  
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':idPrac', $idPractica);
  $resultado->bindValue(':codAlum', $codigoAlumno);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $evaluacionDifusa = $resultado->fetch(PDO::FETCH_OBJ);
    echo "{\"dificulSimuNitido\": \"$evaluacionDifusa->dificulSimuNitido\",
      \"apoyoSimuNitido\": \"$evaluacionDifusa->apoyoSimuNitido\",
      \"CalMatApoNitido\": \"$evaluacionDifusa->CalMatApoNitido\",
      \"ClarMatApoNitido\": \"$evaluacionDifusa->ClarMatApoNitido\",
      \"CantMatApoNitido\": \"$evaluacionDifusa->CantMatApoNitido\",
      \"CalContNitido\": \"$evaluacionDifusa->CalContNitido\",
      \"ClarContNitido\": \"$evaluacionDifusa->ClarContNitido\",
      \"CantContNitido\": \"$evaluacionDifusa->CantContNitido\",
      \"nivelAprendizajeNitido\": \"$evaluacionDifusa->nivelAprendizajeNitido\"}";
    }else{
      //echo "No hay cuestionario anterior: " . $numRow;
      echo "";
      /*echo "{\"dificulSimuNitido\": \"sql_error\",
      \"apoyoSimuNitido\": \"sql_error\",
      \"CalMatApoNitido\": \"sql_error\",
      \"ClarMatApoNitido\": \"sql_error\",
      \"CantMatApoNitido\": \"sql_error\",
      \"CalContNitido\": \"sql_error\",
      \"ClarContNitido\": \"sql_error\",
      \"CantContNitido\": \"sql_error\",
      \"nivelAprendizajeNitido\": \"sql_error\"}";*/
    }
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
