<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
		<title> 上传网站Logo -- 后台管理 </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
	<?php
		$action=(empty($_GET["action"]))?'':$_GET['action'];
		if($action=='up'){
			$f_name=$_FILES['file']['name'];
			$f_size=$_FILES['file']['size'];
			$f_tmpName=$_FILES['file']['tmp_name'];
			$f_ext=strtolower(preg_replace('/.*\.(.*[^\.].*)*/iU','\\1',$f_name));
			$f_extList="png|jpg|gif";

			$f_exts=explode("|",$f_extList);
			$checkExt=true;
			foreach ($f_exts as $v)
				if ($f_ext==$v){
					$checkExt=false;
					break;
				}

			if ($checkExt) {
				alertInfo2("文件格式不在允许范围",'',1);
				exit();
			}

			if ($f_size>200*1024){
				alertInfo2("文件大小不能超过200KB",'',1);
				exit();
			}
			if($f_size>1048576){
				$f_size=$f_size/1048576;
				$f_size=number_format($f_size,2)."MB";
			}else{
				$f_size=$f_size/1024;
				$f_size=intval($f_size)."KB";
			}

			if (!file_exists("../userfiles"))
				@mkdir("../userfiles",0777);

				$random= rand(100,999); 
				$f_names= time().$random.".".$f_ext;
				$filenames="../userfiles"."/".$f_names;
				$msg="上传成功。 文件类型：".$f_ext." 文件大小：".$f_size."";
				if (copy($f_tmpName,$filenames)){
					echo "<script language='javascript'>";
					echo "alert('".$msg."');";
					echo "window.opener.document.getElementById('form2').pic.value='userfiles/".$f_names."';";
					echo "window.close();";
					echo "</script>";
				}else{
					alertInfo2("未知错误，上传失败。请重新上传。",'',1);
					exit();
				}
			}
		?>
		<div id="pic">
			<div id="content1">
				<h1>上传网站Logo</h1>
				<div id="intro">
					<form action="PicUp.php?action=up" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<p><input type="file" name="file" class="botton"/>
						<input type="submit" name="Submit" value="上传" class="button"/></p>
					 </form>
					<div class="point">
						<p class="important">提示：</p>
						<p>1.图片格式只能为gif|jpg|png。</p>
						<p>2.图片的大小必须小于200K。</p>
						<p class="important"><?php echo $msg?></p>
					</div>
					<p class="center"><a href="#" onclick="javascript:window.close();">【关闭窗口】</a></p>
				</div>
			</div>
		</div>
	</body>
</html>