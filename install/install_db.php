<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 设置数据库 - 安装WiiChat </title>
  </head>
 <body>
	<div id="content">
		<div id="header">
			<?php require_once("header.php")?>
		</div>
		<div id="intor">
			<div id="left">
				<div id="leftheader">
					安装步骤
				</div>
				<div id="leftintor">
					<ul>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" />欢迎使用WiiChat
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" />设置数据库
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" />系统初始化
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" />设置管理员
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" />完成安装
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
					设置数据库
				</div>
				<div id="rightintor">
					<p>请填写MySql的连接参数。（可从服务器提供商处获得）</p>
					<form action="install.php" method="POST" name="set" id="set">
						  <p>主机地址：<input type="text" name="db_host" id="db_host" value="localhost"/></p>
						  <p>用 户 名：<input type="text" name="db_user" id="db_user" value="root"/></p>
						  <p>密　　码：<input type="text" name="db_password" id="db_password" value="root"/></p>
						  <p>数据库名：<input type="text" name="db_name" id="db_name" value="wiichat"/></p>
						  <input class="input1" type="image" src="images/next.gif"/>
					</form>
				</div>
			</div>
			<div style="clear:both">
		</div>
		<div id="footer">
			<?php require_once("footer.php")?>
		</div>
	</div>
 </body>
</html>
