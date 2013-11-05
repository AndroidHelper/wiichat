<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 管理员列表 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
   <div class="bgintor">
	<div class="tit1">
		<ul>
			<li><a href="#" target="mainFrame" >管理员列表</a> </li>
			<li class="l1"><a href="adminAdd.php">添加管理员</a> </li>
		</ul>		
	</div>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：系统管理 －&gt; <strong>管理员列表</strong></span>
		</div>
		<div class="header2"><span>管理员列表</span></div>
		<div class="content">
			<table width="100%">
				<tr class="t1">
					<td>管理员</td>
					<td>登录时间</td>
					<td>登录IP</td>
					<td>登录次数</td>
					<td>删除</td>
				</tr>
				<?php
					$sql="select * from wiichat_admin";
					$result=mysql_query($sql);
					while($row=mysql_fetch_assoc($result))
					{
				?>
				<tr>
					<td><?php echo $row['admin_account'];?></td>
					<td><?php echo $row['admin_loginTime'];?></td>
					<td><?php echo $row['admin_loginIP'];?></td>
					<td><?php echo $row['admin_loginCount']?></td>
					<?php if ($row['admin_account']!=$_SESSION[WiiChat_ID.'admin']){ ?>
					<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='admin_do.php?action=del&id=<?php echo $row["admin_account"]?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
					<?php }else{ ?>
					<td></td>
					<?php } ?>
				</tr>
					<?php
					}
				    ?>
			</table>
		</div>
	</div>
 </body>
</html>
