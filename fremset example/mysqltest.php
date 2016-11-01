<?php 
     //数据库登录参数
	 $host = 'localhost'; 
     $database = 'test'; 
     $username = 'root'; 
     $password = '123456'; 
	 $table_name='user';


     //$selectName = '曹操';//要查找的用户名，一般是用户输入的信息 
     function connectionDatabase($host,$username,$password,$database){
	
             $connection = mysql_connect($host, $username, $password);//连接到数据库服务器
             
             if (!$connection) {  
                    die("could not connect to the database.\n" . mysql_error());//诊断连接错误
                } 
			 $selectedDb = mysql_select_db($database);//选择数据库
			 if (!$selectedDb){  
                    die("could not to the database\n" . mysql_error());
                } 
			 mysql_query("set names 'utf8'");//编码转化 
			 
			 return $connection;
	        }   
	 function showTable($conn,$table_name){
		     
			 $sql="select * from $table_name";         
			 $res=mysql_query($sql,$conn);         
			 $rows=mysql_affected_rows($conn);//获取行数         
			 $colums=mysql_num_fields($res);//获取列数         
			 echo "test数据库的"."$table_name"."表的所有用户数据如下：<br/>";         
			 echo "共计".$rows."行 ".$colums."列<br/>"; 
			 echo "<table style='border-color: #efefef;' border='2px' cellpadding='15px' cellspacing='2px'><tr>";         
			 for($i=0; $i < $colums; $i++){             
			          $field_name=mysql_field_name($res,$i);             
				      echo "<th>$field_name</th>"; 
				  }    
             echo "</tr>";         
			 while($row=mysql_fetch_row($res)){             
			          echo "<tr>";             
					  for($i=0; $i<$colums; $i++){                 
					       echo "<td>$row[$i]</td>";
						 }
					  echo "</tr>";
				}
			 echo "</table>";
		    		 
	        }	

     $conn=connectionDatabase($host,$username,$password,$database);
	 showTable($conn,$table_name);
	 
	 
	 
	 



			
/*$selectName = mysql_real_escape_string($selectName);//防止SQL注入 
$query = "select * from user where name = '$selectName'";//构建查询语句 
$result = mysql_query($query);//执行查询 
if (!$result) {   
      die("could not to the database\n" . mysql_error());
} 
while ($row = mysql_fetch_row($result)) {   //取出结果并显示  
 $name = $row[0];   
 $age = $row[1];  
 echo "Name: $name ";  
 echo "Age: $age ";   
 echo "</br>";
 } 
	
*/

?>

 
 