<?php require_once("db_conn.php")?><?php require_once 'adminCheck.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <script type="text/javascript">
	function show_1(type){
		switch(type)
		{
			case "tag":
				document.getElementById('tag').style.display="none";
				break;
			case "log":
				document.getElementById('tag').style.display="";
				break;
		}
	}
  </script>
 <head>
  <title> 修改房间 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <body>
 <?php
	 $id=(empty($_GET["id"]))?"":$_GET['id'];
	 $sqlStr="select * from wiichat_board where board_id=".$id."";
	 $rs=mysql_query($sqlStr);
	 $row=mysql_fetch_assoc($rs);
	 if(!$row){
		alertInfo2("该房间不存在或已经被删除","",1);
	 }else{
		$bdName=$row["board_name"];
		$bdDesc=$row["board_desc"];
		$bdType=$row["board_type"];
		$bdAdmin=$row["board_admin"];
	 }
 ?>
	<div class="listintor">
		<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
			<span>位置：聊天室管理 －&gt; <strong>修改房间</strong></span></div>
		<div class="header2"><span>修改房间</span></div>
		<div class="fromcontent">
			<form id="form2" name="addForm" method="post" action="chat_boardDo.php?act=update&id=<?php echo $id?>">
				
				<p>名称：<input name="name" type="text" class="in1" value="<?php echo $bdName?>"/></p>
				<p>简介：<input name="desc" type="text" class="in1" value="<?php echo $bdDesc?>"/></p>
				<p>房主：<input name="admin" type="text" class="in1" value="<?php echo $bdAdmin?>"/><input name="admin2" type="hidden" value="<?php echo $bdAdmin?>"/>（房主须为前台已注册的会员，多个房主用“|”隔开。注：如果改为vip房间，应以vip会员做为房主）</p>
				<p>类型：<input name="type" type="radio" value="4" <?php If($bdType=="4") echo "checked='checked'"?> onClick="show_1('tag')" />游客房间(注册会员跟游客都可以)<input name="type" type="radio" value="0" <?php If($bdType=="0") echo "checked='checked'"?> onClick="show_1('tag')" />普通房间 <input name="type" type="radio" value="1" <?php If($bdType=="1") echo "checked='checked'"?> onClick="show_1('tag')" />会员房间 <input name="type" type="radio" value="2" <?php If($bdType=="2") echo "checked='checked'"?> onClick="show_1('tag')" />VIP房间 <input name="type" type="radio" value="3" <?php If($bdType=="3") echo "checked='checked'"?> onClick="show_1('tag')" />管理员房间<input name="type" type="radio" value="5" <?php if($bdType=="5") echo "checked='checked'"?> onClick="show_1('log')" />指定会员版面<input name="type" type="radio" value="6" <?php if($bdType=="6") echo "checked='checked'"?> onClick="show_1('tag')"/>直播房间
				</p>
				<?php
					if($bdType=="5")
					{
						$display="";
					}else{
						$display="display:none";
					}
				?>
				<div id="tag" style="<?php echo $display;?>">
					<p>请输入指定会员帐号按"|"间隔：</p>
					<p class="txt"><textarea name="user" cols="50" rows="7"><?php echo HTMLDecode($row['board_users']);?></textarea></p>
				</div>
				<div class="btn">
					<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkIn();"/>
				</div>
				<script language="javascript">
					function checkspace(checkstr) {
					  var str = '';
					  for(i = 0; i < checkstr.length; i++) {
						str = str + ' ';
					  }
					  return (str == checkstr);
					}
					function checkIn(){
						if(checkspace(document.addForm.name.value)) {
							alert("名称不能为空");
							return false;
						}
					}
				</script>
			</form>
		</div>
	</div>
 </body>
</html>
