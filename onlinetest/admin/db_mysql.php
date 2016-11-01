<?php
// MYSQL 数据库类
class db_sql {
	var $usepconnect=0;
	var $server='localhost';
	var $port='3306';
	var $user='root';
	var $password='123456';
	var $database='onlinetest';
	var $link_id=0;
	var $query_id=0;

	var $query_num=0;
	var $query_time=0;
	var $query_str='';

	// 连接数据库服务器
	function connect(){
		if ($this->usepconnect==1){
			$this->link_id=mysql_pconnect($this->server.':'.$this->port,$this->user,$this->password);
		}else{
			$this->link_id=mysql_connect($this->server.':'.$this->port,$this->user,$this->password);
		}
		if (!$this->link_id){
			$this->halt('数据库服务器“'.$this->server.'”连接错误，请联系管理员！');
		}
	}
	// 选择数据库
	function select_db(){
		if(!mysql_select_db($this->database,$this->link_id)){
			$this->halt('“'.$this->database.'”数据库选择错误，请联系管理员！');
		}
	}
	// SQL 查询
	function query($query_string){
		$sql_start=getmicrotime();
		$this->query_id=mysql_query($query_string,$this->link_id);
		$sql_end=getmicrotime();
		if (!$this->query_id){
			$this->halt('无效的SQL: '.$query_string);
		}
		$this->query_num++;
		$this->query_time+=number_format($sql_end-$sql_start,3,'.','');
		$this->query_str.='('.number_format($sql_end-$sql_start,3,'.','').'ms) '.$query_string.'<br>';
		return $this->query_id;
	}
	// 取得查询结果
	function fetch_array($query_id,$type=MYSQL_ASSOC){
		return mysql_fetch_array($query_id,$type);
	}
	// 取得结果行的数目
	function num_rows($query_id){
		return mysql_num_rows($query_id);
	}
	// 释放查询结果内存
	function free_result($query_id){
		return mysql_free_result($query_id);
	}
	// 取得查询结果第一行
	function query_first($query_string){
		$query_id=$this->query($query_string);
		$returnarray=$this->fetch_array($query_id);
		$this->free_result($query_id);
		return $returnarray;
	}
	
/*******************************/	
	// 取得查询结果第一行
	function fetch_one_array($query_string){
		$query_id=$this->query($query_string);
		$returnarray=$this->fetch_array($query_id);
		$this->free_result($query_id);
		return $returnarray;
	}

      function affected_rows() {
               $this->affected_rows = mysql_affected_rows($this->link_id);
               return $this->affected_rows;
      }



/*********************************/
	// 取得上一步 INSERT 操作时产生的 ID
	function insert_id(){
		return mysql_insert_id($this->link_id);
	}
	// 关闭MySQL数据库服务器连接
	function close(){
		return mysql_close();
	}
	// 错误中断
	function halt($msg){
		echo htmlspecialchars($msg);
		exit;
	}
}
?>
