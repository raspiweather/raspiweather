<?php 
if(isset($_SESSION['user_id'])) {

$output = shell_exec('tail -n 50 '.$weather_folder['logs'].'/live_logger.log');

?>
<div class="box box-solid box-primary">
  <div class="box-header">
    <h3 class="box-title">Error Log (Last 50 lines)</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
  <pre>
<?php echo $output; //echo str_replace(PHP_EOL, '<br />', $output);  ?>
  </pre>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>