<?php session_start();require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 添加房间 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
  <script type="text/javascript">
	function show_1(type){
		switch(type){
			case "tag":
				document.getElementById('tag').style.display="none";
				break;
			case "log":
				document.getElementById('tag').style.display="";
				break;
		}
	}
  </script>
 </head>
 <body>
	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li class="l1"><a href="chat_board.php" target="mainFrame" >房间列表</a> </li>
				<li><a href="#">添加房间</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>添加房间</strong></span></div>
			<div class="header2"><span>添加房间</span></div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="chat_boardDo.php?act=add">
					<p>名称：<input class="in1" type="text" name="name" id="name"/>
								<span class="start">*</span>
					</p>
					<p>简介：<input name="desc" type="text" class="in1"/></p>
					<p>房主：<input name="admin" type="text" class="in1"/>（房主须为前台已注册的会员，多个房主用“|”隔开。注：如果添加vip房间，应以vip会员做为房主）</p>
					<p>类型：<input name="type" type="radio" value="4" onClick="show_1('tag')" />游客房间(注册会员跟游客都可以)<input name="type" type="radio" value="0" checked="checked" onClick="show_1('tag')" />普通房间 <input name="type" type="radio" value="1" onClick="show_1('tag')" />会员房间(只有注册会员才能进入) <input name="type" type="radio" value="2" onClick="show_1('tag')" />VIP房间(只有VIP会员才能进入) <input name="type" type="radio" value="3" onClick="show_1('tag')" />管理员房间(只有房主和管理员才能进入)<input name="type" type="radio" value="5" onClick="show_1('log')" />指定会员房间(只有指定会员才能进入)<input name="type" type="radio" value="6" onClick="show_1('tag')"/>直播房间(如果添加直播房间，应以聊天室管理员做为房主) </p>
					<div id="tag" style="display:none">
						<p>请输入指定会员帐号按"|"间隔：</p>
						<p class="txt"><textarea name="user" cols="50" rows="7"></textarea></p>
					</div>
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
								document.addForm.name.focus();
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
