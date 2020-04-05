<?php
while(true)
{
	exec("ls /var/www/live.nfls.io/stream",$return_local);
	exec("ls /var/www/live.nfls.io/oss/stream",$return_oss);
	$new_files=array_diff($return_local,$return_oss);
	$old_files=array_diff($return_oss,$return_local);
	echo json_encode($return_local);
	//echo json_encode($new_files);
	//echo json_encode($old_files);
	foreach($old_files as $files)
	{
		exec("rm -f /var/www/live.nfls.io/oss/stream/$files");
	}
	foreach($new_files as $files)
	{
		exec("cp -f /var/www/live.nfls.io/stream/$files /var/www/live.nfls.io/oss/stream/$files");
	}
	$TEMP=$return_local[sizeof($return_local)-3];
	exec("cp -f /var/www/live.nfls.io/stream/$TEMP /var/www/live.nfls.io/oss/stream/$TEMP");
	exec("cp -f /var/www/live.nfls.io/stream/$files /var/www/live.nfls.io/oss/stream/$files");
	exec("cp -f /var/www/live.nfls.io/stream/*.m3u8 /var/www/live.nfls.io/oss/stream/");
	echo "done!";
	sleep(20);
}
?>