<?php require_once('inc/db_conn.php'); ?><?php  require_once('api/ucenter.php')?>
<?php
	if (!file_exists('ucenter_key.php')){
		$sql="select * from wiichat_online where online_user='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$sql2="delete from wiichat_online where online_user='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
			mysql_query($sql2);
		}
		$sql5="select * from wiichat_privatechat where privateChat_sender='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
		$result5=mysql_query($sql5);
		$row5=mysql_fetch_assoc($result5);
		if($row5)
		{
			$sql3="delete from wiichat_privatechat where privateChat_sender='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
			mysql_query($sql3);
			if($row5['privateChat_isChat']==1)
			{
				$sql5="update wiichat_privatechat set privateChat_isChat='0' where privateChat_receiver='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
				mysql_query($sql5);
			}
		}
		$_SESSION[WiiChat_ID."wiichatUser"]="";
		header("location:".$serverURL."/index.php");
		exit();
	}else{
		logout();
		$sql="select * from wiichat_online where online_user='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$sql2="delete from wiichat_online where online_user='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
			mysql_query($sql2);
		}
		$sql5="select * from wiichat_privatechat where privateChat_sender='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
		$result5=mysql_query($sql5);
		$row5=mysql_fetch_assoc($result5);
		if($row5)
		{
			$sql3="delete from wiichat_privatechat where privateChat_sender='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
			mysql_query($sql3);
			if($row5['privateChat_isChat']==1)
			{
				$sql5="update wiichat_privatechat set privateChat_isChat='0' where privateChat_receiver='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
				mysql_query($sql5);
			}
		}
		$_SESSION[WiiChat_ID."wiichatUser"]="";
		header("location:".$serverURL."/index.php");
		exit();
	}
?>