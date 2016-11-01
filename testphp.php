<?php

     echo "hello words";
     echo "<br/>";
	 echo PHP_INT_SIZE;
	 echo "<br/>";
	 echo PHP_INT_MAX;


     echo "<br/>";
     $conn=mysql_connect("localhost","root","123456");
     if($conn){
                      echo 'MySql数据库连接正常 ok';
               }
			   else{
                      echo '没有ok';
			         }

	$myChar="d";
	   switch($myChar){
		   case "a":
			   echo '<br/>今天星期一，猴子穿新衣';
			   break;
		   case "b":
			   echo '<br/>今天星期二，小猪上大树';
		       break;
	       case "c":
			   echo '<br/>今天星期三，花园开鲜花';
		       break;
		   default:
			   break;
	}


	$i=90;
       $user1="hello$i";
       $user2='hello$i';
       echo '<br/>user1='.$user1;
       echo '<br/>user2='.$user2;


       echo '<br/>'; 
	   for($i=0;$i<6;$i++)
	   {
		   
		   if($i<3)
		   {
		         
		       for($j=0;$j<=$i;$j++)
		           {
			           echo "*";
		           }
				   echo '<br/>';
		   }
	   }




	 
?>
