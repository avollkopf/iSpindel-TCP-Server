# Installation Guide for Ubuntu 
### Step-by-Step

If the server has been already installed, you can perform an update with  sudo./update.sh in the server folder.

Installation on Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_en_Raspi.md)

I am running the server in an ubuntu 16.04 container environement on my NAS. 

After installation of the system I started to update it:

	sudo apt-get update
	sudo apt-get upgrade

Since I hade no access via ssh (through putty) I had to install the ssh server (optional):

	sudo apt-get install openssh-server
	
Then you need to install the git libraries that are required to clone the repo later:

	sudo apt-get install git-all
	
Optionally for German keyboard you need to run these commands 

	sudo locale-gen de_DE.UTF-8
	sudo update-locale LANG="de_DE.utf8" LANGUAGE="de:en" LC_ALL="de_DE.utf8"
	
Then you need to add a user called pi. This can be also a different user but then you will also need to change this in the later steps accordingly and you will need to change the user in the ispindle-srv script

	sudo adduser pi 

Don't enter a password for this user

Then move to the home directory of the new user:

	cd /home/pi

And clone the repo:

	sudo git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindel-Srv

Install the apache server if it is not already installed on your system:

	sudo apt-get install apache2

You also might need to install php as this is not automtically installed on recent images:

	sudo apt-get install php7.4 libapache2-mod-php7.4 php7.4-mbstring php7.4-mysql php7.4-curl php7.4-gd php7.4-zip -y
	
I am using MariaDB on my system. To install mariadb 10.5 you need to add the repo to the system:

	sudo apt -y install software-properties-common gnupg-curl
	sudo apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc'

This is specific for ubuntu 16.04 and has to be adapted for your system:

	sudo add-apt-repository 'deb [arch=amd64,arm64,i386,ppc64el] http://mariadb.mirror.liquidtelecom.com/repo/10.5/ubuntu xenial main'

Then run another update:

	sudo apt-get update

And install mariadb:

	sudo apt install mariadb-server mariadb-client

Configure the database:

	sudo mysql_secure_installation

Enter a password for the datase user root during the configuration

On my system python3 was installed. If this is not the case on your system you will need to install python3

Install the database connetor for python3:

	sudo pip3 install mysql-connector-python==8.0.29

Please note, that newer versions may cause an issue with the database connection.

Install phpmyadmin:

	sudo apt-get install phpmyadmin

Select apache2 as webserver if you installed this before.
Configure the database: yes 
enter database root password you have choosen during the mariadb installation
define a phpmyadmin password.

Now do the final steps (if your user is not pi, you need to adapt these steps accordingly and modify the ispindle-srv script):

	cd /home/pi/iSpindel-Srv
	sudo mv iSpindle.py /usr/local/bin
	sudo mv ispindle-srv /etc/init.d
	sudo chmod 755 /usr/local/bin/iSpindle.py
	sudo chmod 755 /etc/init.d/ispindle-srv
	sudo update-rc.d ispindle-srv defaults    

    cd /var/www/html    
    sudo ln -sf /home/pi/iSpindel-Srv/web/ iSpindle
    sudo chown -R pi:pi iSpindle/*
    sudo chown -h pi:pi iSpindle

You should activate UTF-8 charset handling if not already configured per default:
In my case the php.ini file is loacated here:

	cd /etc/php/7.0/apache2/

edit the php.ini file by removing the ';' if not already done:
	;default_charset = "UTF-8"    ->  default_charset = "UTF-8"   

Now change the rights of the config directory to give the web server group write-access:

	cd /home/pi/iSpindel-Srv
Change group of config file to apache user group (example www-data)

	sudo chown root:www-data config

Allow write access to config directory for group

	sudo chmod 775 config

Call the webpage from your browser:

http://IPOFYOURSYSTEM/iSpindle/index.php

If the database is not configured setup.php should start automatically and database will be created.
You just need to enter the root access to your database installation and how you want to name your iSpindle databse (in case you want to change the defaults.
Once you hit ok, the database will be created and config files will be written accordingly to the config path.






