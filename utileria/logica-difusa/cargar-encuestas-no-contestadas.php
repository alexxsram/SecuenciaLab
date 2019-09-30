<?php
include('../operaciones/conexion.php');
include('Evaluacion-clase-fuzzy.php');

try {

  $claveAcceso = htmlentities(addslashes($_POST['claveAcceso']));
  $tipoDatosDifuso = htmlentities(addslashes($_POST['tipoDatosDifuso']));
  $listaAlumnos = "";
  $sql = "SELECT * FROM practica
  WHERE Clase_claveAcceso = :claveAcceso AND nombre = :nom";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->bindValue(':nom', "Evaluación difusa de la clase");
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow==1){
    //$listaAlumnos .= "entro a uno";
    $practica = $resultado->fetch(PDO::FETCH_OBJ);
    //$data = $baseDatos->query("SELECT * FROM evaluaciondifusa WHERE evaluaciondifusa.Practica_idPractica = $practica->idPractica AND evaluaciondifusa.dificulSimuDifuso = 'no_contestado'")->fetchAll();
    $data = $baseDatos->query("SELECT EV.*, CU.*
      FROM cuestionario CU INNER JOIN evaluacion EV
      ON EV.Cuestionario_idCuestionario = CU.idCuestionario
      WHERE CU.Practica_idPractica = $practica->idPractica
      AND EV.califiacion = 0")->fetchAll();

      foreach ($data as $row) {
        $codigoAlumno = $row['AlumnoUsuario_codigoAlumno'];
        $sql = "SELECT *
        FROM alumnousuario
        WHERE alumnousuario.codigoAlumno = :codAlu";

        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codAlu', $codigoAlumno);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow==1){
          $alumno = $resultado->fetch(PDO::FETCH_OBJ);
          $listaAlumnos .= "<li type=\"button\"
          class=\"list-group-item d-flex
          justify-content-between
          align-items-center\">
          {$alumno->apellidoPaterno} {$alumno->apellidoMaterno}
          {$alumno->nombrePila} - {$alumno->codigoAlumno}</li>";
        }
      }
    }else{
      $listaAlumnos = "nO ENCONTRO PRÁCTICA";
    }
    echo $listaAlumnos;
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
