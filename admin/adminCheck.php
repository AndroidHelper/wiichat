<?php
	require_once('../inc/config.php');
	if (empty($_SESSION[WiiChat_ID.'admin']))
		echo "<script type='text/javascript'>alert('登陆超时或尚未登陆');top.location.href='adminLogin.html';</script>";
?>