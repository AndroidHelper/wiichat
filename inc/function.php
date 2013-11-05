<?php
	function getUrl(){
		$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		return ($url);
	}
	function sqlReplace($str){
	   $strResult = $str;
	   if(!get_magic_quotes_gpc()){
		 $strResult = addslashes($strResult);
	   }
	   return $strResult;
	}
	function mbStrreplace($content,$to_encoding="UTF-8",$from_encoding="UTF-8") {  
		$content=mb_convert_encoding($content,$to_encoding,$from_encoding);  
		$str=mb_convert_encoding("　",$to_encoding,$from_encoding);  
		$content=mb_eregi_replace($str," ",$content);  
		$content=mb_convert_encoding($content,$from_encoding,$to_encoding);  
		$content=trim($content);  
		return $content;  
		} 
	function HTMLEncode($str){
		if (!empty($str)){
			$str=str_replace("&","&amp;",$str);
			$str=str_replace(">","&gt;",$str);
			$str=str_replace("<","&lt;",$str);
			$str=str_replace(CHR(32),"&nbsp;",$str);
			$str=str_replace(CHR(9),"&nbsp;&nbsp;&nbsp;&nbsp;",$str);
			$str=str_replace(CHR(9),"&#160;&#160;&#160;&#160;",$str);
			$str=str_replace(CHR(34),"&quot;",$str);
			$str=str_replace(CHR(39),"&#39;",$str);
			$str=str_replace(CHR(13),"",$str);
			$str=str_replace(CHR(10),"<br/>",$str);
		}
		return $str;
	}
	function HTMLDecode($str){
		if (!empty($str)){
			$str=str_replace("&amp;","&",$str);
			$str=str_replace("&gt;",">",$str);
			$str=str_replace("&lt;","<",$str);
			$str=str_replace("&nbsp;",CHR(32),$str);
			$str=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;",CHR(9),$str);
			$str=str_replace("&#160;&#160;&#160;&#160;",CHR(9),$str);
			$str=str_replace("&quot;",CHR(34),$str);
			$str=str_replace("&#39;",CHR(39),$str);
			$str=str_replace("",CHR(13),$str);
			$str=str_replace("<br/>",CHR(10),$str);
			$str=str_replace("<br>",CHR(10),$str);
		}
		return $str;
	}
	function DateDiff($part, $begin, $end){
		$diff = strtotime($end) - strtotime($begin);
		switch($part){
			case "y": $retval = bcdiv($diff, (60 * 60 * 24 * 365)); break;
			case "m": $retval = bcdiv($diff, (60 * 60 * 24 * 30)); break;
			case "w": $retval = bcdiv($diff, (60 * 60 * 24 * 7)); break;
			case "d": $retval = bcdiv($diff, (60 * 60 * 24)); break;
			case "h": $retval = bcdiv($diff, (60 * 60)); break;
			case "n": $retval = bcdiv($diff, 60); break;
			case "s": $retval = $diff; break;
		}
		return $retval;
	}
	function alertInfo($info,$url,$type){
		switch($type){
			case 0:
				echo "<script language='javascript'>alert('".$info."');location.href='".$url."'</script>";
				exit();
				break;
			case 1:
				echo "$info<br/>【<a href='".$url."'>返回</a>】";
				exit();
				break;
		}
	}
	function alertInfo2($info,$url,$type){
		switch($type){
			case 0:
				echo "<script language='javascript'>alert('".$info."');location.href='".$url."'</script>";
				exit();
				break;
			case 1:
				echo "<script language='javascript'>alert('".$info."');history.back(-1);</script>";
				exit();
				break;
		}
	}
	function checkData($data,$name,$type){
		switch($type){
			case 0:
				if(!preg_match('/^\d*$/',$data)){
					alertInfo("非法参数".$name,'',1);
					exit();
				}
				break;
			case 1:
				if(empty($data)){
					alertInfo($name."不能为空","",1);
					exit();
				}
				break;
		}
		return $data;
	}
	function checkData2($data,$name,$type){
		switch($type){
			case 0:
				if(!preg_match('/^\d*$/',$data)){
					alertInfo2("非法参数".$name,'',1);
					exit();
				}
				break;
			case 1:
				if(empty($data)){
					alertInfo2($name."不能为空","",1);
					exit();
				}
				break;
		}
		return $data;
	}
	function checkAdminRight($right,$rightList){
		if(strpos($rightList,$right)===false){
			alertInfo("您没有该项权限","",1);
			exit;
		}
	}
	function topHeader($header,$title){
		$str="";
		$str.='<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
		$str.='<html xmlns="http://www.w3.org/1999/xhtml">';
		$str.="<head>";
		$str.="<meta http-equiv='Content-Type' content='".$header."; charset=utf-8' />";
		$str.='<link rel="stylesheet" href="style.css" type="text/css"/>';
		$str.="<title> ".$title." </title>";
		$str.="</head>";
		echo $str;
	}
	function admintopHeader($header,$title){
		echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml">';
		echo "<head>";
		echo "<meta http-equiv='Content-Type' content='".$header."; charset=utf-8' />";
		echo '<link rel="stylesheet" href="admin.css" type="text/css"/>';
		echo "<title> ".$title." </title>";
		echo "</head>";
	}
	function pctopHeader($title){
		$str="";
		$str.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		$str.='<html xmlns="http://www.w3.org/1999/xhtml">';
		$str.='<base target="mainFrame">';
		$str.="<head>";
		$str.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$str.='<link href="style/admin_style.css" rel="stylesheet" type="text/css" />';
		$str.='<link href="style/main.css" rel="stylesheet" type="text/css" />';
		$str.="<title> ".$title." </title>";
		$str.="</head>";
		echo $str;
	}
function showPage($url,$page,$pagesize,$rscount,$pagecount){
	echo "<div class='page'>当前页:".$page."/".$pagecount."页 每页 ".$pagesize." 条 共 ".$pagecount." 页 </div>";
	echo "<div class='page2'><a href='".$url."'><img src='images/firstpage.jpg' width='50' height='11' alt='首页' /></a>";
	if(($page-1)>0){
	echo "<a href='".$url."&page=".($page-1)."'><img src='images/prepage.jpg' width='56' height='11' alt='上一页' /></a>";
	}else{
		echo "<img src='images/prepage_01.gif' width='56' height='11' alt='上一页' />";
	}
	if(($page+1)<=$pagecount){
	echo "<a href='".$url."&page=".($page+1)."'><img src='images/nextpage.gif' width='57' height='11' alt='下一页' /></a>";
	}else{
		echo "<img src='images/nextpage_01.gif' width='56' height='11' alt='下一页' />";
	}
	echo "<a href='".$url."&page=".$pagecount."'><img src='images/lastpage.gif' width='60' height='11' alt='尾页' /></a>";
	echo "</div>";		
}
function showPage1($url,$page,$pagesize,$rscount,$pagecount){
	echo "<div class='page'>".$page."/".$pagecount."页 ";
	echo "<a href='".$url."'>首页</a> ";
	if(($page-1)>0){
	echo "<a href='".$url."&page=".($page-1)."'>上一页</a> ";
	}else{
		echo "上一页 ";
	}
	if(($page+1)<=$pagecount){
	echo "<a href='".$url."&page=".($page+1)."'>下一页</a> ";
	}else{
		echo "下一页 ";
	}
	echo "<a href='".$url."&page=".$pagecount."'>尾页</a>";
	echo "</div>";		
}
function showPage2($url,$page,$pagesize,$rscount,$pagecount){
	$showpage='';
	$showpage.="<div class='page'>".$page."/".$pagecount."页 ";
	$showpage.="<a href='".$url."'>首页</a> ";
	if(($page-1)>0){
	$showpage.= "<a href='".$url."&page=".($page-1)."'>上一页</a> ";
	}else{
		$showpage.="上一页 ";
	}
	if(($page+1)<=$pagecount){
	$showpage.="<a href='".$url."&page=".($page+1)."'>下一页</a> ";
	}else{
		$showpage.="下一页 ";
	}
	$showpage.="<a href='".$url."&page=".$pagecount."'>尾页</a>";
	$showpage.= "</div>";	
	return $showpage;
}
function showPage3($url,$page,$pagesize,$rscount,$pagecount){
	echo "<div class='page'>".$page."/".$pagecount."页 ";
	echo "<a href='".$url."'>首页</a> ";
	if(($page-1)>0){
	echo "<a href='".$url."&adminpage=".($page-1)."'>上一页</a> ";
	}else{
		echo "上一页 ";
	}
	if(($page+1)<=$pagecount){
	echo "<a href='".$url."&adminpage=".($page+1)."'>下一页</a> ";
	}else{
		echo "下一页 ";
	}
	echo "<a href='".$url."&adminpage=".$pagecount."'>尾页</a>";
	echo "</div>";
}
Function updateUserScore($u,$s,$m){
	global $userGradeScore;
	$user=$u;
	$score=$s;
	$mode=$m;
	$sqlStr_uus="select user_score,user_grade from wiichat_user where user_account='".$user."'";
	$rs_uus=mysql_query($sqlStr_uus);
	$row=mysql_fetch_assoc($rs_uus);
	$row["user_score"]=$row["user_score"]+$score*$mode;
	$tempScore=$row["user_score"];
	$tempGrade=$row["user_grade"];
	If($mode=="1"){
		If(!($tempScore<$userGradeScore[$tempGrade+1])){
			If($tempGrade<(sizeof($userGradeScore)-1)){ 
				$tempGrade=$tempGrade+$mode;
			}
		}
	}
	If($mode=="-1"){
		If($tempScore<($userGradeScore[$tempGrade])){
			echo $userGradeScore[$tempGrade];
			exit();
			$tempGrade=$tempGrade+$mode;
		}
	}
	$sql="update wiichat_user set user_score=".$tempScore.",user_grade=".$tempGrade." where user_account='".$user."'";
	mysql_query($sql); 
}
function cutstr($string,$length) {
	$charset="utf-8";
	if(strlen($string) <= $length) {
		return $string;
	}
	//$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string,  $n);

	} else {
		for($i = 0; $i < $length; $i++) {
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	//$strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
	return $strcut;
}
Function updateuserVip($user){
	$sqlstr="select user_board,user_level from wiichat_user where user_account='".$user."'";
	$rs=mysql_query($sqlstr);
	$row=mysql_fetch_assoc($rs);
	If($row){
		If($row['user_level']!="2"){
			If($row['user_board']!="|0|"){
				$sqlstr_="update wiichat_user set user_level='1' where user_account='".$user."'";
				mysql_query($sqlstr_);
			}Else{
				$sqlstr_="update wiichat_user set user_level='0' where user_account='".$user."'";
				mysql_query($sqlstr_);
			}	
		}
	}
}
function ImageEncode($image)
	{
		$s1="[ems:".$image."]";
		return $s1;
	}
function ImageDecode($image)
	{
		$s=explode(":",$image);
		$img=str_replace(']','',$s[1]);
		$images=getimagesize('images/expression/'.$img.'.gif');
		return "<img src='images/expression/".$img.".gif' width='".$images[0]."' height='".$images[1]."'/>";
	}
 Function GetModerator($bdAdmin){
	If(empty($bdAdmin))
		return "暂无房主";
	$bzName="";
	If(strpos($bdAdmin,"|") > 0 ){
		$bdAdmins=explode("|",$bdAdmin);
		For($i=0;$i<count($bdAdmins);$i++){
			If($i==(count($bdAdmins)-1)){
				$str="<a href='user.php?id=".$bdAdmins[$i]."&amp;url=".urlencode(getUrl())."'>".$bdAdmins[$i]."</a>";
				$bzName = $bzName.$str;
			}else{
				$str="<a href='user.php?id=".$bdAdmins[$i]."&amp;url=".urlencode(getUrl())."'>".$bdAdmins[$i]."</a>";
				$bzName = $bzName.$str.",";
			}
		}
	}else{
		$str="<a href='user.php?id=".$bdAdmin."&amp;url=".urlencode(getUrl())."'>".$bdAdmin."</a>";
		$bzName = $str;
	}
	return $bzName;
 }
 Function GetModerator1($bdAdmin){
	If(empty($bdAdmin))
	return "暂无房主";
	If(strpos($bdAdmin,"|") > 0 ){
		$bdAdmin=explode("|",$bdAdmin);
		For($i=0;$i<count($bdAdmin);$i++){
			$str="<a href='chat_userDetail.php?account=".urlencode($bdAdmin[$i])."'>".$bdAdmin[$i]." </a>";
			$bzName .= $str;	
		}
	}else{
		$str="<a href='chat_userDetail.php?account=".urlencode($bdAdmin)."'>".$bdAdmin."</a>";
		$bzName = $str;
	}
	return $bzName;
}
?>