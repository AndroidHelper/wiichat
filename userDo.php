<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('inc/mail.inc.php'); ?>
<?php require_once 'api/ucenter.php'; ?>
<?php
	function password($length=10){
		$str="0123456789";
		$result="";
		for($i=0;$i<$length;$i++){
			$num=rand(0,9);
			$result.=$str[$num];
		}
		return $result;
	}
$action=$_GET["act"];
switch($action){
	case "pw":
		$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
		If(empty($wiichatUser)){
			 header("location:".$serverURL."/error.php?err=143");
			 exit();
		}
		$pw=sqlReplace(Trim($_POST["pw"]));
		$pw1=sqlReplace(Trim($_POST["pw1"]));
		$pw2=sqlReplace(Trim($_POST["pw2"]));

		if((strLen($pw)<1) || (strLen($pw1)<1) || (strLen($pw2)<1)){
			header("location:".$serverURL."/error.php?err=148");
			exit();
		}elseIf($pw1!=$pw2){
			header("location:".$serverURL."/error.php?err=149");
			exit();
		}elseif(strLen($pw2)<4){
			header("location:".$serverURL."/error.php?err=150");
			exit();
		}Else{
			$sql2="select * from wiichat_user where user_account='".$wiichatUser."'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if($row2)
			{
				$sort=$row2['user_sort'];
			}
			$sqlStr="select * from wiichat_user where user_account='".$wiichatUser."' and user_password='".md5(md5($pw).$sort)."'";
			$rs=mysql_query($sqlStr);
			$row=mysql_fetch_assoc($rs);
				if(!$row){
					header("location:".$serverURL."/error.php?err=151");
					exit();
				}else{
					if (!file_exists('ucenter_key.php')){
						$rand=rand(1000,9999);
						$sql="update wiichat_user set user_password='".md5(md5($pw2).$rand)."',user_sort=".$rand." where user_account='".$wiichatUser."'";
						if(mysql_query($sql)){
							$_SESSION[WiiChat_ID."wiichatUser"]="";
							echo "修改成功！<br/>【<a href='userLogin.php'>重新登陆</a>】";
							exit();
						}else{
							echo "修改失败！<br/>【<a href='userPassword.php'>重新修改</a>】";
							exit();
						}
					}else{
						$cfg =array('username'=>$row['user_account'], 'password'=>$pw1, 'old_password'=>$pw);
						 $result=edit_user($cfg,0);
						 
						 if ($result==3){
							$_SESSION[WiiChat_ID."wiichatUser"]="";
							echo "修改成功！<br/>【<a href='userLogin.php'>重新登陆</a>】";
							exit();
						 }elseif ($result==4){
							echo "修改失败！<br/>【<a href='userPassword.php'>重新修改</a>】";
							exit();
						 }
					}
				}
		}
		break;
	case "edit":
		$wiichatUser=$_SESSION[WiiChat_ID."wiichatUser"];
		If(empty($wiichatUser)){
			 header("location:".$serverURL."/error.php?err=143");
			 exit();
		}
		$mobile=sqlReplace(Trim($_POST["m"]));
		$email=sqlReplace(Trim($_POST["mail"]));
		$email2=sqlReplace(trim($_POST['mail2']));
		If(!preg_match("/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email)){
			header("location:".$serverURL."/error.php?err=153");
			exit();
		}ElseIf(!preg_match("/^\d{11}$/", $mobile)){
			header("location:".$serverURL."/error.php?err=154");
			exit();
		}Else{
			if (!file_exists('ucenter_key.php')){
				$sqlstr="update wiichat_user set user_email='".$email."',user_mobile='".$mobile."' where user_account='".$wiichatUser."'";
				if(mysql_query($sqlstr)){
					echo "修改成功！<br/>【<a href='userCenter.php'>返回</a>】";
					exit();
				}else{
					echo "修改失败！<br/>【<a href='userCenter.php'>返回</a>】";
					exit();
				}
			}else{
				$cfg =array('email'=>$email, 'username'=>$wiichatUser, 'mobile'=>$mobile,'email2'=>$email2);
				$result=edit_user($cfg);
				 if ($result==1){
					echo "修改成功！<br/>【<a href='userCenter.php'>返回</a>】";
					exit();
					}elseif ($result==2){
					echo "修改失败！<br/>【<a href='userCenter.php'>返回</a>】";
					exit();
				 }
			}
		}
		break;
	case "getPW":
		$account=sqlReplace(Trim($_POST["ac"]));
		$mobile=sqlReplace(Trim($_POST["m"]));
		$email=sqlReplace(Trim($_POST["mail"]));
		$sqlStr="select * from wiichat_user where user_account='".$account."' and user_mobile='".$mobile."' and user_email='".$email."'";
		$rs=mysql_query($sqlStr);
		$row=mysql_fetch_assoc($rs);
		if(!$row){
			header("location:".$serverURL."/error.php?err=156");
			exit();
		}else{
			$newPw=password($length=10);
			$rand=rand(1000,9999);
			$md5Pw=md5(md5($newPw).$rand);
			$row['user_password']=$md5Pw;
			if (!file_exists('ucenter_key.php')){
				$sqlt="update wiichat_user set user_password='".$md5Pw."',user_sort=".$rand." where user_account='".$account."'";
				mysql_query($sqlt);
			}else{
				$cfg =array('username'=>$account, 'password'=>$newPw, 'old_password'=>'');
				 $result=edit_user($cfg,1);	
			}
			if (!empty($mailPassword)){
				$mailcontent="您在".$siteName."的新密码是：".$newPw;
				$smtp=new smtp($mailSMTP,25,true,$mailAccount,$mailPassword,$mailAddress);
				$subject="您在".$siteName."的新密码";
				$body=$mailcontent;
				$mailtype='HTML';
				$send=$smtp->sendmail($email,$mailAddress,$subject,$body,$mailtype);	
			}
			echo "获取密码成功！新的密码已经发送到您的注册邮箱！<br/><a href='userLogin.php'>返回</a>";
		}
		break;
}
?>