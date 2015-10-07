<ul class="sidebar-menu<?php if (!isset($_GET['page'])) { echo " active"; }?>">
  <li>
    <a href="/">
    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  <li>
    <a href="?action=pages&page=news">
    <i class="fa fa-list-ul"></i> <span>News</span>
    </a>
  </li>
  <li class="treeview<?php if (isset($_GET['page'])) { if ($_GET['page']=='table') { echo " active"; }}?>">
    <a href="#">
    <i class="fa fa-table"></i>
    <span>Tables</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <?php
//REMOTE CHECK
if ($remote['is_remote'] != True) {
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("SELECT * FROM templates WHERE `active`=1 AND `type`=0 ORDER BY `template_order`");
      $stmt->execute();
      $table_array = $stmt->fetchAll();
} else {
	$contents = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$contents = json_decode($contents, true);
	$table_array = $contents['tables'];
}
      for ($b = 0; $b <= count($table_array) - 1; $b++) {
        echo "<li><a href='?action=pages&page=table&id=".$table_array[$b]['id']."'><i class='fa fa-angle-double-right'></i> ".$table_array[$b]['name']."</a></li>".PHP_EOL;
      }

      ?>
    </ul>
  </li>
  <li class="treeview<?php if (isset($_GET['page'])) { if ($_GET['page']=='graph') { echo " active"; }}?>">
    <a href="#">
    <i class="fa fa-bar-chart-o"></i>
    <span>Charts</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <?php
//REMOTE CHECK
if ($remote['is_remote'] != True) {
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("SELECT * FROM templates WHERE `active`=1 AND `type`=2 ORDER BY `template_order`");
      $stmt->execute();
      $graph_array = $stmt->fetchAll();
} else {
	$contents = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$contents = json_decode($contents, true);
	$graph_array = $contents['charts'];
}
      for ($b = 0; $b <= count($graph_array) - 1; $b++) {
        echo "<li><a href='?action=pages&page=graph&id=".$graph_array[$b]['id']."'><i class='fa fa-angle-double-right'></i> ".$graph_array[$b]['name']."</a></li>".PHP_EOL;
      }

      ?>
    </ul>
  </li>
</ul>
