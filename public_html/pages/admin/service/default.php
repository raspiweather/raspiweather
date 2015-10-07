<?php 
if(isset($_SESSION['user_id'])) {

$errorlog = shell_exec('tail -n 50 '.$weather_folder['logs'].'/live_logger.log');

?>

<div class="col-md-12">
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Service Information</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
<div class="row">
<div class="col-md-6">
      <div class="form-group">
	
      <?php
      if ($service_json['state']=='running') {
      ?>
      
        <div class="btn btn-success btn-lg disabled">
        <h4><i class="fa fa-check"></i>PYWWS is running</h4>
        </div>
      <?php
      } elseif ($service_json['state']=='stopped') {
      ?>    
      
        <div class="btn btn-danger btn-lg disabled">
        <h4><i class="fa fa-warning"></i> PYWWS is not running</h4>
        </div>
      <?php
      }
      ?> </div>
	  <form role="form" method="post" action="handler.php">
            <input type="hidden" name="action" value="<?php echo $action; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <?php
            if (isset($_GET['type']))
            {
		?>          
		<div class="callout callout-warning"><?php
			    //IF THIS PAGE IS RECEIVING A POST DO THIS
			      if ($_GET['type']=='start') {
		?>
		<h4>Task Scheduled:</h4>
		<p>Start task scheduled, page will reload in 1 minute</p>
		<?php
			      }
			      elseif ($_GET['type']=='restart') {
		?>
		<h4>Task Scheduled:</h4>
		<p>Restart task scheduled, page will reload in 1 minute</p>
		<?php
			      }
			      elseif ($_GET['type']=='stop') {
		?>
		<h4>Task Scheduled:</h4>
		<p>Stop task scheduled, page will reload in 1 minute</p>
		<?php
              }
            ?>
            <META HTTP-EQUIV="Refresh" Content="60; URL=index.php?action=admin&page=service"> 
            </div>
            </div>
            </div>
            <?php 
            } else {
            //IF THIS PAGE IS JUST LOADING NORMALLY DO THIS
              $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	      $crashcheck = 'pywws_crash';
              $stmt = $dbh->prepare("SELECT cron_value FROM cron WHERE cron_name=:cron_name");
              $stmt->bindParam(':cron_name', $crashcheck, PDO::PARAM_STR);
              $stmt->execute();
	      $cron_value = $stmt->fetchAll();
            ?>    
            
              <button type="submit" class="btn btn-success btn-lg" name="start"><i class="fa fa-play"></i> Start</button>

              <button type="submit" class="btn btn-warning btn-lg" name="restart"><i class="fa fa-repeat"></i> Restart</button>

              <button type="submit" class="btn btn-danger btn-lg" name="stop"><i class="fa fa-stop"></i> Stop</button>
              
	  </form>
</div>
<div class="col-md-6">
	  <form role="form" method="post" action="handler.php">
            <input type="hidden" name="action" value="<?php echo $action; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
	  <div class="form-group">
	    <label>Restart automatically after crash?</label>
	    <div class="checkbox">
	      <input type="checkbox" name="restartaftercrash"<?php if ($cron_value[0]['cron_value'] == "yes"){  echo " checked"; }?>>
	    </div>
 	    <button type="submit" class="btn btn-success btn-lg" name="update">Update</button>
	  </div>
</div>
</div>
            <?php 
            }
            ?>  
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.box -->

<div class="col-md-12">
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Error Log (Last 50 lines)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <pre>
  <?php echo $errorlog; ?>
    </pre>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.box -->
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>
