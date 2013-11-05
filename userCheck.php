<?php
require_once('inc/config.php');
  $bd=(empty($_GET["bd"])?0:$_GET["bd"]);
  $bd=checkData($bd,"",0);
  If($bd>0){
	  $sqlStr="select * from wiichat_board where board_id=".$bd."";
	  $rs=mysql_query($sqlStr);
	  $row=mysql_fetch_assoc($rs);
	  if(!$row){
		alertInfo("房间不存在或已被删除！","index.php",1);
		exit();
	  }Else{
		$bdName=$row["board_name"];
		$bdDesc=$row["board_desc"];
		$bdType=$row["board_type"];
		$bdAdmin=$row["board_admin"];
		$bdUsers=explode("|",$row["board_users"]);
	  }
  }
  if(isset($_SESSION[WiiChat_ID."wiichatUser"]))
  {
	$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
  }else{
	 $wiichatUser="";
  }
  If(!empty($wiichatUser)){
		$sqlStr="select user_isVip,user_level from wiichat_user where user_account='".$wiichatUser."'";
		$rs=mysql_query($sqlStr);
		$row=mysql_fetch_assoc($rs);
		$userVip=$row["user_isVip"];
		$userLevel=$row["user_level"];
  }
  If($bd>0){
	  If($bdType!="0" && $bdType!="6"){
		If(empty($wiichatUser)){
			If($bdType!=4){
				header("location:".$serverURL."/error.php?err=139");
				exit();
				}
			}Else{
				if(($bdType=="2") && ($userVip=="0")){
					header("location:".$serverURL."/error.php?err=140");
					exit();
				}
				If(($bdType=="3") && ($userLevel<"1")){
					header("location:".$serverURL."/error.php?err=141");
					exit();
				}
				$sql="select * from wiichat_board where board_id=".$bd;
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if(!empty($row['board_admin'])){
					$wiichat_admin=explode("|",$row['board_admin']);
				}else{
					$wiichat_admin="";
				}
				if(!in_array($wiichatUser,$bdUsers) && $bdType=="5"){
					if(!in_array($wiichatUser,$wiichat_admin)){
					header("location:".$serverURL."/error.php?err=204");
					exit();
					}
				}
			}
	  }
  }
?>