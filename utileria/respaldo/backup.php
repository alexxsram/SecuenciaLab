<?php 
$method = isset($_POST['method']) ? $_POST['method'] : '';
$sqlFilename = isset($_POST['sql_filename']) ? $_POST['sql_filename'] : '';
$zipFoldername = isset($_POST['zip_foldername']) ? $_POST['zip_foldername'] : '';
$path = isset($_POST['path']) ? $_POST['path'] : '';

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'secuencialab';

$host = 'localhost';
$user = 'secuenc2';
$password = 'secuencialabcucei';
$database = 'secuenc2_secuencialab';

switch ($method) {
    case 'export':
        $fecha1 = date('Y-m-d H:i:s');
        $fecha = str_replace(array('-', ' ', ':'), array('', '_', ''), $fecha1);
        $rutaBackups = realpath('../../sql/backups');
        $rutaImageFiles = realpath('../../images/files');
        $sqlFileName = $database.'_'.$fecha.'.sql';
        $zipFoldername = 'files_'.$fecha.'.zip';
        $path = $rutaBackups.'/'.$fecha.'/';
        
        if(!file_exists(is_dir($path))) {
            if(!mkdir($path, 0755, true)) {
                $error = error_get_last();
                echo $error['message'];
            }
        }
        
        $zip = new ZipArchive();
        $zip->open($path.$zipFoldername, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rutaImageFiles), RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                if($file->getFilename() == 'readme.md') {
                } else {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rutaBackups) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
        }
        $zip->close();
        
        $comando = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$path}{$sqlFileName}";
        
        exec($comando, $output, $resultado);
        
        switch($resultado) {
            case 0:
                $archivoBackupJson = $rutaBackups.'/backups.json';
                $array = array();
                $array['dumps'] = array();
                $array['dumps'][0] = array('sql_filename' => $sqlFileName, 'zip_foldername' => $zipFoldername, 'path' => $path, 'export_date' => $fecha1);
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
        
                echo 'export success';
                break;
            case 1:
                echo "<pre>";
                print_r($output);
                die;
                echo 'Error al realizar la exportación de la base de datos';
                break;
        }        
        break;
    case 'import':
        $rutaImageFiles = realpath('../../images/files');

        $comando = "mysql --host={$host} --user={$user} --password={$password} {$database} < {$path}{$sqlFilename}";
        
        exec($comando, $output, $resultado);

        switch ($resultado) {
            case 0:
                $zip = new ZipArchive();
                $folder = $zip->open($path.$zipFoldername);
                if($folder == true) {
                    $zip->extractTo($rutaImageFiles);
                    $zip->close();
                }
                echo 'import success';
                break;
            case 1:
                echo 'Error al realizar la importación de la base de datos';
                break;
        }
        break;
}

?>