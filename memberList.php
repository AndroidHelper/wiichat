<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('userCheck.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> 会员列表 </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> <a href="index.php">聊天室首页</a> &gt;&gt; 会员列表</div>
		<div class="box">
			<?php
				//更新会员能不能发言
				if(!empty($_GET['speak']))
				{
					$speak=sqlReplace(trim($_GET['speak']));
					checkData($spaek,'ID',0);
					$bd=sqlReplace(trim($_GET['bd']));
					checkData($bd,'ID',0);
					$onlineuser=sqlReplace(trim($_GET['onlineuser']));
					$sql="select * from wiichat_user where user_account='".$onlineuser."'";
					$result=mysql_query($sql);
					$row=mysql_fetch_assoc($result);
					if($row)
					{	
						if($speak==2)
						{
							$sql="insert into wiichat_mask values('".$onlineuser."',".$bd.",'".date('Y-m-d H:i:s')."')";
							mysql_query($sql);
						}else if($speak==1)
						{
							$sql="delete from wiichat_mask where mask_user='".$onlineuser."' and mask_room=".$bd;
							mysql_query($sql);
						}
					}else{
						die("用户不存在【<a href='index.php'>返回首页</a>】");
					}
				}
				$bd=sqlReplace(trim($_GET['bd']));
				checkData($bd,'ID',0);
				$url3=sqlReplace(trim($_GET['url3']));
				if(GetModerator($bdAdmin)!='暂无房主')
				{
					$bdamins=explode("|",$bdAdmin);
				}else{
					$bdamins=array();
				}
				$sql2="select * from wiichat_board where board_id=".$bd;
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_assoc($result2);
				if($row2)
				{
			?>
				<div><?php echo $row2['board_name']?>:在线会员列表</div>
				<div class='clear'></div>
			<?php
				}
				$sql="select * from wiichat_online where online_position=".$bd." and online_ip=''";
				$result=mysql_query($sql);
				$Count=mysql_num_rows($result);
				$Pagesize=10;
				$pagecount=ceil($Count/$Pagesize);
				if(!empty($_GET['page']))
				{
					$page=sqlReplace(trim($_GET['page']));
				}else{
					$page=1;
				}
				$sql2="select * from wiichat_online where online_position=".$bd." and online_ip='' order by online_id desc limit ".($page-1)*$Pagesize.",".$Pagesize;
				$result2=mysql_query($sql2);
				while($rows2=mysql_fetch_assoc($result2))
				{
					if(in_array($wiichatUser,$bdamins))
					{
						if(in_array($rows2['online_user'],$bdamins))
						{
							if($wiichatUser==$rows2['online_user'])
							{
								echo "<a href='user.php?id=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>".$rows2['online_user']."</a> ";
							}else{
								echo "<a href='user.php?id=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>".$rows2['online_user']."</a>【<a href='privateChat.php?uid=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>私聊</a>】 ";
							}
						}else{
							//判断是否屏蔽及解除
								echo "<a href='user.php?id=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>".$rows2['online_user']."</a>【<a href='privateChat.php?uid=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>私聊</a>】";
								$sql3="select * from wiichat_mask where mask_user='".$rows2['online_user']."' and mask_room=".$bd;
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								if($row3)
								{
									echo "【<a href='memberList.php?bd=".$bd."&speak=1&onlineuser=".$rows2['online_user']."&page=".$page."&url3=".urlencode($url3)."'>解除</a>】";
								}else{
									echo "【<a href='memberList.php?bd=".$bd."&speak=2&onlineuser=".$rows2['online_user']."&page=".$page."&url3=".urlencode($url3)."'>屏蔽</a>】";
								}
						}
					}else{
						if($wiichatUser==$rows2['online_user']||empty($wiichatUser))
						{
							echo "<a href='user.php?id=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>".$rows2['online_user']."</a> ";
						}else{
							echo "<a href='user.php?id=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>".$rows2['online_user']."</a>【<a href='privateChat.php?uid=".$rows2['online_user']."&amp;url=".urlencode(getUrl())."'>私聊</a>】 ";
						}
					}
				}
				if($Count>$Pagesize)
				{
					$url="memberList.php?bd=".$bd."&url3=".urlencode($url3);
					showPage1($url,$page,$Pagesize,$Count,$pagecount);
				}
			?>
			<div>
				<p class='center'>【<a href="<?php echo urldecode($url3);?>">返回</a>】</p>
			</div>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>