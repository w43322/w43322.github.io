
<?php
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $fp = fopen("text.txt",'a+');
    fwrite($fp,'1');
    fclose($fp);
?>
