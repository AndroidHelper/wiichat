<?php session_start();require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 会员管理 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li  class="l1"><a href="chat_user.php" target="mainFrame" >用户搜索</a> </li>
				<li><a href="#">按权限查看</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>按权限查看用户</strong></span></div>
			<div class="header2"><span>按权限查看用户</span></div>
			<div class="fromcontent">
				<p class="underline"><img src="images/onleft.gif" alt="·" /> <a href="chat_ByRightList.php?l=vip">查看所有VIP用户</a></p>
				<p class="underline"><img src="images/onleft.gif" alt="·" /> <a href="chat_ByRightList.php?l=admin">查看所有管理员</a></p>
				<p class="underline"><img src="images/onleft.gif" alt="·" /> <a href="chat_ByRightList.php?l=bm">查看所有房主</a></p>
				<p class="underline"><img src="images/onleft.gif" alt="·" /> <a href="chat_ByRightList.php?l=user">查看所有普通用户</a></p>
			</div>
		</div>
	</div>
 </body>
</html>
