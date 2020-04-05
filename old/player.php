<!DOCTYPE html>
<html lang="en">

<head>
	<!--
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">
	-->
	<link href="player/video-js.min.css" rel="stylesheet">
	<script src="player/video.min.js"></script>
	<script src="player/videojs-errors.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>NFLSIO Live Center 直播中心</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

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
		
		#div-video-wrapper {
			position: relative;
			background-color: #000;
			border-radius: 5px;
			box-shadow: 0 0 20px rgba(50, 50, 50, 0.95);
			border: 2px #ccc solid;
			margin-left: auto;
			margin-right: auto;
			margin-top: 20px;
			width: 640px;
			height: 360px;
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
                        <a class="nav-link" href="#">首页<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">计划</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">日志</a>
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
                <div id="div-video-wrapper">
					<video id="video-content" class="video-js vjs-default-skin vjs-big-play-centered"
						   controls poster="" preload="auto" data-setup='{"controls": true,"autoplay": true}'>
						<source src="https://live.nfls.io/mystream.m3u8" type="application/x-mpegURL">
					</video>
				</div>
            </ul>
        </div>
    </div>
    <!--/.Mask-->

   


    <!-- SCRIPTS -->
	<script type="text/javascript">
	myView.myVideoPlayer = videojs(myConstants.multiMedia.DOM_VIDEO).ready(function () {
	  var myPlayer = this;

	  // Responsive
	  var aspectRatio = 9/16; // AR 16:9
	  function resizeVideoJs(){
		  // Get the parent element's actual width
		  var width = document.getElementById(myPlayer.id()).parentElement.offsetWidth;
		  // Set my width to fill parent element, set my calculated height
		  myPlayer.width(width).height( width * aspectRatio );
	  }
	  resizeVideoJs(); // Initialize the function right now
	  window.onresize = resizeVideoJs; // Call the function on resize
	}
	</script>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>

</html>