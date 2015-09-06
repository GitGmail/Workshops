<?php
mysql_connect("localhost","root","");
mysql_select_db("jquery_db");

if($_GET['action']=='getComment'){
	$sql=mysql_query("select * from tbl_comment");
	if(!empty($sql)){
		while($row=mysql_fetch_array($sql)){
			echo $row['com_text'].'<br>';	
		}	
	}
}

//--- to get action and save to database ---
if($_GET['action']=='saveChat'){
	mysql_query("insert into tbl_comment values('','".$_GET['com_text']."')");	
}

//--- to response to action loadData ---
if($_GET['action']=='loadChat'){
	$sql=mysql_query("select * from tbl_comment order by com_id desc");
	if(!empty($sql)){
		while($row=mysql_fetch_array($sql)){
			echo $_SERVER['REMOTE_ADDR'].'<br>'.$row['com_text'].'<hr>';	
		}	
	}else{
		echo '---- data not found ---';	
	}
}
?>