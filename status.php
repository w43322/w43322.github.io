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
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">

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
        /*Call to action
        
        .flex-center {
            color: #fff;
        }
        */
        .view {
            background: url("https://nfls.io/background1.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
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
                    <li class="nav-item">
                        <a class="nav-link" href="plan.php">计划</a>
                    </li>
					<li class="nav-item active">
                        <a class="nav-link" href="status.php">状态<span class="sr-only">(current)</span></a>
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
        <div class="full-bg-img  flex-center">
            <ul class="animated fadeInUp">
                <li>
					<div class="card" align="left">
						<h3 class="card-header success-color white-text">香港数据中心（视频源）</h3>
						<div class="card-block">
						<?php
							$status_raw=file_get_contents("status.json");
							$status=json_decode($status_raw,true);
							if($status['status']=="working")
								echo '<h4 class="card-title">直播状态：正在直播中</h4>';
							else
								echo '<h4 class="card-title">直播状态：直播已停止</h4>';
						?>
			
							<p class="card-text">直播分辨率：1080p</p>
							<br />
							<h4 class="card-title">同步脚本状态</h4>
						<?php
							echo '<p class="card-text">循环次数：第 '.$status['id'].'次</p>';
							echo '<p class="card-text">最近一次运行时间：'.$status['starttime'].'</p>';
							echo '<p class="card-text">执行时间：'.$status['runtime'].'</p>';
						?>
							
							
							
							<!--<a class="btn btn-primary">Go somewhere</a>-->
						</div>
					</div>
                </li>
				<li>
					<!--Panel-->
					<div class="card" align="left">
						<h3 class="card-header primary-color white-text">上海分发服务器</h3>
						<div class="card-block">
							<h4 class="card-title">状态：运行正常</h4>
							<!--<a class="btn btn-primary">Go somewhere</a>-->
						</div>
					</div>
					<!--/.Panel-->
				</li>
            </ul>
        </div>
    </div>
	<div id="selected_item" style="display:none">-1</div>
    <!--/.Mask-->

   


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
		function select_item(data)
		{
			document.getElementById("select_id").innerHTML=document.getElementById("item_"+data).innerHTML;
			document.getElementById("selected_item").innerHTML=data;
		}		
		function submit_item()
		{
			data=document.getElementById("selected_item").innerHTML;
			if(data==-1)
			{
				$('#select_id').tooltip('show');
				setTimeout(function () { 
					$('#select_id').tooltip('hide');
				}, 3000);
			}	 
			else
			{
				window.open("player.php?id="+data);
			}						
		}
		// Tooltips Initialization
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>

</body>

</html>
