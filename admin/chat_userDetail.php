<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 用户详情 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
 <?php
	if(empty($_GET["id"])){
		$id="";
	}else{
		$id=sqlReplace(Trim($_GET["id"]));
		$id=Intval($id);
	}
	if(!empty($id))
	 {
	 $sqlStr="select * from wiichat_user where user_id=".$id;
	 $rs=mysql_query($sqlStr);
	 $row=mysql_fetch_assoc($rs);
		If(!$row){
			alertInfo2("用户不存在","",1);
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
	}
	if(!empty($_GET['account']))
	{
		$sql="select * from wiichat_user where user_account='".urldecode($_GET['account'])."'";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if($row)
		{
			$uAccount=$row["user_account"];
			$uMobile=$row["user_mobile"];
			$uEmail=$row["user_email"];
			$uLevel=$row["user_level"];
			$uLoginCount=$row["user_loginCount"];
			$uLastLogin=$row["user_lastLogin"];
			$uRegTime=$row["user_regTime"];
			$uVip=$row["user_isVip"];
		}
	}
?>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：聊天室管理 －&gt; <strong>用户详情</strong></span></div>
		<div class="header2"><span>用户详情</span></div>
		<div class="fromcontent">
			<p class="p2">帐号：<span class="sp2"><?php echo $uAccount;?></span></p>
			<p class="p2">ＱＱ：<span class="sp2"><?php echo $uMobile;?></span></p>
			<p class="p2">邮箱：<span class="sp2"><?php echo $uEmail;?></span></p>
			<p class="p2">注册时间：<span class="sp2"><?php echo $uRegTime;?></span></p>
			<p class="p2">登陆次数：<span class="sp2"><?php echo $uLoginCount;?></span></p>
			<p class="p2">最近登陆：<span class="sp2"><?php echo $uLastLogin;?></span></p>
			<p class="p2">身份：<span class="sp2"><?php echo $uLevel?> (0--普通用户 1--房主 2--管理员)</span></p>
			<p class="p2">VIP：<span class="sp2"><?php echo $uVip?> (1--是 0--不是)</span></p>
		</div>
	</div>
 </body>
</html>
