<?php
	//开发者昵称：牵挂丶
	//开发者ＱＱ：1143099512
	//版权信息：翼创传媒工作室（www.sdyccm.cn）
	
	ini_set("display_errors", 0);
	require ('../inc/lang.php');
	session_start(); 
	include ('../inc/conn.php');//连接数据库
	if (!isset ($_SESSION['login'])) { 
		echo '<script>location.href="login.php"</script>';
	}
	$sql='SELECT COUNT(*) FROM school';
	$res=mysql_query($sql);
	list($cnt)=mysql_fetch_row($res);
	$sql1='SELECT COUNT(*) FROM list';
	$res1=mysql_query($sql1);
	list($cnt1)=mysql_fetch_row($res1);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $lang->admin->index;?> - <?php echo $lang->admin->title;?></title>
	<?php include ('header.php');?>


</head>
<body>
	<div class="bodydiv" align="center">
	<div class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?php echo $lang->admin->title;?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><?php echo $lang->admin->index;?></a></li>
            <li class="dropdown"><a href="../index.php" target="_blank"><?php echo $lang->admin->goindex;?></a></li>
            <li class="dropdown"><a href="love.php"><?php echo $lang->admin->love;?></a></li>
            <li class="dropdown"><a href="system.php"><?php echo $lang->admin->system;?></a></li>
            <li class="dropdown"><a href="pswd.php"><?php echo $lang->admin->pswd;?></a></li>
        </ul>
    </div>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<p align="center" style="font-size: 24px;">已发布表白<?php echo $cnt1;?>条</p>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong><?php echo '管理员“'.$_SESSION['login'].'”登陆成功,尽情管理您的网站吧！'?></strong>
	</div>
	
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>网站版本：<?php echo $lang->all->name.' '.$lang->all->edition;?></strong><br />
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>服务器IP：<?php echo GetHostByName($_SERVER['SERVER_NAME']);?></strong><br />
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>服务器版本：<?php echo php_uname();?></strong><br />
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>服务器语言：<?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></strong><br />
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>PHP版本：<?php echo PHP_VERSION;?></strong><br />
		<span class="glyphicon glyphicon-ok-sign"></span>
		<strong>网站路径：<?php echo __FILE__;?></strong><br />
	</div>
	<div class="footer navbar-inverse">
		<p><?php echo $lang->admin->footer;?></p>
	</div>
	</div>
	<iframe src="" width="0px" height="0px" style="display:none;" name="urlurl"></iframe>
	<script type="text/javascript">
    
 var div1 = document.getElementById('Quietflow');  
          div1.style.width=0; 
          div1.style.height=0; 

</script>
</body>
</html>