# iSpindel Generic TCP Server

#### (iSpindle.py Version 4.0)
[English Version](README_en.md)

**Update (27.11.24)
- Aktualisierte Installationsanleitung
- Kompatibilität mit Debian Bookworm 

**Update (17.12.22)
- Aktualisierte Installationsanleitung

**Neu (16.01.2021)
- Weitere Bugfix für Kalibrierung einer neuen Spindel behoben.
- Neues Rapsi image mit Änderung der DB Konfiguration: Zugriff auch von anderen hosts möglich
- Excel sheet zur Kalibrierung, dass Daten aus der Kalibriertabelle lesen un dauch zurückschreiben kann
- Neuer Downlodlink für Rapsi image inkl. Excel sheet: (https://mrhyde.spdns.eu:8081/share.cgi?ssid=0xOk17o) Link gültig bis 16.02.2021

**Neu (09.01.2021)
- Bugfix für Kalibrierung
- index.php testet, ob default values für Kalibriertabelle existieren.
	- Falls nicht, wir kalibriertabelle automatisch angepasst
	- Das kann später auch für Datenbank Upgrades erweitert werden, falls notwendig.
- Um das update zu nutzen, muss die update routine duchgeführt werden, wie sie in install.md beschrieben ist.

**Neu (03.01.2021)
- Überarbeitete Hilfe
- Home Button im Repo enthalten
- Zusätzliche Parameter beim Archiv zur automatischen Darstellung der Diagramme bei Wechsel der Auswahl (konfigurierbar)

**Neu (11.12.2020)
- KBH2 CSV export aus dem Archiv
- Bug Fix für Datenbankmigration von alter Datenbank (Automatische Erstellung der Archive Tabelle)
- Info auf index page wenn settings oder strings tabellen bei update aktualisiert werden müssen
- Neues Raspi Image zum Download 
	- ntp läuft jetzt und Zeit sollte automatisch syncronisiert werden
	- default python version ist nun python3 (kann über update-alternatives angepasst werden)

**Neu (05.12.2020)
- Detailiertere Installationsanleitung für Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_Raspi.md)
- Image für Raspi zum Download. 
- Möglichkeit zur Weiterleitung der Daten an Grainfather Connect (Für jede Spindel müssen individuelle Settings angelegt werden)
	- Noch nicht im Image enthalten, kann aber über git pull und Update der settings Datenbank aktualisiert werden

**Neu (20.11.2020)
- Aktualisierte [Installations Anleitung](INSTALL.md) für ubuntu (diese sollte mit leichten Anpassungen auch auf einer Raspberry laufen)
- Aktualiseirtes setup.php Skript das zunächst prüft, ob ausreichende Schreibrechte für das config Verzeichnis vorhanden sind.

**Neu (14.08.2020)
- Polynom 3. Grades kann nun auch verwendet werden.
- 'const0' wurde hierfür in Datenbank eingefügt
- index.php überprüft, ob const0 bei bestehender Datenbank vorhanden ist. Falls nicht, wird die Spalte automatisch in die Tabellen calibration und archive ergänzt
--> vor dem Upgrade sollte ein Backup der bestehenden DB gemacht werden

**Neu (16.06.2020)**
Dies ist ein major release mit vielen Änderungen.
- iSpindel.py und sendmail.py sind nun auf python3 lauffähig
	- Neue Funktionen oder Änderungen werden ab jetzt nur noch in den python3 versionen durchgeführt
	- Die alten versionen können auch noch die neusten Datenbankänderungen begleiten, werden aber in Zukunft nicht mehr aktualisiert.
	- Diese versionen sind iSpindel im Verzeichnis mit der Endung .py2 abgelegt
	- Es konnten bis jetzt leider nicht alle funktionen unter python3 getestet werden.
	- getestet: Empfang von iSpindel Daten, Weiterleitung an anderen TCP server, CraftBeerPi3
	- alle anderen forwards bis auf InfluxDB sollten theoretisch genauso wie Craftbeerpi3 funktionieren
	- Für InfluxDB benötige ich noch einen tester und ggf Hilfe
	- emanometer ist in iSpindel.py mit integriert (Jackfrost) -> Tabelle muss aber noch manuell angelegt werden.
- Settings und Strings tabellen für die Oberfläche können über den webbrowser geladen und aktualisiert werden.
- Individuelle Settings können aus dem webinterface gesichert und später wieder geladen werden
- Daten können aus der Weboberfläche gesichert und wieder importiert werden
- Archivfunktion, um auch alte Sude betrachten zu können.
	- Hierfür wird  eine weitere Tabelle benötigt.
	- Der Server kann die Datenbank selbst migrieren, wenn die Tabelle noch nicht vorhanden ist.
	- Dazu werden noch ein paar Spalten in der Datentabelle erstellt.
- Exportfunktion.
	- Aus dem Archiv können Daten als CSV File z.B. für Excel exportiert werden, um damit weiterzuarbeiten
	- Es können Gärdaten auch im beersmith csv Format exportiert werden und dann in beersmith (V3.1) importiert werden
- Oberfläche.
	- Zusammenfassung aller aktuellen Spindel Daten auf der index seite
	- y-Achsen Skalierung der Diagramme kann in den Settings individuell definiert werden 
	- 4 Themes (Farbschemata) können über die settings ausgewählt werden (Wasser, Hopfen, Malz und Raspberry)
- Setup Prozess der Datenbank
	- Ein Setupskript ist verfügbar, dass bei nicht vorhandener iSpindel Datenbank diese und einen Benutzer anlegt
	- Allerdings muss iSpindel und mysql oder mariadb, apache, python und der mysql.connector für python bereits korrekt installiert sein
	- Das manuelle erstellen der Datenbank über die sql files entfällt allerdings
- Einige Bugfixes .....

#### (iSpindle.py Version 1.6.3)
**Neu (20.06.2019)**
Merged avollkopf's fork.
Many thanks!

Documentation will be fully updated soon.

**Neu (28.04.2019)**
Neue Diagramme: Berechneter SVG, Alkoholgehalt; Delta Plato für bestimmten Zeitraum; Wifi/Batterytrend
Optimierte Landing page mit neuen Funktionen:
Möglichkeit der Vergabe eines Sudnamens beim Reset der entsprechendne SPindel im TCP server
Möglichkeit der Kalibrierung der Spindeln über das Web-Interface
Settings können nun auch per button über das Webinterface geändert werden
Mehrsprachiges Interface. Deutsch und Englisch bereits implementiert. Sollte recht einfach erweiterbar auf andere Sprachen sein.
Anzeige der PID des Servers in der Landing page.

**Neu (15.10.2018)**
Neue Diagramme: Moving Average (Glättung für angle.php und plato4.php, konfigurierbar)
"Landing Page" index.php - Die lang ersehnte Auswahlseite für iSpindeln und Diagramme.
Erreichbar über "http://myraspi/index.php" (je nach Konfiguration).
Am besten gleich einen Shortcut (Lesezeichen) erstellen.

**Neu (02.10.2018)**
CBP3 support (Dank an jlanger)     
Brewpiless support (Dank an ollinator2000)     
iSpindel Remote Configuration: Die iSpindel kann nun bestimmte Konfigurations Parameter empfangen.     
Momentan funktioniert das nur mit der "Intervall" Einstellung.     
Das Polynom und das Token können Server seitig bereits konfiguriert werden, diese werden aber von der momentanen Firmware Version (6.0.1) noch ignoriert.     
Benötigt wird auf jeden Fall Firmware 6.0.1 oder neuer.

**Neu (15.02.2018)**
Neues Diagramm wifi.php zeigt die zuletzt gemessene und übertragene Verbindungsqualität zum WLAN.        
angle.php, plato.php und plato4.php wurden erweitert um neue Parameter "days" und "weeks".        
Die Untertitel dieser Diagramme wurden angepasst, um dies zu reflektieren und deren Lesbarkeit zu erhöhen.      
3600 Stunden werden jetzt angezeigt als 21 Wochen, 3 Tage.     
Die Parameter können beliebig kombiniert werden.

**Neu (12.02.2018)**
iSpindle.py Version 1.4.0      
Angepasst an [Sam's iSpindel](https://github.com/universam1/iSpindel) Firmware 5.8 und aufwärts.      
Die nunmehr mitgesendeten Daten (Intervall, WLAN Empfangsqualität) werden jetzt mit abgefragt und in der Datenbank hinterlegt.
Alles sollte nach wie vor rückwärtskompatibel sein.
Im Debug Modus wird ein Hinweis ausgegeben, falls die iSpindel Firmware "veraltet" ist.
Bitte bei bestehenden Installationen die Datenbank anpassen und um die nötigen Felder erweitern, siehe MySQL_Update-3.sql Skript.

**Neu (20.01.2018)**     
iSpindle.py Version 1.3.3     
Neuer Parameter UBI_USE_ISPINDLE_TOKEN     
Die neue Version erlaubt das in der iSpindel Konfiguration vorgesehene Feld "Token" als Ubidots Token zu verwenden.     
Das im Skript global gesetzte Ubidots Token wird durch das in der iSpindel hinterlegte überschrieben, falls diese Option ausgewählt ist.     
Damit wird es möglich, nur die Daten einzelner iSpindeln weiterzuleiten oder einzelnen iSpindeln verschiedene Ubidots Token zuzuweisen.     
Um die Weiterleitung für einzelne iSpindeln zu unterdrücken, wird das Feld "Token" in der iSpindel Konfiguration leer gelassen, oder (falls das Feld für Kommentare etc. genutzt wird) mit einem Asterisk ("*") eingeleitet.     

**Neu (28.11.2017)**     
Interim Release.      
Diagramme benutzen jetzt die mysqli Library.      
Damit ist die Kompatibilität zu PHP7 (Debian/Raspbian Stretch) wieder hergestellt.      
Die Dokumentation wurde entsprechend angepasst.      
Die Änderungen sollten rückwärtskompatibel sein.      
Das neue Repo wurde in den Docs ebenfalls berücksichtigt.      

**Neu (27.09.2017)**  
update.sh: Skript für automatisches Update auf neue Versionen
update-raspi.sh: Skript für komplettes Update (Image/Debian/Raspbian)

**Neu (31.08.2017)**  
Kompatibel zu Firmware >= 5.4.x  
Optionale Weiterleitung zum öffentlichen Server bzw. weiteren lokalen (Raspi-) Server Instanzen implementiert  
Inkohärenz bei Legacy Plato Diagrammen (Version 4, serverseitiges Polynom) beseitigt  
Kleinere Fehler in den Diagrammen beseitigt (Legenden)  
Unix Dateizugriffsrechte angepasst  
Kleinere Bugfixes  

Update von bestehenden Versionen:
Bitte die [Installations Anleitung](INSTALL.md) beachten.

Ein neues Raspbian "Plug & Play" Image wird natürlich ebenfalls in den nächsten Tagen bereitgestellt.  
Hierzu bitte diesen Thread im Hobbybrauer Forum beobachten:
http://hobbybrauer.de/forum/viewtopic.php?f=58&t=12869

**Ältere News:**
**Neu: Diagramme, siehe:**
[Diagramme Readme](web/README.md)


Viel Spaß,     
Alex
