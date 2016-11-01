<?php

     require 'funcs.php';
	 require 'time.php';
	 
	 echo "您好 php 这里是你所在服务器系统环境参数";
     echo "<br/>";
	 
	 
     
	 
	 
	 //假设变量名为 $number
     $number = 1;
     //指定一个空格容器变量
     $str = '';
     //执行一次FOR循环
     for ($i = 0; $i < $number * 100; $i++) {
              $str .= '&nbsp;';
        }
     //输出空格容器变量
	
	 //添加了100个空格输出apache版本号
	 printf ("Apache 版本:$str%s\n" , apache_get_version());echo "<br/>";
	 
     //连接mysql数据库
	 $conn=mysql_connect("localhost","root","123456");
     
	 //获得mysql数据库版本信息
	 $getmysqlver=@mysql_get_server_info();
	 //输出mysql版本号
     printf ("MySQL版本:$str %s\n", $getmysqlver);echo "<br/>";
	 
	 //输出php版本号
	 printf ("PHP  &nbsp&nbsp &nbsp版本:$str %s\n" ,phpversion());echo "<br/>";
	 
	 //输出当前服务器ip地址和根目录
     printf("当前服务器ip和根目录：%s\n",$_SERVER['SERVER_ADDR']);
	 printf("%s\n",$_SERVER['DOCUMENT_ROOT']) ;echo "<br/>";
	 
	 
	 //显示服务器os完整信息，这个信息和phpinfo()显示的第一行一样。
	 $sys_info = php_uname() . "\n";

     if(strtolower(substr($sys_info,0,5)) == "centos") {
     echo "this is a linux system.\n";
     }
     echo "服务器信息： " . php_uname('a') . "\n";
	 
	 
    
 
	//验证一下这个函数是否好用！调用了funcs函数。
     $tree = recurDir('/home/time/example/fremset example/');
     echo "<pre>";
     $beautifulTree = beautifulTree($tree);
     echo "<pre>";
     print_r($beautifulTree);
     echo "</pre>";

     //print_r($tree);
     //echo "</pre>";
	   




	 
?>
