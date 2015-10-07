<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-4 col-md-offset-4">
  <!-- general form elements -->        
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Add User</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
      <form action="index.php?action=admin&page=adduser_submit" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" class="form-control" name="username" value="" maxlength="20" />
        </div>
        <div class="form-group">
          <label for="pass">Password</label>
          <input type="password" id="pass" class="form-control" name="pass" value="" maxlength="20" />
        </div>
        <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-thumbs-up"></i> Add User</button>
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