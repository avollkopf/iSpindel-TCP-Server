-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2021 at 11:02 PM
-- Server version: 10.5.12-MariaDB-0+deb11u1
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iSpindle`
--

-- --------------------------------------------------------

--
-- Table structure for table `Settings`
--

CREATE TABLE `Settings` (
  `Section` varchar(64) CHARACTER SET utf8 NOT NULL,
  `Parameter` varchar(64) CHARACTER SET utf8 NOT NULL,
  `value` varchar(80) CHARACTER SET utf8 NOT NULL,
  `DEFAULT_value` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description_DE` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `Description_EN` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `Description_IT` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `DeviceName` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `Settings`
--

INSERT INTO `Settings` (`Section`, `Parameter`, `value`, `DEFAULT_value`, `Description_DE`, `Description_EN`, `Description_IT`, `DeviceName`) VALUES
('ADVANCED', 'ENABLE_ADDCOLS', '0', '0', 'Dynamische Spalten (nur für Entwickler)', 'Enable dynamic columns (do not use this unless you\'re a developer)', 'Abilita colonne dinamiche (non usare se non siete dei sviluppatori)', 'GLOBAL'),
('BREWFATHER', 'BREWFATHERADDR', 'log.brewfather.net', 'log.brewfather.net', 'IP Adresse des Brewfather Servers', 'IP Address of the Brewfather Server', 'INDIRIZZO IP del server Brewfather', '_DEFAULT'),
('BREWFATHER', 'BREWFATHERPORT', '80', '80', 'Port des Brewfather Servers', 'Port of Brewfather Server', 'Porta del server Brewfather', '_DEFAULT'),
('BREWFATHER', 'BREWFATHERSUFFIX', '[SG]', '[SG]', 'iSpindel polynom in ... ([SG] = relative Dichte, [PL] = plato)  ', 'iSpindle polynom set for ... ([SG] = specific gravity, [PL] = plato)', 'Polinomio iSpindle configurato per ... ([SG] = densità specifica, [PL] = plato)', '_DEFAULT'),
('BREWFATHER', 'BREWFATHER_TOKEN', 'mytoken', 'mytoken', 'Token für Brewfather Server', 'Token for Brewfather Server', 'Token per il server Brewfather', '_DEFAULT'),
('BREWFATHER', 'ENABLE_BREWFATHER', '0', '0', 'Weiterleitung an Brewfather', 'Forward to Brewfather', 'Inoltro a Brewfather', '_DEFAULT'),
('BREWFATHER', 'FAT_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Utilizzare il token sul iSpindle per l\'inoltro dati', '_DEFAULT'),
('BREWPILESS', 'BREWPILESSADDR', '0.0.0.0:80', '0.0.0.0:80', 'IPADRESSE:PORT des BrewPiLess Servers', 'IPADDRESS:PORT of the BrewPiLess Servers', 'INDIRIZZO_IP:PORTA del server BrewPiLess', '_DEFAULT'),
('BREWPILESS', 'ENABLE_BREWPILESS', '0', '0', 'Weiterleitung an BrewPiLess', 'Forward to BrewPiLess', 'Inoltro a BrewPiLess', '_DEFAULT'),
('BREWSPY', 'BREWSPYADDR', 'brew-spy.com', 'brew-spy.com', 'IP Adresse des BrewSpy Servers', 'IP Address of the BrewSpy Server', 'INDIRIZZO IP del server BrewSpy', '_DEFAULT'),
('BREWSPY', 'BREWSPYPORT', '80', '80', 'Port des BrewSpy Servers', 'Port of BrewSpy Server', 'Porta del server BrewSpy', '_DEFAULT'),
('BREWSPY', 'BREWSPY_TOKEN', 'mytoken', 'mytoken', 'Token für BrewSpy Server', 'Token for BrewSpy Server', 'Token per il server BrewSpy', '_DEFAULT'),
('BREWSPY', 'ENABLE_BREWSPY', '0', '0', 'Weiterleitung an BrewSpy', 'Forward to BrewSpy', 'Inoltro a BrewSpy', '_DEFAULT'),
('BREWSPY', 'SPY_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Utilizzare il token sul iSpindle per l\'inoltro dati', '_DEFAULT'),
('CRAFTBEERPI3', 'CRAFTBEERPI3ADDR', '0.0.0.0:5000', '0.0.0.0:5000', 'IPADRESSE:PORT des Craftbeerpi3 servers', 'IPADDRESS:PORT of the Craftbeerpi3 servers', 'INDIRIZZO_IP:PORTA del server Craftbeerpi3', '_DEFAULT'),
('CRAFTBEERPI3', 'CRAFTBEERPI3_SEND_ANGLE', '1', '1', 'Falls 1: Weiterleitung des Winkels anstelle der berechneten Gravity. CBPI3 kann dann gravity berechnen', 'If 1: raw angle will be send instead of gravity. Polynom inside craftbeerpi3 can be used for gravity calculation', 'Se 1: viene inviato il valore del angolo invece della densità.Il polinomio inserito in craftbeerpi3 può calcolare la densità', '_DEFAULT'),
('CRAFTBEERPI3', 'ENABLE_CRAFTBEERPI3', '0', '1', 'Weiterleitung an CraftbeerPI3', 'Enable forwarding to CraftbeerPi3', 'Inoltro a CraftbeerPI3', '_DEFAULT'),
('CSV', 'DATETIME', '1', '1', 'Ein Wert von 1 schreibt einen Excel kompatiblen Zeitstempel in das CSV file', 'Leave this at 1 to include Excel compatible timestamp in CSV', 'Se lasciato a 1 viene incluso un timestamp compatibile nel file CSV', 'GLOBAL'),
('CSV', 'DELIMITER', ';', ';', 'Trennzeichen, dass fuer CSV File genutzt wird', 'Delimiter used for CSV file', 'Separatore usato nel file CSV', 'GLOBAL'),
('CSV', 'ENABLE_CSV', '0', '0', 'Schreiben der Daten in CSV File (1: ja 0: nein)', 'Write Data to CSV file (1: yes 0: no)', 'Scrivere dati in un file CSV (1: si 0: no) ', '_DEFAULT'),
('CSV', 'NEWLINE', '\\r\\n', '\\r\\n', 'Zeichen fuer Zeilenumbruch', 'Newline characters', 'Caratteri Newline', 'GLOBAL'),
('CSV', 'OUTPATH', '/home/pi/iSpindle-srv/csv/', '/home/pi/iSpindle-srv/csv/', 'Pfad zum schreiben des CSV files. Der filename lautet dann name_id.csv', 'CSV output file path; filename will be name_id.csv', 'Percorso file per CSV; il nome del file sarà name_id.csv', '_DEFAULT'),
('DIAGRAM', 'ALCOHOL_Y_AXIS_MAX', '20', '20', 'Max Wert für y-Achse des Alkohol Diagrams', 'Max value for y-axis of the alcohol diagram', '', 'GLOBAL'),
('DIAGRAM', 'ALCOHOL_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Alkohol Diagrams', 'Min value for y-axis of the alcohol diagram', '', 'GLOBAL'),
('DIAGRAM', 'ANGLE_Y_AXIS_MAX', '75', '75', 'Max Wert für y-Achse des Winkel Diagrams', 'Max value for y-axis of the angle diagram', '', 'GLOBAL'),
('DIAGRAM', 'ANGLE_Y_AXIS_MIN', '15', '15', 'Min Wert für y-Achse des Winkel Diagrams', 'Min value for y-axis of the angle diagram', '', 'GLOBAL'),
('DIAGRAM', 'ARCHIVE_AUTO_CHANGE', '1', '1', 'Automatisches Laden der Daten bei Änderung der Archive / Diagramtyp Auswahl (1: an; 0: aus)', 'Automatic data reload if selection of archive / type changes (1: on; 0: off)', '', 'GLOBAL'),
('DIAGRAM', 'ARCHIVE_SORT', '0', '0', 'Sortierreihenfolge der Archivauswahl (1: Aufsteigend; 0: Absteigend)', 'Sort order for archive selection (1: up; 0: down)', '', 'GLOBAL'),
('DIAGRAM', 'BATTERY_Y_AXIS_MAX', '5', '5', 'Max Wert für y-Achse des Batterie Diagrams', 'Max value for y-axis of the battery diagram', '', 'GLOBAL'),
('DIAGRAM', 'BATTERY_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Batterie Diagrams', 'Min value for y-axis of the battery diagram', '', 'GLOBAL'),
('DIAGRAM', 'DELTA_Y_AXIS_MAX', '2', '2', 'Max Wert für y-Achse des Deta Diagrams', 'Max value for y-axis of the delta diagram', '', 'GLOBAL'),
('DIAGRAM', 'DELTA_Y_AXIS_MIN', '-5', '-5', 'Min Wert für y-Achse des Delta Diagrams', 'Min value for y-axis of the delta diagram', '', 'GLOBAL'),
('DIAGRAM', 'PLATO_Y_AXIS_MAX', '25', '25', 'Max Wert für y-Achse des Plato Diagrams', 'Max value for y-axis of the gravity diagram', '', 'GLOBAL'),
('DIAGRAM', 'PLATO_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Plato Diagrams', 'Min value for y-axis of the gravity diagram', '', 'GLOBAL'),
('DIAGRAM', 'RSSI_Y_AXIS_MAX', '0', '0', 'Max Wert für y-Achse des Wifi Signal Diagrams', 'Max value for y-axis of the WiFi signal diagram', '', 'GLOBAL'),
('DIAGRAM', 'RSSI_Y_AXIS_MIN', '-100', '-100', 'Min Wert für y-Achse des Wifi Signal Diagrams', 'Min value for y-axis of the WiFi signal diagram', '', 'GLOBAL'),
('DIAGRAM', 'SVG_Y_AXIS_MAX', '100', '100', 'Max Wert für y-Achse des Vergärungsgrades', 'Max value for y-axis of the attenuation diagram', '', 'GLOBAL'),
('DIAGRAM', 'SVG_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Vergärungsgrades', 'Min value for y-axis of the attenuation diagram', '', 'GLOBAL'),
('DIAGRAM', 'TEMPERATURE_Y_AXIS_MAX', '30', '30', 'Max Wert für y-Achse des Temperatur Diagrams', 'Max value for y-axis of the temperature diagram', '', 'GLOBAL'),
('DIAGRAM', 'TEMPERATURE_Y_AXIS_MIN', '-5', '-5', 'Min Wert für y-Achse des Temperatur Diagrams', 'Min value for y-axis of the temperature diagram', '', 'GLOBAL'),
('EMAIL', 'ALARMDELTA', '1', '1', 'Limit für Delta Plato Alarm. Ist die Änderung der letzten 12 Stunden ist, als diese Wert wird ein email Alarm gesendet.', 'Limit for Delta Plato alarm. If change within past 12 hours becomes lower, Alarm will be sent.', 'Limite delta allarme plato. Se nelle ultime 12 ore la variazione e inferiore, viene inviata una mail.', '_DEFAULT'),
('EMAIL', 'ALARMLOW', '4.5', '4.5', 'Gravity Limit (Plato) für Email Alarm (z.B. 4 -> Alarm, wenn Gravity unter 4 fällt)', 'Lower Gravity Limit for Email Alarm in case acutal gravity is below limit', 'Linite inferiore densità (plato) (p.es. 4 -> allarme quando densità scende al di sotto di quel valore) ', '_DEFAULT'),
('EMAIL', 'ALARMSVG', '60', '60', 'Vergärungsgrad Limit (%) für Email Alarm (z.B. 60 Alarm, wenn SVG 60 Prozent erreicht)', 'Limit for Email Alarm of apparent attenuation (e.g. 60 raises an alarm once apparent attenuation reaches 60 percent)', 'Limite superiore allarme attenuazione apparente (p.es. 60 -> allarme quando viene raggiunto il 60 per cento)', '_DEFAULT'),
('EMAIL', 'ENABLEALARMLOW', '1', '1', 'Sende email Alarm, wenn Gravity unter einen bestimmern Wert fällt (0:nein 1: ja)', 'Enable Alarm for low gravity', 'Abilita allarme in caso la densità scenda al di sotto di un valore impostato (0:no 1:si)', '_DEFAULT'),
('EMAIL', 'ENABLEALARMSVG', '1', '1', 'Sende email Alarm, wenn Vergärungsgrad oberhalb eines bestimmern Werts liegt (0:nein 1: ja)', 'Enable Alarm for apparent attenuation above threshhold value (0:no 1:yes)', 'Abilita allarme in caso l\'attenuazione apparente superi un valore impostato (0:no 1:si)', '_DEFAULT'),
('EMAIL', 'ENABLEDEBUG', '0', '0', 'Debug test email (0:nein 1-2: ja)', 'Debug test email (1-2: yes 0: no)', 'Email di test di debug (1-2: si 0: no)', 'GLOBAL'),
('EMAIL', 'ENABLEMAIL', '1', '1', 'Aktiviere Email Funktion für Device (0:nein 1: ja)', 'Activate email function for device (1: yes 0: no)', 'Attiva la funzione Email per dispositivo (1: si 0: no)', '_DEFAULT'),
('EMAIL', 'ENABLESTATUS', '1', '1', 'Sende tägliche Status Email (0:nein 1: ja)', 'Send daily status email (1: yes 0: no)', 'Abilita l\'Invio di una mail di stato giornaliera (1: si 0: no)', 'GLOBAL'),
('EMAIL', 'ENABLE_ALARMDELTA', '0', '0', 'Alarm, wenn Plato Veränderung innerhalb der letzten 12 Stunden unter limit fällt (An: 1)', 'Alarm for delta plato (On: 1) If change of plato within past 12 hours falls below setting, email alarm will be sent', 'Abilita allarme se il delta plato scende al di sotto un valore impostato nelle ultime 12 ore.', '_DEFAULT'),
('EMAIL', 'EXCLUDESTRING', 'XXX', 'XXX', 'Device Name mit Teilstring wird von Email Alarmen ausgeschlossen', 'Devicename with substring is excluded from Email alarms', 'Il nome devic con sottostringa è escluso dagli allarmi e-mail', 'GLOBAL'),
('EMAIL', 'FROMADDR', 'yourmail@gmail.com', 'yourmail@gmail.com', 'Email Adresse von der eine Nachricht versendet werden soll.', 'email, from which the ', 'Indirizzo email provenienza, inviato da ', 'GLOBAL'),
('EMAIL', 'PASSWD', 'yourpassword', 'yourpassword', 'SMTP Server Passwort', 'SMTP server password', 'Server SMTP password', 'GLOBAL'),
('EMAIL', 'SMTPPORT', '587', '587', 'SMTP Server Port (z.B. 587)', 'smpt server port', 'Porta SMTP server (p. es. 587)', 'GLOBAL'),
('EMAIL', 'SMTPSERVER', 'smtp.gmail.com', 'smtp.gmail.com', 'SMTP Server Adresse (z.B. smtp.gmail.com)', 'smtp server addresss', 'Indirizzo server SMTP', 'GLOBAL'),
('EMAIL', 'TIMEFRAMESTATUS', '3', '3', 'Zeitraum der letzten Datenübermittlung in Tagen, wenn ein Statusalarm gesendet werden soll', 'Timeframe in days when last spindel data was send and should be displayed.', 'Periodo in giorni dall\'ultimo invio di una mail di allarme', '_DEFAULT'),
('EMAIL', 'TIMESTATUS', '7', '7', 'Uhrzeit in vollen Stunden für tägliche Status Email (z.B. 6 fuer 6 Uhr morgens)', 'Set time for Status email around full hour. e.g. 6 means 6:00', 'Ora per l\'invio della mail di stato giornaliera p. es. 6 sono le 6:00', 'GLOBAL'),
('EMAIL', 'TOADDR', 'yourmail@gmail.com', 'yourmail@gmail.com', 'Email Adresse, an die eine Nachricht gesendet werden soll', 'email address to which the alarm email is sent', 'Indirizzo email a cui inviare la mail di stato/allarme', 'GLOBAL'),
('FERMENTRACK', 'ENABLE_FERMENTRACK', '0', '0', 'Weiterleitung der Daten an Fermentrack', 'Forward data to Fermentrack', 'Inoltro dati a Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACKADDR', '0.0.0.0', '0.0.0.0', 'IP Adresse des Fermentrack Servers', 'IP Address of the Fermentrack Server', 'Indirizzo IP del server Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACKPORT', '80', '80', 'Port des Fermentrack Servers', 'Port of Fermentrack Server', 'Porta del server Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACK_TOKEN', 'my_token', 'my_token', 'Token für Fermentrack Server', 'Token for Fermentrack Server', 'Token per server Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERM_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Uso del token che si trova sulla iSpindle per inoltrare dati', '_DEFAULT'),
('FORWARD', 'ENABLE_FORWARD', '0', '0', 'Weiterleitung der Daten an öffentlichen Server oder andere Instanz vom TCP Server', 'Forward to public server or other relay (i.e. another instance of this script)', 'Inoltro a server pubblico o altra istanza di un server TCP', '_DEFAULT'),
('FORWARD', 'FORWARDADDR', '0.0.0.0', '0.0.0.0', 'IP Adresse des anderen Servers', 'IP Adress of the other server', 'Indirizzo IP dell\'altro server', '_DEFAULT'),
('FORWARD', 'FORWARDPORT', '9501', '9501', 'Port des anderen Servers', 'Port of the remote server', 'Porta del server remoto', '_DEFAULT'),
('GENERAL', 'HOST', '0.0.0.0', '0.0.0.0', 'Erlaubter IP Bereich. 0.0.0.0 ermöglicht Verbindungen von überall', 'Allowed IP range. Leave at 0.0.0.0 to allow connections from anywhere', 'Gamma IP concessa. lasciare a 0.0.0.0 per permettere la connessione da ovunque', 'GLOBAL'),
('GENERAL', 'LANGUAGE', 'EN', 'DE', 'Verwendete Sprache (DE für Deutsch, EN for Englisch, IT für Italienisch)', 'Displayed Language (DE for German, EN for English, IT for Italian)', 'Lingua visualizzata (DE per tedesco, EN per inglese, IT per italiano)', 'GLOBAL'),
('GENERAL', 'PORT', '9501', '9501', 'Port zur Kommunikation zwischen Spindel und TCP Server (muss auch in der Spindel hinterlegt sein)', 'TCP Port to listen to (to be used in iSpindle config as well)', 'Porta TCP di communicazione (da impostare anche nella configurazione iSpindle)', 'GLOBAL'),
('GENERAL', 'SHOWSUMMARY', '1', '1', 'Anzeige von Device in der Übersicht auf der Hauptseite. (0: nein 1: ja)', 'Show device in summary on main page (0: no 1: yes)', 'Visualizzazione del dispositivo nella panoramica sulla pagina principale. (0: no 1: sì)', '_DEFAULT'),
('GRAINCONNECT', 'ENABLE_GRAINCONNECT', '0', '0', 'Weiterleitung an Grainfather Connect (muss für jede Spindel individuell angelegt werden)', 'Forward to Grainfather Connect (must be cofigured for individual spindles)', 'Inoltra a Grainfather Connect (deve essere configurato per i singoli spindle)', '_DEFAULT'),
('GRAINCONNECT', 'ENABLE_SG', '0', '0', 'Weiterleitung als SG (1) anstelle von Plato (0) (muss für jede Spindel individuell angelegt werden)', 'Forward as SG (1) instead of Plato (0) (must be cofigured for individual spindles)', 'Avanti come SG (1) invece di Plato (0) (deve essere configurato per i singoli spindle)', '_DEFAULT'),
('GRAINCONNECT', 'GRAINCONNECT_URL', '/URL', '/URL', 'Grainfather \'Server URL\'', 'Grainfather \'Server URL\'', 'Grainfather \'Server URL\'', '_DEFAULT'),
('INFLUXDB', 'ENABLE_INFLUXDB', '0', '0', 'Weiterleitung an InfluxDB', 'Forward to InfluxDB', 'Inoltro a InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBADDR', 'localhost', 'localhost', 'IP-Adresse/Name des InfluxDB-Servers', 'IP address/hostname of the InfluxDB Server', 'Indirizzo IP / nome del server InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBNAME', 'spindeldaten', 'spindeldaten', 'Name der Datenbank innerhalb von InfluxDB', 'Name of the database inside InfluxDB', 'Nome del database all\'interno di InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBPASSWD', 'secret', 'secret', 'Passwort des InfluxDB-Users', 'Password of the InfluxDB user', 'Password dell\'utente InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBPORT', '8086', '8086', 'Port des InfluxDB-Servers', 'Port of InfluxDB Server', 'Porta del server InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBUSERNAME', 'username', 'username', 'Userame für InfluxDB', 'User name for InfluxDB', 'Inoltro a InfluxDB', '_DEFAULT'),
('LAYOUT', 'COLORSCHEME_blue', '1', '1', 'Farbschema Wasser', 'Colorscheme Water', 'Colorscheme Water', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_green', '', '', 'Farbschema Hopfen', 'Colorscheme Hops', 'Colorscheme Hops', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_red', '', '', 'Farbschema Rot', 'Colorscheme Red', 'Colorscheme Red', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_wheat', '', '', 'Farbschema Malz', 'Colorscheme Grain', 'Colorscheme Grain', 'GLOBAL'),
('LITTLEBOCK', 'ENABLE_LITTLEBOCK', '0', '0', 'Weiterleitung der Daten an Little Bock (1: an 0: aus)', '1 to enable output to Little Bock', '1 per abilitare l\'inoltro a Little Bock ', '_DEFAULT'),
('LITTLEBOCK', 'LITTLEBOCKADDRESS', 'www.littlebock.fr', 'www.littlebock.fr', 'IP Address of the Little Bock server', 'IP Address of the Little Bock server', NULL, '_DEFAULT'),
('LITTLEBOCK', 'LITTLEBOCKURL', '/api/log/ispindle/XXX/YYY', '/api/log/ispindle/XXX/YYY', 'IP Address of the Little Bock server', 'url for specific iSpindle', NULL, '_DEFAULT'),
('REMOTECONFIG', 'ENABLE_REMOTECONFIG', '0', '0', 'Bei 1: Konfiguration wird vom TCP Server an die Spindel während eines Datentransfers gesendet (noch in der Testung)', 'If enabled, config from TCP server will be send to Spindle during data transfer once (still under testing)', 'Se abilitato, vengono scritti i dati di configurazione sulla Spindel durante un trasferimento (in fase di testing)', '_DEFAULT'),
('UBIDOTS', 'ENABLE_UBIDOTS', '0', '0', 'Weiterleitung der Daten an Ubidots (1: an 0: aus)', '1 to enable output to ubidots', '1 per abilitare l\'inoltro a ubidots ', '_DEFAULT'),
('UBIDOTS', 'UBI_TOKEN', 'my_token', 'my_token', 'UBIDOTS Token. Siehe Anleitung oder ubidots.com', 'global ubidots token, see manual or ubidots.com', 'Token ubidots vedi istruzioni o ubidots.com', '_DEFAULT'),
('UBIDOTS', 'UBI_USE_ISPINDLE_TOKEN', '0', '0', 'Benutzung des in der Spindel gespeicherten Tokens zur Weiterleitung an Ubidots ', '1 to use \"token\" field in iSpindle config (overrides UBI_TOKEN)', 'Utilizzo del token salvato nella iSpindle per l\'inoltro a ubidots', '_DEFAULT'),
('VERSION', '', '006', '006', NULL, NULL, NULL, 'GLOBAL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`Section`,`Parameter`,`value`,`DeviceName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
