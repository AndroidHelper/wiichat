<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
	$t=$_GET["t"];
	$ac=(empty($_RESUEST["ac"]))?"":$_RESUEST["ac"];
	$m=(empty($_RESUEST["m"]))?"":$_RESUEST["m"];
	$mail=(empty($_RESUEST["mail"]))?"":$_RESUEST["mail"];
	$l=(empty($_GET["l"]))?"":$_GET['l'];
	$g=(empty($_GET["g"]))?"":$_GET['g'];
	$url="t=".$t."&ac=".$ac."&m=".$m."&mail=".$mail."&l=".$l."&g=".$g;
	$action=(empty($_GET["action"]))?"":$_GET['action'];
	if($action=="delAll"){
		if(empty($_POST["id_list"])){
			alertInfo2('请选择删除项!','chat_ByRightList.php?'.$url,0);
		}
		$id_list=$_POST["id_list"];
		foreach($id_list as $val){
			$sql="select * from wiichat_user where user_id=".$val."";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				$sql2="select * from wiichat_board where board_admin like'%".$row['user_account']."%'";
				$result2=mysql_query($sql2);
				if(mysql_num_rows($result2)>0)
				{
					alertInfo2('用户和房主存在关联，请先删除相关联的房主信息。','chat_ByRightList.php?'.$url,0);
				}else{
					$sql3="delete from wiichat_user where user_id=".$val."";
					if(!mysql_query($sql3)){
						alertInfo2('删除失败!','chat_ByRightList.php?'.$url,0);
					}
				}
			}else{
				alertInfo2('删除失败，原因该用户不存在。','chat_ByRightList.php?'.$url,0);
			}
		}
		alertInfo2('删除成功!','chat_ByRightList.php?'.$url,0);
	}
	if($action=='del')
	{
		$id2=$_GET['id2'];
		if(!empty($id2))
		{
			$sql="select * from wiichat_user where user_id=".$id2."";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				$sql2="select * from wiichat_board where board_admin like'%".$row['user_account']."%'";
				$result2=mysql_query($sql2);
				if(mysql_num_rows($result2)>0)
				{
					alertInfo2('该用户和房主存在关联，请先删除相关联的房主信息。','chat_ByRightList.php?'.$url,0);
				}else{
					$sql3="delete from wiichat_user where user_id=".$id2."";
					if(mysql_query($sql3)){
						alertInfo2('删除成功!','chat_ByRightList.php?'.$url,0);
					}else{
						alertInfo2('删除失败!','chat_ByRightList.php?'.$url,0);
					}
				}
			}else{
				alertInfo2('删除失败，原因该用户不存在。','chat_ByRightList.php?'.$url,0);
			}
		}
	}
	if($action=="rmd"){
	$i=trim($_POST["i"]);
	if($i==0)
	{
		alertInfo2('当前没有需要保存的内容','chat_ByRightList.php?'.$url,0);
	}
	$i=checkData2($i,"11",0);
	for($x=1;$x<=$i;$x++){
		$tempId=$_POST["id".$x];
		$tempId=checkData2($tempId,'ID11',0);
		$tempRmd=$_POST["isRmd".$x];
		if($tempRmd=="on"){
			$tempRmd=1;
		}else{
			$tempRmd=0;
		}
		$sqlStrt="update wiichat_user set user_isVip=".$tempRmd." where user_id=".$tempId."";
		if(!mysql_query($sqlStrt)){
			alertInfo2('保存失败! 原因：SQL更新失败','chat_ByRightList.php?'.$url,0);
		}
	}	
	alertInfo2('保存成功!','chat_ByRightList.php?'.$url,0);
}
?>
	
