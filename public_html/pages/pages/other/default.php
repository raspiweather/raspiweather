<?php
$nodata = true;
if (isset($_GET['id'])) {
  $contents = @file_get_contents($settings_array['local_files']."/".$_GET['id'].".txt", true);
  if ($contents === FALSE) {
    $contents = 'Unable locate the file for this, try again later';
  }

if ($remote['is_remote'] != True) {
  $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $dbh->prepare("SELECT name FROM templates WHERE `id`=:tempid AND `active`=1");
  $stmt->bindParam(':tempid', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $template_name = $stmt->fetchColumn();
} else {
	$gettable = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$gettable = json_decode($gettable, true);
	$table_array = $gettable['other'];
	for ($b = 0; $b <= count($table_array) - 1; $b++) {
		if ($table_array[$b]['id'] == $_GET['id']) {
			$template_name = $table_array[$b]['name'];
		}
	}
}
  if($template_name == false) {
    $template_name = "No template";
    $contents = "No data to display";
    $nodata = true;
  } else {
    $nodata = false;
  }
} else {
  $template_name = "No template";
  $contents = "No data to display";
  $nodata = true;
}

echo $contents;

?>
