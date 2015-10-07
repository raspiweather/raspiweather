  <h3 class="box-title">Twitter Configuration</h3>
  <div class="box-body">
  <div class="callout callout-warning">
    <h4>Note:</h4>
    <p>Advanced Users Only</p>
  </div>
  <div class="form-group">
    <label>Twitter Secret</label>
    <input type="text" class="form-control" name="twitter_secret" placeholder="longstringofrandomcharacters"<?php if (isset($config_array['twitter']['secret'])){ echo " value='".trim($config_array['twitter']['secret'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Twitter Key</label>
    <input type="text" class="form-control" name="twitter_key" placeholder="evenlongerstringofrandomcharacters"<?php if (isset($config_array['twitter']['key'])){ echo " value='".trim($config_array['twitter']['key'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Latitude</label>
    <input type="text" class="form-control" name="twitter_lat" placeholder="51.365"<?php if (isset($config_array['twitter']['latitude'])){ echo " value='".trim($config_array['twitter']['latitude'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Longitude</label>
    <input type="text" class="form-control" name="twitter_lon" placeholder="-0.251"<?php if (isset($config_array['twitter']['longitude'])){ echo " value='".trim($config_array['twitter']['longitude'])."'"; }?>>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
