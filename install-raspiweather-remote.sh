#!/bin/bash
#EXIT ON COMMAND FAILS
set -e
## INSTALL SCRIPT FOR RASPIWEATHER

INSTALL_LOCATION="/apps/weather"

## CREATE USER WITHOUT PASSWORD
echo "Create weather user and installation directory =================================="
if id -u weather >/dev/null 2>&1
then
echo "User already created, skipping =================================================="
else
  adduser --home $INSTALL_LOCATION --shell /bin/bash --disabled-password -gecos "" weather
echo "Weather user created ============================================================"
  usermod -aG weather www-data
echo "User added to www-data group ===================================================="
fi
if [ ! -d $INSTALL_LOCATION/logs ]
then
  mkdir -p $INSTALL_LOCATION/logs
echo "Log directory created ==========================================================="
fi
if [ ! -d $INSTALL_LOCATION/tmp ]
then
  mkdir -p $INSTALL_LOCATION/tmp
echo "Tmp directory created ==========================================================="
fi
chown -R weather:weather $INSTALL_LOCATION

# MOVE FILES
echo "Move files to installation directory ============================================"
RASPIGIT=`pwd`
cp -R $RASPIGIT/. $INSTALL_LOCATION
chown -R weather:weather $INSTALL_LOCATION
echo "Move configuration.php to install directory ====================================="
cp  $INSTALL_LOCATION/configs/configuration-remote.php $INSTALL_LOCATION/configuration.php

## INSTALL PHP/NGINX CONFIGS
echo "Install PHP configuration ======================================================="
cp $INSTALL_LOCATION/configs/raspiweather.pool /etc/php5/fpm/pool.d/www.conf
cp $INSTALL_LOCATION/configs/raspiweather.phpini /etc/php5/fpm/php.ini
echo "Install Nginx configuration ====================================================="
cp $INSTALL_LOCATION/configs/raspiweather.nginx /etc/nginx/sites-available/raspiweather
echo "Remove default Nginx configuration =============================================="
DEFAULTNGINX="/etc/nginx/sites-enabled/default"
[[ -f "$DEFAULTNGINX" ]] && rm -f "$DEFAULTNGINX"
echo "Create link to new configuration ================================================"
DEFAULTNGINX="/etc/nginx/sites-enabled/raspiweather"
[[ ! -f "$DEFAULTNGINX" ]] && ln -s /etc/nginx/sites-available/raspiweather /etc/nginx/sites-enabled/raspiweather

## RELOAD NGINX/PHP
echo "Restart Nginx ==================================================================="
/etc/init.d/nginx restart
echo "Restart PHP ====================================================================="
/etc/init.d/php5-fpm restart

## COPY THE CONFIGURATION FILE INTO THE CORRECT LOCATION
cp $INSTALL_LOCATION/configs/configuration_remote.php $INSTALL_LOCATION/.
echo "Install basic configuration file ================================================"

## REMOVE OLD DIR
echo "Clean up old files =============================================================="
cd $INSTALL_LOCATION
rm -rf $RASPIGIT
chown -R weather:weather $INSTALL_LOCATION

GETCURIP=$(hostname -I)
echo "Installation complete ==========================================================="
echo "Now just configure the site for receiving remote data in "$INSTALL_LOCATION"/configuration.php"
echo "Wait up to 5-10 minutes for the page to update from a blank page"
