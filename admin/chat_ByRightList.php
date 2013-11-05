<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 按权限查看用户 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
	<script language="javascript">
		function checkAll(f){
			var len=document.getElementsByName('id_list[]').length;
			if (document.getElementById("handler").checked==true)
			{
				for(i=0;i<len;i++){
					document.getElementsByName('id_list[]')[i].checked=true;
				}
			}
			if (document.getElementById("handler").checked==false)
			{
				for(i=0;i<len;i++){
					document.getElementsByName('id_list[]')[i].checked=false;
				}
			}
		}
	</script>
</head>
 <body>
<?php
	if(empty($_GET["t"])){
		$t="";
	}else{
	$t=$_GET["t"];
	}
	$ac=(empty($_RESUEST["ac"]))?"":$_RESUEST["ac"];
	$m=(empty($_RESUEST["m"]))?"":$_RESUEST["m"];
	$mail=(empty($_RESUEST["mail"]))?"":$_RESUEST["mail"];
	$l=(empty($_GET["l"]))?"":$_GET['l'];
	$g=(empty($_GET["g"]))?"":$_GET['g'];
	$pagesize=15;
	$startRow=0;
	$page=(empty($_GET["page"]))?"":$_GET['page'];
	if (empty($_GET['page'])||!is_numeric($_GET['page'])){
		$page=1;
	}else{
		$page=$_GET['page'];
		$startRow=($page-1)*$pagesize;
	}			
	$url="t=".$t."&ac=".$ac."&m=".$m."&mail=".$mail."&l=".$l."&g=".$g;
	If($l=="vip"){
		$sqlStrt="select * from wiichat_user where user_isVip='1' order by user_id desc";
		$sqlStr="select * from wiichat_user where user_isVip='1' order by user_id desc limit $startRow,$pagesize";
	}ElseIf($l=="bm"){
		$sqlStrt="select * from wiichat_user where user_level='1' order by user_id desc";
		$sqlStr="select * from wiichat_user where user_level='1' order by user_id desc limit $startRow,$pagesize";
	}ElseIf($l=="user"){
		$sqlStrt="select * from wiichat_user where user_level='0' order by user_id desc";
		$sqlStr="select * from wiichat_user where user_level='0' order by user_id desc limit $startRow,$pagesize";
	}ElseIf($l=="admin"){ 
		$sqlStrt="select * from wiichat_user where user_level='2' order by user_id desc";
		$sqlStr="select * from wiichat_user where user_level='2' order by user_id desc limit $startRow,$pagesize";
	}		
	?>
	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li  class="l1"><a href="chat_user.php" target="mainFrame" >用户搜索</a> </li>
				<li><a href="chat_userByRights.php" target="mainFrame">按权限查看</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>按权限查看用户</strong></span></div>
			<form  name="listForm" method="post" action="#" id="listForm">
				<div class="header2"><span>按权限查看用户</span></div>
				<div class="header3">
					<input type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)"> <strong>全选</strong><a href="javascript:document.listForm.action='chat_userByRightsDo.php?action=rmd&<?php echo $url?>&page=<?php echo $page?>';document.listForm.submit();"><img src="images/act_save.gif" width="16" height="16" alt="保存" /> <strong>保存</strong> </a> <a href="javascript:if(confirm('您确定要删除吗？')){document.listForm.action='chat_userByRightsDo.php?action=delAll&<?php echo $url?>';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="删除" /> <strong>删除</strong> </a>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td></td>
							<td>账号</td>
							<td>手机</td>
							<td>Email</td>
							<td>注册时间</td>
							<td>是否VIP</td>
							<td>删除</td>
						</tr>
						<?php
							$rs=mysql_query($sqlStrt);
							$row=mysql_fetch_assoc($rs);
							if(!$row){ 
								echo "<tr><td colspan='7'>暂且没有数据！</td></tr>";
							}else{		
									$rs = mysql_query($sqlStrt) or die ("查询失败，请检查SQL语句T。");
									$result = mysql_query($sqlStr) or die ("查询失败，请检查SQL语句。");
									$rscount=mysql_num_rows($rs);
									if ($rscount%$pagesize==0)
										$pagecount=$rscount/$pagesize;
									else
										$pagecount=ceil($rscount/$pagesize);
									$i=0;
									while($row=mysql_fetch_assoc($result)){
									$i++;
						  ?>
						  <tr>
							<td><input type="checkbox" name="id_list[]" value="<?php echo $row["user_id"]?>" /></td>
							<td class="td1"><a href="chat_userDetail.php?id=<?php echo $row["user_id"]?>"><?php echo $row["user_account"]?></a></td>
							<td><?php echo $row["user_mobile"]?></td>
							<td class="td1"><?php echo $row["user_email"]?></td>
							<td><?php echo $row["user_regTime"]?></td>
							<td><input type="hidden" name="id<?php echo $i?>" value="<?php echo $row["user_id"]?>"/><input type="checkbox" name="isRmd<?php echo $i?>" <?php if($row["user_isVip"]=="1") echo "checked"?>/></td>
							<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='chat_userByRightsDo.php?action=del&<?php echo $url?>&id2=<?php echo $row["user_id"]?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
						  </tr>
						  <?php
								 }
						  ?>
					</table>
					<div class="page">
					  <p><input type="hidden" name="i" value="<?php echo $i?>"/>
					  </p>
					</div>
					<?php
					showPage("chat_ByRightList.php?".$url,$page,$pagesize,$rscount,$pagecount);
					?>
					<?php }?>
				</div>
			</form>
		</div>
	</div>
 </body>
</html>
