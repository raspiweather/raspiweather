  <h3 class="box-title">12 Hourly Configuration</h3>
  <div class="box-body">
  <div class="form-group">
    <label>Services</label>
    <select multiple="" class="form-control" name="hour12_servs[]">
      <?php
        if (!isset($config_array['12 hourly']['services'])){
          $hour12_servs_arr = array();
        } else {
          $hour12_servs_arr = str_replace(array( '[', ']' ), '', $config_array['12 hourly']['services']);
          $hour12_servs_arr = explode(", ", $hour12_servs_arr);
        }
        $services_arr = array('metoffice','openweathermap','pwsweather','stacjapogodywawpl','temperaturnu','underground','wetterarchivde');
        for ($b = 0; $b <= count($services_arr) - 1; $b++) {
          $match[$b] = False;
          for ($i = 0; $i <= count($hour12_servs_arr) - 1; $i++) {
            if (strpos($hour12_servs_arr[$i], $services_arr[$b]) !== false){ 
              $match[$b] = True;
            }}
            if ($match[$b] == 1){ 
              echo "<option selected>".$services_arr[$b]."</option>".PHP_EOL;
            } else {
              echo "<option>".$services_arr[$b]."</option>".PHP_EOL;
            }}
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Templates</label>
    <select multiple="" class="form-control" name="hour12_temp[]">
      <?php   
        $con=mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
        if (mysqli_connect_errno())
          { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
        $result = mysqli_query($con,"SELECT * FROM templates WHERE `interval`='12hourly' AND (`type`=0 OR `type`=2 OR `type`=3)");
        $temps_arr = array();
        while($row = mysqli_fetch_array($result))
          { array_push($temps_arr, array($row['id'], $row['name'], $row['active'])); }
        
        for ($b = 0; $b <= count($temps_arr) -1; $b++) {
          if ($temps_arr[$b][2] == 1){ 
              echo "<option selected value='".$temps_arr[$b][0]."'>".$temps_arr[$b][1]."</option>".PHP_EOL;
            } else {
              echo "<option value='".$temps_arr[$b][0]."'>".$temps_arr[$b][1]."</option>".PHP_EOL;
            }
        }
      ?>
    </select>
  </div>  
  <div class="form-group">
    <label>Twitter</label>
    <select multiple="" class="form-control" name="hour12_twit[]">
      <?php
        $result = mysqli_query($con,"SELECT * FROM templates WHERE `interval`='12hourly' AND `type`=1");
        $twit_arr = array();
        while($row = mysqli_fetch_array($result))
          { array_push($twit_arr, array($row['id'], $row['name'], $row['active'])); }
        mysqli_close($con);        
        for ($b = 0; $b <= count($twit_arr) -1; $b++) {
          if ($twit_arr[$b][2] == 1){ 
              echo "<option selected value='".$twit_arr[$b][0]."'>".$twit_arr[$b][1]."</option>".PHP_EOL;
            } else {
              echo "<option value='".$twit_arr[$b][0]."'>".$twit_arr[$b][1]."</option>".PHP_EOL;
            }
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
