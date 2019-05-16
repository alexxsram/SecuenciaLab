<?php
include('../operaciones/conexion.php');

$calificacion = htmlentities(addslashes($_POST['calificacion']));
$idCuestionario = htmlentities(addslashes($_POST['idCuestionario']));

try {
  $sql = "SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario = :Cuestionario_idCuestionario";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':Cuestionario_idCuestionario', $idCuestionario);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow == 0){
    $sql = 'INSERT INTO evaluacion (califiacion, Cuestionario_idCuestionario) VALUES (:c, :cic)';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':c'=>$calificacion, ':cic'=>$idCuestionario);
    $resultado->execute($array);
    echo 'success';
  }else{
    $evaluacionPrevia = $resultado->fetch(PDO::FETCH_OBJ);
    $sql = "UPDATE evaluacion SET califiacion = :cal WHERE idEvaluacion = :idEval";
    $resultado = $baseDatos->prepare($sql);
    $array = array(':cal'=>$calificacion, ':idEval'=>$evaluacionPrevia->idEvaluacion);
    $resultado->execute($array);
    echo 'success';
  }

  /*$sql = "SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario = :Cuestionario_idCuestionario";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':Cuestionario_idCuestionario', $idCuestionario);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow == 0){
  $sql = 'INSERT INTO evaluacion (califiacion, Cuestionario_idCuestionario) VALUES (:c, :cic)';
  $resultado = $baseDatos->prepare($sql);
  $array = array(':c'=>$calificacion, ':cic'=>$idCuestionario);
  $resultado->execute($array);
  echo 'success';
}else{
$evaluacionPrevia = $resultado->fetch(PDO::FETCH_OBJ);
$sql = "UPDATE evaluacion SET califiacion = :cal WHERE idEvaluacion = :idEval";
$resultado = $baseDatos->prepare($sql);
$array = array(':cal'=>$calificacion, ':idEval'=>$evaluacionPrevia->idEvaluacion);
$resultado->execute($array);
echo 'success';
}*/
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
