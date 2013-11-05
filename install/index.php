<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 欢迎 - 安装WiiChat </title>
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
							<img src="images/li_bg2.gif" width="10" height="11" alt="" />设置数据库
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
					欢迎使用WiiChat
				</div>
				<div id="rightintor">
					<p>感谢您使用WiiChat。WiiChat是一款轻量级的基于PHP+Mysql的聊天室系统。</p>
					<p>请按照说明完成安装步骤。整个过程只需要几分钟时间。如果您在安装过程中遇到问题，您可以访问<a href="http://www.wiipu.com/" target="_blank">WiiChat官方网站</a>查询相关文档获得帮助。</p>
					<h2>WiiChat所需环境</h2>
					<p>您可以向服务器提供商询问是否支持以下环境参数。</p>
					<table width="80%">
						<tr>
							<th width="30%">项目</th>
							<th width="35%">需求</th>
							<th width="35%">实际环境</th>
						</tr>
						<tr>
							<td>PHP</td>
							<td>5.0及以上</td>
							<td><?php echo PHP_VERSION; if(PHP_VERSION>'5.0.0') echo "<img src='images/yes.png' width='16' height='16' alt='' />";?></td>
						</tr>
						<tr>
							<td>MySQL</td>
							<td>5.0及以上</td>
							<td></td>
						</tr>
						<!-- 
						<tr>
							<td>Session</td>
							<td>环境需要支持Session</td>
						</tr>
						<tr>
							<td>config.php</td>
							<td>位于根目录的Config文件需要可写</td>
						</tr> -->
					</table>
					<?php if(PHP_VERSION>'5.0.0'){ 
						$_SESSION['test']="wiichat";
						?>
					<p><a href="install_db.php"><img src="images/next.gif" width="68" height="26" alt="下一步" /></a></p>
					<?php }else{ ?>
					<p>您的PHP版本低于WiiChat所需的版本。</p>
					<?php } ?>
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
