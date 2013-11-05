<?php session_start();require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 添加聊天室管理员 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li class="l1"><a href="chat_admin.php" target="mainFrame" >管理员列表</a> </li>
				<li><a href="#">添加管理员</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>添加聊天室管理员</strong></span></div>
			<div class="header2"><span>添加聊天室管理员</span></div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="chat_adminDo.php?act=add">
					<p>前台帐号：<input class="in1" type="text" name="name" id="name"/>
								<span class="start">*</span>
					</p>
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
								alert("名称不能为空");
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
