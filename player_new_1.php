

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdn.bootcss.com/materialize/0.97.8/css/materialize.min.css">
	  <title>在线观看 - live.nfls.io</title>
      <!--Let browser know website is optimized for mobile-->
	  <link href="player/video-js.min.css" rel="stylesheet">
      <link href="player/videojs-resolution-switcher.css" rel="stylesheet">
	  <script src="player/video.min.js"></script>
	  <script src="player/videojs-errors.js"></script>
	  <script src="player/videojs-contrib-hls.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		  <style type="text/css">
		  body
		  {
			width:80%;
			min-width:1080px;
			margin:0px auto;
			margin-left:auto; margin-right:auto;
		  }
		  table
		  {
		  }
  </style>
</head>
<body>
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/materialize/0.97.8/js/materialize.min.js"></script>
		<script src="player/videojs-resolution-switcher.js"></script>
		<br />
		<div class="row">
        <div class="col s12">
          <div class="card orange darken-4 ">
            <div class="card-content white-text" id="info_box">
              <span class="card-title">NFLSIO直播在线播放器</span>
              <p id="act_info"></p>
			  <br />
			  <div class="card-action">
				<a class="waves-effect orange accent-1 btn" onclick="javascript:history.go(-1);">返回</a>
			  </div>
            </div>
          </div>
        </div>
		<div class="col s12" style="margin:0px auto;margin-left:auto; margin-right:auto;">
			<video id="really-cool-video" class="video-js vjs-fluid" controls
			 preload="auto" width="1080px" height="608px" poster=""
			 data-setup='{"controls": true,"autoplay": true}'>
			 <?php
				include "conn.php";
								
				$timenow=date("Y-m-d H:i:s"); 
				$con = mysqli_connect($sql_add,$sql_user,$sql_pass,$sql_name);
				mysqli_query($con,"set character set 'utf8'");
				//mysqli_select_db($sql_name, $con);
				$uid=$_GET['ID'];
				$result = mysqli_query($con,"SELECT * FROM activity where id=$uid");
				if (mysqli_num_rows($result)!=1)
				{
					$warning="ID";
				}
				else
				{
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$code= $row['stream_code'];
					echo ' <source src="https://nflslive.oss-cn-shanghai.aliyuncs.com/stream/'.$code.'.m3u8" type="application/x-mpegURL" label="上海" />';
					echo ' <source src="https://live.nfls.io/stream/'.$code.'.m3u8" type="application/x-mpegURL" label="香港源"/>';
				}
				?>
			  <p class="vjs-no-js">
				To view this video please enable JavaScript, and consider upgrading to a web browser
				that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
			  </p>
			</video>
		</div>
		<div>
		<form class="col s12">
		  <div class="row">
			<div class="input-field col s11">
			  <input id="comment_text" name="comment_text" type="text"></input>
			  <label for="comment_text">发射弹幕吧！（测试中）</label>
		    </div>
			<div class="col s1">
			<button class="btn waves-effect btn-large waves-light orange" type="button" name="action" onclick="javascript:post_danmu();"><i class="material-icons right">send</i>
		    </button>
			</div>
		  </div>
		</form>
		</div>
		<table class="striped" id="cmdata">
			<thead>
				<tr>
					<th data-field="id">ID</th>
					<th data-field="user_hash">分段文件名</th>
					<th data-field="user_hash">时间</th>
					<th data-field="name">内容</th>
					
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		</div>
		<script>
		<?php
			if(!isset($_GET['ID']))
				echo "var info_detail = document.getElementById('act_info');\ninfo_detail.innerHTML='参数错误！';\n";
			else echo "var act_id=".$_GET['ID'].";\n";
			if(isset($warning))
				if ($warning="ID")
					echo "var info_detail = document.getElementById('act_info');\ninfo_detail.innerHTML='参数错误！';\n";
		?>
		videojs('really-cool-video').videoJsResolutionSwitcher();
			function loadactivitydetail()
			{
				$.ajax({
					type: "POST",
					data:{
						id : act_id,
						check_valid : true,
					},
					datatype:"json",
					url: "https://app.nfls.io/API/Live/GetLiveDetailByID.php",
					success: function(message)
					{
						var json_mes=$.parseJSON(message);
						if (json_mes.status=="failed")
						{
							var info_detail = document.getElementById('act_info');
							if (json_mes.error == "Time is not suitable")
								info_detail.innerHTML="活动时间不正确！请检查活动ID是否有效！";
							else info_detail.innerHTML="获取数据错误！请检查活动ID是否有效！";
						}
						else
						{
							var info = document.getElementById('act_info');
							info.innerHTML=info.innerHTML + "<br />活动名称：" + json_mes.name + "<br/>开始时间："+json_mes.start_time+ "<br/>结束时间："+json_mes.end_time;
						}
						
					},
					error: function()
					{
						var info_detail = document.getElementById('info');
						info_detail.innerHTML="网络错误，请稍后再试。";
					}
				});
			}
			function post_danmu()
			{
				if(document.getElementById("comment_text").value=="")
					alert("弹幕为空！");
				else{
					var Danmu = new Object(); 
					Danmu.user_id="-1";
					Danmu.text=document.getElementById("comment_text").value;
					Danmu.time="1.00000";
					Danmu.filename="test-1.m3u8";
					Danmu.unix_timestamp=Date.parse(new Date());
					//alert(document.getElementById("comment_text").value);
					var finalDanmu = JSON.stringify(Danmu);	
					$.ajax({
						type: "POST",
						data:{
							ID : act_id,
							detail : finalDanmu,
						},
						datatype:"json",
						url: "https://app.nfls.io/API/Chat/PostNormalComment.php",
						success: function(message)
						{
							message=$.parseJSON(message);
							if(message.status=="sucess")
							{
								alert("发送成功！");
								document.getElementById("comment_text").value=="";
							}
							else
							{
								alert("发送失败！");
							}
							
						},
						error: function()
						{
							alert("发送失败！");
						}
					});
				}
				
			}
			window.onload=loadactivitydetail();
		</script>

</body>
</html>


	