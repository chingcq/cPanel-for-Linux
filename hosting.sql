-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 15, 2010 at 08:59 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4
-- 
-- Database: `hosting`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `buga`
-- 

CREATE TABLE `buga` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_password` varchar(64) NOT NULL default '',
  `user_login` varchar(64) default NULL,
  `lock` enum('Y','N') NOT NULL,
  `lock_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `buga`
-- 

INSERT INTO `buga` VALUES (1, 'aef7659d2ba50576dcbdf734756e49fa', 'Spiker', 'Y', '0000-00-00 00:00:00');
INSERT INTO `buga` VALUES (9, '47a97a11469f9fec3926732d5ba3bf0c', 'test_user', 'Y', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `klpt`
-- 

CREATE TABLE `klpt` (
  `password` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Dumping data for table `klpt`
-- 

INSERT INTO `klpt` VALUES ('49b621f3bd15ca1a12edc1c192fbe940', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `lastlogin`
-- 

CREATE TABLE `lastlogin` (
  `user_login` varchar(255) default NULL,
  `lastlogin_id` int(11) NOT NULL auto_increment,
  `lastlogin_ip` varchar(64) NOT NULL,
  `lastlogin_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`lastlogin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=71 ;

-- 
-- Dumping data for table `lastlogin`
-- 



-- --------------------------------------------------------

-- 
-- Table structure for table `log_pages`
-- 

CREATE TABLE `log_pages` (
  `log_ip` varchar(64) default NULL,
  `page_id` int(11) NOT NULL auto_increment,
  `page_name` varchar(255) NOT NULL,
  `page_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`page_id`),
  KEY `log_id` (`log_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=2438 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2438 ;

-- 
-- Dumping data for table `log_pages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `log_user`
-- 

CREATE TABLE `log_user` (
  `log_id` int(11) NOT NULL auto_increment,
  `log_ip` varchar(126) NOT NULL,
  `log_referer` varchar(255) NOT NULL,
  `log_browser` varchar(126) NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `log_ip` (`log_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `log_user`
-- 

INSERT INTO `log_user` VALUES (1, '127.0.0.1', 'http://framework/admin/clients/', 'Chrome');
INSERT INTO `log_user` VALUES (2, '127.0.0.1', 'http://framework/admin/clients/', 'Chrome');
INSERT INTO `log_user` VALUES (3, '127.0.0.1', 'http://framework/admin/login.php', 'Internet Explorer');
INSERT INTO `log_user` VALUES (4, '127.0.0.1', 'http://framework/admin/login.php', 'Opera');
INSERT INTO `log_user` VALUES (5, '127.0.0.1', 'http://framework/admin/login.php', 'Firefox');
INSERT INTO `log_user` VALUES (6, '127.0.0.1', 'http://framework/admin/clients/', 'Opera');
INSERT INTO `log_user` VALUES (7, '127.0.0.1', 'http://framework/admin/clients/', 'Firefox');
INSERT INTO `log_user` VALUES (8, '127.0.0.1', 'http://framework/admin/clients/', 'Internet Explorer');
INSERT INTO `log_user` VALUES (9, '127.0.0.1', 'http://framework/admin/login.php', 'Chrome');
INSERT INTO `log_user` VALUES (10, '127.0.0.1', 'none', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.89 Safari/532.5');
INSERT INTO `log_user` VALUES (11, '127.0.0.1', 'http://framework/buga/login.php', 'Chrome');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_domain`
-- 

CREATE TABLE `tbl_domain` (
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL auto_increment,
  `domain_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`domain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `tbl_domain`
-- 

INSERT INTO `tbl_domain` VALUES (1, 3, 'www.web-a.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 7, 'www.web-a8.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 14, 'www.web-a1.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 15, 'www.web-a3.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 10, 'www.web-a5.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 6, 'www.web-a6.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 16, 'www.web-a4.co.uk');
INSERT INTO `tbl_domain` VALUES (1, 25, 'www.dns.com');
INSERT INTO `tbl_domain` VALUES (9, 26, 'www.testdomain.com');
INSERT INTO `tbl_domain` VALUES (1, 27, 'www.newdomain.com');
INSERT INTO `tbl_domain` VALUES (1, 28, 'www.web-a10.org.uk');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_email`
-- 

CREATE TABLE `tbl_email` (
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `email_id` int(11) NOT NULL auto_increment,
  `email_name` varchar(64) NOT NULL,
  `email_password` varchar(64) NOT NULL,
  PRIMARY KEY  (`email_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `tbl_email`
-- 

INSERT INTO `tbl_email` VALUES (1, 15, 1, 'test11', 'c8b2f17833a4c73bb20f88876219ddcd');
INSERT INTO `tbl_email` VALUES (1, 3, 5, '123', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_ftp`
-- 

CREATE TABLE `tbl_ftp` (
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `ftp_id` int(11) NOT NULL auto_increment,
  `ftp_username` varchar(64) NOT NULL,
  `ftp_password` varchar(64) NOT NULL,
  PRIMARY KEY  (`ftp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=55 ;

-- 
-- Dumping data for table `tbl_ftp`
-- 

INSERT INTO `tbl_ftp` VALUES (1, 3, 1, 'ftpuser1', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 2, 'ftpuser2', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 3, 'testing1', 'd9b1d7db4cd6e70935368a1efb10e377');
INSERT INTO `tbl_ftp` VALUES (1, 3, 4, 'ftpuser4', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 5, 'ftpuser5', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 6, 'ftpuser6', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 7, 'ftpuser7', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 8, 'ftpuser8', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 9, 'ftpuser9', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 10, 'ftpuser10', 'test');
INSERT INTO `tbl_ftp` VALUES (1, 3, 11, 'ftpuser11', '378b243e220ca493');
INSERT INTO `tbl_ftp` VALUES (1, 11, 22, 'test', '202cb962ac59075b964b07152d234b70');
INSERT INTO `tbl_ftp` VALUES (1, 11, 23, 'test2', '202cb962ac59075b964b07152d234b70');
INSERT INTO `tbl_ftp` VALUES (1, 11, 24, 'test3', '202cb962ac59075b964b07152d234b70');
INSERT INTO `tbl_ftp` VALUES (1, 11, 25, 'test4', '86985e105f79b95d6bc918fb45ec7727');
INSERT INTO `tbl_ftp` VALUES (1, 11, 34, 'test6', '4cfad7076129962ee70c36839a1e3e15');
INSERT INTO `tbl_ftp` VALUES (9, 26, 53, 'test_user', '5f4dcc3b5aa765d61d8327deb882cf99');
INSERT INTO `tbl_ftp` VALUES (1, 25, 54, 'test_user1', 'd9b1d7db4cd6e70935368a1efb10e377');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_mysql`
-- 

CREATE TABLE `tbl_mysql` (
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `mysql_id` int(11) NOT NULL auto_increment,
  `mysql_username` varchar(64) NOT NULL,
  `mysql_password` varchar(64) NOT NULL,
  `mysql_dbname` varchar(255) NOT NULL,
  PRIMARY KEY  (`mysql_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tbl_mysql`
-- 

INSERT INTO `tbl_mysql` VALUES (1, 3, 11, '', '', '1_test');
INSERT INTO `tbl_mysql` VALUES (1, 14, 12, '', '', '1_test2');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_order`
-- 

CREATE TABLE `tbl_order` (
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL auto_increment,
  `order_status` enum('New','Payed','Complited','Canceled') NOT NULL,
  `order_memo` text NOT NULL,
  `order_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `order_last_update` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tbl_order`
-- 

INSERT INTO `tbl_order` VALUES (1, 1, 'Payed', 'Test2123123', '2010-04-14 00:00:00', '2010-04-22 00:00:00');
INSERT INTO `tbl_order` VALUES (1, 2, 'New', 'Test', '2010-04-14 00:00:00', '2010-04-22 00:00:00');
INSERT INTO `tbl_order` VALUES (1, 3, 'New', 'Test', '2010-04-14 00:00:00', '2010-04-22 00:00:00');
INSERT INTO `tbl_order` VALUES (1, 4, 'New', 'Test', '2010-04-14 00:00:00', '2010-04-22 00:00:00');
INSERT INTO `tbl_order` VALUES (1, 5, 'New', 'Test', '2010-04-14 00:00:00', '2010-04-22 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_order_length`
-- 

CREATE TABLE `tbl_order_length` (
  `order_id` int(11) default NULL,
  `order_length_id` int(11) NOT NULL auto_increment,
  `order_length_mont` int(3) default NULL,
  PRIMARY KEY  (`order_length_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tbl_order_length`
-- 

INSERT INTO `tbl_order_length` VALUES (1, 1, 2);
INSERT INTO `tbl_order_length` VALUES (2, 2, 5);
INSERT INTO `tbl_order_length` VALUES (3, 3, 7);
INSERT INTO `tbl_order_length` VALUES (4, 4, 1);
INSERT INTO `tbl_order_length` VALUES (5, 5, 6);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_records`
-- 

CREATE TABLE `tbl_records` (
  `user_id` int(11) NOT NULL,
  `domain_name` varchar(255) default NULL,
  `dns_name` varchar(255) default NULL,
  `record_id` int(11) NOT NULL auto_increment,
  `record_type` enum('A','AAAA','ALIAS','CNAME','HINFO','MX','NAPTR','NS','PTR','RP','SRV','TXT') NOT NULL,
  `record_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `tbl_records`
-- 

INSERT INTO `tbl_records` VALUES (1, 'www.dns.com', 'dns.com', 10, 'CNAME', 'mail');
INSERT INTO `tbl_records` VALUES (0, '', '', 11, 'CNAME', 'test');
INSERT INTO `tbl_records` VALUES (1, 'www.dns.com', 'dns.com', 9, 'A', 'www');
INSERT INTO `tbl_records` VALUES (0, '', '', 12, 'A', '123');
INSERT INTO `tbl_records` VALUES (0, '', '', 13, 'A', '123');
INSERT INTO `tbl_records` VALUES (0, '', '', 14, 'A', '213');
INSERT INTO `tbl_records` VALUES (0, '', '', 15, 'A', '213');
INSERT INTO `tbl_records` VALUES (0, '', '', 16, 'A', '213');
INSERT INTO `tbl_records` VALUES (0, '', '', 17, 'A', '213');
INSERT INTO `tbl_records` VALUES (0, '', '', 18, 'A', '213');
INSERT INTO `tbl_records` VALUES (0, '', '', 19, 'A', '213');
INSERT INTO `tbl_records` VALUES (9, 'www.testdomain.com', 'testdomain.com', 21, 'A', 'www');
INSERT INTO `tbl_records` VALUES (9, 'www.testdomain.com', 'testdomain.com', 22, 'A', 'mail');
INSERT INTO `tbl_records` VALUES (1, 'www.newdomain.com', 'newdomain.com', 23, 'A', 'www');
INSERT INTO `tbl_records` VALUES (1, 'www.newdomain.com', 'newdomain.com', 24, 'A', 'mail');
INSERT INTO `tbl_records` VALUES (1, 'www.web-a10.org.uk', 'web-a10.org.uk', 25, 'A', 'www');
INSERT INTO `tbl_records` VALUES (1, 'www.web-a10.org.uk', 'web-a10.org.uk', 26, 'A', 'mail');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_settings`
-- 

CREATE TABLE `tbl_settings` (
  `dns_refresh` varchar(64) default NULL,
  `dns_retry` varchar(64) default NULL,
  `dns_expire` varchar(64) default NULL,
  `dns_minimum` varchar(64) default NULL,
  `dns_ip` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Dumping data for table `tbl_settings`
-- 

INSERT INTO `tbl_settings` VALUES ('21474836471', '21474836472', '21474836473', '21474836474', '1231231212321313');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_shop_config`
-- 

CREATE TABLE `tbl_shop_config` (
  `shop_price` decimal(7,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Dumping data for table `tbl_shop_config`
-- 

INSERT INTO `tbl_shop_config` VALUES (1.20);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_subscribe`
-- 

CREATE TABLE `tbl_subscribe` (
  `user_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL auto_increment,
  `sub_date` varchar(64) NOT NULL,
  PRIMARY KEY  (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `tbl_subscribe`
-- 

INSERT INTO `tbl_subscribe` VALUES (1, 1, '2010-02-14');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_userinfo`
-- 

CREATE TABLE `tbl_userinfo` (
  `user_id` int(11) NOT NULL,
  `user_info_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(128) NOT NULL,
  `user_surname` varchar(128) NOT NULL,
  `user_company` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address1` varchar(255) NOT NULL,
  `user_address2` varchar(255) NOT NULL,
  `user_city` varchar(128) NOT NULL,
  `user_country` varchar(128) NOT NULL,
  `user_postcode` varchar(32) NOT NULL,
  `user_telephone` varchar(32) NOT NULL,
  `user_memo` text NOT NULL,
  `user_gender` enum('male','female') default NULL,
  `user_aged` int(2) NOT NULL,
  `user_agem` varchar(32) NOT NULL,
  `user_agey` int(4) NOT NULL,
  `user_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_info_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `tbl_userinfo`
-- 

INSERT INTO `tbl_userinfo` VALUES (1, 1, 'asd123hhn1', 'asd1', 'asd1', '1231', '12saas1', '12332asd1', 'ct1', 'Bahrain', 'asddas1', 'user_telephone12', 'Memo', 'male', 4, '02', 1992, '2009-12-16 13:37:12');
INSERT INTO `tbl_userinfo` VALUES (9, 10, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, '', 0, '2010-04-14 17:00:35');
INSERT INTO `tbl_userinfo` VALUES (9, 11, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, '', 0, '2010-04-14 17:01:47');
INSERT INTO `tbl_userinfo` VALUES (0, 7, '123', '', '', '', '', '', '', '', '', '', '', NULL, 0, '', 0, '2010-04-13 16:30:18');
INSERT INTO `tbl_userinfo` VALUES (9, 8, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, '', 0, '2010-04-14 17:00:05');
INSERT INTO `tbl_userinfo` VALUES (9, 9, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, '', 0, '2010-04-14 17:00:20');
