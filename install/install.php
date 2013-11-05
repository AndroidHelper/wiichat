<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
   <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
   <script type="text/javascript" src="install.js"></script>
  <title> 系统初始化 - 安装WiiChat </title>
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
					系统初始化
				</div>
				<div id="rightintor">
					<?php
						error_reporting(0);
						$db_host=trim($_POST['db_host']);
						$db_user=trim($_POST['db_user']); 
						$db_password=trim($_POST['db_password']);
						$db_name=trim($_POST['db_name']);

						if(!mysql_connect($db_host,$db_user,$db_password)){
							echo("<p class='error'>错误2001：数据库服务器连接失败！请返回上一页检查连接参数。</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='上一步' /></a></p>");
						}else{
							if(mysql_get_server_info()<'5.0.0'){
								echo("<p class='error'>错误：Mysql版本低于WiiChat正常运行所需版本。</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='上一步' /></a></p>");
								exit;
							}
							if($_SESSION['test']!="wiichat")
							{
								echo("<p class='error'>错误：您的服务器环境不支持SESSION。</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='上一步' /></a></p>");
								exit;
							}
							mysql_query("set names utf8");
							if(!mysql_select_db($db_name)){
								echo("<p class='error'>错误2002：数据库不存在！请返回上一页检查连接参数。</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='上一步' /></a></p>");
							}else{
								$files="../inc/config.php";
								if(!fopen($files,"w+")){
									echo("<p class='error'>错误2003：请为inc目录下config.php设置写权限，然后刷新本页面。</p>");
								}else{
									$install = "../install";
									$admin = "../admin";
									if(!is_readable($install)){
										die ("<p class='error'>错误2004：请为install目录设置写权限，然后刷新本页面。</p>");
									}
									if(!is_readable($admin)){
										die ("<p class='error'>错误2005：请为admin目录设置写权限，然后刷新本页面。</p>");
									}
									$config_str = "<?php";
									$config_str .= "\n";
									$config_str .= '$db_host= "' .$db_host. '";';
									$config_str .= "\n";
									$config_str .= '$db_user= "' .$db_user. '";';
									$config_str .= "\n";
									$config_str .= '$db_password= "' .$db_password. '";';
									$config_str .= "\n";
									$config_str .= '$db_name= "' .$db_name. '";';
									$config_str .= "\n";
									$config_str .= '?>';
									$fp=fopen($files,"a");
									fwrite($fp,$config_str);
									fclose($fp);

									echo '<div id="container"><div class="box">';
									echo '<table width="90%">';
									echo '<tr><th width="80%">步骤</th><th>运行结果</th></tr>';
									echo '<tr><td>1. 检测数据库环境</td><td><span class="red" id="table0"></span></td></tr>';
									echo '<tr><td>2. 创建表[wiichat_admin]</td><td><span class="red" id="table1"></span></td></tr>';
									echo '<tr><td>3. 创建表[wiichat_board]</td><td><span class="red" id="table2"></span></td></tr>';
									echo '<tr><td>4. 创建表[wiichat_msg]</td><td><span class="red" id="table3"></span></td></tr>';
									echo '<tr><td>5. 创建表[wiichat_online]</td><td><span class="red" id="table4"></span></td></tr>';
									echo '<tr><td>6. 创建表[wiichat_site]</td><td><span class="red" id="table5"></span></td></tr>';
									echo '<tr><td>7. 创建表[wiichat_user]</td><td><span class="red" id="table6"></span></td></tr>';
									echo '<tr><td>8. 创建表[wiichat_history]</td><td><span class="red" id="table7"></span></td></tr>';
									echo '<tr><td>9. 创建表[wiichat_radio]</td><td><span class="red" id="table8"></span></td></tr>';
									echo '<tr><td>10. 创建表[wiichat_chat]</td><td><span class="red" id="table9"></span></td></tr>';
									echo '<tr><td>11. 创建表[wiichat_privatechat]</td><td><span class="red" id="table10"></span></td></tr>';
									echo '<tr><td>12. 创建表[wiichat_mask]</td><td><span class="red" id="table11"></span></td></tr>';
									echo '<tr><td>13. 初始化数据库数据</td><td><span class="red" id="table12"></span></td></tr>';
									echo "</table>";
									echo '<div id="success"></div>';
									echo "<script language='javascript'>";
									echo 'var x=0,j=1,t=12;';
									echo "var databaseIP='".$db_host."';";
									echo "var databaseName='".$db_name."';";
									echo "var databaseUser='".$db_user."';";
									echo "var databasePWD='".$db_password."';";
									echo "act();";
									echo "</script>";
									echo "</div></div>";
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