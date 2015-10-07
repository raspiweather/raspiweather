
<?php
//REMOTE
if ($remote['is_remote'] != True) {

if(isset($_SESSION['user_id']))
{

  $service_status = @file_get_contents($weather_folder['install']."/pi-scripts/status.dat", true);
  if ($service_status === FALSE) {
    $service_status = 'Unable locate the file for this, try again later';
  }


$service_json = json_decode($service_status, true);


?>

<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-ul"></i><b> <i class="caret"></i></b></a>
  <ul class="dropdown-menu">
    <li class="header">News</li>
    <li>
      <ul class="menu">    
        <li><a href="?action=admin&page=news"><i class="fa fa-paperclip bg-green"></i>Add News</a></li>
      </ul>
    </li>
  </ul>
</li>

<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-dashboard"></i><b> <i class="caret"></i></b>
<?php
if ($service_json['state']=='stopped') {
?>
<span class="label label-danger"><i class="fa fa-times"></i></span>
<?php
}
if ($service_json['state']=='running') {
?>
<span class="label label-success"><i class="fa fa-check"></i></span>
<?php
}

?></a>
  <ul class="dropdown-menu">
    <li class="header">RasPiWeather Information</li>
    <li>
      <ul class="menu">
        <li><a href="?action=admin&page=resources"><i class="fa fa-linux bg-aqua"></i>System Resources</a></li> 
        <li><a href="?action=admin&page=service"><i class="fa fa-list-alt bg-red"></i>Service Status/Error Log
<?php
if ($service_json['state']=='stopped') {
?>
<span class="label label-danger"><i class="fa fa-times"></i></span>
<?php
}
if ($service_json['state']=='running') {
?>
<span class="label label-success"><i class="fa fa-check"></i></span>
<?php
}

?>
</a></li>
        <li><a href="?action=admin&page=backup"><i class="fa fa-cloud-download bg-yellow"></i>Data Backup / Restore</a></li>
      </ul>
    </li>
  </ul>
</li>

<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i><b> <i class="caret"></i></b></a>
  <ul class="dropdown-menu">
    <li class="header">RasPiWeather Settings</li>
    <li>
      <ul class="menu">    
        <li><a href="?action=admin&page=site"><i class="fa fa-globe bg-green"></i>Site Configuration</a></li>
        <li><a href="?action=admin&page=config"><i class="fa fa-gears bg-aqua"></i>PYWWS Configuration</a></li>        
        <li><a href="?action=admin&page=template"><i class="fa fa-pencil bg-red"></i>Template Configuration</a></li>   
        <li><a href="?action=admin&page=widgets"><i class="fa fa-dashboard bg-teal"></i>Widgets Configuration</a></li>
      </ul>
    </li>
  </ul>
</li>

<?php
}
?>
<?php 
if(isset($_SESSION['user_id'])) {
?>
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b> <?php echo $_SESSION['user_name']; ?> <i class="caret"></i></b></a>
  <ul class="dropdown-menu">
    <li class="header">Account Settings</li>
    <li>
      <ul class="menu">
        <?php
        if(isset($_SESSION['user_id']))
        {
        ?>
        <li><a href="#"><i class="fa fa-user bg-aqua"></i>Profile</a></li>
        <li><a href="index.php?action=admin&page=change_password"><i class="fa fa-terminal bg-red"></i>Change Password</a></li>       
        <li><a href="index.php?action=admin&page=adduser"><i class="fa fa-plus bg-green"></i>Add User</a></li>
        <li><a href="index.php?action=pages&page=logout"><i class="fa fa-sign-out bg-teal"></i>Log out</a></li>
        <?php
        }
        ?>    
      </ul>
    </li>
  </ul>
</li>
<?php
} else {
?>
<li class="dropdown notifications-menu">
<a href="index.php?action=pages&page=login" class="dropdown notifications-menu"><b><i class="fa fa-sign-in"></i> Log in</b></a>
</li>
<?php
}
} //REMOTE
?>
