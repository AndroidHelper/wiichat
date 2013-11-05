<?php
	require_once('inc/config.php');
	$acceptHeader=$_SERVER['HTTP_ACCEPT'];
	if (strpos($acceptHeader,"application/vnd.wap.xhtml+xml")>-1)
		$header="application/vnd.wap.xhtml+xml";
	elseif (strpos($acceptHeader,"application/xhtml+xml")>-1)
		$header="application/xhtml+xml";
	elseif (strpos($acceptHeader,"text/html")>-1)
		$header="text/html";
	elseif (strpos($acceptHeader,"text/vnd.wap.wml")>-1) {
		Header("Location:".$serverURL."/wmlInfo.wml");
		exit;
	}
	else
		$header="text/html";
?>