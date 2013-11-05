<?php require_once('getHeader.php'); ?><?php echo "<?xml version='1.0' encoding='utf-8'?>" ?>
<?php
$url=(empty($_GET["url"]))?"":$_GET['url'];
$id=(empty($_GET["id"]))?"":$_GET['id'];
$key=(empty($_GET["key"]))?"":$_GET['key'];
$bd=(empty($_GET["bd"]))?"":$_GET['bd'];
$uid=(empty($_GET["uid"]))?"":$_GET['uid'];
if(!empty($_GET['db']))
{
$db=$_GET['db'];
}else{
$db="";
}
$WPErr=array();
$WPErr[101]="数据库连接出错";
$WPErr[102]="数据库初始化失败";

$WPErr[131]="帐号长度为3-20位！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[132]="两次密码不相同！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[133]="密码不少于4位！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[134]="邮箱格式不正确！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[135]="QQ号格式不正确！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[136]="帐户已经被注册！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
$WPErr[137]="用户名或密码不正确！<br/>【<a href='userLogin.php?id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>重新登陆</a>】";
$WPErr[138]="房间不存在或已被删除！<br/>【<a href='index.php'>进入聊天室首页</a>】";
$WPErr[139]="该房间需要注册登陆后才能访问！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>注册</a>】【<a href='userLogin.php?id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>登陆</a>】<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[140]="该房间VIP会员才能访问！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[141]="该房间房主以上级别才能访问！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[142]="该帖子不存在！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[143]="该操作需要注册登陆后才能执行！<br/>【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>注册</a>】【<a href='userLogin.php?id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>登陆</a>】<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[144]="该帖子被锁定，不能回复！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[145]="用户不存在！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[207]="用户不存在！<br/>【<a href='userCenter.php'>返回</a>】";
$WPErr[146]="无权限操作！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[147]="搜索关键字不能为空！<br/>【<a href='index.php'>返回首页</a>】";
$WPErr[148]="必填项不能为空！<br/>【<a href='userPassword.php'>返回</a>】";
$WPErr[149]="两次密码不相同！<br/>【<a href='userPassword.php'>返回</a>】";
$WPErr[150]="密码不少于4位！<br/>【<a href='userPassword.php'>返回</a>】";
$WPErr[151]="原密码错误！<br/>【<a href='userPassword.php'>返回</a>】";
$WPErr[152]="帖子标题和内容不能为空！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[153]="邮箱格式不正确！<br/>【<a href='userEdit.php'>返回</a>】";
$WPErr[154]="QQ号格式不正确！<br/>【<a href='userEdit.php'>返回</a>】";
$WPErr[156]="帐号、QQ号、邮箱不相符！<br/>【<a href='userGetPW.php'>返回</a>】";
$WPErr[157]="该帐号被系统禁止注册！<br/>【<a href='userReg.php'>返回</a>】";

$WPErr[199]="非法访问！<br/>【<a href='index.php'>进入网站首页</a>】";
$WPErr[200]="该信息不存在！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[201]="信息标题和内容不能为空！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[206]="信息标题和内容不能为空！<br/>【<a href='userCenter.php'>返回</a>】";
$WPErr[202]="帖子中有不和谐的关键字！<br/>【<a href='topicPost.php?bd=".$db."&amp;key=post'>返回发帖页】<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[203]="帖子回复中有不和谐的关键字！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[204]="指定用户才能进入！<br/>【<a href='index.php'>返回聊天室首页</a>】";
$WPErr[205]="该邮箱已被注册！<br/> 【<a href='userReg.php?key=".$key."&amp;id=".$id."&amp;bd=".$bd."&amp;uid=".$uid."'>返回</a>】";
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 发生错误 </title>
  <meta http-equiv="Content-Type" content="<?php echo $header?>; charset=utf-8" />
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
 </head>
	
 <body>
	<h2>错误！</h2>
	<p class="red"><?php echo $WPErr[Trim($_GET["err"])]?></p>
 </body>
</html>
