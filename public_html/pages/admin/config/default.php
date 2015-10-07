<?php 
if(isset($_SESSION['user_id'])) {
?>
<?php
require_once('config_vars.php')
?>
<div class="row">
<!-- left column -->
  <div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-solid box-primary">
  <div class="box-header">
  <h3 class="box-title">Configuration Options</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Main</a></li>
        <li><a href="#tab_2" data-toggle="tab">Paths</a></li>
        <li><a href="#tab_3" data-toggle="tab">Live</a></li>
        <li><a href="#tab_4" data-toggle="tab">Logged</a></li>
        <li><a href="#tab_5" data-toggle="tab">Hourly</a></li>
        <li><a href="#tab_6" data-toggle="tab">12 Hourly</a></li>
        <li><a href="#tab_7" data-toggle="tab">Daily</a></li>
        <li><a href="#tab_8" data-toggle="tab">FTP</a></li>
        <li><a href="#tab_9" data-toggle="tab">Twitter</a></li>
        <li><a href="#tab_10" data-toggle="tab">Online Services</a></li>
        <li><a href="#tab_11" data-toggle="tab">Zambretti</a></li>
      </ul>
      <form role="form" method="post" action="handler.php">
      <input type="hidden" name="action" value="<?php echo $action; ?>">
      <input type="hidden" name="page" value="<?php echo $page; ?>">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
        <?php
        require_once('main.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        <?php
        require_once('paths.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
        <?php
        require_once('live.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
        <?php
        require_once('logged.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_5">
        <?php
        require_once('hourly.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_6">
        <?php
        require_once('12hourly.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_7">
        <?php
        require_once('daily.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_8">
        <?php
        require_once('ftp.php')
        ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_9">
        <?php
        require_once('twitter.php')
        ?>
	</div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_10">
        <?php
        require_once('online.php')
        ?>
	</div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_11">
        <?php
        require_once('zambretti.php')
        ?>
        </div><!-- /.tab-pane -->

      
      </div><!-- /.tab-content -->
      </form>
    </div><!-- nav-tabs-custom -->
  </div>
  </div>
  </div><!-- /.col -->
  <div class="col-md-6">
  <!-- general form elements -->

    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Configuration File</h3>
      </div><!-- /.box-header -->
  <div class="box-body">
    <?php
    $contents = fopen($weather_folder['data']."/weather.ini", "r");
    if ($contents) {
    while (($line = fgets($contents)) !== false) {
    echo $line."<br>";
    }
    }
    ?>
    </div><!-- /.box -->
  </div>
  </div>
</div>
<?php
} else {
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=pages&page=login">';
}
?>
