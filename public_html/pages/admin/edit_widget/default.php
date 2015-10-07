<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Edit Widget</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="handler.php">    
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST")
          {
            if ($_POST['action']=='admin' && $_POST['page']=='widgets') {
            echo '<input type="hidden" name="method" value="edit">';
                          
              $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $dbh->prepare("SELECT * FROM widgets WHERE id=:widget_id");
              $stmt->bindParam(':widget_id', $_POST['widgetname'], PDO::PARAM_STR);
              $stmt->execute();
              
              $widget_array = $stmt->fetchAll();
              
              for ($b = 0; $b <= count($widget_array) - 1; $b++) {
                if ($widget_array[0]['active']==1) { $checked = "checked"; } else { $checked = ""; }
                
                //$contents = file_get_contents($settings_array['templates']."/".$widget_array[0][4]."", true);
                echo '<input type="hidden" name="widget_id" value="'.$widget_array[0]['id'].'">
                      <div class="form-group">
                        <label><i class="fa fa-font"></i> Widget Name</label>
                        <input type="text" class="form-control" name="widget_name" placeholder="Widget Name" value="'.$widget_array[0]['widget_name'].'">
                      </div>
                      <div class="form-group">
                        <label><i class="fa fa-terminal"></i> Widget Label</label>
                        <input type="text" class="form-control" name="widget_text" placeholder="Widget Label" value="'.$widget_array[0]['widget_text'].'">
                      </div>
                      <div class="form-group">
                        <label><i class="fa fa-th"></i> Widget Icon</label>
                        <input type="text" class="form-control" name="widget_icon" placeholder="<i class=&quot;wi-celcius&quot;></i>" value="'.$widget_array[0]['widget_icon'].'">
                      </div>
                      <div class="form-group">
                        <label><i class="fa fa-square"></i> Widget Background</label>
                        <input type="text" class="form-control" name="widget_bg" placeholder="<i class=&quot;wi-celcius&quot;></i>" value="'.$widget_array[0]['widget_bg'].'">
                      </div>
                      <div class="form-group">
                        <label><i class="fa fa-list-ol"></i> Widget Order</label>
                        <input type="number" min="1" max="50" class="form-control" name="widget_order" placeholder="1" value="'.$widget_array[0]['widget_order'].'">
                      </div>
                      <div class="form-group">
                        <label><i class="fa fa-question"></i> Active</label>
                        <div class="checkbox">
                          <input type="checkbox" name="active" '.$checked.'>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-success" name="update"><i class="fa fa-upload"></i> Update</button></div>'.PHP_EOL;
              }
            }
          } else {
          ?>
          Can't create widgets
          <?php
          }
          ?>
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