-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 09 2024 г., 23:12
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
-- Структура таблицы `Strings`
--

CREATE TABLE `Strings` (
  `File` varchar(64) NOT NULL,
  `Field` varchar(64) NOT NULL,
  `Description_DE` varchar(1024) NOT NULL,
  `Description_EN` varchar(1024) NOT NULL,
  `Description_IT` varchar(1024) DEFAULT NULL,
  `Description_RU` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `Strings`
--

INSERT INTO `Strings` (`File`, `Field`, `Description_DE`, `Description_EN`, `Description_IT`, `Description_RU`) VALUES
('add_comment', 'comment_written', 'Kommentar in Datenbank eingetragen: ', 'Comment added to database: ', 'Commento inserito nel database: ', 'Комментарий сохранён в БД: '),
('add_comment', 'error_write', 'Fehler beim Schreiben des Kommentars in die Datenbank', 'Cannot insert comment into Database', 'Errore durante la scrittura di un commento nel database', 'Во время записи комментария в БД произошла ошибка'),
('angle', 'first_y', 'Winkel', 'Angle', 'Angolo', 'Угол наклона'),
('angle', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('angle', 'timetext', 'Temperatur und Winkel der letzten', 'Temperature and angle of the last ', 'Temperatura e angolo da', 'Значения угла наклона и температуры за последние '),
('angle', 'timetext_reset', 'Temperatur und Winkel seit dem letzten Reset: ', 'Temperature and angle since last reset: ', 'Temperatura e angolo dall\'ultimo reset: ', 'Значения угла наклона и температуры с последнего сброса:'),
('angle', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('angle_ma', 'first_y', 'Winkel (geglättet)', 'Angle (moving average)', 'Angolo (livellato)', 'Угол наклона (скользящее среднее)'),
('angle_ma', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('angle_ma', 'timetext', 'Temperatur und Winkel der letzten', 'Temperature and angle of the last ', 'Temperatura e angolo da', 'Значения угла наклона и температуры за последние '),
('angle_ma', 'timetext_reset', 'Temperatur und Winkel seit dem letzten Reset: ', 'Temperature and angle since last reset: ', 'Temperatura e angolo dall\'ultimo reset: ', 'Значения угла наклона и температуры с последнего сброса: '),
('angle_ma', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('archive', 'alcohol', 'Alkohol', 'ABV', 'ABV', 'ABV'),
('archive', 'archive', 'Archiv', 'Archive', 'Archivio', 'Архив'),
('archive', 'archive_end', 'Archiv Ende festlegen /<br/> Kommentar schreiben', 'Set Archive end /<br/> Write comment', 'Imposta fine archivio /<br/> Scrivi un commento', 'Закрыть архив /<br/> Записать комментарий'),
('archive', 'archive_end_removal', 'Flag \"Archiv Ende\" entfernen', 'Remove Flag Archive end', 'Rimuovere il flag \"Fine archivio\"', 'Снять флаг \"Конец архива\"'),
('archive', 'attenuation', 'Vergärungsgrad', 'Attentuation', 'Attenuazione', 'Аттенюация'),
('archive', 'calibration_archive', 'Kalibrierung (Archiv)', 'Calibration (archive)', 'Calibrazione (archivio)', 'Калибровка (архив)'),
('archive', 'comment_text', 'Kommentar:', 'Comment:', 'Commento:', 'Комментарий:'),
('archive', 'Delete_archive', 'Gewählte Fermentation löschen', 'Delete selected fermentation ', 'Elimina la fermentazione selezionata', 'Удалить выбранную информацию о брожении'),
('archive', 'end', 'Ende', 'End', 'Fine', 'Конец'),
('archive', 'final_gravity', 'Restextrakt', 'Final Gravity', 'Estratto residuo', 'Конечная плотность'),
('archive', 'header_initialgravity', 'Stammwürze', 'Initial gravity', 'Mosto originale', 'Начальная плотность'),
('archive', 'time_selected', ' wurde ausgewählt', ' has been selected', ' è stato selezionato', ' было выбрано'),
('battery', 'diagram_battery', 'Volt', 'Voltage', 'Voltaggio', 'Вольт'),
('battery', 'header_battery', 'Aktueller Ladezustand:', 'Battery condition:', 'Stato carica Batteria:', 'Состояние батареи: '),
('batterytrend', 'first_y', 'Batteriespannung', 'Battery voltage', 'Voltaggio Batteria', 'Напряжение батареи:'),
('batterytrend', 'second_y', 'WiFi Signal', 'WiFi reception', 'Segnale ricezione WiFi', 'Уровень сигнала WiFi'),
('batterytrend', 'timetext', 'Batteriespannung und WiFi Signal der letzten', 'Battery voltage and WiFi reception of the last ', 'Voltaggio Batteria e segnale WiFi delle ultime', 'Значения напряжения батареи и уровня сигнала WiFi за последние '),
('batterytrend', 'timetext_reset', 'Batteriespannung und WiFi Signal seit dem letzten Reset: ', 'Battery voltage and WiFi reception since last reset: ', 'Voltaggio Batteria e segnale WiFi dall\'ultimo reset: ', 'Значения напряжения батареи и уровня сигнала WiFi с момента последнего сброса: '),
('batterytrend', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('calibration', 'constant0', 'Konstante 0 (x3):', 'Constant 0 (x3):', 'Costante 0 (x3):', 'Константа 0 (x3): '),
('calibration', 'constant1', 'Konstante 1 (x2):', 'Constant 1(x2):', 'Costante 1 (x2):', 'Константа 1 (x2): '),
('calibration', 'constant2', 'Konstante 2 (x)  :', 'Constant 2 (x)  :', 'Costante 2 (x)  :', 'Константа 2 (x)  : '),
('calibration', 'constant3', 'Konstante 3      :', 'Constant 3      :', 'Costante 3      :', 'Константа 3      :'),
('calibration', 'enter_constants', 'Konstanten eingeben:', 'Please enter constants:', 'Inserire costanti:', 'Введите константы: '),
('calibration', 'header', 'Aktualisieren der Kalibrierung für:', 'Update calibration for:', 'Aggiornamento della calibrazione per:', 'Обновление калибровки для:'),
('calibration', 'send', 'Kalibrierung an DB senden', 'Send calibration to database', 'Inoltra calibrazione al database', 'Сохранить калибровку в БД'),
('calibration', 'stop', 'Zurück', 'Go back', 'Indietro', 'Назад'),
('calibration', 'window_alert_update', 'Kalibrierung an Datenbank gesendet!', 'Calibration was send to database!', 'Calibrazione e stata inoltrata al database!', 'Калибровка была сохранена в БД!'),
('diagram', 'header_no_data_1', 'Keine Daten von', 'No data from', 'Nessun dato da', 'Нет данных от '),
('diagram', 'header_no_data_2', 'in diesem Zeitraum. Bitte noch weitere', 'from this timeframe. Please go', 'In questo periodo. Per favore vai ', 'в заданном периоде. Пожалуйста, вернитесь на '),
('diagram', 'header_no_data_3', 'Tage zurückgehen.', 'more days back.', 'giorni indietro.', 'дней раньше.'),
('diagram', 'not_calibrated', 'ist nicht kalibriert.', 'is not calibrated.', 'non calibrata.', 'не откалиброван.'),
('diagram', 'recipe_name', 'Sudname:', 'Recipe:', 'Ricetta:', 'Рецепт:'),
('diagram', 'timetext_days', 'Tag(e), ', 'day(s), ', 'giorno(i),', 'дней, '),
('diagram', 'timetext_hours', 'Stunde(n).', 'Hour(s).', 'ora(e).', 'часов, '),
('diagram', 'timetext_weeks', 'Woche(n), ', 'Week(s), ', 'settimana(e), ', 'недель, '),
('diagram', 'tooltip_at', 'um', 'at', 'alle', 'на'),
('diagram', 'tooltip_time', 'Uhr:', ':', ':', ':'),
('ferment_end', 'ferment_end_written', 'Gärende in Datenbank eingetragen', 'Fermentation End added to database', 'Fine della fermentazione inserito nel database', 'Дата окончания брожения сохранена в БД'),
('index', 'available_version', 'Verfügbare Version:', 'Available version:', 'Versione disponibile:', 'Доступная версия:'),
('index', 'calibrate_spindle', 'Spindle im TCP Server kalibrieren', 'Calibrate spindle in TCP Server ', 'Calibrare la spindle nel server TCP', 'Калибровка Spindel на TCP-сервере'),
('index', 'change_history', 'Historie anpassen\r\n', 'Change history', 'Personalizza la cronologia', 'Редактировать журнал'),
('index', 'chart_filename_01', 'Status (Batterie, Winkel, Temperatur)', 'Show Status (Battery, Angle, Temperature)', 'Stato (batteria, angolo, temperatura)', 'Состояние (батарея, угол наклона, температура)'),
('index', 'chart_filename_02', 'Batteriezustand', 'Show Battery Condition', 'Stato batteria', 'Состояние батареи'),
('index', 'chart_filename_03', 'Netzwerk Empfangsqualität', 'Show WiFi quality', 'Qualità ricezione WiFi', 'Уровень сигнала WiFi'),
('index', 'chart_filename_04', 'Extrakt und Temperatur (RasPySpindel)', 'Gravity and temperature (RasPySpindel)', 'Densità e temperatura', 'Плотность и температура (RasPySpindel)'),
('index', 'chart_filename_05', 'Extrakt und Temperatur (RasPySpindel), Geglättet', 'Gravity and temperature (RasPySpindel), Moving Average', 'Densità e temperatura livellata', 'Плотность и температура (RasPySpindel), скользящее среднее'),
('index', 'chart_filename_06', 'Tilt und Temperatur', 'Tilt and temperature', 'Tilt e temperatura', 'Угол наклона и температура'),
('index', 'chart_filename_07', 'Tilt und Temperatur, Geglättet', 'Tilt and temperature, Moving Average', 'Tilt e temperatura, Curva livellata', 'Угол наклона и температура, скользящее среднее'),
('index', 'chart_filename_08', 'Extrakt und Temperatur (iSpindel Polynom)', 'Gravity and temperature (iSpindle Polynom)', 'Densità e temperatura (polinomio iSpindle)', 'Плотность и температура (полином iSpindel)'),
('index', 'chart_filename_08_1', 'Extrakt und Temperatur (iSpindel Polynom), Geglättet', 'Gravity and temperature (iSpindle Polynom), Moving Average', 'Densità e temperatura (polinomio iSpindle), livellata', 'Плотность и температура (полином iSpindel), скользящее среднее'),
('index', 'chart_filename_09', 'Gärbeginn Zeitpunkt setzen', 'Set Fermentation Start', 'Impostazione inizio fermentazione', 'Установить дату начала брожения'),
('index', 'chart_filename_10', 'Vergärungsgrad', 'Apparent attenuation', 'Attenuazione apparente', 'Видимая аттенюация'),
('index', 'chart_filename_11', 'Änderung (Delta) Extrakt innerhalb 12 Stunden Anzeigen', 'Delta gravity  (12 hrs interval)', 'Delta densità (Intervallo di 12 ore)', 'Изменение плотности (12ч интервал)'),
('index', 'chart_filename_12', 'Verlauf Batteriespannung/WiFi anzeigen', 'Battery / Wifi trend', 'Batteria / trend WiFi ', 'Изменение состояния батареи / сигнала WiFi'),
('index', 'chart_filename_13', 'Spindel im TCP Server Kalibrieren', 'Calibrate Spindel in TCP Server', 'Calibrazione Spindel nel server TCP', 'Калибровка Spindel на TCP-сервере'),
('index', 'chart_filename_14', 'Gärende Zeitpunkt setzen', 'Set Fermentation End', 'Imposta il tempo di fermentazione', 'Установить дату окончания брожения'),
('index', 'chart_filename_15', 'Kommentar eingeben', 'Enter comment', 'Inserisci un commento', 'Добавить комментарий'),
('index', 'chart_filename_16', 'iGauge Daten', 'iGauge Data', 'Dati iGauge', 'Данные iGauge'),
('index', 'chart_filename_17', 'Nachgärbeginn Zeitpunkt setzen', 'Set secondary fermentation', 'Set secondary fermentation', 'Установить дату начала вторичного брожения'),
('index', 'comment_text', 'Kommentarfeld : ', 'Comment : ', 'Campo commento : ', 'Комментарий : '),
('index', 'current_data', 'Aktuelle Daten', 'Most recent data', 'Date attuali', 'Актуальные данные'),
('index', 'days_history', 'Tage Historie\r\n', 'Days history', 'Giorni di storia', 'последних дней'),
('index', 'diagram_selection', 'Diagramm Auswahl(Tage):', 'Diagram selection (days):', 'Selezione diagramma (giorni):', 'Период отображения данных (дней):'),
('index', 'expert_settings', 'Experten Einstellungen aktivieren', 'Activate expert settings', 'Attiva le impostazioni degli esperti', 'Открыть настройки для опытных пользователей'),
('index', 'header_batch', 'Charge', 'Batch', 'lotto', 'Партия'),
('index', 'header_deltagravity', 'Delta Extrakt [°P]', 'Delta gravity [°P]', 'Mosto delta [°P]', 'Изменение плотности [°P]'),
('index', 'header_device', 'Gerät', 'Device', 'Dispositivo', 'Устройство'),
('index', 'header_e_g', 'z.B.', 'e.g.', 'per essempio', 'например'),
('index', 'header_hours_short', 's', 'h', 'o', 'ч'),
('index', 'header_initialgravity', 'Stammwürze [°P]', 'Initial gravity [°P]', 'Mosto originale [°P]', 'Начальная плотность [°P]'),
('index', 'header_volt', 'V', 'V', 'V', 'В'),
('index', 'help', 'Hilfe', 'Help', 'Aiuto', 'Справка'),
('index', 'installed_version', 'Installierte Version:', 'Installed version:', 'Versione installata:', 'Установленная версия:'),
('index', 'no_data', 'Keine Daten in den letzten %1$d Tagen gespeichert. Bitte Spindel Verbinden, damit Daten angezeigt werden können.<br /><br />Oder ändern sie die Anzahl der Tage:<br />\r\n\r\n', 'No spindle data received in the past %1$d days. Please connect Spindle to generate data.<br /><br />Or change days of history:<br />', 'Nessun dato salvato negli ultimi %1$d giorni. Collegare il mandrino in modo che i dati possano essere visualizzati.<br /> <br /> Oppure modifica il numero di giorni: <br />', 'Нет данных за последние %1$d дней. Пожалуйста, подключите iSpindel для получения данных<br /><br />Или выберите другой период:<br />'),
('index', 'or', 'oder:', 'or:', 'o:', 'или:'),
('index', 'recipe_name', 'Optional Sudnamen eingeben:', 'Enter optional recipe name:', 'Imposta nome ricetta (opzionale):', 'Введите название рецепта (опционально):'),
('index', 'reset_flag', 'Daten seit zuletzt gesetztem \"Reset\" Flag zeigen', 'Show data since last set \'Reset\'', 'Visualizzare dati dall\'ultimo reset impostato', 'Показать данные с момента последнего сброса'),
('index', 'reset_settings', 'Standard Einstellungen ', 'Default settings', 'Impostazioni predefinite', 'Настройки по-умолчанию'),
('index', 'reset_warning', 'Achtung: Individuelle Settings werden gelöscht und mit Default Werten überschrieben.', 'Attention: Individual settings will be deleted and replaced with the default settings.', 'Attenzione: le singole impostazioni vengono eliminate e sovrascritte con i valori predefiniti dell\'applicazione.', 'Внимание! Все изменения в настройках будут удалены и заменены настройками по-умолчанию.'),
('index', 'send_comment', 'Kommentar senden', 'Send Comment', 'Invia un commento', 'Записать комментарий'),
('index', 'send_rdi_end', 'Gärende festlegen', 'Set fermentation end', 'Definire la fermentazione', 'Установить дату окончания брожения'),
('index', 'send_reset', 'Gärbegin festlegen', 'Set fermentation start', 'Imposta inizio fermentazione', 'Установить дату начала брожения'),
('index', 'server_not_running', 'Warnung: TCP Server läuft nicht!', 'Warning: TCP Server is not running!', 'Attenzione: server TCP non avviato!', 'Внимание! TCP-сервер не запущен!'),
('index', 'server_running', 'TCP Server läuft mit PID: ', 'TCP Server is running with PID: ', 'Server TCP avviato: ', 'TCP-сервер запущен, PID: '),
('index', 'server_settings', 'TCP Server Settings Editieren', 'Edit TCP Server Settings', 'Modificare impostazioni server TCP', 'Редактировать настройки TCP-сервера'),
('index', 'settings_header', 'RasPySpindel Einstellungen', 'RasPySpindel Settings', 'RasPySpindel impostazioni', 'Настройки RasPySpindel'),
('index', 'show_archive', 'Archiv Laden', 'Load archive', 'Magazzino archivio', 'Загрузить архив'),
('index', 'show_diagram', 'Diagramm anzeigen', 'Show Diagram', 'Visualizza diagramma', 'Отобразить диаграмму'),
('index', 'upgrade_data_table', 'Upgrade der Datentabelle', 'Upgrade data table', 'Aggiornamento di Datentabelle', 'Обновить таблицу с данными'),
('index', 'upgrade_settings', 'Settings Tabelle durch neuste Version ersetzen', 'Replace Settings table with latest version', 'Sostituisci la tabella delle impostazioni con l\'ultima versione', 'Заменить текущие настройки актуальной версией'),
('index', 'upgrade_strings', 'String Tabelle durch neuste Version ersetzen', 'Replace Strings table with latest version', 'Sostituisci la tabella delle stringhe con l\'ultima versione', 'Заменить текущую локализацию актуальной версией'),
('index', 'upgrade_warning', 'Achtung: Individuelle Settings werden gelöscht und mit Default Werten der Installation überschrieben. Bitte vorher ein Backup der Settings erstellen.', 'Attention: Individual settings will be deleted and replaced with the default settings of the installation.Pleas backup settings prior to upgrade.', 'Attenzione: le singole impostazioni vengono eliminate e sovrascritte con i valori predefiniti dell\'applicazione. Effettuare in anticipo un backup delle impostazioni.', 'Внимание! Все изменения в настройках будут удалены и заменены настройками по-умолчанию. Рекомендуется сохранить настройки перед обновлением.'),
('plato', 'first_y', 'Extrakt °P (Spindel)', 'Extract °P (Spindle)', 'Densità °P (Spindle)', 'Плотность °P (Spindle)'),
('plato', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('plato', 'timetext', 'Temperatur und Extraktgehalt (Spindel) der letzten', 'Temperature and extract (Spindle) of the last ', 'Temperatura e densità delle ultime', 'Значения температуры и плотности (Spindle) за последние '),
('plato', 'timetext_reset', 'Temperatur und Extraktgehalt (Spindel) seit dem letzten Reset: ', 'Temperature and extract (Spindle) since last reset: ', 'Temperatura e densità dall\'ultimo reset: ', 'Значения температуры и плотности (Spindle) с момента последнего сброса:'),
('plato', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Ora', 'Дата / время'),
('plato4', 'first_y', 'Extrakt °P', 'Extract °P', 'Densità °P', 'Плотность [°P]'),
('plato4', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('plato4', 'timetext', 'Temperatur und Extraktgehalt der letzten', 'Temperature and extract of the last ', 'Temperatura e densità di', 'Значения температуры и плотности за последние '),
('plato4', 'timetext_reset', 'Temperatur und Extraktgehalt seit dem letzten Reset: ', 'Temperature and extract since last reset: ', 'Temperatura e densità dall\'ultimo reset: ', 'Значения температуры и плотности с момента последнего сброса:'),
('plato4', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('plato4_delta', 'first_y', 'Delta Extrakt °P', 'Delta extract °P', 'Delta densità °P', 'Изменение плотности °P'),
('plato4_delta', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('plato4_delta', 'timetext', 'Temperatur und Delta Extraktgehalt der letzten', 'Temperature and delta extract of the last ', 'Temperatura e delta densità delle ultime', 'Значения температуры и изменения плотности за последние '),
('plato4_delta', 'timetext_reset', 'Temperatur und Delta Extraktgehalt seit dem letzten Reset: ', 'Temperature and delta extract since last reset: ', 'Temperatura e delta densità dall\'ultimo reset: ', 'Значения температуры и изменения плотности с момента последнего сброса: '),
('plato4_delta', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('plato4_ma', 'first_y', 'Extrakt °P (geglättet)', 'Extract °P (moving average)', 'Densità °P (curva livellata)', 'Плотность °P (скользящее среднее)'),
('plato4_ma', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('plato4_ma', 'timetext', 'Temperatur und Extraktgehalt der letzten', 'Temperature and extract of the last ', 'Temperatura e densità di', 'Значения температуры и плотности за последние '),
('plato4_ma', 'timetext_reset', 'Temperatur und Extraktgehalt seit dem letzten Reset: ', 'Temperature and extract since last reset: ', 'Temperatura e densità dall\'ultimo reset: ', 'Значения температуры и плотности с момента последнего сброса: '),
('plato4_ma', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('reset_now', 'error_read_id', 'Fehler beim Lesen der Spindel ID', 'Cannot read Spindle ID from Database', 'Impossibile leggere l\' ID Spindle dal database', 'Ошибка чтения Spindel ID из БД'),
('reset_now', 'error_write', 'Fehler beim Insert', 'Cannot insert reset into Database', 'Errore scrittura database', 'Ошибка записи в БД'),
('reset_now', 'recipe_written', 'Sudname in Datenbank eingetragen:', 'Recipe name added to database:', 'Nome ricetta inserita nel database:', 'Название рецепта записано в БД'),
('reset_now', 'reset_written', 'Reset-Timestamp in Datenbank eingetragen', 'Reset-Timestamp added to database', 'Reset-Timestamp inserito nel database', 'Даза установки сброса записана в БД'),
('sendmail', 'content_alarm_low_gravity_1', '<b>Der gemessene Extrakt folgender Spindel(n) ist unter das Limit von %s Plato gefallen:</b><br/><br/>', '<b>Measured Gravity for these Spindle(s) is below Limit of %s Plato:</b><br/><br/>', '<b>Densità rilevata dalla Spindle e inferiore al limite di %s plato:</b><br/><br/>', '<b>Измеренная плотность для данных Spindle(s) ниже ограничения в %s Plato:</b><br/><br/>'),
('sendmail', 'content_alarm_svg', '<b>Der Vergärungsgrad folgender Spindel(n) ist oberhalb des Alarm Limits von %s Prozent\r\n:</b><br/><br/>', '<b>Calculated Apparent Attenuation for these Spindle(s) is above alarm Limit of %s Percent:</b><br/><br/>', '<b>Attenuazione apparente calcolata e superiore al limite di %s per cento:</b><br/><br/>', '<b>Вычисленная видимая аттенюация для данных Spindle(s) выше ограничения в  %s процентов:</b><br/><br/>'),
('sendmail', 'content_data', '<b>%s <br/>Datum:</b> %s <br/><b>ID:</b> %s <br/><b>Winkel:</b> %s <br/><b>Stammwürze in Plato:</b> %s <br/><b>Extrakt in Plato:</b> %s <br/><b>Scheinbarer Vergärungsgrad:</b> %s <br/><b>Alkohol im Volumen :</b> %s <br/><b>Delta Plato letzte 24h:</b> %s <br/><b>Delta Plato letzte 12h:</b> %s <br/><b>Temperatur:</b> %s <br/><b>Batteriespannung:</b> %s <br/><b>Sudname:</b> %s <br/><br/>', '<b>%s <br/>Date:</b> %s <br/><b>ID:</b> %s <br/><b>Angle:</b> %s <br/><b>Apparent Attenuation in Plato:</b> %s <br/><b>Current extract in Plato:</b> %s <br/><b>Apparent attentuation:</b> %s <br/><b>Alcohol by Volumen :</b> %s <br/><b>Delta Plato last 24h:</b> %s <br/><b>Delta Plato last 12h:</b> %s <br/><b>Temperature:</b> %s <br/><b>Battery:</b> %s <br/><b>Recipe:</b> %s <br/><br/>', '<b>%s <br/>Data:</b> %s <br/><b>ID:</b> %s <br/><b>Angolo:</b> %s <br/><b>Attenuazione apparente in Plato:</b> %s <br/><b>Attuale densità in Plato:</b> %s <br/><b>Attenuazione apparente:</b> %s <br/><b>ABV :</b> %s <br/><b>Delta Plato ultime 24 ore:</b> %s <br/><b>Delta Plato ultime 12 ore:</b> %s <br/><b>Temperatura:</b> %s <br/><b>Batteria:</b> %s <br/><b>Ricetta:</b> %s <br/><br/>', '<b>%s <br/>Дата:</b> %s <br/><b>ID:</b> %s <br/><b>Наклон:</b> %s <br/><b>Аттенюация, Plato:</b> %s <br/><b>Текущая плотность, Plato:</b> %s <br/><b>Видимая аттенюация:</b> %s <br/><b>Алкоголь по объёму :</b> %s <br/><b>Изменение плотности за последние 24ч:</b> %s <br/><b>Изменение плотности за последние 12ч:</b> %s <br/><b>Температура:</b> %s <br/><b>Батарея:</b> %s <br/><b>Рецепт:</b> %s <br/><br/>'),
('sendmail', 'content_info', '<b>Alarm bei Plato Unterschreitung:</b> %s Plato<br/><b>Alarm Delta Plato in den letzten 24 Stunden :</b> %s Plato<br/><b>Zeit für Statusemail:</b> %s<br/>                    <b>Aktuelle Zeit:</b> %s', '<b>Lower limit for Plato Alarm:</b> %s Plato<br/><b>Alarm Delta Plato in last 24 hours :</b> %s Plato<br/><b>Time for Statusmail:</b> %s<br/>                    <b>Current Time:</b> %s', '<b>Limite inferiore per allarme plato:</b> %s Plato<br/><b>Allarme Delta Plato nelle ultime 24 ore :</b> %s Plato<br/><b>Ora per la mail di stato:</b> %s<br/>                    <b>Ora attuale:</b> %s', '<b>Нижнее значение плотности:</b> %s Plato<br/><b>Изменение плотности за 24ч :</b> %s Plato<br/><b>Время отправки письма о текущем состоянии:</b> %s<br/>                    <b>Текущее время:</b> %s'),
('sendmail', 'content_status_1', '<b>Letzter Datensatz innerhalb der letzten %s Tage wurde für folgende Spindel(n) gefunden:</b><br/><br/>', '<b>Last dataset within the last %s days was found for the following Spindles:</b><br/><br/>', '<b>Ultima rilevazione nei ultimi %s giorni sono state trovate dalle seguenti spindle:</b><br/><br/>', '<b>Данные за последние %s дней для указанных Spindles:</b><br/><br/>'),
('sendmail', 'subject_alarm_low_gravity', 'Alarm von iSpindel-TCP-Server (%s): Gravity unter Limit gefallen', 'Alarm from iSpindel-TCP-Server (%s): Gravity below limit', 'Allarme dal server-TCP-iSpindle (%s): Densità inferiore al limite', 'Уведомление от iSpindel-TCP-Server (%s): Плотность опустилась ниже заданного ограничения'),
('sendmail', 'subject_alarm_svg', 'Alarm von iSpindel-TCP-Server (%s): Vergärungsgrad oberhalb Alarm Limit', 'Alarm from iSpindel-TCP-Server (%s): Apparent attenuation above alarm limit', 'Allarme dal server-TCP-iSpindle (%s): Attenuazione apparente superiore al limite', 'Уведомление от iSpindel-TCP-Server (%s): Видимая аттенюация опустилась ниже заданного ограничения'),
('sendmail', 'subject_status', 'Status Email von iSpindel-TCP-Server (%s)', 'Status Email from iSpindel-TCP-Server (%s)', 'Email di stato dal server-TCP-iSpindle (%s)', 'Уведомление о текущем состоянии от iSpindel-TCP-Server (%s)'),
('settings', 'add_device', 'Individuelle Settings für Device anlegen', 'Add individual settings for device', 'Crea impostazioni individuali per il dispositivo', 'Добавить уникальные настройки для устройства'),
('settings', 'data_table', 'Datentabelle', 'Data Table', 'Tabella di dati', 'Таблица данных'),
('settings', 'database_header', 'RasPySpindel Datenbank', 'RasPySpindel Database', 'RasPySpindel Database', 'RasPySpindel БД'),
('settings', 'delete_device', 'Device aus individuellen Settings löschen', 'Remove Device from individual Settings', 'Elimina il dispositivo dalle singole impostazioni', 'Отменить индивидуальные настройки для устройства'),
('settings', 'description', 'Beschreibung', 'Description', 'Descrizione', 'Описание'),
('settings', 'export', 'Exportieren:', 'Export:', 'Esporta:', 'Экспорт:'),
('settings', 'export_data', 'Daten Tabelle exportieren', 'Export Data Table', 'Esporta tabella dati', 'Экспорт таблицы с данными'),
('settings', 'export_settings', 'Einstellungen exportieren', 'Export Settings', 'Esporta impostazioni', 'Экспорт настроек'),
('settings', 'import', 'Importieren:', 'Import:', 'Importazione:', 'Импорт:'),
('settings', 'import_data', 'Daten Tabelle importieren', 'Import Data Table', 'Importa tabella dati', 'Импорт таблицы с данными'),
('settings', 'import_settings', 'Einstellungen importieren', 'Import Settings', 'Importa impostazioni', 'Импорт настроек'),
('settings', 'problem', 'Probleme beim Schreiben der Settings', 'Problem with writing settings', 'Problema nella scrittura delle impostazioni', 'Ошибка при записи настроек'),
('settings', 'select_section', 'Section Auswahl', 'Select Section', 'Selezione sezione', 'Выбор секции'),
('settings', 'send', 'Settings in DB schreiben', 'Send settings to database', 'Invia impostazioni al database', 'Записать настройки в БД'),
('settings', 'settings_header', 'RasPySpindel Einstellungen', 'RasPySpindel Settings', 'RasPySpindel impostazioni', 'Настройки RasPySpindel'),
('settings', 'settings_table', 'Einstellungen', 'Settings', 'Impostazioni', 'Настройки'),
('settings', 'stop', 'Zurück', 'Go back', 'Indietro', 'Назад'),
('settings', 'testmail', 'Sende Test Email', 'Send test email', 'Invia e-mail di prova', 'Отправить проверочное письмо'),
('settings', 'window_alert_update', 'Settings aktualisiert!', 'Settings were updated!', 'Impostazioni aggiornate!', 'Настройки успешно обновлены!'),
('status', 'diagram_angle', 'Grad', 'Degree', 'Gradi', 'Градусы'),
('status', 'diagram_battery', 'Volt', 'Voltage', 'Voltaggio', 'Вольт'),
('status', 'diagram_temperature', '°', '°', '°', '°'),
('status', 'header_angle', 'Winkel', 'Angle', 'Angolo', 'Угол наклона'),
('status', 'header_battery', 'Akku', 'Battery', 'Batteria', 'Батарея'),
('status', 'header_temperature', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('svg_ma', 'first_y', 'Vergärungsgrad (%)', 'Attentuation (%)', 'Attenuazione (%)', 'Аттенюация (%)'),
('svg_ma', 'second_y', 'Temperatur', 'Temperature', 'Temperatura', 'Температура'),
('svg_ma', 'third_y', 'Alkohol (Vol. %)', 'ABV (%)', 'ABV (%)', 'ABV (%)'),
('svg_ma', 'timetext', 'Temperatur und scheinbarer Vergärungsgrad der letzten', 'Temperature and extract of the last ', 'Tenperatura e densità delle ultime', 'Значения температуры и плотности за последние '),
('svg_ma', 'timetext_reset', 'Temperatur und scheinbarer Vergärungsgrad seit dem letzten Reset: ', 'Temperature and apparent attenuation since last reset: ', 'Temperatura e attenuazione apparente dall\'ultimo reset: ', 'Значения температуры и видимой аттенюации с момента последнего сброса:'),
('svg_ma', 'x_axis', 'Datum / Uhrzeit', 'Date / Time', 'Data / Orario', 'Дата / время'),
('version', '013', '', '', '', NULL),
('wifi', 'header', 'WiFi Empfangsqualität:', 'Wifi reception: ', 'Qualità della ricezione WiFi: ', 'Уровень сигнала WiFi:');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Strings`
--
ALTER TABLE `Strings`
  ADD UNIQUE KEY `File` (`File`,`Field`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
