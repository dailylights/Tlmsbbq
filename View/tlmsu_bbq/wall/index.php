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
?>
<!DOCTYPE html>
<html lang="zh_cn">
	<head>
		<title><?php echo $row['title'];?> - <?php echo $row['titlesm'];?></title>
		<meta name="keywords" content="<?php echo $row['keywords'];?>">
		<meta name="description" content="<?php echo $row['description'];?>">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="style/js/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="style/css/wall_style.css" />
		<link rel="shortcut icon" href="style/img/favicon.ico" />
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">


<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="lib/quietflow.min.js"></script>
<script type="text/javascript" src="demo/js/index.js"></script>
<script type="text/javascript" src="demo/js/prism.js"></script>



		

	</head>
	<body id="Wrapper">
		
		<div class="bodydiv" >
		<?php
			$perNumber=15; //每页显示记录数
			$page=$_GET['page']; //获得当前页面值
			$count1=mysql_query("select count(*) from list"); //获得记录总数
			$rs=mysql_fetch_array($count1);
			$totalNumber=$rs[0];
		?>
		<div class="container-fluid">
	    <div class="jumbotron">
		    <h1>表白墙</h1>
		    <p>想念的人想说的话写下来吧</p>
		    <p><a class="btn btn-primary btn-lg" role="button" href="call.php">我要表白</a></p>
	    </div>

	    <div class="alert alert-success" role="alert">
			 <?php echo $row['school'];?>表白墙欢迎您<br/>
			 已经有<span class="badge"><?php echo $totalNumber ?></span>条表白被发布
			
	    </div>
	    <div class="alert alert-info" role="alert">
		    <div class="clearfix">
		        <form method="post" action="search.php" name="search">
			        <div class="col-lg-6">
			            <div class="input-group">
				            <input type="text" class="form-control" placeholder="填写要搜索的表白对象..." name="search" />
				            <span class="input-group-btn">
				                <button class="btn btn-default" type="submit" value="Search">搜索</button>
				            </span>
			            </div>
			    	</div>
		        </form>
		    </div>
	    </div>
		<?php
			$totalPage=ceil($totalNumber/$perNumber);
			if (!isset($page)) {
			 $page=1;
			}
			$startCount=($page-1)*$perNumber;
			$result=mysql_query("select * from list order by id desc limit $startCount,$perNumber"); //根据前面计算出开始记录和记录数
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
	    <div class="clearfix shijian2">
	    	页数：<?php echo $page ?>/<?php echo $totalPage ?></div>
		    <ul class="pagination  pagination-lg">
			    <li><a href="index.php?page=1">首页</a></li>
			    <?php
				if ($page != 1) {
				?>
			    <li><a href="index.php?page=<?php echo $page - 1;?>">上页</a></li>
			    	<?php
						}
						$fen=5;
						$zong=ceil($page/$fen);
						$szong=($zong-1)*5;
						for ($i=$szong+1;$i<=$szong+1;$i++) {  //循环显示出页面
					?>
			    <li><a class="pagination-a" href="index.php?page=<?php echo $page;?>"><?php echo $page ;?></a></li>
			    	<?php
						}
						if ($page<$totalPage) { //page小于总页数,显示下页链接
					?>
			    <li><a href="index.php?page=<?php echo $page + 1;?>">下页</a></li>
			    	<?php
					}
					?>
			    <li><a href="index.php?page=<?php echo $totalPage;?>">尾页</a></li>
			</ul>

		<div class="h3"></div>
		<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=450 src="//music.163.com/outchain/player?type=0&id=616904413&auto=0&height=430"></iframe>
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