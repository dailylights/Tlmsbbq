<?php
	//开发者昵称：牵挂丶
	//开发者ＱＱ：1143099512
	//版权信息：翼创传媒工作室（www.sdyccm.cn）
	
	session_start(); 
	include ('conn.php');
	include ('inc/lang.php');
	mysql_query("set names utf8");
	$sql = 'select * from system';
	$res=mysql_query($sql);
	$row = mysql_fetch_array($res);
	$searchs = $_POST['search'];
?>
<!DOCTYPE html>
<html lang="zh_cn">
	<head>
		<title><?php echo $row['title'];?> - <?php echo $row['titlesm'];?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="style/js/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="style/css/wall_style.css" />
		<link rel="shortcut icon" href="style/img/favicon.ico" />
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
	</head>
	<body>
		<div class="bodydiv">
		<?php
			$count1=mysql_query("select count(*) from list where toname = '".$searchs."'"); //获得记录总数
			$rs=mysql_fetch_array($count1);
			$totalNumber=$rs[0];
		?>
		<div class="container-fluid">
	    <div class="jumbotron">
		    <h1>表白墙</h1>
		    <p>书写出心中的那份爱</p>
		    <p><a class="btn btn-primary btn-lg" role="button" href="call.php">我要表白</a></p>
	    </div>
	    <div class="alert alert-success" role="alert">
			<?php echo $row1['name'];?>表白墙欢迎您<br/>
			您搜索到<span class="badge"><?php echo $totalNumber ?></span>条表白内容
	    </div>
	    <div class="alert alert-info" role="alert">
	    	您搜索的表白对象：<?php echo $searchs;?>
	    	<a href="index.php">返回表白墙</a>
	    </div>
		<?php
			$result=mysql_query("select * from list where toname ='".$searchs."'order by id desc limit 99999"); //根据前面计算出开始记录和记录数
			while ($rows=mysql_fetch_array($result)) {
		?>
	    <div class="panel panel-info">
	    	<div class="panel-heading"><strong>TO：<?=$rows[toname] ?></strong>
	        <div class="shijian"><?=$rows[lastdate]?></div>
	    </div>
	    <div class="panel-body">
	      	<p>&nbsp;&nbsp;&nbsp;&nbsp;<?=$rows[content]?></p>
	        <div class="shijian2">FROM：<?=$rows[fromname] ?></div>
	    </div>
	    </div>
	    <?php
			}
		?>
		<div class="h3" align="center">
			<a style="width: 100%;" href="index.php" class="btn btn-danger">返回表白墙首页</a>
		</div>
		<div class="panel panel-default">
		<div class="panel-body">
			版权所有 &copy;&nbsp;2017 <a href="<?php echo $row['weburl'];?>"><?php echo $row['footer'];?></a><br/>
			校园客服 &copy;&nbsp;<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $row['qq'];?>" target="url"><?php echo $row['qq'];?></a></div>
		</div>
		<iframe src="" width="0px" height="0px" style="display:none;" name="url"></iframe>
		</div>
		</div>
	</body>
</html>