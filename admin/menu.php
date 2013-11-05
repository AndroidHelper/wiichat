<?php session_start();require_once 'adminCheck.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> WiiChat管理主菜单 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>	
 <body id="flow">
	<div class="menu" id="me">
		<div class="menu_content">
			<div class="menu_h">
				系统管理
			</div>
			<div class="menu_intor">
				<p><a href="adminList.php" target="mainFrame">管理员列表</a></p>
			</div>
		</div>
		<div class="menu_content">
			<div class="menu_h menu_h3">
				聊天室管理
			</div>
			<div class="menu_intor">
				<p><a href="aboutSite.php" target="mainFrame">聊天室设置</a></p>
				<p><a href="chat_admin.php" target="mainFrame">聊天室管理员</a></p>
				<p><a href="chat_board.php" target="mainFrame">房间管理</a></p>
				<p><a href="chat_user.php" target="mainFrame">会员管理</a></p>
				<p><a href="admin_radio.php" target="mainFrame">管理员广播</a></p>
				<p><a href="chat_stat.php" target="mainFrame">聊天室统计</a></p>
			</div>
		</div>
	</div>
 </body>
</html>
