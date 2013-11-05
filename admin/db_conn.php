<?php
	error_reporting(0);
	require_once("../inc/function.php");
	header("content-type:text/html;charset=utf-8");
	session_start();
	ob_start();
	require_once("../inc/config.php");
	$db_connect = mysql_connect($db_host, $db_user, $db_password);
	if (!$db_connect) {
		die ('数据库连接失败');
	}
	mysql_select_db($db_name, $db_connect) or die ("没有找到数据库。");
	mysql_query("set names utf8;");
	$sql="select * from wiichat_site limit 1";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	@date_default_timezone_set($row['site_timezone']);
?>