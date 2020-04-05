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
					<li class="nav-item">
                        <a class="nav-link" href="status.php">状态</a>
                    </li>
					<li class="nav-item active">
                        <a class="nav-link" href="history.php">弹幕<span class="sr-only">(current)</span></a>
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
			<!--Panel-->
			<div class="card">
				<div class="card-header orange white-text">
				弹幕查询
				</div>
				<div class="card-block">
					<div class="md-form" >
					<form action="history_query.php" method="post">
						<input type="text" id="form2" name="ID" class="form-control">
						<label for="form2">直播ID号</label>
						<button type="submit" class="btn btn-warning">提交</button>
						<p>提示：ID号可从计划中查询</p>
					</form>
					</div>
				</div>
			</div>
			<!--/.Panel-->
                <li>
					
                </li>
				<li>
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
	</script>

</body>

</html>
