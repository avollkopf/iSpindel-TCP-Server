-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 21 2024 г., 23:00
-- Версия сервера: 10.11.6-MariaDB-0+deb12u1
-- Версия PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `iSpindle`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Settings`
--

CREATE TABLE `Settings` (
  `Section` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Parameter` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `DEFAULT_value` varchar(80) DEFAULT NULL,
  `Description_DE` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Description_EN` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Description_IT` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Description_RU` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `DeviceName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `Settings`
--

INSERT INTO `Settings` (`Section`, `Parameter`, `value`, `DEFAULT_value`, `Description_DE`, `Description_EN`, `Description_IT`, `Description_RU`, `DeviceName`) VALUES
('ADVANCED', 'ENABLE_ADDCOLS', '0', '0', 'Dynamische Spalten (nur für Entwickler)', 'Enable dynamic columns (do not use this unless you\'re a developer)', 'Abilita colonne dinamiche (non usare se non siete dei sviluppatori)', 'Разрешить динамические столбцы (только для разработчиков)', 'GLOBAL'),
('BREWFATHER', 'BREWFATHERADDR', 'log.brewfather.net', 'log.brewfather.net', 'IP Adresse des Brewfather Servers', 'IP Address of the Brewfather Server', 'INDIRIZZO IP del server Brewfather', 'IP-адрес сервера Brewfather', '_DEFAULT'),
('BREWFATHER', 'BREWFATHERPORT', '80', '80', 'Port des Brewfather Servers', 'Port of the Brewfather Server', 'Porta del server Brewfather', 'Порт сервера Brewfather', '_DEFAULT'),
('BREWFATHER', 'BREWFATHERSUFFIX', '[SG]', '[SG]', 'iSpindel polynom in ... ([SG] = relative Dichte, [PL] = plato)  ', 'iSpindle polynom set for ... ([SG] = specific gravity, [PL] = plato)', 'Polinomio iSpindle configurato per ... ([SG] = densità specifica, [PL] = plato)', 'Используемые единицы измерения плотности ([SG] = specific gravity, [PL] = plato)', '_DEFAULT'),
('BREWFATHER', 'BREWFATHER_TOKEN', 'mytoken', 'mytoken', 'Token für Brewfather Server', 'Token for Brewfather Server', 'Token per il server Brewfather', 'Токен для доступа к серверу Brewfather', '_DEFAULT'),
('BREWFATHER', 'ENABLE_BREWFATHER', '0', '0', 'Weiterleitung an Brewfather', 'Forward to Brewfather', 'Inoltro a Brewfather', 'Пересылка на сервер Brewfather (1 - включена, 0 - выключена)', '_DEFAULT'),
('BREWFATHER', 'FAT_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Utilizzare il token sul iSpindle per l\'inoltro dati', 'Использовать токен iSpindle для пересылки данных', '_DEFAULT'),
('BREWPILESS', 'BREWPILESSADDR', '0.0.0.0:80', '0.0.0.0:80', 'IPADRESSE:PORT des BrewPiLess Servers', 'IPADDRESS:PORT of the BrewPiLess Servers', 'INDIRIZZO_IP:PORTA del server BrewPiLess', 'IPADDRESS:PORT сервера BrewPiLess', '_DEFAULT'),
('BREWPILESS', 'ENABLE_BREWPILESS', '0', '0', 'Weiterleitung an BrewPiLess', 'Forward to BrewPiLess', 'Inoltro a BrewPiLess', 'Пересылка на сервер BrewPiLess (1 - включена, 0 - выключена)', '_DEFAULT'),
('BREWSPY', 'BREWSPYADDR', 'brew-spy.com', 'brew-spy.com', 'IP Adresse des BrewSpy Servers', 'IP Address of the BrewSpy Server', 'INDIRIZZO IP del server BrewSpy', 'IP-адрес сервера BrewSpy', '_DEFAULT'),
('BREWSPY', 'BREWSPYPORT', '80', '80', 'Port des BrewSpy Servers', 'Port of BrewSpy Server', 'Porta del server BrewSpy', 'Порт сервера BrewSpy', '_DEFAULT'),
('BREWSPY', 'BREWSPY_TOKEN', 'mytoken', 'mytoken', 'Token für BrewSpy Server', 'Token for BrewSpy Server', 'Token per il server BrewSpy', 'Токен для доступа к серверу BrewSpy', '_DEFAULT'),
('BREWSPY', 'ENABLE_BREWSPY', '0', '0', 'Weiterleitung an BrewSpy', 'Forward to BrewSpy', 'Inoltro a BrewSpy', 'Пересылка на сервер BrewSpy (1 - включена, 0 - выключена)', '_DEFAULT'),
('BREWSPY', 'SPY_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Utilizzare il token sul iSpindle per l\'inoltro dati', 'Использовать токен iSpindle для пересылки данных', '_DEFAULT'),
('CRAFTBEERPI3', 'CRAFTBEERPI3ADDR', '0.0.0.0:5000', '0.0.0.0:5000', 'IPADRESSE:PORT des Craftbeerpi3 servers', 'IPADDRESS:PORT of the Craftbeerpi3 servers', 'INDIRIZZO_IP:PORTA del server Craftbeerpi3', 'IPADDRESS:PORT сервера Craftbeerpi3', '_DEFAULT'),
('CRAFTBEERPI3', 'CRAFTBEERPI3_SEND_ANGLE', '1', '1', 'Falls 1: Weiterleitung des Winkels anstelle der berechneten Gravity. CBPI3 kann dann gravity berechnen', 'If 1: raw angle will be send instead of gravity. Polynom inside craftbeerpi3 can be used for gravity calculation', 'Se 1: viene inviato il valore del angolo invece della densità.Il polinomio inserito in craftbeerpi3 può calcolare la densità', '1 - Отправлять значение угла наклона вместо плотности. Плотность будет рассчитываться на сервере craftbeerpi3.', '_DEFAULT'),
('CRAFTBEERPI3', 'ENABLE_CRAFTBEERPI3', '0', '0', 'Weiterleitung an CraftbeerPI3', 'Enable forwarding to CraftbeerPi3', 'Inoltro a CraftbeerPI3', 'Пересылка на сервер CraftbeerPi3 (1 - включена, 0 - выключена)', '_DEFAULT'),
('CSV', 'DATETIME', '1', '1', 'Ein Wert von 1 schreibt einen Excel kompatiblen Zeitstempel in das CSV file', 'Leave this at 1 to include Excel compatible timestamp in CSV', 'Se lasciato a 1 viene incluso un timestamp compatibile nel file CSV', '1 - использовать совместимые с Excel метки времени', 'GLOBAL'),
('CSV', 'DELIMITER', ';', ';', 'Trennzeichen, dass fuer CSV File genutzt wird', 'Delimiter used for CSV file', 'Separatore usato nel file CSV', 'Разделитель для CSV-файлов', 'GLOBAL'),
('CSV', 'ENABLE_CSV', '1', '0', 'Schreiben der Daten in CSV File (1: ja 0: nein)', 'Write Data to CSV file (1: yes 0: no)', 'Scrivere dati in un file CSV (1: si 0: no) ', NULL, '_DEFAULT'),
('CSV', 'NEWLINE', '\\r\\n', '\\r\\n', 'Zeichen fuer Zeilenumbruch', 'Newline characters', 'Caratteri Newline', 'Символ перевода строки', 'GLOBAL'),
('CSV', 'OUTPATH', '/home/pi/csv/', '/home/pi/iSpindle-srv/csv/', 'Pfad zum schreiben des CSV files. Der filename lautet dann name_id.csv', 'CSV output file path; filename will be name_id.csv', 'Percorso file per CSV; il nome del file sarà name_id.csv', 'Директория для сохранения CSV-файлов; Имя файла имеет вид name_id.csv', '_DEFAULT'),
('DIAGRAM', 'ALCOHOL_Y_AXIS_MAX', '20', '20', 'Max Wert für y-Achse des Alkohol Diagrams', 'Max value for y-axis of the alcohol diagram', '', 'Максимальное значение по оси Y диаграммы содержания алкоголя', 'GLOBAL'),
('DIAGRAM', 'ALCOHOL_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Alkohol Diagrams', 'Min value for y-axis of the alcohol diagram', '', 'Минимальное значение по оси Y диаграммы содержания алкоголя', 'GLOBAL'),
('DIAGRAM', 'ANGLE_Y_AXIS_MAX', '75', '75', 'Max Wert für y-Achse des Winkel Diagrams', 'Max value for y-axis of the angle diagram', '', 'Максимальное значение по оси Y диаграммы угла наклона', 'GLOBAL'),
('DIAGRAM', 'ANGLE_Y_AXIS_MIN', '15', '15', 'Min Wert für y-Achse des Winkel Diagrams', 'Min value for y-axis of the angle diagram', '', 'Минимальное значение по оси Y диаграммы угла наклона', 'GLOBAL'),
('DIAGRAM', 'ARCHIVE_AUTO_CHANGE', '1', '1', 'Automatisches Laden der Daten bei Änderung der Archive / Diagramtyp Auswahl (1: an; 0: aus)', 'Automatic data reload if selection of archive / type changes (1: on; 0: off)', '', 'Автоматическая перезагрузка данных при изменении архива / типа (1 - да, 0 - нет)', 'GLOBAL'),
('DIAGRAM', 'ARCHIVE_SORT', '0', '0', 'Sortierreihenfolge der Archivauswahl (1: Aufsteigend; 0: Absteigend)', 'Sort order for archive selection (1: up; 0: down)', '', 'Порядок сортировки в архиве (1 - по возрастанию, 0 - по убыванию)', 'GLOBAL'),
('DIAGRAM', 'BATTERY_Y_AXIS_MAX', '5', '5', 'Max Wert für y-Achse des Batterie Diagrams', 'Max value for y-axis of the battery diagram', '', 'Максимальное значение по оси Y диаграммы состояния батареи', 'GLOBAL'),
('DIAGRAM', 'BATTERY_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Batterie Diagrams', 'Min value for y-axis of the battery diagram', '', 'Минимальное значение по оси Y диаграммы состояния батареи', 'GLOBAL'),
('DIAGRAM', 'DELTA_Y_AXIS_MAX', '2', '2', 'Max Wert für y-Achse des Deta Diagrams', 'Max value for y-axis of the delta diagram', '', 'Максимальное значение по оси Y диаграммы изменения плотности', 'GLOBAL'),
('DIAGRAM', 'DELTA_Y_AXIS_MIN', '-5', '-5', 'Min Wert für y-Achse des Delta Diagrams', 'Min value for y-axis of the delta diagram', '', 'Минимальное значение по оси Y диаграммы изменения плотности', 'GLOBAL'),
('DIAGRAM', 'PLATO_Y_AXIS_MAX', '25', '25', 'Max Wert für y-Achse des Plato Diagrams', 'Max value for y-axis of the gravity diagram', '', 'Максимальное значение по оси Y диаграммы плотности', 'GLOBAL'),
('DIAGRAM', 'PLATO_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Plato Diagrams', 'Min value for y-axis of the gravity diagram', '', 'Минимальное значение по оси Y диаграммы плотности', 'GLOBAL'),
('DIAGRAM', 'RSSI_Y_AXIS_MAX', '0', '0', 'Max Wert für y-Achse des Wifi Signal Diagrams', 'Max value for y-axis of the WiFi signal diagram', '', 'Максимальное значение по оси Y диаграммы уровня сигнала WiFi', 'GLOBAL'),
('DIAGRAM', 'RSSI_Y_AXIS_MIN', '-100', '-100', 'Min Wert für y-Achse des Wifi Signal Diagrams', 'Min value for y-axis of the WiFi signal diagram', '', 'Минимальное значение по оси Y диаграммы уровня сигнала WiFi', 'GLOBAL'),
('DIAGRAM', 'SVG_Y_AXIS_MAX', '100', '100', 'Max Wert für y-Achse des Vergärungsgrades', 'Max value for y-axis of the attenuation diagram', '', 'Максимальное значение по оси Y диаграммы аттенюации', 'GLOBAL'),
('DIAGRAM', 'SVG_Y_AXIS_MIN', '0', '0', 'Min Wert für y-Achse des Vergärungsgrades', 'Min value for y-axis of the attenuation diagram', '', 'Минимальное значение по оси Y диаграммы аттенюации', 'GLOBAL'),
('DIAGRAM', 'TEMPERATURE_Y_AXIS_MAX', '30', '30', 'Max Wert für y-Achse des Temperatur Diagrams', 'Max value for y-axis of the temperature diagram', '', 'Максимальное значение по оси Y диаграммы температуры', 'GLOBAL'),
('DIAGRAM', 'TEMPERATURE_Y_AXIS_MIN', '-5', '-5', 'Min Wert für y-Achse des Temperatur Diagrams', 'Min value for y-axis of the temperature diagram', '', 'Минимальное значение по оси Y диаграммы температуры', 'GLOBAL'),
('EMAIL', 'ENABLEMAIL', '0', '1', 'Aktiviere Email Funktion für Device (0:nein 1: ja)', 'Activate email function for device (1: yes 0: no)', 'Attiva la funzione Email per dispositivo (1: si 0: no)', 'Отправка уведомлений по e-mail (1 - да, 0 - нет)', 'GLOBAL'),
('EMAIL', 'FROMADDR', 'yourmail@gmail.com', 'yourmail@gmail.com', 'Email Adresse von der eine Nachricht versendet werden soll.', 'email, from which the ', 'Indirizzo email provenienza, inviato da ', 'E-mail, с которого будет вестись отправка уведомлений', 'GLOBAL'),
('EMAIL', 'PASSWD', 'yourpassword', 'yourpassword', 'SMTP Server Passwort', 'SMTP server password', 'Server SMTP password', 'Пароль SMTP', 'GLOBAL'),
('EMAIL', 'SMTPPORT', '587', '587', 'SMTP Server Port (z.B. 587)', 'smpt server port', 'Porta SMTP server (p. es. 587)', 'Порт сервера SMTP', 'GLOBAL'),
('EMAIL', 'SMTPSERVER', 'smtp.gmail.com', 'smtp.gmail.com', 'SMTP Server Adresse (z.B. smtp.gmail.com)', 'smtp server addresss', 'Indirizzo server SMTP', 'Адрес сервера SMTP', 'GLOBAL'),
('EMAIL', 'TOADDR', 'yourmail@gmail.com', 'yourmail@gmail.com', 'Email Adresse, an die eine Nachricht gesendet werden soll', 'email address to which the alarm email is sent', 'Indirizzo email a cui inviare la mail di stato/allarme', 'E-mail, на который будут отправляться уведомления', 'GLOBAL'),
('FERMENTRACK', 'ENABLE_FERMENTRACK', '0', '0', 'Weiterleitung der Daten an Fermentrack', 'Forward data to Fermentrack', 'Inoltro dati a Fermentrack', 'Пересылка на сервер Fermentrack (1 - включена, 0 - выключена)', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACKADDR', '0.0.0.0', '0.0.0.0', 'IP Adresse des Fermentrack Servers', 'IP Address of the Fermentrack Server', 'Indirizzo IP del server Fermentrack', 'IP-адрес сервера Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACKPORT', '80', '80', 'Port des Fermentrack Servers', 'Port of Fermentrack Server', 'Porta del server Fermentrack', 'Порт сервера Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERMENTRACK_TOKEN', 'my_token', 'my_token', 'Token für Fermentrack Server', 'Token for Fermentrack Server', 'Token per server Fermentrack', 'Токен для доступа к серверу Fermentrack', '_DEFAULT'),
('FERMENTRACK', 'FERM_USE_ISPINDLE_TOKEN', '0', '0', 'Verwendung des ISpindle Tokens zur Weiterleitung', 'Use token from iSpindle for data forwarding', 'Uso del token che si trova sulla iSpindle per inoltrare dati', 'Использовать токен iSpindle для пересылки данных (1 - да, 0 - нет)', '_DEFAULT'),
('FORWARD', 'ENABLE_FORWARD', '0', '0', 'Weiterleitung der Daten an öffentlichen Server oder andere Instanz vom TCP Server', 'Forward to public server or other relay (i.e. another instance of this script)', 'Inoltro a server pubblico o altra istanza di un server TCP', 'Пересылать данные на произвольный сервер (в т.ч другой экземпляр данного скрипта)', '_DEFAULT'),
('FORWARD', 'FORWARDADDR', '0.0.0.0', '0.0.0.0', 'IP Adresse des anderen Servers', 'IP Adress of the other server', 'Indirizzo IP dell\'altro server', 'IP-адрес сервера', '_DEFAULT'),
('FORWARD', 'FORWARDPORT', '9501', '9501', 'Port des anderen Servers', 'Port of the remote server', 'Porta del server remoto', 'Порт сервера', '_DEFAULT'),
('GENERAL', 'HOST', '0.0.0.0', '0.0.0.0', 'Erlaubter IP Bereich. 0.0.0.0 ermöglicht Verbindungen von überall', 'Allowed IP range. Leave at 0.0.0.0 to allow connections from anywhere', 'Gamma IP concessa. lasciare a 0.0.0.0 per permettere la connessione da ovunque', 'Разрешённые IP-адреса. Оставьте 0.0.0.0 для доступа с любого адреса.', 'GLOBAL'),
('GENERAL', 'LANGUAGE', 'RU', 'DE', 'Verwendete Sprache (DE für Deutsch, EN for Englisch, IT für Italienisch, RU für Russisch)', 'Displayed Language (DE for German, EN for English, IT for Italian, RU for Russian)', 'Lingua visualizzata (DE per tedesco, EN per inglese, IT per italiano, RU per russo)', 'Язык интерфейса (DE - немецкий, EN - английский, IT - итальянский, RU - русский)', 'GLOBAL'),
('GENERAL', 'PORT', '9501', '9501', 'Port zur Kommunikation zwischen Spindel und TCP Server (muss auch in der Spindel hinterlegt sein)', 'TCP Port to listen to (to be used in iSpindle config as well)', 'Porta TCP di communicazione (da impostare anche nella configurazione iSpindle)', 'Порт для подключения (указывается в настройках iSpindel)', 'GLOBAL'),
('GENERAL', 'SHOWSUMMARY', '1', '1', 'Anzeige von Device in der Übersicht auf der Hauptseite. (0: nein 1: ja)', 'Show device in summary on main page (0: no 1: yes)', 'Visualizzazione del dispositivo nella panoramica sulla pagina principale. (0: no 1: sì)', 'Отображать устройство на главной странице (1 - да, 0 - нет)', '_DEFAULT'),
('GRAINCONNECT', 'ENABLE_GRAINCONNECT', '0', '0', 'Weiterleitung an Grainfather Connect (muss für jede Spindel individuell angelegt werden)', 'Forward to Grainfather Connect (must be cofigured for individual spindles)', 'Inoltra a Grainfather Connect (deve essere configurato per i singoli spindle)', 'Пересылка на сервер Grainfather Connect (1 - включена, 0 - выключена) (требуется настройка для каждого iSpindel индивидуально)', '_DEFAULT'),
('GRAINCONNECT', 'ENABLE_SG', '1', '0', 'Weiterleitung als SG (1) anstelle von Plato (0) (muss für jede Spindel individuell angelegt werden)', 'Forward as SG (1) instead of Plato (0) (must be cofigured for individual spindles)', 'Avanti come SG (1) invece di Plato (0) (deve essere configurato per i singoli spindle)', 'Единицы измерения плотности (1 - SG, 0 - Plato) (требуется настройка для каждого iSpindel индивидуально)', '_DEFAULT'),
('GRAINCONNECT', 'GRAINCONNECT_INTERVAL', '900', '900', 'Grainfather Intervall zum Senden von Datenpaketen', 'Grainfather interval for sending data packages', 'Grainfather intervallo per l\'invio di pacchetti di dati', 'Период между отправками данных', '_DEFAULT'),
('GRAINCONNECT', 'GRAINCONNECT_LASTSENT', '2024-10-02 23:39:11', '0', 'Grainfather Zeitstempel des letzten gesendeten Datenpaketen', 'Grainfather timestamp of last package sent', 'Grainfather timestamp dell\'ultimo pacchetti di dati inviato', 'Метка времени последнего отправленного на сервер Grainfather пакета данных', '_DEFAULT'),
('GRAINCONNECT', 'GRAINCONNECT_URL', '/URL', '/URL', 'Grainfather \'Server URL\'', 'Grainfather \'Server URL\' (blank to use URLSLUG instead', 'Grainfather \'Server URL\'', '\'URL сервера\' Grainfather (оставьте пустым для использования URLSLUG)', '_DEFAULT'),
('GRAINCONNECT', 'GRAINCONNECT_URLSLUG', 'URLSLUG', 'url-slug', 'Grainfather \'Server URL\' stück für /iot/[url-slug]/ispindel', 'Grainfather \'Server URL\' part for /iot/[url-slug]/ispindel', 'Grainfather \'Server URL\'', 'Grainfather \'Server URL\' part for /iot/[url-slug]/ispindel', '_DEFAULT'),
('INFLUXDB', 'ENABLE_INFLUXDB', '0', '0', 'Weiterleitung an InfluxDB', 'Forward to InfluxDB', 'Inoltro a InfluxDB', 'Пересылка на сервер InfluxDB (1 - включена, 0 - выключена)', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBADDR', 'localhost', 'localhost', 'IP-Adresse/Name des InfluxDB-Servers', 'IP address/hostname of the InfluxDB Server', 'Indirizzo IP / nome del server InfluxDB', 'IP-адрес сервера InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBNAME', 'spindeldaten', 'spindeldaten', 'Name der Datenbank innerhalb von InfluxDB', 'Name of the database inside InfluxDB', 'Nome del database all\'interno di InfluxDB', 'Имя БД', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBPASSWD', 'secret', 'secret', 'Passwort des InfluxDB-Users', 'Password of the InfluxDB user', 'Password dell\'utente InfluxDB', 'Пароль пользователя InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBPORT', '8086', '8086', 'Port des InfluxDB-Servers', 'Port of InfluxDB Server', 'Porta del server InfluxDB', 'Порт сервера InfluxDB', '_DEFAULT'),
('INFLUXDB', 'INFLUXDBUSERNAME', 'username', 'username', 'Userame für InfluxDB', 'User name for InfluxDB', 'Inoltro a InfluxDB', 'Имя пользователя InfluxDB', '_DEFAULT'),
('LAYOUT', 'COLORSCHEME_blue', '', '1', 'Farbschema Wasser', 'Colorscheme Water', 'Colorscheme Water', 'Цветовая гамма \"Вода\"', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_green', '1', '', 'Farbschema Hopfen', 'Colorscheme Hops', 'Colorscheme Hops', 'Цветовая гамма \"Хмель\"', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_red', '', '', 'Farbschema Rot', 'Colorscheme Red', 'Colorscheme Red', 'Цветовая гамма \"Красная\"', 'GLOBAL'),
('LAYOUT', 'COLORSCHEME_wheat', '', '', 'Farbschema Malz', 'Colorscheme Grain', 'Colorscheme Grain', 'Цветовая гамма \"Солод\"', 'GLOBAL'),
('LITTLEBOCK', 'ENABLE_LITTLEBOCK', '0', '0', 'Weiterleitung der Daten an Little Bock (1: an 0: aus)', '1 to enable output to Little Bock', '1 per abilitare l\'inoltro a Little Bock ', 'Пересылка на сервер Little Bock (1 - включена, 0 - выключена)', '_DEFAULT'),
('LITTLEBOCK', 'LITTLEBOCKADDRESS', 'www.littlebock.fr', 'www.littlebock.fr', 'IP Address of the Little Bock server', 'IP Address of the Little Bock server', NULL, 'Адрес сервера Little Bock ', '_DEFAULT'),
('LITTLEBOCK', 'LITTLEBOCKURL', '/api/log/ispindle/XXX/YYY', '/api/log/ispindle/XXX/YYY', 'IP Address of the Little Bock server', 'url for specific iSpindle', NULL, 'путь к каталогу определённого iSpindel', '_DEFAULT'),
('MESSAGING', 'ALARMDELTA', '1', '1', 'Limit für Delta Plato Alarm. Ist die Änderung der letzten 12 Stunden ist, als diese Wert wird ein Message Alarm gesendet.', 'Limit for Delta Plato alarm. If change within past 12 hours becomes lower, Alarm will be sent.', 'Limite delta allarme plato. Se nelle ultime 12 ore la variazione e inferiore, viene inviata una message.', 'Уведомлять, если изменение плотности за 12 часов меньше указанного значения.', '_DEFAULT'),
('MESSAGING', 'ALARMLOW', '4.5', '4.5', 'Gravity Limit (Plato) für Message Alarm (z.B. 4 -> Alarm, wenn Gravity unter 4 fällt)', 'Lower Gravity Limit for message Alarm in case acutal gravity is below limit', 'Linite inferiore densità (plato) (p.es. 4 -> allarme quando densità scende al di sotto di quel valore) ', 'Уведомлять, когда КП опустилась ниже указанного значения', '_DEFAULT'),
('MESSAGING', 'ALARMSVG', '60', '60', 'Vergärungsgrad Limit (%) für Message Alarm (z.B. 60 Alarm, wenn SVG 60 Prozent erreicht)', 'Limit for message Alarm of apparent attenuation (e.g. 60 raises an alarm once apparent attenuation reaches 60 percent)', 'Limite superiore allarme attenuazione apparente (p.es. 60 -> allarme quando viene raggiunto il 60 per cento)', 'Уведомлять, когда видимая аттенюация превышает указанное значение', '_DEFAULT'),
('MESSAGING', 'ENABLEALARMLOW', '0', '1', 'Sende Message Alarm, wenn Gravity unter einen bestimmern Wert fällt (0:nein 1: ja)', 'Enable Alarm for low gravity', 'Abilita allarme in caso la densità scenda al di sotto di un valore impostato (0:no 1:si)', 'Включить отправку уведомлений о достижении заданной КП (1 - да, 0 - нет)', '_DEFAULT'),
('MESSAGING', 'ENABLEALARMSVG', '0', '1', 'Sende message Alarm, wenn Vergärungsgrad oberhalb eines bestimmern Werts liegt (0:nein 1: ja)', 'Enable Alarm for apparent attenuation above threshhold value (0:no 1:yes)', 'Abilita allarme in caso l\'attenuazione apparente superi un valore impostato (0:no 1:si)', 'Включить отправку уведомлений о достижении заданной видимой аттенюации (1 - да, 0 - нет)', '_DEFAULT'),
('MESSAGING', 'ENABLEMESSAGE', '0', '1', 'Aktiviere Message Funktion für Device (0:nein 1: ja)', 'Activate message function for device (1: yes 0: no)', 'Attiva la funzione message per dispositivo (1: si 0: no)', 'Включить отправку уведомлений (1 - да, 0 - нет)', '_DEFAULT'),
('MESSAGING', 'ENABLESTATUS', '0', '0', 'Sende tägliche Status Message (0:nein 1: ja))', 'Send daily status message (1: yes 0: no)', 'Abilita l\'Invio di una message di stato giornaliera (1: si 0: no)', 'Включить ежедневную отправку сообщений о текущем состоянии', 'GLOBAL'),
('MESSAGING', 'ENABLE_ALARMDELTA', '0', '0', 'Alarm, wenn Plato Veränderung innerhalb der letzten 12 Stunden unter limit fällt (An: 1)', 'Alarm for delta plato (On: 1) If change of plato within past 12 hours falls below setting, email alarm will be sent', 'Abilita allarme se il delta plato scende al di sotto un valore impostato nelle ultime 12 ore.', 'Включить уведомление об изменении плотности за 12ч', '_DEFAULT'),
('MESSAGING', 'EXCLUDESTRING', 'XXX', 'XXX', 'Device Name mit Teilstring wird von Message Alarmen ausgeschlossen', 'Devicename with substring is excluded from message alarms', 'Il nome devic con sottostringa è escluso dagli allarmi message', 'Отключить уведомления для устройств, содержащих в имени указанное значение', 'GLOBAL'),
('MESSAGING', 'TIMEFRAMESTATUS', '3', '3', 'Zeitraum der letzten Datenübermittlung in Tagen, wenn ein Statusalarm gesendet werden soll.', 'Timeframe in days when last spindel data was send and should be displayed.', 'Periodo in giorni dall\\\'ultimo invio di una mail di allarme.', 'Период отправки и отображения данных при отправке уведомлений', '_DEFAULT'),
('MESSAGING', 'TIMESTATUS', '7', '7', 'Uhrzeit in vollen Stunden für tägliche Status Message (z.B. 6 fuer 6 Uhr morgens)', 'Set time for Status message around full hour. e.g. 6 means 6:00', 'Ora per l\'invio della message di stato giornaliera p. es. 6 sono le 6:00', 'Время отправки сообщений о текущем состоянии (например, 6 - 06:00)', 'GLOBAL'),
('PUSHOVER', 'API_TOKEN', 'YOURTOKEN', 'YOURTOKEN', 'PushOver Service API Token', 'PushOver Service API Token', 'PushOver Service API Token', 'Токен для доступа к PushOver API', 'GLOBAL'),
('PUSHOVER', 'ENABLEPUSHOVER', '0', '0', 'Aktiviere Push Message (0: nein, 1: ja)', 'Activate Push Message (0: no, 1: yes)', 'Activate Push Message (0: no, 1: yes)', 'Включить push-сообщения (1 - да, 0 - нет)', 'GLOBAL'),
('PUSHOVER', 'USER_KEY', 'YOURUSERKEY', 'YOURUSERKEY', 'PushOver Service User Key', 'PushOver Service User Key', 'PushOver Service User Key', 'User Key сервиса PushOver', 'GLOBAL'),
('REMOTECONFIG', 'ENABLE_REMOTECONFIG', '0', '0', 'Bei 1: Konfiguration wird vom TCP Server an die Spindel während eines Datentransfers gesendet (noch in der Testung)', 'If enabled, config from TCP server will be send to Spindle during data transfer once (still under testing)', 'Se abilitato, vengono scritti i dati di configurazione sulla Spindel durante un trasferimento (in fase di testing)', 'Отправка конфигурации с TCP-сервера на iSpindle во время обмена данными (1 - да, 0 - нет. В разработке)', '_DEFAULT'),
('UBIDOTS', 'ENABLE_UBIDOTS', '0', '0', 'Weiterleitung der Daten an Ubidots (1: an 0: aus)', '1 to enable output to ubidots', '1 per abilitare l\'inoltro a ubidots ', 'Пересылка на сервер Ubidots (1 - включена, 0 - выключена)', '_DEFAULT'),
('UBIDOTS', 'UBI_TOKEN', 'my_token', 'my_token', 'UBIDOTS Token. Siehe Anleitung oder ubidots.com', 'global ubidots token, see manual or ubidots.com', 'Token ubidots vedi istruzioni o ubidots.com', 'Токен для доступа к серверу Ubidots. ', '_DEFAULT'),
('UBIDOTS', 'UBI_USE_ISPINDLE_TOKEN', '0', '0', 'Benutzung des in der Spindel gespeicherten Tokens zur Weiterleitung an Ubidots ', '1 to use \"token\" field in iSpindle config (overrides UBI_TOKEN)', 'Utilizzo del token salvato nella iSpindle per l\'inoltro a ubidots', 'Использовать токен iSpindle для пересылки данных на сервер Ubidots (1 - да, 0 - нет)', '_DEFAULT'),
('VERSION', '', '009', '009', NULL, NULL, NULL, NULL, 'GLOBAL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`Section`,`Parameter`,`value`,`DeviceName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
