<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 网站设置 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <?php
	$sqlStr="select  * from wiichat_site limit 0,1";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	If(!$row){
		alertInfo("数据库初始化失败！","",0);
	}Else{
		$logo=$row["site_logo"];
		$name=$row["site_name"];
		$a_width=$row["site_width"];
		$a_count=$row["site_count"];
		$express=$row['site_express'];
	}
 ?>
 <body>
 	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li><a href="#" target="mainFrame" >基本设置</a> </li>
				<li class="l1"><a href="aboutSiteAdvance.php">高级设置</a> </li>
				<li class="l1"><a href="aboutSiteUC.php">UCenter设置</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>网站基本设置</strong></span></div>
			<div class="header2"><span>网站基本设置</span></div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="aboutSite_do.php?act=base">
					<?php if (!empty($pic)) echo "<img src='../".$pic."' alt=''/><br/>"?>
					<p>网站logo：<input type="text" class="in1" name="pic" value="<?php echo $logo?>"/> <a href="javascript:void(0);" onclick="javascript:window.open('PicUp.php','upfile','height=200,width=360,status=yes,toolbar=no,menubar=no,location=no')"><img src="images/Upload.gif" width="16" height="16" alt="上传" />点击上传</a></p>
					<p>网站名称：<input class="in1" name="name" value="<?php echo $name?>"/>
								<span class="start">*</span>
					</p>
					<p class="underline">网站宽度：<input type="radio" name="width" value="226" <?php If($a_width=="226")echo "checked"?>/> 标准宽度  <input type="radio" name="width" value="0" <?php If($a_width=="0") echo "checked"?>/> 自适应手机屏幕</p>
					<p class="underline">是否开启表情功能：<input type="radio" name="express" value="1" <?php If($express=="1")echo "checked"?>/> 是  <input type="radio" name="express" value="0" <?php If($express=="0") echo "checked"?>/> 否</p>
					<div class="btn">
						<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkIn();"/>
					</div>
					<script language="javascript">
						function checkspace(checkstr) {
						  var str = '';
						  for(i = 0; i < checkstr.length; i++) {
							str = str + ' ';
						  }
						  return (str == checkstr);
						}
						function checkIn(){
							if(checkspace(document.addForm.name.value)) {
								alert("网站名称不能为空");
								return false;
							}
						}
					</script>
				</form>
			</div>
		</div>
	</div>
 </body>
</html>
