<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 聊天室管理员列表 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
    <script language="javascript">
		function checkAll(f){
			var len=f.elements.length;
			if (document.getElementById("handler").checked==true)
			{	
				for(i=0;i<len;i++){
					var e=f.elements[i];
					if (e.type=='checkbox') e.checked=true;
				}
			}
			if (document.getElementById("handler").checked==false)
			{	
				for(i=0;i<len;i++){
					var e=f.elements[i];
					if (e.type=='checkbox') e.checked=false;
				}
			}
		}
	</script>
</head>
 <body>
	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li><a href="#" target="mainFrame" >管理员列表</a> </li>
				<li class="l1"><a href="chat_adminAdd.php">添加管理员</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<form  name="listForm" method="post" action="#">
				<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
					<span>位置：聊天室管理 －&gt; <strong>聊天室管理员列表</strong></span></div>
				<div class="header2"><span>聊天室管理员列表</span></div>
				<div class="header3">
					<input type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)"> <strong>全选</strong><a href="javascript:if(confirm('您确定要删除吗？')){document.listForm.action='chat_adminDo.php?act=delAll';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="删除" /> <strong>删除</strong> </a>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td></td>
							<td>管理员</td>
							<td>删除</td>
						</tr>
						<?php
							$sqlStr="select * from wiichat_user where user_level='2'";
							$rs=mysql_query($sqlStr);
							$rows=mysql_num_rows($rs);
							if(!$rows){
								echo "<tr><td colspan='3'>暂且没有数据！</td></tr>";
							}else{
								while($row=mysql_fetch_assoc($rs)){
							?>
							<tr>
								<td><input type="checkbox" name="id_list[]" value="<?php echo $row["user_id"]?>" /></td>
								<td><?php echo $row['user_account'];?></td>
								<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='chat_adminDo.php?act=del&id=<?php echo $row["user_id"]?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
							</tr>
								<?php
							}
						}
						?>
					</table>
				</div>
			</form>
		</div>
	</div>
 </body>
</html>
