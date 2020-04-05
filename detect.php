<?php
function slove_ls($input)
{
	$result=array();
	$i=0;
	foreach($input as $row)
	{
		//echo serialize($row);
		//echo "\n";
		if((strpos($row,"M")>0 || strpos($row,"K")>0)&& strpos($row,".ts")>0)
		{
			if(strpos($row,"M")>0)
				$pos_blank=strpos($row,"M")+1;
			else if (strpos($row,"K")>0)
				$pos_blank=strpos($row,"K")+1;
			
			
			//echo $pos_blank;
			//echo "\n";
			$size=substr($row,0,$pos_blank);
			$name=substr($row,$pos_blank+1);
			$result[$name]=$size;
		}
	}
	return $result;
}
function microtime_float()
{
list($usec, $sec) = explode(" ", microtime());
return ((float)$usec + (float)$sec);
}
$i=0;
$interval=3;
$anti=true;
while(true)
{
	$i++;
	$status=array();
	
	echo "当前时间：".date('y-m-d h:i:s',time())."    第 ".$i."次循环执行\n";
	$status['starttime']=date('y-m-d h:i:s',time());
	$status['id']=$i;
	$starttime = microtime_float();
	//exec("rm /var/www/live.nfls.io/backup/*.m3u8");
	exec("cp -f /var/www/live.nfls.io/stream/*.m3u8 /var/www/live.nfls.io/backup/");
	exec("ls -sh /var/www/live.nfls.io/stream",$return_local);
	exec("ls -sh /var/www/live.nfls.io/oss/stream",$return_oss);
	$arr_local=slove_ls($return_local);
	$arr_oss=slove_ls($return_oss);
	//echo serialize($arr_local);	
	if(!empty($arr_local))
	{
		echo "直播进行中！正在同步文件。\n";
		$new_files=array_diff_assoc($arr_local,$arr_oss);
		$old_files=array_diff_assoc($arr_oss,$arr_local);
		echo "新增文件：".json_encode($new_files)."\n";
		echo "旧文件：".json_encode($old_files)."\n";
		foreach($old_files as $files => $size)
		{
			exec("rm -f /var/www/live.nfls.io/oss/stream/$files");
		}
		foreach($new_files as $files => $size)
		{
			exec("cp -f /var/www/live.nfls.io/stream/$files /var/www/live.nfls.io/oss/stream/$files");
		}
/*
		if($anti)
		{
			exec("cp -f /var/www/live.nfls.io/stream/*.m3u8 /var/www/live.nfls.io/oss/stream/");
			$anti=false;
		}
		{
			exec("cp -f /var/www/live.nfls.io/stream/*.m3u8 /var/www/live.nfls.io/oss/stream/");
			$anti=true;
		}*/
		exec("cp -f /var/www/live.nfls.io/backup/*.m3u8 /var/www/live.nfls.io/oss/stream/");
			
		$runtime = number_format((microtime_float() - $starttime), 4).'s';
		$status['status']="working";
		$status['runtime']=number_format((microtime_float() - $starttime), 4);
		echo "循环结束！执行时间：$runtime\n";
		sleep($interval);
	}
	else
	{
		echo "直播已停止！\n";
		if(!empty($arr_oss))
			exec("rm -f /var/www/live.nfls.io/oss/stream/*.*");
		$runtime = number_format((microtime_float() - $starttime), 4).'s';
		$status['status']="sleeping";
		$status['runtime']=number_format((microtime_float() - $starttime), 4);
		echo "循环结束！执行时间：$runtime\n";
		sleep(30);
	}
	file_put_contents("status.json",json_encode($status));
	unset($status);
	unset($return_local);
	unset($return_oss);
	unset($arr_local);
	unset($arr_oss);
	unset($new_files);
	unset($old_files);
	
}
	
	
	
?>
