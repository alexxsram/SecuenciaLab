<?php 
$method = $_POST['method'];

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'secuencialab';

$host = 'localhost';
$user = 'id10689217_secuencialaboperaciones';
$password = 'develsecuencialab';
$database = 'id10689217_secuencialab';

$fecha = date('Ymd_His');
$rutaCarpetaBackups = realpath('../../sql/backups');
$rutaCarpetaImageFiles = realpath('../../images/files');
$fileNameDb = $database.'_'.$fecha.'.sql';
$fileNameZipImageFiles = 'files_'.$fecha.'.zip';
$rutaDump = $rutaCarpetaBackups.'\\'.$fecha.'\\';
$rutaZip = $rutaDump.$fileNameZipImageFiles;

if(!file_exists(is_dir($rutaDump))) {
    if(!mkdir($rutaDump, 0777, true)) {
        $error = error_get_last();
        echo $error['message'];
    }
}

$zip = new ZipArchive();
$zip->open($rutaZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rutaCarpetaBackups), RecursiveIteratorIterator::LEAVES_ONLY);
foreach ($files as $name => $file) {
    if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rutaCarpetaBackups) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();

$comando = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$rutaDump}{$fileNameDb}";

exec($comando, $output, $resultado);

switch($resultado) {
    case 0:
        $archivoBackupJson = $rutaCarpetaBackups.'\\backups.json';
        $array = array();
        $array['dumps'] = array();
        $array['dumps'][0] = array('sql_filename' => $fileNameDb, 'zip_foldername' => $fileNameZipImageFiles, 'path' => $rutaDump, 'export_date' => $fecha);
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