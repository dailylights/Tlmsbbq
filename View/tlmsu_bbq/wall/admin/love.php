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
	<title><?php echo $lang->admin->love;?> - <?php echo $lang->admin->title;?></title>
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
	            <li class="active"><a href="love.php"><?php echo $lang->admin->love;?></a></li>
	            <li class="dropdown"><a href="system.php"><?php echo $lang->admin->system;?></a></li>
	            <li class="dropdown"><a href="pswd.php"><?php echo $lang->admin->pswd;?></a></li>
	        </ul>
	    </div>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<p align="center" style="font-size: 24px;"><?php echo $lang->admin->school;?></p>
	</div>
	<div class="alert alert-warning" role="alert" style="text-align:left;width: 80%;">
		<table cellspacing="0" cellpadding="0" id="table2" width="100%" class="table table-striped table-bordered table-hover datatable">
			<tr>
				<th style="width:  5%;">ID</th>
				<th style="width: 10%;">昵称</th>
				<th style="width: 10%;">对象</th>
				<th style="width: 45%;">内容</th>
				<th style="width: 30%;">操作</th>
		    </tr>
		    <?php
		    	$perNumber=20; //每页显示记录数
				$page=$_GET['page']; //获得当前页面值
				$count1=mysql_query("select * from list order by Id desc limit 99999"); //获得记录总数
				$rs=mysql_fetch_array($count1);
				$totalNumber=$rs[0];
		    ?>
		    <?php
		    	$totalPage=ceil($totalNumber/$perNumber);
				if (!isset($page)) {
				 $page=1;
				}
				mysql_select_db($dbname, $connect);
				mysql_query("set names utf8");
				$startCount=($page-1)*$perNumber;
				$result=mysql_query("select * from list order by Id desc limit $startCount,$perNumber"); //根据前面计算出开始记录和记录数
				while ($rows=mysql_fetch_array($result)) 
				{
		    ?>
	        <tr>
		        <td style="width:  5%;"><?=$rows['Id']?></td>
		        <td style="width: 10%;"><?= $rows['fromname'] ?></td>
		        <td style="width: 10%;"><?=$rows['toname']?></td>
		        <td style="width: 45%;"><?=$rows['content']?></td>
		        <td style="width: 30%;">
		        	<a href="relove.php?id=<?=$rows['Id']?>" class="btn btn-danger" style="height: 26px;font-size: 12px;">修改</a> 
		        	<a href="del.php?from=love&id=<?=$rows['Id']?>" class="btn btn-danger" style="height: 26px;font-size: 12px;">删除</a>
		        </td>
	        </tr>
	    	<?php
	   		}
	    	?>
    	</table>
    <ul class="pager">
	    <li class="previous"><a href="love.php?page=<?php echo $page - 1;?>" style="color: #8a6d3b;margin-left: 5%;"><- 上一页</a></li>
	  	<a class="btn btn-danger">页数：<?php echo $page ?>/<?php echo $totalPage ?></a>
	    <li class="next"><a href="love.php?page=<?php echo $page + 1;?>" style="color: #8a6d3b;margin-right: 5%;">下一页  -></a></li>
	</ul>
	</div>
	<div class="footer navbar-inverse">
		<p><?php echo $lang->admin->footer;?></p>
	</div>
</div>
</body>
</html>