

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdn.bootcss.com/materialize/0.97.8/css/materialize.min.css">
	  <title>弹幕查询</title>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		  <style type="text/css">
		  body
		  {
			background-color:black;
			width:1000px;
		  }
		  table
		  {
			  background-color:black;
			  color:white;
		  }
  </style>
</head>
<body>
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/materialize/0.97.8/js/materialize.min.js"></script>
		<br />
		<div class="row" style="width:90%">
        <div class="col s12">
          <div class="card purple darken-4 ">
            <div class="card-content white-text" id="info_box">
              <span class="card-title">历史弹幕查询</span>
              <p id="act_info">此处显示了所有支持弹幕的直播活动的历史记录。<br /></p>
			  <br />
			  <div class="card-action">
				<a class="waves-effect indigo accent-1 btn" onclick="javascript:history.go(-1);">返回</a>
			  </div>
            </div>
          </div>
        </div>
		
		<div class="col s12" >
          <div class="card red darken-4 ">
            <div class="card-content white-text" id="status_box">
              <span id="info_title" class="card-title">正在获取数据中，请稍后！如果弹幕较多，可能需要一定的时间加载。</span>
			  <p id="info"></p>
            </div>
          </div>
        </div>
      
		<table class="striped" id="cmdata">
		<thead>
			<tr>
                <th data-field="id">ID</th>
				<th data-field="user_hash">用户码</th>
				<th data-filed="type">弹幕类型</th>
				<th data-field="font_size">字号</th>
				<th data-field="font_colour">颜色</th>
				<th data-field="price">发送时间</th>
                <th data-field="name">内容</th>
				
            </tr>
		</thead>
		<tbody>
		</tbody>
		</div>
		<script>
		<?php
			if(!isset($_POST['ID']))
				echo "var info_detail = document.getElementById('info');\ninfo_detail.innerHTML='参数错误！';\n";
			else echo "var act_id=".$_POST['ID'].";\n";
		?>
			function loadtabledata()
			{
				$.ajax({
					type: "POST",
					url: "https://app.nfls.io/API/Chat/GetCommentListByActivityID.php",
					data:{
						id : act_id,
					},
					datatype:"json",
					success: function(message)
					{
						var json_mes=$.parseJSON(message);
						if (json_mes.status=="failed")
						{
							 var info_detail = document.getElementById('info');
							 info_detail.innerHTML="获取数据错误！请检查活动ID是否有效！";
							 loadactivitydetail(false);
						}
						else
						{
							//alert(json_mes.details);
							$.each(json_mes.details,function(i,mes){
							
							var newline=cmdata.insertRow();
							//
							var column1=newline.insertCell();
							column1.innerHTML=i;
							
							var column_user_hash=newline.insertCell();
							column_user_hash.innerHTML=mes.user_hash.slice(-6);
							
							var column_comments_type=newline.insertCell();
							column_comments_type.innerHTML=GetTextType(mes.comments_type);
							
							var column_font_size=newline.insertCell();
							column_font_size.innerHTML=mes.font_size;
							
							var column_font_colour=newline.insertCell();
							column_font_colour.innerHTML=mes.font_colour;
							column_font_colour.style.color=mes.font_colour;
							
							var column3=newline.insertCell();
							column3.innerHTML=mes.send_time;
							
							var column2=newline.insertCell();
							column2.innerHTML=mes.text;
							});
							loadactivitydetail(true);
						}
						
						
					},
					error: function()
					{
						var info_detail = document.getElementById('info');
						info_detail.innerHTML="网络错误，请稍后再试。";
					}
				});
			}
			function loadactivitydetail(suc)
			{
				$.ajax({
					type: "POST",
					data:{
						id : act_id,
					},
					datatype:"json",
					url: "https://app.nfls.io/API/Live/GetLiveDetailByID.php",
					success: function(message)
					{
						var json_mes=$.parseJSON(message);
						if (json_mes.status=="failed")
						{
							var info_detail = document.getElementById('info');
							info_detail.innerHTML="获取数据错误！请检查活动ID是否有效！";
						}
						else
						{
							var info = document.getElementById('act_info');
							info.innerHTML=info.innerHTML + "<br />活动名称：" + json_mes.name + "<br/>开始时间："+json_mes.start_time+ "<br/>结束时间："+json_mes.end_time;
							if (suc)
								$('#status_box').hide();
						}
						
					},
					error: function()
					{
						var info_detail = document.getElementById('info');
						info_detail.innerHTML="网络错误，请稍后再试。";
					}
				});
			}
			function GetTextType(number)
			{
				if(number==1)
					return "右至左滚动";
				if(number==4)
					return "底部固定";
				if(number==5)
					return "顶部固定";
				if(number==7)
					return "高级弹幕";
				if(number==8)
					return "脚本弹幕";
				if(number==6)
					return "左至右滚动";
			}
			window.onload=loadtabledata();
		</script>

</body>
</html>


	