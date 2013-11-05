<?php require_once 'db_conn.php';?><?php require_once 'adminCheck.php';?><?php require_once '../version.php';?>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 后台管理首页 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body id="flow">
	<div class="bgintor">
		<div class="bgintor2">
			<div class="bgvline"></div>
			<div class="bgtitle"><span><img src="images/home.gif" width="16" height="15" alt="" /></span>
				<span><strong>位置</strong>：首页</span></div>
			<div class="bgintor3">
				<div class="left">
					<div class="title2"></div>
					<div class="title1"><span class="s1">个人资料</span></div>
					<div class="bgintor4">
						<?php
							$sql="select * from wiichat_admin where admin_account='".$_SESSION[WiiChat_ID.'admin']."'";
							$result=mysql_query($sql);
							$row=mysql_fetch_assoc($result);
							if($row)
							{
								$admin_account=$row['admin_account'];
								$admin_logintime=$row['admin_loginTime'];
								$admin_loginIp=$row['admin_loginIP'];
								$admin_loginCount=$row['admin_loginCount'];
							}
						?>
						<p>用 户 名：<?php echo $admin_account;?></p>
						<p>登 录 IP：<?php echo $admin_loginIp;?></p>
						<p>登录次数：<?php echo $admin_loginCount;?></p>
						<p>登录时间：<?php echo $admin_logintime;?></p>
					</div>
				</div>
			</div>
			<div class="bgintor3">
				<div class="left">
					<div class="title2"></div>
					<div class="title1"><span class="s1">系统信息</span></div>
					<div class="bgintor4">
						<p>系统名称：WiiChat</p>
						<p>版本号：<?php echo $version;?> </p>
						<p>系统时间：<?php echo date('Y-m-d H:i:s');?></p>
						<p></p>
					</div>
				</div>
			</div>
			<div id="main"></div>
			<div class="bgintor5">
				<div class="title2"></div>
				<div class="title1"><span class="s1">WiiChat动态</span></div>
				<ul>
					<script language='javascript' src="http://www.wiipu.com/news/wiichat.php"></script>
				</ul>
			</div>
		</div>
	</div>
 </body>
</html>
