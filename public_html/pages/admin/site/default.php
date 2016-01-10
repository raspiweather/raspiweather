<?php
if(isset($_SESSION['user_id'])) {

$dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$crashcheck = 'pywws_remote';
$stmt = $dbh->prepare("SELECT cron_value FROM cron WHERE cron_name=:cron_name");
$stmt->bindParam(':cron_name', $crashcheck, PDO::PARAM_STR);
$stmt->execute();
$cron_value = $stmt->fetchAll();

?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Site Configuration</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="handler.php">
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="form-group">
            <label>Site Name</label>
            <input type="text" class="form-control" name="site_name" placeholder="Site Name" value="<?php echo $site_array['site_name']; ?>">
          </div>
          <div class="form-group">
            <label>Site Colour</label>
            <input type="text" class="form-control color {hash:true}" name="site_colour" placeholder="#3C8DBC" value="<?php echo $site_array['site_colour']; ?>">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Submit</button>
          </div>
        </form>

      </div>
    </div>
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Remote Site Configuration</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
	<div class="callout callout-warning">
        <h4>Note:</h4>
        <p>Set your API Key and URL end point here (separate additional keys and urls by commas)<br>Update interval is every 5 minutes</p>
        </div>
        <form role="form" method="post" action="handler.php">
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="form-group">
            <label>Remote Site API</label>
            <input type="text" class="form-control" name="site_api" placeholder="putyourapikeyhere" value="<?php echo $site_array['site_api']; ?>">
          </div>
          <div class="form-group">
            <label>Remote Site URL</label>
            <input type="text" class="form-control" name="site_remote" placeholder="http://raspiweather.com/" value="<?php echo $site_array['site_remote']; ?>">
          </div>
	  <div class="form-group">
	    <label>Enable Remote Site Connection?</label>
	    <div class="checkbox">
	      <input type="checkbox" name="site_remote_enable"<?php if ($cron_value[0]['cron_value'] == "yes"){  echo " checked"; }?>>
	    </div>
	  </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="remote"><i class="fa fa-save"></i> Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div><!-- /.col -->

<!-- right column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Dashboard Refresh</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="handler.php">
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="form-group">
            <label>Site Refresh Interval (Seconds) - Enter 0 to disable</label>
            <input type="text" class="form-control" name="site_refresh" placeholder="0" value="<?php echo $site_array['site_refresh']; ?>">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="refresh"><i class="fa fa-save"></i> Submit</button>
          </div>
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
