<?php

require "global.php";

require "forms.php";
require "php_pagenav_class.php";
$cpforms = new FORMS;

require "header.php";

$threadid = intval($_REQUEST[threadid]);
if(!$threadid){
  msg('URL����ȱ����ĿID��','test_thread.php?action=edit');
  exit;
}else{
  $rs = $db->query_first("SELECT * FROM ".$db_prefix."thread WHERE id='$threadid'");
  if(!$rs){
     msg('���޴˿��⡣','test_thread.php?action=edit');
     exit;
  }
}

$rs = $db->query_first("SELECT name FROM ".$db_prefix."thread WHERE id='$threadid'");
$cpforms->tableheader();
echo "<tr class=".getrowbg().">
          <td >
              <strong>��<a href='test_title.php?action=edit&threadid=$threadid'>$rs[name]</a></strong>
          </td>
          <td  align=right>
             <a href='test_title.php?action=add&threadid=$threadid'>����±���</a>
          </td>
        </tr>";
$cpforms->tablefooter();
echo "<br>";

if ($action=="edit")  {
   

    echo "<table class=\"tableoutline\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" align=\"center\">
               <tr class=\"tbhead\">
                <td>#ID</td>
				<td nowrap width=\"50%\"> ���� </td>
                <td nowrap align=\"center\"> ѡ�� </td>
				 <td nowrap align=\"center\"> ѡ������ </td>
                <td nowrap align=\"center\"> ���� </td>
               </tr>\n";

    $q= $db->query("SELECT * FROM ".$db_prefix."title WHERE threadid='$threadid' ORDER BY id DESC");
    while($title=$db->fetch_array($q)){
	      switch($title[choicetype]){
		         case "radio":   $choicetype="��ѡ";$prehref="http://www.imp3.net/article/test_show.php?id=$title[id]";break;
				 case "checkbox":$choicetype="��ѡ";$prehref="http://www.imp3.net/article/test_show.php?id=$title[id]";break;
		  }
          echo "<tr class=".getrowbg().">
                <td>$title[id]</td>
				<td width=\"50%\">$title[title]</td>
                <td align=\"center\"> <a href=\"test_choice.php?action=add&threadid=$threadid&id=$title[id]\">���ѡ��</a> </td>
                <td align=\"center\"> $choicetype </td>
                <td align=\"center\"> <a href=\"test_title.php?action=mod&threadid=$threadid&id=$title[id]\">�༭</a> <a href=\"test_title.php?action=kill&threadid=$threadid&id=$title[id]\">ɾ��</a> </td>
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
    $cpforms->formheader(array('title'=>'����±���'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'insert'));

    $cpforms->makeselect(array('text'=>'ѡ�����:',
                               'name'=>'threadid',
							   'option'=>$items,
							   'selected'=>(intval($_GET[threadid]) ? intval($_GET[threadid]) : 0)
							   ));
							   
    $cpforms->maketextarea(array('text'=>'��������:',
                               'name'=>'title'));

    $cpforms->makeselect(array('text'=>'ѡ�����ͣ�',
                               'name'=>'choicetype',
                               'option'=>array('radio'=>'��ѡ','checkbox'=>'��ѡ')
								   ));
    $cpforms->makeinput(array('text'=>'��ȷ��:�ж�����Զ���"��"�ֿ�',
                               'name'=>'answer'));

    
	
	$cpforms->formfooter();
}


if ($_POST[action]=="insert"){

    $threadid = intval($_POST[threadid]);
    $title = htmlspecialchars(trim($_POST[title]));
    $choicetype = $_POST[choicetype];
	$answer = sql($_POST[answer]);
    $answer = str_replace("��",",",$answer);
    if(!$title || !$answer){
	   msg("��Ŀ����ʹ𰸶�����Ϊ��","$selfurl?action=add");exit;
	}
	
	$db->query("INSERT INTO ".$db_prefix."title(threadid,title,choicetype,answer) VALUES ('$threadid','".addslashes($title)."','".addslashes($choicetype)."','$answer')");
    $id = $db->insert_id();
    msg("�±��������,��Ϊ�˱���<a href=\"test_choice.php?action=add&threadid=$threadid&id=$id\">���ѡ��</a>","./test_title.php?action=edit&threadid=$threadid");

}



if ($action=="mod")  {

    $id = intval($_GET[id]);

	$title = $db->fetch_one_array("SELECT * FROM ".$db_prefix."title WHERE id=$id");

   $items = array();
   $q = $db->query("SELECT id,name FROM ".$db_prefix."thread");
   while($r = $db->fetch_array($q)){
         $items[$r[id]]=$r[name];
   }

    $cpforms->formheader(array('title'=>'�޸ı���'));
    $cpforms->makehidden(array('name'=>'action',
                                'value'=>'update'));

    $cpforms->makehidden(array('name'=>'id',
                                'value'=>$id));

    $cpforms->makeselect(array('text'=>'ѡ����Ŀ:',
                               'name'=>'threadid',
							   'option'=>$items,
							   'selected'=>$title[threadid]
							   ));
    $cpforms->maketextarea(array('text'=>'��������:',
                               'name'=>'title',
							   'value'=>$title[title]));

    $cpforms->makeselect(array('text'=>'ѡ�����ͣ�',
                               'name'=>'choicetype',
                               'option'=>array('radio'=>'��ѡ','checkbox'=>'��ѡ'),
							   'selected'=>$title[choicetype]));
								  
    $cpforms->makeinput(array('text'=>'��ȷ��:�ж�����԰�Ƕ���","�ֿ�',
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
	$answer = str_replace("��",",",$answer);
    if(!$title || !$answer){
	   msg("��Ŀ����ʹ𰸶�����Ϊ��","$selfurl?action=add");exit;
	}
	
    $db->query("UPDATE ".$db_prefix."title SET threadid='$threadid',title='".addslashes($title)."',choicetype='".addslashes($choicetype)."',answer='$answer' WHERE id=$id");
    
    msg("�����Ѹ���","./test_title.php?action=mod&threadid=$threadid&id=$id");


}


if ($_GET[action]=="kill"){

    $id = intval($_GET[id]);
	$threadid = intval($_GET[threadid]);
    $cpforms->formheader(array('title'=>'ȷʵҪɾ���ñ���?�ñ�����ñ����µ�����ѡ����ᱻɾ��.'));
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

    msg("������ɾ��","./test_title.php?action=edit&threadid=$threadid");

}



require "footer.php";
?>