<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 广播列表 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
   <div class="bgintor">
	<div class="tit1">
		<ul>
			<li><a href="#" target="mainFrame" >广播列表</a> </li>
			<li class="l1"><a href="radioAdd.php" target='mainFrame'>添加广播</a> </li>
		</ul>		
	</div>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：聊天室管理 －&gt; <strong>广播列表</strong></span>
		</div>
		<div class="header2"><span>广播列表</span></div>
		<div class="content">
			<table width="100%">
				<tr class="t1">
					<td>广播时间</td>
					<td>发布者</td>
					<td>内容</td>
					<td>是否有效</td>
					<td>删除</td>
				</tr>
				<?php
					$sql="select * from wiichat_radio order by radio_id desc";
					$result=mysql_query($sql);
					if(mysql_num_rows($result)>0)
					{
						while($row=mysql_fetch_assoc($result))
						{
					?>
					<tr>
						<td><?php echo $row['radio_addTime'];?></td>
						<td><?php echo $row['radio_sender'];?></td>
						<td class='td1'><?php echo $row['radio_content'];?></td>
						<td><?php if($row['radio_isExpired']=='1'){ echo "有效"; }else echo "无效";?></td>
						<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='admin_radioDo.php?act=del&id=<?php echo $row["radio_id"]?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
					</tr>
						<?php
						}
					}else{
				?>
					<tr>
						<td colspan='5'>尚未发送过广播</td>
					</tr>
				<?php
					}
				    ?>
			</table>
		</div>
	</div>
 </body>
</html>
