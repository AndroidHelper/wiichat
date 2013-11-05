<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 房间管理 </title>
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
	$action=(empty($_GET["action"]))?'':$_GET['action'];
	 if($action=="update"){
		$i=trim($_POST["i"]);
		$i=checkData2($i,"",0);
		for($x=1;$x<=$i;$x++){
			$tempId=$_POST["id".$x];
			$tempId=checkData2($tempId,'ID',0);
			$tempOrder=$_POST["order".$x];
			$tempOrder=checkData2($tempOrder,'ID',0);
			$sqlStr="update wiichat_board set board_order=".$tempOrder." where board_id=".$tempId."";
			if(!mysql_query($sqlStr)){
				alertInfo('保存失败! 原因：SQL更新失败',"chat_board.php",0);
			}
		}
		alertInfo('保存成功!',"chat_board.php",0);
	 }
 ?>
   <div class="bgintor">
		<div class="tit1">
			<ul>
				<li><a href="#" target="mainFrame" >房间列表</a> </li>
				<li class="l1"><a href="chat_boardAdd.php">添加房间</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<form  name="listForm" method="post" action="#">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>房间列表</strong></span>
			</div>
			<div class="header2"><span>房间列表</span></div>
			<div class="header3">
				<input type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)"> <strong>全选</strong><a href="javascript:document.listForm.action='chat_board.php?action=update';document.listForm.submit();"><img src="images/act_save.gif" width="16" height="16" alt="保存" /> <strong>保存</strong> </a> <a href="javascript:if(confirm('您确定要删除吗？')){document.listForm.action='chat_boardDo.php?act=delAll';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="删除" /> <strong>删除</strong> </a>
			</div>
			<div class="content">
			<p><span class='red'>提示：数据打包操作将聊天室数据保存至数据库，前台聊天室数据将被清空。</span></p>
				<table width="100%">
					<tr class="t1">
						<td></td>
						<td>名称</td>
						<td>简介</td>
						<td>房主</td>
						<td>排序</td>
						<td>数据打包</td>
						<td>编辑</td>
						<td>删除</td>
					</tr>
					<?php
						$sqlStr="select * from wiichat_board order by board_order asc,board_id desc";
						$rs=mysql_query($sqlStr);
						$num=mysql_num_rows($rs);
						if(!$num){
							echo "<tr><td colspan='6'>暂且没有数据！</td></tr>";
						}else{
							$i=0;
							while($row=mysql_fetch_assoc($rs)){	 
								$i++;
					  ?>
						<tr>
							<td><input type="checkbox" name="id_list[]" value="<?php echo $row["board_id"]?>" /></td>
							<td class="td1"><a href="chat_boardEdit.php?id=<?php echo $row["board_id"]?>"><?php echo $row["board_name"]?></a></td>
							<td class="td1"><?php echo $row["board_desc"]?></td>
							<td class="td1"><?php echo GetModerator1($row["board_admin"])?></td>
							<td><input name="id<?php echo $i?>" type="hidden" value="<?php echo $row["board_id"]?>"><input name="i" type="hidden" value="<?php echo $i?>"><input name="order<?php echo $i?>" type="text" size="4" value="<?php echo $row["board_order"]?>"/></td>
							<td><a href="chat_boardDo.php?act=import&id=<?php echo $row["board_id"]?>">打包</a> <a href='packList.php?id=<?php echo $row['board_id']?>'>数据包列表</a></td>
							<td><a href="chat_boardEdit.php?id=<?php echo $row["board_id"]?>"><img src="images/dot_edit.gif" width="9" height="9" alt="编辑" /></a></td>
							<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='chat_boardDo.php?act=del&id=<?php echo $row["board_id"]?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
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
	 </div>
 </body>
</html>
