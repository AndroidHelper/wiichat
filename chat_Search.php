<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $siteName?>聊天室 </title>
 </head>
 <?php 
 $search=sqlReplace(trim($_GET['search']));
 if (empty($search)) die ("搜索关键词不能为空！<a href='index.php'>返回</a>");
 $sql1="select * from wiichat_online where online_user='".$search."'";
	$rs=mysql_query($sql1);
	$row=mysql_fetch_assoc($rs);
	if(!$row) die ("该用户不在任何房间！<a href='index.php'>返回</a>");
?>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"><?php echo $siteName?>聊天室&gt;&gt; <?php echo $bdName?></div>
		<div class="box">
			<?php require_once('userHandle.php'); ?>
			<h2>查询会员所在房间</h2>
			<div class="clear"></div>
			<p>会员名：<?php 
				echo GetModerator($row['online_user']);
			?></p>
			<div class="clear"></div>
			<p>会员所在房间：</p>
			<?php
				$sql2="select * from wiichat_online,wiichat_board where online_user='".$search."' and board_id=online_position";
				$rs2=mysql_query($sql2);
				$row2=mysql_fetch_assoc($rs2);
				echo $row2['board_name'];
				echo "<a href='room.php?bd=".$row2['board_id']."&amp;r=".rand()."'> 进入</a>";
			?>
		</div>
		<?php
			require_once('footer.php');
		?>
	</div>
 </body>
</html>