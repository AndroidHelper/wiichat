<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 聊天室用户注册 </title>
 </head>
 <body>
 <?php
	$id=sqlReplace(empty($_GET["id"])?"":$_GET["id"]);
	$key=sqlReplace(empty($_GET["key"])?"":$_GET["key"]);
	$bd=sqlReplace(empty($_GET["bd"])?"":$_GET["bd"]);
	$uid=sqlReplace(empty($_GET["uid"])?"":$_GET["uid"]);
	$url="?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid;
 ?>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h4"> 聊天室用户注册 </div>
		<div class="box">
			<form action="userRegDo.php<?php echo $url?>" method="post">
			<p class="red">提示：QQ和邮箱作为找回密码的依据。</p>
			<p>帐号：<input inputmode="user predictOn" name="name" type="text"/>*</p>
			<p>密码：<input inputmode="user predictOn" name="pw1" type="password"/>*</p>
			<p>密码：<input inputmode="user predictOn" name="pw2" type="password"/>*</p>
			<p>ＱＱ：<input inputmode="user predictOn" name="phone" type="text"/>*</p>
			<p>邮箱：<input inputmode="user predictOn" name="email" type="text"/>*</p>
			<p><input inputmode="user predictOn" type="submit" value="提交注册"/></p>
			</form>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>
