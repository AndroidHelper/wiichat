<?php
$sqlstr[0]="DROP TABLE IF EXISTS wiichat_admin";
$sqlstr[1]="DROP TABLE IF EXISTS wiichat_board";
$sqlstr[2]="DROP TABLE IF EXISTS wiichat_msg";
$sqlstr[3]="DROP TABLE IF EXISTS wiichat_online";
$sqlstr[4]="DROP TABLE IF EXISTS wiichat_site";
$sqlstr[5]="DROP TABLE IF EXISTS wiichat_user";
$sqlstr[6]="DROP TABLE IF EXISTS wiichat_history";
$sqlstr[7]="DROP TABLE IF EXISTS wiichat_radio";
$sqlstr[8]="DROP TABLE IF EXISTS wiichat_chat";
$sqlstr[9]="DROP TABLE IF EXISTS wiichat_privatechat";
$sqlstr[10]="CREATE TABLE `wiichat_admin` (
	`admin_id` int(11) NOT NULL AUTO_INCREMENT,
	`admin_account` varchar(50) NOT NULL DEFAULT '',
	`admin_password` varchar(50) NOT NULL DEFAULT '',
	`admin_loginTime` DATETIME NULL,
	`admin_loginIP` VARCHAR(50) NULL,
	`admin_loginCount` INT(10) NOT NULL DEFAULT '0',
	 PRIMARY KEY (`admin_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
									
$sqlstr[11]="CREATE TABLE `wiichat_board` (
	`board_id` int(11) NOT NULL AUTO_INCREMENT,
	`board_name` varchar(40) DEFAULT NULL,
	`board_desc` varchar(100) DEFAULT NULL,
	`board_order` int(11) DEFAULT '0',
	`board_type` char(1) DEFAULT NULL,
	`board_admin` varchar(200) DEFAULT NULL,
	`board_uniqid` varchar(50) DEFAULT NULL,
	`board_users` varchar(200) default null,
	 PRIMARY KEY (`board_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
					
$sqlstr[12]="CREATE TABLE `wiichat_msg` (
	`msg_id` int(11) NOT NULL AUTO_INCREMENT,
	`msg_send` varchar(255) DEFAULT NULL,
	`msg_received` varchar(255) DEFAULT NULL,
	`msg_title` varchar(255) DEFAULT NULL,
	`msg_content` text,
	`msg_addTime` datetime DEFAULT NULL,
	`msg_isReader` int(11) DEFAULT '0',
	`msg_isReaderTime` datetime DEFAULT NULL,
	`msg_isReply` int(11) DEFAULT '0',
	`msg_isReplyTime` datetime DEFAULT NULL,
	`msg_side` int(11) DEFAULT '0',
	PRIMARY KEY (`msg_id`)
	) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;";

$sqlstr[13]="CREATE TABLE `wiichat_online` (
	  `online_id` int(11) NOT NULL AUTO_INCREMENT,
	  `online_ip` varchar(100) NOT NULL DEFAULT '',
	  `online_time` datetime DEFAULT NULL,
	  `online_user` varchar(50) DEFAULT NULL,
	  `online_position` int(11) DEFAULT NULL,
	  PRIMARY KEY (`online_id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlstr[14]="CREATE TABLE `wiichat_site` (
	`site_logo` varchar(200) NOT NULL DEFAULT '',
	`site_width` int(11) DEFAULT NULL,
    `site_name` varchar(40) DEFAULT NULL,
	`site_mailSMTP` varchar(100) DEFAULT NULL,
	`site_mailAddress` varchar(100) DEFAULT NULL,
	`site_mailAccount` varchar(100) DEFAULT NULL,
	`site_mailPassword` varchar(100) DEFAULT NULL,
	`site_count` int(11) DEFAULT '0',
	`site_code` TEXT DEFAULT NULL,
	`site_filter` TEXT DEFAULT NULL,
	`site_timezone` varchar(100) DEFAULT NULL,
	`site_express` char(1) default '1',
	PRIMARY KEY (`site_logo`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlstr[15]="CREATE TABLE `wiichat_user` (
	`user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_account` varchar(50) NOT NULL DEFAULT '',
	`user_password` varchar(50) NOT NULL DEFAULT '',
	`user_mobile` varchar(20) DEFAULT NULL,
	`user_email` varchar(50) DEFAULT NULL,
	`user_info` text,
	`user_regTime` datetime DEFAULT NULL,
	`user_loginCount` int(11) DEFAULT '0',
	`user_lastLogin` datetime DEFAULT NULL,
	`user_level` char(1) DEFAULT NULL,
	`user_isVip` char(1) DEFAULT '0',
	`user_board` varchar(600) DEFAULT '|0|',
	`user_sort` int(4) DEFAULT NULL,
	`user_ip` varchar(50) DEFAULT NULL,
	 PRIMARY KEY (`user_id`)
	) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;";
$sqlstr[16]="CREATE TABLE `wiichat_history` (
	  `history_id` int(11) NOT NULL AUTO_INCREMENT,
	  `history_board` int(11) DEFAULT NULL,
	  `history_content` text,
	  `history_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`history_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";	
$sqlstr[17]="CREATE TABLE `wiichat_radio` (
	  `radio_id` int(11) NOT NULL AUTO_INCREMENT,
	  `radio_sender` varchar(50) default null,
	  `radio_content` text,
	  `radio_addTime` datetime DEFAULT NULL,
	  `radio_isExpired` char(1) default null,
	  PRIMARY KEY (`radio_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$sqlstr[18]="CREATE TABLE `wiichat_chat` (
	  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
	  `chat_sender` varchar(50) DEFAULT NULL,
	  `chat_receiver` varchar(50) DEFAULT NULL,
	  `chat_content` varchar(200) DEFAULT NULL,
	  `chat_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`chat_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$sqlstr[19]="CREATE TABLE `wiichat_privatechat` (
	  `privateChat_id` int(11) NOT NULL AUTO_INCREMENT,
	  `privateChat_sender` varchar(50) DEFAULT NULL,
	  `privateChat_receiver` varchar(50) DEFAULT NULL,
	  `privateChat_isChat` char(1) DEFAULT '0',
	  PRIMARY KEY (`privateChat_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$sqlstr[20]="CREATE TABLE `wiichat_mask` (
	  `mask_user` varchar(50) DEFAULT NULL,
	  `mask_room` int(11) DEFAULT NULL,
	  `mask_time` datetime DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$sqlstr[21]="INSERT INTO `wiichat_site` VALUES ('',0,'WiiChat','','','','',1,'','','Asia/Shanghai','1');";

	$sqlstr[22]="INSERT INTO `wiichat_board` VALUES (1,'游客房间','',0,'4',NULL,'aa0a8d357b7674807f21fb994f7f40fd.dat','');";
?>