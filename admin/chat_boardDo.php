<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
	$act=sqlReplace(trim($_GET['act']));
	switch($act)
	{
		case 'add':
			$name=checkData2(trim($_POST["name"]),"名称",1);
			$desc=trim($_POST["desc"]);
			$admins=$_POST["admin"];
			$t=trim($_POST["type"]);
			$users=HTMLDecode(trim($_POST['user']));
			$boarduniqid=md5(uniqid(rand(),true)).".dat";
			If(!empty($admins)){
				$admin=explode("|",$admins);
				foreach($admin as $val){
					$sqlstr="select user_id from wiichat_user where user_account='".$val."'";
					$rs=mysql_query($sqlstr);
					$row=mysql_fetch_assoc($rs);
					If(!$row){
						alertInfo("房主不存在","chat_board.php",0);
						exit();
					}
				}
			}
			if(!empty($users)){
				$user=explode("|",$users);
				foreach($user as $vals){
					$sql1="select user_id from wiichat_user where user_account='".$vals."'";
					$rs1=mysql_query($sql1);
					$row=mysql_fetch_assoc($rs1);
					if(!$row){
						alertInfo("指定会员不存在","chat_boardAdd.php",0);
						exit();
					}
				}
			}
			$sqlStr="insert into wiichat_board(board_name,board_desc,board_admin,board_type,board_uniqid,board_users) values('".$name."','".$desc."','".$admins."','".$t."','".$boarduniqid."','".$users."')";
			mysql_query($sqlStr);
			$sql="select max(board_id) as topid from wiichat_board";
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			$topid=$row['topid'];
			If(!empty($admins)){
				$admin=explode("|",$admins);
				foreach($admin as $val){
					
					$sqlstr = "select user_board from wiichat_user where user_account='".$val."' limit 0,1";
					$rs=mysql_query($sqlstr);
					$row=mysql_fetch_assoc($rs);
					If($row){
						$user_board = $row["user_board"].$topid."|";
						$sql="update wiichat_user set user_board='".$user_board."' where user_account='".$val."'";
						mysql_query($sql);
					}
					//修改userLevel为1
					updateuserVip($val);
				}
			}
			alertInfo("添加成功！","chat_board.php",0);
			break;
		case 'delAll':
			$id_list=$_POST["id_list"];
			if(empty($id_list)){
				alertInfo('请选择删除项!',"chat_board.php",0);
				}
				foreach($id_list as $val){
					//删除对应版块的房主      
					$sqlstr = "select  user_board,user_account,user_level from wiichat_user where  user_board like '%".$val."|%'";
					$rs=mysql_query($sqlstr);
					$rows=mysql_num_rows($rs);
					If($rows){
						while($row=mysql_fetch_assoc($rs)){
							$user=$row["user_account"];
							$user_level=$row['user_level'];
							$user_board = str_replace($val."|","",$row["user_board"]);
							if(!empty($user_board)&&$user_board!="|0|")
							{
								$sql="update wiichat_user set user_board='".$user_board."' where user_account='".$user."'";
							}else{
								if($user_level!="2")
								{
									$sql="update wiichat_user set user_board='".$user_board."',user_level='0' where user_account='".$user."'";
								}else{
									$sql="update wiichat_user set user_board='".$user_board."' where user_account='".$user."'";
								}
							}
							mysql_query($sql);
							}
					}
					$sql2="select * from wiichat_board where board_id=".$val;
					$result2=mysql_query($sql2);
					$row2=mysql_fetch_assoc($result2);
					if(file_exists("../data/".$row2['board_uniqid']))
					{
						unlink("../data/".$row2['board_uniqid']);
					}
					$sql3='delete from wiichat_history where history_board='.$val;
					if(!mysql_query($sql3))
					{
						alertInfo2('房间删除失败，原因在删除房间历史记录是出错','',1);
					}
					$sqlStr="delete from wiichat_board where board_id=".$val."";
					mysql_query($sqlStr);
				}
				alertInfo2('房间删除成功','chat_board.php',0);
				break;
			case 'del':
				$id=$_GET['id'];
				checkData($id,'ID',0);
				$sqlstr = "select  user_board,user_account,user_level from wiichat_user where  user_board like '%".$id."|%'";
				$rs=mysql_query($sqlstr);
				$nums=mysql_num_rows($rs);
				If($nums>0){
					while($row=mysql_fetch_assoc($rs)){
						$user=$row["user_account"];
						$user_board = str_replace($id."|","",$row["user_board"]);
						$user_level=$row['user_level'];
						if(!empty($user_board)&&$user_board!="|0|")
						{
							$sql="update wiichat_user set user_board='".$user_board."' where user_account='".$user."'";
						}else{
							if($user_level!="2")
							{
								$sql="update wiichat_user set user_board='".$user_board."',user_level='0' where user_account='".$user."'";
							}else{
								$sql="update wiichat_user set user_board='".$user_board."' where user_account='".$user."'";
							}
						}
						mysql_query($sql);
					}
				}
				$sql2="select * from wiichat_board where board_id=".$id;
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_assoc($result2);
				if(file_exists("../data/".$row2['board_uniqid']))
				{
					unlink("../data/".$row2['board_uniqid']);
				}
				$sql3='delete from wiichat_history where history_board='.$id;
				if(!mysql_query($sql3))
				{
					alertInfo2('房间删除失败，原因在删除房间历史记录是出错','',1);
				}
				$sqlStr="delete from wiichat_board where board_id=".$id."";
				if(!mysql_query($sqlStr)){
					alertInfo2('房间删除失败，原因sql3异常','',1);
				}
				alertInfo2('房间删除成功','chat_board.php',0);
				break;
			case 'update':
				$id=(empty($_GET["id"]))?"":$_GET['id'];
				$id=checkData2($id,"ID",0);
				$name=checkData2(trim($_POST["name"]),"名称",1);
				$desc=trim($_POST["desc"]);
				$admins=trim($_POST["admin"]);
				$admins2=trim($_POST["admin2"]);
				$t=trim($_POST["type"]);
				$users=HTMLDecode(Trim($_POST['user']));
				$nadmin=explode("|",$admins);
				$yadmin=explode("|",$admins2);
				if(!empty($users)){
					$user=explode("|",$users);
					foreach($user as $vals){
						$sql1="select user_id from wiichat_user where user_account='".$vals."'";
						$rs1=mysql_query($sql1);
						$row=mysql_fetch_assoc($rs1);
						if(!$row){
							alertInfo2("指定会员不存在","",1);
						}
					}
				}
				If($admins!=$admins2){
					If(!empty($admins)){
						foreach($nadmin as $val){
							$sqlstr="select user_id from wiichat_user where user_account='".$val."'";
							$rs=mysql_query($sqlstr);
							$row=mysql_fetch_assoc($rs);
							If(!$row){
								alertInfo2("房主不存在","",1);
								exit();
							}
						}
					}
						for($i=0;$i<count($nadmin);$i++)
						{
							if(!in_array($nadmin[$i],$yadmin))
							{
								$sql="select * from wiichat_user where user_account='".$nadmin[$i]."'";
								$result=mysql_query($sql);
								$row=mysql_fetch_assoc($result);
								if($row)
								{
									$user_board=$row['user_board'];
									$user_nboard=$user_board.$id."|";
									$user_level=$row['user_level'];
									if($user_level!="2")
									{
										$sql2="update wiichat_user set user_board='".$user_nboard."',user_level='1' where user_account='".$nadmin[$i]."'";
									}else{
										$sql2="update wiichat_user set user_board='".$user_nboard."' where user_account='".$nadmin[$i]."'";
									}
									mysql_query($sql2);
								}
							}
						}
						for($i=0;$i<count($yadmin);$i++)
						{
							$sql="select * from wiichat_user where user_account='".$yadmin[$i]."'";
							$result=mysql_query($sql);
							$row=mysql_fetch_assoc($result);	
							if($row)
							{
								if(!in_array($yadmin[$i],$nadmin))
								{
									$user_board=$row['user_board'];
									$user_yboard = str_replace($id."|","",$user_board);
									$user_level=$row['user_level'];
									if(!empty($user_yboard)&&$user_yboard!="|0|")
									{
										$sql2="update wiichat_user set user_board='".$user_yboard."' where user_account='".$yadmin[$i]."'";
									}else{
										if($user_level!="2")
										{
											$sql2="update wiichat_user set user_board='".$yuser_board."',user_level='0' where user_account='".$yadmin[$i]."'";
										}else{
											$sql2="update wiichat_user set user_board='".$yuser_board."' where user_account='".$yadmin[$i]."'";
										}
									}
									mysql_query($sql2);
								}
							}
						}
				}
				$sqlStr="update wiichat_board set board_name='".$name."',board_desc='".$desc."',board_admin='".$admins."',board_type='".$t."',board_users='".$users."' where board_id=".$id."";
				mysql_query($sqlStr);
				alertInfo2("修改成功！","",1);
				break;
			case "import":
				$id=(empty($_GET["id"]))?"":$_GET['id'];
				$id=checkData2($id,"ID",0);
				$sql="select * from wiichat_board where board_id=".$id;
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if(!$row)
				{
					alertInfo2('更新失败，原因要更新的房间不存在','',1);
				}
				$file=$row['board_uniqid'];
				if(file_exists("../data/".$file))
				{
					$filecontent=file_get_contents("../data/".$file);
				}
				$file2=md5(uniqid(rand(),true)).".dat";
				$sql2="update wiichat_board set board_uniqid='".$file2."' where board_id=".$id;
				if(!mysql_query($sql2))
				{
					alertInfo2('更新失败，原因在创建新文件时出现错误','',1);
				}
				$date=date('Y-m-d H:i:s');
				$sql3="insert into wiichat_history (history_board,history_content,history_time) values ($id,'".$filecontent."','".$date."') ";
				if(mysql_query($sql3))
				{
					if(file_exists("../data/".$file))
					{
						unlink("../data/".$file);
					}
					alertInfo2('数据打包成功','chat_board.php',0);
				}else{
					alertInfo2('数据打包失败，原因sql出现异常','',1);
				}
		}
?>
