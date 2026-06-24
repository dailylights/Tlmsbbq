
	<head>
		<title>表白墙</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="style/js/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="style/css/wall_style.css" />
		<link rel="shortcut icon" href="style/img/favicon.ico" />
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
	
	</head>
	<body>
			<script type="text/javascript">
			function validate_required(field,alerttxt)
			{
			    with (field)
			    {
			      if (value==null||value=="")
			        {alert(alerttxt);return false}
			      else {return true}
			    }
			}
			function validate_form(thisform)
			{
			with (thisform)
			{
			    if (validate_required(content,"请填写表白内容")==false)
			    {content.focus();return false}
			}
			with (thisform)
			{
			    if (validate_required(realname,"请填写昵称")==false)
			    {realname.focus();return false}
			}
			with (thisform)
			{
			    if (validate_required(towho,"请填写表白对象")==false)
			    {towho.focus();return false}
			}
			}
		</script>
	<div class="bodydiv" style="margin-top: 10px;">
		<?php
		error_reporting(E_ALL^E_WARNING^E_NOTICE);
		if ($_COOKIE["userip"]=='yes'){
			echo "<script>alert('亲，五分钟内只能表白一次哦！')</script>";
			echo "<script>window.location.href='http://www.521.igelou.com/'</script>";
		}
		?>
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading" align="center">
					<h3 class="panel-title">书写出心中的那份爱</h3>
				</div>
				<div class="panel-body">
					<form name="addForm" method="post" action="sumbit.php" onSubmit="return validate_form(this)" >
						<div class="alert alert-warning" role="alert">
							<strong>使用说明：</strong></br>
							<span class="glyphicon glyphicon-ok-sign"></span>
							昵称部分请凭个人意愿填写真实姓名或者昵称</br>
							<span class="glyphicon glyphicon-ok-sign"></span>
							表白对象建议加上对方的专业班级</br>
							<span class="glyphicon glyphicon-ok-sign"></span>
							为防止刷屏，每隔5分钟可以发布一次消息
						</div>
						
						<input name="from" value="call" style="display: none;">
						<div class="alert alert-warning">希望发表到哪个校区？<br /><br />
                           <input name="xx" type="radio" value="0" />职高 
                           <input name="xx" type="radio" value="1" />三中
                           <input name="xx" type="radio" value="2" />技校 
                           <input name="xx" type="radio" value="5" />求是 
                           <input name="xx" type="radio" value="3" />德高 
                           <input name="xx" type="radio" value="4" />一中 </div>
						<input name="realname" class="form-control" placeholder="昵称..." required="" autofocus="autofocus"></br>
						<input name="towho" class="form-control" placeholder="送给..." required="" autofocus=""></br>
						<textarea class="form-control" name="content" placeholder="留言内容（不超过140字）" rows="3" onkeyup='value=value.substr(0,140);this.nextSibling.innerHTML=value.length+"/140";'></textarea></br>
						<input  class="btn btn-primary btn-lg btn-block" TYPE="submit" name="submit" value="发布表白" />
					</form>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>