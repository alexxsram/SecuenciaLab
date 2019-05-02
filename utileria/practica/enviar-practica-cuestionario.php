<?php
include('../operaciones/conexion.php');

try {
  $respuestaPregunta1 = htmlentities(addslashes($_POST['respuestaPregunta1']));
  $respuestaPregunta2 = htmlentities(addslashes($_POST['respuestaPregunta2']));
  $respuestaPregunta3 = htmlentities(addslashes($_POST['respuestaPregunta3']));
  $conclusion = htmlentities(addslashes($_POST['conclusion']));
  $fechaFinalizacion = date('Y-m-d');

  $nombreArchivo = $_FILES['nombreArchivo']['name']; // nombre del archivo
  $tmpArchivo = $_FILES['nombreArchivo']['tmp_name']; // nombre del temporal del archivo
  $tamanoArchivo = $_FILES['nombreArchivo']['size']; // tamaño del archivo
  
  $idPractica = htmlentities(addslashes($_POST['idPractica']));  
  $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));

  //Convertir elementos de texto en codificación UTF-8
  $respuestaPregunta1 = html_entity_decode($respuestaPregunta1, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $respuestaPregunta2 = html_entity_decode($respuestaPregunta2, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $respuestaPregunta3 = html_entity_decode($respuestaPregunta3, ENT_QUOTES | ENT_HTML401, "UTF-8");
  $conclusion = html_entity_decode($conclusion, ENT_QUOTES | ENT_HTML401, "UTF-8");

  $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':ca', $codigoAlumno);
  $resultado->execute();

  $numRow = $resultado->rowCount();

  if($numRow == 0) {
    echo 'Error. No se pudo encontrar al alumno, no es posible subir la práctica.';
  } else {
    $alumno = $resultado->fetch(PDO::FETCH_OBJ);
    $nombreAlumno = $alumno->apellidoPaterno . '-' . $alumno->apellidoMaterno . '-' . $alumno->nombrePila;

    $directorio = '../../images/files/';
    $directorio = $directorio . $nombreAlumno . "/";
    
    if(!file_exists($directorio)) {
      mkdir($directorio, 0777, true);
    }

    $target_file = $directorio . basename($nombreArchivo);
    
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    //if(isset($_POST["submit"])) {
    $check = getimagesize($tmpArchivo);
    if($check !== false) {
      //echo "El archivo es una imagen - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "El archivo no es una imagen.";
      $uploadOk = 0;
    }

    //}
    // Check if file already exists
    /*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }*/
  $tamanoMegas = 10;

  // Comprobar el tamaño de la imagen
  if($tamanoArchivo > ($tamanoMegas * 1000000)) {
    echo "Error. El tamaño de la imagen es muy grande. El tamaño máximo permitido es de: " . $tamanoMegas . " Mb.";
    echo "Su archivo pesa: " . $tamanoArchivo / 1000000 . " Mb.";
    $uploadOk = 0;
  }

  // Comrpobar formato de los archivos
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
    echo "Error. Solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if($uploadOk == 0) {
    echo "Error. Tu archivo no fue subido correctamente.";
    // if everything is ok, try to upload file
  } else {
    if(move_uploaded_file($tmpArchivo, $target_file)) {
      //echo "El archivo ". basename( $_FILES["nombreArchivo"]["name"]). " ha sido correctamente subido.";
      // echo "success";
    } else {
      echo "Error. Hubo un error subiendo el archivo.";
    }
  }

  // $sql = 'INSERT INTO cuestionario (respuestaPregunta1, respuestaPregunta2, respuestaPregunta3, conclusion, fechaFinalizacion, rutaArchivo, Practica_idPractica, AlumnoUsuario_codigoAlumno) VALUES (:rp1, :rp2, :rp3, :c, :ff, :ra, :pip, :auca)';
  // $resultado = $baseDatos->prepare($sql);
  // $array = array(':rp1'=>$respuestaPregunta1, ':rp2'=>$respuestaPregunta2, ':rp3'=>$respuestaPregunta3, ':c'=>$conclusion, ':ff'=>$fechaFinalizacion, ':ra'=>$directorio, ':pip'=>$idPractica, ':auca'=>$codigoAlumno);
  // $resultado->execute($array);
  // echo 'success';
  //$nombreArchivo = str_replace( "\\", '/', $nombreArchivo );
  //echo $nombreArchivo . "  " . $directorio;
}
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}

?>
