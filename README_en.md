# iSpindel Generic TCP Server

#### (iSpindle.py Version 4.0)

**Update (27.11.24)
- Updated Install instructions
- Compatibility with Debian Bookworm 

**Update (17.12.22)
- Updated Install instructions

**New (16.01.2021)
- Additional bugfix for calibration of a new spindle has been fixed.
- New raspi image incl. change on accessibilty of database from other hosts
- Excel sheet for calibration, which allows pulling data from the database and writing calibration values back.
- New downlodlink for Rapsi image incl. Excel sheet: (https://mrhyde.spdns.eu:8081/share.cgi?ssid=0xOk17o) Link valid until 16.02.2021

**New (09.01.2021)
- Bugfix for calibration
- index.php is testing, if default values exists for calibration table.
	- If not, table will be upgraded automatically.
	- Funvtion can be also extended for poetential database changes at a later point of time.
- to apply bugfix, just run an update as described in the install_en.md files


**New (03.01.2021)
- Added Help in English 
- Home Button included im Repo.
- Additional parameters for Archive to update diagrams automatically on changes in the selection (configurable)

**New (11.12.2020)
- KBH2 CSV export from archive
- Bug Fix for database migration from old version (automatic generation of archive table)
- Info on index page if  settings or strings tables need to be updated after runnuing update.sh
- New Raspi Image for Download.
	- ntp starts now and time should be synced automatically
	- default python version ist now python3 (can be changed via update-alternatives)

**New (05.12.2020)
- More detailied Installation manual for Raspi: (https://github.com/avollkopf/iSpindel-TCP-Server/blob/master/INSTALL_en_Raspi.md)
- Downloadable image for Raspi. 
- Possibility to forward data to Grainfather Connect (Individual settings need to be configured for each spindle)
	- Not yet inccluded in the image. pdate possible via git pull and settings database upgrade

**New (20.11.2020)
- Updated [Installation Instructions](INSTALL_en.md) for ubuntu (should also work for a rasbpi with small modifications)
- Updated setup.php script that informs you if write access is not granted for config directory

**New (14.08.2020)
-  3rd degree polynomial can be also used now 
- 'const0' has been added to database tables
- index.php checks, if const0 is existing in tables. If not, it is automatically added  to the tables calibration and archive.
--> Please make a Backup of your database prior upgrade to this version

**New (16.06.2020)**
This is a major release with quite a few changes
- iSpindel.py and sendmail.py are now compatible with python3.
	- New functions or changes will only be done on the python3 base files
	- The old python2 based version are still available and can be used with the database changes of this version. However, they won't be update in future releases
	- python2 based versions are located in the iSpindle directory with .py2 extensions
	- Not all functions could have been tested under python3 so far
	- tested: receiving data from a spindle, forwarding data to another tcp server, CraftBeerPi3
	- all other forwarding except for INFLUXDB should be theoretically also working
	- Testers and probably some help are required for INFLUXDB
	- Receiving an acknowloedement after sending data is not yet implemented for debugging
	- emanomater is integrated in the server (thanks to Jackfrost) -> corresponding data table needs to be created manually so far
- Settings and Strings tables for the webpages can be loaded and updated via web interface
- Backup and restore of individual settings can be done via web interface
- Data table incl. archive and calibration can be exported and re-imported via web interface
- Archive funcion added to view also old individual fermentation processes
	- An additional archive table is required for this function
	- The php scripts can migrate the database automaitcally from the index page if table is not available
	- Script also adds automatically some new columns to the data table
- Export function
    - Data can be exported from archive as CSV file (e.g. for Excel) to work with the data
	- Fermentation data can be also exported as beersmith csv file to import it to beersmith (V3.1)
- Layout
	- Overal summary of current data in table on index page
	- y-axis scales can be edited in settings for the diagrams
	- 4 colorschemes added via css that can be selected via settings (Water, Hops, Malt, Raspberry)  
- Setup proces of iSpindle database
	- Setupscript added that creates iSpindle database incl. all required tables and user if database is not available
	- However, iSPindle files, mysql or mariadb server, apache, python3 and mysql.connector have to be installed prior to this
	- Manual setup of database tables won't be reuired for fresh installation
- Some bugfixes .....

#### (iSpindle.py Version 1.6.0)

**New (15.10.2018)**
Moving Average Diagrams (thanks to mrhyde).
Also introducing the long-awaited "landing page", index.php.
Select iSpindels having been active for a default of 7 days (change this by appending "?days=x" to the URL or editing include/common_db.php)
Put this on your desktop or have it start up.

**New (02.10.2018)**
CBP3 support thanks to jlanger     
Brewpiless support thanks to ollinator2000     
iSpindel Remote Configuration: a set of config parameters can now be sent to the iSpindel as response.     
Currently, this is limited by the firmware to the "Interval" setting, although you can already set the polynomial and token parameters server side.      
You'll need firmware 6.0.1 or above for this.

**New (15.02.2018)**
New chart wifi.php shows current connection quality (RSSI).          
angle.php, plato.php and plato4.php have been updated and accept the new parameters "days" and "weeks".        
Their subtitles will reflect these changes now and will make the charts easier to read.        
For example, a timeframe of 3600 hours will now be displayed as 21 weeks, 3 days and 0 hours.      
These parameters can be combined completely at will.

**New (12.02.2018)**
iSpindle.py Version 1.4.0        
Updated to [Sam's iSpindel](https://github.com/universam1/iSpindel) Firmware 5.8 and higher.         
Newly sent data (interval, Wi-Fi signal quality) will now be registered and stored to the database accordingly.
Everything should still be backwards compatible.
Debug mode will show a message asking you to consider updating the iSpindel firmware, if an outdated version is being detected.
When updating an existing version of this script, please take a look at MySQL_Update-3.sql and add the required fields to your database accordingly before using this new version of the python script.


**New (20.01.2018)**     
iSpindle.py Version 1.3.3     
The iSpindle config option "token" can now be used as Ubidots Token, in order to only forward the data of certain devices, or use different tokens for several of them.     
Leave blank or put a leading asterisk ("*") in order to exclude an iSpindle from Ubidots forwarding.     
This is now the default behavior (Ubidots Forwarding switched on; new parameter UBI_USE_ISPINDLE_TOKEN enabled, too).     
The global UBIDOTS_TOKEN parameter will now only be used if UBI_USE_ISPINDLE_TOKEN is disabled while UBIDOTS is enabled.     

**New (25.11.2017)**     
Interim Release.      
Restored compatibility with Raspbian/Debian Jessie and PHP7.      
Using mysqli Library now.      
Docs have been updated accordingly and also reflect the new mirror.      

**New (27.09.2017)**  
Added Update Scripts  

**New (31.08.2017)**  
Compatible to firmware >= 5.4.x  
Optional data forwarding to other JSON capable TCP clients, including this one and the upcoming "public server".  
Fixed incoherency with legacy Plato charts (plato4.php), properly using signed parameters in Calibration table now for building the polynomial  
Fixed some minor issues in chart legends (formerly mislabeled but still only in German, sorry for that...)  
Fixed Unix permissions  
Several other small bugfixes  

In order to update from former versions:  
Take a look at the [Install Instructions](INSTALL_en.md).

There will of course also be an updated full image for the Raspberry.  
Please watch this thread on the German Hobbybrauer Forum for the announcement:  
http://hobbybrauer.de/forum/viewtopic.php?f=58&t=12869

Future enhancements and goodies are being announced there, too, so make sure you check it once in a while. ;)

**Older News:**
**New: Charts:**
[Charts](web/README_en.md)


Have Fun!    
Alex