  <h3 class="box-title">Path Configuration</h3>
  <div class="box-body">
  <div class="callout callout-warning">
    <h4>Note:</h4>
    <p>Advanced Users Only</p>
  </div>
  <div class="form-group">
    <label>Template Path</label>
    <input type="text" class="form-control" name="path_temp" placeholder="/home/$USER/weather/templates/"<?php if (isset($config_array['paths']['templates'])){ echo " value='".trim($config_array['paths']['templates'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>User Calibration</label>
    <input type="text" class="form-control" name="path_user" placeholder="/home/$USER/weather/modules/usercalib"<?php if (isset($config_array['paths']['user_calib'])){ echo " value='".trim($config_array['paths']['user_calib'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Local Files</label>
    <input type="text" class="form-control" name="path_local" placeholder="/home/$USER/weather/results/"<?php if (isset($config_array['paths']['local_files'])){ echo " value='".trim($config_array['paths']['local_files'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Working Directory</label>
    <input type="text" class="form-control" name="path_work" placeholder="/tmp/weather"<?php if (isset($config_array['paths']['work'])){ echo " value='".trim($config_array['paths']['work'])."'"; }?>>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>

