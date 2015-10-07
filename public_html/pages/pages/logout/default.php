<?php
session_unset();
session_destroy();
$_SESSION = array();
echo '<META HTTP-EQUIV="Refresh" Content="5; URL=index.php">';
?>
<div class="row">
<!-- left column -->
  <div class="col-md-4 col-md-offset-4">
  <!-- general form elements -->        
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Login</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
You have successfully logged out, you will be redirected to the main page shortly
      </div>
    </div>
  </div><!-- /.col -->
</div>