<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php
	$uid=sqlReplace(Trim($_GET["id"]));
	$sqlStr="select * from wiichat_user where user_account='".$uid."'";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	If(!$row){
		header("location:".$serverURL."/error.php?err=145");
		exit();
	}Else{
		$uAccount=$row["user_account"];
		$uMobile=$row["user_mobile"];
		$uEmail=$row["user_email"];
		$uLevel=$row["user_level"];
		$uLoginCount=$row["user_loginCount"];
		$uLastLogin=$row["user_lastLogin"];
		$uRegTime=$row["user_regTime"];
		$uVip=$row["user_isVip"];
	}
	if(isset($_SESSION[WiiChat_ID."wiichatUser"]))
	{
		$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
	}else{
		$wiichatUser="";
	}
	$userVip="";
	$userLevel="";

	If(!empty($wiichatUser)){
		$sqlStr="select user_isVip,user_level,user_board from wiichat_user where user_account='".$wiichatUser."'";
		$rs=mysql_query($sqlStr);
		$row=mysql_fetch_assoc($rs);
		$userVip=$row["user_isVip"];
		$userLevel=$row["user_level"];
		$user_board =$row["user_board"];  
	}
 ?>
  <title> 会员<?php echo $uid?> </title>
 </head>
	
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> 会员资料 </div>
		<div class="box">
			<h2><?php echo $uid?></h2>
			<p>身份：
			<?php
				switch($uLevel){
					case "0":
						$sf= "普通会员";
						break;
					case "1":
						$sf= "房主";
						break;
					case "2":
						$sf= "管理员";
						break;
				}	
				echo $sf;
			?>
			</p>
			<?php If($userVip==1){?><p class="red">本聊天室VIP用户</p><?php }?>
			<?php If(($userLevel=="2") || ($userVip=="1")){?>
			<p>ＱＱ：<?php echo $uMobile?></p>
			<p>邮箱：<?php echo $uEmail?></p>
			<?php }?>
			<p>注册时间：<?php echo $uRegTime?></p>
			<p>登陆次数：<?php echo $uLoginCount?></p>
			<p>最近登陆：<?php echo $uLastLogin?></p>
			<?php if(!empty($wiichatUser)&&$wiichatUser!=$uid) { ?>
			<p>【<a href="privateChat.php?uid=<?php echo $uid?>&amp;url=<?php echo urlencode(getUrl())?>">私聊</a>】</p>
			<?php } ?>
			【<a href="<?php echo $_GET["url"];	?>">返回</a>】
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>
