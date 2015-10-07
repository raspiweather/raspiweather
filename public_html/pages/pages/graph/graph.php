<?php

$chartdata = json_decode($contents, true);

$seriesdata = "";
$categories = "";
$legend = "";
$yaxis = "";

if ($chartdata['charttype']['type'] == "column" && $chartdata['charttype']['polar'] == "true") {
  //DO POLAR CHART STUFF
  //INITIALISE ROSEDATA ARRAY PRE-FILL WITH 0 VALUES
  //JSON WIND DIRECTION DATA
  $directions = json_decode('[{"dir":"N"},{"dir":"NNE"},{"dir":"NE"},{"dir":"ENE"},{"dir":"E"},{"dir":"ESE"},{"dir":"SE"},{"dir":"SSE"},{"dir":"S"},{"dir":"SSW"},{"dir":"SW"},{"dir":"WSW"},{"dir":"W"},{"dir":"WNW"},{"dir":"NW"},{"dir":"NNW"}]', true);
  for ($a = 0; $a <= count($chartdata['windvalues'])-1; $a++) {
    for ($z = 0; $z <= count($directions)-1; $z++) {
      for ($y = 0; $y <= count($chartdata['thresholds'])-1; $y++) {
        $rosedata['thresh'.$y][$z] = 0;
      }
    }
  }
  $totalcount = 0;
  //ROLL THROUGH ARRAYS TO GENERATE THE ROSEDATA FOR THE CHART
  for ($a = 0; $a <= count($chartdata['windvalues'])-1; $a++) {
    for ($z = 0; $z <= count($directions)-1; $z++) {
      if ($chartdata['windvalues'][$a]['dir'] == $directions[$z]['dir']) {
        for ($y = 0; $y <= count($chartdata['thresholds'])-1; $y++) {
          if ($y == 0) {
            if ($chartdata['windvalues'][$a]['value'] <= $chartdata['thresholds'][$y]['thresh']) {
                $rosedata['thresh'.$y][$z] = $rosedata['thresh'.$y][$z] + 1;
                $totalcount++;
            }
          } else {
            if ($chartdata['windvalues'][$a]['value'] > $chartdata['thresholds'][$y-1]['thresh'] && $chartdata['windvalues'][$a]['value'] <= $chartdata['thresholds'][$y]['thresh']) {
                $rosedata['thresh'.$y][$z] = $rosedata['thresh'.$y][$z] + 1;    
                $totalcount++;
            }
          }
        }
      }
    }
  }
  
  //YAXIS GENERATION 
  $yaxis = "yAxis: [".PHP_EOL;  
  for ($a = 0; $a <= count($chartdata['options']['yaxis'])-1; $a++) {   
    $yaxis = $yaxis."{ title: { text: '".$chartdata['options']['yaxis'][$a]['title']."',},".PHP_EOL;
    if (isset($chartdata['options']['yaxis'][$a]['opposite'])){
        $yaxis = $yaxis."opposite: ".$chartdata['options']['yaxis'][$a]['opposite'].",";
    }
    $yaxis = $yaxis."},".PHP_EOL;
  }
  $yaxis = $yaxis."],".PHP_EOL;
  
  for ($y = 0; $y <= count($chartdata['thresholds'])-1; $y++) {
    $thresholds[$y] = '';
  }
  //GENERATE THE DATA FOR THE JAVASCRIPT SERIES DATA
  for ($a = 0; $a <= count($directions) -1; $a++) {
    $categories = $categories."'".$directions[$a]["dir"]."',";
    for ($y = 0; $y <= count($chartdata['thresholds'])-1; $y++) {
      $thresholds[$y] = $thresholds[$y].''.round(($rosedata['thresh'.$y][$a]/$totalcount*100),1).',';
    }
  }
  
  for ($y = 0; $y <= count($chartdata['thresholds'])-1; $y++) {
    $seriesdata = $seriesdata."    {";
    if ($y == 0){
      $seriesdata = $seriesdata."name: '< ".$chartdata['thresholds'][$y]['thresh']."',";
    } elseif($y == count($chartdata['thresholds'])-1) {
      $seriesdata = $seriesdata."name: '> ".$chartdata['thresholds'][$y]['thresh']."',";
    } else {
      $seriesdata = $seriesdata."name: '".$chartdata['thresholds'][$y-1]['thresh']." - ".$chartdata['thresholds'][$y]['thresh']."',";
    }
    $seriesdata = $seriesdata."data: [".$thresholds[$y]."]
    },".PHP_EOL;
  }
  //END POLAR CHART STUFF  
}
elseif ($chartdata['charttype']['type'] == "column" && $chartdata['charttype']['polar'] == "false") {
  //DO COLUMN CHART STUFF
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
    $b=0;
    foreach($chartdata['values'][$a] as $key => $val) {
      $categoryarray[$a][$b] = $key;
      $b++;
    }
  }
  
  //YAXIS GENERATION 
  $yaxis = "yAxis: [".PHP_EOL;  
  for ($a = 0; $a <= count($chartdata['options']['yaxis'])-1; $a++) {   
    $yaxis = $yaxis."{ title: { text: '".$chartdata['options']['yaxis'][$a]['title']."',},".PHP_EOL;
    if (isset($chartdata['options']['yaxis'][$a]['opposite'])){
        $yaxis = $yaxis."opposite: ".$chartdata['options']['yaxis'][$a]['opposite'].",";
    }
    $yaxis = $yaxis."},".PHP_EOL;
  }
  $yaxis = $yaxis."],".PHP_EOL;
  
  for ($c = 1; $c <= count($categoryarray[0])-1; $c++) {
    $splinedata = "";
    for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $splinedata = $splinedata.'['.$chartdata['values'][$a][$categoryarray[0][$c]].'],';
    }
    $seriesdata = $seriesdata."{";
    if (isset($chartdata['options']['seriestype'])){
      if (isset($chartdata['options']['seriestype'][$c-1]['type'])){
        $seriesdata = $seriesdata."type: '".$chartdata['options']['seriestype'][$c-1]['type']."',";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['yaxis'])){
        $seriesdata = $seriesdata."yAxis: ".$chartdata['options']['seriestype'][$c-1]['yaxis'].",";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['valuesuffix'])){
        $seriesdata = $seriesdata."tooltip: { valueSuffix: '".$chartdata['options']['seriestype'][$c-1]['valuesuffix']."' },";
      }
    }
    $seriesdata = $seriesdata."name: '".$categoryarray[0][$c]."',";
    $seriesdata = $seriesdata."data: [".$splinedata."]";
    $seriesdata = $seriesdata."},".PHP_EOL;
  }
  
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $categories = $categories.'"'.$chartdata['values'][$a][$categoryarray[$a][0]].'",';
  }
}
elseif ($chartdata['charttype']['type'] == "bar" && $chartdata['charttype']['polar'] == "false") {
  //DO BAR CHART STUFF
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
    $b=0;
    foreach($chartdata['values'][$a] as $key => $val) {
      $categoryarray[$a][$b] = $key;
      $b++;
    }
  }
  
  //YAXIS GENERATION 
  $yaxis = "yAxis: [".PHP_EOL;  
  for ($a = 0; $a <= count($chartdata['options']['yaxis'])-1; $a++) {   
    $yaxis = $yaxis."{ title: { text: '".$chartdata['options']['yaxis'][$a]['title']."',},".PHP_EOL;
    if (isset($chartdata['options']['yaxis'][$a]['opposite'])){
        $yaxis = $yaxis."opposite: ".$chartdata['options']['yaxis'][$a]['opposite'].",";
    }
    $yaxis = $yaxis."},".PHP_EOL;
  }
  $yaxis = $yaxis."],".PHP_EOL;
  
  for ($c = 1; $c <= count($categoryarray[0])-1; $c++) {
    $splinedata = "";
    for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $splinedata = $splinedata.'['.$chartdata['values'][$a][$categoryarray[0][$c]].'],';
    }
    $seriesdata = $seriesdata."{";
    if (isset($chartdata['options']['seriestype'])){
      if (isset($chartdata['options']['seriestype'][$c-1]['type'])){
        $seriesdata = $seriesdata."type: '".$chartdata['options']['seriestype'][$c-1]['type']."',";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['yaxis'])){
        $seriesdata = $seriesdata."yAxis: ".$chartdata['options']['seriestype'][$c-1]['yaxis'].",";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['valuesuffix'])){
        $seriesdata = $seriesdata."tooltip: { valueSuffix: '".$chartdata['options']['seriestype'][$c-1]['valuesuffix']."' },";
      }
    }
    $seriesdata = $seriesdata."name: '".$categoryarray[0][$c]."',";
    $seriesdata = $seriesdata."data: [".$splinedata."]";
    $seriesdata = $seriesdata."},".PHP_EOL;
  }
  
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $categories = $categories.'"'.$chartdata['values'][$a][$categoryarray[$a][0]].'",';
  }
}
elseif ($chartdata['charttype']['type'] == "pie" && $chartdata['charttype']['polar'] == "false") {
  //DO PIE CHART STUFF
}
elseif ($chartdata['charttype']['type'] == "spline" || $chartdata['charttype']['type'] == "line" || $chartdata['charttype']['type'] == "column" && $chartdata['charttype']['polar'] == "false") {
  //DO SPLINE/LINE/COLUMN CHART STUFF
  //INITIALISE CATEGORIES AND DATA
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
    $b=0;
    foreach($chartdata['values'][$a] as $key => $val) {
      $categoryarray[$a][$b] = $key;
      $b++;
    }
  }
  
  //YAXIS GENERATION 
  $yaxis = "yAxis: [".PHP_EOL;  
  for ($a = 0; $a <= count($chartdata['options']['yaxis'])-1; $a++) {   
    $yaxis = $yaxis."{ title: { text: '".$chartdata['options']['yaxis'][$a]['title']."',},".PHP_EOL;
    if (isset($chartdata['options']['yaxis'][$a]['opposite'])){
        $yaxis = $yaxis."opposite: ".$chartdata['options']['yaxis'][$a]['opposite'].",";
    }
    $yaxis = $yaxis."},".PHP_EOL;
  }
  $yaxis = $yaxis."],".PHP_EOL;
  
  for ($c = 1; $c <= count($categoryarray[0])-1; $c++) {
    $splinedata = "";
    for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $splinedata = $splinedata.'['.$chartdata['values'][$a][$categoryarray[0][$c]].'],';
    }
    $seriesdata = $seriesdata."{";
    if (isset($chartdata['options']['seriestype'])){
      if (isset($chartdata['options']['seriestype'][$c-1]['type'])){
        $seriesdata = $seriesdata."type: '".$chartdata['options']['seriestype'][$c-1]['type']."',";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['yaxis'])){
        $seriesdata = $seriesdata."yAxis: ".$chartdata['options']['seriestype'][$c-1]['yaxis'].",";
      }
      if (isset($chartdata['options']['seriestype'][$c-1]['valuesuffix'])){
        $seriesdata = $seriesdata."tooltip: { valueSuffix: '".$chartdata['options']['seriestype'][$c-1]['valuesuffix']."' },";
      }
    }
    $seriesdata = $seriesdata."name: '".$categoryarray[0][$c]."',";
    $seriesdata = $seriesdata."data: [".$splinedata."]";
    $seriesdata = $seriesdata."},".PHP_EOL;
  }
  
  for ($a = 0; $a <= count($chartdata['values'])-1; $a++) {
      $categories = $categories.'"'.$chartdata['values'][$a][$categoryarray[$a][0]].'",';
  }
  //END SPLINE STUFF
}
elseif ($chartdata['charttype']['type'] == "scatter"  && $chartdata['charttype']['polar'] == "false") {
  //DO SCATTER CHART STUFF
}

//SETUP THE COLORS USED FOR THE CHART
$chartcolors = '';
for ($a = 0; $a <= count($chartdata['colors'])-1; $a++) {
  $chartcolors = $chartcolors.'"#'.$chartdata['colors'][$a]['color'].'",';
}


/*
///////////////////////////////////////////////// PYWWS TEMPLATE => JSON OUTPUT WIND ROSE
#timezone local#
#roundtime True#
#hourly#
{"colors":[{"color":"001f3f"},{"color":"0073b7"},{"color":"f39c12"},{"color":"00c0ef"},{"color":"3d9970"},{"color":"39cccc"},{"color":"00a65a"}],"charttype":{"polar":"true","type":"column"},"options":{"stacking":"normal", "labels":"\\u00B0", "valuesuffix":"","chartheight":"600px","yaxistitle":""},"thresholds":[{"thresh":0.5},{"thresh":2.2},{"thresh":3.5},{"thresh":7.5},{"thresh":12.5},{"thresh":18.5},{"thresh":24.5},{"thresh":31.5}],"windvalues":[
#jump -25#
#loop 24#
{"dir":"#wind_dir "%s" "-" "wind_dir_text[x]"#","value":#wind_ave "%.1f" "" "wind_kmph(x)"#},
#jump 1#
#endloop#
]}
///////////////////////////////////////////////// PYWWS TEMPLATE
*/

?>
<div id="container" style="min-width: 300px; height: <?php echo $chartdata['options']['chartheight']; ?>; margin: 0 auto"></div>

<script>
$(function () {
  $('#container').highcharts({
    colors: [<?php echo $chartcolors; ?>],
    chart: {
      polar: <?php echo $chartdata['charttype']['polar']; //PRINT THE POLAR BOOLEAN ?>,
      type: '<?php echo $chartdata['charttype']['type']; //PRINT THE CHARTTYPE ?>'
    },     
    title: {
      text: '<?php echo $template_name; //PRINT THE CHARTNAME ?>'
    },  
    xAxis: {
      categories: [<?php echo $categories; //PRINT THE CATEGORIES ?>],           
      labels: {
        formatter: function () {
          return this.value + '<?php echo $chartdata['options']['labels']; ?>';
        }
      }
    },         
    <?php echo $yaxis; ?>
    <?php echo $legend; ?>
    exporting: {
        enabled: false
    },
    tooltip: {
        shared: true,
    },
    plotOptions: {
      series: {
        <?php echo "stacking: '".$chartdata['options']['stacking']."',".PHP_EOL; ?>
        shadow: false
      },
      <?php echo 'column: {
        pointPadding: '.$chartdata['options']['pointpadding'].',
        groupPadding: 0
      },'.PHP_EOL; ?>
    }, 
    series: [
     <?php
      echo $seriesdata;
  
     ?>
    ]
 });
});
</script>
