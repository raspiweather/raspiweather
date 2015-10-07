  <h3 class="box-title">Zambretti Configuration</h3>
  <div class="box-body">
  <div class="callout callout-warning">
    <h4>Note:</h4>
    <p>Advanced Users Only</p>
  </div>
  <div class="form-group">
    <label>North?</label>
    <input type="text" class="form-control" name="zambretti_north" placeholder="True"<?php 
if (isset($config_array['Zambretti']['north'])){
 if ($config_array['Zambretti']['north'] == 1){
   echo " value='True'"; 
 } else {
   echo " value='False'"; 
 }
}

?>>
  </div>
  <div class="form-group">
    <label>Barometer Upper</label>
    <input type="text" class="form-control" name="zambretti_upper" placeholder="1050.0"<?php if (isset($config_array['Zambretti']['baro upper'])){ echo " value='".trim($config_array['Zambretti']['baro upper'])."'"; }?>>
  </div>
<hr>
  <div class="form-group">
    <label>Barometer Lower</label>
    <input type="text" class="form-control" name="zambretti_lower" placeholder="950.0"<?php if (isset($config_array['Zambretti']['baro lower'])){ echo " value='".trim($config_array['Zambretti']['baro lower'])."'"; }?>>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
