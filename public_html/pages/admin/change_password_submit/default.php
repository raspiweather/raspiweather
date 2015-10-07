<?php 
if(isset($_SESSION['user_id'])) {
?>
<META HTTP-EQUIV="Refresh" Content="5; URL=index.php">
<div class="row">
<!-- left column -->
  <div class="col-md-4 col-md-offset-4">
  <!-- general form elements -->        
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Change Password</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
<?php echo $message; ?>
      </div>
    </div>
  </div><!-- /.col -->
</div>
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>