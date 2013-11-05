<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('api/ucenter.php');?>
<?php
	$id=sqlReplace($_GET["id"]);
	$key=sqlReplace($_GET["key"]);
	$bd=sqlReplace($_GET["bd"]);
	$uid=sqlReplace($_GET["uid"]);
	$url="&amp;key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid;
	$account=mbStrreplace(Trim($_POST["name"]));
	$pw1=sqlReplace(Trim($_POST["pw1"]));
	$pw2=sqlReplace(Trim($_POST["pw2"]));
	$phone=sqlReplace(Trim($_POST["phone"]));
	$email=sqlReplace(Trim($_POST["email"]));
	$sort=rand(1000,9999);

	$fbdStr="guest|admin|manager|root|administrator";

	If(strLen($account)<3 || strLen($account)>20){
		header("location:".$serverURL."/error.php?err=131&url=".$url);
		exit();
	}elseIf(strLen($pw1)<4){
		header("location:".$serverURL."/error.php?err=133&url=".$url);
		exit();
	}elseIf($pw1!=$pw2){
		header("location:".$serverURL."/error.php?err=132&url=".$url);
		exit();
	}elseIf(!preg_match("/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email)){
		header("location:".$serverURL."/error.php?err=134&url=".$url);
		exit();
	}elseIf(!preg_match("/^\d{11}$/", $phone)){
		header("location:".$serverURL."/error.php?err=135&url=".$url);
		exit();
	}elseIf(strpos($fbdStr,strtolower($account))>0){
		header("location:".$serverURL."/error.php?err=157&url=".$url);
		exit();
	}Else{
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql2="select max(user_regTime) as regtime from wiichat_user where user_ip='".$ip."'";
		$result2=mysql_query($sql2);
		$row2=mysql_fetch_assoc($result2);
		if($row2)
		{
			$data=date('Y-m-d H:i:s');
			$registetime=$row2['regtime'];
			if((strtotime($data)-strtotime($registetime))<2*60)
			{
				die("两分钟内不允许同一台计算机注册.<a href='index.php'>首页</a>");
			}
		}
		$sql1="select user_email from wiichat_user where user_email='$email'";
		$rs1=mysql_query($sql1);
		if(is_array(mysql_fetch_row($rs1))){
			header("location:".$serverURL."/error.php?err=205&url=".$url);
			exit();
		}
		if (!file_exists('ucenter_key.php')){
			$sqlstr="select user_id from wiichat_user where user_account='".$account."'";
			$rs=mysql_query($sqlstr);
			$row=mysql_fetch_array($rs);
			If(!$row){
				$sqlStr="insert into wiichat_user(user_account,user_password,user_mobile,user_email,user_regtime,user_level,user_board,user_sort,user_ip) values('".$account."','".md5(md5($pw2).$sort)."','".$phone."','".$email."','".date('Y-m-d H:i:s')."','0','|0|',".$sort.",'".$ip."')";
				if(mysql_query($sqlStr)){
					echo "注册成功！<br/><a href='userLogin.php?bd=".$bd."&amp;id=".$id."&amp;uid=".$uid."'>登陆</a>";
					exit();
				}else{
					echo "注册失败！原因SQL语句写入失败！<br/><a href='userLogin.php?bd=".$bd."&amp;id=".$id."&amp;uid=".$uid."'>登陆</a>";
					exit();
				}
			}Else{
				header("location:".$serverURL."/error.php?err=136&url=".$url);
				exit();
			}
		}else{
			$result=add_user($account, $pw1, $email, $phone);
			if($result==3){
				echo "注册成功！<br/><a href='userLogin.php?bd=".$bd."&amp;id=".$id."&amp;uid=".$uid."'>登陆</a>";
				exit();
			}elseif ($result==1){
				header("location:".$serverURL."/error.php?err=136&url=".$url);
				exit();
			}elseif ($result==2 || $result==4){
				echo "注册失败！原因SQL语句写入失败！<br/><a href='userLogin.php?bd=".$bd."&amp;id=".$id."&amp;uid=".$uid."'>登陆</a>";
				exit();
			}else{
				echo $result;
			}
		}
	}
?>