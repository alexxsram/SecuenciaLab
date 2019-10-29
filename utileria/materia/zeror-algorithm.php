<?php
$fileCsv = $_FILES['nombreArchivo']['name'];
$dataSet = readCsv($fileCsv);
$totalInstances = getTotalInstances($dataSet);
$uniqueValues = getUniqueValues($dataSet);
$repeatedValues = getRepetitionValues($dataSet);
$bestValue = getBestOption($repeatedValues, $totalInstances);

echo json_encode($bestValue, JSON_PRETTY_PRINT);
die;

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