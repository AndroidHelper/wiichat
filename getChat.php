<?php
	require_once('inc/db_conn.php');
	require_once('inc/function.php');
	require_once('userCheck.php');
	$contents='';
	$recive=sqlReplace(trim($_GET['recive']));
	$url=$_GET['url'];
	$sql="select * from wiichat_user where user_account='".$recive."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	if($row)
	{
		$sql2="select * from wiichat_chat where (chat_sender='".$wiichatUser."' and chat_receiver='".$recive."') or (chat_sender='".$recive."' and chat_receiver='".$wiichatUser."')";
		$result2=mysql_query($sql2);
		$count=mysql_num_rows($result2);
		$pagesize=10;
		$pagecount=ceil($count/$pagesize);
		if(!empty($_GET['page']))
		{
			$page=trim($_GET['page']);
		}else{
			$page=1;
		}
		$starpage=($page-1)*$pagesize;
		$endpage=$pagesize;
		if($endpage<0)
		{
			$endpage=0;
		}
		$sql3="select * from wiichat_chat where (chat_sender='".$wiichatUser."' and chat_receiver='".$recive."') or (chat_sender='".$recive."' and chat_receiver='".$wiichatUser."') order by chat_time desc limit $starpage,$endpage";
		$result3=mysql_query($sql3);
		while($row3=mysql_fetch_assoc($result3))
		{
			$content=$row3['chat_content'];
			for($j=1;$j<16;$j++)
			{
				$content=str_replace(ImageEncode($j),ImageDecode(ImageEncode($j)),$content);
			}
			$contents.="<p class='red'>".$row3['chat_sender']." ".date('H:i:s',strtotime($row3['chat_time']))."</p> <p>".$content."</p>";
		}
		if(isset($count)&&$count>10)
		{
			$refresh=$_GET['refresh'];
			$refreshvalue=$_GET['refreshvalue'];
			$url=$url."&refresh=".$refresh."&"."refreshvalue=".$refreshvalue;
			$contents.=showPage2($url,$page,$pagesize,$count,$pagecount);
		}
	}
			
		echo $contents;
?> 