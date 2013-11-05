<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 管理员广播 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
    <div class="bgintor">
		<div class="tit1">
			<ul>
				<li class="l1"><a href="admin_radio.php" target="mainFrame" >广播列表</a> </li>
				<li><a href="#">添加广播</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>添加广播</strong></span></div>
			<div class="header2"><span>添加广播</span></div>
			<div class="fromcontent">
				<form action="admin_radioDo.php?act=add" method='post'>
					<p><span class='start'>提示：广播内容不能超过140字</span></p>
					<p>广播内容：</p>
					<p><textarea name="content" cols='50' rows='5' id='content'></textarea></p>
					<div class="btn">
						<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onclick="return check();"/>
					</div>
					<script type='text/javascript'>
						function check()
						{
							if(document.getElementById('content').value=="")
							{
								alert('广播内容不能为空');
								document.getElementById('content').focus();
								return false;
							}
							return true;
						}
					</script>
				</form>
			</div>
		</div>
	</div>
 </body>
</html>
