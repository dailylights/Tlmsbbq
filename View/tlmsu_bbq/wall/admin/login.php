<?php
	//开发者昵称：牵挂丶
	//开发者ＱＱ：1143099512
	//版权信息：翼创传媒工作室（www.sdyccm.cn）
	
	ini_set("display_errors", 0);
	require ('../inc/lang.php');
	session_start(); 
	include ('../inc/conn.php');//连接数据库
	$username = $_POST['username'];//获取登录表单信息
	$password = md5($_POST['password']);//获取登录表单信息
	$sql = "select * from admin where user = '".$username."'";//查询数据库
	$set = mysql_query($sql);
	$result = mysql_fetch_array($set);
	if($result[pswd] == $password){
		$_SESSION['login'] = $username;
		echo "<script>location.href='index.php';</script>";
	}
	mysql_close($con); //关闭数据库连接
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $lang->admin->login;?> - <?php echo $lang->admin->title;?></title>
	<?php include ('header.php');?>
</head>
<body style="overflow:hidden">
	<div class="bodydiv">
		<div class="login-top navbar-inverse">
			<p><?php echo $lang->admin->title;?></p>	
		</div>
		<div class="login-box">
			<form action="" method="post">
				<div class="login-box-top">
					<p><?php echo $lang->admin->admlog;?></p>				
				</div>
				<div class="login-box-center" align="center">
					<div class="formdiv">
					<div class="form-group"><br />
			            <input type="text" name="username" class="form-control" placeholder="<?php echo $lang->admin->username;?>">
			        </div>
				    <div class="form-group">
				        <input type="password" name="password" placeholder="<?php echo $lang->admin->password;?>" class="form-control">
				    </div>
				        <button type="submit" class="btn"><?php echo $lang->admin->login;?></button>
					</div>
				</div>
				<div class="login-box-bottom">
					<p><a href="/">->返回首页</a></p>
				</div>
			</form>
		</div>
		<footer class="navbar-inverse">
			<p><?php echo $lang->admin->footer;?></p>
		</footer>
	</div>
</body>
</html>