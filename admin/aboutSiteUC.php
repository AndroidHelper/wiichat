<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 网站设置 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
 	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li  class="l1"><a href="aboutSite.php" target="mainFrame" >基本设置</a> </li>
				<li class="l1"><a href="aboutSiteAdvance.php">高级设置</a> </li>
				<li><a href="aboutSiteUC.php">UCenter设置</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>UCenter设置</strong></span></div>
			<div class="header2"><span>UCenter设置</span></div>
			<div class="fromcontent">
				<form action="aboutSite_do.php?act=ucenter" method="post" id="doForm">
					<p class='p1'>提示：当您已经添加了一个新的UCenter应用程序后将UCenter应用管理下的 应用的UCenter配置信息 拷贝到以下输入框中.</p>
					<p>UCenter代码：</p>
					<p class="txt">
						<textarea name="uccode" cols="60" rows="6"></textarea>
					</p>
					<div class="btn">
						<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交"/>
					</div>
				</form>
			</div>
		</div>
	</div>
 </body>
</html>
