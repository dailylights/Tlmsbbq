<?php
	//开发者昵称：牵挂丶
	//开发者ＱＱ：1143099512
	//版权信息：翼创传媒工作室（www.sdyccm.cn）
	
	include("../inc/config.php");//调用数据库连接信息
	$conn = mysql_connect($mysql_server_name,$mysql_username,$mysql_password); //连接数据库
	if (!$conn)//如果连接数据库失败 
	{
		echo "<script>alert('连接数据库失败!');</script>";
		die('连接数据库失败： ' . mysql_error());
	}
	mysql_select_db($mysql_database,$conn);//成功的话就执行以下代码
?>