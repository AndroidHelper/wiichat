<?php
	require_once('inc/db_conn.php');
	require_once('inc/function.php');
	$act=sqlReplace(trim($_GET['act']));
	switch($act)
	{
		case 'send':
			$message=HTMLEncode(trim($_POST['message']));
			$sender=sqlReplace(trim($_POST['send']));
			$receive=sqlReplace(trim($_POST['receive']));
			$refresh=sqlReplace(trim($_POST['refresh']));
			$refreshvalue=sqlReplace(trim($_POST['refreshvalue']));
			$page=sqlReplace(trim($_POST['page']));
			if(empty($message))
			{
				echo "不能发送空消息.[<a href='privateChat.php?uid=".$receive."&amp;refresh=".$refresh.";&amp;page=".$page."'>返回</a>]";
				exit();
			}
			if(strlen($message)>70*3)
			{
				echo "消息内容不能超过70个汉字.[<a href='privateChat.php?uid=".$receive."&amp;refresh=".$refresh.";&amp;page=".$page."'>返回</a>]";
				exit();
			}
			$sql="select * from wiichat_user where user_account='".$sender."'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row)
			{
				echo "发送者不存在.[<a href='privateChat.php?uid=".$receive."&amp;refresh=".$refresh.";&amp;page=".$page."'>返回</a>]";
				exit();
			}
			$sql2="select * from wiichat_user where user_account='".$receive."'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if(!$row2)
			{
				echo "接收者不存在.[<a href='privateChat.php?uid=".$receive."&amp;refresh=".$refresh.";&amp;page=".$page."'>返回</a>]";
				exit();
			}
			$sql3="insert into wiichat_chat(chat_sender,chat_receiver,chat_content,chat_time) values ('".$sender."','".$receive."','".$message."','".date('Y-m-d H:i:s')."')";
			if(mysql_query($sql3))
			{
				header("location:".$serverURL."/privateChat.php?uid=".$receive."&refresh=".$refresh."&refreshvalue=".$refreshvalue);
			}else{
				echo "发送失败.[<a href='privateChat.php?uid=".$receive."&amp;refresh=".$refresh.";&amp;page=".$page."'>返回</a>]";
				exit();
			}
			break;
		case 'quit':
			$recive=sqlReplace(trim($_GET['recive']));
			$send=sqlReplace(trim($_GET['send']));
			$sql="select * from wiichat_privatechat where privateChat_sender='".$send."' and privateChat_receiver='".$recive."'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if($row)
			{
				if($row['privateChat_isChat']==1)
				{
					$sql2="update wiichat_privatechat set privateChat_isChat='0' where privateChat_sender='".$recive."' and privateChat_receiver='".$send."'";
					mysql_query($sql2);
				}
				$sql3="delete from wiichat_privatechat where privateChat_sender='".$send."' and privateChat_receiver='".$recive."'";
				mysql_query($sql3);
				header("location:".$serverURL."/index.php");
			}else{
				die("退出失败.【<a href='privateChat.php?uid=".$recive."'>返回</a>】");
			}
	}
?>