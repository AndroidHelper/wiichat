<?php
	$sql="select * from wiichat_radio where radio_isExpired='1'";
	$result=mysql_query($sql);
	while($rows=mysql_fetch_assoc($result)){
		$date=date('Y-m-d H:i:s');
		if(strtotime($date)-strtotime($rows['radio_addTime'])>RADIOTIME*60)
		{
			$sql2="update wiichat_radio  set radio_isExpired='2' where radio_addTime='".$rows['radio_addTime']."'";
			mysql_query($sql2);
		}else{
			echo "<p class='red'>管理员广播：".$rows['radio_content']."</p>";
		}
	}
?>