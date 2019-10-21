<?php
session_start();
if(!isset($_SESSION['codigo']) && $_SESSION['permiso'] == '') {
  header('Location: ../sesion/sesion.php');
}

include('../../utileria/operaciones/conexion.php');

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);
$codigoAlumno = base64_decode($_GET['codigoAlumno']);

try {
  // Include the main TCPDF library (search for installation path).
  require_once('tcpdf_include.php');

  // datos de la cabecera
  class MYPDF extends TCPDF {
    //Page header
    public function Header() {
      // Logo
      // $image_file = K_PATH_IMAGES . 'logo_example.jpg';
      // $this->Image($image_file, 10, 7, 17, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
      $headerData = $this->getHeaderData();

      // Set font
      $this->SetFont('helvetica', 'B', 20);

      // Title
      // $this->Cell(0, 100, 'Reporte de practicas por alumno', 0, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->writeHTML($headerData['string']);
    }

    // Page footer
    public function Footer() {
      // Position at 15 mm from bottom
      $this->SetY(-15);
      // Set font
      $this->SetFont('helvetica', 'I', 8);
      // Page number
      $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' .
      $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
  }

  // crea el nuevo documento PDF
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Castillo Serrano & Alex Salgado & Neri');
  $pdf->SetTitle('Reporte de práctica');
  $pdf->SetSubject('Reporte de práctica');
  $pdf->SetKeywords('Reporte de práctica, PDF, example, estudiante, profesor');

  // set default header data
  // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
  $pdf->SetHeaderData($ln='', $lw=0, $ht='', $hs='<div style="text-align:
  center;">Reporte de prácticas</div>', $tc=array(0,0,0), $lc=array(0,0,0));

  // set header and footer fonts
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

  // set default monospaced font
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

  // definir margenes
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

  // definir el factor de escala de la imagen
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

  // definir algunas cadenas dependientes de lenguaje (opcional)
  if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
  }

  // definir modo de fuente subopcional
  $pdf->setFontSubsetting(true);

  // definir fuente
  $pdf->SetFont('dejavusans', '', 9, '', true);

  // Añadir una pagina
  $pdf->AddPage();

  // definir efectos de sombra en el texto
  $pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2,
  'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

  $sql = 'SELECT C.*, CE.* FROM clase C INNER JOIN cicloescolar CE ON
  CE.idCicloEscolar = C.CicloEscolar_idCicloEscolar WHERE C.claveAcceso = :ca';
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':ca', $claveAccesoClase);
  $resultado->execute();

  $numRowClase = $resultado->rowCount();

  if($numRowClase != 0) {
    // imprimo los datos de la clase
    $datosClase = $resultado->fetch(PDO::FETCH_OBJ);

    $infoClase = '<table border="1" cellspacing="3" cellpadding="4">
    <thead>
    <tr>
    <th colspan="12" style="text-align: center;
    background-color: #1C6EA4; color: #FFFFFF;">
    <b> Datos de la clase </b> </th>
    </tr>
    </thead>

    <tbody>
    <tr>
    <td colspan="3" style="background-color: #555555;
    color: #FFFFFF;"> <b> Clave de acceso </b> </td>

    <td colspan="2" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->claveAcceso . ' </td>

    <td colspan="3" style="background-color: #555555;
    color: #FFFFFF;"> <b> Nombre materia </b> </td>

    <td colspan="4" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->nombreMateria . ' </td>
    </tr>

    <tr>
    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> NRC </b> </td>

    <td colspan="4" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->nrc . ' </td>

    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Sección </b> </td>

    <td colspan="4" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->claveSeccion . ' </td>
    </tr>

    <tr>
    <td colspan="3" style="background-color: #555555;
    color: #FFFFFF;"> <b> Nombre Clase </b> </td>

    <td colspan="6" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->nombreClase . ' </td>

    <td colspan="1" style="background-color: #555555;
    color: #FFFFFF;"> <b> Aula </b> </td>

    <td colspan="2" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->aula . ' </td>
    </tr>

    <tr>
    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Año </b> </td>

    <td colspan="4" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->anio . ' </td>

    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Ciclo </b> </td>

    <td colspan="4" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosClase->ciclo . ' </td>
    </tr>
    </tbody>
    </table>';

    $infoClase .= '<br><br>';

    // Imprimo los datos del profesor
    $sql = 'SELECT CLA.*, PR.* FROM profesorusuario PR INNER JOIN clase CLA ON
    CLA.ProfesorUsuario_codigoProfesor = PR.codigoProfesor WHERE CLA.claveAcceso = :cca';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':cca'=>$datosClase->claveAcceso);
    $resultado->execute($array);

    $datosProfesor = $resultado->fetch(PDO::FETCH_OBJ);

    $infoProfesor = '<table border="1" cellspacing="3" cellpadding="4">
    <thead>
    <tr>
    <th colspan="12" style="text-align: center;
    background-color: #1C6EA4; color: #FFFFFF;">
    <b> Datos del profesor </b> </th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Código </b> </td>

    <td colspan="2" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosProfesor->codigoProfesor . ' </td>

    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Nombre </b> </td>

    <td colspan="6" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosProfesor->apellidoPaterno .
    ' ' . $datosProfesor->apellidoMaterno . ', ' . $datosProfesor->nombrePila . ' </td>
    </tr>
    </tbody>
    </table>';

    $infoProfesor .= '<br><br>';

    // Imprimo los datos del alumno
    $sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $codigoAlumno);
    $resultado->execute();

    $datosAlumno = $resultado->fetch(PDO::FETCH_OBJ);

    $infoAlumno = '<table border="1" cellspacing="3" cellpadding="4">
    <thead>
    <tr>
    <th colspan="12" style="text-align: center;
    background-color: #1C6EA4; color: #FFFFFF;">
    <b> Datos del alumno </b> </th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Código </b> </td>

    <td colspan="2" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosAlumno->codigoAlumno . ' </td>

    <td colspan="2" style="background-color: #555555;
    color: #FFFFFF;"> <b> Nombre </b> </td>

    <td colspan="6" style="text-align: center;
    background-color: #D0E4F5;"> ' . $datosAlumno->apellidoPaterno .
    ' ' . $datosAlumno->apellidoMaterno . ', ' . $datosAlumno->nombrePila . ' </td>
    </tr>
    </tbody>
    </table>';

    $infoAlumno .= '<br><br>';

    $html = '';

    // Busco los cuestionarios de las practicas del alumno
    $promedioEstudiante = 0;
    $numeroDePracticas = 0;
    $resumenCalificacionesPracticas = '';
    $sql = 'SELECT P.*, CU.*, EV.* 
    FROM practica P 
    INNER JOIN cuestionario CU ON CU.Practica_idPractica = P.idPractica 
    INNER JOIN evaluacion EV ON EV.Cuestionario_idCuestionario = CU.idCuestionario 
    WHERE P.Clase_claveAcceso = :cca AND CU.AlumnoUsuario_codigoAlumno = :auca
    AND P.nombre != :n AND P.eliminado != true';
    $resultado = $baseDatos->prepare($sql);
    $array = array(':cca'=>$datosClase->claveAcceso,
    ':auca'=>$datosAlumno->codigoAlumno,
    ':n'=>'');
    $resultado->execute($array);

    $numRowPracticas = $resultado->rowCount();

    if($numRowPracticas > 0) {
      $practicasCalificadas = $resultado->fetchAll(PDO::FETCH_OBJ);
      foreach($practicasCalificadas as $practicaCalificada) {
        $numeroDePracticas++;
        $promedioEstudiante += $practicaCalificada->califiacion;

        $html .= $infoClase;
        $html .= $infoProfesor;
        $html .= $infoAlumno;

        $html .= '<table border="1" cellspacing="3" cellpadding="4">
        <thead>
        <tr>
        <th colspan="12" style="text-align: center;
        background-color: #1C6EA4; color: #FFFFFF;">
        <b> Reporte de práctica </b> </th>
        </tr>
        </thead>

        <thead>
        <tr>
        <th colspan="12" style="text-align: center;
        background-color: #1C6EA4; color: #FFFFFF;">
        <b>' . $practicaCalificada->nombre . ' </b> </th>
        </tr>
        </thead>

        <tbody>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Calificación </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->califiacion . ' </td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Respuesta pregunta 1 </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->respuestaPregunta1 . ' </td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Respuesta pregunta 2 </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->respuestaPregunta2 . ' </td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Respuesta pregunta 3 </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->respuestaPregunta3 . ' </td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Conclusión </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->conclusion . ' </td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b> Diagrama de control </b> </td>

        <td colspan="10" style="text-align: justify;
        background-color: #D0E4F5;"> <img src="' .
        $practicaCalificada->rutaArchivo . '" alt="Diagrama de control secuencial"> </td>
        </tr>
        </tbody>
        </table> <br><br>';

        $html .= '<br pagebreak="true">';

        $resumenCalificacionesPracticas .= '<tr>
        <td colspan="7" style="text-align: center;
        background-color: #555555; color: #FFFFFF;">
        <b>' . $practicaCalificada->nombre . '</b> </td>

        <td colspan="5" style="text-align: center;
        background-color: #D0E4F5;"> ' .
        $practicaCalificada->califiacion . ' </td>
        </tr>';
      }

      $promedioEstudiante = $promedioEstudiante / $numeroDePracticas;

      $promEstudiante = '<table border="1" cellspacing="3" cellpadding="4">
      <thead>
      <tr>
      <th colspan="12" style="text-align: center;
      background-color: #1C6EA4; color: #FFFFFF;">
      <b> <h1> Resumen de calificaciones </h1> </b> </th>
      </tr>
      <tr>
      <th colspan="12" style="text-align: center;
      background-color: #1C6EA4; color: #FFFFFF;">
      <b> Resumen de prácticas </b> </th>
      </tr>
      </thead>
      <tbody>';

      $promEstudiante .= $resumenCalificacionesPracticas;

      $promEstudiante .= ' <tr>
      <th colspan="12" style="text-align: center;
      background-color: #1C6EA4; color: #FFFFFF;">
      <b> Promedio total </b> </th>
      </tr>
      <tr>
      <td colspan="12" style="text-align: center;
      background-color: #D0E4F5;"> <h2>' .
      round($promedioEstudiante, 2) . '</h2> </td>
      </tr>
      </tbody>
      </table>';

      $html .= $promEstudiante;
    } else {
      $html .= '<table border="1" cellspacing="3" cellpadding="4">
      <tbody>
      <tr>
      <td colspan="12" style="text-align: center;
      background-color: #1C6EA4; color: #FFFFFF;">
      <b> Sin prácticas contestadas y/o calificadas </b> </td>
      </tr>
      </tbody>
      </table>';
    }

    $pdf->writeHTML($html, true, false, true, false, '');

    if(ob_get_length() > 0) {
      ob_end_clean();
    }
    
    $pdf->Output('reporte_practicas_' . $codigoAlumno . '.pdf', 'I');
  } else {
    $html = '';

    $pdf->writeHTML($html, true, false, true, false, '');

    if(ob_get_length() > 0) {
      ob_end_clean();
    }

    $pdf->Output('reporte_practicas_' . $codigoAlumno . '.pdf', 'I');
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
