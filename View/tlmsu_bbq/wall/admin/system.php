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
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $lang->admin->system;?> - <?php echo $lang->admin->title;?></title>
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
	            <li class="dropdown"><a href="index.php"><?php echo $lang->admin->index;?></a></li>
	            <li class="dropdown"><a href="../index.php" target="_blank"><?php echo $lang->admin->goindex;?></a></li>
	            <li class="dropdown"><a href="love.php"><?php echo $lang->admin->love;?></a></li>
	            <li class="active"><a href="system.php"><?php echo $lang->admin->system;?></a></li>
	            <li class="dropdown"><a href="pswd.php"><?php echo $lang->admin->pswd;?></a></li>
	        </ul>
	    </div>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<p align="center" style="font-size: 24px;"><?php echo $lang->admin->system;?></p>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<form action="submit.php" method="post">
			<?php
				mysql_query("set names utf8");
				$sql = "select * from system";//查询数据库
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
			{	
			?>
			<div class="form-group">
				<input type="text" value="system" name="from" style="display: none;"/>
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">网站标题</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['title']?>" name="title" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">标题后缀</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['titlesm']?>" name="titlesm" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">关键词</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['keywords']?>" name="keywords" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">网站描述</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['description']?>" name="description" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">网站域名</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['weburl']?>" name="weburl" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">底部版权</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['footer']?>" name="footer" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">客服QQ</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['qq']?>" name="qq" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<div class="form-group">
			    <label for="firstname" class="col-sm-1 control-label" style="text-align: right;margin-top: 7px;">学校名称</label>
			    <div class="col-sm-11">
			    	<input value="<?=$row['school']?>" name="school" type="text" class="form-control" id="firstname">
				</div>
			</div>
			<br /><br />
			<?php
				}
				$len=count($arid);
				mysql_close($connect);
			?>
			<div class="form-group">
			    <div class="col-sm-12" style="text-align: center;">
			    	<input type="submit" class="btn btn-default" style="width: 60%;" value="更改设置" />
			    </div>
			</div>
			<br />
		</form>
	</div>
	<div class="footer navbar-inverse">
		<p><?php echo $lang->admin->footer;?></p>
	</div>
</div>
</body>
</html>