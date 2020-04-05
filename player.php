<?php
ob_start();
Header('Access-Control-Allow-Origin:*');
include "conn.php";
								
$timenow=date("Y-m-d H:i:s"); 
$con = mysqli_connect($sql_add,$sql_user,$sql_pass,$sql_name);
mysqli_query($con,"set character set 'utf8'");
//mysqli_select_db($sql_name, $con);
$uid=$_GET['id'];
$result = mysqli_query($con,"SELECT * FROM activity where id=$uid");
if (mysqli_num_rows($result)!=1)
{
	die("ID不合法！");
}
else
{
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$code= $row['stream_code'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link href="player/video-js.min.css" rel="stylesheet">
    <link href="player/videojs-resolution-switcher.css" rel="stylesheet">
<script src="player/video.min.js"></script>
<script src="player/videojs-errors.js"></script>


  <script src="player/videojs-contrib-hls.js"></script>
  <title>NFLSIO 直播平台播放器</title>
</head>
<body>
<script src="player/videojs-resolution-switcher.js"></script>
<video id="really-cool-video" class="video-js vjs-default-skin" controls
 preload="auto" width="1280" height="720" poster=""
 data-setup='{"controls": true,"autoplay": true}'>
 <?php
 echo ' <source src="https://nflslive.oss-cn-shanghai.aliyuncs.com/stream/'.$code.'.m3u8" type="application/x-mpegURL" label="上海" />';
	echo ' <source src="https://live.nfls.io/stream/'.$code.'.m3u8" type="application/x-mpegURL" label="香港源"/>';
	
	?>
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a web browser
    that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
  </p>
</video>
<script>
  alert("如果视频卡住超过半分钟请刷新浏览器！播放途中请不要切换视频源！")
  videojs('really-cool-video').videoJsResolutionSwitcher();
</script>
<!--
	   <div id="player"></div>
	  <script>
		var player = new Clappr.Player({source: "https://live.nfls.io/mystream.m3u8", parentId: "#player",gaAccount: 'UA-83933553-2',actualLiveTime: "true"});
	  </script>
-->
</body>
</html>