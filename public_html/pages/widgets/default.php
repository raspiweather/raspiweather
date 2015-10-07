<?php
/* TEMPLATE CODE <= FIX FOR NEW JSON STRING
{"time":"28-Feb-2014 19:39","widgets":{"temp_out":"4","temp_in":"4","apparent_temp":"2","hum_out":"24","hum_in":"25","abs_pressure":"1245","wind_ave":"12","wind_gust":"67","wind_dir":"E","rain":"2"}}

//PYWWS TEMPLATE
#raw#
#timezone local#
#roundtime True#
{"time":"#idx "%d-%b-%Y %H:%M "#","widgets":{"temp_out":"#temp_out "%.1f" "-"#","temp_in":"#temp_in "%.1f" "-"#","apparent_temp":"#calc "apparent_temp(data['temp_out'], data['hum_out'], data['wind_ave'])" "%.1f" "-"#","hum_out":"#hum_out "%.1f" "-"#","hum_in":"#hum_in "%.1f" "-"#","abs_pressure":"#abs_pressure "%.1f" "-"#","wind_ave":"#wind_ave "%.1f" "" "wind_kmph(x)"#","wind_gust":"#wind_gust "%.1f" "" "wind_kmph(x)"#","wind_dir":"#wind_dir "%s " "-" "wind_dir_text[x]"#","rain":"#rain "%.1f" "-"#"}}
*/

$contents = file_get_contents($settings_array['local_files']."/widgets.txt", true);

$widget_array = json_decode($contents, true);

//print_r($widget_array);
if ($remote['is_remote'] != True) {
$dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare("SELECT * FROM widgets ORDER BY widget_order");

$stmt->execute();
$widget_db_array = $stmt->fetchAll();
} else {
	$contents = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$contents = json_decode($contents, true);
	$widget_db_array = $contents['widgets'];
}

$c=0;

for ($a = 0; $a <= count($widget_db_array)-1; $a++) {
  $b=0;
  foreach($widget_array['widgets'] as $key => $value) {    
    if ($key == $widget_db_array[$a]['widget_name'] && $widget_db_array[$a]['active'] != 0){
        if ($c == 4){
          ?>
          </div>
          <?php
          $c=0;
        }
        if ($c == 0){
          ?>
          <div class="row">
          <?php          
        }
        ?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="small-box <?php echo $widget_db_array[$a]['widget_bg']; ?>">
              <div class="inner">
                <h3><?php echo $value; ?><i class="<?php echo $widget_db_array[$a]['widget_icon']; ?>"></i></h3>
                <p><?php echo $widget_db_array[$a]['widget_text']; ?></p>
              </div>
              <div class="icon"><i class="<?php echo $widget_db_array[$a]['widget_icon']; ?>"></i></div>
              <div class="small-box-footer"><?php echo $widget_array['time']; ?></div>
            </div>
          </div>          
        <?php
        if ($b == count($widget_array['widgets']) - 1){
          ?>
          </div>
          <?php
          $c=0;
        }
        $c=$c+1;
      }
      $b++;
    }    
  }
?>
