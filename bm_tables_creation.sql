CREATE TABLE `Data`
(
	`Timestamp` datetime NOT NULL,
	`Name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`ID` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`Angle` double NOT NULL,
	`Temperature` double NOT NULL,
	`Battery` double NOT NULL,
	`ResetFlag` tinyint(1) DEFAULT NULL,
	`Gravity` double NOT NULL DEFAULT 0,
	`UserToken` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Interval` int(11) DEFAULT NULL,
	`RSSI` int(11) DEFAULT NULL,
	`Recipe` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Recipe_ID` int(11) NOT NULL,
	`Internal` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Comment` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Temperature_Alt` DOUBLE NULL DEFAULT NULL,
	PRIMARY KEY (`Timestamp`,`Name`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='iSpindle Data';

CREATE TABLE `Archive`
(
	`Recipe_ID` int(11) NOT NULL AUTO_INCREMENT,
	`Name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
	`ID` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Recipe` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`Batch` VARCHAR(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`Start_date` datetime NOT NULL,
	`End_date` datetime DEFAULT NULL,
	`const0` double DEFAULT NULL,
	`const1` double DEFAULT NULL,
	`const2` double DEFAULT NULL,
	`const3` double DEFAULT NULL,
	PRIMARY KEY (`Recipe_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `Calibration`
(
	`ID` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
	`const0` double NOT NULL DEFAULT '0',
	`const1` double NOT NULL DEFAULT '0',
	`const2` double NOT NULL DEFAULT '0',
	`const3` double NOT NULL DEFAULT '0',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='iSpindle Calibration Data' ROW_FORMAT=COMPACT;

CREATE TABLE `Config`
(
	`ID` int(11) NOT NULL,
	`Interval` int(11) NOT NULL,
	`Token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`Polynomial` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`Sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='iSpindle Config Data' ROW_FORMAT=COMPACT;

