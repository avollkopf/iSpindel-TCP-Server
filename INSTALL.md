# Installationsanleitung für Ubuntu
### Schritt-für-Schritt

[English Version] (INSTALL_en.md)
Installation auf Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_Raspi.md)

Sollte der Server bereits installiert sein, so kann man im Server Verzeichnis mit sudo./update.sh ein Update durchführen.

Bei mir läuft der Server in einem Debian 12 (bookworm) Container auf meiner NAS. 

Nach der Installation des Systems habe ich zunächst ein Update durchgeführt:

	apt update
	apt upgrade

Da als Standard kein ssh server installiert war, habe ich den noch nachträglich installiert (optional, falls Zugriff über putty gewünscht ist):

	apt install ssh
	
Dann müssen die git bibliotheken installiert werden, damit man das repo später klonen kann:

	apt install git-all

Optional könnnen die deutschen locales mit den folgenden Kommandos installiert werden. Ädert `/etc/locale.gen` und aktiviert die Sprache, die benötigt wird durch Entfernen des `#` vor eurer gewünschete Sprache.

Beispiel für `de_DE.utf8`

	locale-gen
	update-locale LANG="de_DE.utf8" LANGUAGE="de:de" LC_ALL="de_DE.utf8"


Es muss noch die korrekte Timezone für das System gesetzt werden. Das wird mit `tzselect` gemacht.
	
Danach muss ein user'pi' erstellt werden. Das kann auch ein anderer nutzername sein. Aber dann müssen auch die späteren Schritte und das script ispindle-srv entsprechend dem Nutzernamen angepasst werden.

	adduser pi 

Bei der Passwortabfrage kein Passwort für den Nutzer angeben
Danach in das Home Verzeichnis des angelegten Nutzers wechseln:

	cd /home/pi

Und das repo klonen:

	git clone https://github.com/avollkopf/iSpindel-TCP-Server iSpindle-Srv

Falls nicht bereits auf dem System, muss nun der apache server isntalliert werden (war beim bookworm image nicht notwendig):

	apt install apache2

Es ist auch nicht immer zwingend, dass php vorinstalliert ist. Somit muss auch php installiert werden. Bei meinem Image war es aber notwendig:

	apt install php8.2 libapache2-mod-php8.2 php8.2-mbstring php8.2-mysql php8.2-curl php8.2-gd php8.2-zip -y
	
MariaDB installieren:

	apt install mariadb-server

Die Datenbank muss konfiguriert werden:

	sudo mysql_secure_installation

Für den Root user der Datenbank muss ein Passwort eingegeben werden 

Einen user Pi in der Datenbank anlegen (Passwort hier als Beispiel: 'PiSpindle'):
	
	sudo mysql --user=root mysql

```
CREATE USER 'pi'@'localhost' IDENTIFIED BY 'PiSpindle';
GRANT ALL PRIVILEGES ON *.* TO 'pi'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
QUIT;
 ```

Im Container war python-requests und pip nicht installiert. Installation erfolgt mit

	apt install python3-pip
	apt install python3-requests


Die python3 bibliothek für die Datenbankverbindung muss noch installiert werden:

	pip install --break-system-packages mysql-connector-python


phpmyadmin sollte installiert werden:

	sudo apt-get install phpmyadmin

Wenn zuvor der apache Web server installiert wurde muss hier auch apache2 als webserver ausgewählt werden.
Datenbank Konfiguration: Ja
Eingabe des zuvor definierten Root Passwortes für die Datenbnak.
Definition eine passworts für phpmyadmin.

Nun müssen die letzten Schritte zur Konfiguration noch durchgeführt werden (falls zuvor ein anderer username als pi gewählt wurde, müssen diese Schritte und das ispindle-srv script entsprechend angepasst werden):

Zunächst müssen die ausführbaren files in ein anderes Verzeichnis kopiert werden und attribute entsprechend gesetzt werden:
```
cd /home/pi/iSpindle-Srv
sudo cp iSpindle.py /usr/local/bin
sudo cp sendmail.py /usr/local/bin
sudo chmod 755 /usr/local/bin/iSpindle.py
sudo chmod 755 /usr/local/bin/sendmail.py
```

Dann muss der Server als dienst registriert und gestartet werden:
```
sudo cp ispindle-srv.service /etc/systemd/system/
sudo systemctl enable ispindle-srv.service
sudo systemctl start ispindle-srv.service
```

Nun müssen die php scripte in ein Verzeichnes außerhalb des home directories kopiert werden und die Zugriffsrechte angepasst werden:
```
sudo cp -R /home/pi/iSpindle-Srv/ /usr/share
sudo chown -R root:www-data /usr/share/iSpindle-Srv/*
sudo chown -h root:www-data /usr/share/iSpindle-Srv
sudo chmod 775 /usr/share/iSpindle-Srv/config
```

Dann muss die Webseite im Apache Server registriert werden:
```
cd /etc/apache2/conf-available
sudo ln -sf /usr/share/iSpindle-Srv/config/apache.conf iSpindle.conf
sudo a2enconf iSpindle
sudo systemctl reload apache2
```

UTF-8 sollte in php aktiviert werden, falls das nicht bereits der Fall ist. Auf meinem system ist die php.ini hier zu finden:

	cd /etc/php/8.2/apache2/

Das kann auf anderen System natürlich woanders unter /etc sein.

Die php.ini muss hierzu editiert werden und ein ';' am Anfang der folgenden Zeilt entfernt werden, falls es dort ist:

	;default_charset = "UTF-8"`    ->  `default_charset = "UTF-8"

Ausserdem die Zeitzone für php einstellen (die gleiche, die oben für das system gewählt wurde)

	;date.timezone = -> date.timezone="Europe/Berlin" 

Für Euopa/Berlin als Beispiel

Dann apache2 noch einmal starten

	sudo systemctl restart apache2

Nun kann die Webesite des Servers aufgerufen werden:

http://IPOFYOURSYSTEM/iSpindle/index.php

Wenn die Datenbank nicht vorhanden ist, wird man automatisch zu enem setup.php script umgeleitet. Dieses kann dann die Datenbank automatisch erstellen.
Es muss lediglich der admin/root username und passwort eingegeben werden, dem zuvor alle Privilegien für die Datenbank erteilt worden. Man hat auch die Möglichkeit den Namen, User und das Passwort der Spindel Datenbank anzupassen.
Wenn dann die Eingaben bestätigt werden, erstellt das skript die Datenbank und erstellt die konfigurationsdateien für php und die python skripte
Sollten die Schreibrechte für das Konfigurationsfile nicht korrekt sein, so teilt das skript einem das im Vorfeld mit.