<script>setInterval("getContent()",<?php echo $refreshvalue*1000 ?>);</script> 
<p>自动刷新  <input type="radio" name="refresh" value="10" <?php if($refreshvalue==10){echo "checked";}?> onclick='check()'/>10秒<input type="radio" name="refresh" value="30" <?php if($refreshvalue==30){echo "checked";}?> onclick='check()'>30秒<input type="radio" name="refresh" value="60" <?php if($refreshvalue==60){echo "checked";}?> onclick='check()'/>60秒</p>
<p><a href='room.php?bd=<?php echo $bd?>&amp;r=<?php echo rand();?>&amp;refresh=2'>[设置为手动刷新]</a></p>
<div id="ni"></div>
<script language="javascript" type="text/javascript">
function check(){
	var allRadio = document.getElementsByName('refresh');
	for(var i = 0;i < allRadio.length;i++){
	   if(allRadio[i].checked){
		location.href='room.php?bd=<?php echo $bd?>&r=<?php echo rand();?>&refresh=1&refreshvalue='+allRadio[i].value;
		}
	}
}
</script>