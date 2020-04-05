<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>NFLSIO Live Center 直播中心</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <style rel="stylesheet">
        /* TEMPLATE STYLES */
        
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
        
        .navbar {
            background-color: transparent;
        }
        
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        
        .top-nav-collapse {
            background-color: #1C2331;
        }
        
        footer.page-footer {
            background-color: #1C2331;
            margin-top: -1px;
        }
        
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }
        /*Call to action*/
        
        .flex-center {
            color: #fff;
        }
        
        .view {
            background: url("https://nfls.io/background1.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
		
		.list-group-bg {
			background-color:rgba(0,0,0,0.2);
		}
		/*
		.list-group-item-heading {
			color: #FFFFFF;
		}
		
		.list-group-item-text {
			color: #FFFFFF;
		}
		
		.list-group-item-info{
			occupy:0.2;
		}
		*/
    </style>

</head>

<body>


    <!--Navbar-->
    <nav class="navbar navbar-dark navbar-fixed-top scrolling-navbar">

        <!-- Collapse button-->
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
            <i class="fa fa-bars"></i>
        </button>

        <div class="container">

            <!--Collapse content-->
            <div class="collapse navbar-toggleable-xs" id="collapseEx">
                <!--Navbar Brand-->
                <a class="navbar-brand" href="https://live.nfls.io/test" target="_blank">NFLSIO Live Center</a>
                <!--Links-->
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">首页</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="plan.php">计划<span class="sr-only">(current)</span></a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="status.php">状态</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="history.php">弹幕</a>
                    </li>
                </ul>
                <!--Search form
                <form class="form-inline">
                    <input class="form-control" type="text" placeholder="Search">
                </form>
				-->
            </div>
            <!--/.Collapse content-->

        </div>

    </nav>
    <!--/.Navbar-->

	
	<!--Mask-->
	<div class="view hm-black-strong">
    <div class="full-bg-img flex-center">
	<ul class="animated fadeInUp">
	<li><h1 class="h1-responsive">计划</h1></li>
	<li>
                    <p style="width:90%;margin-left:auto;margin-right:auto;">本页可查询本站的所有直播计划，部分直播项目带有回放链接，可以进行回放查询。<br />其余校内录制（非直播）项目，请检阅Video Center视频中心上的列表</p>
					<a href="https://video.nfls.io" class="btn btn-primary">Video Center视频中心</a>
                </li>
				<li>
	<div class="btn-group">
	
	<a href="#current" class="btn btn-success">正在进行的活动</a><br /><br />
	<a href="#next" class="btn btn-info">尚未开始的活动</a><br /><br />
	<a href="#pass" class="btn btn-warning">已经结束的活动</a><br /><br />
	
	
	</div>
	</li>
	</div>
	</div>
	</ul>
	<footer class="page-footer">
	<div class="list-group" style="width:90%;margin-left:auto;margin-right:auto;overflow:auto;height:auto">
	<br /><br />
		
							<?php
								include "conn.php";
								
								$timenow=date("Y-m-d H:i:s"); 
								$con = mysqli_connect($sql_add,$sql_user,$sql_pass,$sql_name);
								mysqli_query($con,"set character set 'utf8'");
								//mysqli_select_db($sql_name, $con);
								$result = mysqli_query($con,"SELECT * FROM activity ORDER BY start");
								$pass=0;
								$current=0;
								$next=0;
								
								
								while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
								{
									if (strtotime($timenow)>strtotime($row['start']) && strtotime($timenow)<strtotime($row['end']))
									{
										$array_current[$current]['id']=$row['id'];
										$array_current[$current]['name']=$row['name'];
										$array_current[$current]['start']=$row['start'];
										$array_current[$current]['end']=$row['end'];
										$current++;
										
									}
									else if (strtotime($timenow)<strtotime($row['start']))
									{
										$array_next[$next]['id']=$row['id'];
										$array_next[$next]['name']=$row['name'];
										$array_next[$next]['start']=$row['start'];
										$array_next[$next]['end']=$row['end'];
										$next++;
									}
									else if (strtotime($timenow)>strtotime($row['end']))	
									{
										$array_pass[$pass]['id']=$row['id'];
										$array_pass[$pass]['name']=$row['name'];
										$array_pass[$pass]['start']=$row['start'];
										$array_pass[$pass]['end']=$row['end'];
										$array_pass[$pass]['replay_url']=$row['replay_url'];
										$pass++;
									}
									
								}
								
								echo '<a href="#current" id="current" class="list-group-item active list-group-item-success" >正在进行的活动</a>';
								echo '<div class="list-group list-group-bg">';
								if($current==0)
								{
									echo '<a class="list-group-item list-group-bg disabled">无</a>';
								}
								else
								{
									for($i=0;$i<=$current-1;$i++)
									{
										echo '<a class="list-group-item list-group-bg">';
										echo '<h4 class="list-group-item-heading">'.$array_current[$i]['name'].' [LID'.$array_current[$i]['id'].']</h4>';
										echo '<p class="list-group-item-text">从：'.$array_current[$i]['start'].'<br />到：'.$array_current[$i]['end'].'</p>';
										echo '</a>';
									}
								}
								
								echo '<a href="#next" id="next" class="list-group-item list-group-item-info active">尚未开始的活动</a>';
								echo '<div class="list-group list-group-bg">';
								//echo '<a href="#" class="list-group-item">';
								
								if($next==0)
								{
									echo '<a class="list-group-item list-group-bg">无</a>';
								}
								else
								{
									for($i=0;$i<=$next-1;$i++)
									{
										echo '<a class="list-group-item list-group-bg list-group-bg">';
										echo '<h4 class="list-group-item-heading">'.$array_next[$i]['name'].' [LID'.$array_next[$i]['id'].']</h4>';
										echo '<p class="list-group-item-text">从：'.$array_next[$i]['start'].'<br />到：'.$array_next[$i]['end'].'</p>';
										echo '</a>';
									}
										
									
										//echo '<a class="list-group-item list-group-item-info">'.date("m月d日",strtotime($array_next[$i]['time']))." ".$array_next[$i]['name'].'</a>';
								}
								echo '</div>';
								echo '<a href="#pass" id="pass" class="list-group-item active list-group-item-warning">已经结束的活动</a>';
								if($pass==0)
								{
									echo '<a class="list-group-item list-group-bgdisabled">无</a>';
								}
								else
								{
									for($i=0;$i<=$pass-1;$i++)
									{
										echo '<a class="list-group-item list-group-bg">';
										echo '<h4 class="list-group-item-heading">'.$array_pass[$i]['name'].' [LID'.$array_pass[$i]['id'].']</h4>';
										echo '<p class="list-group-item-text">从：'.$array_pass[$i]['start'].'<br />到：'.$array_pass[$i]['end'];
										if(empty($array_pass[$i]['replay_url']))
										{
											echo '</p>';
										}
										else
										{
											$adress=json_decode($array_pass[$i]['replay_url'],true);
											if($adress['type']="bilibili")
												echo '<br /><div onclick="javascript:window.location.href=\'http://www.bilibili.com/video/'.$adress['id'].'\';">'.'回放地址：bilibili-'.$adress['id'].'</div></p>';
										}
										
										echo '</a>';
									}
								}
							?>
							<br /><br />
				<!--<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
				<a href="#" class="list-group-item">Morbi leo risus</a>
				<a href="#" class="list-group-item">Porta ac consectetur ac</a>
				<a href="#" class="list-group-item">Vestibulum at eros</a> -->
			</div>
	</div>


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
	<script>
	</script>

</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82277812-7', 'auto');
  ga('send', 'pageview');

</script>
</html>
