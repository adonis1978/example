<?php

require "global.php";

require "forms.php";
require "php_pagenav_class.php";
$cpforms = new FORMS;

require "header.php";
islogin();

if ($action=="edit")  {

    echo "<table class=\"tableoutline\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" align=\"center\">
               <tr class=\"tbhead\">
                <td>#ID</td>
				<td>考试名称 </td>
                <td> 日期 </td>
				<td> 操作 </td>
               </tr>\n";

    $q= $db->query("SELECT * FROM ".$db_prefix."thread ORDER BY id DESC");
    while($title=$db->fetch_array($q)){
          echo "<tr class=".getrowbg().">
                <td>$title[id]</td>
				<td><a href='test_title.php?action=edit&threadid=$title[id]' title='查看所有考试题目'>$title[name]</a></td>
                <td>".maketime($title[date],'datetime')."</td>
				<td><a href='test_title.php?action=add&threadid=$title[id]'>添加新考试题目</a> <a href='".$_SERVER['PHP_SELF']."?action=mod&id=$title[id]'>编辑</a> <a href='".$_SERVER['PHP_SELF']."?action=kill&id=$title[id]'>删除</a></td>
               </tr>\n";
   
   }

    echo "<tr class=tbcat>
            <td colspan=\"4\" align=\"center\"> </td>\n</tr>\n</table>\n";

}
if ($action=="add")  {

    $cpforms->formheader(array('title'=>'添加新考试名称'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'insert'));

    $cpforms->makeinput(array('text'=>'考试名称:',
                               'name'=>'name'));
	$cpforms->formfooter();
}


if ($_POST[action]=="insert"){

    $name = htmlspecialchars(trim($_POST[name]));
	if(!$name){
	    msg("考试名称不能为空",$_SERVER['PHP_SELF']."?action=add");
		exit;
	}
    $db->query("INSERT INTO ".$db_prefix."thread(name,date) VALUES ('".addslashes($name)."','".time()."')");
    $id = $db->insert_id();
    msg("新考试名称已添加,请为此次考试添加考试题目。<a href=\"test_title.php?action=add&threadid=$id\">点我添加考试题目</a>","./test_title.php?action=add&threadid=$id");

}



if ($action=="mod")  {

    $id = intval($_GET[id]);
	$title = $db->fetch_one_array("SELECT * FROM ".$db_prefix."thread WHERE id=$id");
    $cpforms->formheader(array('title'=>'修改考试名称'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'update'));
    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));

    $cpforms->makeinput(array('text'=>'考试名称:',
                               'name'=>'name',
							   'value'=>$title[name]));
	$cpforms->formfooter();

}



if ($_POST[action]=="update"){

    $id = intval($_POST[id]);
	$name = htmlspecialchars(trim($_POST[name]));

    $db->query("UPDATE ".$db_prefix."thread SET name='".addslashes($name)."' WHERE id=$id");
    
    msg("考试名称已更新","./test_thread.php?action=edit");


}


if ($_GET[action]=="kill"){

    $id = intval($_GET[id]);
    $cpforms->formheader(array('title'=>'确实要删除该考试名称?该考试名称的所有考试题目均会被删除！！'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'remove'));
    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));

    $cpforms->formfooter(array('confirm'=>1));

}



if ($_POST[action]=="remove"){

    $id = intval($_POST[id]);
    
    //删除所有选项
	$q = $db->query("SELECT id FROM ".$db_prefix."title WHERE threadid='$id'");
	while($r=$db->fetch_array($q)){
	      $db->query("DELETE FROM ".$db_prefix."choice WHERE  extends=$r[id]");
	}
	//删除所有标题
    $db->query("DELETE FROM ".$db_prefix."title WHERE threadid =$id");

	//删除试题名称
    $db->query("DELETE FROM ".$db_prefix."thread WHERE id =$id");

    msg("考试名称及其下所有题目均被删除。","./test_thread.php?action=edit");

}

////////题目分数设置
if($_GET[action]=="setmark"){
   $mark = $db->query_first("SELECT * FROM ".$db_prefix."setmark");

   $contstr = array();
   $contstr[] = array('单选题','left','10%');
   $contstr[] = array(makeinput('text','radio',array($mark[radio],'10','分'),''),'left');
   $contstr[] = array('多选题','left');
   $contstr[] = array(makeinput('text','checkbox',array($mark[checkbox],'10','分'),''),'left');
   
   $header = array('题目分数设置',2);
   $titles = array();
   $footer = array('<input type="submit" name="submit" value=" 确定 ">','center');
   echo "<form name='form' action='$selfurl' method='post'><input name='action' value='dosetmark' type='hidden'>";
   maketablev($header,$titles,$contstr,$footer);
   echo "</form>";
   
}

if($_POST[action]=="dosetmark"){
   $radio = sql($_POST[radio]);
   $checkbox = sql($_POST[checkbox]);
   $db->query("UPDATE ".$db_prefix."setmark set radio='$radio',checkbox='$checkbox'");
   msg("分数修改成功。",$selfurl."?action=setmark");
}

require "footer.php";
?>