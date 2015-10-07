<?php
$weather_folder['install'] = "/apps/weather";
$weather_folder['logs'] = $weather_folder['install']."/logs";

//REMOTE SITE SETTINGS
$remote['is_remote'] = True;
//EDIT THIS TO MATCH WHAT YOU HAVE SET UP ON YOUR RASPBERRY PI INSTALLATION
$remote['api_key'] = 'putyourownapikeyhere';

$settings_array = array();
$settings_array['local_files'] = 'data/';

$contents = file_get_contents("public_html/data/site_data.json", true);
$contents = json_decode($contents, true);
$site_info = $contents['site_info'];
$site_array = array();

for ($b = 0; $b <= count($site_info) - 1; $b++) {
  $site_array[$site_info[$b]['site_item']] = $site_info[$b]['site_value'];
}

?>
