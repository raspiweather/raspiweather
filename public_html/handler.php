<?php
//REMOTE CHECK
require_once('../configuration.php');
if ($remote['is_remote'] != True)
{
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if ($_POST['action']=='admin' && $_POST['page']=='config') {

      $con = mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
      if (mysqli_connect_errno())
        { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
      //BEGIN CONFIG PARSING
      $config = "[config]".PHP_EOL;
      if (isset($_POST["ws_type"]) && !empty($_POST["ws_type"])){$config .= "ws type = ".$_POST["ws_type"]."".PHP_EOL;}
      if (isset($_POST["day_end"]) && !empty($_POST["day_end"])){$config .= "day end hour = ".$_POST["day_end"]."".PHP_EOL;}
      if (isset($_POST["pres_offset"]) && !empty($_POST["pres_offset"])){$config .= "pressure offset = ".$_POST["pres_offset"]."".PHP_EOL;}
      if (isset($_POST["gnu_encode"]) && !empty($_POST["gnu_encode"])){$config .= "gnuplot encoding = ".$_POST["gnu_encode"]."".PHP_EOL;}
      if (isset($_POST["temp_encode"]) && !empty($_POST["temp_encode"])){$config .= "template encoding = ".$_POST["temp_encode"]."".PHP_EOL;}
      if (isset($_POST["language"]) && !empty($_POST["language"])){$config .= "language = ".$_POST["language"]."".PHP_EOL;}
      if (isset($_POST["log_data"])){ if ($_POST["log_data"]=='0') { $config .= "logdata sync = 0".PHP_EOL;} else { $config .= "logdata sync = 1".PHP_EOL;}}
      if (isset($_POST["rain_thresh"]) && !empty($_POST["rain_thresh"])){$config .= "rain day threshold = ".$_POST["rain_thresh"]."".PHP_EOL;}
      if (isset($_POST["async"])){$config .= "asynchronous = True".PHP_EOL;} else {$config .= "asynchronous = False".PHP_EOL;}
      if (isset($_POST["usb_act"]) && !empty($_POST["usb_act"])){$config .= "usb activity margin = ".$_POST["usb_act"]."".PHP_EOL;}
      if (isset($_POST["gnu_version"]) && !empty($_POST["gnu_version"])){$config .= "gnuplot version = ".$_POST["gnu_version"]."".PHP_EOL;}
      if (isset($_POST["freq_writes"])){$config .= "frequent writes = True".PHP_EOL;} else {$config .= "frequent writes = False".PHP_EOL;}

      $config .= PHP_EOL."[paths]".PHP_EOL;
      if (isset($_POST["path_temp"]) && !empty($_POST["path_temp"])){$config .= "templates = ".$_POST["path_temp"]."".PHP_EOL;}
      if (isset($_POST["path_user"]) && !empty($_POST["path_user"])){$config .= "user_calib = ".$_POST["path_user"]."".PHP_EOL;}
      if (isset($_POST["path_work"]) && !empty($_POST["path_work"])){$config .= "work = ".$_POST["path_work"]."".PHP_EOL;}
      if (isset($_POST["path_local"]) && !empty($_POST["path_local"])){$config .= "local_files = ".$_POST["path_local"]."".PHP_EOL;}

      //SET PATH VARIABLES FROM POST
      $path_temp=$_POST['path_temp'];
      $path_user=$_POST['path_user'];
      $path_work=$_POST['path_work'];
      $path_local=$_POST['path_local'];
      $inactive_temps=0;

      //TEMPLATE PATH
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("INSERT INTO settings (setting_item,setting_value) VALUES ('templates',:path_temp) ON DUPLICATE KEY UPDATE setting_value=:path_temp");
      $stmt->bindParam(':path_temp', $path_temp, PDO::PARAM_STR);
      $stmt->execute();
      //USER CALIBRATION PATH
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("INSERT INTO settings (setting_item,setting_value) VALUES ('user_calib',:path_user) ON DUPLICATE KEY UPDATE setting_value=:path_user");
      $stmt->bindParam(':path_user', $path_user, PDO::PARAM_STR);
      $stmt->execute();
      //WORKING DIRECTORY PATH
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("INSERT INTO settings (setting_item,setting_value) VALUES ('work',:path_work) ON DUPLICATE KEY UPDATE setting_value=:path_work");
      $stmt->bindParam(':path_work', $path_work, PDO::PARAM_STR);
      $stmt->execute();
      //LOCAL FILES PATH
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("INSERT INTO settings (setting_item,setting_value) VALUES ('local_files',:path_local) ON DUPLICATE KEY UPDATE setting_value=:path_local");
      $stmt->bindParam(':path_local', $path_local, PDO::PARAM_STR);
      $stmt->execute();
      //SET ALL TEMPLATES TO INACTIVE BEFORE UPDATING CONFIG
      $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare("UPDATE templates SET active=:templates_active");
      $stmt->bindParam(':templates_active', $inactive_temps, PDO::PARAM_INT);
      $stmt->execute();

      if (isset($_POST["live_servs"])){
        $live_servs_val = "[";
        for ($i = 0; $i <= count($_POST["live_servs"]) - 1; $i++) {
            if ($i != (count($_POST["live_servs"]) - 1)){ $live_servs_val .= "'".$_POST["live_servs"][$i]."', ";
            } else { $live_servs_val .= "'".$_POST["live_servs"][$i]."'"; }
        }
        $live_servs_val .= "]";
      }

      $live_temp_val = "[";
      if (isset($_POST["live_temp"])){
        for ($i = 0; $i <= count($_POST["live_temp"]) - 1; $i++) {
            if ($i != (count($_POST["live_temp"]) - 1)){ $live_temp_val .= "'".$_POST["live_temp"][$i].".txt', ";
            } else { $live_temp_val .= "'".$_POST["live_temp"][$i].".txt'"; }
            $add_value=$_POST['live_temp'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }

      if (isset($_POST["live_twit"])){
        for ($i = 0; $i <= count($_POST["live_twit"]) - 1; $i++) {
            if ($i != (count($_POST["live_twit"]) - 1)){ $live_temp_val .= "'".$_POST["live_twit"][$i].".txt', ";
            } else { $live_temp_val .= "'".$_POST["live_twit"][$i].".txt'"; }
            $add_value=$_POST['live_twit'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }
      $live_temp_val = rtrim($live_temp_val, ",");
      $live_temp_val .= "]";

      $config .= PHP_EOL."[live]".PHP_EOL;
      if (isset($_POST["live_servs"]) && !empty($_POST["live_servs"])){$config .= "services = ".$live_servs_val."".PHP_EOL;}
      if (isset($_POST["live_temp"]) && !empty($_POST["live_temp"])){$config .= "text = ".$live_temp_val."".PHP_EOL;}
      if (isset($_POST["live_plot"]) && !empty($_POST["live_plot"])){$config .= "plot = ".$_POST["live_plot"]."".PHP_EOL;}

      if (isset($_POST["logged_servs"])){
        $logged_servs_val = "[";
        for ($i = 0; $i <= count($_POST["logged_servs"]) - 1; $i++) {
            if ($i != (count($_POST["logged_servs"]) - 1)){ $logged_servs_val .= "'".$_POST["logged_servs"][$i]."', ";
            } else { $logged_servs_val .= "'".$_POST["logged_servs"][$i]."'"; }
        }
        $logged_servs_val .= "]";
      }

      $logged_temp_val = "['forecast.txt','widgets.txt',";
      if (isset($_POST["logged_temp"])){

        for ($i = 0; $i <= count($_POST["logged_temp"]) - 1; $i++) {
            if ($i != (count($_POST["logged_temp"]) - 1)){ $logged_temp_val .= "'".$_POST["logged_temp"][$i].".txt',";
            } else { $logged_temp_val .= "'".$_POST["logged_temp"][$i].".txt',"; }
            $add_value=$_POST['logged_temp'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }

      if (isset($_POST["logged_twit"])){
        //$logged_temp_val = "[";
        for ($i = 0; $i <= count($_POST["logged_twit"]) - 1; $i++) {
            if ($i != (count($_POST["logged_twit"]) - 1)){ $logged_temp_val .= "('".$_POST["logged_twit"][$i].".txt', 'T'),";
            } else { $logged_temp_val .= "('".$_POST["logged_twit"][$i].".txt', 'T'),"; }
            $add_value=$_POST['logged_twit'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }
      $logged_temp_val = rtrim($logged_temp_val, ",");
      $logged_temp_val .= "]";

      $config .= PHP_EOL."[logged]".PHP_EOL;
      if (isset($_POST["logged_servs"]) && !empty($_POST["logged_servs"])){$config .= "services = ".$logged_servs_val."".PHP_EOL;}
      if (isset($_POST["logged_temp"]) && !empty($_POST["logged_temp"])){$config .= "text = ".$logged_temp_val."".PHP_EOL;} else {$config .= "text = ".$logged_temp_val."".PHP_EOL;}
      if (isset($_POST["logged_plot"]) && !empty($_POST["logged_plot"])){$config .= "plot = ".$_POST["logged_plot"]."".PHP_EOL;}

      if (isset($_POST["hour_servs"])){
        $hour_servs_val = "[";
        for ($i = 0; $i <= count($_POST["hour_servs"]) - 1; $i++) {
            if ($i != (count($_POST["hour_servs"]) - 1)){ $hour_servs_val .= "'".$_POST["hour_servs"][$i]."', ";
            } else { $hour_servs_val .= "'".$_POST["hour_servs"][$i]."'"; }
        }
        $hour_servs_val .= "]";
      }

      $hour_temp_val = "[";
      if (isset($_POST["hour_temp"])){
        for ($i = 0; $i <= count($_POST["hour_temp"]) - 1; $i++) {
            if ($i != (count($_POST["hour_temp"]) - 1)){ $hour_temp_val .= "'".$_POST["hour_temp"][$i].".txt', ";
            } else { $hour_temp_val .= "'".$_POST["hour_temp"][$i].".txt'"; }
            $add_value=$_POST['hour_temp'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }

      if (isset($_POST["hour_twit"])){
        for ($i = 0; $i <= count($_POST["hour_twit"]) - 1; $i++) {
            if ($i != (count($_POST["hour_twit"]) - 1)){ $hour_temp_val .= "'".$_POST["hour_twit"][$i].".txt', ";
            } else { $hour_temp_val .= "'".$_POST["hour_twit"][$i].".txt'"; }
            $add_value=$_POST['hour_twit'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }
      $hour_temp_val = rtrim($hour_temp_val, ",");
      $hour_temp_val .= "]";

      $config .= PHP_EOL."[hourly]".PHP_EOL;
      if (isset($_POST["hour_servs"]) && !empty($_POST["hour_servs"])){$config .= "services = ".$hour_servs_val."".PHP_EOL;}
      if (isset($_POST["hour_temp"]) && !empty($_POST["hour_temp"])){$config .= "text = ".$hour_temp_val."".PHP_EOL;}
      if (isset($_POST["hour_plot"]) && !empty($_POST["hour_plot"])){$config .= "plot = ".$_POST["hour_plot"]."".PHP_EOL;}

      if (isset($_POST["hour12_servs"])){
        $hour12_servs_val = "[";
        for ($i = 0; $i <= count($_POST["hour12_servs"]) - 1; $i++) {
            if ($i != (count($_POST["hour12_servs"]) - 1)){ $hour12_servs_val .= "'".$_POST["hour12_servs"][$i]."', ";
            } else { $hour12_servs_val .= "'".$_POST["hour12_servs"][$i]."'"; }
        }
        $hour12_servs_val .= "]";
      }

      $hour12_temp_val = "[";
      if (isset($_POST["hour12_temp"])){
        for ($i = 0; $i <= count($_POST["hour12_temp"]) - 1; $i++) {
            if ($i != (count($_POST["hour12_temp"]) - 1)){ $hour12_temp_val .= "'".$_POST["hour12_temp"][$i].".txt', ";
            } else { $hour12_temp_val .= "'".$_POST["hour12_temp"][$i].".txt'"; }
            $add_value=$_POST['hour12_temp'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
        $hour12_temp_val .= "]";
      }

      if (isset($_POST["hour12_twit"])){
        for ($i = 0; $i <= count($_POST["hour12_twit"]) - 1; $i++) {
            if ($i != (count($_POST["hour12_twit"]) - 1)){ $hour12_temp_val .= "'".$_POST["hour12_twit"][$i].".txt', ";
            } else { $hour12_temp_val .= "'".$_POST["hour12_twit"][$i].".txt'"; }
            $add_value=$_POST['hour12_twit'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }
      $hour12_temp_val = rtrim($hour12_temp_val, ",");
      $hour12_temp_val .= "]";

      $config .= PHP_EOL."[12 hourly]".PHP_EOL;
      if (isset($_POST["hour12_servs"]) && !empty($_POST["hour12_servs"])){$config .= "services = ".$hour12_servs_val."".PHP_EOL;}
      if (isset($_POST["hour12_temp"]) && !empty($_POST["hour12_temp"])){$config .= "text = ".$hour12_temp_val."".PHP_EOL;}
      if (isset($_POST["hour12_plot"]) && !empty($_POST["hour12_plot"])){$config .= "plot = ".$_POST["hour12_plot"]."".PHP_EOL;}

      if (isset($_POST["daily_servs"])){
        $daily_servs_val = "[";
        for ($i = 0; $i <= count($_POST["daily_servs"]) - 1; $i++) {
            if ($i != (count($_POST["daily_servs"]) - 1)){ $daily_servs_val .= "'".$_POST["daily_servs"][$i]."', ";
            } else { $daily_servs_val .= "'".$_POST["daily_servs"][$i]."'"; }
        }
        $daily_servs_val .= "]";
      }

      $daily_temp_val = "[";
      if (isset($_POST["daily_temp"])){
        for ($i = 0; $i <= count($_POST["daily_temp"]) - 1; $i++) {
            if ($i != (count($_POST["daily_temp"]) - 1)){ $daily_temp_val .= "'".$_POST["daily_temp"][$i].".txt', ";
            } else { $daily_temp_val .= "'".$_POST["daily_temp"][$i].".txt'"; }
            $add_value=$_POST['daily_temp'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }

      if (isset($_POST["daily_twit"])){
        for ($i = 0; $i <= count($_POST["daily_twit"]) - 1; $i++) {
            if ($i != (count($_POST["daily_twit"]) - 1)){ $daily_temp_val .= "'".$_POST["daily_twit"][$i].".txt', ";
            } else { $daily_temp_val .= "'".$_POST["daily_twit"][$i].".txt'"; }
            $add_value=$_POST['daily_twit'][$i];
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE templates SET active=1 WHERE id=:add_value");
            $stmt->bindParam(':add_value', $add_value, PDO::PARAM_STR);
            $stmt->execute();
        }
      }
      $daily_temp_val = rtrim($daily_temp_val, ",");
      $daily_temp_val .= "]";

      $config .= PHP_EOL."[daily]".PHP_EOL;
      if (isset($_POST["daily_servs"]) && !empty($_POST["daily_servs"])){$config .= "services = ".$daily_servs_val."".PHP_EOL;}
      if (isset($_POST["daily_temp"]) && !empty($_POST["daily_temp"])){$config .= "text = ".$daily_temp_val."".PHP_EOL;}
      if (isset($_POST["daily_plot"]) && !empty($_POST["daily_plot"])){$config .= "plot = ".$_POST["daily_plot"]."".PHP_EOL;}

      $config .= PHP_EOL."[ftp]".PHP_EOL;
      if (isset($_POST["ftp_local"]) && !empty($_POST["ftp_local"])){$config .= "local site = ".$_POST["ftp_local"]."".PHP_EOL;}
      if (isset($_POST["ftp_secure"]) && !empty($_POST["ftp_secure"])){$config .= "secure = ".$_POST["ftp_secure"]."".PHP_EOL;}
      if (isset($_POST["ftp_url"]) && !empty($_POST["ftp_url"])){$config .= "site = ".$_POST["ftp_url"]."".PHP_EOL;}
      if (isset($_POST["ftp_user"]) && !empty($_POST["ftp_user"])){$config .= "user = ".$_POST["ftp_user"]."".PHP_EOL;}
      if (isset($_POST["ftp_pass"]) && !empty($_POST["ftp_pass"])){$config .= "password = ".$_POST["ftp_pass"]."".PHP_EOL;}
      if (isset($_POST["ftp_directory"]) && !empty($_POST["ftp_directory"])){$config .= "directory = ".$_POST["ftp_directory"]."".PHP_EOL;}
      if (isset($_POST["ftp_port"]) && !empty($_POST["ftp_port"])){$config .= "port = ".$_POST["ftp_port"]."".PHP_EOL;}

      $config .= PHP_EOL."[Zambretti]".PHP_EOL;
      if (isset($_POST["zambretti_north"]) && !empty($_POST["zambretti_north"])){$config .= "north = ".$_POST["zambretti_north"]."".PHP_EOL;}
      if (isset($_POST["zambretti_upper"]) && !empty($_POST["zambretti_upper"])){$config .= "baro upper = ".$_POST["zambretti_upper"]."".PHP_EOL;}
      if (isset($_POST["zambretti_lower"]) && !empty($_POST["zambretti_lower"])){$config .= "baro lower = ".$_POST["zambretti_lower"]."".PHP_EOL;}

      $file = $weather_folder['data']."/weather.ini";
      file_put_contents($file, $config); //WRITE FILE CONTENTS

    }
    if ($_POST['action']=='admin' && $_POST['page']=='edit_template') {
      $con = mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
      // Check connection
      if (mysqli_connect_errno())
        { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }

        if (isset($_POST['delete'])){
          mysqli_query($con,"DELETE FROM templates WHERE `id`='".$_POST['template_id']."'");

          mysqli_close($con);

          $file = $settings_array['templates']."/".$_POST['template_id'].".txt";
          unlink($file);

        }

        if (isset($_POST['update'])){

          $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("UPDATE templates SET `interval`=:tempinterval, `type`=:temptype, `name`=:tempname, `file`=:tempfile, `chart`=:tempchart, `template_order`=:temporder WHERE `id`=:tempid");

          $tempinterval=$_POST['temp_interval'];

          $tempname=$_POST['temp_name'];
          $tempid=$_POST['template_id'];
          $tempfile=$_POST['template_id'];

          $temporder=$_POST['template_order'];
          $temptype=$_POST['temp_type'];

          $stmt->bindParam(':tempinterval', $tempinterval, PDO::PARAM_STR);
          $stmt->bindParam(':temptype', $temptype, PDO::PARAM_INT);
          $stmt->bindParam(':tempname', $tempname, PDO::PARAM_STR);
          $stmt->bindParam(':tempfile', $tempfile, PDO::PARAM_STR);
          $stmt->bindParam(':tempchart', $tempchart, PDO::PARAM_INT);
          $stmt->bindParam(':tempid', $tempid, PDO::PARAM_INT);
          $stmt->bindParam(':temporder', $temporder, PDO::PARAM_INT);

          $stmt->execute();
          $template_data = $_POST['temp_content'];
          $file = $settings_array['templates']."/".$_POST['template_id'].".txt";

          file_put_contents($file, $template_data); //WRITE FILE CONTENTS
        }

        if (isset($_POST['submit'])){
        //RE WRITE TO SUIT NEW TEMP_TYPE VARIABLE
          //if ($_POST['temp_type']==1) {
            mysqli_query($con,"INSERT INTO templates (`interval`, `type`, `name`) VALUES ('".$_POST['temp_interval']."', ".$_POST['temp_type'].", '".$_POST['temp_name']."')");
          //} else {
          //  mysqli_query($con,"INSERT INTO templates (`interval`, `type`, `name`) VALUES ('".$_POST['temp_interval']."', 0, '".$_POST['temp_name']."')");
          //}
          $template_id = mysqli_insert_id($con);
          mysqli_query($con,"UPDATE templates SET `file`='".$template_id."' WHERE `id`=".$template_id."");

          mysqli_close($con);

          $template_data = $_POST['temp_content'].PHP_EOL;
          $file = $settings_array['templates']."/".$template_id.".txt";

          file_put_contents($file, $template_data); //WRITE FILE CONTENTS
        }
          $_POST['page'] = 'template';
    }

    if ($_POST['action']=='admin' && $_POST['page']=='edit_widget') {

        if (isset($_POST['update'])){
          $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("UPDATE widgets SET widget_name=:widgetname, active=:widgetactive, widget_icon=:widgeticon, widget_text=:widgettext, widget_bg=:widgetbg, widget_order=:widgetorder WHERE id=:widgetid");

          $widgetname=$_POST['widget_name'];
          if (isset($_POST['active'])) {
          $widgetactive=1;
          } else {
          $widgetactive=0;
          }
          $widgeticon=$_POST['widget_icon'];
          $widgettext=$_POST['widget_text'];
          $widgetbg=$_POST['widget_bg'];
          $widgetorder=$_POST['widget_order'];
          $widgetid=$_POST['widget_id'];

          $stmt->bindParam(':widgetname', $widgetname, PDO::PARAM_STR);
          $stmt->bindParam(':widgetactive', $widgetactive, PDO::PARAM_INT);
          $stmt->bindParam(':widgeticon', $widgeticon, PDO::PARAM_STR);
          $stmt->bindParam(':widgettext', $widgettext, PDO::PARAM_STR);
          $stmt->bindParam(':widgetbg', $widgetbg, PDO::PARAM_STR);
          $stmt->bindParam(':widgetorder', $widgetorder, PDO::PARAM_INT);
          $stmt->bindParam(':widgetid', $widgetid, PDO::PARAM_INT);

          $stmt->execute();
        }

          $_POST['page'] = 'widgets';
    }

    if ($_POST['action']=='admin' && $_POST['page']=='site') {

        if (isset($_POST['submit'])){
          $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("UPDATE site_info SET site_value=:site_name WHERE site_item='site_name'; UPDATE site_info SET site_value=:site_colour WHERE site_item='site_colour'");
	  function truncate($string, $length = 20)
	    {
		if (strlen($string) <= intval($length)) {
		    return $string;
		}
		return substr($string, 0, $length);
	    }

          $site_name_val=$_POST['site_name'];
          $site_colour_val=$_POST['site_colour'];

          $stmt->bindParam(':site_name', truncate($site_name_val), PDO::PARAM_STR);
          $stmt->bindParam(':site_colour', truncate($site_colour_val), PDO::PARAM_STR);

          $stmt->execute();
        }
        elseif (isset($_POST['remote'])) {
          $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("UPDATE site_info SET site_value=:site_api WHERE site_item='site_api'; UPDATE site_info SET site_value=:site_remote WHERE site_item='site_remote'; UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_remote'");

          if (isset($_POST['site_remote_enable'])) {
            $cron_value="yes";
          } else {
            $cron_value="no";
          }

          $site_api=$_POST['site_api'];
          $site_remote=$_POST['site_remote'];
          $stmt->bindParam(':site_api', $site_api, PDO::PARAM_STR);
          $stmt->bindParam(':site_remote', $site_remote, PDO::PARAM_STR);
          $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_STR);

          $stmt->execute();
        }
        elseif (isset($_POST['refresh'])) {
          $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("UPDATE site_info SET site_value=:site_refresh WHERE site_item='site_refresh'");
          $stmt->bindParam(':site_refresh', $site_refresh, PDO::PARAM_STR);
          $stmt->execute();
        }

          $_POST['page'] = 'site';
    }

    if ($_POST['action']=='admin' && $_POST['page']=='service') {

              $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_service'");
              $cron_value="no";
              $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_INT);
              $stmt->execute();

              if (isset($_POST['start'])) {
                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_service'");
                            $cron_value="start";
                            $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_INT);
                            $stmt->execute();
              $_POST['page'] = 'service&type=start';
              }
              elseif (isset($_POST['restart'])) {
                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_service'");
                            $cron_value="restart";
                            $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_INT);
                            $stmt->execute();
              $_POST['page'] = 'service&type=restart';
              }
              elseif (isset($_POST['stop'])) {
                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_service'");
                            $cron_value="stop";
                            $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_INT);
                            $stmt->execute();
              $_POST['page'] = 'service&type=stop';
              }
              elseif (isset($_POST['update'])) {

		  if (isset($_POST['restartaftercrash'])) {
		  $cron_value="yes";
		  } else {
		  $cron_value="no";
		  }
                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("UPDATE cron SET cron_value=:cron_value WHERE cron_name='pywws_crash'");
                            $stmt->bindParam(':cron_value', $cron_value, PDO::PARAM_STR);
                            $stmt->execute();
              }
    }

    if ($_POST['action']=='admin' && $_POST['page']=='news') {

              if (isset($_POST['add_news'])) {
                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("INSERT INTO news (posted_by, news_subject, news_text, news_date) VALUES (:posted_by,:news_subject,:news_text,:news_date)");
                            $posted_by=$_POST['posted_by'];
                            $news_subject=$_POST['news_subject'];
                            $news_text=$_POST['news_text'];
                            $news_date=date('d M Y h:i a');
                            $stmt->bindParam(':posted_by', $posted_by, PDO::PARAM_STR);
                            $stmt->bindParam(':news_subject', $news_subject, PDO::PARAM_STR);
                            $stmt->bindParam(':news_text', $news_text, PDO::PARAM_STR);
                            $stmt->bindParam(':news_date', $news_date, PDO::PARAM_STR);
                            $stmt->execute();
              		    $_POST['action'] = 'pages';
              		    $_POST['page'] = 'news';
              }
              elseif (isset($_POST['edit_news'])) {

                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("UPDATE news SET posted_by=:posted_by, news_subject=:news_subject, news_text=:news_text, news_edit=:news_edit WHERE id=:news_id");
                            $posted_by=$_POST['posted_by'];
                            $news_subject=$_POST['news_subject'];
                            $news_text=$_POST['news_text'];
                            $news_edit=date('d M Y h:i a');
                            $news_id=$_POST['news_id'];
                            $stmt->bindParam(':posted_by', $posted_by, PDO::PARAM_STR);
                            $stmt->bindParam(':news_subject', $news_subject, PDO::PARAM_STR);
                            $stmt->bindParam(':news_text', $news_text, PDO::PARAM_STR);
                            $stmt->bindParam(':news_edit', $news_edit, PDO::PARAM_STR);
                            $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
                            $stmt->execute();
              		    $_POST['action'] = 'pages';
              		    $_POST['page'] = 'news';
              }
              elseif (isset($_POST['delete_news'])) {

                            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $dbh->prepare("DELETE FROM news  WHERE id=:news_id");
                            $news_id=$_POST['news_id'];
                            $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
                            $stmt->execute();
              		    $_POST['action'] = 'pages';
              		    $_POST['page'] = 'news';
              }
    }

  header('Location: index.php?action='.$_POST["action"].'&page='.$_POST["page"].'');
  } else {
  header('Location: index.php');
  }
} else {
  header('Location: index.php');
}
?>
