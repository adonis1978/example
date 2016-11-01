<?php

require "global.php";

require "forms.php";
require "php_pagenav_class.php";
$cpforms = new FORMS;

require "header.php";

$threadid = intval($_REQUEST[threadid]);
if(!$threadid){
  msg('URL参数缺少项目ID。','test_thread.php?action=edit');
  exit;
}else{
  $rs = $db->query_first("SELECT * FROM ".$db_prefix."thread WHERE id='$threadid'");
  if(!$rs){
     msg('查无此考题。','test_thread.php?action=edit');
     exit;
  }
}

$rs = $db->query_first("SELECT name FROM ".$db_prefix."thread WHERE id='$threadid'");
$cpforms->tableheader();
echo "<tr class=".getrowbg().">
          <td >
              <strong>★<a href='test_title.php?action=edit&threadid=$threadid'>$rs[name]</a></strong>
          </td>
          <td  align=right>
             <a href='test_title.php?action=add&threadid=$threadid'>添加新标题</a>
          </td>
        </tr>";
$cpforms->tablefooter();
echo "<br>";

if ($action=="edit")  {
   

    echo "<table class=\"tableoutline\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" align=\"center\">
               <tr class=\"tbhead\">
                <td>#ID</td>
				<td nowrap width=\"50%\"> 标题 </td>
                <td nowrap align=\"center\"> 选项 </td>
				 <td nowrap align=\"center\"> 选项类型 </td>
                <td nowrap align=\"center\"> 操作 </td>
               </tr>\n";

    $q= $db->query("SELECT * FROM ".$db_prefix."title WHERE threadid='$threadid' ORDER BY id DESC");
    while($title=$db->fetch_array($q)){
	      switch($title[choicetype]){
		         case "radio":   $choicetype="单选";$prehref="http://www.imp3.net/article/test_show.php?id=$title[id]";break;
				 case "checkbox":$choicetype="复选";$prehref="http://www.imp3.net/article/test_show.php?id=$title[id]";break;
		  }
          echo "<tr class=".getrowbg().">
                <td>$title[id]</td>
				<td width=\"50%\">$title[title]</td>
                <td align=\"center\"> <a href=\"test_choice.php?action=add&threadid=$threadid&id=$title[id]\">添加选项</a> </td>
                <td align=\"center\"> $choicetype </td>
                <td align=\"center\"> <a href=\"test_title.php?action=mod&threadid=$threadid&id=$title[id]\">编辑</a> <a href=\"test_title.php?action=kill&threadid=$threadid&id=$title[id]\">删除</a> </td>
               </tr>\n";
   
   }


    echo "<tr class=tbcat>
            <td colspan=\"6\" align=\"center\"> </td>\n</tr>\n</table>\n";

}
if ($_GET[action]=="add")  {
   
   $items = array();
   $q = $db->query("SELECT id,name FROM ".$db_prefix."thread");
   while($r = $db->fetch_array($q)){
         $items[$r[id]]=$r[name];
   }
    $cpforms->formheader(array('title'=>'添加新标题'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'insert'));

    $cpforms->makeselect(array('text'=>'选择标题:',
                               'name'=>'threadid',
							   'option'=>$items,
							   'selected'=>(intval($_GET[threadid]) ? intval($_GET[threadid]) : 0)
							   ));
							   
    $cpforms->maketextarea(array('text'=>'标题内容:',
                               'name'=>'title'));

    $cpforms->makeselect(array('text'=>'选项类型：',
                               'name'=>'choicetype',
                               'option'=>array('radio'=>'单选','checkbox'=>'多选')
								   ));
    $cpforms->makeinput(array('text'=>'正确答案:有多个答案以逗号"，"分开',
                               'name'=>'answer'));

    
	
	$cpforms->formfooter();
}


if ($_POST[action]=="insert"){

    $threadid = intval($_POST[threadid]);
    $title = htmlspecialchars(trim($_POST[title]));
    $choicetype = $_POST[choicetype];
	$answer = sql($_POST[answer]);
    $answer = str_replace("，",",",$answer);
    if(!$title || !$answer){
	   msg("题目标题和答案都不能为空","$selfurl?action=add");exit;
	}
	
	$db->query("INSERT INTO ".$db_prefix."title(threadid,title,choicetype,answer) VALUES ('$threadid','".addslashes($title)."','".addslashes($choicetype)."','$answer')");
    $id = $db->insert_id();
    msg("新标题已添加,请为此标题<a href=\"test_choice.php?action=add&threadid=$threadid&id=$id\">添加选项</a>","./test_title.php?action=edit&threadid=$threadid");

}



if ($action=="mod")  {

    $id = intval($_GET[id]);

	$title = $db->fetch_one_array("SELECT * FROM ".$db_prefix."title WHERE id=$id");

   $items = array();
   $q = $db->query("SELECT id,name FROM ".$db_prefix."thread");
   while($r = $db->fetch_array($q)){
         $items[$r[id]]=$r[name];
   }

    $cpforms->formheader(array('title'=>'修改标题'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'update'));

    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));

    $cpforms->makeselect(array('text'=>'选择项目:',
                               'name'=>'threadid',
							   'option'=>$items,
							   'selected'=>$title[threadid]
							   ));
    $cpforms->maketextarea(array('text'=>'标题内容:',
                               'name'=>'title',
							   'value'=>$title[title]));

    $cpforms->makeselect(array('text'=>'选项类型：',
                               'name'=>'choicetype',
                               'option'=>array('radio'=>'单选','checkbox'=>'多选'),
							   'selected'=>$title[choicetype]));
								  
    $cpforms->makeinput(array('text'=>'正确答案:有多个答案以半角逗号","分开',
                               'name'=>'answer',
							   'value'=>$title[answer]
							   ));

	$cpforms->formfooter();

}



if ($_POST[action]=="update"){

    $id = intval($_POST[id]);
	$threadid = intval($_POST[threadid]);
	$title = htmlspecialchars(trim($_POST[title]));
    $choicetype = $_POST[choicetype];
	$answer = sql($_POST[answer]);
	$answer = str_replace("，",",",$answer);
    if(!$title || !$answer){
	   msg("题目标题和答案都不能为空","$selfurl?action=add");exit;
	}
	
    $db->query("UPDATE ".$db_prefix."title SET threadid='$threadid',title='".addslashes($title)."',choicetype='".addslashes($choicetype)."',answer='$answer' WHERE id=$id");
    
    msg("标题已更新","./test_title.php?action=mod&threadid=$threadid&id=$id");


}


if ($_GET[action]=="kill"){

    $id = intval($_GET[id]);
	$threadid = intval($_GET[threadid]);
    $cpforms->formheader(array('title'=>'确实要删除该标题?该标题与该标题下的所有选项均会被删除.'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'remove'));
    $cpforms->makehidden(array('name'=>'threadid',
                                'value'=>$threadid));
    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));

    $cpforms->formfooter(array('confirm'=>1));

}



if ($_POST[action]=="remove"){

   $threadid = intval($_POST[threadid]);
   $id = intval($_POST[id]);

    $db->query("DELETE FROM ".$db_prefix."title WHERE id =$id");
    $db->query("DELETE FROM ".$db_prefix."choice WHERE extends = $id");

    msg("标题已删除","./test_title.php?action=edit&threadid=$threadid");

}



require "footer.php";
?>