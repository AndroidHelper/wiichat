<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php 
	require_once('userCheck.php');
  ?>
 <?php 
	$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
	If(empty($wiichatUser)){
		header("location:".$serverURL."/error.php?err=143");
		exit();
    }
	$sql="select * from wiichat_msg where  msg_received ='".$wiichatUser."' and msg_side=1 and msg_isReader=0 order by msg_addTime desc";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
 ?>
  <title> 用户中心 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> 用户中心 </div>
		<div class="box">
			<h2>我的信息</h2>
			<div class="content">
				<?php
					require_once('invite.php');
					if($num>0)
					{
						echo "<p><a href='msg_List.php?act=new' class='red'>您有新的信息</a></p>";
					}
				?>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="msg_send.php?url=<?php echo urlencode(getUrl())?>">写信息</a></p>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="msg_List.php?act=new">未读信息</a></p>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="msg_List.php?act=receive">收件箱</a></p>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="msg_List.php?act=send">发件箱</a></p>
			</div>
			<h2>我的资料</h2>
			<div class="content">
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="userData.php">我的资料</a></p>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="userEdit.php">修改资料</a></p>
				<p><img src="images/xtb1.gif"  alt="·" width='6' height='8'> <a href="userPassword.php">修改密码</a></p>
			</div>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>