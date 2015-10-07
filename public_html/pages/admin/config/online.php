  <h3 class="box-title">Online Services Configuration</h3>
  <div class="box-body">
  <div class="callout callout-warning">
    <h4>Note:</h4>
    <p>Advanced Users Only</p>
  </div>
  <div class="form-group">
    <label>Undergroud Station</label>
    <input type="text" class="form-control" name="underground_station" placeholder="IXYZABA5"<?php if (isset($config_array['underground']['station'])){ echo " value='".trim($config_array['underground']['station'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Undergroud Password</label>
    <input type="text" class="form-control" name="underground_password" placeholder="secret"<?php if (isset($config_array['underground']['password'])){ echo " value='".trim($config_array['underground']['password'])."'"; }?>>
  </div>
<hr>
  <div class="form-group">
    <label>Metoffice</label>
    <input type="text" class="form-control" name="metoffice_1" placeholder="51.365"<?php if (isset($config_array['metoffice']['1'])){ echo " value='".trim($config_array['metoffice']['1'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Metoffice</label>
    <input type="text" class="form-control" name="metoffice_2" placeholder="-0.251"<?php if (isset($config_array['metoffice']['2'])){ echo " value='".trim($config_array['metoffice']['2'])."'"; }?>>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
