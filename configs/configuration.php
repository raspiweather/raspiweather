<?php
#SET UP YOUR DATABASE INFORMATION HERE
$database['host'] = "localhost";
$database['user'] = "weather";
$database['pass'] = "password";
$database['name'] = "weather";
#EDIT FILE LOCATIONS HERE
$weather_folder['install'] = "/apps/weather";
$weather_folder['data'] = $weather_folder['install']."/weather_data";
$weather_folder['logs'] = $weather_folder['install']."/logs";
$weather_folder['scripts'] = $weather_folder['install']."/pi-scripts";

$remote['is_remote'] = False;

$dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare("SELECT * FROM site_info");
$stmt->execute();
$site_info = $stmt->fetchAll();

$dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare("SELECT * FROM settings");
$stmt->execute();
$settings = $stmt->fetchAll();

$settings_array = array();

for ($b = 0; $b <= count($settings) - 1; $b++) {
  $settings_array[$settings[$b]['setting_item']] = $settings[$b]['setting_value'];
}

$site_array = array();

for ($b = 0; $b <= count($site_info) - 1; $b++) {
  $site_array[$site_info[$b]['site_item']] = $site_info[$b]['site_value'];
}

?>
