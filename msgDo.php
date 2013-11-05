<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?> <?php require_once('userCheck.php'); ?>
  <link rel="stylesheet" href="style.css" type="text/css"/>
<?php
if(isset($_GET['key']))
{
	$key=sqlReplace(Trim($_GET['key']))?"":$_GET['key'];
}else{
	$key="";
}
if(isset($_POST['receive']))
{
	$receive=sqlReplace(trim($_POST['receive']));
}
If(empty($wiichatUser)){
	header("location:".$serverURL."/error.php?err=143&amp;key=".$key."&amp;uid=".$receive."");
}
$act=sqlReplace(Trim($_GET["act"]));
switch($act){
	Case "send":
		sendmsg($serverURL);
		break;
	Case "del":
		delmsg($serverURL);
		break;
	Case "reply":
		replymsg($serverURL);
		break;
}

Function sendmsg($serverURL){
	$send_user=$_SESSION[WiiChat_ID."wiichatUser"];
	$Received_user=sqlReplace(Trim($_POST["receive"]));
	$title=sqlReplace(Trim($_POST["title"]));
	$content=HTMLEncode($_POST["content"]);
	If($Received_user==$send_user){
		echo "不能给自己发！<br/>【<a href='index.php'>回聊天室首页</a>】";
		exit();
	}
	If(!chekuser($Received_user)){
		header("location:".$serverURL."/error.php?err=207");
		exit();
	}
	If((strLen($title)<1) || (strLen($content)<1)){
		header("location:".$serverURL."/error.php?err=206");
		exit();
	}
	$sqlstr = "insert into wiichat_msg(msg_Send,msg_received,msg_title,msg_content,msg_side) values ('".$send_user."','".$Received_user."','".$title."','".$content."',0)";
	mysql_query($sqlstr);
	$sqlstr = "insert into wiichat_msg(msg_send,msg_received,msg_title,msg_content,msg_side) values ('".$send_user."','".$Received_user."','".$title."','".$content."',1)";
	mysql_query($sqlstr);
	
	@updateUserScore($_SESSION[WiiChat_ID."wiichatUser"],scoreUserTopic,"1");
	echo "发送成功！<br/>【<a href='userCenter.php'>返回用户中心</a>】<br/>【<a href='index.php'>回聊天室首页</a>】";
}

Function delmsg($serverURL){
    $rcode=rand();
	$id=sqlReplace(Trim($_GET["id"]));
	$key=sqlReplace(Trim($_GET["key"]));
	$page=sqlReplace(Trim($_GET["page"]));
	$sqlstr = "delete from wiichat_msg where msg_id=".$id;
	if(mysql_query($sqlstr)){
		echo "<p class='red'>删除成功！<br/>";
		echo "【<a href='msg_List.php?act=".$key."&amp;page=".$page."&amp;s=".$rcode."'>返回</a>】<br/>【<a href='index.php'>回聊天室首页</a>】</p>";
		exit();
	}else{
		echo "<p class='red'>删除失败！<br/>";
		echo "【<a href='msg_List.php?act=".$key."&amp;page=".$page."&amp;s=".$rcode."'>返回</a>】<br/>【<a href='index.php'>回聊天室首页</a>】</p>";
		exit();
	}
}

Function replymsg($serverURL){
	$send_user=$_SESSION[WiiChat_ID."wiichatUser"];
	$Received_user = sqlReplace(Trim($_GET["uid"]));
	$title = sqlReplace(Trim($_POST["title"]));
	$content = HTMLEncode($_POST["content"]);
	$id = sqlReplace(Trim($_GET["id"]));
	If($Received_user==$send_user){
		echo "不能给自己发！<br/>【<a href='index.php'>回聊天室首页</a>】";	
	}
	//检查收信人是否存在
	If(!chekuser($Received_user)){
		header("location:".$serverURL."/error.php?err=145");
	}
	If((strLen($title)<1) || (strLen($content)<1)){  
		header("location:".$serverURL."/error.php?err=201");
	}
	$sqlstr = "insert into wiichat_msg(msg_send,msg_received,msg_title,msg_content,msg_side) values ('".$send_user."','".$Received_user."','".$title."','".$content."',0)";
	mysql_query($sqlstr);
	$sqlstr = "insert into wiichat_msg(msg_send,msg_received,msg_title,msg_content,msg_side) values ('".$send_user."','".$Received_user."','".$title."','".$content."',1)";
	mysql_query($sqlstr);
	//修改已恢复
	updatereply($id);
	updateUserScore($_SESSION[WiiChat_ID."wiichatUser"],scoreUserTopic,1);
	echo "回复成功！<br/>【<a href='msg_List.php?act=receive'>返回</a>】<br/>【<a href='index.php'>回聊天室首页</a>】";
}

Function updatereply($id){
	$date=date('Y-m-d H:i:s');
	$sqlstr="update wiichat_msg set msg_isReply=1,msg_isReplyTime='".$date."' where msg_id=".$id;
	mysql_query($sqlstr);
}

Function chekuser($Received_user){
	$sqlstr="select * from wiichat_user where user_account='".$Received_user."'";
	$rs=mysql_query($sqlstr);
	$row=mysql_fetch_assoc($rs);
	//$count=$row['user_id'];
	If(!$row){
		$chekuser=False;
	}Else{
		$chekuser=True;	
	}
	return $chekuser;
}
?>