<?php require_once 'install_sql.php'; ?>
<?php
$t=intval($_POST["t"]);
$db_name=$_POST["dabasename"];
$db_host=$_POST["dataaddress"];
$db_user=$_POST["datauser"];
$db_password=$_POST["datapwd"];
$conn=mysql_connect($db_host,$db_user,$db_password) or die("错误：2009。");
mysql_select_db($db_name) or die("错误：2010。");
mysql_query("set names utf8") or die("错误：2011。");
if ($t==0){
	for($i=0;$i<=9;$i++){
		//wait
		if(!mysql_query($sqlstr[$i]))die("失败");
	}
}elseif($t>0 && $t<=11){
	if(!mysql_query($sqlstr[$t+9]))die("失败");
}else{
	if(!mysql_query($sqlstr[21]))die("失败");
	if(!mysql_query($sqlstr[22]))die("失败");
}
echo("S");
?>