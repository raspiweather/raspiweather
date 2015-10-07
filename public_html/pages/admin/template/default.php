<?php 
if(isset($_SESSION['user_id'])) {
?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Template</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <form role="form" method="post" action="index.php?action=admin&page=edit_template&method=edit">    
          <input type="hidden" name="action" value="<?php echo $action; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="callout callout-warning">
              <h4>Note:</h4>
              <p>Changes to active templates will only appear once their interval cycle has occured (for example, hourly templates will only change when the next hourly template generation has been performed)</p>
            </div>
          <div class="form-group">
            <label>Select Template (* indicates active template)</label>
            <select class="form-control" name="templates">
              <?php  
                $con=mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
                if (mysqli_connect_errno())
                  { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
                  
                $result = mysqli_query($con,"SELECT * FROM templates");
                $template_arr = array();
                
                while($row = mysqli_fetch_array($result))
                  { array_push($template_arr, array($row['id'], $row['name'], $row['interval'], $row['type'], $row['active'])); }                  
                mysqli_close($con);
                
                for ($b = 0; $b <= count($template_arr) - 1; $b++) {
                  if ($template_arr[$b][3]==1) {
                    $template_type = "(Twitter)";
                  } 
                  elseif ($template_arr[$b][3]==2) {
                    $template_type = "(Chart)";
                  } 
                  elseif ($template_arr[$b][3]==3) {
                    $template_type = "(Other)";
                  } else {
                    $template_type = "(Text)";
                  }
                  if ($template_arr[$b][4]==1) {
                    $active = "*";
                  } else {
                    $active = "";
                  }
                  echo "<option value='".$template_arr[$b][0]."'>".$active.$template_arr[$b][1]." - ".$template_type." - ".$template_arr[$b][2]."</option>".PHP_EOL;
                }
              ?>
            </select>
          </div>          
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-pencil"></i> Edit Template</button>
            <a href="?action=admin&page=edit_template" class="btn btn-success"><i class="fa fa-file-text"></i> Create Template</a>  
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