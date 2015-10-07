RasPiWeather
==============
RasPiWeather is a webfront end for PYWWS weather station software written by Jim Easterbrook.<br>
There aren't many nice looking interactive front ends for PYWWS template outputs. I set about creating my own, hopefully you like it too.<br>
Some features haven't been fully implemented yet, as I don't really use those features myself

Current Features
========
<b>Dashboard</b> - The main page presents a dashboard, which is the latest data pulled from the weather station.
It presents temperatures, humidty, pressure, wind speeds and rain fall.<br>
<b>Tables</b> - Basic tables to present time period specific information. The basic install comes with a few examples<br>
<b>Graphs</b> - Basic graphs to present time period specific information. The basic install comes with a few examples<br>
<b>Backup/Upload</b> - Ability to backup weather data for download, or upload historic data for import.<br>
<b>Service Status</b> - Ability to start/stop/restart the PYWWS service and view its status and logs. When logged in you are presented with the status in the notifcation bar<br>
<b>System Resources</b> - View system resources (mem, cpu, disk, etc..)<br>
<b>Theme</b> - Change the basic colour theme for the site<br>
<b>Template Editor</b> - Ability to create, and modify templates<br>
<b>PYWWS Config editor</b> - Edit PYWWS config on the fly for paths, templates in use, external services and ftp
Untested/Incomplete Features
====
<b>External services</b> - Untested and not fully completed integration into front end configuration<br>
<b>FTP</b> - Currently only works properly when set as local site. If you point to an external host, and try to load the site, it won't work. I am working on a way to support external hosts by creating a version of the site that doesn't require a database. This version of the site won't allow logins or the ability to control the services. Purely for displaying information externally.

<b>Note on charts:</b>
I haven't coded anything around the functionality with GNUPlot because the plots are quite outdated in styling in comparison to what alot of Javascript charts can produce.
If there is enough interest I could perhaps incorporate it, but personally I don't like them.<br>
Instead of GNUPlot, I have made use of HighchartsJS, mostly just basic configuration to maintain more symplistic template coding for end users to learn.
HighchartsJS can be found here (http://www.highcharts.com/) for full documentation if you wish to modify code.

Installation for Raspberry Pi
=============================
</b>NOTE!</b> Make sure you have confgured the date and time on your Raspberry Pi properly, and make sure you have expanded the filesystem with raspi-config.
Also make sure that any other web servers running are either not using port 80 or are disabled and stopped.

1. Install packages
```
sudo apt-get update
sudo apt-get install python-pip sysstat php-pear nginx php5-fpm php5-mysql php5-curl git
```

2. Install MySQL
```
sudo apt-get install mysql-server
```

3. Create the MySQL user for weather
```
mysql -uroot -p
CREATE DATABASE weather;
GRANT ALL ON weather.* TO 'weather'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
```

4. Clone the repo
```
git clone https://github.com/raspiweather/raspiweather.git ~/raspiweather; cd ~/raspiweather
```

5. Modify install script to specify installation location (location could be hardcoded in places)
```
nano install-raspiweather.sh
INSTALL_LOCATION="/apps/weather"
```
<b>If you changed the default install directory, perform steps 6 through 9</b><br>
<b>STEP 7 IS REQUIRED, MAKE SURE YOU UPDATE THE DATABASE PASSWORD TO WHAT WAS CONFIGURED IN STEP 3</b><br>
6. Edit nginx config
```
nano configs/raspiweather.nginx
```
```
access_log <INSTALLDIR>/logs/access.log;
error_log <INSTALLDIR>/logs/error.log;
root <INSTALLDIR>/public_html;
```

7. Modify configs/configuration.php with the database password from step 3 and installation directory
```
nano configuration.php
```
```
$database['host'] = "localhost";
$database['user'] = "weather";
$database['pass'] = "<DBUSERPASS>";
$database['name'] = "weather";
$weather_folder['install'] = "<INSTALLDIR>";
```
8. Edit sql/000_base_structure.sql to change installation directory
```
nano sql/000_base_structure.sql
INSERT INTO `settings` (`setting_item`, `setting_value`) VALUES
('templates', '<INSTALLDIR>/templates'),
('user_calib', '<INSTALLDIR>/calib'),
('work', '/tmp/weather'),
('local_files', '<INSTALLDIR>/public_html/data');
```

9. Edit configs/weather.ini
```
nano configs/weather.ini
```
```
[paths]
templates = <INSTALLDIR>/templates
work = /tmp/weather
local_files = <INSTALLDIR>/public_html/data
[ftp]
local site = True
directory = <INSTALLDIR>/public_html/data
```

10. Insert SQL file into database (enter weather user password when prompted)
```
mysql -uweather -p weather < sql/000_base_structure.sql
```

11. Execute installation script and follow prompts (this can take a few minutes)
```
sudo ./install-raspiweather.sh
```

12. If you plan to use twitter or SFTP you will need to install the following
<b>TWITTER IS NOT CURRENTLY SUPPORTED IN RASPIWEATHER CONFIGURATION</b>
```
sudo pip install python-twitter oauth2	## TWITTER
```
```
sudo pip install pycrypto paramiko	## SFTP
```

13. Test PYWWS
```
sudo pywws-testweatherstation
```

14. Set station interval to every 5 minutes (if you haven't done this previously)
```
sudo pywws-setweatherstation -r 5
```

15. Unplug and replug the weather station in.

16. Login to the front end, go to the service status page and click the START button to begin logging data. Initial start up could take some minutes before data gets logged.


Installation for Remote Sites / Host Your Own
=============================================

1. Install packages
```
sudo apt-get update
sudo apt-get install php-pear nginx php5-fpm php5-curl git
```

2. Clone the repo
```
git clone https://github.com/raspiweather/raspiweather.git ~/raspiweather; cd ~/raspiweather
```

3. Modify install script to specify installation location (location could be hardcoded in places)
```
nano install-raspiweather-remote.sh
INSTALL_LOCATION="/apps/weather"
```
<b>If you changed the default install directory, perform steps 6 through 9 (MAKE SURE YOU UPDATE THE DATABASE PASSWORD IN STEP 7)</b>

4. Edit nginx config
```
nano configs/raspiweather.nginx
```
```
access_log <INSTALLDIR>/logs/access.log;
error_log <INSTALLDIR>/logs/error.log;
root <INSTALLDIR>/public_html;
```

5. Execute installation script and follow prompts
```
sudo ./install-raspiweather-remote.sh
```

6. Modify ./configuration.php with your own API key and installation directory
```
nano configuration.php
```
```
$weather_folder['install'] = "<INSTALLDIR>";
$remote['api_key'] = 'putyourownapikeyhere';
```

7. Done


PYWWS
=====
http://jim-easterbrook.github.io/pywws/doc/en/html/index.html

Interface - AdminLTE
====================
https://github.com/almasaeed2010/AdminLTE

Weather Icons
=============
http://erikflowers.github.io/weather-icons/

All other by Ben Jackson 2014

Donations
=========
If you would like to donate to this project you can do so with bitcoin or litecoin

 Currency|Name|
 :-------------|:-----------
BTC|14MgMvkXv2hGLtcP6A3ZP3BysUukZTGFgC|
LTC|Lchh3oLkRQd4vo3MjkLcruVPcMhtxNWEap
