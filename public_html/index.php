<?php
require_once('../configuration.php');
require_once('auth.php');
?>
<?php

$display_index = True;

if (isset($_GET['page'])){
  $page = $_GET['page'];
  if ($page == "other") {
    require_once('pages/pages/'.$page.'/default.php');
    $display_index = False;
  } else {
    $display_index = True;
  }
}
// DISPLAY INDEX
if ($display_index == True) {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <title><?php echo $site_array['site_name']; ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- bootstrap 3.0.2 -->
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- font Awesome -->
  <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/css/weather-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/css/pi-icons.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="/assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- jQuery 2.0.2 -->
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/jscolor/jscolor.js"></script>
  <script src="/assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
  <?php
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 'graph'){ ?>
      <script src="/assets/js/plugins/highcharts/highcharts.js"></script>
      <script src="/assets/js/plugins/highcharts/highcharts-more.js"></script>
      <script src="/assets/js/plugins/highcharts/exporting.js"></script>
      <?php
      }
    }
  ?>
  <!-- Theme style -->
  <link href="/assets/css/AdminLTE.php" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="favicon.png" />

  <!-- / date stuff -->
  <script type="text/javascript">
  var DayName = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
  var MonthName = new Array("January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  </script>

</head>
<script>
var windowsize = $(window).height();

$(window).resize(function() {
  windowsize = $(window).height();
  if (windowsize <= 1023) {
    $("body").removeClass("fixed");
  }
  if (windowsize >= 1024) {
    $("body").addClass("fixed");
  }

});
</script>



<body class="skin-blue">
  <!-- Fixed navbar -->

  <header class="header">
  <a href="/" class="skin-blue logo"><?php echo $site_array['site_name']; ?></a>
  <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </a>
      <div class="navbar-right">
        <ul class="nav navbar-nav">
        <?php
        require_once('nav.php');
        ?>
        </ul>
      </div>
    </nav>
  </header>

  <div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left info">
          <?php
          require_once('pages/forecast/default.php');
          ?>
          </div>
        </div>
        <?php
          require_once('sidebar.php');
        ?>
      </section>
    <!-- /.sidebar -->
    </aside>

  <aside class="right-side">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><script type="text/javascript"> <!--
      var CurrentDate = new Date();
      var DateCur = CurrentDate.getDate();
      var DayNumber = CurrentDate.getDay();
      var MonthNumber = CurrentDate.getMonth();
      var Year = CurrentDate.getFullYear();
      document.write("" + DayName[DayNumber] + ", " + DateCur + " " + MonthName[MonthNumber] + " " + Year + "");
      </script></h1>
    </section>

  <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-md-12">
          <?php
          if (!isset($_GET['page'])) {
          require_once('pages/widgets/default.php');
          ?>
        </div>
      </div>

      <?php
      }
      else {
      ?>
        <div class="row">
          <div class="col-md-12">
            <?php
            if (isset($_GET['action'])){
              $action = $_GET['action'];
            }
            $page = $_GET['page'];
            if (!empty($action)) {
              require_once('pages/'.$action.'/'.$page.'/default.php');
            } else {
              require_once($page.'/default.php');
            }
            ?>
          </div>
        </div>

        <?php
        }
        ?>

        <div class="box box-solid bg-skin-blue fg-skin-blue">
          <div class="box-header">
            <h3 class="box-title">RasPiWeather</h3>
          </div>
        </div>
      </section><!-- /.content -->
    </aside><!-- /.right-side -->
  </div><!-- ./wrapper -->

  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/AdminLTE/app.js" type="text/javascript"></script>
</body>
</html>
<?php
// DISPLAY INDEX
}
?>
