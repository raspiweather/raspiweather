<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-12">
  <!-- general form elements -->        
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Add News Item</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
      <form role="form" method="post" action="handler.php">
            <input type="hidden" name="action" value="<?php echo $action; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
<?php
if (isset($_GET['method'])) {
  if ($_GET['method'] == 'edit') {
?>
            <input type="hidden" name="news_id" value="<?php echo $_POST['news_id']; ?>">
<?php
  $news_subject = $_POST['news_subject'];
  }
}
?>
            <input type="hidden" name="posted_by" value="<?php echo $_SESSION['user_name']; ?>">
        <div class="form-group">
          <label for="news_subject">Subject</label>
          <input type="text" class="form-control" name="news_subject" value="<?php if (isset($_POST['news_subject'])) { echo $_POST['news_subject']; }?>" maxlength="50" />
        </div>
        <div class="form-group">
          <label for="news_text">News Text</label>
          <textarea class="form-control" name="news_text" rows="4"><?php if(isset($_POST['news_text'])) { echo $_POST['news_text']; }?></textarea>
        </div>
        <div class="form-group">
<?php
if (isset($_GET['method'])) {
  if ($_GET['method'] == 'edit') {
?>
          <button type="submit" class="btn btn-primary" name="edit_news"><i class="fa fa-thumbs-up"></i> Edit News Item</button>
<?php
  }
} else {
?>
          <button type="submit" class="btn btn-primary" name="add_news"><i class="fa fa-thumbs-up"></i> Add News Item</button>
<?php
}
?>
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
