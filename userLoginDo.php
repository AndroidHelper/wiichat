<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('api/ucenter.php')?>
<?php
$id=sqlReplace($_GET["id"]);
$key=strtolower(sqlReplace($_GET["key"]));
$bd=sqlReplace(empty($_GET["bd"])?"":$_GET["bd"]);
$uid=sqlReplace($_GET["uid"]);
$ac=sqlReplace(Trim($_POST["name"]));
$pass=sqlReplace(Trim($_POST["pass"]));
if (!file_exists('ucenter_key.php')){
	$sql2="select * from wiichat_user where user_account='".$ac."'";
	$result2=mysql_query($sql2);
	$row2=mysql_fetch_assoc($result2);
	if($row2)
	{
		$sort=$row2['user_sort'];
	}else{
		header("location:".$serverURL."/error.php?err=137&id=".$id."&key=".$key."&bd=".$bd."&uid=".$uid."");
		exit();
	}
	$sqlStr="select * from wiichat_user where user_account='".$ac."' and user_password='".md5(md5($pass).$sort)."'";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	if(!$row){
		header("location:".$serverURL."/error.php?err=137&id=".$id."&key=".$key."&bd=".$bd."&uid=".$uid."");
		exit();
	}else{
		$_SESSION[WiiChat_ID."wiichatUser"]=$ac;
		$_SESSION[WiiChat_ID."wiichatUserId"]=$row['user_id'];
		$sql="update wiichat_user set user_lastLogin='".date('Y-m-d H:i:s')."',user_loginCount=user_loginCount+1 where user_account='".$ac."'";
		mysql_query($sql);

		updateUserScore($ac,scoreUserLogin,"1");
		If($key=="post"){
			header("location:".$serverURL."/room.php?bd=".$bd."&rnd=".rand()."");
			exit();
		}Else{
			header("location:".$serverURL."/index.php");
			exit();
		} 
	}
}else{
	$result=login($ac, $pass);
	$sql="select * from wiichat_user where user_account='".$ac."'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	if($row)
	{
		$result2=login($ac,md5(md5($pass).$row['user_sort']));
	}
	if($result2==3)
	{
		$result=3;
	}
	switch($result){
		case 1:
			header("location:".$serverURL."/error.php?err=137&id=".$id."&key=".$key."&bd=".$bd."&uid=".$uid."");
			exit();
			break;
		case 2:
			header("location:".$serverURL."/error.php?err=137&id=".$id."&key=".$key."&bd=".$bd."&uid=".$uid."");
			exit();
			break;
		case 3:
			$_SESSION[WiiChat_ID."wiichatUser"]=$ac;
			$sql="update wiichat_user set user_lastLogin='".date('Y-m-d H:i:s')."',user_loginCount=user_loginCount+1 where user_account='".$ac."'";
			mysql_query($sql);
			If($key=="post"){
				header("location:".$serverURL."/room.php?bd=".$bd."&rnd=".rand()."");
				exit();
			}Else{
				header("location:".$serverURL."/index.php");
				exit();
			} 
			break;
		default:
			echo $result;	
	}
}
?>