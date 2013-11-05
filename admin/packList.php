<?php require_once("db_conn.php")?>
<?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 数据包列表 </title>
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
		<?php
			$id=sqlReplace(trim($_GET['id']));
		?>
		<div class="listintor">
			<form  name="listForm" method="post" action="#">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>数据包列表</strong></span>
			</div>
			<div class="header2"><span>数据包列表</span></div>
			<div class="header3">
				<input type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)"> <strong>全选</strong> <a href="javascript:if(confirm('您确定要删除吗？')){document.listForm.action='pack_Do.php?act=delAll&boardid=<?php echo $id;?>';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="删除" /> <strong>删除</strong> </a>
			</div>
			<div class="content">
				<table width="100%">
					<tr class="t1">
						<td></td>
						<td>打包时间</td>
						<td>数据包下载</td>
						<td>删除</td>
					</tr>
					<?php
						$sql="select * from wiichat_history where history_board=".$id;
						$result=mysql_query($sql);
						if(mysql_num_rows($result)<1)
						{
						?>
							<tr>
								<td colspan='4'>没有数据</td>
							</tr>
						<?php
						}else{
							while($rows=mysql_fetch_assoc($result))
							{
					  ?>
						<tr>
							<td><input type="checkbox" name="id_list[]" value="<?php echo $rows["history_id"]?>" /></td>
							<td><?php echo $rows['history_time']?></td>
							<td><a href='pack_Do.php?act=down&id=<?php echo $rows['history_id'];?>'>下载</a></td>
							<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='pack_Do.php?act=del&id=<?php echo $rows["history_id"]?>&borderid=<?php echo $id;?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
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
