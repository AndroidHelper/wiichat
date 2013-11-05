<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php require_once('userCheck.php'); ?>
  <?php
	If(empty($wiichatUser)){
		header("location:".$serverURL."/error.php?err=143");
		exit();
    }

    $act=sqlReplace(Trim($_GET["act"]));
	If($act=="send"){
		$where ="msg_send ='".$wiichatUser."' and msg_side=0";
		$title ="用户中心 &gt;&gt; 发件箱";
		$title1="<a href='userCenter.php'>用户中心</a> &gt;&gt; 发件箱";
	}ElseIf($act=="receive"){
		$where ="msg_Received ='".$wiichatUser."' and msg_side=1";
		$title ="用户中心 &gt;&gt; 收件箱";
		$title1="<a href='userCenter.php'>用户中心</a> &gt;&gt; 收件箱";
	}ElseIf($act=="new"){
		$where ="msg_received ='".$wiichatUser."' and msg_side=1 and msg_isReader=0";
		$title ="用户中心 &gt;&gt; 未读信息";
		$title1="<a href='userCenter.php'>用户中心</a> &gt;&gt; 未读信息";
	}
  ?>
  <title> <?php echo $title?> </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h"><?php echo $title1?></div>
		<div class="box">
			<p><?php If(empty($wiichatUser)){
					echo "[<a href='userLogin.php'>登陆</a>] [<a href='userReg.php'>注册</a>]";
				}Else{
					echo "<span class='red'>".$wiichatUser."</span> [<a href='userCenter.php'>用户中心</a>] ";
				}?></p>
			<div class="clear"></div>
			<?php
				$sqlStr="select * from wiichat_msg where 1=1 and ".$where." order by msg_addTime desc";
				$rs=mysql_query($sqlStr);
				$rows=mysql_fetch_assoc($rs);
				If(!$rows){
					echo "<p>没有信息</p>";
				}else{
					$pagesize=15;
					$startRow=0;
					if (empty($_GET['page'])||!is_numeric($_GET['page']))
						$page=1;
					else{
						$page=$_GET['page'];
						$startRow=($page-1)*$pagesize;
					}
					$sqlStrT="select * from wiichat_msg where 1=1 and ".$where." order by msg_addTime desc";
					$sqlStr="select * from wiichat_msg where 1=1 and ".$where." order by msg_addTime desc limit $startRow,$pagesize";
					$rs = mysql_query($sqlStrT) or die ("查询失败，请检查SQL语句T。");
					$result = mysql_query($sqlStr) or die ("查询失败，请检查SQL语句。");
					$rscount=mysql_num_rows($rs);
					if ($rscount%$pagesize==0)
						$pagecount=$rscount/$pagesize;
					else
						$pagecount=ceil($rscount/$pagesize);
					while($row=mysql_fetch_assoc($result)){
						$time=$row['msg_addTime'];
						$time=substr($time,0,10);
			?>
			<p><img src="images/li.gif" alt="" width='11' height='11'/><a href="msgshow.php?id=<?php echo $row["msg_id"]?>&amp;act=<?php echo $act?>&amp;page=<?php echo $page?>"><?php echo $row["msg_title"]?></a>&nbsp;<span class="sp1"><?php echo $time?>
			<?php 
				If($act=="receive"){ 
					If(intval($row["msg_isReader"])==0){
						echo "未读"; 
					}Else{ 
						echo "已读"; 
					}
				}
			?></span>[<a href="msgDo.php?id=<?php echo $row["msg_id"]?>&amp;act=del&amp;key=<?php echo $act?>&amp;page=<?php echo $page?>">删</a>]</p>
			<p class="p1"></p>
			<?php
					}
				}			
			?>
			<p class="center">
			<?php
				if(!isset($pagecount))
				{
					$pagecount="";
				}
				If($pagecount>1){
					If($page>1) echo "<a href='msg_List.php?t=".$t."&amp;bd=".$bd."&amp;id=".$id."&amp;page=".($page-1)."&amp;act=".$act."'>&lt;上一页</a> ";
					If($page<$pagecount) echo "<a href='msg_List.php?t=".$t."&amp;bd=".$bd."&amp;id=".$id."&amp;page=".($page+1)."&amp;act=".$act."'>下一页&gt;</a>";
				}
			?>
			</p>
			<?php echo "<p class='center'>【<a href='userCenter.php'>返回</a>】</p>"?>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>