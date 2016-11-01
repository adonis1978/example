-- 创建数据库
CREATE DATABASE onlinetest;
use onlinetest;

-- 表的结构 `test_admin`

CREATE TABLE `test_admin` (
  `adminid` int(11) NOT NULL auto_increment,
  `adminname` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY  (`adminid`)
) TYPE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
INSERT INTO `test_admin` (`adminid`, `adminname`, `password`) VALUES 
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- 表的结构 `test_choice`
-- 

CREATE TABLE `test_choice` (
  `id` int(11) NOT NULL auto_increment,
  `choice` varchar(100) NOT NULL default '',
  `extends` int(11) default '0',
  `IsDefault` tinyint(1) default '0',
   PRIMARY KEY  (`id`),
  KEY `choice` (`choice`)
) TYPE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE `test_setmark` (
  `radio` tinyint(5) NOT NULL default '2',
  `checkbox` tinyint(5) NOT NULL default '4'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `test_setmark` ( `radio` , `checkbox` ) VALUES ('2', '4');

-- --------------------------------------------------------
-- 
-- 表的结构 `test_thread`
-- 

CREATE TABLE `test_thread` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `date` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `test_title`
-- 

CREATE TABLE `test_title` (
  `id` int(11) NOT NULL auto_increment,
  `threadid` int(10) NOT NULL default '0',
  `title` varchar(200) NOT NULL default '',
  `choicetype` enum('radio','checkbox','text','textarea') default NULL,
  `answer` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `themeid` (`threadid`)
) TYPE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
