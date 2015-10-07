<?php
$nodata = true;
if (isset($_GET['id'])) {
  $contents = @file_get_contents($settings_array['local_files']."/".$_GET['id'].".txt", true);
  if ($contents === FALSE) {
    $contents = 'Unable locate the file for this, try again later';
  }

if ($remote['is_remote'] != True) {
  $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $dbh->prepare("SELECT name FROM templates WHERE `id`=:tempid AND `active`=1");
  $stmt->bindParam(':tempid', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $template_name = $stmt->fetchColumn();
} else {
	$gettable = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$gettable = json_decode($gettable, true);
	$table_array = $gettable['tables'];
	for ($b = 0; $b <= count($table_array) - 1; $b++) {
		if ($table_array[$b]['id'] == $_GET['id']) {
			$template_name = $table_array[$b]['name'];
		}
	}
}
  if($template_name == false) {
    $template_name = "No template";
    $contents = "No data to display";
    $nodata = true;
  } else {
    $nodata = false;  
  }
} else {
  $template_name = "No template";
  $contents = "No data to display";
  $nodata = true;
}
?>
<div class="box box-solid box-primary">
  <div class="box-header">
    <h3 class="box-title"><?php echo $template_name; ?></h3>
    <?php if($nodata == false) { 
	if(isset($_SESSION['user_id'])) {
?>
    <div class="box-tools pull-right">
      <form role="form" method="post" action="index.php?action=admin&page=edit_template&method=edit">    
        <input type="hidden" name="action" value="admin">
        <input type="hidden" name="page" value="template">
        <input type="hidden" name="templates" value="<?php echo $_GET['id']; ?>">    
        <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-pencil"></i></button>
      </form>
    </div>
  <?php
  } }
  ?>
  </div>
  <div class="box-body chart-responsive"><?php
  echo $contents;
  ?>
  </div><!-- /.box-body -->
</div><!-- /.box -->
