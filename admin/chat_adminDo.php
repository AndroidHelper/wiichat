<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
	$act=$_GET['act'];
	switch($act)
	{
		case 'del':
			$id=$_GET['id'];
			checkData($id,ID,1);
			$sql="select * from wiichat_user where user_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				if($row['user_board']=="|0|"||empty($row['user_board']))
				{
					$sql2="update wiichat_user set user_level='0' where user_level='2' and user_id=".$id;
				}else{
					$sql2="update wiichat_user set user_level='1' where user_level='2' and user_id=".$id;
				}
				if(mysql_query($sql2))
				{
					alertInfo2('聊天室管理员删除成功','chat_admin.php',0);
				}else{
					alertInfo2('聊天室管理员删除失败','',1);
				}
			}else{
				alertInfo2('您要删除的聊天室管理员不存在',"",1);
			}
			break;
		case 'add':
			$name=sqlReplace(trim($_POST['name']));
			checkData($name,'名称',1);
			$sql="select user_level from wiichat_user where user_account='".$name."'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				$sql2="update wiichat_user set user_level='2' where user_account='".$name."'";
				if(mysql_query($sql2))
				{
					alertInfo2('聊天室管理员添加成功','chat_admin.php',0);
				}else{
					alertInfo2('聊天室管理员添加失败，原因sql异常','',1);
				}
			}else{
				alertInfo2('该用户不存在','',1);
			}
			break;
		case 'delAll':
			$id_list=$_POST["id_list"];
			if(empty($id_list)){
				alertInfo('请选择删除项!',"chat_admin.php",0);
			}
			foreach($id_list as $val){
				$sql="select * from wiichat_user where user_id=".$val;
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if($row)
				{
					if($row['user_board']=="|0|"||empty($row['user_board']))
					{
						$sqlStr="update wiichat_user set user_level='0' where user_level='2' and user_id=".$val;
					}else{
						$sqlStr="update wiichat_user set user_level='1' where user_level='2' and user_id=".$val;
					}
					if(!mysql_query($sqlStr)){
						alertInfo("删除失败！原因：SQL语句删除失败！","chat_admin.php",0);
					}
				}
			}
			alertInfo('删除成功','chat_admin.php',0);
		break;
	}
?>
