<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php
	$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
	If(empty($wiichatUser)){
		 header("location:".$serverURL."/error.php?err=143");	
		 exit();
    }

	$sqlStr="select * from wiichat_user where user_account='".$wiichatUser."'";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	If(!$row){
		 header("location:".$serverURL."/error.php?err=145");
		 exit();
	}Else{
		$uAccount=$row["user_account"];
		$uMobile=$row["user_mobile"];
		$uEmail=$row["user_email"];
		$uLoginCount=$row["user_loginCount"];
		$uLastLogin=$row["user_lastLogin"];
		$uRegTime=$row["user_regTime"];
		$uVip=$row["user_isVip"];
	}
 ?>
  <title> 我的资料 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> 我的资料 </div>
		<div class="box">
			<h2>帐号：<?php echo $uAccount?></h2>
			<p>手机：<?php echo $uMobile?></p>
			<p>Email：<?php echo $uEmail?></p>
			<?php If($uVip=="1"){?> <span class="red">本聊天室VIP用户</span><?php }?>
			</p>
			<p>注册时间：<?php echo $uRegTime?></p>
			<p>最近一次登陆：<?php echo $uLastLogin?></p>
			<p>登陆次数：<?php echo $uLoginCount?></p>
			<p class="center">【<a href='userCenter.php'>返回</a>】</p>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>