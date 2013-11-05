<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
   <script type="text/javascript" src="install.js"></script>
  <title> 设置管理员 - 安装WiiChat </title>
  </head>
 <body>
<?php
		$AdminFolderNameOld="admin";
		$Host="http://../".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
		$count=strpos($Host,"install_admin.php");
		$Host=substr_replace($Host,"",$count,17);
		$Host1=str_replace('../','',$Host);
		$count1=strpos($Host1,"/install");
		$Host2=substr_replace($Host1,"",$count1,9);
		$db_name=$_GET["dabasename"];
		$db_host=$_GET["dataaddress"];
		$db_user=$_GET["datauser"];
		$db_password=$_GET["datapwd"];
	?>
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
							<img src="images/li_bg2.gif" width="10" height="11" alt="" />完成安装
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
					设置管理员
				</div>
				<div id="rightintor">
					<form id="edit" name="edit" method="post" action="install_finish.php">
						<p>　网站地址：<input class='input2' type='text' name='address' value='<?php echo $Host2;?>'/><span class='red'> * 建议不修改</span></p>
						<p>　管理目录：<input id="edtAdminFolderName" name="edtAdminFolderName" inputmode="user predictOn" value="<?php echo $AdminFolderNameOld;?>" class='input2'/><span class='red'> * 安全起见，要求修改</span><input type="hidden" name="Host" value="<?php echo $Host;?>"/></p>
						<p>管理员帐号： <input id="edtAdminUserName" name="edtAdminUserName" class="input2" inputmode="user predictOn" type="text"/><span class='red'> *</span></p>
						<p>管理员密码：
						<input id="edtAdminPassWord" name="edtAdminPassWord"  inputmode="user predictOn" class="input2" type="password"/><span class='red'> *</span></p>
						<p>　确认密码：
						<input id="edtAdminPassWord2" name="edtAdminPassWord2"  inputmode="user predictOn" class="input2" type="password"/><input type="hidden" name="db_host" value="<?php echo $db_host;?>"/><input type="hidden" name="db_name" value="<?php echo $db_name;?>"/><input type="hidden" name="db_user" value="<?php echo $db_user;?>"/><input type="hidden" name="db_password" value="<?php echo $db_password;?>"/><span class='red'> *</span></p>
						<input class="input1" type="image" src="images/next.gif" onclick="return check();" id="btnPost"/>
						<script language="JavaScript" type="text/javascript">
							function check(){
								if((document.getElementById("edtAdminFolderName").value)=="admin"){
										document.getElementById("edtAdminFolderName").focus();
										alert("请修改管理后台地址");
										return false;
								}
								if((document.getElementById("edtAdminFolderName").value).length<2){
										alert("后台管理地址长度最少为2位");
										return false;
								}
								if((document.getElementById("edtAdminUserName").value).length<3){
										alert("帐号长度最少为3位");
										return false;
								}
								if((document.getElementById("edtAdminPassWord").value).length<6){
										alert("管理员密码长度最少为6位");
										return false;
								}
								if((document.getElementById("edtAdminPassWord").value!==document.getElementById("edtAdminPassWord2").value)){
										alert("两次输入的密码不一样");
										return false;
								}
							}
						</script>
					</form>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div id="footer">
			<?php require_once("footer.php")?>
		</div>
	</div>
 </body>
</html>
