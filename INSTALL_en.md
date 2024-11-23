# Installation Guide for Ubuntu 
### Step-by-Step

If the server has been already installed, you can perform an update with  sudo./update.sh in the server folder.

Installation on Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_en_Raspi.md)

I am running the server in a debian 12 (bookworm) container environement on my NAS. 

After installation of the system I started to update it:

	apt update
	apt upgrade

Since I hade no access via ssh (through putty) I had to install the ssh server (optional):

	apt install ssh
	
Then you need to install the git libraries that are required to clone the repo later:

	apt install git-all
	
Optionally for German keyboard you need to run these commands. Edit `/etc/locale.gen` and activate the language you want to acitvate by removing the `#` in front of your locale.

Example for `de_DE.utf8`

	locale-gen
	sudo update-locale LANG="de_DE.utf8" LANGUAGE="de:de" LC_ALL="de_DE.utf8"

Set the timezone for your system with `tzselect`.
	
Then you need to add a user called pi. This can be also a different user but then you will also need to change this in the later steps accordingly and you will need to change the user in the ispindle-srv script

	adduser pi 

Don't enter a password for this user

Then move to the home directory of the new user:

	cd /home/pi

And clone the repo:

	git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindle-Srv

Currently required until development branch is merged into main:

```
cd iSpindle-Srv
git checkout development
```

Install the apache server if it is not already installed on your system:

	apt install apache2

You also might need to install php as this is not automtically installed on recent images (I had to in the container evironment):

	apt install php8.2 libapache2-mod-php8.2 php8.2-mbstring php8.2-mysql php8.2-curl php8.2-gd php8.2-zip -y
	
Install mariadb:

	apt install mariadb-server

Configure the database:

	sudo mysql_secure_installation

Enter a password for the datase user root during the configuration

Add a user Pi to the database that has all privileges to create also the iSpindle database during setup (Password as example here: 'PiSpindle'):
	
	sudo mysql --user=root mysql

```
	CREATE USER 'pi'@'localhost' IDENTIFIED BY 'PiSpindle';
	GRANT ALL PRIVILEGES ON *.* TO 'pi'@'localhost' WITH GRANT OPTION;
	FLUSH PRIVILEGES;
	QUIT;
```

On my system python-requests and pip was not installed. Install it with

	apt install python3-pip
	apt install python3-requests


Install the database connetor for python3:

	pip install --break-system-packages mysql-connector-python

Please note, that newer versions may cause an issue with the database connection.

Install phpmyadmin:

	apt install phpmyadmin

Select apache2 as webserver if you installed this before.
Configure the database: yes 
enter database root password you have choosen during the mariadb installation
define a phpmyadmin password.

Now do the final steps (if your user is not pi, you need to adapt these steps accordingly and modify the ispindle-srv script):

In a first step you need to copy the executable files to a different directory and chnge the file attributes:
```
cd /home/pi/iSpindle-Srv
sudo cp iSpindle.py /usr/local/bin
sudo cp sendmail.py /usr/local/bin
sudo chmod 755 /usr/local/bin/iSpindle.py
sudo chmod 755 /usr/local/bin/sendmail.py
```

In the next step, the server needs to be registred and started as a service:
```
sudo cp ispindle-srv.service /etc/systemd/system/
sudo systemctl enable ispindle-srv.service
sudo systemctl start ispindle-srv.service
```

Now copy the php scripts to a different directory and adapt the access rights:
```
sudo cp -R /home/pi/iSpindle-Srv/ /usr/share
sudo chown -R root:www-data /usr/share/iSpindle-Srv/*
sudo chown -h root:www-data /usr/share/iSpindle-Srv
sudo chmod 775 /usr/share/iSpindle-Srv/config
```


Finally, you need to register the webpage in the apache server and reload the apache config:
```
cd /etc/apache2/conf-available
sudo ln -sf /usr/share/iSpindle-Srv/config/apache.conf iSpindle.conf
sudo a2enconf iSpindle
sudo systemctl reload apache2
```

You should activate UTF-8 charset handling if not already configured per default: In my case the php.ini file is loacated here:

	cd /etc/php/8.2/apache2/

edit the php.ini file by removing the ';' if not already done:
	;default_charset = "UTF-8"    ->  default_charset = "UTF-8"   

Adapt the timezone for php (use the same, you selected for the system above)

	;date.timezone = -> date.timezone="Europe/Berlin" 

As example for Europe/Berlin (Adapt it to your timezone)

Restart apache 

	sudo systemctl restart apache2


Call the webpage from your browser:

http://IPOFYOURSYSTEM/iSpindle/index.php

If the database is not configured setup.php should start automatically and database will be created.
You just need to enter the root access to your database installation and how you want to name your iSpindle databse (in case you want to change the defaults.
Once you hit ok, the database will be created and config files will be written accordingly to the config path.
