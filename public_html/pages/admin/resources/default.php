<?php 
if(isset($_SESSION['user_id'])) {
#$output = shell_exec('sudo '.$weather_folder['scripts'].'/resources');

  $output = @file_get_contents($weather_folder['install']."/pi-scripts/resource.dat", true);
  if ($output === FALSE) {
    $output = 'Unable locate the file for this, try again later';
  }

$resources = json_decode($output, true);

?>
<script>
        $(function() {

            $(".knob").knob({
                /*change : function (value) {
                    //console.log("change : " + value);
                },
                release : function (value) {
                    console.log("release : " + value);
                },
                cancel : function () {
                    console.log("cancel : " + this.value);
                },*/
                draw : function () {

                    // "tron" case
                    if(this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv)  // Angle
                            , sa = this.startAngle          // Previous start angle
                            , sat = this.startAngle         // Start angle
                            , ea                            // Previous end angle
                            , eat = sat + a                 // End angle
                            , r = true;

                        this.g.lineWidth = this.lineWidth;

                        this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value);
                            this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                            this.g.beginPath();
                            this.g.strokeStyle = this.previousColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });

            // Example of infinite knob, iPod click wheel
            var v, up=0,down=0,i=0
                ,$idir = $("div.idir")
                ,$ival = $("div.ival")
                ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
                ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
            $("input.infinite").knob(
                                {
                                min : 0
                                , max : 20
                                , stopper : false
                                , change : function () {
                                                if(v > this.cv){
                                                    if(up){
                                                        decr();
                                                        up=0;
                                                    }else{up=1;down=0;}
                                                } else {
                                                    if(v < this.cv){
                                                        if(down){
                                                            incr();
                                                            down=0;
                                                        }else{down=1;up=0;}
                                                    }
                                                }
                                                v = this.cv;
                                            }
                                });
        });
    </script>
<div class="box box-solid box-primary">
  <div class="box-header">
    <h3 class="box-title">System Resources</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="row">        <!-- purple #932ab6, green #00a65a, red #f56954, teal #39cccc,  -->
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center"> 
        <input type="text" class="knob" value="<?php echo (100-$resources['cpuidle']); ?>" data-width="160" data-height="160" data-fgColor="#3c8dbc" data-readonly="true"/> 
        <div class="knob-label"><h4>Current CPU Usage (%)</h4></div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center"> 
        <input type="text" class="knob" value="<?php echo substr($resources['memused'], 0,- 1); ?>" data-max="<?php echo substr($resources['memtotal'], 0,- 1); ?>" data-width="160" data-height="160" data-fgColor="#00a65a" data-readonly="true"/> 
        <div class="knob-label"><h4>Current Memory Usage (<?php echo substr($resources['memused'], - 1); ?>)</h4></div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center"> 
        <input type="text" class="knob" value="<?php echo substr($resources['temperature'], 0, -2); ?>" data-width="160" data-height="160" data-fgColor="#39cccc" data-readonly="true"/> 
        <div class="knob-label"><h4>Pi Temperature (&deg;C)</h4></div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center"> 
        <input type="text" class="knob" value="<?php echo substr($resources['corevolts'], 0, -1); ?>" data-max="5" data-width="160" data-height="160" data-fgColor="#932ab6" data-readonly="true"/> 
        <div class="knob-label"><h4>Core Voltage (V)</h4></div>
      </div><!-- ./col -->
    </div><!-- /.row -->
  </div><!-- /.box-body -->
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th>Filesystem</th>
        <th>Used</th>
        <th>Usage</th>
      </tr>
      <?php
      for ($a=0;$a<=count($resources['dirs'])-1;$a++) {
      
      if (substr($resources['dirs'][$a]['used'],-1)=="G") {
        $usedval = substr($resources['dirs'][$a]['used'],0,-1)*1024;
      } elseif (substr($resources['dirs'][$a]['used'],-1)=="M") {
        $usedval = substr($resources['dirs'][$a]['used'],0,-1);
      } elseif (substr($resources['dirs'][$a]['used'],-1)=="K") {
        $usedval = substr($resources['dirs'][$a]['used'],0,-1)/1024;
      } else {
        $usedval = 0;
      }
      
      if (substr($resources['dirs'][$a]['size'],-1)=="G") {
        $sizeval = substr($resources['dirs'][$a]['size'],0,-1)*1024;
      }  elseif (substr($resources['dirs'][$a]['size'],-1)=="M") {
        $sizeval = substr($resources['dirs'][$a]['size'],0,-1);
      } elseif (substr($resources['dirs'][$a]['size'],-1)=="K") {
        $sizeval = substr($resources['dirs'][$a]['size'],0,-1)/1024;
      } else {
        $sizeval = 0;
      }
      $usageval = round($usedval/$sizeval*100,1);
      
      if ($usageval < 75) {
        $progresscolor = "green";
      } elseif ($usageval >= 75 && $usageval < 90) {      
        $progresscolor = "yellow";
      } elseif ($usageval >= 90) {
        $progresscolor = "red";      
      }
echo '      <tr>'.PHP_EOL;
echo '        <td width="15%">'.$resources['dirs'][$a]['name'].'</td>'.PHP_EOL;
echo '        <td width="10%">'.round($usedval,2).'/'.round($sizeval,2).' M</td>'.PHP_EOL;
echo '        <td width="70%"><div class="progress">
                    <div class="progress-bar progress-bar-'.$progresscolor.'" role="progressbar" aria-valuenow="'.$usageval.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$usageval.'%">
                    <span class="sr-only">'.round($usedval,2).'M Used</span>
                    </div>
                  </div></td>'.PHP_EOL;
echo '      </tr>'.PHP_EOL;
      }
      ?>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>
