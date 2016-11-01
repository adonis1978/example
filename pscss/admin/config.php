<?php
error_reporting(7);
// ******************** 数据库设置 ********************
$dbuser     = "root";              							// 数据库用户名
$dbpassword = "123456";               						// 数据库密码
$dbdatabase = "onlinetest";       						// 数据库名称
$db_prefix  = "test_";									// 数据表名称前缀
///////////
$settings=array(
    'sitename'   =>'大连银行沈阳分行在线考试系统 v0.1',
	'copyright'=>'Copyright &copy; 2016年10月 测试版 V0.1',
	'timeoffset' => 8,
	'datetimeformat' => 'Y.m.d H:i',
	'dateformat' => 'Y年m月d日',
	'timeformat' => 'H时i分',
    'adminout'=>'300',
	'pagenum' => 10,

	'rstime' => 3,

	'adminnum' => 20,
	'adminout' => 1000,

	'allimgwidth' => 640,

	'mfrcols' => 5,
	'mfrrows' => 5,

	'lognum' => 20,

	'logowidth'=> 88,
	'logoheight'=> 31,

	'mainwidth' => '100%',
	'mainbgcolor' => '#9EB6D8',

	'bordercolor' => '#698CC3',
	'borderbgcolor' => '#D6E0EF',

	'headercolor' => '#FFFFFF',
	'headerbgcolor' => '#698CC3',

	'titlecolor' => '#000000',
	'titlebgcolor' => '#EFEFEF',

	'altbgcolor1' => '#FFFFFF',
	'altbgcolor2' => '#EEEEEE',
	'altbgcolor3' => '#8BAEE5',

);

?>
