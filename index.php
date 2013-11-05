<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $siteName?>聊天室 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"><?php echo $siteName?>聊天室</div>
		<div class="box">
			<?php require_once('userHandle.php'); ?>
			<h2>房间</h2>
			<div class="clear"></div>
			<?php require_once('invite.php');?>
			<?php
				$sqlStr="select * from wiichat_board order by board_order asc,board_id desc";
				$rs=mysql_query($sqlStr);
				while($row=mysql_fetch_assoc($rs)){
					echo "【<a href='room.php?bd=".$row['board_id']."&amp;r=".rand()."'>";
					$sql2="select count(*) as count from wiichat_online where online_position=".$row['board_id'];
					$result2=mysql_query($sql2);
					$row2=mysql_fetch_assoc($result2);
					echo $row["board_name"];
					echo "</a>】(在线：".$row2['count']."人)<br/>";
				}
			?>
			<h2>查询会员所在房间</h2>
			<div class="clear"></div>
			<form action='chat_Search.php' method='get'>
				<div><input inputmode="user predictOn" type='text' name='search' value='会员名'/>
				<input inputmode="user predictOn" type='submit' value='查询'/></div>
			</form>
		</div>
		<?php
			require_once('footer.php');
		?>
	</div>
 </body>
</html>