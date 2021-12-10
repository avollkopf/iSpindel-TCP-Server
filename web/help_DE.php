<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// Loads personal config file for db connection details. If not found, default file will be used
if ((include_once '../config/common_db_config.php') == FALSE){
    include_once("../config/common_db_default.php");
    }
//  Loads db query functions
include_once("./include/common_db_query.php");
$document_class = get_color_scheme($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <title>RasPySpindel Homepage</title>
    <meta name="Keywords" content="iSpindle, iSpindel, Chart, genericTCP, Select">
    <meta name="Description" content="iSpindle Fermentation Chart Selection Screen">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" type="text/css" href="./include/iSpindle.css">
<style id="php_Parameter_10648_Styles"><!--table
	{mso-displayed-decimal-separator:"\,";
	mso-displayed-thousand-separator:"\.";}
.xl1510648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6310648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6410648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6510648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6610648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6710648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6810648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6910648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7010648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7110648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7210648
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
--></style>
    <link rel="shortcut icon" href="./include/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./include/favicon.ico" type="image/x-icon">

</head>
<body class='<?php echo $document_class ?>'>
<form name="main" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

<?php echo"<div id='SideMenu' class='sidebar'>" ?> 
<h2>RasPySpindel</h2>
  <a id="lnk_home"class="lnk active" href="#home">Hilfe</a>
  <a id="lnk_main" class="lnk" href="#main">Hauptseite</a>
  <a id="lnk_config" class="lnk" href="#config">Konfiguration</a>
  <a id="lnk_calibration" class="lnk" href="#calibration">Kalibrierung</a>
  <a id="lnk_diagram" class="lnk" href="#diagram">Diagramme</a>
  <a id="lnk_archive" class="lnk" href="#archive">Archiv</a>
  <a id="lnk_sendmail" class="lnk" href="#sendmail">Email Alarme Konfigurieren</a>
  <a id="lnk_parameter" class="lnk" href="#parameter">php Script Parameter</a>
  <a id="lnk_about" class="lnk" href="#about">About</a>
  <a id="lnk_back" class="lnk" href="index.php">Zurück</a>
</div>

<div class="content">
<div id="home" style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>Hilfe</h2>
  <p>Dieses in Python geschriebene Server Skript dient dazu, von der iSpindel kommende Rohdaten über eine generische TCP Verbindung zu empfangen. Auf zusätzlichen, unnötigen Overhead durch Protokolle wie http wird hierbei bewusst verzichtet, um den Stromverbrauch der iSpindel so gut es geht zu minimieren. Die empfangenen Daten können als CSV (“Comma Separated Values”, also durch Kommas getrennte Werte) in Textdateien gespeichert (und so zum Beispiel in Excel leicht importiert) werden. Ebenso ist es möglich, die Daten in einer MySQL Datenbank abzulegen.
Somit hat man einen lokalen Server, der auch ohne Internet Anbindung funktioniert und den Einsatz der iSpindel im Heimnetzwerk ermöglicht. Die Zugriffszeiten sind kürzer und dadurch sinkt natürlich auch der (ohnehin geringe) Stromverbrauch der iSpindel noch weiter.</p>

<p>Um nicht auf die Anbindung an Ubidots oder andere Dienste verzichten zu müssen, besteht aber auch die Option, die Daten zusätzlich dorthin weiterzuleiten.
Das geschieht transparent, ohne dass die iSpindel auf die Verbindung warten muss. Der lokale Server fungiert dann sozusagen als Proxy.</p>

<p>Das Skript ist plattformunabhängig und kann z.B. auf einem Raspberry Pi oder einer NAS, eingesetzt werden. Aber auch der Einsatz auf einem evtl. gemieteten dedizierten (oder virtuellen) Server oder einem beliebigen Rechner im Heimnetz ist möglich. Der Betrieb mehrerer iSpindeln gleichzeitig funktioniert problemlos und ohne Verzögerungen, da Multithreading implementiert ist.
Getestet wurde es unter Linux (Ubuntu Container einer QNAP NAS und Raspbian Buster), es sollte aber auch unter Windows problemlos laufen.
Die einzige Voraussetzung ist, dass Python(3), ein Apache Server und eine Datenbank installiert sind.</p>

<p>Für die Anbindung an MySQL muss auch der python-mysql.connector installiert sein. In der Konfiguration der iSpindel wählt man TCP aus, und trägt die IP Adresse des Servers ein, auf dem das Skript läuft. Als Port wählt man am besten die Voreinstellung 9501.</p>

<p>Nun muss das Skript selbst unbedingt noch konfiguriert werden. Eine detailierte Anleitung findet man im File INSTALL.md</p> 

<p>Ein Update kann man aus dem Verzeichnis der Installation mit sudo ./update.sh bzw. sudo ./update-rapsi.sh starten.</br>
Sollte beim update neue Strings bzw. Settings verfügbar sein, so wird das auf der Hauptseite angezeigt. Dann müssen die Experteneinstellungen ausgewählt werden und man kann ein update der entsprechenden Tabellen Starten.</p>

<p><b>To change the language of the web interface you need to:</b/></br> 
<ol>
  <li>Press 'TCP Server Settings editieren'</li>
  <li>Select the Device 'GLOBAL'</li>
  <li>Select the Section 'GENERAL'</li>
  <li>Enter e.g. EN for the parameter LANGUAGE</li>
  <li>Press 'Settings in DB schreiben'</li>
</ol>
Currently, there are German (DE), English (EN), and Italian (IT) installed

</div>

<div id="main" style="margin-left:15%;padding:1px 16px;height:4000px;">
  <h2>Hauptseite</h2>
  <p>Wenn der Server korrekt installiert ist und läuft, kann die Hauptseite über die IP des Servers aufgerufen werden (z.B.: http://192.168.10.11/iSpindle/index.php)</p>
  <p>Wenn Daten von Spindeln an die Datenbank innerhalb der letzten 7 Tage (default) gesendet wurden, so sieht man auf der Seite den letzten Datensatz der Spindeln, sofern das über den Parameter 'SHOWSUMMARY' in der Section 'GENERAL' in den Settings aktiviert wurde.</p>
  <p>Sollten keine Daten angezeigt werden, so kann man die Anzahl der Tage in der Historie erhöhen, bis Daten angezeigt werden</p>
  <p>Es gibt auch die Möglichkeit alte Sude im Archiv anzuzeigen. Dazu muss der Button 'Archiv laden' gedrückt werden. Wie ein Sud im Archiv angelegt wird, wird weiter unten beschrieben.</p>
  <p>Es wird auch angezeigt, ob und mit welcher PID der Server im Hintergrund läuft. </p>
  <p>Auf der Hauptseite gibt es auch die Möglichkeit, die Seite für die Kalibrierung der Spindeln zu öffnen. Hierfür muss der Button 'Spindel im TCP Server Kalibrieren' angeklickt werden. Durch anklicken des Buttons 'TCP Server Settings Editieren' wird die Konfigurationsseite geladen.</p>
  <img class="img_norm" src="help/images/index1.png" alt="Hauptseite mit Übersicht">
  <p>Sollten keine Daten in den letzten 7 Tagen in die Datenbank geschrieben worden sein, so wird die Option angeboten, den Zeitraum zu verändern, um ggf auch ältere Daten für Spindeln anzeigen zu lassen. Wenn man den Button 'Historie anpassen' anklickt, wird die Hauptseite neu geladen.</p>
  <img class="img_norm" src="help/images/index2.png" alt="Hauptseite ohne Daten">
  <p>Auf der Seite kann man ein entsprechendes Device auswählen: </p>
  <img class="img_norm" src="help/images/index3.png" alt="Hauptseite Device auswählen">
  <p>Für das ausgewählte Device kann man dann ein Diagramm oder eine Funktion auswählen. Nach der Auswahl des Diagramms muss dann noch der Button 'Diagramm anzeigen' angeklickt werden und es öffnet sich die entsprechende Seite.</p>
  <p>Folgende Funktionen können für die selektierte Spindel ausgewählt werden:</p>
  <ol>
    <li><b>Gärbeginn Zeitpunkt setzen:</b> Namen für einen Sud definieren und im Archiv anlegen</li>
    <li><b>Gärende Zeitpunkt setzen:</b> Endpunkt der Gärung im Archiv festlegen</li>
    <li><b>Kommentar eingeben:</b> Kommentar für aktuellen Sud/Datenpunkt eingeben</li>
  </ol>
  <img class="img_norm" src="help/images/index4.png" alt="Hauptseite Funktion/Diagramm auswählen">
  <p>Auf der Hauptseite gibt es auch die Möglichkeit, Experteneinstellungen zu wählen. Dazu muss die entsprechende checkbox aktiviert werden. Hier können dann zum Beispiel die Settings auf Default Werte zurückgesetzt werden</p>
  <p>Wird ein update installiert, so kann es sein, dass neue Funktionen oder Settings zum Server hinzugekommen sind. Die Index Seite informiert darüber. Dann müssen die Erperteneinstellungen aktiviert werden und man kann die sogenannte Strings Tabelle bzw. die Settings tabelle aktualisieren. Hierbei muss darauf geachtet werden, dass beim Aktualisieren der Settings Tabelle alle Settings auf Default Werte zurückgesetzt werden. Die aktuellen Settings kann man aber vor einem Update auch auf der Settings Seite als Backup exportieren und später wieder importieren</p>
  <img class="img_norm" src="help/images/index5.png" alt="Hauptseite Experten Einstellungen">


</div>

<div id="config" style="margin-left:15%;padding:1px 16px;height:6500px;">
  <h2>Konfiguration</h2>
  <p>Von der Hauptseite kommt man über den Link 'TCP Server Settings Editieren' auf die Settings Seite</br>
  <p>Um zurück zur Hauptseite zu kommen, kann man oben links den 'Home' Button oder den 'Zurück' Button verwenden</br>
  <p>Dort hat man die Möglichkeit, verschiedene Einstellungen festzulegen. Die Einstellungen sind zunächst in 'Devices' unterteilt:</p>
  <b>Devices:</b>
  <p style="white-space: pre;">GLOBAL&#9;Settings sind Server spezifisch und somit für alle Devices gleich.</br>_DEFAULT&#9;Settings gelten für alle Devices, die keine individuellen Einstellungen haben. Diese Settings können für jedes device kopiert werden und dann individuell angepasst werden.</br>iSpindel001&#9;Beispielname für ein Device mit dem Namen iSpindel001, dass für individuelle angelegt wurde Settings angelegt wurde.</p>
  <p>Außerdem kann man sowohl die Datentabelle, also auch die Settings der Datenbank exportieren, wenn man den entsprechenden Button anklickt. Ein späterer Import ist hier auch wieder über die Import Funktion möglich.</p>

  <img class="img_norm" src="help/images/Settings1.png" alt="Settings Deviceauswahl">
  <p><b>Sections:</b></br>
  Dann sind die Settings noch in sogenannte Sections unterteilt um eine bessere Übersicht zu haben. Es kann sein, dass z.B. bei der Auswahl von 'GOBAL' und z.B. 'BREWSPY' keine Settings angezeigt werden, da diese nur unter '_DEFAULT' bzw. einem angelegten individuellen Device zu sehen sind. </p>
  <img class="img_norm" src="help/images/Settings2.png" alt="Settings Sectionauswahl">
  <p><b>Settings speichern:</b></br>
  Wenn Settings geändert werden, müssen sie mit dem Button 'Settings in DB schreiben' in die Datenbank übertragen werden, sonst haben Änderungen keine Wirkung.</p>
  </br>
  <p><b>Individuelle Settings für Device anlegen:</b></br>
  Um individuelle Settings für ein Device anzulegen, muss das entsprechende Device aus der Liste unterhalb der Parameter ausgewählt werden und der Button 'Individuelle Settings für Device anlegen' geklickt werden. Danach erscheint in der Auswahl 'Device' im oberen Bereich auch das entsprechende Device zur Auswahl. Ist nun das Device angelegt, dann kann man im Feld 'Section' die einzelnen Bereiche auswählen, für die man individuelle Settings einstellen und speichern kann. Änderungen müssen durch anklicken des Button 'Settings in DB schreiben' gesichert werden. Sonst sind die Änderungen unwirksam.</p>

  <img class="img_norm" src="help/images/Settings3.png" alt="Settings für Device individuell anlegen">
  <p><b>Device aus individuellen Settings entfernen:</b></br>
  Ein Device kann auch aus den individuellen Settings wieder entfernt werden. Dazu muss das entsprechende Device ausgewählt werdne und der Button 'Device aus individuellen Settings entfernen' angeklickt werden. Derzeit findet keine Sicherheitsabfrage statt. Die Individuellen Settings werden unwiderruflich gelöscht und das Device verwendet dann die Settings, die unter '_DEFAULT' hinterlegt sind. Um individuelle Settings für das Device wieder zu verwenden, muss es erst wieder neu angelegt werden.</p>
  <img class="img_norm" src="help/images/Settings4.png" alt="Device aus individuellen Settings entfernen">
  <p><b>Sprache des Webinterfaces ändern:</b></br>
  Derzeit sind die Srpachen Deutsch, Englisch und Italienisch integriert. Man kann sie durch Eingabe von DE, EN oder IT im entsprechenden Konfigurationsfeld auswählen.</p>
  <img class="img_norm" src="help/images/Settings5.png" alt="Device aus individuellen Settings entfernen">
<p>Andere Sprachen könnne hinuzgefügt werden. Hierfür müssen die Tabellen Settings und Strings durch entpsrechende Spalten ergänzt werden. Dazu kann z.B. phpmyadmin genutzt werden. Soll z.B. Niederländisch als Sprache ergänzt werden, so muss in den genannten Tabellen eine Spalte mit Description_NL ergänzt werden und die Zeilen mit der passenden Übersetzung eingetragen werden. Danach kann man im Webinterface NL als Sprache eingeben und es werden die Beschreibungen aus der Spalte Description_NL für das Webinterface verwendet. Um Sprachen zu ergänzen, sollte die Settings Tabelle idealerweise keine individuellen Devices enthalten, da man sonst Felder mehrfach eintragen muss.</p>
<p><b>Tabelle Settings:</b></p>
  <img class="img_norm" src="help/images/Settings6.png" alt="Device aus individuellen Settings entfernen">
<p><b>Tabelle Strings:</b></p>
  <img class="img_norm" src="help/images/Settings7.png" alt="Device aus individuellen Settings entfernen">
  <p><b>Layout Webinterfaces ändern:</b></br>
  <p>In den Settings kann auch das Layout des Webinterfaces geändert werden. Aktuell stehen 4 verschiedene Layouts zur Verfügung</p>
  <p>Das Default Layout ist 'Wasser'</p>
  <img class="img_norm" src="help/images/Settings8.png" alt="Layout ändern">
  <p>Es gibt noch die Layouts Hopfen, Malz und Rot/Raspberry</p>
  <img src="help/images/Settings8h.png" alt="Layout Hopfen">
  <img src="help/images/Settings8m.png" alt="Layout Malz">
  <img src="help/images/Settings8r.png" alt="Layout Rot"> 
</div>

<div id="calibration" style="margin-left:15%;padding:1px 16px;height:1500px;">
  <h2>Kalibrierung</h2>
  <p>Von der Hauptseite kommt man über den Link 'Spindel im TCP Server kalibrieren' auf die Kalibrierseite.</br>
     Um zurück zur Hauptseite zu kommen, kann man oben links den 'Home' Button oder den 'Zurück' Button verwenden.</br>
     Im Auswahlfeld muss die Spindel selektiert werden, für die im Server eine Kalibrierung hinterlegt werden soll. </br>
     <b>Um alle Funktionen des Servers nutzen zu können sollte für jede verwendete Spindel auch eine Kalibrierung hinterlegt sein</b></p>
  <img class="img_norm" src="help/images/Calibrate1.png" alt="Spindel fuer Kalibrierung auswaehlen">
  <p>Danach können die 4 Konstanten eingegeben werden, die z.B. mit dem Excel Sheet für die Kalibrierung berechnet wurden. Um die Kalibrierung auch zu speichern, muss der Button 'Kalibrierung an DB senden' noch angeklickt werden. Bei alle Diagrammen, außer plato.php wird nun die Stammwürze, bzw. der Restextrakt oder der Vergärungsgrad mit den für diese Spindel mit der hinterlegten Kalibrierung berechnet. Das gleiche gilt für die Berechnungen in den Email Alarmen. Eine Berechnung auf Basis der von der Spindel übermittelten Gravity Werte ist derzeit nicht integriert. Im Server können Polynome 3. Grades verwendet werden. Sollte nur ein Polynom zweiten Grades verwendet werden, so muss bei der Konstante für x3 eine '0' eingegeben werden.</p>
  <img class="img_norm" src="help/images/Calibrate2.png" alt="Kalibrierung an DB senden">
</div>

<div id="diagram" style="margin-left:15%;padding:1px 16px;height:4000px;">
  <h2>Diagramme</h2>
  <p>Die Diagramme werden von der Hauptseite aus für die ausgewählte Spindel aufgerufen.</br>
     Wird ein Diagramm mit dem Resetflag aufgerufen, so werden Daten für die ausgewählte Spindel seit dem letzten Rest dargestellt.</br>
     In der Kopfzeile des Diagramms ist der Name der Spindel und der aktuelle Sudname zu sehen. Oben rechts ist ein 'Home' Button integriert. Beim Anklicken des Buttons kommt man wieder zur Hauptseite zurück.</br>
</p>
  <img class="img_norm" src="help/images/Diagramm1.png" alt="Diagramm mit Reset">
  <p>Wird das Resetflag auf der Hauptseite beim Laden des Diagramms nicht gewählt, sondern nur wie im Beispiel 12 Tage, dann werden die letzten 12 Tage für die Spindel ab dem jetzigen Datum dargestellt.</p>
  <img class="img_norm" src="help/images/Diagramm2.png" alt="Diagramm2">
  <p>Wenn man die Maus über das Diagramm bewegt, so werden die Daten der Kurven auch noch einmal für den entsprechenden Zeitpunkt als Tooltip angezeigt.</p>
  <img class="img_norm" src="help/images/Diagramm3.png" alt="Diagramm3">
  <p>Am rechten oberen Rand der x/y-Diagramme ist ein Menü, mit dem man das Diagramm als PDF oder Bild abspeichern kann.</p>
  <img class="img_norm" src="help/images/Diagramm4.png" alt="Diagramm4">
  <p>Da die Spindelwerte insbesondere bei obergärigen Hefen stärkeren Schwankungen unterliegen können, gibt es die Möglichkeit einige Diagramme (Extrakt vom Server und Winkel) normal oder geglättet darzustellen. Bei der Glättung wird ein gleitender Mittelwert berechnet. Als default wird ein Zeitraum von 120 Minuten verwendet. Details können im Abschnitt php Script Parameter angesehen werden.</p>
  <img class="img_small" src="help/images/Diagramm5.png" alt="Diagramm normal">
  <img class="img_small" src="help/images/Diagramm6.png" alt="Diagramm geglaettet">
</div>

<div id="archive" style="margin-left:15%;padding:1px 16px;height:4500px;">
  <h2>Archiv</h2>
  <p>Für die Sude wird eine Archivtabelle angelegt. Somit ist es auch möglich, alte Sude wieder aufzurufen und z.B. zu exportieren. Ein entsprechender Eintrag für einen Sud in die Archivtabelle wird gemacht, wenn man auf der Indexseite die Funktion 'Gärbeginn Zeitpunkt setzen wählt'. Sobald ein Sud in der Archivtabelle angelegt ist, sieht man auch auf der index Seite einen Button 'Archiv laden'. Wird dieser Button gedrückt, so gelangt man auf diese Seite.</p>
  <p> In den Settings gibt es unter GLOBAL / DIAGRAM zwei Parameter, die man für das Archiv einstellen kann. Der Parameter ARCHIV_SORT legt die Reihenfolge der angezeigten Sude fest. Das kann auf- oder absteigend sein. Der Parameter ARCHIVE_AUTO_CHANGE legt fest, ob bei jeder Änderung der Auswahl vom Archiv bzw. Diagramtyp die Daten automatisch neu dargestellt werden oder ob es einen Button gibt, der gedrückt werden muss, um das Diagramm neu darzustellen. Prinzipiell ist die Automatik komfortabler. Allerdings könnte das bei langsameren Systemen/Datenbankinstallationen zu unnötigen Verzögerungen führen. Somit kann man das über den entsprechenden Parameter ausstellen.</br>
  Man kann auch einen Sud aus dem Archiv löschen. Hierzu muss der Butten 'Gewählte Fermentation löschen' gedrückt werden. <b>Achtung: Das Entfenren kann nicht Rückgängig gemacht werden!</b><p>

  <img class="img_norm" src="help/images/Archiv1.png" alt="Archiv1">
  </br>
  <p>Hier hat man die Möglichkeit, die im Archiv angelegten Sude auszuwählen.</p>
  <img class="img_small" src="help/images/Archiv2.png" alt="Archiv2">
  <p>Außerdem kann man verschiedene Diagramtypen auswählen, die dann dargestellt werden.</p>
  <img class="img_small" src="help/images/Archiv3.png" alt="Archiv3">
  <p>Wenn man mit der Maus über das Diagram geht, kann man eine bestimmten Stelle mit einem Mausklick markieren und für diesen Zeitpunkt dann einen Kommentar eingeben. Als Beispiel kann man hier z.B. 'Hefegabe' sehen. Wir kein Kommentar eingegeben, so wird am markierten Zeitpunkt das Ende des Archivs markiert.</p>
  <img class="img_small" src="help/images/Archiv4.png" alt="Archiv4">
  <p>Das nächste Bild zeigt eine Fermentation, die bis zum 25.10 lief. Die Spindel wurd dann ausgestellt und am 8. November für die nächste Fermentation wieder angestellt. Der nächste Datenpunkt wir noch der aktuellen Fermentation zugeordnet, da noch keine neue über 'Gärzeitpuknt Beginn setzen' im Archiv angelegt wurde.</p>
  <p>Man hat nun die Möglichkeit, im Diagramm mit einem Mausklick einen Zeitpunkt für das Ende der Fermentation zu wählen. Danach muss der Button 'Archiv Ende festlegen/Kommentar schreiben' gedrückt werden. Allerdings muss das Kommentarfeld leer gelassen werden. Dann wird ein Flag in der Datenbank gesetzt, dass das Ende der Fermentation festlegt.</p>
  <img class="img_norm" src="help/images/Archiv6.png" alt="Archiv6">
  <p>Das Diagram wird danach automatisch noch einmal geladen und die Fermentation wird nur noch bis zum gewählten Ende angezeigt. Die Daten in der Zusammenfassung oberhalb des Diagrams werden auch entsprechend aktualisiert/berechnet</p>
  <p>Sollte man das FLag für das Ende des Archivs falsch gesetzt haben, so kann man es auch wieder entfernen. Beim nochmaligen Laden des Diagrams erscheint für Archive, die das entsprechende Flag gesetzt haben ein Button, über den man das Flag wiede rentfernen kann -> 'Flag "Archiv Ende" entfernen'</p>
  <img class="img_norm" src="help/images/Archiv7.png" alt="Archiv7">
  <p>Oberhalb der Archiv Diagramme ist noch eine Zusammenfassung der gewählten Fermentation. Hier werden verschiedene Parameter, wie die berechnete Stammwürze, der Vergärungsgrad oder Alkoholgehalt angezeigt.</p>
  <img class="img_small" src="help/images/Archiv5.png" alt="Archiv5">
  <p>Man hat hier auch die Möglichkeit die Daten der aktuell angezeigten Fermentation als CSV File zu exportieren. Hier gibt es verschiedene Möglichkeiten:</p>
  <ol>
    <li><b>CSV:</b> CSV file inkl. Zusammenfassung, der in Excel importiert werden kann</li>
    <li><b>Beersmith:</b> CSV File, das in Beersmith importiert werden kann (Ein Datenpunkt / 4 Stunden) </li>
    <li><b>KBH2:</b> CSV File, dasr in den Kleinen Brauhelfer 2 per copy & paste importiert werden kann (Ein Datenpunkt / 4 Stunden) </li>
  </ol>

</div>


<div id="sendmail" style="margin-left:15%;padding:1px 16px;height:3000px;">
  <h2>Email Alarme Konfigurieren</h2>
  <p>Der Server kann so konfiguriert werden, dass er Email Alarme, bzw. eine tägliche Status Email versendet. Hierzu müssen Einstellungen in den Settings vorgenommen werden.</br></br>
     Zunächst müssen erst einmal die Daten des Email Kontos eingegeben werden. Die Änderungen müssen erst gespeichert werden ('Settings in DB schreiben'), bevor sie wirksam wird. Die Globalen Einstellungen gelten für alle Devices.</br></br>
     Mit den Button 'Sende Test Email' kann getestet werden, ob das versenden funktioniert. Sollte es Probleme geben, so können über den Parameter ENABLEDEBUG noch mehr Details zum Problem während des Versands der Test Email angezeigt werden.</br></br>
Über den Parameter ENABLESTATUS kann man festlegen, ob eine tägliche Statusemail der Daten versendet werdne soll. Der Parameter TIMESTATUS legt die Uhrzeit fest, zu der eine Statusemail versendet wird. 6 steht z.B. für 6:00. Da der Server nur eine Email sendet, wenn auch Daten von einer Spindel kommen, ist ein Zeitraum von +/- 15 Minuten festgelegt. Somit kommt dann bei der Auswahl von 6 eine Email zwischen 5:45 und 6:15, falls eine Spindel Daten sendet.</br></br>
Wenn man z.B. eine ganze Reihe von Devices hat, für die keine Email versendet werden soll, so kann man diesen im Namen ein Kürzel geben. Entspricht das Kürzel dem Feld EXCLUDESTRING, so werden diese Devices beim Email Versand nicht berücksichtigt.</p>
  <img class="img_norm" src="help/images/email1.png" alt="Globale Email Settings">
  <p>Wechselt man nun bei den Settings auf das Device _DEFAULT können nun die Default Settings eingstellt werden. Diese werden dann auch erst einmal für jede Spindel verwendet. Die Default Settings können auch für ein Device kopiert und dann geändert werden. Somit hat man die Möglichkeit, diese Einstellungen für jedes Devices anders anzupassen</p>
  <img class="img_norm" src="help/images/email2.png" alt="Default Email Settings">
  <p>Hier kann man sehen, dass z.B. Settings für das Device 'iSpindel001' angelegt worden sind. Für diese SPindel werden dann diese Settings herangezogen, während für die anderen Spindeln die Settings unter '_DEFAULT' verwendet werden.</p>
  <img class="img_norm" src="help/images/email3.png" alt="Individuelle Email Settings">
  <p>Wenn alle Einstellung vorgenommen und gespeichert wurden, kommt man mit dem Home Button wieder zur Hauptseite zurück.</p>
</div>


<div id="parameter" style="margin-left:15%;padding:1px 16px;height:3000px;">
  <h2>php Script Parameter</h2>
  <p>Die meisten Seiten des Servers können mit Parametern geladen werden. Die möglichen Parameter für jedes Script sind unten beschrieben. Prinzipiell werden die ensprechenden PArameter bereits über dne Aufruf der Scripte von der Hauptseite gewählt.</p>
  <p>Der Aufruf eines Scripts sieht dann z.B. so aus:</p>
  <p>http://IP.DES.SERVERS/iSpindle/plato4.php?name=iSpindel001&days=7</p>
  <p>Der erste Parameter wird mit einem ? hinter dem .php geschrieben und der Wert wird dann hinter einem '=' gesetzt. Möchte man mehrere Parameter an das Script übergeben, sie geschieht die Verknüpfung über ein '&'.</p>
  <p></p>

<div id="php_Parameter_10648" align=left x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=933 style='border-collapse:
 collapse;table-layout:fixed;width:700pt'>
 <col width=273 span=2 style='width:205pt'>
 <col width=387 style='mso-width-source:userset;mso-width-alt:14153;width:290pt'>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6310648 width=273 style='height:15.75pt;width:205pt'>Seite</td>
  <td class=xl6310648 width=273 style='border-left:none;width:205pt'>Paramter</td>
  <td class=xl6810648 width=387 style='border-left:none;width:290pt'>Ergebnis</td>
 </tr>
 <tr height=86 style='height:64.5pt'>
  <td height=86 class=xl6910648 width=273 style='height:64.5pt;border-top:none;
  width:205pt'>index.php</td>
  <td class=xl6410648 width=273 style='border-top:none;border-left:none;
  width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;border-left:none;
  width:290pt'>Wenn die Seite mit dem Parameter geladen wird, so wird nicht der
  default Wert für daysago aus der config Datei verwendet, sondern der Wert von
  days. So kann man z.B. die suche nach Daten über einen längeren Zeitraum
  ermöglichen, ohne den Defaultwert ändern zu müssen</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>angle.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Wochen, für die Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=247 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:185.25pt;border-top:none;width:205pt'>angle_ma.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-left:
  none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Anzahl der Wochen, für die
  Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Zeitraum in
  Minuten, für den der gleitende Mittelwert berechnet wird. Wird der Parameter
  nicht verwendet, so wird ein default Wert von 120 Minuten zur Berechnung
  herangezogen.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6910648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>battery.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>batterytrend.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Wochen, für die Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6910648 width=273 style='height:26.25pt;border-top:
  none;width:205pt'>calibration.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die die Kalibrierung durchgeführt werden soll.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl7010648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>plato4_delta.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Anzahl der Wochen, für die
  Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden.</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl7110648 width=273 style='height:51.75pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-left:none;width:205pt'>reset=TRUE
  (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl7210648 width=273 style='height:51.75pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Zeitraum in
  Minuten, für den die Differenz der Gravity berechnet wird. Wird der Parameter
  nicht verwendet, so wird ein default Wert von 720 Minuten (12 Stunden) zur
  Berechnung herangezogen.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=247 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:185.25pt;border-top:none;width:205pt'>plato4_ma.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-left:
  none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Anzahl der Wochen, für die
  Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Zeitraum in
  Minuten, für den der gleitende Mittelwert berechnet wird. Wird der Parameter
  nicht verwendet, so wird ein default Wert von 120 Minuten zur Berechnung
  herangezogen.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>plato4.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Wochen, für die Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>plato.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Wochen, für die Daten im Diagramm dargestellt werden (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Tage, für die Daten im Diagramm dargestellt werden (default=7 bzw. der Wert
  aus der php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Anzahl der
  Stunden, für die Daten im Diagramm dargestellt werden (default=0). Alle drei
  Werte können Kombiniert werden</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>Soll das Diagramm seit dem
  letzten Setzen des Resetflags dargetellt werden, so ist hier eine 1 zu
  wählen. Dieses Flag überschreibt auch alle eventuell gewählten Parameter
  bzgl. Weeks, Days und Hours.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td rowspan=2 height=70 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:52.5pt;border-top:none;width:205pt'>reset_now.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Reset Flag in der Datenbank gesetzt werden soll.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>recipe=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Neuer
  Rezeptname für die Spindel, der ab dem Reset verwendet wird.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=2 height=42 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:31.5pt;border-top:none;width:205pt'>settings.php</td>
  <td class=xl6410648 width=273 style='border-top:none;border-left:none;
  width:205pt'>device=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;border-left:none;
  width:290pt'>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6410648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>recipe=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;border-left:none;
  width:290pt'>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6910648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>status.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=157 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:117.75pt;border-top:none;width:205pt'>svg_ma.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>keine
  Auswirkung</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>keine
  Auswirkung</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>keine
  Auswirkung</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>keine
  Auswirkung</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Zeitraum in
  Minuten, für den der gleitende Mittelwert berechnet wird. Wird der Parameter
  nicht verwendet, so wird ein default Wert von 120 Minuten zur Berechnung
  herangezogen.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6910648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>wifi.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name der
  Spindel, für die das Diagramm erstellt werden soll.</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=273 style='width:205pt'></td>
  <td width=273 style='width:205pt'></td>
  <td width=387 style='width:290pt'></td>
 </tr>
 <![endif]>
</table>

</div>

  <p></p>

</div>
<div id="about" style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>About</h2>
  <p>Der Server wurde von Tozzi initiiert und entwickelt. Die Weiterentwicklung und Portierung auf python3 wurde von mrhyde vorgenommen.</p>
  <p>Eine Diskussion über den Server kann im Hybbybrauerforum verfolgt werden: https://hobbybrauer.de/forum/viewtopic.php?f=58&t=12869</p>
  <p>Die neueste Version des Servers kann <a href="https://github.com/avollkopf/iSpindel-TCP-Server">hier</a> gefunden werden.</p>
  <p>Der Server verwendet folgende Resourcen zur Unterstützung:</p>
  <p><a href="https://www.highcharts.com">Highcharts für die Diagramdarstellung</a></p>
  <p><a href="https://github.com/PHPMailer/PHPMailer">PHPMailer für die Mailfunktionen</a></p>
  <p><a href="https://www.deviantart.com/blackvariant">Buttons sind von Blackvariant</a></p>
</div>
</div>

<script>
var scrollPos = 0;
var sections = ["lnk_home","lnk_main","lnk_config","lnk_calibration","lnk_diagram","lnk_archive","lnk_sendmail","lnk_parameter","lnk_about"];

window.onscroll = function() {myFunction()};

function myFunction() {

  if ((document.body.getBoundingClientRect()).top > scrollPos)
                var direction = 'UP';
        else
                var direction = 'DOWN';
        // saves the new position for iteration.
        scrollPos = (document.body.getBoundingClientRect()).top;

  var h = window.innerHeight;
  var offsets = document.getElementById('home').getBoundingClientRect();
  var home_top = offsets.top;
  var home_bottom = offsets.bottom;;
  var offsets = document.getElementById('main').getBoundingClientRect();
  var main_top = offsets.top;
  var main_bottom = offsets.bottom;
  var offsets = document.getElementById('config').getBoundingClientRect();
  var config_top = offsets.top;
  var config_bottom = offsets.bottom;
  var offsets = document.getElementById('calibration').getBoundingClientRect();
  var calibration_top = offsets.top;
  var calibration_bottom = offsets.bottom;
  var offsets = document.getElementById('diagram').getBoundingClientRect();
  var diagram_top = offsets.top;
  var diagram_bottom = offsets.bottom;
  var offsets = document.getElementById('archive').getBoundingClientRect();
  var archive_top = offsets.top;
  var archive_bottom = offsets.bottom;
  var offsets = document.getElementById('sendmail').getBoundingClientRect();
  var sendmail_top = offsets.top;
  var sendmail_bottom = offsets.bottom;
  var offsets = document.getElementById('parameter').getBoundingClientRect();
  var parameter_top = offsets.top;
  var parameter_bottom = offsets.bottom;
  var offsets = document.getElementById('about').getBoundingClientRect();
  var about_top = offsets.top;
  var about_bottom = offsets.bottom;
  
  var positions = [{"ID": 0,"name": "lnk_home","position_top": home_top,"position_bottom": home_bottom},
                   {"ID": 1,"name": "lnk_main","position_top": main_top,"position_bottom": main_bottom},
                   {"ID": 2,"name": "lnk_config","position_top": config_top,"position_bottom": config_bottom}, 
                   {"ID": 3,"name": "lnk_calibration","position_top": calibration_top,"position_bottom": calibration_bottom}, 
                   {"ID": 4,"name": "lnk_diagram","position_top": diagram_top,"position_bottom": diagram_bottom},
                   {"ID": 5,"name": "lnk_archive","position_top": archive_top,"position_bottom": archive_bottom}, 
                   {"ID": 6,"name": "lnk_sendmail","position_top": sendmail_top,"position_bottom": sendmail_bottom}, 
                   {"ID": 7,"name": "lnk_parameter","position_top": parameter_top,"position_bottom": parameter_bottom}, 
                   {"ID": 8,"name": "lnk_about","position_top": about_top,"position_bottom": about_bottom}];

  min_top = getMin(positions,"position_top");
  min_bottom = getMin(positions,"position_bottom");
  if (direction == 'DOWN'){
  if (min_top.position_top <= h){
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  var newActive = document.getElementById(min_top.name);
  newActive.className += " active";}
  }

  if (direction == 'UP'){
  if (min_top.position_top >= h){
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  var newActive = document.getElementById(min_bottom.name);
  newActive.className += " active";}
  }

}

function getMin(arr, prop) {
    var min;
    for (var i=0 ; i<arr.length ; i++) {
        if (min == null || parseInt(Math.abs(arr[i][prop])) < parseInt(Math.abs(min[prop])))
            min = arr[i];
    }
    return min;
}

</script>

</body>
</form>
</html>
