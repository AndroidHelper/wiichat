<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
	$act=sqlReplace(trim($_GET['act']));
	switch($act)
	{
		case 'base':
			$name=checkData2(Trim($_POST["name"]),"网站名称",1);
			$pic=sqlReplace(Trim($_POST["pic"]));
			$a_width=sqlReplace(Trim($_POST["width"]));
			$express=sqlReplace(trim($_POST['express']));
			$sql="select * from wiichat_site limit 1";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(file_exists("../".$row['site_logo']))
			{
				@unlink("../".$row['site_logo']);
			}
			$sqlStr="update wiichat_site set site_name='".$name."',site_logo='".$pic."',site_width=".$a_width.",site_express='".$express."'";
			if(mysql_query($sqlStr)){
				alertInfo("网站基本设置成功！","aboutSite.php",0);
			}else{
				alertInfo("网站基本设置失败！","aboutSite.php",0);
			}
		break;
		case 'advance':
			$mSMTP=sqlReplace(Trim($_POST["smtp"]));
			$mAddress=sqlReplace(Trim($_POST["address"]));
			$mAccount=sqlReplace(Trim($_POST["account"]));
			$mPass=sqlReplace(Trim($_POST["password"]));
			$filter=HTMLEncode(trim($_POST['filter']));
			$timezone=sqlReplace(trim($_POST['timezone']));
			$sql="update wiichat_site set site_mailSMTP='".$mSMTP."',site_mailAddress='".$mAddress."',site_mailAccount='".$mAccount."',site_mailPassword='".$mPass."',site_filter='".$filter."',site_timezone='".$timezone."'";
			if(mysql_query($sql))
			{
				alertInfo('网站高级设置成功','aboutSiteAdvance.php',0);
			}else{
				alertInfo('网站高级设置失败','aboutSiteAdvance.php',0);
			}
			break;
		case 'ucenter':
			$uccode=trim($_POST['uccode']);
			$uccode=str_replace("\'","'",$uccode);
			$uccode=str_replace("\‘","'",$uccode);
			if(empty($uccode))
			{
				alertInfo2('UCenter代码不能为空','',1);
			}
			if(file_exists("../ucenter_key.php"))
			{
				@unlink("../ucenter_key.php");
			}
			$handle=fopen("../ucenter_key.php",'w+');
			$str="<?php ";
			$str.="\n";
			$str.=$uccode;
			$str.="\n";
			$str.=" ?>";
			fwrite($handle,$str);
			fclose($handle);
			alertInfo2('Ucenter配置成功','aboutSiteUC.php',0);
	}
	
?>