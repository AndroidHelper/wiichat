<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 聊天室统计 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
	 <?php
		if(isset($_GET['act']))
		{
			if(trim($_GET['act'])=='save')
			{
				$code=HTMLEncode(trim($_POST['code']));
				$sql="update wiichat_site set site_code='".$code."'";
				if(mysql_query($sql))
				{
					alertInfo2('第三方统计代码保存成功','chat_stat.php',0);
				}else{
					alertInfo2('第三方统计代码保存失败','chat_stat.php',0);
				}
			}
		}
		$sql2="select * from wiichat_site limit 1";
		$result2=mysql_query($sql2);
		$row2=mysql_fetch_assoc($result2);
		$code=HTMLDecode(trim($row2['site_code']));
	?>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：聊天室管理 －&gt; <strong>聊天室统计</strong></span></div>
		<div class="header2"><span>聊天室统计</span></div>
		<div class="fromcontent">
			<p><span class='red'>网站统计：(请将从第三方统计(例如：cnzz，51.la，google等)获得的统计代码复制到下面的框中。详细说明请见WiiChat官网)</span></p>
			<form action="chat_stat.php?act=save" method='post'>
				<p><textarea name="code" cols='60' rows='10'><?php echo $code;?></textarea></p>
				<div class="btn">
					<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交"/>
				</div>
			</form>
		</div>
	</div>
 </body>
</html>
