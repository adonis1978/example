<?php
require "global.php";

require "forms.php";
require "php_pagenav_class.php";
$cpforms = new FORMS;

require "header.php";
islogin();


$threadid = intval($_REQUEST[threadid]);
if(!$threadid){
  msg('URL参数缺少项目ID。','test_thread.php?action=edit');
  exit;
}else{
  $rs = $db->query_first("SELECT * FROM ".$db_prefix."thread WHERE id='$threadid'");
  if(!$rs){
     msg('查无此项目。','test_thread.php?action=edit');
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


if ($_GET[action]=="add")  {
    $tid = intval($_GET[id]);
	$title = $db->fetch_one_array("SELECT * FROM ".$db_prefix."title WHERE id=$tid");
      echo "<table class=\"tableoutline\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" align=\"center\">
               <tr class=\"tbhead\">
                <td nowrap > 当前主题 </td>
               </tr>
               <tr >
                <td nowrap class=".getrowbg().">$title[title]</td>
               </tr>
               <tr >
                <td nowrap align=\"right\" class=".getrowbg().">选择类型 ".($title[choice] ? "单选" : "多选")." <a href=\"test_title.php?action=mod&threadid=$threadid&id=$id\">编辑</a></td>
               </tr>
			   </table><br>\n";
      
    $cpforms->formheader(array('title'=>'添加新选项'));
	
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'insert'));
    $cpforms->makehidden(array('name'=>'threadid',
                                'value'=>$threadid));
    $cpforms->makehidden(array('name'=>'tid',
                                'value'=>$tid));

    $cpforms->makeinput(array('text'=>'选项内容:',
                               'name'=>'choice'));

     $cpforms->makeyesno(array('text'=>'是否默认?','name'=>'IsDefault'));
    $cpforms->formfooter();
    echo "<br><table class=\"tableoutline\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" align=\"center\">
               <tr class=\"tbhead\">
                <td nowrap width=\"50%\"> 选项内容 </td>
                <td nowrap align=\"center\"> 是否默认 </td>
                <td nowrap align=\"center\"> 操作 </td>
               </tr>\n";

	$id = intval($_GET[id]);
    $q = $db->query("SELECT * FROM ".$db_prefix."choice WHERE extends=$id ORDER BY id DESC");
	while($choice  = $db->fetch_array($q)){
	     
          echo "<tr class=".getrowbg().">
                <td nowrap width=\"50%\">$choice[choice]</td>
                <td nowrap align=\"center\">".($choice[IsDefault] ? "默认" : "&nbsp;")."</td>
                <td nowrap align=\"center\"> <a href=\"test_choice.php?action=mod&threadid=$threadid&id=$choice[id]\">编辑</a> <a href=\"test_choice.php?action=kill&threadid=$threadid&id=$choice[id]&tid=$choice[extends]\">删除</a> </td>
               </tr>\n";
   
   }


    echo "<tr class=tbcat>
            <td colspan=\"3\" align=\"center\"> </td>\n</tr>\n</table>\n";

}



if ($_POST[action]=="insert"){
    $threadid = intval($_POST[threadid]);
	$extends = intval($_POST[tid]);//标题id
    $choice = htmlspecialchars(trim($_POST[choice]));
    $IsDefault = $_POST[IsDefault];
    if ($choice==""){
        pa_exit("选项名不能为空");
    }
    if($IsDefault)
	$db->query("UPDATE ".$db_prefix."choice SET IsDefault=0 WHERE extends=$extends");
    $db->query("INSERT INTO ".$db_prefix."choice (choice,extends,IsDefault)VALUES ('".addslashes($choice)."','$extends','".addslashes($IsDefault)."')");

    msg("选项已添加","./test_choice.php?action=add&threadid=$threadid&id=$extends");

}



if ($action=="mod")  {
    
	$threadid = intval($_GET[threadid]);
	$id = intval($_GET[id]);
	$choice = $db->fetch_one_array("SELECT * FROM ".$db_prefix."choice WHERE id=$id");
    $cpforms->formheader(array('title'=>'修改选项'));
	
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'update'));
    $cpforms->makehidden(array('name'=>'threadid',
                                'value'=>$threadid));
    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));
    $cpforms->makehidden(array('name'=>'tid',
                                'value'=>$choice['extends']));


    $cpforms->makeinput(array('text'=>'选项内容:',
                               'name'=>'choice',
							   'value'=>$choice[choice]
							   ));

    $cpforms->makeyesno(array('text'=>'是否默认?','name'=>'IsDefault','selected'=>$choice[IsDefault]));
    $cpforms->formfooter(array('confirm'=>1));

}



if ($_POST[action]=="update"){
    
	$threadid = intval($_POST[threadid]);
    $extends = intval($_POST[tid]);//标题 id
	$id = intval($_POST[id]);//选项id
    $choice = htmlspecialchars(trim($_POST[choice]));
    $IsDefault = $_POST[IsDefault];
    if ($choice==""){
        pa_exit("选项名不能为空");
    }
    if($IsDefault)
	$db->query("UPDATE ".$db_prefix."choice SET IsDefault=0 WHERE extends=$extends");
    $db->query("UPDATE ".$db_prefix."choice SET choice='".addslashes($choice)."',IsDefault='".addslashes($IsDefault)."'  WHERE id=$id");

    msg("选项已修改","./test_choice.php?action=add&threadid=$threadid&id=$extends");

}


if ($_GET[action]=="kill"){
    $threadid = intval($_GET[threadid]);
    $id = intval($_GET[id]);
	$tid = intval($_GET[tid]);
    $cpforms->formheader(array('title'=>'确实要删除该选项?'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'remove'));
    $cpforms->makehidden(array('name'=>'threadid',
                                'value'=>$threadid));
    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));
    $cpforms->makehidden(array('name'=>'tid',
                                'value'=>$tid));

    $cpforms->formfooter(array('confirm'=>1));

}



if ($_POST[action]=="remove"){
    
	$threadid=$_POST[threadid];
    $id = intval($_POST[id]);
	$tid = intval($_POST[tid]);
    $db->query("DELETE FROM ".$db_prefix."choice WHERE id =$id");

    msg("该选项已删除","./test_choice.php?action=add&threadid=$threadid&id=$tid");

}






require "footer.php";
?>