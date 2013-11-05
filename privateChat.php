<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('userCheck.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?><?php require_once('configue.php')?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 私聊模式 </title>
  <script type='text/javascript' src="ajax2.js"></script>
    <script type="text/javascript">
		function th(s){
			document.getElementById('textare').value+=s;
		}
	</script>
 </head>
 <body>
	<?php
		$uid=sqlReplace(trim($_GET['uid']));
		$sql="select * from wiichat_privatechat where privateChat_sender='".$wiichatUser."' and privateChat_receiver!='".$uid."'";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if($row)
		{
			$sql="delete from wiichat_privatechat where privateChat_sender='".$wiichatUser."' and privateChat_receiver!='".$uid."'";
			mysql_query($sql);
			$sql="update wiichat_privatechat set privateChat_isChat='0' where privateChat_receiver='".$wiichatUser."'";
			mysql_query($sql);
		}
		$sql2="select * from wiichat_privatechat where privateChat_sender='".$wiichatUser."' and privateChat_receiver='".$uid."'";
		$result2=mysql_query($sql2);
		$row=mysql_fetch_assoc($result2);
		if(!$row)
		{
			$sql="insert into wiichat_privatechat (privateChat_sender,privateChat_receiver,privateChat_isChat) values ('".$wiichatUser."','".$uid."','0')";
			mysql_query($sql);
		}
		$sql4="select * from wiichat_privatechat where privateChat_receiver='".$uid."' and privateChat_sender!='".$wiichatUser."'";
		$result4=mysql_query($sql4);
		$row4=mysql_fetch_assoc($result4);
		$chat=$row4['privateChat_isChat'];
		if($chat==1)
		{
			$sql5="delete from wiichat_privatechat where privateChat_sender='".$wiichatUser."' and privateChat_receiver='".$uid."'";
			mysql_query($sql5);
			$sql6="delete from wiichat_chat where chat_sender='".$wiichatUser."'";
			mysql_query($sql6);
			echo "私聊中【<a href='index.php'>返回首页</a>】";
			exit;
		}
		$sql3="select * from wiichat_privatechat where privateChat_sender='".$uid."' and privateChat_receiver='".$wiichatUser."'";
		$result3=mysql_query($sql3);
		$row3=mysql_fetch_assoc($result3);
		if($row3)
		{
			if($row3['privateChat_isChat']!=1)
			{
				$sql4="update wiichat_privatechat set privateChat_isChat='1' where privateChat_sender='".$wiichatUser."' and privateChat_receiver='".$uid."'";
				mysql_query($sql4);
				$sql5="update wiichat_privatechat set privateChat_isChat='1' where privateChat_sender='".$uid."' and privateChat_receiver='".$wiichatUser."'";
				mysql_query($sql5);
			}
		}
		$sql6="select * from wiichat_privatechat where privateChat_sender='".$wiichatUser."'";
		$result6=mysql_query($sql6);
		$row6=mysql_fetch_assoc($result6);
	?>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> <a href="index.php">聊天室首页</a> &gt;&gt; 私聊</div>
		<div class="bz">聊天成员：<?php echo $wiichatUser."　".$uid;if($row6['privateChat_isChat']=="0")echo "未进入";?></div>
		<div class="clear"></div>
		<div class="box">
			<?php
			//自动刷新还是手动刷新
				$refreshvalue=10;
				if(isset($_GET['refreshvalue']))
				{
					$refreshvalue=trim($_GET['refreshvalue']);
				}
				$refresh=2;
				if(isset($_GET['refresh']))
				{
					$refresh=trim($_GET['refresh']);
				}
				if($refresh==1)
				{
					require_once('chatrefresh.php');
				}else{
					require_once('chatrefresh1.php');
				}
				//要显示的内容
				echo "<div class='clear'></div>";
				if($refresh==2){
					$sql="select * from wiichat_chat where (chat_sender='".$wiichatUser."' and chat_receiver='".$uid."') or (chat_sender='".$uid."' and chat_receiver='".$wiichatUser."')";
					$result=mysql_query($sql);
					$pagesize=10;
					$count=mysql_num_rows($result);
					$pagecount=ceil($count/$pagesize);
					if(isset($_GET['page']))
					{
						$page=sqlReplace(trim($_GET['page']));
					}else{
						$page=1;
					}
					$pagestart=($page-1)*$pagesize;
					$sql2="select * from wiichat_chat where (chat_sender='".$wiichatUser."' and chat_receiver='".$uid."') or (chat_sender='".$uid."' and chat_receiver='".$wiichatUser."') order by chat_time desc limit $pagestart,$pagesize";
					$result2=mysql_query($sql2);
					while($row2=mysql_fetch_assoc($result2))
					{
						echo "<p class='red'>".$row2['chat_sender']." ".date('H:i:s',strtotime($row2['chat_time']))."</p>";
						$content=$row2['chat_content'];
						if($express=='1')
						{
							for($j=1;$j<16;$j++)
							{
								$content=str_replace(ImageEncode($j),ImageDecode(ImageEncode($j)),$content);
							}
						}
						echo "<p>".$content."</p>";
					}
				if(isset($count)&&$count>10)
				{
					$url="privateChat.php?uid=".$uid."&"."refresh=".$refresh."&"."refreshvalue=".$refreshvalue;
					showPage1($url,$page,$pagesize,$count,$pagecount);
				}
				}else if($refresh==1)
				{
					if(!empty($_GET['page']))
					{
						$page=sqlReplace(trim($_GET['page']));
					}else{
						$page=1;
					}
			?>
				<input type='hidden' id='recive' value='<?php echo $uid;?>'/>
				<input type='hidden' id='url' value='privateChat.php?uid=<?php echo $uid ?>&amp;refresh=<?php echo $refresh?>&amp;refreshvalue=<?php echo $refreshvalue?>&amp;page=<?php echo $page?>'>
				<div id="contentlist"></div>
				<script type="text/javascript">
					getContent();
				</script>
			<?php
				}
				echo "<div class='clear'></div>";
			?>
			<form action="privateChat_do.php?act=send" method='post'>
				<p><textarea name="message" id="textare" rows='6' cols='30'></textarea></p>
				<p><input type='hidden' name='send' value="<?php echo $wiichatUser;?>"/><input type='hidden' name='receive' value="<?php echo $uid;?>"/><input type='hidden' name='refresh' value="<?php echo $refresh;?>"/><input type='hidden' name='refreshvalue' value="<?php echo $refreshvalue;?>"/><input type='hidden' name='page' value="<?php echo $page;?>"/><input type="submit" value="发言" name='submit'/>(限制70字)【<a href='privateChat_do.php?act=quit&amp;recive=<?php echo $uid?>&amp;send=<?php echo $wiichatUser?>'>退出</a>】</p>
			</form>
			<?php if($express=='1'){ ?>
				<script type='text/javascript'>
					document.write("<div id='experse'>");
				</script>
					<?php
						for($i=1;$i<15;$i++)
						{
					?>
					<script type='text/javascript'>
						document.write("<a href=\"#textare\" onClick=\"return th('<?php echo ImageEncode($i);?>')\" ><img src='images/expression/<?php echo $i;?>.gif'/></a>");
					</script>
					<?php
						}
						?>
					<script type='text/javascript'>
						document.write("</div>");
					</script>
				<?php
				}
			?>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>