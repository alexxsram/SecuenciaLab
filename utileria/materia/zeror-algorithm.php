<?php
// $fileCsv = $_FILES['nombreCsv']['name'];
$fileCsv = $_FILES['nombreCsv']['tmp_name'];
$dataSet = readCsv($fileCsv);
$totalInstances = getTotalInstances($dataSet);
$uniqueValues = getUniqueValues($dataSet);
$repeatedValues = getRepetitionValues($dataSet);
$bestValue = getBestOption($repeatedValues, $totalInstances);

if($bestValue[0]['index'] == 'Insatisfactorio') {
    $opc = 'Define al docente que imparte la clase que no se relaciona con el contenido de la clase y desconoce los recursos de apoyo para los alumnos.';
}
if($bestValue[0]['index'] == 'Malo') {
    $opc = 'Define al docente que imparte la clase que no se relaciona al menos en un 60% con el contenido de la clase.';
}
if($bestValue[0]['index'] == 'Regular') {
    $opc = 'Define al docente que imparte la clase que esta poco relacionado con el contenido de la clase en un 70%.';
}
if($bestValue[0]['index'] == 'Bueno') {
    $opc = 'Define al docente que imparte la clase que esta capacitado y relacionado con el contenido de la clase en un 80%.';
}
if($bestValue[0]['index'] == 'Muy bueno') {
    $opc = 'Define al docente que imparte la clase que esta aptamente capacitado y domina el contenido de la clase en un 90%.';
}
if($bestValue[0]['index'] == 'Excelente') {
    $opc = 'Define al docente que imparte la clase que esta aptamente capacitado y conoce a la perfección el contenido de la clase en un 100% utilizando
    los recursos de la clase como apoyo para los alumnos.';
}

$message = '<div class="alert alert-success text-justify" role="alert"> En base al rendimiento de los alumnos, el status de la clase se encuentra en nivel: ' . $bestValue[0]['index'] . '.
'.$opc.'</div>';

echo $message;

function readCsv($fileName) {
    $dataSet = array();
    $fileHandle = fopen($fileName, 'r');
    while(!feof($fileHandle)) {
        $dataSet[] = fgetcsv($fileHandle, 1024);
    }
    fclose($fileHandle);
    return $dataSet;
}

function getTotalInstances($dataSet) {
    $total = 0;
    $totalRows = count($dataSet);
    for($i = 1; $i < $totalRows; $i++) {
        if(!empty($dataSet[$i])) {
            $total++;
        }
    }
    return $total;
}

function getUniqueValues($dataSet) {
    $uniqueValues = array();
    $totalRows = count($dataSet);
    for($i = 1; $i < $totalRows; $i++) {
        if(!empty($dataSet[$i])) {
            if(!in_array($dataSet[$i][10], $uniqueValues)) {
                $uniqueValues[] = $dataSet[$i][10];
            }
        }
    }
    return $uniqueValues;
}

function getRepetitionValues($dataSet) {
    $repetitionValues = array();
    $totalRows = count($dataSet);
    for($i = 1; $i < $totalRows; $i++) {
        if(!empty($dataSet[$i])) {
            if(isset($repetitionValues[$dataSet[$i][10]])) {
                $repetitionValues[$dataSet[$i][10]] += 1;
            } else {
                $repetitionValues[$dataSet[$i][10]] = 1;
            }
        }
    }
    return $repetitionValues;
}

function getBestOption($repeatedValues, $totalInstances) {
    $value = max($repeatedValues);
    $index = array_search($value, $repeatedValues);
    $bestValue = array();
    $bestValue[0] = array();
    $bestValue[0]['index'] = $index;
    $bestValue[0]['value'] = $value . '/' . $totalInstances;
    return $bestValue;
}
?>