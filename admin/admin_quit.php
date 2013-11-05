<?php
	require_once("db_conn.php");
	$_SESSION[WiiChat_ID."admin"]="";
	echo "<script language='javascript'>top.location.href='adminLogin.html';</script>";
	exit();
?>