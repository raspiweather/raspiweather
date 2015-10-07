<?php

require_once('../../../../configuration.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['action']=='admin' && $_POST['page']=='backup' && $_POST['download']) {

    $backup['date'] = date('Y_m_d_His');
    $backup['filename'] = "rawbackup_".$backup['date'].".zip";
    $backup['data'] = $weather_folder['install']."/weather_data/raw";
    $backup['temp_loc'] = $weather_folder['install']."/tmp/".$backup['filename'];

    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file)
            {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true)
                {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }
                else if (is_file($file) === true)
                {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }

    Zip($backup['data'],$backup['temp_loc']);

    if(file_exists($backup['temp_loc'])){
        //Set Headers:
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($backup['temp_loc'])) . ' GMT');
        header('Content-Type: application/force-download');
        header('Content-Disposition: inline; filename="'.$backup['filename'].'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($backup['temp_loc']));
        header('Connection: close');
        readfile($backup['temp_loc']);
        exit();
    }

    if(file_exists($backup['temp_loc'])){
        unlink($backup['temp_loc']);

    }


  }
}
?>
