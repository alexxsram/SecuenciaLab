<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  $idPractica = $_POST['idPractica'];
  $nombrePractica = $_POST['nombrePractica'];
  $codigoAlumno = $_POST['codigoAlumno'];//Para confirmación

  $sql = "SELECT * FROM practica WHERE idPractica = :idPractica";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':idPractica', $idPractica);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $practica = $resultado->fetch(PDO::FETCH_OBJ);
    echo "<p class=\"card-text\" id=\"info-alumno-descripcion-practica\" name=\"info-alumno-descripcion-practica\"><b>Descripción:</b> $practica->descripcion</p>";
  }else{
    echo "<p class=\"card-text\" id=\"info-alumno-descripcion-practica\" name=\"info-alumno-descripcion-practica\"><b>Descripción:</b> Error. El id de la práctica es invalido.</p>";
  }
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
