<?php 
$method = $_POST['method'];

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'secuencialab';

// $host = 'localhost';
// $user = 'id10689217_secuencialaboperaciones';
// $password = 'develsecuencialab';
// $database = 'id10689217_secuencialab';
$rutaCarpetaBackups = realpath('../../sql/backups');
$fechaFile = date('Ymd_His');
$rutaDump = $rutaCarpetaBackups.'\\'.$fechaFile.'\\';
$filename = $database.'_'.$fechaFile.'.sql';

if(!file_exists(is_dir($rutaDump))) {
    if(!mkdir($rutaDump, 0777, true)) {
        $error = error_get_last();
        echo $error['message'];
    }
}

$comando = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$rutaDump}{$filename}";

exec($comando, $output, $resultado);

switch($resultado) {
    case 0:
        $archivoBackupJson = $rutaCarpetaBackups.'\\backups.json';
        $array = array();
        $array['dumps'] = array();
        $array['dumps'][$fechaFile] = array('sql_filename' => $filename, 'sql_path' => $rutaDump, 'export_date' => $fechaFile);
        if(!file_exists($archivoBackupJson)) {
            $json = json_encode($array, JSON_PRETTY_PRINT);
        } else {
            $content = file_get_contents($archivoBackupJson);
            unlink($archivoBackupJson);
            $contentArray = json_decode($content, true);
            $newArray = array();
            $newArray['dumps'] = array_merge($contentArray['dumps'], $array['dumps']);
            $json = json_encode($newArray, JSON_PRETTY_PRINT);
        }
        $fo = fopen($archivoBackupJson, 'w');
        fwrite($fo, $json);
        fclose($fo);

        echo 'success';
        break;
    case 1:
        echo 'Error al realizar la exportación de la base de datos';
        break;
}
?>