

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

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
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
		<div class="row" style="width:90%">
        <div class="col s12">
          <div class="card purple darken-4 ">
            <div class="card-content white-text" id="info_box">
              <span class="card-title">历史弹幕查询</span>
              <p>这里显示了所有支持弹幕的直播活动的历史记录。</p>
            </div>
          </div>
        </div>
		
		<div class="col s12" >
          <div class="card purple darken-4 ">
            <div class="card-content white-text" id="status_box">
              <span class="card-title">正在获取数据中，请稍后！</span>
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
			if(!isset($_GET['ID']))
				echo "alert('参数错误！');\n";
			else echo "var act_id=".$_GET['ID'].";\n";
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
							 $ ("#status_box").html = ($ ("#status_box").html () + "<p>获取弹幕列表错误！请检查活动是否有效！</p>");
						}
						else
						{
							alert(json_mes.details);
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
							loadactivitydetail();
						}
						
					},
					error: function()
					{
						alert("加载错误！");
					}
				});
			}
			function loadactivitydetail()
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
							 $ ("#status_box").html = ($ ("#status_box").html () + "<p>获取活动信息错误！请检查活动是否有效！</p>");
						}
						else
						{
							$ ("#status_box").hide();
							alert(json_mes.name);
						}
						
					},
					error: function()
					{
						alert("加载错误！");
					}
				});
			}
			function GetTextType(number)
			{
				if(number==1)
					return "普通弹幕";
			}
			window.onload=loadtabledata();
		</script>

</body>
</html>


	