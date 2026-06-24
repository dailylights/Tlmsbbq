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
	setcookie("userip", "yes" , time()+300);
	$name = $_POST['realname'];
	$to = $_POST['towho'];
	$content = $_POST['content'];
	$xuexiao =$_POST['xx'];
	date_default_timezone_set('Etc/GMT-8');
	$lastdate = date("Y-m-d H:i");
	$sql = "insert into hy_thread (niming,title,content,lastdate,biaobai,fid,pid)  values('$name','$to','$content','$lastdate','1','$xuexiao','1')";
	$result = mysql_query($sql);
	$sql="select * from hy_thread where id=(select max(id)from hy_thread)";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
      $jj=$row['id'];
	$sql = "insert into hy_post (tid,fid,isthread,uid)  values('$jj','$xuexiao','1','1')";
	$result = mysql_query($sql);
	
	  if(isset($_POST["toemail"]))
		{
		// 邮件
		require_once "email.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "15957238978@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $_POST['toemail']."@139.com";//发送给谁
	$smtpuser = "15957238978@163.com";//SMTP服务器的用户帐号
	$smtppass = "123qwe";//SMTP服务器的用户密码
	$mailtitle =$name."对你表白啦!";//邮件主题
	$mailcontent = "<h1 style=color:#E28757>".$content."<h1>"."<br>"."<h3>"."<a href=http://t.cn/RifYoN3>"."由德清校区表白墙推送 ,点击查看更多表白信息!"."</a>" ."</h3>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
		header('Location:http://www.521.igelou.com');
		}
	
	
	}
	
	else
	{
		header('Location:http://www.521.igelou.com');
	}
	
		

	
?>