<?php require_once("db_conn.php")?>
<?php
$name=sqlReplace(trim($_POST["name"]));
$pass=sqlReplace(trim($_POST["password"]));
$code=sqlReplace(trim($_POST["code"]));
if((empty($name)) || (empty($pass)) || (empty($code))){
	alertInfo2("账号不能为空","adminLogin.html",0);
	exit();
}
if($code!=$_SESSION["imgcode"]){
	alertInfo2("验证码错误","adminLogin.html",0);
	exit();
}

$sqlStr="select * from wiichat_admin where admin_account='".$name."' and admin_password='".md5($pass)."'";
$rs=mysql_query($sqlStr);
$row=mysql_fetch_assoc($rs);
	if(!$row){
		alertInfo2("账号或密码错误！","adminLogin.html",1); 	
	}else{
		$admin_count=$row['admin_loginCount']+1;
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="update wiichat_admin set admin_loginTime='".date('Y-m-d H:i:s')."',admin_loginIP='".$ip."',admin_loginCount='".$admin_count."' where admin_account='".$name."'";
		if(!mysql_query($sql))
		{
			alertInfo2("数据更新失败，请重新登录.",'adminLogin.html',0);
		}
		$_SESSION[WiiChat_ID."admin"]=$name;
		header("location:adminindex.php");
	}
?>