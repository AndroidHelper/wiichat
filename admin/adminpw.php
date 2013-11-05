<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 个人信息修改 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：首页 －&gt;  <strong>修改密码</strong></span></div>
		<div class="header2"><span>个人信息</span></div>
		<div class="fromcontent">
			<form id="updatePWForm" name="updatePWForm" method="post" action="adminpw_do.php">
				<p>原密码：<input class="in1" type="password" name="password" id="password"/>
							<span class="start">*</span>
				</p>
				<p>新密码：<input  class="in1" type="password" name="password1" id="password1"/><span class="start"> * 不少于6位，请使用复杂密码，建议不要使用生日、信用卡号等作为密码。</span></p>
				<p>确　认：<input  class="in1" type="password" name="password2" id="password2"/><span class="start"> *</span></p>
				<div class="btn">
					<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkInput2();"/>
				</div>
				<script language="javascript">
					function checkspace(checkstr) {
						 var str = '';
						 for(i = 0; i < checkstr.length; i++) {
							str = str + ' ';
						  }
						  return (str == checkstr);
						}
					function checkInput2(){
					  if(checkspace(document.updatePWForm.password.value)) {
							document.updatePWForm.password.focus();
							alert("原密码不能为空");
							return false;
						}
						if(checkspace(document.updatePWForm.password1.value)) {
							document.updatePWForm.password1.focus();
							alert("新密码不能为空");
							return false;
						}
						if(checkspace(document.updatePWForm.password2.value)) {
							document.updatePWForm.password2.focus();
							alert("新密码确认不能为空");
							return false;
						}
						if(document.updatePWForm.password1.value.length<6){
							document.updatePWForm.password1.focus();
							document.updatePWForm.password1.value="";
							document.updatePWForm.password2.value="";
							alert("密码不能少于6位");
							return false;
						}
						if(document.updatePWForm.password1.value!=document.updatePWForm.password2.value) {
							document.updatePWForm.password1.value="";
							document.updatePWForm.password2.value="";
							document.updatePWForm.password1.focus();
							alert("两次密码不相同");
							return false;
						}
					}
				</script>
			</form>
		</div>
	</div>
 </body>
</html>
