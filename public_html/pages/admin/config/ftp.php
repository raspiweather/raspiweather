  <h3 class="box-title">FTP Configuration</h3>
  <div class="box-body">
  <div class="callout callout-warning">
    <h4>Note:</h4>
    <p>Advanced Users Only</p>
  </div>
  <div class="form-group">
    <label>Local Site</label>
    <input type="text" class="form-control" name="ftp_local" placeholder="True"<?php if (isset($config_array['ftp']['local site'])){ if($config_array['ftp']['local site'] == 1){echo " value='True'";}else{echo " value='False'";} }?>>
  </div>
  <div class="form-group">
    <label>Secure</label>
    <input type="text" class="form-control" name="ftp_secure" placeholder="False"<?php if (isset($config_array['ftp']['secure'])){ echo " value='".trim($config_array['ftp']['secure'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>FTP Url</label>
    <input type="text" class="form-control" name="ftp_url" placeholder="ftp.your_isp.com"<?php if (isset($config_array['ftp']['site'])){ echo " value='".trim($config_array['ftp']['site'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>FTP User</label>
    <input type="text" class="form-control" name="ftp_user" placeholder="username"<?php if (isset($config_array['ftp']['user'])){ echo " value='".trim($config_array['ftp']['user'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>FTP Password</label>
    <input type="text" class="form-control" name="ftp_pass" placeholder="password"<?php if (isset($config_array['ftp']['password'])){ echo " value='".trim($config_array['ftp']['password'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Working Directory</label>
    <input type="text" class="form-control" name="ftp_directory" placeholder="public_html/weather/data/"<?php if (isset($config_array['ftp']['directory'])){ echo " value='".trim($config_array['ftp']['directory'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>FTP Port</label>
    <input type="text" class="form-control" name="ftp_port" placeholder="21"<?php if (isset($config_array['ftp']['port'])){ echo " value='".trim($config_array['ftp']['port'])."'"; }?>>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
