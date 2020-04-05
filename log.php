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
            background: url("https://home.nfls.io/background1.jpg")no-repeat center center fixed;
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">首页<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plan.php">计划</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="log.php">日志</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="status.php">状态</a>
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
                <li>
                    <h1 class="h1-responsive">NFLSIO Live Center</h1></li>
                <li>
                    <p>NFLSIO 直播中心</p>
                </li>
                <li>
                    <!--<a target="_blank" href="http://mdbootstrap.com/getting-started/" class="btn btn-primary btn-lg">Sign up!</a>-->
					<div class="btn-group">
						<button type="button" class="btn btn-danger" id="select_id" data-toggle="tooltip" data-placement="top" title="请先选择一个直播内容">请选择观看内容</button>
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>

						<div class="dropdown-menu">
						
						<h6 class="dropdown-header">仅显示6个月内的活动</h6>
						<h6 class="dropdown-header">超出范围请从“计划”栏查询</h6>
						<h6 class="dropdown-header">           </h6>
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
										$array_current[$current]['time']=$row['start'];
										$current++;
										
									}
									else if (strtotime($timenow)<strtotime($row['start']))
									{
										$array_next[$next]['id']=$row['id'];
										$array_next[$next]['name']=$row['name'];
										$array_next[$next]['time']=$row['start'];
										$next++;
									}
									else if (strtotime($timenow)>strtotime($row['end']))	
									{
										$array_pass[$pass]['id']=$row['id'];
										$array_pass[$pass]['name']=$row['name'];
										$array_pass[$pass]['time']=$row['start'];
										$pass++;
									}
									
								}
								
								echo '<h6 class="dropdown-header">可选择内容</h6>';
								if($current==0)
								{
									echo '<a class="dropdown-item disabled">无</a>';
								}
								else
								{
									for($i=0;$i<=$current-1;$i++)
										echo '<a class="dropdown-item" onclick="javascript:select_item(\''.$array_current[$i]['id'].'\');" id="item_'.$array_current[$i]['id'].'">'.date("m月d日",strtotime($array_current[$i]['time']))." ".$array_current[$i]['name'].'</a>';
								}
								
								echo '<h6 class="dropdown-header">未开始内容</h6>';
								if($next==0)
								{
									echo '<a class="dropdown-item disabled">无</a>';
								}
								else
								{
									for($i=0;$i<=$next-1;$i++)
										echo '<a class="dropdown-item disabled" id="item_'.$array_next[$i]['id'].'">'.date("m月d日",strtotime($array_next[$i]['time']))." ".$array_next[$i]['name'].'</a>';
								}
								
								echo '<h6 class="dropdown-header">已结束内容</h6>';
								if($pass==0)
								{
									echo '<a class="dropdown-item disabled">无</a>';
								}
								else
								{
									for($i=0;$i<=$pass-1;$i++)
										echo '<a class="dropdown-item disabled" id="item_'.$array_pass[$i]['id'].'">'.date("m月d日",strtotime($array_pass[$i]['time']))." ".$array_pass[$i]['name'].'</a>';
								}
							?>
							
						</div>
					</div>
                </li>
				<li>
					<?php
						session_start();
						if(!isset($_SESSION['TOKEN']))
							echo '<a target="_blank" onclick="javascript:submit_item();" class="btn btn-primary btn-lg">访客观看</a><a target="_blank" href="https://login.nfls.io/?url=live&reason=notlogin" class="btn btn-secondary btn-lg">登录账户</a>';
						else
							echo '<a target="_blank" onclick="javascript:submit_item();" class="btn btn-primary btn-lg">进入播放器</a>';
						?>
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
