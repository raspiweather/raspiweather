<?php
require_once('../configuration.php');

$allData = array();

$dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
$remote_site_url = $dbh->query("SELECT site_value FROM site_info WHERE `site_item`='site_remote'")->fetchAll(PDO::FETCH_ASSOC);
$remote_site_api = $dbh->query("SELECT site_value FROM site_info WHERE `site_item`='site_api'")->fetchAll(PDO::FETCH_ASSOC);

$remote_site_url_array = explode(",",$remote_site_url[0]['site_value']);
$remote_site_api_array = explode(",",$remote_site_api[0]['site_value']);

$array = $dbh->query("SELECT * FROM templates WHERE `active`=1 AND `type`=0 ORDER BY `template_order`")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('tables'=>$array));

$array = $dbh->query("SELECT * FROM templates WHERE `active`=1 AND `type`=2 ORDER BY `template_order`")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('charts'=>$array));

$array = $dbh->query("SELECT * FROM templates WHERE `active`=1 AND `type`=3 ORDER BY `template_order`")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('other'=>$array));

$array = $dbh->query("SELECT * FROM widgets ORDER BY widget_order")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('widgets'=>$array));

$array = $dbh->query("SELECT * FROM news ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('news'=>$array));

$array = $dbh->query("SELECT * FROM site_info WHERE (`site_item`='site_name' OR `site_item`='site_colour')")->fetchAll(PDO::FETCH_ASSOC);

$allData = array_merge($allData,array('site_info'=>$array));

$array = array('date_time' => date("d-m-Y h:i a"));

$allData = array_merge($allData,array('last_update'=>$array));

file_put_contents($weather_folder['install'].'/public_html/data/site_data.json', json_encode($allData)); //WRITE FILE CONTENTS


    $backup['data'] = $weather_folder['install']."/public_html/data/";
    $backup['temp_loc'] = $weather_folder['install']."/tmp/upload.zip";
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


 for ($rs = 0; $rs < count($remote_site_url_array); ++$rs) {
   $filename = $weather_folder['install'].'/tmp/upload.zip';
   $handle = fopen($filename, "r");
   $data = fread($handle, filesize($filename));
   $POST_DATA = array('file' => base64_encode($data));

   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $remote_site_url_array[$rs].'/api.php');
   curl_setopt($curl, CURLOPT_TIMEOUT, 30);
   curl_setopt($curl, CURLOPT_POST, 1);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPHEADER,array('HttpSiteAPI: '.$remote_site_api_array[$rs].''));
   curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
   $response[$rs] = curl_exec($curl);
   curl_close ($curl);


 }
 $rd=0;
 for ($rp = 0; $rp < count($response); ++$rp) {
   if ($response == 'success') {
     ++$rd;
   }
 }
 if ($rd == count($response)) {
   unlink($filename);
 }
