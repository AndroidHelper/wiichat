<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 修改聊天室密码 </title>
 </head>
 <?php 
	$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
	If(empty($wiichatUser)){
		 header("location:".$serverURL."/error.php?err=143");	
		 exit();
    }
 ?>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h4"> 修改聊天室密码 </div>
		<div class="box">
			<form action="userDo.php?act=pw" method="post">
			<p>旧 密 码：<input inputmode="user predictOn" name="pw" type="password"/></p>
			<p>新 密 码：<input inputmode="user predictOn" name="pw1" type="password"/></p>
			<p>确认密码：<input inputmode="user predictOn" name="pw2" type="password"/></p>
			<p><input inputmode="user predictOn" type="submit" value="保存"/> 【<a href="userCenter.php">返回</a>】</p>
			</form>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>