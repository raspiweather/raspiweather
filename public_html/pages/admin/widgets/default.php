<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Widgets</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="index.php?action=admin&page=edit_widget&method=edit">    
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <div class="callout callout-warning">
             <h4>Note:</h4>
             Basic widget functions can be performed here. More advanced tweaking is done in the backend
          </div>
          <div class="form-group">
            <label>Select Widget</label>
            <select class="form-control" name="widgetname">
              <?php                  
                $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbh->prepare("SELECT * FROM widgets");
                $stmt->execute();
                $widget_array = $stmt->fetchAll();
                
                for ($b = 0; $b <= count($widget_array) - 1; $b++) {
                  echo "<option value='".$widget_array[$b]['id']."'>".$widget_array[$b]['widget_name']."</option>".PHP_EOL;
                }
              ?>
            </select>
          </div>          
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-pencil"></i> Edit Widget</button>
            <!--<a href="?action=forms&page=template" class="btn btn-success">Create Template</a>  -->
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
