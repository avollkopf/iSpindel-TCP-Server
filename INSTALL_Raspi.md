# Installationsanleitung für Raspberry Pi (Raspbian)
### Schritt-für-Schritt

[English Version] (INSTALL_en_Raspi.md)

Sollte der Server bereits installiert sein, so kann man im Server Verzeichnis mit sudo./update-raspi.sh ein Update durchführen.

Nach der Installation des Systems (ich habe z.B. Raaspian 32 bit lite verwendet) habe ich zunächst ein Update durchgeführt:

	sudo apt-get update
	sudo apt-get upgrade

Dann habe ich den ssh server vie raspi-config aktiviert.

Außerdem habe ich die Zeitzone via Raspi-config angepasst (z.B Europe/Berlin)
	
Dann müssen die git bibliotheken installiert werden, damit man das repo später klonen kann:

	sudo apt-get install git-all

Danach in das Home Verzeichnis des angelegten Nutzers wechseln:

	cd /home/pi

Und das repo klonen:

	sudo git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindle-Srv

Falls nicht bereits auf dem System, muss nun der apache server isntalliert werden (für das volle bookworm 64 bit nicht notwendig):

	sudo apt-get install apache2

Es ist auch nicht immer zwingend, dass php vorinstalliert ist. Somit muss auch php installiert werden (für das volle bookworm 64 bit nicht notwendig):

	sudo apt-get install php8.2 libapache2-mod-php8.2 php8.2-mbstring php8.2-mysql php8.2-curl php8.2-gd php8.2-zip -y
	
Als Datenbank habe ich MariaDB installiert.

	sudo apt install mariadb-server
	
Die Datenbank muss konfiguriert werden:

	sudo mysql_secure_installation

Für den Root user der Datenbank ggf ein Passwort eingeben.

Einen user Pi in der Datenbank anlegen (Passwort hier als Beispiel: 'PiSpindle'):
	
	sudo mysql --user=root mysql

	CREATE USER 'pi'@'localhost' IDENTIFIED BY 'PiSpindle';
	GRANT ALL PRIVILEGES ON *.* TO 'pi'@'localhost' WITH GRANT OPTION;
	FLUSH PRIVILEGES;
	QUIT;
 

Auf Raspbian lite war  Python 3 bereits mit installiert. Sollte das nicht der Fall sein, so muss das auch noch per apt-get gemacht werden

Die python3 bibliothek für die Datenbankverbindung muss noch installiert werden:

	sudo pip install --break-system-packages mysql-connector-python

!!!Hier ist es wichtig, dass die angegebene Version installiert wird, da es ab 8.0.30 Probleme mit der Verbindung gibt!!! -> Zu überprüfen

phpmyadmin sollte installiert werden:

	sudo apt-get install phpmyadmin

Wenn zuvor der apache Web server installiert wurde muss hier auch apache2 als webserver ausgewählt werden.
Datenbank Konfiguration: Ja
Eingabe des zuvor definierten Root Passwortes für die Datenbnak.
Definition eine passworts für phpmyadmin.

Nun müssen die letzten Schritte zur Konfiguration noch durchgeführt werden (falls zuvor ein anderer username als pi gewählt wurde, müssen diese Schritte und das ispindle-srv script entsprechend angepasst werden):

	cd /home/pi/iSpindle-Srv
	sudo mv iSpindle.py /usr/local/bin
	sudo mv sendmail.py /usr/local/bin
	!!!!To be changed !!!! sudo mv ispindle-srv /etc/init.d
	sudo chmod 755 /usr/local/bin/iSpindle.py
	sudo chmod 755 /usr/local/bin/sendmail.py
	!!!!To be changed !!!! sudo chmod 755 /etc/init.d/ispindle-srv
	!!!!To be changed !!!! sudo update-rc.d ispindle-srv defaults    

    sudo cp /home/pi/iSpindle-Srv/ /usr/share
    sudo chown -R root:www-data /usr/share/iSpindle-Srv/*
    sudo chown -h root:www-data /usr/share/iSpindle-Srv
	sudo chmod 775 /usr/share/iSpindle-Srv/config

UTF-8 sollte in php aktiviert werden, falls das nicht bereits der Fall ist. Auf meinem system ist die php.ini hier zu finden:

	cd /etc/php/8.2/apache2/

Das kann auf anderen System natürlich woanders unter /etc sein.

Die php.ini muss hierzu editiert werden und ein ';' am Anfang der folgenden Zeilt entfernt werden, falls es dort ist:

	;default_charset = "UTF-8"    ->  default_charset = "UTF-8"   


Der Gruppe müssen für das Verzeichnis Schreibrechte erteilt werden:

	sudo chmod 775 config

Nun kann die Webesite des Servers aufgerufen werden:

http://IPOFYOURSYSTEM/iSpindle/index.php

Wenn die Datenbank nicht vorhanden ist, wird man automatisch zu enem setup.php script umgeleitet. Dieses kann dann die Datenbank automatisch erstellen.
Es muss lediglich der admin/root username und passwort eingegeben werden, dem zuvor alle Privilegien für die Datenbank erteilt worden. Man hat auch die Möglichkeit den Namen, User und das Passwort der Spindel Datenbank anzupassen.
Wenn dann die Eingaben bestätigt werden, erstellt das skript die Datenbank und erstellt die konfigurationsdateien für php und die python skripte
Sollten die Schreibrechte für das Konfigurationsfile nicht korrekt sein, so teilt das skript einem das im Vorfeld mit.