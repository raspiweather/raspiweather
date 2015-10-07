<?php
if(isset($_SESSION['user_id'])) {
  $message = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
      if($mime_type == $type) {
      $okay = true;
      break;
      }
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
      $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

    $target_path = $weather_folder['install']."/weather_data/".$filename;  // change this to the correct site path
    if(move_uploaded_file($source, $target_path)) {
      $zip = new ZipArchive();
      $x = $zip->open($target_path);
      if ($x === true) {
      $zip->extractTo($weather_folder['install']."/weather_data/raw/"); // change this to the correct site path
      $zip->close();

      unlink($target_path);
      }
      $message = "Your .zip file was uploaded and unpacked<br>PyWWWS will now stop and reprocess, this could take a long time be patient.";

      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_service'");
      $cron_value="reprocess";
      $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_INT);
      $stmt->execute();
    } else {
      $message = "There was a problem with the upload. Please try again.";
    }
    }
  }
  ?>

  <div class="row">
  <!-- left column -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <!-- general form elements -->
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Dowload Backup Data</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <div class="form-group">
          You can use this to take a current timestamped backup of the weather data folder for safe keeping.
          This will zip and offer a download of the full folder that contains the raw data for the weather station
        </div>
        <form enctype="multipart/form-data" method="post" action="pages/admin/backup/download.php">
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="download" value="Upload"><i class="fa fa-download"></i> Download Backup</button>
          </div>
        </form>
        </div>
      </div>
    </div><!-- /.col -->

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <!-- general form elements -->
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Upload Backup Data</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <?php
        if($message) {
        ?><div class="callout callout-info"><?php
          echo "<p>$message</p>";
        ?></div><?php
        }
        ?>
        <form enctype="multipart/form-data" method="post" action="">
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="form-group">
          <div class="input-group">
	<span class="input-group-btn">
	<span class="btn btn-primary btn-file">
            <i class="fa fa-archive"></i> Choose file
            <input type="file" id="zip_file" name="zip_file">
	</span>
	</span>
        <input type="text" class="form-control" readonly>
	<script type="text/javascript">
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
});
	</script>
          </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-warning" name="submit" value="Upload"><i class="fa fa-upload"></i> Upload Backup</button>
          </div>
        </form>
        </div>
      </div>
    </div><!-- /.col -->
</div>
<div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <!-- general form elements -->
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Information About Uploads</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          If you are uploading your previous PYWWS data, make sure you zip the following folder (not just contents of the folder):
          <ul>
          <li>raw</li>
          </ul>
        </div>
      </div>
    </div><!-- /.col -->
  </div>
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>
