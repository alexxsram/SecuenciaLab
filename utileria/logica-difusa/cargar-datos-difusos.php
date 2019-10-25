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
      //Recomendación general
      if($tipoDatosDifuso == "calificacionClaseDifuso"){
        if($resultadoDifuso == "Deficiente"){
          $resultadoDifuso = $resultadoDifuso . " - Su desempeño fue muy deficiente, se le recomienda mejorar en cuanto a la calidad y claridad de la clase y del material de apoyo. Además, de utilizar una mayor cantidad de ejemplos y material de apoyo.";
        }else if($resultadoDifuso == "Insuficiente"){
          $resultadoDifuso = $resultadoDifuso . " - Su desempeño fue deficiente, se le recomienda mejorar en cuanto a la calidad y claridad de la clase y del material de apoyo.";
        }else if($resultadoDifuso == "Promedio"){
          $resultadoDifuso = $resultadoDifuso . " - Su desempeño fue suficiente, podría mejorar sus clases aumentando la calidad de su contenido y aplicando el conocimiento visto en clase en casos prácticas.";
        }else if($resultadoDifuso == "Buena"){
          $resultadoDifuso = $resultadoDifuso . " - Su desempeño bueno, sus clases tienen un gran nivel. Siga con el buen trabajo y procure mejorar en la medida de los posible sus aspectos más deficientes.";
        }else if($resultadoDifuso == "Excelente"){
          $resultadoDifuso = $resultadoDifuso . " - Su desempeño excelente, sus clases tienen un gran nivel. Siga con el buen trabajo y gracias por ser un gran profesor.";
        }
      }
      //Recomendación especifica
      $peorAspectoNumero = $evalClase->dificulSimuNitido;;
      $mayorAspectoNumero = $evalClase->dificulSimuNitido;;
      $peorAspectoNombre = 'Dificultad utilización del simulador';
      $mayorAspectoNombre = 'Dificultad utilización del simulador';
      $recomendacion = "Para mejorar la utilización del simulador se recomienda
      al profesor que haga que sus alumno practique más con el software para
      poder saber cómo utilizarlo y conocer los comando para facilitar su
      utilización. También se recomiendo que se consulte el manual de usuario
      disponible con el software, para consultar sus trucos y modos de
      utilización. ";
      if($tipoDatosDifuso == "calificacionClaseDifuso"){
        $ColorFondo = "white";
        $ColorTexto = "black";
        //$resultadoNitido = "";
        //Buscar el minimo
        if($peorAspectoNumero>$evalClase->dificulSimuNitido){
          $peorAspectoNumero = $evalClase->dificulSimuNitido;
          $peorAspectoNombre = 'Dificultad utilización del simulador';
          $recomendacion = "Para mejorar la utilización del simulador se recomienda
          al profesor que haga que sus alumno practique más con el software para
          poder saber cómo utilizarlo y conocer los comando para facilitar su
          utilización. También se recomiendo que se consulte el manual de usuario
          disponible con el software, para consultar sus trucos y modos de
          utilización. ";
        }
        if($peorAspectoNumero>$evalClase->apoyoSimuNitido){
          $peorAspectoNumero = $evalClase->apoyoSimuNitido;
          $peorAspectoNombre = 'Apoyo del simulador';
          $recomendacion = "Para mejorar el apoyo del simulador se recomienda al
          profesor que haga que sus alumno practique más con el software para
          poder saber cómo utilizarlo y conocer los comando para facilitar su
          utilización. También se recomiendo que se consulte el manual de usuario
          disponible con el software, para consultar sus trucos y modos de utilización.
          Adicionalmente, es favorable que el profesor dedique alguna clase a
          explicar el funcionamiento del software al alumnado y muestre algunos
          ejemplos prácticos.";
        }
        if($peorAspectoNumero>$evalClase->CalMatApoNitido){
          $peorAspectoNumero = $evalClase->CalMatApoNitido;
          $peorAspectoNombre = 'Calidad del material de apoyo';
          $recomendacion = "Para mejorar la calidad del material de apoyo se
          recomienda que el profesor prepare de  antemano los recursos que planea
          utilizar en sus clases y que los suba a un repositorio para fácil consulta.";
        }
        if($peorAspectoNumero>$evalClase->ClarMatApoNitido){
          $peorAspectoNumero = $evalClase->ClarMatApoNitido;
          $peorAspectoNombre = 'Claridad del material de apoyo';
          $recomendacion = "Para mejorar la claridad del material de apoyo se
          recomienda que el profesor realice un resumen o algún instrumento de
          síntesis de ideas, para extraer los puntos más relevantes de un tema
          y poder comunicárselo al alumnado. Adicionalmente, sería recomendable
          poner a disposición de los alumnos presentaciones con documentos,
          explicaciones y ejemplos de los temas vistos en clase.";
        }
        if($peorAspectoNumero>$evalClase->CantMatApoNitido){
          $peorAspectoNumero = $evalClase->CantMatApoNitido;
          $peorAspectoNombre = 'Cantidad del material de apoyo';
          $recomendacion = "Para mejorar la cantidad del material de apoyo se
          recomienda que el profesor utilice las bibliografías recomendadas para
          la materia y que adicionalmente busque y ponga a disposición de los
          alumnos mayor cantidad de material de apoyo ya sea físico o digital.";
        }
        if($peorAspectoNumero>$evalClase->CalContNitido){
          $peorAspectoNumero = $evalClase->CalContNitido;
          $peorAspectoNombre = 'Calidad del contenido';
          $recomendacion = "Para mejorar la calidad del contenido se recomienda
          que el profesor practique más sus ponencias, para realizar una mejor
          estructura de la información. Adicionalmente, sería recomendable
          poner a disposición de los alumnos presentaciones con documentos,
          explicaciones y ejemplos de los temas vistos en clase.";
        }
        if($peorAspectoNumero>$evalClase->ClarContNitido){
          $peorAspectoNumero = $evalClase->ClarContNitido;
          $peorAspectoNombre = 'Claridad del contenido';
          $recomendacion = "Para mejorar la claridad del contenido se recomienda
          que el profesor realice un resumen o algún instrumento de síntesis
          de ideas, para extraer los puntos más relevantes de un tema y poder
          comunicárselo al alumnado. Adicionalmente, sería recomendable poner
          a disposición de los alumnos presentaciones con documentos,
          explicaciones y ejemplos de los temas vistos en clase. Asimismo,
          sería recomendable evaluar una reorganización de los temas de la
          materia, para estructurarlos de una mejor manera.";
        }
        if($peorAspectoNumero>$evalClase->CantContNitido){
          $peorAspectoNumero = $evalClase->CantContNitido;
          $peorAspectoNombre = 'Cantidad del contenido';
          $recomendacion = "Para mejorar la cantidad contenido se recomienda que
          el profesor organice mejor el tiempo de la clase, para poder maximizar
          la cantidad de ejemplos y prácticas de cada tema de la materia.";
        }
        if($peorAspectoNumero>$evalClase->nivelAprendizajeNitido){
          $peorAspectoNumero = $evalClase->nivelAprendizajeNitido;
          $peorAspectoNombre = 'Nivel de aprendizaje percibido por el alumno';
          $recomendacion = "Para mejorar el nivel de aprendizaje del alumno es
          recomendable que el profesor realice un resumen o algún instrumento de
          síntesis de ideas, para extraer los puntos más relevantes de un tema
          y poder comunicárselo al alumnado. Adicionalmente, sería recomendable
          poner a disposición de los alumnos presentaciones con documentos,
          explicaciones y ejemplos de los temas vistos en clase. Asimismo,
          sería recomendable evaluar una reorganización de los temas de la
          materia, para estructurarlos de una mejor manera.";
        }
        //Buscar el maximo
        if($mayorAspectoNumero<$evalClase->dificulSimuNitido){
          $mayorAspectoNumero = $evalClase->dificulSimuNitido;
          $mayorAspectoNombre = 'Dificultad utilización del simulador';
        }
        if($mayorAspectoNumero<$evalClase->apoyoSimuNitido){
          $mayorAspectoNumero = $evalClase->apoyoSimuNitido;
          $mayorAspectoNombre = 'Apoyo del simulador';
        }
        if($mayorAspectoNumero<$evalClase->CalMatApoNitido){
          $mayorAspectoNumero = $evalClase->CalMatApoNitido;
          $mayorAspectoNombre = 'Calidad del material de apoyo';
        }
        if($mayorAspectoNumero<$evalClase->ClarMatApoNitido){
          $mayorAspectoNumero = $evalClase->ClarMatApoNitido;
          $mayorAspectoNombre = 'Claridad del material de apoyo';
        }
        if($mayorAspectoNumero<$evalClase->CantMatApoNitido){
          $mayorAspectoNumero = $evalClase->CantMatApoNitido;
          $mayorAspectoNombre = 'Cantidad del material de apoyo';
        }
        if($mayorAspectoNumero<$evalClase->CalContNitido){
          $mayorAspectoNumero = $evalClase->CalContNitido;
          $mayorAspectoNombre = 'Calidad del contenido';
        }
        if($mayorAspectoNumero<$evalClase->ClarContNitido){
          $mayorAspectoNumero = $evalClase->ClarContNitido;
          $mayorAspectoNombre = 'Claridad del contenido';
        }
        if($mayorAspectoNumero<$evalClase->CantContNitido){
          $mayorAspectoNumero = $evalClase->CantContNitido;
          $mayorAspectoNombre = 'Cantidad del contenido';
        }
        if($mayorAspectoNumero<$evalClase->nivelAprendizajeNitido){
          $mayorAspectoNumero = $evalClase->nivelAprendizajeNitido;
          $mayorAspectoNombre = 'Nivel de aprendizaje percibido por el alumno';
        }
        $resultadoDifuso = $resultadoDifuso . " Su aspectomenos favorable fue:
          {$peorAspectoNombre}. Su mejor aspecto fue: {$mayorAspectoNombre}.
          Para mejorar su clase se le recomienda: {$recomendacion}";
      }
      //Resultado difuso con resultado nitido
      /*echo "<li type=\"button\" class=\"list-group-item d-flex
      justify-content-between align-items-center p-3 mb-2 bg-$ColorFondo
      text-$ColorTexto\"><h5>$resultadoDifuso - ($resultadoNitido)</h5></li>";*/
      //Resultado solo difuso
      echo "<li type=\"button\" class=\"list-group-item d-flex
      justify-content-between align-items-center p-3 mb-2 bg-$ColorFondo
      text-$ColorTexto\"><h5>$resultadoDifuso</h5></li>";
    }
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
