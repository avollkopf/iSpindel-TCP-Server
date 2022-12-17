# Installation Guide for Raspberry Pi (Raspbian)
### Step-by-Step

If the server has been already installed, you can perform an update with  sudo./update-raspi.sh in the server folder.

After installation of the system (I was using Rasbpian lite) I started to update it:

	sudo apt-get update
	sudo apt-get upgrade

I activated the ssh server to get access via raspi-config
I also configured the timezone to my needs (e.g. Europe/Berlin)
Optionally for German keyboard layout you also need go through raspi-config and use the localization options 
	
Then you need to install the git libraries that are required to clone the repo later:

	sudo apt-get install git-all

Then move to the home directory of the new user:

	cd /home/pi

And clone the repo:

	sudo git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindel-Srv

Install the apache server if it is not already installed on your system:

	sudo apt-get install apache2

You also might need to install php as this is not automtically installed on recent images:

	sudo apt-get install php7.4 libapache2-mod-php7.4 php7.4-mbstring php7.4-mysql php7.4-curl php7.4-gd php7.4-zip -y
	
You need to install MariaDB on the Raspi. 10.3 seems to be the most recent version as of today for the Raspi (Mysql should also work)

	sudo apt install mariadb-server

Configure the database:

	sudo mysql_secure_installation

Enter a password for the datase user root during the configuration

Add a user Pi to the database that has all privileges to create also the iSpindle database during setup (Password as example here: 'PiSpindle'):
	
	sudo mysql --user=root mysql

	CREATE USER 'pi'@'localhost' IDENTIFIED BY 'PiSpindle';
	GRANT ALL PRIVILEGES ON *.* TO 'pi'@'localhost' WITH GRANT OPTION;
	FLUSH PRIVILEGES;
	QUIT;

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

	cd /etc/php/7.4/apache2/

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
You need to replace the Admin/Root databaes user with pi or the user you granted root access to the databse earlier.
Enter also the password you've choosen earlier for the user that has all privileges to the database
Then you just need to enter  name your iSpindle databse, then name of the user and the password (in case you want to change the defaults).
Once you hit ok, the database will be created and config files will be written accordingly to the config path.