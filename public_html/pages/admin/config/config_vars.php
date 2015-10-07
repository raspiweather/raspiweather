<?php
// $handle = fopen($weather_folder['data']."/weather.ini", "r");
$config_array = parse_ini_file($weather_folder['data']."/weather.ini", true);
if ($config_array) { 
} else {
?>
<div class="alert alert-warning alert-dismissable">
<i class="fa fa-warning"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Alert!</b> Could not open configuration file
</div>
<?php
}
?>
