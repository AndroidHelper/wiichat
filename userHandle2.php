				<p><?php If(empty($wiichatUser)){
					echo "[<a href='userLogin.php?bd=".$bd."&amp;key=post'>登陆</a>] [<a href='userReg.php?bd=".$bd."'>免费注册</a>]";
				}Else{
					echo "<span class='red'>".$wiichatUser."</span> [<a href='userCenter.php'>用户中心</a>] [<a href='userQuit.php'>退出</a>] ";
				}?> </p>