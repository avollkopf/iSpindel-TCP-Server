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
  <a id="lnk_home"class="lnk active" href="#home">Help</a>
  <a id="lnk_main" class="lnk" href="#main">Main Page</a>
  <a id="lnk_config" class="lnk" href="#config">Configuration</a>
  <a id="lnk_calibration" class="lnk" href="#calibration">Calibration</a>
  <a id="lnk_diagram" class="lnk" href="#diagram">Diagrams</a>
  <a id="lnk_archive" class="lnk" href="#archive">Archive</a>
  <a id="lnk_sendmail" class="lnk" href="#sendmail">Email Alarm Configuration</a>
  <a id="lnk_parameter" class="lnk" href="#parameter">php Script Parameters</a>
  <a id="lnk_about" class="lnk" href="#about">About</a>
  <a id="lnk_back" class="lnk" href="index.php">Back</a>
</div>

<div id="home" style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>Help</h2>
  <p>This server script, written in Python, is used to receive raw data coming from the iSpindel via a generic TCP connection. Not required overhead through protocols such as http is deliberately omitted in order to reduce the power consumption of the iSpindel as much as possible. The received data can also be saved as CSV ("Comma Separated Values") in text files. It is possible and recommended to have the data in a MySQL database. This gives you a local server that works even without an internet connection and enables the iSpindel to be used in the home network. Access times are short which results in low power consumption of the spindle.</p>

<p>In order support the data transfer to Ubidots or other services, there is also the option of forwarding the data as well. This is done transparently, without the iSpindel having to wait for the connection. The local server then acts basically as a proxy.</p>

<p>The script is platform-independent and can e.g. on a Raspberry Pi or a NAS. However, it can also be used on a possibly rented dedicated (or virtual) server or any computer in the home network. The operation of several iSpindles at the same time works smoothly and without delays, as multithreading is implemented. It was tested under Linux (Ubuntu container of a QNAP NAS and Raspbian Buster), but it should also run without problems under Windows. The only requirement is that Python (3), an Apache server and a database are installed.</p>

<p>For the connection to MySQL the python-mysql.connector must also be installed. In the configuration of the iSpindel select TCP and enter the IP address of the server on which the script is running. It is best to choose the preset 9501 as the port.</p>

<p>Now the script itself still has to be configured. Detailed instructions can be found in the INSTALL_en.md file</p>

<p>An update can be started from the installation directory with sudo ./update.sh or sudo ./update-rapsi.sh.</br>
If new strings or settings are available during the update, this will be displayed on the main page. Then the expert settings must be selected and an update of the corresponding tables can be started.</p>
</div>

<div id="main" style="margin-left:15%;padding:1px 16px;height:4000px;">
  <h2>Main Page</h2>
  <p> If the server is correctly installed and running, the main page can be called up via the IP of the server (e.g. http://192.168.10.11/iSpindle/index.php) </p>
  <p> If data from spindles have been sent to the database within the last 7 days (default), you can see the last data record of the spindles on the page, provided this is done via the 'SHOWSUMMARY' parameter in the 'GENERAL' section in the settings activated. </p>
  <p> If no data is displayed, you can increase the number of days in the history until data is displayed </p>
  <p> There is also the possibility to display older fermentations in the archive. To do this, the 'Load archive' button must be pressed. How a brew is created in the archive is described below. </p>
  <p> It is also displayed whether and with which PID the server is running in the background. </p>
  <p> On the main page there is also the possibility to open the page for the calibration of the spindles. To do this, the button 'Calibrate spindle in TCP server' must be clicked. Clicking the 'Edit TCP Server Settings' button loads the configuration page. </p>
  <img class="img_norm" src="help/images/index1.png" alt="Hauptseite mit Übersicht">
  <p> If no data has been written to the database in the past 7 days, the option is offered to change the period in order to display older data for spindles. If you click the button 'Customize history', the main page will be reloaded. </p>
  <img class="img_norm" src="help/images/index2.png" alt="Hauptseite ohne Daten">
  <p>The corresponding device can be selected on this page: </p>
  <img class="img_norm" src="help/images/index3.png" alt="Hauptseite Device auswählen">
  <p> You can then select a diagram or a function for the selected device. After selecting the diagram, the button 'Show diagram' has to be clicked and the corresponding page opens. </p>
  <p> The following functions can be selected for the selected spindle: </p>
  <ol>
    <li> <b> Set fermentation start time:</b>Define a name for a fermentation and store it in the archive </li>
    <li> <b> Set fermentation end time:</b>Set the end point of fermentation in the archive </li>
    <li> <b> Enter comment:</b> Enter comment for current fermentation / data point </li>
  </ol>
  <img class="img_norm" src="help/images/index4.png" alt="Hauptseite Funktion/Diagramm auswählen">
  <p> On the main page there is also the option to select expert settings. To do this, the corresponding checkbox must be activated. Here, for example, the settings can be reset to default values</p>
  <p> If an update is installed, it is possible that new functions or settings have been added to the server. The index page informs about it. Then the expert settings must be activated and you can update the so-called strings table or the settings table. Please note, that all settings are reset to default values when the settings table is updated. The current settings can also be exported as a backup before an update on the Settings page and imported again later </p>
  <img class="img_norm" src="help/images/index5.png" alt="Hauptseite Experten Einstellungen">
</div>

<div id="config" style="margin-left:15%;padding:1px 16px;height:6500px;">
  <h2>Configuration</h2>
  <p>From the main page you can get to the settings page via the link 'Edit TCP Server Settings' </br>
  <p>To get back to the main page, you can use the 'Home' button or the 'Back' button at the top left </br>
  <p>There you have the option of defining various settings. The settings are initially divided into 'Devices': </p>
  <b>Devices:</b>
  <p style = "white-space: pre;">GLOBAL&#9; Settings are server-specific and therefore the same for all devices. </br> _DEFAULT&#9; Settings apply to all devices that have no individual settings. These settings can be copied for each device and then individually adapted. </br> iSpindel001&#9; Example name for a device with the name iSpindel001 that was created for individual settings. </p>
  <p>In addition, you can export both the data table and the database settings by clicking the corresponding button. A later import is also possible here using the import function. </p>
  <img class="img_norm" src="help/images/Settings1.png" alt="Settings Deviceauswahl">
  <p><b>Sections:</b></br>
  Additionally, settings are divided into so-called sections in order to have a better overview. It may be that e.g. when selecting 'GOBAL' and e.g. 'BREWSPY' no settings are displayed, as these can only be seen under '_DEFAULT' or a created individual device. </p>
  <img class="img_norm" src="help/images/Settings2.png" alt="Settings Sectionauswahl">
  <p><b>Save Settings:</b></br>
  If settings are changed, they must be transferred to the database with the button 'Write settings to DB', otherwise changes will have no effect. </p>
  </br>
  <p><b>Add individual settings for a device:</b></br>
  In order to create individual settings for a device, the corresponding device must be selected from the list below the parameters and the button 'Create individual settings for device' clicked. The corresponding device then appears for selection in the 'Device' selection in the upper area. Once the device has been created, you can select the individual areas for which you can set and save individual settings in the 'Section' field. Changes must be saved by clicking the button 'Write settings to DB'. Otherwise the changes are ineffective. </p>

  <img class="img_norm" src="help/images/Settings3.png" alt="Settings für Device individuell anlegen">
  <p><b>Remove individual settings for device:</b></br>
  Individual settings can be also removed for a device. To do this, the corresponding device must be selected and the 'Remove device from individual settings' button clicked. There is currently no security query. The individual settings are irrevocably deleted and the device then uses the settings that are stored under '_DEFAULT'. In order to use individual settings for the device again, it must first be created again. </p>
  <img class="img_norm" src="help/images/Settings4.png" alt="Device aus individuellen Settings entfernen">
  <p><b>Change language of the web interface:</b></br>
  Currently the languages German, English and Italian are integrated. You can select it by entering DE, EN or IT in the corresponding configuration field. </p>
  <img class="img_norm" src="help/images/Settings5.png" alt="Device aus individuellen Settings entfernen">
<p> Other languages can be added. For this purpose, additional columns must be added to the tables Settings and Strings. For this purpose, e.g. phpmyadmin can be used. If e.g. Dutch should be added as language, a column with Description_NL must be added in the tables mentioned and the lines must be entered with the appropriate translation. Then you can enter NL as the language in the web interface and the descriptions from the Description_NL column are used for the web interface. In order to add languages, the settings table should ideally not contain any individual devices, otherwise fields would have to be entered multiple times. </p>

<p><b>Settings table:</b></p>
  <img class="img_norm" src="help/images/Settings6.png" alt="Device aus individuellen Settings entfernen">
<p><b>Strings table:</b></p>
  <img class="img_norm" src="help/images/Settings7.png" alt="Device aus individuellen Settings entfernen">
  <p><b>Change web interface layout:</b></br>
  <p> The layout of the web interface can also be changed in the settings. There are currently 4 different layouts available </p>
  <p>The Default layout is 'Water'</p>
  <img class="img_norm" src="help/images/Settings8.png" alt="Layout ändern">
  <p>Additional layouts are Hops, Malt and Red/Raspberry</p>
  <img src="help/images/Settings8h.png" alt="Layout Hopfen">
  <img src="help/images/Settings8m.png" alt="Layout Malz">
  <img src="help/images/Settings8r.png" alt="Layout Rot"> 
</div>

<div id="calibration" style="margin-left:15%;padding:1px 16px;height:1500px;">
  <h2>Calibration</h2>
  <p>From the main page you can access the calibration page via the link 'Calibrate spindle in TCP server'. </br>
     To get back to the main page, you can use the 'Home' button or the 'Back' button at the top left. </br>
     The spindle for which a calibration is to be stored in the server must be selected in the selection field. </br>
     <b>In order to be able to use all functions of the server, a calibration should also be stored for each spindle used </b> </p>
  <img class="img_norm" src="help/images/Calibrate1.png" alt="Spindel fuer Kalibrierung auswaehlen">
  <p>Then the 4 constants can be entered, e.g. calculated with the Excel sheet for the calibration. In order to also save the calibration, the button 'Send calibration to DB' still has to be clicked. For all diagrams, except for plato.php, the original wort or the residual extract or the degree of fermentation is now calculated with the calibration stored for this spindle. The same applies to the calculations in the email alarms. A calculation based on the gravity values transmitted by the spindle is currently not integrated. 3rd degree polynomials can be used in the server. If only a second degree polynomial is used, a '0' must be entered for the constant for x3.</p>
  <img class="img_norm" src="help/images/Calibrate2.png" alt="Kalibrierung an DB senden">
</div>

<div id="diagram" style="margin-left:15%;padding:1px 16px;height:4000px;">
  <h2>Diagrams</h2>
  <p>The diagrams are called from the main page for the selected spindle. </br>
     If the reset flag is checked, data for the selected spindle since the last reset is displayed. </br>
     The name of the spindle and the current fermentation name can be seen in the header of the diagram. A 'Home' button is integrated at the top right. Clicking the button takes you back to the main page. </br>
</p>
  <img class="img_norm" src="help/images/Diagramm1.png" alt="Diagramm mit Reset">
  <p>If the reset flag is not selected on the main page when the diagram is loaded, but only 12 days as in the example, then the last 12 days for the spindle from the current date are displayed. </p>
  <img class="img_norm" src="help/images/Diagramm2.png" alt="Diagramm2">
  <p>If you move the mouse over the diagram, the data of the curves are displayed again as a tooltip for the corresponding point in time. </p>
  <img class="img_norm" src="help/images/Diagramm3.png" alt="Diagramm3">
  <p>At the top right of the x / y diagrams is a menu with which the diagram can be saved as a PDF or image. </p>
  <img class="img_norm" src="help/images/Diagramm4.png" alt="Diagramm4">
  <p>Since the spindle values can be subject to greater fluctuations, especially with top-fermenting yeasts, it is possible to display some diagrams (extract from the server and angle) normal or smooth. A moving average is calculated for smoothing. A period of 120 minutes is used as the default. Details can be seen in the section php script parameters. </p>
  <img class="img_small" src="help/images/Diagramm5.png" alt="Diagramm normal">
  <img class="img_small" src="help/images/Diagramm6.png" alt="Diagramm geglaettet">
</div>

<div id="archive" style="margin-left:15%;padding:1px 16px;height:4500px;">
  <h2>Archive</h2>
  <p>An archive table is created for the fermentations. Thus it is also possible to display old fermentations and export them for instance. A corresponding entry for a fermentation in the archive table is made when you select the 'Set fermentation start time' function on the index page. As soon as a fermentation is created in the archive table, you can also see a button 'Load archive' on the index page. If this button is pressed, you get to this page. </p>
  <p>In the settings under GLOBAL / DIAGRAM there are two parameters that can be set for the archive. The ARCHIVE_SORT parameter defines the sequence of the brews displayed. That can be ascending or descending. The parameter ARCHIVE_AUTO_CHANGE determines whether the data are automatically redisplayed each time the archive or diagram type is changed, or whether there is a button that must be pressed to redisplay the diagram. In principle, the automatic is more convenient. However, this could lead to unnecessary delays in slower systems / database installations. So you can show this via the corresponding parameter. </br>
  You can also delete a fermentation from the archive. To do this, the button 'Delete selected fermentation' must be pressed. <b>Attention: The deletion cannot be undone! </b> <p>
  <img class="img_norm" src="help/images/Archiv1.png" alt="Archiv1">
  </br>
  <p>On this page you have the possibility to choose one of the fermentations stored in the arhcive.</p>
  <img class="img_small" src="help/images/Archiv2.png" alt="Archiv2">
  <p>You can also choose between differen tyoes of diagrams that can be displayed.</p>
  <img class="img_small" src="help/images/Archiv3.png" alt="Archiv3">
  <p> If you move the mouse over the diagram, you can mark a certain point with a mouse click and then enter a comment for this point in time. As an example you can see 'Pitching Yeast'. If no comment is entered, the end of the archive is flagged at the selected time. </p>
  <img class="img_small" src="help/images/Archiv4.png" alt="Archiv4">
  <p>The next picture shows a fermentation that ran until October 25th. The Spindel was switched off and turned on again on November 8th for the next fermentation. The next data point is still assigned to the current fermentation, since a new one has not yet been created in the archive via 'Set fermentation start'.</p>
  <p>You also have the option of selecting a point for the end of the fermentation in the diagram with a mouse click. Then the button 'Set archive end / write comment' must be pressed. However, the comment field must be left blank. Then a flag is set in the database that defines the end of the fermentation. </p>
  <img class="img_norm" src="help/images/Archiv6.png" alt="Archiv6">
  <p>The diagram is then automatically reloaded and the fermentation is only displayed until the selected end. The data in the summary above the diagram are also updated / calculated accordingly </p>
  <p> If you have set the flag for the end of the archive incorrectly, you can remove it again. When the diagram is reloaded, a button appears for archives that have set the corresponding flag, via which the flag can be removed again -> 'Remove flag "Archive end"' </p>
  <img class="img_norm" src="help/images/Archiv7.png" alt="Archiv7">
  <p>Above the archive diagrams is a summary of the selected fermentation shown. Various parameters, such as the calculated original wort, the degree of fermentation or alcohol content are displayed here. </p>
  <img class="img_small" src="help/images/Archiv5.png" alt="Archiv5">
  <p>You can also export the data of the currently displayed fermentation as a CSV file. There are different options here: </p>
  <ol>
    <li> <b> CSV: </b> CSV file including a summary, which can be imported into Excel </li>
    <li> <b> Beersmith: </b> CSV file that can be imported into Beersmith (one data point / 4 hours) </li>
    <li> <b> KBH2: </b> CSV file that can be imported into the Kleine Brauhelfer 2 via copy & paste (one data point / 4 hours) </li>
  </ol>
</div>


<div id="sendmail" style="margin-left:15%;padding:1px 16px;height:3000px;">
  <h2>Email Alarms Configuration</h2>
<p> The server can be configured to send email alarms or a daily status email. To do this, changes must be made in the settings. </br> </br>
     First of all, the data of the email account must be entered. The changes must first be saved ('write settings to DB') before they take effect. The global settings apply to all devices. </br> </br>
     With the button 'Send Test Email' you can test whether the sending works. If there are problems, the ENABLEDEBUG parameter can be used to display more details about the problem while the test email is being sent. </br> </br>
The ENABLESTATUS parameter can be used to specify whether a daily status email of the data should be sent. The TIMESTATUS parameter defines the time at which a status email is sent. 6 stands e.g. for 6:00. Since the server only sends an email when data comes from a spindle, a period of +/- 15 minutes is specified. If you select 6, you will receive an email between 5:45 and 6:15 if a spindle sends data. </br> </br>
If you e.g. has a number of devices for which no email should be sent, you can give them an abbreviation in their name. If the abbreviation corresponds to the EXCLUDESTRING field, these devices are not taken into account when sending emails. </p>
  <img class="img_norm" src="help/images/email1.png" alt="Globale Email Settings">
  <p>If you change to the device _DEFAULT in the settings, the default settings can now be set. These are then also used once for each spindle. The default settings can also be copied for a device and then changed. So you have the possibility to adjust these settings differently for each device </p>
  <img class="img_norm" src="help/images/email2.png" alt="Default Email Settings">
  <p>Here you can see that e.g. Settings for the device 'iSpindel001' have been created. These settings are then used for this spindle, while the settings under '_DEFAULT' are used for the other spindles. </p>
  <img class="img_norm" src="help/images/email3.png" alt="Individuelle Email Settings">
  <p>When all settings have been made and saved, the Home button takes you back to the main page. </p>
</div>


<div id="parameter" style="margin-left:15%;padding:1px 16px;height:3000px;">
  <h2>php Script Parameters</h2>
  <p>Most pages of the server can be loaded with parameters. The possible parameters for each script are described below. In principle, the corresponding parameters are already selected by calling up the scripts from the main page. </p>
  <p> When a script is called, e.g. like this: </p>
  <p> http://IP.OF.SERVER/iSpindle/plato4.php?name=iSpindel001&days=7</p>
  <p> The first parameter comes with a ? written behind the .php and the value is then placed behind an '='. If you want to transfer several parameters to the script, the link is made with a '&'. </p>
  <p> </p>

<div id="php_Parameter_10648" align=left x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=933 style='border-collapse:
 collapse;table-layout:fixed;width:700pt'>
 <col width=273 span=2 style='width:205pt'>
 <col width=387 style='mso-width-source:userset;mso-width-alt:14153;width:290pt'>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6310648 width=273 style='height:15.75pt;width:205pt'>Page</td>
  <td class=xl6310648 width=273 style='border-left:none;width:205pt'>Paramter</td>
  <td class=xl6810648 width=387 style='border-left:none;width:290pt'>Result</td>
 </tr>
 <tr height=86 style='height:64.5pt'>
  <td height=86 class=xl6910648 width=273 style='height:64.5pt;border-top:none;
  width:205pt'>index.php</td>
  <td class=xl6410648 width=273 style='border-top:none;border-left:none;
  width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;border-left:none;
  width:290pt'>When the page with the parameter is loaded, the
  default value for daysago from the config file is used, but the value of
  days. So you can e.g. searching for data over a long period of time
  without having to change the default value</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>angle.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the 
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of
  weeks, that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for 
   which data is shown in the diagram (default = 7 or the value from the php config)
  </td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours 
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed 
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites 
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=247 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:185.25pt;border-top:none;width:205pt'>angle_ma.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-left:
  none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Number of
  weeks, that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Period in minutes 
  for which the moving average is calculated. If the parameter is not used, a default 
  value of 120 minutes is used for the calculation.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6910648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>battery.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>batterytrend.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of weeks, 
  that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed 
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites 
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6910648 width=273 style='height:26.25pt;border-top:
  none;width:205pt'>calibration.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl7010648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>plato4_delta.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Number of weeks, that should be shown 
  in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl7110648 width=273 style='height:26.25pt;width:205pt'>&nbsp;</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl7110648 width=273 style='height:51.75pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-left:none;width:205pt'>reset=TRUE
  (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl7210648 width=273 style='height:51.75pt;width:205pt'>&nbsp;</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Period in minutes
  for which the moving average is calculated. If the parameter is not used, a default
  value of 120 minutes is used for the calculation.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=247 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:185.25pt;border-top:none;width:205pt'>plato4_ma.php</td>
  <td class=xl6710648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-left:
  none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='width:290pt'>Number of weeks, 
  that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Period in minutes
  for which the moving average is calculated. If the parameter is not used, a default
  value of 120 minutes is used for the calculation.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>plato4.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of weeks, 
  that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=5 height=195 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:146.25pt;border-top:none;width:205pt'>plato.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of weeks, 
  that should be shown in the diagram (default=0)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Number of days for
   which data is shown in the diagram (default = 7 or the value from the php config)</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6710648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6610648 width=387 style='border-top:none;width:290pt'>Number of hours
  for which data is shown in the diagram (default = 0). All three values can be combined</td>
 </tr>
 <tr height=69 style='height:51.75pt'>
  <td height=69 class=xl6510648 width=273 style='height:51.75pt;border-left:
  none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='width:290pt'>If the diagram is to be displayed
  since the reset flag was last set, a 1 must be selected here. This flag also overwrites
  any selected parameters for weeks, days and hours.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td rowspan=2 height=70 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:52.5pt;border-top:none;width:205pt'>reset_now.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the spindle 
  for which the Reset Flag will be set in the database.</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td height=35 class=xl6510648 width=273 style='height:26.25pt;border-top:
  none;border-left:none;width:205pt'>recipe=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>New Recipe Name
  for selected spindle, which is used after reset</td>
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
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td rowspan=6 height=157 class=xl7010648 width=273 style='border-bottom:1.0pt solid black;
  height:117.75pt;border-top:none;width:205pt'>svg_ma.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>weeks=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>No effect</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>days=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>No effect</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>hours=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>No effect</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6510648 width=273 style='height:15.75pt;border-top:
  none;border-left:none;width:205pt'>reset=TRUE (0 oder 1)</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>No effect</td>
 </tr>
 <tr height=52 style='height:39.0pt'>
  <td height=52 class=xl6510648 width=273 style='height:39.0pt;border-top:none;
  border-left:none;width:205pt'>moving=INTEGER</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Period in minutes
  for which the moving average is calculated. If the parameter is not used, a default
  value of 120 minutes is used for the calculation.</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6910648 width=273 style='height:15.75pt;border-top:
  none;width:205pt'>wifi.php</td>
  <td class=xl6510648 width=273 style='border-top:none;border-left:none;
  width:205pt'>name=STRING</td>
  <td class=xl6410648 width=387 style='border-top:none;width:290pt'>Name of the
  spindle, for which the diagram should be loaded.</td>
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
  <p>The initial server scripts have been developed by Tozzi. Further development and porting to Python3 was done by mr_hyde</p>
  <p>A discussion about this software can be followed in the German Hobbybrauerforum: https://hobbybrauer.de/forum/viewtopic.php?f=58&t=12869</p>
  <p>The lates version of the server can ba found  <a href="https://github.com/avollkopf/iSpindel-TCP-Server">here</a>.</p>
  <p>The server is using the following ressources:</p>
  <p><a href="https://www.highcharts.com">Highcharts for the Diagrams</a></p>
  <p><a href="https://github.com/PHPMailer/PHPMailer">PHPMailer for the mailfunctions</a></p>
  <p><a href="https://www.deviantart.com/blackvariant">Buttons are from Blackvariant</a></p>
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
