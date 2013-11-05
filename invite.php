<?php
	//提示是否有人邀请私聊
	if(!empty($_SESSION[WiiChat_ID."wiichatUser"]))
	{
		$sql="select * from wiichat_privatechat where privateChat_receiver='".$_SESSION[WiiChat_ID."wiichatUser"]."'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_assoc($result))
			{
				echo "<p>".$row['privateChat_sender']."邀请私聊【<a href='privateChat.php?uid=".$row['privateChat_sender']."'>进入</a>】</p>";
			}
	}
					
?>
			