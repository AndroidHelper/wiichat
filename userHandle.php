	<p>
	<?php 
		if(empty($_SESSION[WiiChat_ID."wiichatUser"])){
			echo "[<a href='userLogin.php'>登陆</a>] [<a href='userReg.php'>注册</a>]";
		}else{
			echo "<span class='red'>".$_SESSION[WiiChat_ID."wiichatUser"]."</span> [<a href='userCenter.php'>用户中心</a>] [<a href='userQuit.php'>退出</a>]";
		}
	?>
	</p>