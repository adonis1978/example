<?php
require "global.php";

if (empty($_COOKIE['adminname'])&&empty($action)){
	$action="logon";
}

if (empty($action)){
	$action="frames";
}

if ($action=="logon"){
	require "header.php";
	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
	$contstr=array();
	$contstr[]=array('管理员','center','30%');
	$contstr[]=array('<input type="text" name="i_adminname" size="25" maxlength="20" value="">','left','35%');
	$contstr[]=array('密　码','center');
	$contstr[]=array('<input type="password" name="i_password" size="25" maxlength="20">','left');

	$header=array('登录入口',2,'260');
	$titles=array();
	$footer=array('<input type="submit" value=" 登录 "> <input type="reset" value=" 重填 ">','center');

	echo "<script language=\"javascript\">function check(){if (!document.iform.i_adminname.value||!document.iform.i_password.value){alert(\"管理员和密码均不能为空！\");return false;}}</script><form action=\"$selfurl\" method=\"post\" name=\"iform\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"login\">";
	maketablev($header,$titles,$contstr,$footer);
	echo "</form>";
	echo "</body>\n</html>";
}

if ($action=="frames"){
?>
<html>
<head>
<title><?php echo $settings['sitename']." - 管理中心";?></title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<frameset rows="22,*" framespacing="1">
	<frame src="index.php?action=top" name="head" noresize scrolling="no" frameborder="0">
	<frameset cols="140,*" framespacing="0">
		<frame src="index.php?action=menu" name="menu" scrolling="yes" frameborder="0">
		<frame src="index.php?action=main" name="main" scrolling="yes" frameborder="0">
	</frameset>
</frameset><noframes></noframes>
</html>
<?php
}

if ($action=="login"){
	$i_adminname=sql($_REQUEST['i_adminname']);
	$i_password=sql($_REQUEST['i_password']);
	$row=$db->query_first("SELECT adminid,adminname,password FROM ".$db_prefix."admin WHERE adminname='$i_adminname'");
	if ($row){
		if ($row['password']!=md5($i_password)){
			$message="密码错误，你无权进入管理中心！";
		}else{
			setcookie("adminid",$row['adminid']);
			setcookie("adminname",trim($i_adminname));
			setcookie("adminpassword",md5($i_password));
			$message="成功登录，正在进入管理中心！";
		}
	}else{
		$message="管理员“<font class=\"empha\">$i_adminname</font>”不存在，你无权进入管理中心！";
	}
	require "header.php";
	msg($message,"index.php");
	echo "</body>\n</html>";
}

if ($action=="logout"){
	setcookie("adminname",NULL);
	require "header.php";
	msg("已退出管理中心！","index.php");
	echo "</body>\n</html>";
}

if ($action=="top"){
?>
<html>
<head>
<title><?php echo $settings['sitename']." - 管理中心";?></title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body bgcolor="#698CC3" style="margin:0px">
<center>
<table border="0" cellspacing="0" cellpadding="3" width="100%">
	<tr>
		<td width="50%" align="left">&nbsp;&nbsp;管理中心</td>
	</tr>
</table>
</body>
</html>
<?php
}

if ($action=="main"){
	require "header.php";
	$contstr=array();
	$contstr[]=array('WWW服务器','center','15%');
	$contstr[]=array($_SERVER['SERVER_SOFTWARE'],'left','35%');
	$contstr[]=array('服务器主机名称','center','15%');
	$contstr[]=array($_SERVER['SERVER_NAME'],'left','35%');
	$contstr[]=array('PHP版本','center');
	$contstr[]=array(phpversion(),'left');
	$contstr[]=array('Zend版本','center');
	$contstr[]=array(zend_version(),'left');
	$contstr[]=array('MySQL服务器版本','center');
	$contstr[]=array(mysql_get_server_info(),'left');
	$contstr[]=array('MySQL客户端版本','center');
	$contstr[]=array(mysql_get_client_info(),'left');
	maketablev(array('服务器信息',4),array(),$contstr);
	require "footer.php";
}

if ($action=="menu"){
	require "header.php";
	$contstr=array();
	$contstr[]=array('<font class="empha">'.$_COOKIE['adminname'].'</font>','center');
	$header=array("管理员",1);
	$titles=array();
	maketablev($header,$titles,$contstr);
	
	
	  $contstr=array();
	  $contstr[]=array(
			'<font class="menu"><a href="test_thread.php?action=edit" target="main">考试列表</a></font><br>'.
			'<font class="menu"><a href="test_thread.php?action=add" target="main">添加考试</a></font><br>'.
			'<font class="menu"><a href="test_thread.php?action=setmark" target="main">分数设置</a></font><br>'
			,"left");
	  $header=array('试题管理',1);
	  $titles=array();
	  maketablev($header,$titles,$contstr);

	  $contstr=array();
	  $contstr[]=array(
			'<font class="menu"><a href="index.php?action=logout" target="main">退出</a></font><br>'
			,"left");
	  $header=array('退出',1);
	  $titles=array();
	  maketablev($header,$titles,$contstr);
	echo "</body>\n</html>";
}
?>

