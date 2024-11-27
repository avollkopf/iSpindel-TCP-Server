#!/usr/bin/env python3
# Version 4.0
# Test for bookworm with different configuration
#
# Version 3.5
# Fixed InfluxDB for python3
#
# Version 3.4
# Added RSSI to cbpi forwarding
# Added forwarding to Littebock (thanks to Francois-Xavier / NoWing31)
#
# Version 3.3
# Added support for SG transfer to grainconnect
#
# Version 3.2
# Added support for alternative Fermenter temperature from CBPiv4 iSpindle plugin
#
# Version 3.1
# Added support to forwrd data to Grainfather Connect
#
# Version 3.0
# Modified version fpor Python 3
# Some string handling had to be changed for python3
#  
# Version 2.1
# Added Recipe_Id column while writing data to enable archive function in database
#
# Version 2.0
# Made possible by Alex (avollkopf): A whole new release.
# Now including complete graphical user interface and new charts.
#
# Version 1.6.3.1 
# Changed some variables for settings from bool to int
#
# Version 1.6.3
# Added function to send emails automatically
# this file calls a file sendmail.py which has also to be placed in /usr/local/bin
# Routine is running as thread and should not conflict with iSpindle.py
# Most Settings are now retireved from SQL Database and some (SQL from ini file)
#
# Version 1.6.2
# Change of config data handling. ini files will be stored in config directory and user can create iSpindle_config.ini in this directory.
# If personalized config file is not existing, values from iSpindle_default.ini will be pulled. 
# Change preserves personalized config data during update
#
# 1.6.1.1
# Added Exception Handlers for CSV and SQL Recipe Lookup
#
# Version 1.6.1
# Added functionality to deal with recipe information
# Spindel is sending data. Script pulls corresponding spindle recipe information from last reset and writes it with current data to database and/or CSV
# Todo and test: write info to other systems
# DB Field receipe (charset(64)) required before running new version of this script
#
# Version: 1.6.0
# iSpindel Remote Config via JSON TCP response implemented
# Added CraftBeerPi 3.0 Support (thanks to jlanger)
#
# Version: 1.5.0
# Added: Brewpiless support (thanks to ollinator2000)
# Testing: Return JSON with TCP Reply
#
# Version: 1.4.1
# New: Added new data fields for Interval and WiFi reception (RSSI) for Firmware 5.8 and later
# Chg: TimeStamp in CSV now in first column
# New: Added option to forward to fermentrack http://www.fermentrack.com/ (thanks to Th3ju)

# Version: 1.3.3
# New:  Added config parameter to use token field in iSpindle config as Ubidots token

# Previous changes and fixes:
# Fix: Debug Output of Ubidots response
# New: Forward data to another instance of this script or any other JSON recipient
# New: Support changes in firmware >= 5.4.0 (ID now transmitted as Integer)
#
# Generic TCP Server for iSpindel (https://github.com/universam1/iSpindel)
# Receives iSpindel data as JSON via TCP socket and writes it to a CSV file, Database and/or forwards it
#
# Stephan Schreiber <stephan@sschreiber.de>, 2017-02-02 - 2018-08-20
#

from socket import socket, AF_INET, SOCK_STREAM, SOL_SOCKET, SO_REUSEADDR
from datetime import datetime, timedelta
import _thread
import reprlib
import json
import time
import configparser
import os
import sys

# CONFIG Start
# Config is now completely being stored inside the database.
# So there shouldn't be anything here for you to adjust anymore.

config = configparser.ConfigParser()
config_path = '/usr/share/iSpindle-Srv/config'

try:
  with open(os.path.join(os.path.expanduser(config_path),'iSpindle_config.ini')) as f:
    config.read_file(f)
except IOError:
    config.read_file(os.path.join(os.path.expanduser(config_path),'iSpindle_default.ini'))
  

# General
DEBUG = config.get('GENERAL', 'DEBUG') # Set to 1 to enable debug output on console (usually devs only)

def dbgprint(s):
    if DEBUG: print(str(s))

# MySQL
SQL = config.getint('MYSQL', 'SQL')  # 1 to enable output to MySQL database
SQL_HOST = config.get('MYSQL', 'SQL_HOST')  # Database host name (default: localhost - 127.0.0.1 loopback interface)
SQL_DB = config.get('MYSQL', 'SQL_DB')  # Database name
SQL_TABLE = config.get('MYSQL', 'SQL_TABLE')  # Table name
SQL_USER = config.get('MYSQL', 'SQL_USER')  # DB user
SQL_PASSWORD = config.get('MYSQL', 'SQL_PASSWORD')  # DB user's password (change this)
SQL_PORT = config.getint('MYSQL', 'SQL_PORT')

# Check and wait until database is available
check = False
while check == False:
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "SELECT VERSION()"
        cur.execute(sqlselect)
        results = cur.fetchone()
        ver = results[0]
        if (ver is None):
            time.sleep(1)
            check = False
        else:
            break
    except:
        time.sleep(1)
        check = False

# Function to retrieve config values from SQL database
def get_config_from_sql(section, parameter, spindle_name = '_DEFAULT'):
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "SELECT Value FROM Settings WHERE Section = '%s' and Parameter = '%s' " \
                "and ( DeviceName = '_DEFAULT' or DeviceName = '%s' ) ORDER BY DeviceName DESC LIMIT 1;" %(section, parameter, spindle_name)

        cur.execute(sqlselect)
        row = cur.fetchone()
        sqlparameter = ''
        if row is not None:
            sqlparameter = row[0]
        cur.close()
        cnx.close()

        return sqlparameter.replace('\\r\\n', '\r\n')

    except Exception as e:
        dbgprint(e)

# Function to write to Settings table (to update Grainfather last sent timestamp)
def write_config_to_sql(section, parameter, new_value, spindle_name = '_DEFAULT'):
    # Writing config item back to Settings
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        # If there is a Settings entry for this device, use the device's name, otherwise use _DEFAULT
        sqlcheckdevice = "SELECT Value FROM Settings WHERE Section = '%s' and Parameter = '%s' " \
                "and DeviceName = '%s' ORDER BY DeviceName DESC LIMIT 1;" %(section, parameter, spindle_name)
        cur.execute(sqlcheckdevice)
        row = cur.fetchone()
        if row is not None: 
            devicename = spindle_name 
        else:
            devicename = '_DEFAULT'
        sqlupdate = "UPDATE Settings SET Value = '%s' WHERE Section = '%s' and Parameter = '%s' " \
                    "and ( DeviceName = '_DEFAULT' or DeviceName = '%s' ) ;" %(new_value, section, parameter, devicename)

        cur.execute(sqlupdate)
        cnx.commit()
        cur.close()
        cnx.close()

        return

    except Exception as e:
        dbgprint(e)


#GENERAL
PORT = int(get_config_from_sql('GENERAL', 'PORT' ,'GLOBAL')) # TCP Port to listen to (to be used in iSpindle config as well)
HOST = get_config_from_sql('GENERAL', 'HOST', 'GLOBAL')  # Allowed IP range. Leave at 0.0.0.0 to allow connections from anywhere

# CSV
CSV = int(get_config_from_sql('CSV', 'ENABLE_CSV'))  # Set to 1 if you want CSV (text file) output
OUTPATH = get_config_from_sql('CSV', 'OUTPATH','GLOBAL')  # CSV output file path; filename will be name_id.csv
DELIMITER = get_config_from_sql('CSV', 'DELIMITER','GLOBAL')  # CSV delimiter (normally use ; for Excel)
NEWLINE =  get_config_from_sql('CSV', 'NEWLINE','GLOBAL')  # newline (\r\n for windows clients)
DATETIME = int(get_config_from_sql('CSV', 'DATETIME','GLOBAL'))  # Leave this at 1 to include Excel compatible timestamp in CSV

# Ubidots (using existing account)
UBIDOTS = int(get_config_from_sql('UBIDOTS', 'ENABLE_UBIDOTS'))  # 1 to enable output to ubidots
UBI_USE_ISPINDLE_TOKEN = int(get_config_from_sql('UBIDOTS', 'UBI_USE_ISPINDLE_TOKEN'))  # 1 to use "token" field in iSpindle config (overrides UBI_TOKEN)
UBI_TOKEN = get_config_from_sql('UBIDOTS', 'UBI_TOKEN')  # global ubidots token, see manual or ubidots.com

# Forward to public server or other relay (i.e. another instance of this script)
FORWARD = int(get_config_from_sql('FORWARD', 'ENABLE_FORWARD'))
FORWARDADDR = get_config_from_sql('FORWARD', 'FORWARDADDR')
FORWARDPORT =  int(get_config_from_sql('FORWARD', 'FORWARDPORT'))


# Fermentrack
FERMENTRACK = int(get_config_from_sql('FERMENTRACK', 'ENABLE_FERMENTRACK'))
FERM_USE_ISPINDLE_TOKEN = int(get_config_from_sql('FERMENTRACK', 'FERM_USE_ISPINDLE_TOKEN'))
FERMENTRACKADDR = get_config_from_sql('FERMENTRACK', 'FERMENTRACKADDR')
FERMENTRACK_TOKEN = get_config_from_sql('FERMENTRACK', 'FERMENTRACK_TOKEN')
FERMENTRACKPORT = int(get_config_from_sql('FERMENTRACK', 'FERMENTRACKPORT'))

# BrewSpy
BREWSPY = int(get_config_from_sql('BREWSPY', 'ENABLE_BREWSPY'))
SPY_USE_ISPINDLE_TOKEN = int(get_config_from_sql('BREWSPY', 'SPY_USE_ISPINDLE_TOKEN'))
BREWSPYADDR = get_config_from_sql('BREWSPY', 'BREWSPYADDR')
BREWSPY_TOKEN = get_config_from_sql('BREWSPY', 'BREWSPY_TOKEN')
BREWSPYPORT = int(get_config_from_sql('BREWSPY', 'BREWSPYPORT'))

# Brewfather
BREWFATHER = int(get_config_from_sql('BREWFATHER', 'ENABLE_BREWFATHER'))
FAT_USE_ISPINDLE_TOKEN = int(get_config_from_sql('BREWFATHER', 'FAT_USE_ISPINDLE_TOKEN'))
BREWFATHERADDR = get_config_from_sql('BREWFATHER', 'BREWFATHERADDR')
BREWFATHER_TOKEN = get_config_from_sql('BREWFATHER', 'BREWFATHER_TOKEN')
BREWFATHERPORT = int(get_config_from_sql('BREWFATHER', 'BREWFATHERPORT'))
BREWFATHERSUFFIX = get_config_from_sql('BREWFATHER', 'BREWFATHERSUFFIX')

# BREWPILESS
BREWPILESS = int(get_config_from_sql('BREWPILESS', 'ENABLE_BREWPILESS'))
BREWPILESSADDR = get_config_from_sql('BREWPILESS', 'BREWPILESSADDR')

# Forward to CraftBeerPi3 iSpindel Addon
CRAFTBEERPI3 = int(get_config_from_sql('CRAFTBEERPI3', 'ENABLE_CRAFTBEERPI3'))
CRAFTBEERPI3ADDR = get_config_from_sql('CRAFTBEERPI3', 'CRAFTBEERPI3ADDR')
# if this is true the raw angle will be sent to CBPI3 instead of
# the gravity value. Use this if you want to configure the
# polynome from within CBPI3.
# Otherwise leave this 0 and just use "tilt" in CBPI3
CRAFTBEERPI3_SEND_ANGLE = int(get_config_from_sql('CRAFTBEERPI3', 'CRAFTBEERPI3_SEND_ANGLE'))

INFLUXDB = int(get_config_from_sql('INFLUXDB', 'ENABLE_INFLUXDB'))
INFLUXDBADDR = get_config_from_sql('INFLUXDB', 'INFLUXDBADDR')
INFLUXDBPORT = int(get_config_from_sql('INFLUXDB', 'INFLUXDBPORT'))
INFLUXDBNAME = get_config_from_sql('INFLUXDB', 'INFLUXDBNAME')
INFLUXDBUSERNAME = get_config_from_sql('INFLUXDB', 'INFLUXDBUSERNAME')
INFLUXDBPASSWD = get_config_from_sql('INFLUXDB', 'INFLUXDBPASSWD')

# Forward to little bock
LITTLEBOCK = int(get_config_from_sql('LITTLEBOCK', 'ENABLE_LITTLEBOCK'))
LITTLEBOCKADDR = get_config_from_sql('LITTLEBOCK', 'LITTLEBOCKADDRESS')
LITTLEBOCKURL = get_config_from_sql('LITTLEBOCK', 'LITTLEBOCKURL')

# iSpindle Remote Config?
# If this is enabled, we'll send iSpindle config JSON as TCP reply.
# Before using this, make sure your database is up-to-date. See README and INSTALL.
# This feature is still in testing but should already work reliably.
REMOTECONFIG = int(get_config_from_sql('REMOTECONFIG', 'ENABLE_REMOTECONFIG'))

# ADVANCED
ENABLE_ADDCOLS = int(get_config_from_sql('ADVANCED', 'ENABLE_ADDCOLS', 'GLOBAL'))  # Enable dynamic columns (do not use this unless you're a developer)
# CONFIG End

ACK = bytes([6])  # ASCII ACK (Acknowledge)
NAK = bytes([21])  # ASCII NAK (Not Acknowledged)
BUFF = 256  # Buffer Size

# iSpindel Config Param Arrays
lConfigIDs = []
dInterval = {}
dToken = {}
dPoly = {}


def dbgprint(s):
    if DEBUG: print(str(s))

def readConfig():
    if REMOTECONFIG:
        dbgprint('Preparing iSpindel config data...')
        try:
            import mysql.connector
            cnx = mysql.connector.connect(user=SQL_USER, port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
            cur = cnx.cursor()
            cur.execute("SELECT * FROM Config WHERE NOT Sent;")
            ispindles = cur.fetchall()
            del lConfigIDs[:] #ConfigIDs.clear()
            dInterval.clear()
            dToken.clear()
            dPoly.clear()
            for i in ispindles:
                id = i[0]  # ID
                sId = str(id)
                lConfigIDs.append(id)
                dInterval[sId] = i[1]   # Interval
                dToken[sId] = str(i[2]) # Token
                dPoly[sId] = str(i[3])  # Polynomial

            cur.close()
            cnx.close()
            dbgprint('Config data: Done. ' + str(len(lConfigIDs)) + " config change(s) to submit.")
        except Exception as e:
            dbgprint('Error: ' + str(e))
            dbgprint('Did you properly add the "Config" table to your database?')


def handler(clientsock, addr):
    inpstr = ''
    success = 0
    spindle_name = ''
    spindle_id = 0
    angle = 0.0
    temperature = 0.0
    temp_units = 'C'
    battery = 0.0
    gravity = 0.0
    user_token = ''
    interval = 0
    rssi = 0
    timestart = time.monotonic()
    config_sent = 0
    pressure = 0.0
    carbondioxid = 0.0
    gauge = 0
    CBPiTemp = None

    while 1:
        data = clientsock.recv(BUFF)
        if not data: break  # client closed connection
        dbgprint(repr(addr) + ' received:' + repr(data.decode('utf-8')))
        if "close" == data.rstrip():
            clientsock.send(ACK)
            dbgprint(repr(addr) + ' ACK sent. Closing.')
            break  # close connection
        try:
            inpstr += str(data.decode('utf-8').rstrip())
            if inpstr[0] != "{":
                clientsock.send(NAK)
                dbgprint(repr(addr) + ' Not JSON.')
                break  # close connection
            dbgprint(repr(addr) + ' Input Str is now:' + inpstr)
            if inpstr.find("}") != -1:
                jinput = json.loads(inpstr)
                spindle_name = jinput['name']
                if 'type' in jinput:
                    dbgprint("detected eManometer")
                    gauge = 1
                else:
                    gauge = 0
                    dbgprint("detected iSpindel")
                if gauge == 0:
                    spindle_id = jinput['ID']
                    angle = jinput['angle']
                    temperature = jinput['temperature']
                    temp_units = jinput['temp_units']
                    battery = jinput['battery']

                    try:
                        gravity = jinput['gravity']
                        interval = jinput['interval']
                        rssi = jinput['RSSI']
                    except:
                        # older firmwares might not be transmitting all of these
                        dbgprint("Consider updating your iSpindel's Firmware.")
                    try:
                        # get user token for connection to ispindle.de public server
                        user_token = jinput['token']
                    except:
                        # older firmwares < 5.4 or field not filled in
                        user_token = '*'
                else:
                    spindle_id = jinput['ID']
                    pressure = jinput['pressure']
                    temperature = jinput['temperature']
                    carbondioxid = jinput['co2']
                    #interval = jinput['interval']
                    rssi = jinput['RSSI']
                    gauge = 1
                # looks like everything went well :)
                #
                # Should we reply with a config JSON?
                #
                if REMOTECONFIG:
                    resp = ACK
                    try:
                        if spindle_id in lConfigIDs:
                            sId = str(spindle_id)
                            jresp = {}
                            if dInterval[sId]:
                                jresp["interval"] = dInterval[sId]
                            if dToken[sId]:
                                jresp["token"] = dToken[sId]
                            if dPoly[sId]:
                                jresp["polynomial"] = dPoly[sId]
                            resp = json.dumps(jresp)
                            dbgprint(repr(addr) + ' JSON Response: ' + resp)
                            config_sent = 1
                        else:
                            dbgprint(repr(addr) + ' No unsent data for iSpindel "' + spindle_name + '". Sending ACK.')
                    except Exception as e:
                        dbgprint(repr(addr) + " Can't send config response. Something went wrong:")
                        dbgprint(repr(addr) + " Error: " + str(e))
                        dbgprint(repr(addr) + " Sending ACK.")
                    clientsock.send(resp.encode())
                else:
                    clientsock.send(ACK)
                    dbgprint(repr(addr) + ' Sent ACK.')
                #
                dbgprint(repr(addr) + ' Time elapsed: ' + str(time.monotonic() - timestart))
                dbgprint(repr(addr) + ' ' + spindle_name + ' (ID:' + str(spindle_id) + ') : Data Transfer OK.')
                success = 1
                break  # close connection
        except Exception as e:
            # something went wrong
            # traceback.print_exc() # this would be too verbose, so let's do this instead:
            dbgprint(repr(addr) + ' Error: ' + str(e))
            clientsock.send(NAK)
            dbgprint(repr(addr) + ' NAK sent.')
            break  # close connection server side after non-success
    clientsock.close()
    dbgprint(repr(addr) + " - closed connection")  # log on console

    if config_sent:
        # update sent status in config table
        import mysql.connector
        dbgprint(repr(addr) + ' - marking db config data as sent.')
        cnx = mysql.connector.connect(user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sql = 'UPDATE Config SET Sent=True WHERE ID=' + str(spindle_id) + ';'
        cur.execute(sql)
        cnx.commit()
        cur.close()
        cnx.close()

    if success:
        # We have the complete spindle data now, so let's make it available

        # CSV
        CSV = int(get_config_from_sql('CSV', 'ENABLE_CSV', spindle_name))  # Set to 1 if you want CSV (text file) output
        OUTPATH = get_config_from_sql('CSV', 'OUTPATH', 'GLOBAL')  # CSV output file path; filename will be name_id.csv
        DELIMITER = get_config_from_sql('CSV', 'DELIMITER', 'GLOBAL')  # CSV delimiter (normally use ; for Excel)
        NEWLINE = get_config_from_sql('CSV', 'NEWLINE', 'GLOBAL')  # newline (\r\n for windows clients)
        DATETIME = int(
            get_config_from_sql('CSV', 'DATETIME', 'GLOBAL'))  # Leave this at 1 to include Excel compatible timestamp in CSV

        # Ubidots (using existing account)
        UBIDOTS = int(get_config_from_sql('UBIDOTS', 'ENABLE_UBIDOTS', spindle_name))  # 1 to enable output to ubidots
        UBI_USE_ISPINDLE_TOKEN = get_config_from_sql('UBIDOTS',
                                                     'UBI_USE_ISPINDLE_TOKEN', spindle_name)  # 1 to use "token" field in iSpindle config (overrides UBI_TOKEN)
        UBI_TOKEN = get_config_from_sql('UBIDOTS', 'UBI_TOKEN', spindle_name)  # global ubidots token, see manual or ubidots.com

        # Forward to public server or other relay (i.e. another instance of this script)
        FORWARD = int(get_config_from_sql('FORWARD', 'ENABLE_FORWARD', spindle_name))
        FORWARDADDR = get_config_from_sql('FORWARD', 'FORWARDADDR', spindle_name)
        FORWARDPORT = int(get_config_from_sql('FORWARD', 'FORWARDPORT', spindle_name))

        # Fermentrack
        FERMENTRACK = int(get_config_from_sql('FERMENTRACK', 'ENABLE_FERMENTRACK', spindle_name))
        FERM_USE_ISPINDLE_TOKEN = get_config_from_sql('FERMENTRACK', 'FERM_USE_ISPINDLE_TOKEN', spindle_name)
        FERMENTRACKADDR = get_config_from_sql('FERMENTRACK', 'FERMENTRACKADDR', spindle_name)
        FERMENTRACK_TOKEN = get_config_from_sql('FERMENTRACK', 'FERMENTRACK_TOKEN', spindle_name)
        FERMENTRACKPORT = int(get_config_from_sql('FERMENTRACK', 'FERMENTRACKPORT', spindle_name))

        # BREWPILESS
        BREWPILESS = int(get_config_from_sql('BREWPILESS', 'ENABLE_BREWPILESS', spindle_name))
        BREWPILESSADDR = get_config_from_sql('BREWPILESS', 'BREWPILESSADDR', spindle_name)

        # Forward to CraftBeerPi3 iSpindel Addon
        CRAFTBEERPI3 = int(get_config_from_sql('CRAFTBEERPI3', 'ENABLE_CRAFTBEERPI3', spindle_name))
        CRAFTBEERPI3ADDR = get_config_from_sql('CRAFTBEERPI3', 'CRAFTBEERPI3ADDR', spindle_name)
        # if this is true the raw angle will be sent to CBPI3 instead of
        # the gravity value. Use this if you want to configure the
        # polynome from within CBPI3.
        # Otherwise leave this 0 and just use "tilt" in CBPI3
        CRAFTBEERPI3_SEND_ANGLE = int(get_config_from_sql('CRAFTBEERPI3', 'CRAFTBEERPI3_SEND_ANGLE', spindle_name))

        # BrewSpy
        BREWSPY = int(get_config_from_sql('BREWSPY', 'ENABLE_BREWSPY', spindle_name))
        SPY_USE_ISPINDLE_TOKEN = int(get_config_from_sql('BREWSPY', 'SPY_USE_ISPINDLE_TOKEN', spindle_name))
        BREWSPYADDR = get_config_from_sql('BREWSPY', 'BREWSPYADDR', spindle_name)
        BREWSPY_TOKEN = get_config_from_sql('BREWSPY', 'BREWSPY_TOKEN', spindle_name)
        BREWSPYPORT = int(get_config_from_sql('BREWSPY', 'BREWSPYPORT', spindle_name))

        # Brewfather
        BREWFATHER = int(get_config_from_sql('BREWFATHER', 'ENABLE_BREWFATHER', spindle_name))
        FAT_USE_ISPINDLE_TOKEN = int(get_config_from_sql('BREWFATHER', 'FAT_USE_ISPINDLE_TOKEN', spindle_name))
        BREWFATHERADDR = get_config_from_sql('BREWFATHER', 'BREWFATHERADDR', spindle_name)
        BREWFATHER_TOKEN = get_config_from_sql('BREWFATHER', 'BREWFATHER_TOKEN', spindle_name)
        BREWFATHERPORT = int(get_config_from_sql('BREWFATHER', 'BREWFATHERPORT', spindle_name))
        BREWFATHERSUFFIX = get_config_from_sql('BREWFATHER', 'BREWFATHERSUFFIX', spindle_name)

       # InfluxDB
        INFLUXDB = int(get_config_from_sql('INFLUXDB', 'ENABLE_INFLUXDB', spindle_name))
        INFLUXDBADDR = get_config_from_sql('INFLUXDB', 'INFLUXDBADDR', spindle_name)
        INFLUXDBPORT = int(get_config_from_sql('INFLUXDB', 'INFLUXDBPORT', spindle_name))
        INFLUXDBNAME = get_config_from_sql('INFLUXDB', 'INFLUXDBNAME', spindle_name)
        INFLUXDBUSERNAME = get_config_from_sql('INFLUXDB', 'INFLUXDBUSERNAME', spindle_name)
        INFLUXDBPASSWD = get_config_from_sql('INFLUXDB', 'INFLUXDBPASSWD', spindle_name)

        # Forward to little bock
        LITTLEBOCK = int(get_config_from_sql('LITTLEBOCK', 'ENABLE_LITTLEBOCK',spindle_name))
        LITTLEBOCKADDR = get_config_from_sql('LITTLEBOCK', 'LITTLEBOCKADDRESS',spindle_name)
        LITTLEBOCKURL = get_config_from_sql('LITTLEBOCK', 'LITTLEBOCKURL',spindle_name)
        
        #Grainfather Connect
        GRAINCONNECT = int(get_config_from_sql('GRAINCONNECT', 'ENABLE_GRAINCONNECT', spindle_name))
        GRAIN_SG = int(get_config_from_sql('GRAINCONNECT', 'ENABLE_SG', spindle_name))
        GC_URL = str(get_config_from_sql('GRAINCONNECT', 'GRAINCONNECT_URL', spindle_name))
        GC_URLSLUG = str(get_config_from_sql('GRAINCONNECT', 'GRAINCONNECT_URLSLUG', spindle_name))
        GRAINCONNECT_LASTSENT = str(get_config_from_sql('GRAINCONNECT', 'GRAINCONNECT_LASTSENT', spindle_name))
        GRAINCONNECT_INTERVAL = int(get_config_from_sql('GRAINCONNECT', 'GRAINCONNECT_INTERVAL', spindle_name))


        if CSV:
            dbgprint(repr(addr) + ' - writing CSV')
            recipe = 'n/a'
            try:
                #   dbgprint(repr(addr) + ' Reading last recipe name for corresponding Spindel' + spindle_name)
                #   Get the Recipe name from the last reset for the spindel that has sent data
                import mysql.connector
                cnx = mysql.connector.connect(user=SQL_USER, port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST,
                                              database=SQL_DB)
                cur = cnx.cursor()
                sqlselect = "SELECT Data.Recipe FROM Data WHERE Data.Name = '" + spindle_name + "' AND Data.Timestamp >= (SELECT max( Data.Timestamp )FROM Data WHERE Data.Name = '" + spindle_name + "' AND Data.ResetFlag = true) LIMIT 1;"
                cur.execute(sqlselect)
                recipe_names = cur.fetchone()
                cur.close()
                cnx.close()
                recipe = str(recipe_names[0])
                dbgprint('Recipe Name: Done. ' + recipe)
            except Exception as e:
                dbgprint(repr(addr) + ' Recipe Name not found - CSV Error: ' + str(e))

            try:
                filename = OUTPATH + spindle_name + '_' + str(spindle_id) + '.csv'
                with open(filename, 'a') as csv_file:
                    # this would sort output. But we do not want that...
                    # import csv
                    # csvw = csv.writer(csv_file, delimiter=DELIMITER)
                    # csvw.writerow(jinput.values())
                    outstr = ''
                    if DATETIME == 1:
                        cdt = datetime.now()
                        outstr += cdt.strftime('%x %X') + DELIMITER
                    outstr += str(spindle_name) + DELIMITER
                    outstr += str(spindle_id) + DELIMITER
                    outstr += str(angle) + DELIMITER
                    outstr += str(temperature) + DELIMITER
                    outstr += str(battery) + DELIMITER
                    outstr += str(gravity) + DELIMITER
                    outstr += user_token + DELIMITER
                    outstr += str(interval) + DELIMITER
                    outstr += str(rssi) + DELIMITER
                    outstr += recipe
                    outstr += NEWLINE
                    csv_file.writelines(outstr)
                    dbgprint(repr(addr) + ' - CSV data written.')
            except Exception as e:
                dbgprint(repr(addr) + ' CSV Error: ' + str(e))

        if CRAFTBEERPI3 and gauge == 0:
            try:
                dbgprint(repr(addr) + ' - forwarding to CraftBeerPi3 at http://' + CRAFTBEERPI3ADDR)
                import urllib3
                import requests
                outdata = {
                    'name': spindle_name,
                    'angle': angle if CRAFTBEERPI3_SEND_ANGLE else gravity,
                    'temperature': temperature,
                    'battery': battery,
                    'RSSI': rssi,
                }
                out = json.dumps(outdata).encode('utf-8')
                dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                url = 'http://' + CRAFTBEERPI3ADDR + '/api/hydrometer/v1/data'
                http = urllib3.PoolManager()
                req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))

            except Exception as e:
                dbgprint(repr(addr) + ' Error while forwarding to URL ' + url + ' : ' + str(e))

            try:
                url = 'http://' + CRAFTBEERPI3ADDR + '/api/hydrometer/v1/data/gettemp/'+ spindle_name
                http = urllib3.PoolManager()
                req = http.request('POST',url, headers={'Content-Type': 'application/json'})
                response=json.loads(req.data.decode())
                dbgprint(response)
                CBPiTemp=response["Temp"]
                dbgprint(CBPiTemp)

            except Exception as e:
                dbgprint(repr(addr) + ' Error while forwarding to URL ' + url + ' : ' + str(e))


        if SQL:
            recipe = 'n/a'
            try:
                dbgprint(repr(addr) + ' Reading last recipe name for corresponding Spindel - ' + spindle_name)
                # Get the recipe name from last reset for the spindel that has sent data
                import mysql.connector
                cnx = mysql.connector.connect(user=SQL_USER, port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST,
                                              database=SQL_DB)
                cur = cnx.cursor()
                sqlselect = "SELECT Data.Recipe FROM Data WHERE Data.Name = '" + spindle_name + "' AND Data.Timestamp >= (SELECT max( Data.Timestamp )FROM Data WHERE Data.Name = '" + spindle_name + "' AND Data.ResetFlag = true) LIMIT 1;"
                cur.execute(sqlselect)
                recipe_names = cur.fetchone()
                cur.close()
                cnx.close()
                recipe = str(recipe_names[0])
                dbgprint('Recipe Name: Done. ' + recipe)
            except Exception as e:
                dbgprint(repr(addr) + ' Recipe Name not found - Database Error: ' + str(e))

            recipe_id = 0
            try:
                dbgprint(repr(addr) + ' Reading last recipe_id value for corresponding Spindel - ' + spindle_name)
                # Get the latest recipe_id for the spindel that has sent data from the archive table
                import mysql.connector
                cnx = mysql.connector.connect(user=SQL_USER, port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST,
                                              database=SQL_DB)
                cur = cnx.cursor()
                sqlselect = "SELECT max(Archive.Recipe_ID) FROM Archive WHERE Archive.Name='" + spindle_name + "';"
                cur.execute(sqlselect)
                recipe_ids = cur.fetchone()
                cur.close()
                cnx.close()
                recipe_id = str(recipe_ids[0])
                dbgprint('Recipe_ID: Done. ' + recipe_id)
            except Exception as e:
                dbgprint(repr(addr) + ' Recipe_ID not found - Database Error: ' + str(e))
            if recipe_id == "None":
                recipe_id = 0
            try:
                import mysql.connector
                dbgprint(repr(addr) + ' - writing to database')
                # standard field definitions:
                if gauge == 0 :
                    fieldlist = ['Timestamp', 'Name', 'ID', 'Angle', 'Temperature', 'Battery', 'Gravity', 'Recipe', 'Recipe_ID', 'Temperature_Alt']
                    valuelist = [datetime.now(), spindle_name, spindle_id, angle, temperature, battery, gravity, recipe, recipe_id, CBPiTemp]
                else:
                    fieldlist = ['Timestamp', 'Name', 'ID', 'Pressure', 'Temperature', 'Carbondioxid', 'Recipe']
                    valuelist = [datetime.now(), spindle_name, spindle_id, pressure, temperature, carbondioxid, recipe]
                # do we have a user token defined? (Fw > 5.4.x)
                # this is for later use (public server) but if it exists, let's store it for testing purposes
                # this also should ensure compatibility with older fw versions and not-yet updated databases
                if user_token != '':
                    fieldlist.append('UserToken')
                    valuelist.append(user_token)

                # If we have firmware 5.8 or higher:
                if rssi != 0:
                    fieldlist.append('`Interval`')  # this is a reserved SQL keyword so it requires additional quotes
                    valuelist.append(interval)
                    fieldlist.append('RSSI')
                    valuelist.append(rssi)
                dbgprint(fieldlist)
                dbgprint(valuelist)
                # establish database connection
                cnx = mysql.connector.connect(user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
                cur = cnx.cursor()

                # add extra columns dynamically?
                # this is kinda ugly; if new columns should persist, make sure you add them to the lists above...
                # for testing purposes it allows to introduce new values of raw data without having to fiddle around.
                # Basically, do not use this unless your name is Sam and you are the firmware developer... ;)
                if ENABLE_ADDCOLS:
                    jinput = json.loads(inpstr)
                    for key in jinput:
                        if not key in fieldlist:
                            dbgprint(repr(addr) + ' - key \'' + key + ' is not yet listed, adding it now...')
                            fieldlist.append(key)
                            value = jinput[key]
                            valuelist.append(value)
                            # crude way to check if it's numeric or a string (we'll handle strings and doubles only)
                            vartype = 'double'
                            try:
                                dummy = float(value)
                            except:
                                vartype = 'varchar(64)'
                            # check if the field exists, if not, add it
                            try:
                                dbgprint(repr(addr) + ' - key \'' + key + '\': adding to database.')
                                sql = 'ALTER TABLE ' + SQL_TABLE + ' ADD ' + key + ' ' + vartype
                                cur.execute(sql)
                            except Exception as e:
                                if e[0] == 1060:
                                    dbgprint(repr(
                                        addr) + ' - key \'' + key + '\': exists. Consider adding it to defaults list if you want to keep it.')
                                else:
                                    dbgprint(repr(addr) + ' - key \'' + key + '\': Error: ' + str(e))

                # gather the data now and send it to the database
                fieldstr = ', '.join(fieldlist)
                valuestr = ', '.join(['%s' for x in valuelist])
                if gauge == 0 :
                    add_sql = 'INSERT INTO Data (' + fieldstr + ')'
                else :
                    add_sql = 'INSERT INTO iGauge (' + fieldstr + ')'
                add_sql += ' VALUES (' + valuestr + ')'
                #dbgprint(add_sql)
                #dbgprint(valuelist)
                cur.execute(add_sql, valuelist)
                cnx.commit()
                cur.close()
                cnx.close()
                dbgprint(repr(addr) + ' - DB data written.')
            except Exception as e:
                dbgprint(repr(addr) + ' Database Error: ' + str(e) + NEWLINE + 'Did you update your database?')

        if BREWPILESS and gauge == 0:
            try:
                dbgprint(repr(addr) + ' - forwarding to BREWPILESS at http://' + BREWPILESSADDR)
                import urllib3
                outdata = {
                    'name': spindle_name,
                    'angle': angle,
                    'temperature': temperature,
                    'battery': battery,
                    'gravity': gravity,
                }
                out = json.dumps(outdata).encode('utf-8')
                dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                url = 'http://' + BREWPILESSADDR + '/gravity'
                http = urllib3.PoolManager()
                req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                dbgprint(repr(addr) + ' - HTTP Status Code received: ' + str(req.status))

            except Exception as e:
                dbgprint(repr(addr) + ' Error while forwarding to URL ' + url + ' : ' + str(e))

        if UBIDOTS and gauge == 0:
            try:
                if UBI_USE_ISPINDLE_TOKEN:
                    token = user_token
                else:
                    token = UBI_TOKEN
                if token != '':
                    if token[:1] != '*':
                        dbgprint(repr(addr) + ' - sending to ubidots')
                        import urllib3
                        outdata = {
                            'tilt': angle,
                            'temperature': temperature,
                            'battery': battery,
                            'gravity': gravity,
                            'interval': interval,
                            'rssi': rssi
                        }
                        out = json.dumps(outdata).encode('utf-8')
                        dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                        url = 'http://things.ubidots.com/api/v1.6/devices/' + spindle_name + '?token=' + token
                        http = urllib3.PoolManager()
                        req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                        dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' Ubidots Error: ' + str(e))

        if FORWARD and gauge == 0:
            try:
                dbgprint(repr(addr) + ' - forwarding to ' + FORWARDADDR)
                outdata = {
                    'name': spindle_name,
                    'ID': spindle_id,
                    'angle': angle,
                    'temperature': temperature,
                    'battery': battery,
                    'gravity': gravity,
                    'token': user_token,
                    'interval': interval,
                    'RSSI': rssi
                }
                out = json.dumps(outdata)
                dbgprint(repr(addr) + ' - sending: ' + out)
                s = socket(AF_INET, SOCK_STREAM)
                s.connect((FORWARDADDR, FORWARDPORT))
                s.send(out.encode())
                rcv = s.recv(BUFF)
                s.close()
                dbgprint('received:' + repr(rcv.decode()) + '|' + repr(ACK.decode()))
                if rcv == ACK:
                    dbgprint(repr(addr) + ' - received ACK - OK!')
                elif rcv == NAK:
                    dbgprint(repr(addr) + ' - received NAK - Not OK...')
                else:
                    dbgprint(repr(addr) + ' - received: ' + rcv)
            except Exception as e:
                dbgprint(repr(addr) + ' Error while forwarding to ' + FORWARDADDR + ': ' + str(e))

        if FERMENTRACK and gauge == 0:
            try:
                if FERM_USE_ISPINDLE_TOKEN:
                    token = user_token
                else:
                    token = FERMENTRACK_TOKEN
                if token != '':
                    if token[:1] != '*':
                        dbgprint(repr(addr) + ' - sending to fermentrack')
                        import urllib3
                        outdata = {
                            "ID": spindle_id,
                            "angle": angle,
                            "battery": battery,
                            "gravity": gravity,
                            "name": spindle_name,
                            "temperature": temperature,
                            "token": token
                        }
                        out = json.dumps(outdata).encode('utf-8')
                        dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                        url = 'http://' + FERMENTRACKADDR + ':' + str(FERMENTRACKPORT) + '/ispindel/'
                        dbgprint(repr(addr) + ' to : ' + url)
                        http = urllib3.PoolManager()
                        req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                        dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' Fermentrack Error: ' + str(e))

        if GRAINCONNECT and gauge == 0:
            # Check to see if we can send yet (GF has a 15 minute limit on uploads)
            try:
                fmt = '%Y-%m-%d %H:%M:%S'
                last_send = datetime.strptime(GRAINCONNECT_LASTSENT, fmt)
            except ValueError:
                dbgprint(repr(addr) + ' Grainfather - Error in LASTSENT time value')
                last_send = datetime.now() - timedelta(seconds=900)    
                pass
            now = datetime.now()
            last_send_seconds_ago = (now - last_send).days * 86400 + (now - last_send).seconds
            if last_send_seconds_ago >= GRAINCONNECT_INTERVAL:
                dbgprint(repr(addr) + ' Grainfather - OK TO SEND (last sent ' + GRAINCONNECT_LASTSENT + ")")
                try:
                    import urllib3
                    # Grainfather API accepts device specific URL suffix "/iot/[url-slug]/ispindel"
                    # where url-slug is unique, like "blue-wind"
                    # if GC_URLSLUG is defined, use that within fixed "/iot/[url-slug]/ispindel" suffix string, otherwise use GC_URL
                    if GC_URL != '':
                        GC_SUFFIX = GC_URL.strip()
                    else:
                        GC_SUFFIX = '/iot/' + GC_URLSLUG.strip() + '/ispindel'
                    dbgprint(repr(addr) + ' - forwarding to Grainfather Connect at http://community.grainfather.com:80' + GC_SUFFIX)
                    GRAIN_SUFFIX = ""
                    if GRAIN_SG:
                        GRAIN_SUFFIX = ",SG"
                    outdata = {
                        'name': spindle_name + GRAIN_SUFFIX,
                        'ID': spindle_id,
                        'angle': angle,
                        'temperature': temperature,
                        'temp_units': temp_units,
                        'battery': battery,
                        'gravity': gravity,
                        'token': user_token,
                        'interval': interval,
                        'RSSI': rssi
                    }
                    out = json.dumps(outdata)

                    dbgprint(repr(addr) + ' - sending: ' + out)
                    url = 'http://community.grainfather.com:80' + GC_SUFFIX
                    dbgprint(repr(addr) + ' to : ' + url)
                    http = urllib3.PoolManager()
                    header={'User-Agent': 'iSpindel', 'Connection': 'close', 'Content-Type': 'application/json'}
                    req = http.request('POST', url, body = out, headers = header)
                    dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
                except Exception as e:
                    dbgprint(repr(addr) + ' - forwarding to Grainfather Connect Error: ' + str(e))
                write_config_to_sql('GRAINCONNECT', 'GRAINCONNECT_LASTSENT', now.strftime(fmt), spindle_name)
            else:
                dbgprint(repr(addr) + ' - NOT OK TO SEND (wait ' + str(GRAINCONNECT_INTERVAL - last_send_seconds_ago) + ' more seconds)')

# not clear on how to update yet (can't be tested)
        if INFLUXDB and gauge == 0:
            try:
                dbgprint(repr(addr) + ' - forwarding to InfluxDB ' + INFLUXDBADDR)
                import urllib3
                import base64
                outdata = {
                    'tilt': angle,
                    'temperature': temperature,
                    'temp_units': temp_units,
                    'battery': battery,
                    'gravity': gravity,
                    'interval': interval,
                    'RSSI': rssi
                }
                out = ('measurements,source=' + spindle_name + ' ')
                out_append=""
                dbgprint(out)
                for k,v in outdata.items():
                   if k != "temp_units":
                       dbgprint(out_append)
                       out_append = out_append + ("{}={},").format(k,v)
                   else:
                       out_append = out_append + ("{}=\"{}\",").format(k,v)
                out = out + out_append[:-1]
#                out = 'measurements,source=' + spindle_name + ' ' +  ",".join("{}={}".format(k,v) for k,v in outdata.items())
                dbgprint(repr(addr) + ' - sending: ' + out)

                url = 'http://' + INFLUXDBADDR + ':' + str(INFLUXDBPORT) + '/write?db=' + INFLUXDBNAME
                dbgprint(repr(addr) + ' to : ' + url)
                http = urllib3.PoolManager()
                base64string = base64.b64encode(('%s:%s' % (INFLUXDBUSERNAME,INFLUXDBPASSWD)).encode())
                dbgprint(base64string)
                header = {'User-Agent': spindle_name, 'Content-Type': 'application/x-www-form-urlencoded','Authorization': 'Basic %s' % base64string.decode('utf-8')}
                dbgprint(header)
                req = http.request('POST',url, body=out, headers = header)
                dbgprint(repr(addr) + ' - received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' InfluxDB Error: ' + str(e))

        if BREWSPY and gauge == 0:
            try:
                if SPY_USE_ISPINDLE_TOKEN:
                    token = user_token
                else:
                    token = BREWSPY_TOKEN
                if token != '':
                    if token[:1] != '*':
                        dbgprint(repr(addr) + ' - sending to brewspy')
                        import urllib3
                        outdata = {
                            "ID": spindle_id,
                            "angle": angle,
                            "battery": battery,
                            "gravity": gravity,
                            "name": spindle_name,
                            "temperature": temperature,
                            "token": token,
                            "RSSI": rssi
                        }
                        out = json.dumps(outdata).encode('utf-8')
                        dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                        url = 'http://' + BREWSPYADDR + ':' + str(BREWSPYPORT) + '/api/ispindel/'
                        dbgprint(repr(addr) + ' to : ' + url)
                        http = urllib3.PoolManager()
                        req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                        dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' Brewspy Error: ' + str(e))

        if BREWFATHER and gauge == 0:
            try:
                if FAT_USE_ISPINDLE_TOKEN:
                    token = user_token
                else:
                    token = BREWFATHER_TOKEN
                if token != '':
                    if token[:1] != '*':
                        dbgprint(repr(addr) + ' - sending to brewfather')
                        import urllib3
                        outdata = {
                            "ID": spindle_id,
                            "angle": angle,
                            "battery": battery,
                            "gravity": gravity,
                            "name": spindle_name + BREWFATHERSUFFIX,
                            "temperature": temperature,
                            "token": token
                        }
                        out = json.dumps(outdata).encode('utf-8')
                        dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                        url = 'http://' + BREWFATHERADDR + ':' + str(BREWFATHERPORT) + '/ispindel?id=' + token
                        dbgprint(repr(addr) + ' to : ' + url)
                        http = urllib3.PoolManager()
                        req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                        dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' Brewfather Error: ' + str(e))

        if LITTLEBOCK and gauge == 0:
            try:
                        dbgprint(repr(addr) + ' - sending to littlebock')
                        import urllib3
                        outdata = {
                            'temperature': temperature,
                            'battery': battery,
                            'gravity': gravity
                        }
                        out = json.dumps(outdata).encode('utf-8')
                        dbgprint(repr(addr) + ' - sending: ' + out.decode('utf-8'))
                        url = 'http://' + LITTLEBOCKADDR + LITTLEBOCKURL 
                        dbgprint(repr(addr) + ' to : ' + url)
                        http = urllib3.PoolManager()
                        req = http.request('POST',url,body=out, headers={'Content-Type': 'application/json', 'User-Agent': spindle_name})
                        dbgprint(repr(addr) + ' - HTTP Status code received: ' + str(req.status))
            except Exception as e:
                dbgprint(repr(addr) + ' Littlebock Error: ' + str(e))


        readConfig()

def sendmail():
    try:
        os.system('/usr/local/bin/sendmail.py')
    except Exception as e:
        dbgprint(e) 

def main():
    ADDR = (HOST, PORT)
    serversock = socket(AF_INET, SOCK_STREAM)
    serversock.setsockopt(SOL_SOCKET, SO_REUSEADDR, 1)
    serversock.bind(ADDR)
    serversock.listen(5)
    readConfig()
    while 1:
        dbgprint('waiting for connection... listening on port: ' + str(PORT))
        clientsock, addr = serversock.accept()
        dbgprint('...connected from: ' + str(addr))
        _thread.start_new_thread(handler, (clientsock, addr))
        _thread.start_new_thread(sendmail, ())

if __name__ == "__main__":
    main()
