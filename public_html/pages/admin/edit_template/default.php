<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
      <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST")
          {
            if ($_POST['action']=='admin' && $_POST['page']=='template') { ?>
        <h3 class="box-title">Edit Template</h3>
        <?php } } else { ?>
        <h3 class="box-title">Create Template</h3>
        <?php } ?>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="handler.php">    
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST")
          {
            if ($_POST['action']=='admin' && $_POST['page']=='template') {
            echo '<input type="hidden" name="method" value="edit">';
            
              $con=mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
              if (mysqli_connect_errno())
                { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
                
              $result = mysqli_query($con,"SELECT * FROM templates WHERE `id`=".$_POST['templates']."");
              $template_arr = array();
              
              while($row = mysqli_fetch_array($result))
                { array_push($template_arr, array($row['id'], $row['name'], $row['interval'], $row['type'], $row['file'], $row['active'], $row['chart'], $row['template_order'])); }                  
              mysqli_close($con);
              for ($b = 0; $b <= count($template_arr) - 1; $b++) {
                //if ($template_arr[0][3] == 1) { $twit_check = "checked"; $twit_check_text = 'value="1"'; } else { $twit_check = ""; $twit_check_text = 'value="0"'; }
                //if ($template_arr[0][6] == 1) { $chart_check = "checked"; $chart_check_text = 'value="1"'; } else { $chart_check = ""; $chart_check_text = 'value="0"';}
                
                $contents = file_get_contents($settings_array['templates']."/".$template_arr[0][4].".txt", true);
                if ($template_arr[0][5] == 1) {
                      echo '<div class="callout callout-warning">
                                        <h4>Note:</h4>
                                        <p>Some features disabled while this template is active</p>
                                    </div>'.PHP_EOL;
                       echo '<input type="hidden" name="temp_interval" value="'.$template_arr[0][2].'">';
                       echo '<input type="hidden" name="temp_type" value="'.$template_arr[0][3].'">';
                    }
                echo '<input type="hidden" name="template_id" value="'.$template_arr[0][0].'">
                      <div class="form-group">
                      <label><i class="fa fa-font"></i> Template Name</label>
                      <input type="text" class="form-control" name="temp_name" placeholder="Template Name" value="'.$template_arr[0][1].'">
                    </div>'.PHP_EOL;
                    if ($template_arr[0][5] == 0) {
                      for ($a=0;$a<=2; $a++) {
                        $radio[$a]="";
                      }
                      if ($template_arr[0][3]==0) { $radio[0]="checked";}
                      elseif ($template_arr[0][3]==1) { $radio[1]="checked"; }
                      elseif ($template_arr[0][3]==2) { $radio[2]="checked"; }
                      elseif ($template_arr[0][3]==3) { $radio[3]="checked"; }
                    echo '<div class="form-group">
                      <label><i class="fa fa-clock-o"></i> Interval</label>                      
                      <select class="form-control" name="temp_interval">'.PHP_EOL;
                      for ($i = 0; $i <= 5; $i++) {
                        if ($template_arr[0][2] == 'live') { $live_select = " selected"; } else { $live_select = ""; }
                        if ($template_arr[0][2] == 'logged') { $logged_select = " selected"; } else { $logged_select = ""; }
                        if ($template_arr[0][2] == 'hourly') { $hourly_select = " selected"; } else { $hourly_select = ""; }
                        if ($template_arr[0][2] == '12hourly') { $hourly12_select = " selected"; } else { $hourly12_select = ""; }
                        if ($template_arr[0][2] == 'daily') { $daily_select = " selected"; } else { $daily_select = ""; }
                      }
                      echo '<option value="live"'.$live_select.'>Live</option>
                      <option value="logged"'.$logged_select.'>Logged</option>
                      <option value="hourly"'.$hourly_select.'>Hourly</option>
                      <option value="12hourly"'.$hourly12_select.'>12 Hourly</option>        
                      <option value="daily"'.$daily_select.'>Daily</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="temp_type" value="0"  '.$radio[0].'>
                          <div class="badge bg-green"><i class="fa fa-table"></i></div> Text
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="temp_type" value="1" '.$radio[1].'>
                          <div class="badge bg-teal"><i class="fa fa-twitter"></i></div> Twitter
                        </label>
                      </div>            
                      <div class="radio">
                        <label>
                          <input type="radio" name="temp_type" value="2" '.$radio[2].'>
                          <div class="badge bg-aqua"><i class="fa fa-bar-chart-o"></i></div> Chart
                        </label>
                      </div>            
                      <div class="radio">
                        <label>
                          <input type="radio" name="temp_type" value="3" '.$radio[3].'>
                          <div class="badge bg-yellow"><i class="fa fa-file"></i></div> Other (only accessible via direct URL)
                        </label>
                      </div>
                    </div>'.PHP_EOL;
                    } 
                    echo '<div class="form-group">
                      <label><i class="fa fa-font"></i> Template Contents</label>
                      <textarea class="form-control" rows="10" name="temp_content" placeholder="#raw# ...">'.$contents.'</textarea>
                    </div>
                      <div class="form-group">
                        <label><i class="fa fa-list-ol"></i> Template Display Order (In Sidepanel Navigation</label>
                        <input type="number" min="1" max="50" class="form-control" name="template_order" placeholder="1" value="'.$template_arr[0][7].'">
                      </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success" name="update"><i class="fa fa-upload"></i> Update</button>'.PHP_EOL;
                      if ($template_arr[0][5] == 0) {
                      echo '<button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-times-circle"></i> Delete</button>'.PHP_EOL;
                      }
                    echo '</div>'.PHP_EOL;
              }
            }
          } else {
          ?>
          <div class="form-group">
            <label><i class="fa fa-font"></i> Template Name</label>
            <input type="text" class="form-control" name="temp_name" placeholder="Template Name">
          </div>
          <div class="form-group">
            <label><i class="fa fa-clock-o"></i> Interval</label>
            <select class="form-control" name="temp_interval">
            <option value="live">Live</option>
            <option value="logged">Logged</option>
            <option value="hourly">Hourly</option>
            <option value="12hourly">12 Hourly</option>        
            <option value="daily">Daily</option>
            </select>
          </div>
          <div class="form-group">            
            <div class="radio">
              <label>
                <input type="radio" name="temp_type" value="0" checked>
                <div class="badge bg-green"><i class="fa fa-table"></i></div> Text
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="temp_type" value="1">
                <div class="badge bg-teal"><i class="fa fa-twitter"></i></div> Twitter
              </label>
            </div>            
            <div class="radio">
              <label>
                <input type="radio" name="temp_type" value="2">
                <div class="badge bg-aqua"><i class="fa fa-bar-chart-o"></i></div> Chart
              </label>
            </div>          
            <div class="radio">
              <label>
                <input type="radio" name="temp_type" value="3">
                <div class="badge bg-yellow"><i class="fa fa-file"></i></div> Other (only accessible via direct URL)
              </label>
            </div>
          </div>
          <div class="form-group">
            <label><i class="fa fa-font"></i> Template Contents</label>
            <textarea class="form-control" rows="10" name="temp_content" placeholder="#raw# ..."></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
          </div>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div><!-- /.col -->
</div>
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>
