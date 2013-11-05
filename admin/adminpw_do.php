<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<?php
	$pw=checkData2(trim($_POST["password"]),"原密码",1);
	$pw1=checkData2(trim($_POST["password1"]),"新密码",1);
	$pw2=checkData2(trim($_POST["password2"]),"新密码确认",1);
	if($pw1!=$pw2)
		alertInfo2("两次输入的密码不相同！","",1);
	//密码不小于6位
	if(strLen($pw1)<6) 
		alertInfo2("密码不小于6位！","",1);
	//判断原密码是否正确
	$sqlStr="select * from wiichat_admin where admin_account='".$_SESSION[WiiChat_ID."admin"]."' and admin_password='".md5($pw)."'";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_array($rs);
	if(!$row){
		alertInfo("原密码错误！","adminpw.php",0);
	}else{
		$row["admin_password"]=md5($pw2);
		$sql="update wiichat_admin set admin_password='".md5($pw2)."' where admin_account='".$_SESSION[WiiChat_ID."admin"]."'";
		if(mysql_query($sql)){
			alertInfo("修改密码成功，下次登陆生效！","adminpw.php",0);
		}else{
			alertInfo("修改密码失败！","adminpw.php",0);
		}			
	}
?>
 