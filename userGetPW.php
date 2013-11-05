<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 忘记密码 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h4"> 忘记密码 </div>
		<div class="box">
			<p>填写您的注册时提交的帐号、QQ号和邮箱</p>
			<form action="userDo.php?act=getPW" method="post">
				<p>帐号：<input inputmode="user predictOn" name="ac" type="text"/></p>
				<p>ＱＱ：<input inputmode="user predictOn" name="m" type="text"/></p>
				<p>邮箱：<input inputmode="user predictOn" name="mail" type="text"/></p>
				<p><input inputmode="user predictOn" type="submit" value="提交"/> 【<a href="userLogin.php">返回</a>】</p>
			</form>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>
