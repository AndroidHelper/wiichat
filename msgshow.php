<?php require_once('inc/db_conn.php'); ?><?php require_once('inc/function.php'); ?><?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <?php require_once('userCheck.php'); ?>
  <?php
	$id=sqlReplace(Trim($_GET["id"]));
	$act = sqlReplace(Trim($_GET["act"]));
	$page = sqlReplace(Trim($_GET["page"]));
	If(empty($page)) $page=1;
	$id=intval($id);
	$url="id=".$id."&amp;act=".$act;
	$sqlStr="select * from wiichat_msg where msg_id=".$id;
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	If(!$row){
		header("location:".$serverURL."/error.php?err=200");
		exit();
	}Else{
		$title=$row["msg_title"];
		$content=$row["msg_content"];
		$addTime=$row["msg_addTime"];
		$msg_Send=$row["msg_send"];
		$MSG_Received=$row["msg_received"];
		$date=date('Y-m-d H:i:s');
		$sql="update wiichat_msg set msg_isReader=1,msg_isReaderTime='".$date."' where msg_id=".$id;
		mysql_query($sql);
	}
 ?>
  <title> <?php echo $title?> </title>
 </head>
 <body>
	<div id="container" class="<?php echo $style; ?>">	
		<?php require_once('header.php'); ?>
		<div class="h">信息详情 </div>
		<div class="box">
			<h2><?php echo $title?></h2>
			<p><?php If($act=="send"){?>收信人：<?php echo $MSG_Received?><?php }?><?php If($act=="receive"){?>写信人：<?php echo $msg_Send?> [<a href="msg_replay.php?to=<?php echo $msg_Send?>&amp;id=<?php echo $id?>">回复</a>]<?php }?> [<a href="msgDo.php?id=<?php echo $id?>&amp;act=del&amp;key=<?php echo $act?>&amp;page=<?php echo $page?>">删除</a>]</p>
			<div class="clear"></div>
         <?php 
			mb_internal_encoding("UTF-8");
			if(isset($_GET["all"]))
			{
				$all=sqlReplace(Trim($_GET["all"]));
			}else{
				$all='';
			}
			$logtextx=$content;
			$logtextx=strip_tags($logtextx);
			//开始分页  
			if(!empty($_REQUEST["Page"]))  $page=intval($_REQUEST["Page"]); 
			$PageLength=300;
			$CLength=mb_strLen($logtextx);
			//$str=cutstr($logtextx,$CLength);
			$pagecount=(intval($CLength/$PageLength))+1; 
			
			if(($page<1) || (is_null($page))) $page=1; 
			if($page>$pagecount) $Page=$pagecount; 
			if($page==1){
				$a=0; 
			}elseif($page>1){ 
				$a=($page-1)*$PageLength; 
			}
			
			If($all=="all"){
				$wen=mb_substr($logtextx,$a);
			}Else{
				$wen=mb_substr($logtextx,$a,$PageLength); 
			} 
			echo "<p>".$wen."</p>"; 
			echo "<p>"; 
			If($pagecount>1){
				if(($page-1)>0){
					echo " <a href='msgshow.php?".$url."&amp;page=".($page-1)."'>[上页]</a>";
				}else{
					echo " [上页] ";
				}
				if(($page+1)<=$pagecount){
					echo " <a href='msgshow.php?".$url."&amp;page=".($page+1)."'>[下页]</a>";
				}else{
					echo " [下页] ";
				}
				If(($pagecount>=2) && ($pagecount<=5)){
					If($pagecount==$page){
						echo " [剩余全文]";
					}else{
						echo " <a href='msgshow.php?".$url."&amp;page=".($page+1)."&amp;all=all'>[剩余全文]</a>";
					} 
				}
				echo "<p>";
					For($i=1;$i<=$pagecount;$i++){
						If($i==$page){
							echo "[".$i."]";
						}Else{
							echo " [<a href='msgshow.php?".$url."&amp;page=".$i."'>".$i."</a>] ";
					} 
				}
				echo "</p>";
			}
			echo "</p>"; 
			echo "<p class='center'>【<a href='msg_List.php?act=".$act."'>返回</a>】</p>"; 
        ?>
		</div>
		<?php require_once('footer.php'); ?>
	</div>
 </body>
</html>