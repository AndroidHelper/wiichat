<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php require_once('userCheck.php'); ?>
  <?php
	  If(empty($wiichatUser)){
		header("location:".$serverURL."/error.php?err=143");
		exit();
	  }
	  $id=intval(sqlReplace(Trim($_GET["id"])));
	  $Received=sqlReplace(Trim($_GET["to"])); //收信人
	  $sqlStr="select msg_title from wiichat_msg where msg_id=".$id;
	  $rs=mysql_query($sqlStr);
	  $row=mysql_fetch_assoc($rs);
	  If($row){
		$title=$row['msg_title'];
	  }
  ?>
  <title> 回复信息 </title>
 </head>	
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h4"> 回复信息 </div>
		<div class="box">
			<form action="msgDo.php?uid=<?php echo $Received?>&amp;act=reply&amp;id=<?php echo $id?>" method="post">
				<p>收信人：<span class="red"><?php echo $Received?></span></p>
				<p>标题：<input inputmode="user predictOn" name="title" type="text"  value="<?php echo $title?>"/></p>
				<p>内容：</p>
				<p><textarea cols="22" rows="8" name="content" ></textarea></p>
				<p><input inputmode="user predictOn" type="submit" value="回复"/>	
				</p>
			</form>
			<div class="clear"></div>
			<p class="center">
				【<a href="msg_List.php?act=receive">返回</a>】
			</p>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>