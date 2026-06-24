<?php
	//开发者昵称：牵挂丶
	//开发者ＱＱ：1143099512
	//版权信息：翼创传媒工作室（www.sdyccm.cn）
	
	if(isset($_POST["content"]))
	{
	include ('conn.php');
	ob_start();
	header("Content-type: text/html; charset=utf-8");
	mysql_query("set names utf8");

	ini_set("output_buffering", "1");
	setcookie("userip", "yes" , time()+1);
	$name = $_POST['realname'];
	$to = $_POST['towho'];
	$content = $_POST['content'];
	$xuexiao =$_POST['xx'];
	$xbie=$_POST['xb'];
	date_default_timezone_set('Etc/GMT-8');
	$lastdate = date("Y-m-d H:i");
	$sql = "insert into hy_thread (niming,title,content,lastdate,biaobai,fid,pid,xb)  values('$name','$to','$content','$lastdate','1','$xuexiao','1','$xbie')";
	$result = mysql_query($sql);
	$sql="select * from hy_thread where id=(select max(id)from hy_thread)";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
      $jj=$row['id'];
	$sql = "insert into hy_post (tid,fid,isthread,uid)  values('$jj','$xuexiao','1','1')";
	$result = mysql_query($sql);
	header('Location:http://www.tlmsu.com');
	
	}
	
	else
	{
		header('Location:http://www.tlmsu.com');
	}
	
		

	
?>