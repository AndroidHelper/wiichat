<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('userCheck.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?><?php require_once('configue.php')?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $bdName?> </title>
  <script type='text/javascript' src="ajax.js"></script>
    <script type="text/javascript">
		function th(s){
		document.getElementById('textare').value+=s;
		}
	</script>
 </head>
 <body>
 <?php
	//每刷新一次页面更新在线用户的时间
	if(empty($wiichatUser))
	{
		if(empty($_SESSION[WiiChat_ID."tourist"]))
		{
			$name="游客".rand(1,99999);
			$_SESSION[WiiChat_ID."tourist"]=$name;
		}else{
			$name=$_SESSION[WiiChat_ID."tourist"];
		}
		$sql="select * from wiichat_online where online_user='".$_SESSION[WiiChat_ID."tourist"]."'";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if(mysql_num_rows($result)>0)
		{
			$date=date('Y-m-d H:i:s');
			$sql2="update wiichat_online set online_position=".$bd.",online_time='".$date."' where online_user='".$_SESSION[WiiChat_ID."tourist"]."'";
			mysql_query($sql2)or die('失败1');
		}else{
			$ip=$_SERVER["REMOTE_ADDR"];
			$date=date('Y-m-d H:i:s');
			$sql3="insert into wiichat_online(online_user,online_position,online_time,online_ip) values ('".$_SESSION[WiiChat_ID."tourist"]."',".$bd.",'".$date."','".$ip."')";
			mysql_query($sql3)or die('失败2');
		}
	}else{
		$sql="select * from wiichat_online where online_user='".$wiichatUser."'";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if(mysql_num_rows($result)>0)
		{
			$date=date('Y-m-d H:i:s');
			$sql2="update wiichat_online set online_position=".$bd.",online_time='".$date."' where online_user='".$wiichatUser."'";
			mysql_query($sql2);
		}else{
			$date=date('Y-m-d H:i:s');
			$sql3="insert into wiichat_online(online_user,online_position,online_time) values ('".$wiichatUser."',".$bd.",'".$date."')";
			mysql_query($sql3);
		}
	}
	$sql8="select board_uniqid from wiichat_board where board_id=".$bd;
	$result8=mysql_query($sql8);
	$row8=mysql_fetch_assoc($result8);
	$filename="data/".$row8['board_uniqid'];
	//提交数据
	if(isset($_POST['message']))
	{
		$url = $_SERVER["HTTP_REFERER"];
		$url2=strstr($url,$serverURL);
		if(empty($url2))
		{
			//wait
			/*echo '<p>本站不允许外部提交</p>';
			exit;*/
		}
		$message=HTMLEncode(trim($_POST['message']));
		if(strlen($message)>140*3)
		{
		?>
		<p>发送的文字最多不超过140个汉字.<a href='room.php?bd=<?php echo $bd?>&amp;r=<?php echo rand();?>'>返回</a></p>
		<?php
			exit;
		}
		if(!empty($message))
		{
			if(!file_exists($filename))
			{
				$fp=fopen($filename,'x+');
			}else{
				$fp=fopen($filename,'a+');
			}
			$date=date('H:i');
			if(empty($wiichatUser))
			{
				if(empty($_SESSION[WiiChat_ID."tourist"]))
				{
					$name="游客".rand(1,99999);
					$_SESSION[WiiChat_ID."tourist"]=$name;
				}else{
					$name=$_SESSION[WiiChat_ID."tourist"];
				}
			}else {
				$name=$wiichatUser;
			}
			$filter1=str_replace("，",",",$filter);
			$filters=explode(",",$filter1);
			for($i=0;$i<count($filters);$i++)
			{
				$index=@strpos($message,$filters[$i]);
				if($index===0||$index>0)
				{
					$replace='';
					$countj=ceil(strlen($filters[$i])/3);
					for($j=0;$j<$countj;$j++)
					{
						$replace.="*";
					}
					$message=substr_replace($message,$replace,$index,strlen($filters[$i]));
				}
			}
			$filecontent="[".$date."]".$name.":".$message."\r\n";
			fwrite($fp,$filecontent);
			fclose($fp);
		}
	 }
	//删除在本房间内超时的用户
	$sql4="select * from wiichat_online where online_position=".$bd;
	$result4=mysql_query($sql4) or die('失败了');
	while($rows4=mysql_fetch_assoc($result4))
	{
		$date=strtotime(date('Y-m-d H:i:s'));
		$date1=strtotime($rows4['online_time']);
		if($date-$date1>1200){
			if(isset($_SESSION[WiiChat_ID."tourist"]))
			{
				if($rows4['online_user']==$_SESSION[WiiChat_ID."tourist"])
				{
					$_SESSION[WiiChat_ID."tourist"]="";
				}
			}
			$sql5="delete from wiichat_online where online_position=".$bd." and online_time='".$rows4['online_time']."'";
			mysql_query($sql5);
		}
	}
	//删除24小时内本房间不能聊天的用户
	$sql18="select * from wiichat_mask";
	$result18=mysql_query($sql18);
	while($rows18=mysql_fetch_assoc($result18))
	{
		$date=strtotime(date('Y-m-d H:i:s'));
		$date1=strtotime($rows18['mask_time']);
		if($date-$date1>24*60*60)
		{
			$sql="delete from wiichat_mask where mask_time='".$rows18['mask_time']."'";
			mysql_query($sql);
		}
	}
	?>	
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"> <a href="index.php">聊天室首页</a> &gt;&gt; <?php echo $bdName?></div>
		<div class="bz">房主:<span><?php echo GetModerator($bdAdmin)?></span></div>
		<div class="box">
			<?php require_once('userHandle2.php'); ?>
			<div class="clear"></div>
			<?php
				//提示是否有人邀请私聊
				require_once('invite.php');
				//统计在线的会员人数和游客人数
				$sql6="select * from wiichat_online  where online_position=".$bd." and online_ip=''";
				$result6=mysql_query($sql6);
				@$count1=mysql_num_rows($result6);
				$sql7="select * from wiichat_online  where online_position=".$bd." and online_ip!=''";
				$result7=mysql_query($sql7);
				@$count2=mysql_num_rows($result7);

				echo "当前在线：<a href='memberList.php?bd=".$bd."&amp;url3=".urlencode(getUrl())."'>".$count1." 会员</a> ".$count2." 游客";			
			?>
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
					require_once('refresh.php');
				}else{
					require_once('refresh1.php');
				}
			?>
			<div class="clear"></div>
			<?php
				if(!empty($_POST['forbid'])&&($_POST['forbid']!='游客名'))
				{
					$frobid=sqlReplace(trim($_POST['forbid']));
					$sql12="select * from wiichat_online where online_user='".$frobid."'";
					$result12=mysql_query($sql12);
					$row=mysql_fetch_assoc($result12);
					if($row)
					{
						$sql13="insert into wiichat_mask values('".$frobid."',".$bd.",'".date('Y-m-d H:i:s')."')";
						mysql_query($sql13);
					}
				}
				if(!empty($wiichatUser)&&(in_array($wiichatUser,explode("|",$bdAdmin))))
				{
				?>
				<form action='<?php echo getUrl()?>' method='post'>
					<input type='text' name='forbid' value='游客名' />
					<input type='submit' value='屏蔽' />
				</form>
				<div class="clear"></div>
				<?php
				}
			?>
			<?php
			//管理员广播
			require_once('radio_content.php');
			//手动刷新的时候读取文件内容带分页
				if($refresh==2)
				{
					if(file_exists($filename))
					{
						$lines=file($filename);
						$count=count($lines);
						$pagesize=10;
						$pagecount=ceil($count/$pagesize);
						if(isset($_GET['page']))
						{
							$page=sqlReplace(trim($_GET['page']));
						}else{
							$page=1;
						}
						$starpage=$count-($page-1)*$pagesize;
						$endpage=$count-$page*$pagesize;
						if($endpage<0)
						{
							$endpage=0;
						}
						for($i=$starpage-1;$i>=$endpage;$i--)
						{
							if(isset($lines[$i]))
							{
								$content=$lines[$i];
								if($express=='1')
								{
									for($j=1;$j<16;$j++)
									{
										$content=str_replace(ImageEncode($j),ImageDecode(ImageEncode($j)),$content);
									}
								}
							echo "<p>".$content."</p>";
							}
						}
					}
					if(isset($count)&&$count>10)
					{
						$url="room.php?bd=".$bd."&"."refresh=".$refresh."&"."refreshvalue=".$refreshvalue;
						showPage1($url,$page,$pagesize,$count,$pagecount);
					}
				}else if($refresh==1)//自动刷新的时候使用ajax技术得到带分页内容
				{
					if(!empty($_GET['page']))
					{
						$page=sqlReplace(trim($_GET['page']));
					}else{
						$page=1;
					}
					
			?>
				<input type='hidden' id='file' value='<?php echo $filename;?>'/>
				<input type='hidden' id='url' value='room.php?bd=<?php echo $bd ?>&amp;refresh=<?php echo $refresh?>&amp;refreshvalue=<?php echo $refreshvalue?>&amp;page=<?php echo $page?>'>
				<div id="contentlist"></div>
				<script type="text/javascript">
					getContent();
				</script>
			<?php
				}
			?>
			  <?php
			  If(!($bdType==0&&empty($wiichatUser))){
				  if(!empty($name))
				  {
					 $sql16="select * from wiichat_online where online_user='".$name."'";
					 $sql17="select * from wiichat_mask where mask_user='".$name."' and mask_room=".$bd;
				  }else{
					 $sql16="select * from wiichat_online where online_user='".$wiichatUser."'";
					  $sql17="select * from wiichat_mask where mask_user='".$wiichatUser."' and mask_room=".$bd;
				  }
				  $result16=mysql_query($sql16);
				  $rows16=mysql_fetch_assoc($result16);
				  if($rows16)
					{
					  echo "<div class='clear'></div>";
						$result17=mysql_query($sql17);
						$row17=mysql_fetch_assoc($result17);
						if(!$row17)
						{
							?>
							<?php if(!(($bdType=="6")&&($userLevel!="2"))) {?>
							<form action="room.php?bd=<?php echo $bd;?>&amp;refresh=<?php echo $refresh?>&amp;refreshvalue=<?php echo $refreshvalue;?>" method='post'>
								<p><textarea name="message" id="textare" rows='6' cols='30'></textarea></p>
								<p><input type="submit" value="发言"/>(限制140字)</p>
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
							}
						}else{
							echo "<p>您已被房主禁止发言</p>";
						}
					}
				?>
				<?php
					$sql10="select * from wiichat_board where board_id!=".$bd;
					$result10=mysql_query($sql10);
					if(mysql_num_rows($result10)>0)
					{
				?>
						<form action="room.php" method="get" class="fo1">
						转到：<select name="bd">
							<?php
								$sql9="select * from wiichat_board where board_id!=".$bd;
								$rs=mysql_query($sql9);
								while($row9=mysql_fetch_assoc($rs)){
									echo "<option value='".$row9['board_id']."'";
									echo">".$row9['board_name']."</option>";
								}
							?>
							</select> <input inputmode="user predictOn" type="submit" value="跳"/>
						</form>
				<?php
					}
				}
			  ?>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>