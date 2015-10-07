  <h3 class="box-title">Main Configuration</h3>
  <div class="box-body">
  <div class="form-group">
    <label>Weather Station Class</label>
    <input type="text" class="form-control" name="ws_type" placeholder="1080"<?php if (isset($config_array['config']['ws type'])){ echo " value='".trim($config_array['config']['ws type'])."'"; } ?>>
  </div>
  <div class="form-group">
    <label>Day End Hour</label>
    <input type="number" min="1" max="24" class="form-control" name="day_end" placeholder="9"<?php if (isset($config_array['config']['day end hour'])){ echo " value='".trim($config_array['config']['day end hour'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Pressure Offset</label>
    <input type="text" class="form-control" name="pres_offset" placeholder="9.1"<?php if (isset($config_array['config']['pressure offset'])){ echo " value='".trim($config_array['config']['pressure offset'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Template Encoding</label>
    <input type="text" class="form-control" name="temp_encode" placeholder="iso_8859_1"<?php if (isset($config_array['config']['template encoding'])){ echo " value='".trim($config_array['config']['template encoding'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>Language</label>
    <select class="form-control" name="language">
    <option>en</option>
    <option>de</option>
    </select>
  </div>
  <div class="form-group">
    <label>Rain Day Threshold</label>
    <input type="text" class="form-control" name="rain_thresh" placeholder="0.2"<?php if (isset($config_array['config']['rain day threshold'])){ echo " value='".trim($config_array['config']['rain day threshold'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>USB Activity Margin</label>
    <input type="text" class="form-control" name="usb_act" placeholder="3.0"<?php if (isset($config_array['config']['usb activity margin'])){ echo " value='".trim($config_array['config']['usb activity margin'])."'"; }?>>
  </div>
  <!--
  <div class="form-group">
    <label>GNUPlot Encoding</label>
    <input type="text" class="form-control" name="gnu_encode" placeholder="iso_8859_1"<?php if (isset($config_array['config']['gnuplot encoding'])){ echo " value='".trim($config_array['config']['gnuplot encoding'])."'"; }?>>
  </div>
  <div class="form-group">
    <label>GNUPlot Version</label>
    <input type="text" class="form-control" name="gnu_version" placeholder="3.0"<?php if (isset($config_array['config']['gnuplot version'])){ echo " value='".trim($config_array['config']['gnuplot version'])."'"; }?>>
  </div>-->
  <div class="form-group">
    <label>Log Data Sync</label>
    <div class="checkbox">
      <input type="checkbox" name="log_data"<?php if (isset($config_array['config']['logdata sync'])){ if(strpos($config_array['config']['logdata sync'], '1') !== false){ echo " checked"; }}?>>
    </div>
  </div>
  <div class="form-group">
    <label>Asynchronous</label>
    <div class="checkbox">
      <input type="checkbox" name="async"<?php if (isset($config_array['config']['asynchronous'])){ if(strpos($config_array['config']['asynchronous'], 'True') !== false){ echo " checked"; }}?>>
    </div>
  </div>
  <div class="form-group">
    <label>Frequent Writes</label>
    <div class="checkbox">
      <input type="checkbox" name="freq_writes"<?php if (isset($config_array['config']['frequent writes'])){ if(strpos($config_array['config']['frequent writes'], 'True') !== false){ echo " checked"; }}?>>
    </div>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
  </div>
  </div>
