#!/usr/bin/env python3
# V1.3
# Add Pushover Message support
#
# V1.2
# Improved behavior for SVG and Low Gravity Alarms. Alarm will be send now only once and not sveral times in case of fluctuations
# Set flags will be removed through Web interface if Reset is selected
# Added functionality for different settings per device
# Added possibility to exclude devices with defined substring (EXCLUDESTRING)
#
# V1.1
# Added mor variables such as apparent attenuation and corresponding alarms
# Added functionality for multiple languages. EN and DE already implemented
# Added utf8 handling for databases where required
#
# V1.0
# Script to send automatic email alarms 
# Statusemail with SPindle data once a day if enabled
# Alarm if gravity falls below defined threshold 
# Script is called from iSPindel.py whenever a SPindle has send data
#

import smtplib
import logging
import socket
import fcntl
import struct
import configparser
import importlib
import requests

try:
    from cStringIO import StringIO ## for Python 2
except ImportError:
    from io import StringIO ## for Python 3
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.header import Header
from email import charset
from email.generator import Generator
import datetime
import os
import sys  


#importlib.reload(sys)  
#sys.setdefaultencoding('utf8')

# function to modify newline command for csv file for transfer from / to settings db
#class MyConfigParser(configparser):
#    def get(section, option):
#        return configparser.get(section, option).replace('\\r\\n', '\r\n')


# CONFIG Start
config = configparser.ConfigParser()
# load config from personal ini file if available
config_path = '~/iSpindel-Srv/config'

try:
  with open(os.path.join(os.path.expanduser(config_path),'iSpindle_config.ini')) as f:
    config.read_file(f)
# fall back to default ini file if other file does not exist

except IOError:
  config.read_file(os.path.join(os.path.expanduser(config_path),'iSpindle_default.ini'))


# GENERAL
# Set to 1 to enable debug output on console (usually devs only)
DEBUG = config.getint('GENERAL', 'DEBUG')

# function to print debug information if debug is set to 1
def dbgprint(s):
    if DEBUG:
        print(str(s))

def get_ip():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    try:
        # doesn't even have to be reachable
        s.connect(('10.255.255.255', 1))
        IP = s.getsockname()[0]
    except:
        IP = '127.0.0.1'
    finally:
        s.close()
    return IP

server_ip = str(get_ip())

dbgprint(server_ip)

# SQL settings
# MySQL
SQL = config.getint('MYSQL', 'SQL')
SQL_HOST = config.get('MYSQL', 'SQL_HOST')
SQL_DB = config.get('MYSQL', 'SQL_DB')
SQL_TABLE = config.get('MYSQL', 'SQL_TABLE')
SQL_USER = config.get('MYSQL', 'SQL_USER')
SQL_PASSWORD = config.get('MYSQL', 'SQL_PASSWORD')
SQL_PORT = config.getint('MYSQL', 'SQL_PORT')

# Function to retrieve config values from SQL database
def get_config_from_sql(section, parameter, device='_DEFAULT'):
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "SELECT Value FROM Settings WHERE Section = '%s' and Parameter = '%s' and ( DeviceName = '_DEFAULT' or DeviceName = '%s' ) ORDER BY DeviceName DESC LIMIT 1;" %(section, parameter, device)
#        dbgprint(sqlselect)
        cur.execute(sqlselect)
        sqlparameters = cur.fetchall()
        if len(sqlparameters) > 0:
            for i in sqlparameters:
                sqlparameter = i[0]
#                dbgprint(sqlparameter)
            return sqlparameter
        else:
            return ''
        cur.close()
        cnx.close()
    except Exception as e:
        dbgprint(e)

# retrieve email settings from Database (Global and not per device)
fromaddr = get_config_from_sql('EMAIL','FROMADDR','GLOBAL')
if fromaddr == '':
    dbgprint('Please enter fromaddr to settings SQL table')
    quit()
toaddr = get_config_from_sql('EMAIL','TOADDR','GLOBAL')
if toaddr == '':
    dbgprint('Please enter toaddr to settings SQL table')
    quit()
passwd = get_config_from_sql('EMAIL','PASSWD','GLOBAL')
if passwd == '':
    dbgprint('Please enter Email passwd to settings SQL table')
    quit()
smtpserver = get_config_from_sql('EMAIL','SMTPSERVER','GLOBAL')
if smtpserver == '':
    dbgprint('Please enter smptserver to settings SQL table')
    quit()
smtpport = int(get_config_from_sql('EMAIL','SMTPPORT','GLOBAL'))
if smtpport == '':
    dbgprint('Please enter smtpport to settings SQL table')
    quit()


# Retrieve global alarmsettings from Database
timestatus = int(get_config_from_sql('MESSAGING','TIMESTATUS','GLOBAL'))
enablestatus = int(get_config_from_sql('MESSAGING','ENABLESTATUS','GLOBAL'))
#Devices that contain this string are excluded from email alarms
excludedevice = get_config_from_sql('MESSAGING','EXCLUDESTRING','GLOBAL')
#  calculation of 30 minutes time window for status alarm email.
timestatuslow = datetime.time(timestatus-1, 45)
timestatushigh = datetime.time(timestatus, 15)
# current date and time to check against alarmsettings
currentdate = datetime.datetime.now()
currenttime = datetime.datetime.time(currentdate)

enablemail = int(get_config_from_sql('EMAIL','ENABLEMAIL','GLOBAL'))
enablepushover = int(get_config_from_sql('PUSHOVER','ENABLEPUSHOVER','GLOBAL'))



#enablealarmlow = bool(get_config_from_sql('EMAIL','ENABLEALARMLOW'))
alarmlow = float(get_config_from_sql('MESSAGING','ALARMLOW'))
#enablealarmdelta = bool(get_config_from_sql('EMAIL', 'ENABLE_ALARMDELTA'))
alarmdelta = float(get_config_from_sql('MESSAGING', 'ALARMDELTA'))
#timeframestatus = int(get_config_from_sql('EMAIL','TIMEFRAMESTATUS'))
#enablealarmsvg = bool(get_config_from_sql('EMAIL','ENABLEALARMSVG'))
alarmsvg = float(get_config_from_sql('MESSAGING','ALARMSVG'))


# Retrieve global alarmsettings from Database
pushover_token = get_config_from_sql('PUSHOVER','API_TOKEN','GLOBAL')
pushover_user = get_config_from_sql('PUSHOVER','USER_KEY','GLOBAL')





def check_exclude_device(iSpindel):
    if (iSpindel.find(excludedevice) == -1): 
        return 1 
    else: 
        dbgprint("Device %s excluded as it contains %s in Name" %(iSpindel, excludedevice))
        return 0
         

# retrieve information from database, if mail has been sent for corresponding alarm
def check_mail_sent(alarm,iSpindel):
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "Select value from Settings where Section ='MESSAGING' and Parameter = '%s' AND value = '%s' ;" %(alarm, iSpindel)
        cur.execute(sqlselect)
        mail_sent = cur.fetchall()
        if len(mail_sent) > 0:
            for i in mail_sent:
                spindelID_sent = i[0]
            return spindelID_sent
        else:
            return 0
        cur.close()
        cnx.close()
    except Exception as e:
        dbgprint(e)

# write information to database, that email has been send for corresponding alarm
# iSpindel could be also '1' for setting SentStatus
def write_mail_sent(alarm,iSpindel,SpindelName=''):
    try:
        dbgprint('Writing alarmflag %s for Spindel %s' %(alarm,iSpindel))
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "INSERT INTO Settings (Section, Parameter, value, DeviceName) VALUES ('MESSAGING','%s','%s','%s');" %(alarm, iSpindel, SpindelName)
        cur.execute(sqlselect)
        cnx.commit()
        cur.close()
        cnx.close()
        return 1
    except Exception as e:
        dbgprint(e)

# remove email sent flag from database for corresponding alarm
def delete_mail_sent(alarm,iSpindel):
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "DELETE FROM Settings where Section ='MESSAGING' and Parameter = '%s' AND value = '%s';" %(alarm, iSpindel)
        cur.execute(sqlselect)
        cnx.commit()
        cur.close()
        cnx.close()
        return 1
    except Exception as e:
        dbgprint(e)


# Function to send message via pushover service
def push_message(subject, body):
    pushoverData = {}
    pushoverData["token"] = pushover_token
    pushoverData["user"] = pushover_user
    pushoverData["html"] = 1
    pushoverData["message"] = body
    pushoverData["title"] = subject
    requests.post("https://api.pushover.net/1/messages.json", data=pushoverData)
    pass


# Function to send the email with defined subject and body. Connection details are taken from ini file
def sendemail(subject, body):
    charset.add_charset('utf-8', charset.QP, charset.QP, 'utf-8')
    msg = MIMEMultipart()
    msg['From'] = Header(fromaddr.encode('utf-8'), 'UTF-8').encode()
    msg['To'] = Header(toaddr.encode('utf-8'), 'UTF-8').encode()
    msg['Subject'] = Header(subject.encode('utf-8'), 'UTF-8').encode()

    msg.attach(MIMEText(body.encode('utf-8'), 'html', 'UTF-8'))
    try:
        server = smtplib.SMTP(smtpserver, smtpport)
        server.starttls()
        server.login(fromaddr, passwd)
        text = msg.as_string()
        server.sendmail(fromaddr, toaddr, text)
        server.quit()
    except Exception as e:
        dbgprint(e)


# Function to retrieve config values from SQL database
def get_string_from_sql(section, parameter):
    try:
        import mysql.connector
# set connection to utf-8 to display characters like umlauts correctly
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB, charset='utf8')
        cur = cnx.cursor()
# query to get language setting
        sql_language = "SELECT value FROM Settings WHERE Section = 'GENERAL' AND Parameter = 'LANGUAGE'"
        cur.execute(sql_language)
        language = cur.fetchall()
        language = list(language[0])
# define corresponding description column for selected language
        description="Description_" + language[0]
        sql_select = "SELECT " + description + " FROM Strings WHERE File = '" + section + "' and Field = '" + parameter + "'";
        cur.execute(sql_select)
        parameter = cur.fetchall()
        parameter = list(parameter[0])
        cur.close()
        cnx.close()
#        dbgprint(parameter[0])
        return parameter[0]
    except Exception as e:
        dbgprint(e)

# Function to get Spindel data from x hrs ago to calculate plato differences (stil work in progress)
def get_data_hours_ago(iSpindleID, lasttime, hours):
    sqlselect = 'SELECT angle, Gravity FROM Data WHERE ID = %s AND Timestamp > DATE_SUB("%s", INTERVAL %s HOUR) limit 1 ' %(iSpindleID, lasttime, hours)
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        cur.execute(sqlselect)
        dataset = cur.fetchall()
        if len(dataset) > 0:
            for i in dataset:
                angle = i[0]
        cur.close()
        cnx.close()
        return angle
    except Exception as e:
        dbgprint(e)

# Function to calculate gravity (Plato) from  angle for submitted spindelID
def calculate_plato_from_calibration(iSpindleID, Angle):
    calc_gravity = 'N/A'
    lSpindleID = []
    dconst0 = {}
    dconst1 = {}
    dconst2 = {}
    dconst3 = {}
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "SELECT id, const0, const1, const2, const3 FROM Calibration WHERE ID = '" + \
            iSpindleID + "';"
        cur.execute(sqlselect)
        calibrationdata = cur.fetchall()
        if len(calibrationdata) > 0:
            del lSpindleID[:]  # ConfigIDs.clear()
            dconst0.clear()
            dconst1.clear()
            dconst2.clear()
            dconst3.clear()
            for i in calibrationdata:
                id = i[0]  # ID
                sID = str(id)
                lSpindleID.append(sID)
                dconst0[sID] = i[1]
                dconst1[sID] = i[2]                
                dconst2[sID] = i[3]
                dconst3[sID] = i[4]
            calc_gravity = dconst0[sID]*Angle*Angle*Angle + dconst1[sID]*Angle * \
                Angle+dconst2[sID]*Angle+dconst3[sID]
            cur.close()
            cnx.close()

        return calc_gravity
    except Exception as e:
        dbgprint(e)

# Function to calculate initial gravity based on the first 2 hrs after reset is done
def getInitialGravity(iSpindleID):
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        where = "WHERE Data.ID = '" + iSpindleID + \
            "' AND Timestamp > (Select MAX(Timestamp) FROM Data  WHERE ResetFlag = true AND Data.ID = '" + iSpindleID + \
            "') AND Timestamp < DATE_ADD((SELECT MAX(Timestamp)FROM Data WHERE Data.ID = '" + iSpindleID + \
            "' AND ResetFlag = true), INTERVAL 2 HOUR)"
        sqlselect = "SELECT AVG(Angle) as angle FROM Data " + where 
        cur.execute(sqlselect)
        angle = cur.fetchall()
        angle = list(angle[0])
        if len(angle) > 0:
            for i in angle:
                initial_angle = angle[0]
            initial_gravity = calculate_plato_from_calibration(iSpindleID,initial_angle)
            try:
                initial_garvity=round(initial_gravity,4)
            except:
                initial_gravity = 0
        cur.close()
        cnx.close()
        return initial_gravity
    except Exception as e:
        dbgprint(e)

# Function to get timestamp from last reset for corresponding spinel ID. Can be used to prevent delta calculation if time is less than 1 day
def timestamp_reset_spindle(iSpindleID):
    min_time = datetime.timedelta(days=99999) # changed to prevent error if one of the devices has no reset flag in the database
    timestamp = datetime.datetime.now() - min_time
    lSpindleID = []
    dresettime = {}
    try:
        import mysql.connector
        cnx = mysql.connector.connect(
            user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
        cur = cnx.cursor()
        sqlselect = "SELECT id, timestamp FROM `Data` WHERE ID = '" + iSpindleID + \
            "' AND Timestamp >= (Select max(Timestamp) FROM Data WHERE ResetFlag = true AND ID = '" + \
            iSpindleID + "') LIMIT 1;"
        cur.execute(sqlselect)
        ispindles = cur.fetchall()
        if len(ispindles) > 0:
            del lSpindleID[:]  # ConfigIDs.clear()
            dresettime.clear()
            for i in ispindles:
                id = i[0]  # ID
                sID = str(id)
                lSpindleID.append(sID)
                dresettime[sID] = i[1]
            cur.close()
            cnx.close()
            timestamp = dresettime[iSpindleID]
    except Exception as e:
        dbgprint(e)
    return timestamp


# iSpindel Param Arrays
lSpindleID = []
dName = {}
dlasttime = {}
dlasttemp = {}
dlastangle = {}
d24hangle = {}
d12hangle = {}
d24hgravity = {}
d12hgravity = {}
dlasttimetrue = {}
dbattery = {}
dRecipe = {}
dgravity = {}
dlastreset = {}
dinitialgravity = {}
drealdens = {}
dSVG = {}
dalcoholbyvolume = {}
dexcludedevice = {}
dsendemail = {}

# get now latest dataset for each spindel
try:
    import mysql.connector
    cnx = mysql.connector.connect(
        user=SQL_USER,  port=SQL_PORT, password=SQL_PASSWORD, host=SQL_HOST, database=SQL_DB)
    cur = cnx.cursor()
    sqlselect = "SELECT * FROM (SELECT MAX(timestamp) AS timestamp FROM Data GROUP BY name) AS T INNER JOIN Data as F ON T. timestamp = F. timestamp;"
    cur.execute(sqlselect)
    ispindles = cur.fetchall()
    del lSpindleID[:]  # ConfigIDs.clear()
    dlasttime.clear()
    dlasttemp.clear()
    dlastangle.clear()
    d24hangle.clear()
    d12hangle.clear()
    d24hgravity.clear()
    d12hgravity.clear()
    dName.clear()
    dbattery.clear()
    dlasttimetrue.clear()
    dRecipe.clear()
    dgravity.clear()
    dlastreset.clear()
    dinitialgravity.clear()
    drealdens.clear()
    dSVG.clear()
    dalcoholbyvolume.clear()
    dexcludedevice.clear()
    dsendemail.clear ()
    spindeldataavailable = 0
    for i in ispindles:
#        dbgprint(i[0])
#        dbgprint(i[1])
#        dbgprint(i[2])
#        dbgprint(i[3])
#        dbgprint(i[4])
#        dbgprint(i[5])
#        dbgprint(i[6])
#        dbgprint(i[7])
#        dbgprint(i[8])
#        dbgprint(i[9])
#        dbgprint(i[10])
#        dbgprint(i[11])
#        dbgprint(i[12])
        try:
            id = i[3].decode('utf-8') # ID
        except:
            id = i[3]
        sID = str(id)
        lSpindleID.append(sID)
        dlasttimetrue[sID] = 0
        dlasttime[sID] = i[0]  # timestamp of latest dataset for sID
        dlastreset[sID] = timestamp_reset_spindle(sID)
# calculate difference between last reset and now
        difference = currentdate - dlasttime[sID]
        time_since_last_reset = currentdate - dlastreset[sID]
        d24hgravity[sID]='N/A'
        d12hgravity[sID]='N/A'
        dlasttemp[sID] = i[5]  # temperature
        try:
            dName[sID] = i[2].decode('utf8') # Spindelname
        except:
            dName[sID] = i[2]
        dbattery[sID] = i[6] # batteryvoltage
        dRecipe[sID] = i[12] # current recipename
        timeframestatus = int(get_config_from_sql('MESSAGING','TIMEFRAMESTATUS',dName[sID]))
        dbgprint('Timeframe for Spindle ' + dName[sID] + ':' + str(timeframestatus) +' days.')

        if time_since_last_reset.days >= 1:
#           dbgprint(sID)
            d24hangle[sID] = get_data_hours_ago(sID, dlasttime[sID], 24)
            d24hgravity[sID] = calculate_plato_from_calibration(
                sID, d24hangle[sID]) # calculated gravity (from TCP server calibration)
            d12hangle[sID] = get_data_hours_ago(sID, dlasttime[sID], 12)
            d12hgravity[sID] = calculate_plato_from_calibration(
                sID, d12hangle[sID]) # calculated gravity (from TCP server calibration)
# if difference is within defined timeframe (days) from settings.
# true flag for available data is set globally and for corresponding spindel
# Additional check, if device should be excluded from email alarms based on exclude string from settings
        dsendemail[sID] = int(get_config_from_sql('MESSAGING','ENABLEMESSAGE',dName[sID])) 
        dbgprint('Message function for ' + dName[sID] + ':' + str(dsendemail[sID]))
        dexcludedevice[sID]=check_exclude_device(dName[sID])
        if ((difference.days <= timeframestatus) and (dsendemail[sID] == 1) and (dexcludedevice[sID] == 1)):
            dlasttimetrue[sID] = 1
            spindeldataavailable = 1
            dlastangle[sID] = i[4]  # angle from latest dataset of sID
            dgravity[sID] = calculate_plato_from_calibration(
                sID, dlastangle[sID]) # calculated gravity (from TCP server calibration)
            dinitialgravity[sID]=getInitialGravity(sID)
# real density differs from aparent density
            try:
                drealdens[sID] = 0.1808 * dinitialgravity[sID] + 0.8192 * dgravity[sID]
# calculte apparent attenuation
                dSVG[sID] = (dinitialgravity[sID] - dgravity[sID])*100 / dinitialgravity[sID]
# calculate alcohol by weigth and by volume (fabbier calcfabbier calc for link see above)
                dalcoholbyvolume[sID] = (( 100 * (drealdens[sID] - dinitialgravity[sID]) / (1.0665 * dinitialgravity[sID] - 206.65))/0.795)
            except:
                drealdens[sID] = 0
                dSVG[sID] = 0
                dalcoholbyvolume[sID] = 0
           
#        dlasttemp[sID] = i[5]  # temperature
#        dName[sID] = i[2] # Spindelname
#        dbattery[sID] = i[6] # batteryvoltage
#        dRecipe[sID] = i[12] # current recipename
    cur.close()
    cnx.close()

# if at least one of the spindles has actual data
    if spindeldataavailable == 1:
        dbgprint('Spindledata availabile for at least one device')
# if daily status is enabled
        if enablestatus == 1:
            dbgprint('Try to send status email')
# if time is in defined interval around set values from database
            if currenttime >= timestatuslow and currenttime < timestatushigh:
                exists = check_mail_sent('SentStatus', '1')
                if exists:
                    dbgprint('Status for %s has been already sent' %(currentdate.strftime("%Y-%m-%d")))
                else:
                    dbgprint('Prepare Email content for status email')
                    Content = str(get_string_from_sql('sendmail','content_status_1') %str(timeframestatus))
                    i = 0
                    while i < len(lSpindleID):
                        if dlasttimetrue[lSpindleID[i]] == 1:
                            if dgravity[lSpindleID[i]] == 'N/A':
                                Gravity = 'Not Calibrated'
                                D24hGravity = 'Not Calibrated'
                                D12hGravity = 'Not Calibrated'
                            else:
                                Gravity = str(round(dgravity[lSpindleID[i]],2)) 
                                if (d24hgravity[lSpindleID[i]]!='N/A'):
                                    D24hGravity = str(round(dgravity[lSpindleID[i]]-d24hgravity[lSpindleID[i]],2))
                                    D12hGravity = str(round(dgravity[lSpindleID[i]]-d12hgravity[lSpindleID[i]],2))
                                else:
                                   D24hGravity = 'N/A'
                                   D12hGravity = 'N/A' 
                            Content += get_string_from_sql('sendmail','content_data') % (str(dName[lSpindleID[i]]), str(dlasttime[lSpindleID[i]]) \
                            , str(lSpindleID[i]), str(round(dlastangle[lSpindleID[i]], 2)), str(round(dinitialgravity[lSpindleID[i]], 2)), Gravity \
                            , str(round(dSVG[lSpindleID[i]], 2)), str(round(dalcoholbyvolume[lSpindleID[i]], 2)), D24hGravity, D12hGravity \
                            , str(round(dlasttemp[lSpindleID[i]], 2)), str(round(dbattery[lSpindleID[i]], 2)), str(dRecipe[lSpindleID[i]]))
                            dbgprint('Last Data for following Spindel found: ' + str(dName[lSpindleID[i]]) + \
                            ' [ID]: ' + str(lSpindleID[i]) + \
                            ' Angle: ' + str(dlastangle[lSpindleID[i]]) + \
                            ' Date: ' + str(dlasttime[lSpindleID[i]]) + \
                            ' Temperature: ' + str(dlasttemp[lSpindleID[i]]))
                        else:
                            dbgprint('Data for Spindel ' + str(dName[lSpindleID[i]]) + ' is older than ' + str(timeframestatus) + ' days')
                        i += 1

                    subject = str(get_string_from_sql('sendmail', 'subject_status') %str(server_ip))
                    info = get_string_from_sql('sendmail', 'content_info') %(str(alarmlow), alarmdelta, datetime.time(timestatus), currentdate.strftime("%Y-%m-%d %H:%M:%S"))

                    body = """
                    %s

                    %s
                    """ % (Content, info)
                    if enablemail == 1:
                        sendemail(subject, body)
                    if enablepushover == 1:
                        push_message(subject, body)
                    write = write_mail_sent('SentStatus', '1') 

            else:  # if status mail enabled
                dbgprint('Time is not between ' + str(timestatuslow) + ' and ' + str(timestatushigh))
                delete = delete_mail_sent('SentStatus', '1')               
        else:
            dbgprint('Status Email not enabled in settings')  
# send alarm mail if gravity is below threshold limit from settings
#       if enablealarmlow == 1:
        subject = get_string_from_sql('sendmail', 'subject_alarm_low_gravity') %str(server_ip)
        Content = get_string_from_sql('sendmail','content_alarm_low_gravity_1') %str(alarmlow)
        isreset = 0
        i = 0
        while i < len(lSpindleID):
            enablealarmlow = 0
            if dlasttimetrue[lSpindleID[i]] == 1:
                dbgprint('AlarmLow Data available for Spindle: ' + dName[lSpindleID[i]])
                enablealarmlow = int(get_config_from_sql('MESSAGING','ENABLEALARMLOW',dName[lSpindleID[i]]))

                dbgprint('AlarmLow enabled: ' + str(enablealarmlow))
                if enablealarmlow == 1:
                    alarmlow = float(get_config_from_sql('MESSAGING','ALARMLOW',dName[lSpindleID[i]]))
                    dbgprint('AlarmLowGravity: ' + str(alarmlow))
                    dbgprint('CurrentGravity: ' + str(float(dgravity[lSpindleID[i]])))
                    alarmsvg = float(get_config_from_sql('MESSAGING','ALARMSVG',dName[lSpindleID[i]]))
                    alarmdelta = float(get_config_from_sql('MESSAGING', 'ALARMDELTA',dName[lSpindleID[i]]))
                    lastreset = dlastreset[lSpindleID[i]]
                    difference = currentdate - lastreset
                    exists = check_mail_sent('SentAlarmLow',str(lSpindleID[i]))
                    try:
                        if exists and float(dgravity[lSpindleID[i]]) >= float(dinitialgravity[lSpindleID[i]]):
                            delete = delete_mail_sent('SentAlarmLow',str(lSpindleID[i]))
                            dbgprint('Deleted LowAlarm  for Spindel %s from database as it exists and gravity still above threshold' %(str(lSpindleID[i])))
                        if difference.days >= 1 and float(dgravity[lSpindleID[i]]) <= float(alarmlow):
                            exists = check_mail_sent('SentAlarmLow',str(lSpindleID[i]))
                            if exists:
                                dbgprint('Alarm for Low Gravity already sent as entry for Spindel %s exists in database' %(str(lSpindleID[i])))
                            else:
                                write = write_mail_sent('SentAlarmLow',str(lSpindleID[i]),str(dName[lSpindleID[i]]))
                                dbgprint('Added Alarmlowflag for Spindel %s to Database' %(str(lSpindleID[i])))
                                isreset = 1
                                Content += '<b>'+str(dName[lSpindleID[i]]) + \
                                '<br/>Date:</b> ' + str(dlasttime[lSpindleID[i]]) + \
                                '<br/><b>ID:</b> ' + str(lSpindleID[i]) + \
                                '<br/><b>Angle:</b> ' + str(round(dlastangle[lSpindleID[i]], 2)) + \
                                '<br/><b>Initial Gravity Plato:</b> ' + str(round(dinitialgravity[lSpindleID[i]], 2)) + \
                                '<br/><b>Calculated Plato:</b> ' + str(round(dgravity[lSpindleID[i]], 2)) + \
                                '<br/><b>Apparent Attenuation:</b> ' + str(round(dSVG[lSpindleID[i]], 2))  + \
                                '<br/><b>Alcohol by Volume %:</b> ' + str(round(dalcoholbyvolume[lSpindleID[i]], 2))  + \
                                '<br/><b>Temperature:</b> ' + str(round(dlasttemp[lSpindleID[i]], 2)) + \
                                '<br/><b>Battery:</b> ' + str(round(dbattery[lSpindleID[i]], 2)) + \
                                '<br/><b>Sudname:</b> ' + \
                                str(dRecipe[lSpindleID[i]]) + '<br/><br/>'
                    except:
                        if  exists == 0 and dgravity[lSpindleID[i]] == 'N/A':
                            dbgprint('Send Alarm for Spindel %s as it is not calibrated' %(str(lSpindleID[i])))
                            isreset = 1
                            Content = '<b>'+str(dName[lSpindleID[i]]) + \
                            '<br/>Date:</b> ' + str(dlasttime[lSpindleID[i]]) + \
                            '<br/><b>ID:</b> ' + str(lSpindleID[i]) + \
                            '<br/>' + \
                            '<br/><b>Your Spindel is not calibrated in TCP Server Database!</b><br/><br/>'
                            write = write_mail_sent('SentAlarmLow',str(lSpindleID[i]),str(dName[lSpindleID[i]]))
                            dbgprint('Added Alarmlowflag for Spindel %s to Database' %(str(lSpindleID[i]))) 
                        else:
                            dbgprint('Spindel %s is not calibrated. Alarm has been already send' %(str(lSpindleID[i])))
            i += 1

        info = get_string_from_sql('sendmail', 'content_info') %(str(alarmlow), alarmdelta, datetime.time(timestatus), currentdate.strftime("%Y-%m-%d %H:%M:%S"))

        body = """
        %s

        %s
        """ % (Content, info)
        if isreset == 1:
            if enablemail == 1:
                sendemail(subject, body)
            if enablepushover == 1:
                push_message(subject, body)
            dbgprint('Alarm for gravity below threshold has been sent')

# send alarm mail if gravity is below threshold limit from settings
#        if enablealarmsvg == 1:
        subject = get_string_from_sql('sendmail', 'subject_alarm_svg') %str(server_ip)
        Content = get_string_from_sql('sendmail','content_alarm_svg') %str(alarmsvg)
        isreset = 0
        i = 0
        while i < len(lSpindleID):
            if dlasttimetrue[lSpindleID[i]] == 1:
                dbgprint('AlarmSVG Data available for Spindle: ' + dName[lSpindleID[i]])
                enablealarmsvg = int(get_config_from_sql('MESSAGING','ENABLEALARMSVG',dName[lSpindleID[i]]))

                dbgprint('AlarmSVG enabled: ' + str(enablealarmsvg))
                if enablealarmsvg == 1:
                    alarmsvg = float(get_config_from_sql('MESSAGING','ALARMSVG',dName[lSpindleID[i]]))
                    dbgprint('AlarmSVG: ' + str(alarmsvg))
                    dbgprint('CurrentSVG: ' + str(dSVG[lSpindleID[i]]))
                    alarmlow = float(get_config_from_sql('MESSAGING','ALARMLOW',dName[lSpindleID[i]]))
                    alarmdelta = float(get_config_from_sql('MESSAGING', 'ALARMDELTA',dName[lSpindleID[i]]))
                    lastreset = dlastreset[lSpindleID[i]]
                    difference = currentdate - lastreset
                    exists = check_mail_sent('SentAlarmSVG',str(lSpindleID[i]))
                    try:
                        if exists and float(dSVG[lSpindleID[i]]) < float(alarmsvg-15):
                            delete = delete_mail_sent('SentAlarmSVG',str(lSpindleID[i]))
                            dbgprint('Deleted Attenuation Alarm  for Spindel %s from database as it exists and Attenuation still below threshold' %(str(lSpindleID[i])))
                        if difference.days >= 1 and float(dSVG[lSpindleID[i]]) >= float(alarmsvg):
                            exists = check_mail_sent('SentAlarmSVG',str(lSpindleID[i]))
                            if exists:
                                dbgprint('Alarm for SVG already sent as entry for Spindel %s exists in database' %(str(lSpindleID[i])))
                            else:
                                write = write_mail_sent('SentAlarmSVG',str(lSpindleID[i]),str(dName[lSpindleID[i]]))
                                dbgprint('Added AlarmSVGflag for Spindel %s to Database' %(str(lSpindleID[i])))
                                isreset = 1
                                Content += '<b>'+str(dName[lSpindleID[i]]) + \
                                '<br/>Date:</b> ' + str(dlasttime[lSpindleID[i]]) + \
                                '<br/><b>ID:</b> ' + str(lSpindleID[i]) + \
                                '<br/><b>Angle:</b> ' + str(round(dlastangle[lSpindleID[i]], 2)) + \
                                '<br/><b>Initial Gravity Plato:</b> ' + str(round(dinitialgravity[lSpindleID[i]], 2)) + \
                                '<br/><b>Calculated Plato:</b> ' + str(round(dgravity[lSpindleID[i]], 2)) + \
                                '<br/><b>Apparent Attenuation:</b> ' + str(round(dSVG[lSpindleID[i]], 2))  + \
                                '<br/><b>Alcohol by Volume %:</b> ' + str(round(dalcoholbyvolume[lSpindleID[i]], 2))  + \
                                '<br/><b>Temperature:</b> ' + str(round(dlasttemp[lSpindleID[i]], 2)) + \
                                '<br/><b>Battery:</b> ' + str(round(dbattery[lSpindleID[i]], 2)) + \
                                '<br/><b>Sudname:</b> ' + \
                                str(dRecipe[lSpindleID[i]]) + '<br/><br/>'
                    except:
                        if  exists == 0 and dgravity[lSpindleID[i]] == 'N/A':
                            dbgprint('Send Alarm for Spindel %s as it is not calibrated' %(str(lSpindleID[i])))
                            isreset = 1
                            Content = '<b>'+str(dName[lSpindleID[i]]) + \
                            '<br/>Date:</b> ' + str(dlasttime[lSpindleID[i]]) + \
                            '<br/><b>ID:</b> ' + str(lSpindleID[i]) + \
                            '<br/>' + \
                            '<br/><b>Your Spindel is not calibrated in TCP Server Database!</b><br/><br/>'
                            write = write_mail_sent('SentAlarmSVG',str(lSpindleID[i]),str(dName[lSpindleID[i]]))
                            dbgprint('Added AlarmSVGflag for Spindel %s to Database' %(str(lSpindleID[i])))
                        else:
                            dbgprint('Spindel %s is not calibrated. Alarm has been already send' %(str(lSpindleID[i])))
            i += 1

        info = get_string_from_sql('sendmail', 'content_info') %(str(alarmlow), alarmdelta, datetime.time(timestatus), currentdate.strftime("%Y-%m-%d %H:%M:%S"))

        body = """
        %s

        %s
        """ % (Content, info)
        if isreset == 1:
            if enablemail ==1:
                sendemail(subject, body)
            if enablepushover == 1:
                push_message(subject, body)
            dbgprint('Alarm for SVG above threshold has been sent')

    else:  # if spindledata available
        dbgprint('Data for all Spindels is older than ' +
                 str(timeframestatus) + ' days')

except Exception as e:
    exc_type, exc_obj, exc_tb = sys.exc_info()
    fname = os.path.split(exc_tb.tb_frame.f_code.co_filename)[1]
    print(exc_type, fname, exc_tb.tb_lineno)
    dbgprint(e)
