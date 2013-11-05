<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
	$act=sqlReplace(trim($_GET['act']));
	switch($act)
	{
		case 'add':
			$content=HTMLEncode(trim($_POST['content']));
			if(empty($content))
			{
				alertInfo2('广播内容不能为空','',1);
			}
			if(strlen($content)>140*3)
			{
				alertInfo2('广播内容不能超过140个字','',1);
			}
			$date=date('Y-m-d H:i:s');
			$sql="insert into wiichat_radio(radio_content,radio_addTime,radio_sender,radio_isExpired) values ('".$content."','".$date."','".$_SESSION[WiiChat_ID.'admin']."','1')";
			if(mysql_query($sql))
			{
				alertInfo2('发表广播成功','admin_radio.php',0);
			}else{
				alertInfo2('发表广播失败，请重新发布','',1);	
			}
			break;
		case 'del':
			$id=sqlReplace(trim($_GET['id']));
			checkData2($id,'ID',0);
			$sql="select * from wiichat_radio where radio_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				$sql2="delete from wiichat_radio where radio_id=".$id;
				if(mysql_query($sql2))
				{
					alertInfo2("广播删除成功",'admin_radio.php',0);
				}else{
					alertInfo2("广播删除失败，原因sql异常",'',1);
				}
			}else{
				alertInfo2('删除广播失败，原因广播不存在','',1);
			}
	}
?>