<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 完成安装 - 安装WiiChat </title>
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
							<img src="images/li_bg1.gif" width="10" height="11" alt="" />系统初始化
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" />设置管理员
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" />完成安装
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
				完成安装
				</div>
				<div id="rightintor">
					<?php
						//error_reporting(0);
						$AdminUserName=trim($_POST["edtAdminUserName"]);
						$AdminPassWord=trim($_POST["edtAdminPassWord"]);
						$foldername=trim($_POST["edtAdminFolderName"]);
						$AdminFolderName="../".$foldername;
						$AdminPassWord2=md5($AdminPassWord);
						$db_host=trim($_POST["db_host"]);
						$db_user=trim($_POST["db_user"]);
						$db_name=trim($_POST["db_name"]);
						$db_password=trim($_POST["db_password"]);
						$address=trim($_POST['address']);
						if(!mysql_connect($db_host,$db_user,$db_password)){
							echo("<p class='error'>错误：2004。意外错误！</p>");
						}else{
							mysql_query("set names utf8");
							if(!mysql_select_db($db_name)){
								echo("<p class='error'>错误：2005。意外错误！</p>");
							}else{
								$ID=md5(uniqid(rand(),true));
								rename("../admin",$AdminFolderName);
								$files="../inc/config.php";
								$config_str  = "\n";
								$config_str .= "<?php";
								$config_str .= "\n";
								$config_str .= '$admin_dir= "'.$foldername.'";';
								$config_str .= "\n";
								$config_str.="define('WiiChat_ID','".$ID."');";
								$config_str.="\n";
								$config_str .= '$serverURL= "'.$address.'";';
								$config_str .= "\n";
								$config_str .= '?>';
								$fp=fopen($files,"a");
								fwrite($fp,$config_str);
								fclose($fp);
								$sql="insert into wiichat_admin (admin_account,admin_password) values('".$AdminUserName."','".$AdminPassWord2."')";
								if(!mysql_query($sql)){
									echo("<p class='error'>错误：2008。意外错误！</p>");
								}else{
									echo "<h2>恭喜您，WiiChat安装顺利完成！</h2>";
									echo "<p class='red'><strong>请牢记以下资料：</strong></p>";
									echo "<p>管理后台地址：<span class='red'>". $address."/".$foldername."/adminLogin.html</span></p>";
									echo "<p>管理员帐号：<span class='red'>".$AdminUserName."</span></p>";
									echo "<p>管理员密码：<span class='red'>".$AdminPassWord."</span></p>";
									echo "<p><a href='".$address."' target='_blank'>进入WiiChat首页</a></p>";
									echo "<p><a href='".$address."/".$foldername."/adminLogin.html' target='_blank'>进入WiiChat管理后台</a></p>";

									echo "<p><a href='".$address."'><img src='images/bt_finish.gif' width='68' height='26' alt='完成' /></a></p>";
								}
							}
						}
					?>
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
