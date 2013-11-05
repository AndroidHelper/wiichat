<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php require_once('userCheck.php'); ?>
  <?php
	  $uid=(sqlReplace(Trim(empty($_GET["uid"]))))?"":$_GET["uid"];
	  If(empty($wiichatUser)){
		header("location:".$serverURL."/error.php?err=143&key=send&uid=".$uid);
		exit();
	  }
	  $url=$_GET["url"];
  ?>
  <title> 写信息 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h4"> 写信息 </div>
		<div class="box">
			<form action="msgDo.php?act=send&amp;key=send" method="post">
				<p>收信人：<input  inputmode="user predictOn" name="receive" type="text" value="<?php echo $uid?>"/></p>
				<p>标&nbsp;&nbsp;题：<input name="title" inputmode="user predictOn" type="text" /></p>
				<p>内容：</p>
				<p><textarea cols="22" rows="8" name="content" ></textarea></p>
				<p><input type="submit" inputmode="user predictOn" value="发送"/>	
				</p>
			</form>
			<div class="clear"></div>
			<p class="center">
				【<a href="<?php echo $url?>">返回</a>】
			</p>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>