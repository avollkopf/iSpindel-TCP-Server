# Installationsanleitung für Ubuntu
### Schritt-für-Schritt

[English Version] (INSTALL_en.md)
Installation auf Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_Raspi.md)

Sollte der Server bereits installiert sein, so kann man im Server Verzeichnis mit sudo./update.sh ein Update durchführen.

Bei mir läuft der Server in einem Ubuntu 16.04 Container auf meiner NAS. 

Nach der Installation des Systems habe ich zunächst ein Update durchgeführt:

	sudo apt-get update
	sudo apt-get upgrade

Da als Standard kein ssh server installiert war, habe ich den noch nachträglich installiert (optional, falls Zugriff über putty gewünscht ist):

	sudo apt-get install openssh-server
	
Dann müssen die git bibliotheken installiert werden, damit man das repo später klonen kann:

	sudo apt-get install git-all

Optional könnnen die deutschen locales mit den folgenden Kommandos installiert werden

	sudo locale-gen de_DE.UTF-8
	sudo update-locale LANG="de_DE.utf8" LANGUAGE="de:en" LC_ALL="de_DE.utf8"

Danach muss ein user'pi' erstellt werden. Das kann auch ein anderer nutzername sein. Aber dann müssen auch die späteren Schritte und das script ispindle-srv entsprechend dem Nutzernamen angepasst werden.

	sudo adduser pi 

Bei der Passwortabfrage kein Passwort für den Nutzer angeben
Danach in das Home Verzeichnis des angelegten Nutzers wechseln:

	cd /home/pi

Und das repo klonen:

	sudo git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindel-Srv

Falls nicht bereits auf dem System, muss nun der apache server isntalliert werden:

	sudo apt-get install apache2

Es ist auch nicht immer zwingend, dass php vorinstalliert ist. Somit muss auch php installiert werden:

	sudo apt-get install php7.4 libapache2-mod-php7.4 php7.4-mbstring php7.4-mysql php7.4-curl php7.4-gd php7.4-zip -y
	
Als Datenbank nutze ich MariaDB auf meinem System. Um MariaDB 10.5 zu installieren, muss das repo zur Installationsdatenbank hinzugefügt werden:

	sudo apt -y install software-properties-common gnupg-curl
	sudo apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc'

Der nächste Schritt ist nun für Ubuntu 16.04 spezifisch und muss für das entsprechende system angepasst werden, damit das korrekte repo verwendet wird:

	sudo add-apt-repository 'deb [arch=amd64,arm64,i386,ppc64el] http://mariadb.mirror.liquidtelecom.com/repo/10.5/ubuntu xenial main'

Dan muss ein update der Installationsdatanbank durchgeführt werden:

	sudo apt-get update

Und nun kann MariaDB installiert werden:

	sudo apt install mariadb-server mariadb-client

Die Datenbank muss konfiguriert werden:

	sudo mysql_secure_installation

Für den Root user der Datenbank muss ein Passwort eingegeben werden 

Auf meinem Container war Python 3 bereits mit installiert. Sollte das nicht der Fall sein, so muss das auch noch per apt-get gemacht werden

Die python3 bibliothek für die Datenbankverbindung muss noch installiert werden:

	sudo pip3 install mysql-connector-python==8.0.29

Hier ist es wichtig, dass die angegebene Version installiert wird, da es ab 8.0.30 Probleme mit der Verbindung gibt

phpmyadmin sollte installiert werden:

	sudo apt-get install phpmyadmin

Wenn zuvor der apache Web server installiert wurde muss hier auch apache2 als webserver ausgewählt werden.
Datenbank Konfiguration: Ja
Eingabe des zuvor definierten Root Passwortes für die Datenbnak.
Definition eine passworts für phpmyadmin.

Nun müssen die letzten Schritte zur Konfiguration noch durchgeführt werden (falls zuvor ein anderer username als pi gewählt wurde, müssen diese Schritte und das ispindle-srv script entsprechend angepasst werden):

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

UTF-8 sollte in php aktiviert werden, falls das nicht bereits der Fall ist. Auf meinem system ist die php.ini hier zu finden:

	cd /etc/php/7.0/apache2/

Das kann auf anderen System natürlich woanders unter /etc sein.

Die php.ini muss hierzu editiert werden und ein ';' am Anfang der folgenden Zeilt entfernt werden, falls es dort ist:

	;default_charset = "UTF-8"    ->  default_charset = "UTF-8"   

Nun müssen noch die Rechte im config Verzeichnis angepasst werden, damit das setup script eine Konfigurationsdatei erstellen kann:

	cd /home/pi/iSpindel-Srv

Die Gruppe des verzeichnisses muss dem des apache Nutzers entsprechen (Beispiel: www-data)

	sudo chown root:www-data config

Der Gruppe müssen für das Verzeichnis Schreibrechte erteilt werden:

	sudo chmod 775 config

Nun kann die Webesite des Servers aufgerufen werden:

http://IPOFYOURSYSTEM/iSpindle/index.php

Wenn die Datenbank nicht vorhanden ist, wird man automatisch zu enem setup.php script umgeleitet. Dieses kann dann die Datenbank automatisch erstellen.
Es muss lediglich das root Passwort der Datenbank eingegeben werden und man hat die Möglichkeit den Namen, User und das Passwort der Spindel Datenbank anzupassen.
Wenn dann die Eingaben bestätigt werden, erstellt das skript die Datenbank und erstellt die konfigurationsdateien für php und die python skripte
Sollten die Schreibrechte für das Konfigurationsfile nicht korrekt sein, so teilt das skript einem das im Vorfeld mit.





