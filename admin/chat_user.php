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
				<li><a href="#" target="mainFrame" >用户搜索</a> </li>
				<li class="l1"><a href="chat_userByRights.php">按权限查看</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>聊天室用户搜索</strong></span></div>
			<div class="header2"><span>聊天室用户搜索</span></div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="chat_userList.php">
					<p><span class='red'>提示：支持模糊搜索，不必填写所有的项，填写关键字即可。</span></p>
					<p>帐号：<input name="ac" type="text" class="in1"/></p>
					<p>ＱＱ：<input name="m" type="text" class="in1"/></p>
					<p>邮箱：<input name="mail" type="text" class="in1"/></p>
					<div class="btn">
						<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return true"/>
					</div>
				</form>
			</div>
		</div>
	</div>
 </body>
</html>
