<?php

      $arr[0]=true;
	  $arr[1]=100;
	  $arr=array(1,90,"helllo",89.5);
      for($i=0;$i<count($arr);$i++){
		  
		  echo "显示数组的每一个元素的值：arr"."[".$i."]= ".$arr[$i]."</br>";
		}
       print_r($arr);echo "</br>";
	   
	   $arr[4]=true;
	   $arr[5]=89;
       //我要访问"logo"这个值
       echo $arr[4];
       echo "<br/>".$arr[5];
       echo "</br>";
	   print_r($arr);
	   echo "</br>";
	   var_dump($arr);
	   echo "</br>";
	   $aaa="my name is hehe.";
	   $aaa.="&nbsp &nbsp &nbsp from chian.";
	   echo $aaa;
	   
	   echo "</br>";
	   $str="北京&上海&天津&河北&辽宁";
	   $arr=explode("&",$str);
	   print_r($arr);
	   
	   echo "</br>";
	   $sport=array(10,12,5.7,9.14);
	   
	   foreach($arr as $key3=>$val2){
              echo $key3."=".$val2."<br/>";
       }

	   $sum=0;
	   for($i=0;$i<count($sport);$i++){
		   $sum+=$sport[$i];
	   }
	   $averagetime=$sum/count($sport);
	   echo "运动会孩子的平均成绩是：".$averagetime."s";




?>