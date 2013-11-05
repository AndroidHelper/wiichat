<?php
	function getdirname($path=null){
		if (!empty($path)) {
			if (strpos($path,'\\')!==false) {
				return substr($path,0,strrpos($path,'\\')).'/';
			} elseif (strpos($path,'/')!==false) {
				return substr($path,0,strrpos($path,'/')).'/';
			}
		}
		return './';
	}
	define('path',substr(dirname(__FILE__),0,-3));
	error_reporting(0);
	header("content-type:text/html;charset=utf-8");
	session_start();
	ob_start();
	define('R_P',getdirname(__FILE__));
	if (!file_exists("inc/config.php")&&!file_exists("../inc/config.php")){
			header("location:install/index.php");
			exit();
		}else{
			if(file_exists("install"))
				@rename("install","__install".rand(100,999));
		}
	if(file_exists('inc/config.php'))
	{
		require_once('inc/config.php');
	}
	if(file_exists('../inc/config.php'))
	{
		require_once('../inc/config.php');
	}
	$db_connect = mysql_connect($db_host, $db_user, $db_password);
	if (!$db_connect) {
		die ('数据库连接失败');
	}
	mysql_select_db($db_name, $db_connect) or die ("没有找到数据库。");
	mysql_query("set names utf8;");

	$sqlStr="select * from wiichat_site limit 0,1";
	$result = mysql_query($sqlStr) or die ("查询失败，请检查SQL语句。");
	$row = mysql_fetch_array($result);

	if($row){
		$siteName=$row["site_name"];
		$siteLogo=$row["site_logo"];
		$siteWidth=$row["site_width"];
		$siteCount=$row["site_count"];
		$mailSMTP=$row["site_mailSMTP"];
		$mailAccount=$row["site_mailAccount"];
		$mailPassword=$row["site_mailPassword"];
		$mailAddress=$row["site_mailAddress"];
		$codecount=$row['site_code'];
		$filter=$row['site_filter'];
		$timezone=$row['site_timezone'];
		$express=$row['site_express'];
		@date_default_timezone_set($timezone);
		If($siteWidth=="0"){
			$style="container2";
		}else{
			$style="container1";
		}
		If(empty($siteCount)) 
			$siteCount=0;
		//ucenter整合用的变量
		if(file_exists('ucenter_key.php'))
		{
			require_once('ucenter_key.php');
			define('UC_CLIENT_ROOT', path.'./uc_client/');
			include_once(UC_CLIENT_ROOT.'./client.php');
		}
		if(file_exists('../ucenter_key.php'))
		{
			require_once('../ucenter_key.php');
			define('UC_CLIENT_ROOT', path.'./uc_client/');
			include_once(UC_CLIENT_ROOT.'./client.php');
		}

	}else
		echo "数据库初始化失败";
?>
