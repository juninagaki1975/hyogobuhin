#!/bin/bash

#Force install of missing deps
sudo apt-get -f install -o Dpkg::Options::="--force-overwrite"

#Remove the installed Apache 2
sudo apt-get purge apache2\*

#And followed by:
sudo apt-get purge mysql\*
sudo rm -rf /var/lib/mysql
sudo rm -rf /etc/mysql
sudo dpkg -l | grep -i mysql
sudo apt-get clean
sudo apt-get aut
sudo updatedb

#Reinstall full webstack if you want to.
sudo apt-get install lamp-server^
