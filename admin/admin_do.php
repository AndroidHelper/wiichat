<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
$action=trim($_GET["action"]);
$action=checkData2($action,"关键参数",1);

//添加管理员
if($action=="add"){
	$name=checkData2(trim($_POST["account"]),"管理员账号",1);
	$pass=checkData2(trim($_POST["password"]),"管理员密码",1);
	if(strLen($pass)<6)  
		alertInfo2("密码不小于6位！","admin_view.php",0);
		$pass=md5($pass);
		//判断账号是否存在
		$sqlStr="select * from wiichat_admin where admin_account='".$name."'";
		$rs=mysql_query($sqlStr);
		$row=mysql_fetch_assoc($rs);
		if(!$row){
			$sqlStr="insert into wiichat_admin(admin_account,admin_password) values('".$name."','".$pass."')";
			if(mysql_query($sqlStr)){
				alertInfo2("添加成功！","adminList.php",0);
			}else{
				alertInfo2("添加失败！原因：SQL语句写入失败！","adminList.php",0);
			}
		}else{
			alertInfo2("该帐号已经存在！","adminList.php",0);
		}
}
//删除管理员
if($action=="del"){
	$name=checkData2(trim($_GET["id"]),"管理员账号",1);	
	//当前管理员不能被删除
	if($name!=$_SESSION[WiiChat_ID."admin"]){	
		$sqlStr="delete from wiichat_admin where admin_account='".$name."'";
		if(mysql_query($sqlStr)){
			alertInfo2("删除成功！","adminList.php",0);
		}else{
			alertInfo2("删除失败！原因：SQL语句写入失败！","adminList.php",0);
		}
	}
}
?>