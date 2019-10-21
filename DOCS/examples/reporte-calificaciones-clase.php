<?php
session_start();
if(!isset($_SESSION['codigo']) && $_SESSION['permiso'] == '') {
    header('Location: ../sesion/sesion.php');
}

include('../../utileria/operaciones/conexion.php');

$claveAccesoClase = base64_decode($_GET['claveAccesoClase']);

try {
    // Include the main TCPDF library (search for installation path).
    require_once('tcpdf_include.php');

    // Header Data
    class MYPDF extends TCPDF {
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

    // set default header data
    $pdf->SetHeaderData($ln = '', $lw = 0, $ht = '', $hs = '<div style="text-align: center;"> Reporte de calificaciones de clase</div>', $tc = array(0, 0, 0), $lc = array(0, 0, 0));

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
    $pdf->AddPage('L', 'A3');

    // definir efectos de sombra en el texto
    $textShadow = array(
        'enabled' => false, 
        'depth_w' => 0.2, 
        'depth_h' => 0.2, 
        'color' => array(196, 196, 196), 
        'opacity' => 1, 
        'blend_mode' => 'Normal'
    );
    $pdf->setTextShadow($textShadow);

    $sql = 'SELECT C.*, CE.* FROM clase C 
    INNER JOIN cicloescolar CE ON CE.idCicloEscolar = C.CicloEscolar_idCicloEscolar 
    WHERE C.claveAcceso = :ca';
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':ca', $claveAccesoClase);
    $resultado->execute();

    $numRowClase = $resultado->rowCount();

    if($numRowClase != 0) {
        // imprimo los datos de la clase
        $datosClase = $resultado->fetch(PDO::FETCH_OBJ);

        $infoClase = '';
        $infoClase = '<table border="1" cellspacing="3" cellpadding="4">
            <thead>
                <tr>
                    <th colspan="12" style="text-align: center; background-color: #1C6EA4; color: #FFFFFF;"> <b> Datos de la clase </b> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="background-color: #555555; color: #FFFFFF;"> <b> Clave de acceso </b> </td>
                    <td colspan="2" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->claveAcceso . ' </td>
                    <td colspan="3" style="background-color: #555555; color: #FFFFFF;"> <b> Nombre materia </b> </td>
                    <td colspan="4" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->nombreMateria . ' </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color: #555555; color: #FFFFFF;"> <b> NRC </b> </td>
                    <td colspan="4" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->nrc . ' </td>
                    <td colspan="2" style="background-color: #555555; color: #FFFFFF;"> <b> Sección </b> </td>
                    <td colspan="4" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->claveSeccion . ' </td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color: #555555; color: #FFFFFF;"> <b> Nombre Clase </b> </td>
                    <td colspan="6" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->nombreClase . ' </td>
                    <td colspan="1" style="background-color: #555555; color: #FFFFFF;"> <b> Aula </b> </td>
                    <td colspan="2" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->aula . ' </td>
                </tr>

                <tr>
                    <td colspan="2" style="background-color: #555555; color: #FFFFFF;"> <b> Año </b> </td>
                    <td colspan="4" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->anio . ' </td> 
                    <td colspan="2" style="background-color: #555555; color: #FFFFFF;"> <b> Ciclo </b> </td>
                    <td colspan="4" style="text-align: center; background-color: #D0E4F5;"> ' . $datosClase->ciclo . ' </td>
                </tr>
            </tbody>
        </table><br><br>';

        $html = '';
        $html .= $infoClase;

        $numeroDePracticas = 0;
        $promediosPracticas = array();
        $NumeroDeAlumnosEntregadosPracticas = array();

        $sql = 'SELECT P.* FROM practica P
        WHERE P.Clase_claveAcceso = :cca AND P.eliminado = 0';
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':cca', $datosClase->claveAcceso);
        $resultado->execute();

        $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);

        $infoCalificaciones = '';
        $infoCalificaciones .= '<table border="1" cellspacing="3" cellpadding="4">
            <tbody>
                <tr>
                    <td colspan="12" style="text-align: center; background-color: #1C6EA4; color: #FFFFFF;"> <b> Relación de calificaciones </b> </td>
                </tr>
            </tbody>
        </table>';

        $infoCalificaciones .= '<table border="1" cellspacing="3" cellpadding="4">';

        $thead = '<thead><tr>';
        $thead .= '<th style="text-align: center; background-color: #555555; color: #FFFFFF;"> <b> Nombre alumno </b> </th>';
        foreach($practicas as $practica) {
            $promediosPracticas['\'' . $practica->idPractica . '\''] = 0;
            $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica . '\''] = 0;
            $numeroDePracticas++; 
            $thead .= '<th style="text-align: center; background-color: #555555; color: #FFFFFF;"> <b> ' . $practica->nombre . ' </b> </th>';
        }
        $thead .= '<th style="text-align: center; background-color: #555555; color: #FFFFFF;"> <b> Promedio </b> </th>';
        $thead .= '</tr></thead>';

        $infoCalificaciones .= $thead;

        $promedioTotalAlumnos = 0;
        $sql = 'SELECT AU.codigoAlumno as codigo, CONCAT(AU.apellidoPaterno, " ", AU.apellidoMaterno, ", ", AU.nombrePila) as nombre FROM clase_has_alumnousuario CHAU
        INNER JOIN alumnousuario AU ON AU.codigoAlumno = CHAU.AlumnoUsuario_codigoAlumno 
        WHERE CHAU.Clase_claveAcceso = :cca ORDER BY nombre ASC';

        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':cca', $datosClase->claveAcceso);
        $resultado->execute();

        $numeroDeAlumnos = $resultado->rowCount();
        $alumnos = $resultado->fetchAll(PDO::FETCH_OBJ);

        $tbody = '<tbody>';
        foreach($alumnos as $alumno) {
            
            $sql = 'SELECT EV.*, CU.* FROM cuestionario CU 
            INNER JOIN evaluacion EV ON EV.Cuestionario_idCuestionario = CU.idCuestionario 
            WHERE CU.AlumnoUsuario_codigoAlumno = :auca';
            $resultado = $baseDatos->prepare($sql);
            $resultado->bindValue(':auca', $alumno->codigo);
            $resultado->execute();

            $numRowCalificadas = $resultado->rowCount();

            if($numRowCalificadas > 0) {
                $tbody .= '<tr>';
                $tbody .= '<td style="text-align: center; background-color: #555555; color: #FFFFFF;"> ' . $alumno->codigo . ' - ' . $alumno->nombre . ' </td>';

                $calificadas = $resultado->fetchAll(PDO::FETCH_OBJ);

                $promedio = 0;
                $numeroDeCalificaciones = 0;
                $PracticaYaCalificada = false;
                foreach($practicas as $practica) {
                    $PracticaYaCalificada = false;
                    foreach ($calificadas as $calificado) {
                        if($calificado->Practica_idPractica == $practica->idPractica) {
                            $promediosPracticas['\'' . $practica->idPractica . '\''] = $promediosPracticas['\'' . $practica->idPractica .'\''] + $calificado->califiacion;
                            $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\''] = $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\''] + 1;
                            $numeroDeCalificaciones++;
                            $promedio = $promedio + $calificado->califiacion;
                            $tbody .= '<td style="text-align: center; background-color: #D0E4F5;"> ' . $calificado->califiacion . ' </td>';
                            $PracticaYaCalificada = true;
                            break;
                        }
                    }
                    if(!$PracticaYaCalificada) {
                        $promedio = $promedio + 0; 
                        $tbody .= '<td style="text-align: center; background-color: #D0E4F5;"> Sin calificación </td>';
                    }
                }
                if($numeroDeCalificaciones != 0) {
                    $promedio = round($promedio / $numeroDeCalificaciones, 4);
                } else {
                    $promedio = 'Sin promedio';
                }
                $tbody .= '<td style="text-align: center; background-color: #D0E4F5;"> <b>' . $promedio . '</b> </td>';
                $tbody .= '</tr>';
                $promedioTotalAlumnos += $promedio;
            }
        }
        if($numeroDeAlumnos > 0) {
            $promedioTotalAlumnos = $promedioTotalAlumnos / $numeroDeAlumnos;
        } else {
            $promedioTotalAlumnos = 0;
        }
        $tbody .= '<tr>';
        $tbody .= '<td style="text-align: center; background-color: #555555; color: #FFFFFF;"> <b> Totales </b> </td>';
        foreach($practicas as $practica) {
            if(($numAlumUnaPractica = $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\'']) != 0) {
                $promedioUnaPractica = $promediosPracticas['\'' . $practica->idPractica .'\''] / $NumeroDeAlumnosEntregadosPracticas['\'' . $practica->idPractica .'\''];
            } else {
                $promedioUnaPractica = 'Sin promedio';
            }
            $tbody .= '<td style="text-align: center; background-color: #D0E4F5;"> <b> '. $promedioUnaPractica . ' </b> </td>';
        }
        $tbody .= '<td style="text-align: center; background-color: #D0E4F5;"> <b> '. $promedioTotalAlumnos . ' </b></td>';
        $tbody .= '</tr>';
        $tbody .= '</tbody>';
        
        $infoCalificaciones .= $tbody;
        $infoCalificaciones .= '</table>';
        
        $html .= $infoCalificaciones;
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        if(ob_get_length() > 0) {
            ob_end_clean();
        }

        $pdf->Output('reporte_calificaciones_' . $claveAccesoClase . '.pdf', 'I');
    } else {
        $html = '';
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        if(ob_get_length() > 0) {
            ob_end_clean();
        }

        // Agua del retiro y Contra daños
        $pdf->Output('reporte_calificaciones_' . $claveAccesoClase . '.pdf', 'I');
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
