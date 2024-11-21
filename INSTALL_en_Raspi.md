# Installation Guide for Raspberry Pi (Raspbian)
### Step-by-Step

If the server has been already installed, you can perform an update with  sudo./update-raspi.sh in the server folder.

After installation of the system (tested with bookworm 64 bit full) I started to update it:

	sudo apt update
	sudo apt upgrade

I activated the ssh server to get access via raspi-config
I also configured the timezone to my needs (e.g. Europe/Berlin)
Optionally for German keyboard layout you also need go through raspi-config and use the localization options 
	
Then you need to install the git libraries that are required to clone the repo later:

	sudo apt-get install git-all

Then move to the home directory of the new user:

	cd /home/pi

And clone the repo:

	git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindel-Srv

Currently required until development branch is merged into main:

```
cd iSpindle-Srv
git checkout development
```


Install the apache server if it is not already installed on your system (not required for the afoementioned bookworm 64 bit full): 

	sudo apt-get install apache2

You also might need to install php as this is not automtically installed on recent images (also not required on bookworm 64 bit full):

	sudo apt-get install php8.2 libapache2-mod-php8.2 php8.2-mbstring php8.2-mysql php8.2-curl php8.2-gd php8.2-zip -y
	
You need to install MariaDB on the Raspi. 10.3 seems to be the most recent version as of today for the Raspi (Mysql should also work)

	sudo apt install mariadb-server

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

On my system python3 was installed. If this is not the case on your system you will need to install python3

Install the database connetor for python3:

	sudo pip install --break-system-packages mysql-connector-python

Install phpmyadmin:

	sudo apt-get install phpmyadmin

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
Call the webpage from your browser:

http://IPOFYOURSYSTEM/iSpindle/index.php

If the database is not configured setup.php should start automatically and database will be created.
You need to replace the Admin/Root databaes user with pi or the user you granted root access to the databse earlier.
Enter also the password you've choosen earlier for the user that has all privileges to the database
Then you just need to enter  name your iSpindle databse, then name of the user and the password (in case you want to change the defaults).
Once you hit ok, the database will be created and config files will be written accordingly to the config path.