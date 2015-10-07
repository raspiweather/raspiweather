<?php
$contents = file_get_contents($settings_array['local_files']."/forecast.txt", true);

$forecast= json_decode($contents, true);

$forecast_icons= json_decode('{"A":"wi-day-sunny","B":"wi-day-sunny","C":"wi-day-overcast","D":"wi-day-showers","E":"wi-day-rain","F":"wi-day-cloudy","G":"wi-day-rain-mix","H":"wi-night-showers","I":"wi-day-showers","J":"wi-day-cloudy","K":"wi-day-rain","L":"wi-cloudy","M":"wi-cloudy","N":"wi-rain","O":"wi-showers","P":"wi-showers","Q":"wi-storm-showers","R":"wi-night-showers","S":"wi-storm-showers","T":"wi-thunderstorm","U":"wi-rain","V":"wi-thunderstorm","W":"wi-rain","X":"wi-thunderstorm","Y":"wi-thunderstorm","Z":"wi-thunderstorm"}', true);

/*
//THIS LINE ONLY TO GO INTO THE FORECAST TEMPLATE
{"icon":"#calc "ZambrettiCode(params, data)" "%s"#","forecast":"#calc "Zambretti(params, data)" "%s."#","time":"Computed at #idx "Computed at %H:%M %Z"#"}
*/
?>

<div class="box box-solid bg-skin-blue fg-skin-blue">
  <div class="box-header">
    <h3 class="box-title">Forecast</h3>
  </div>
  <div class="box-body">
  <p style="font-size:500%">
    <i class="<?php echo $forecast_icons[$forecast['icon']];?>"></i>
  </p>
  <?php echo $forecast['forecast'];?><br>
  <?php echo $forecast['time'];?>
  </div>
</div>
