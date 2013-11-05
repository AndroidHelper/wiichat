<?php
/**
 * UCenter 应用程序接口 for wp2.6.x（discuz, xspace等comsenz系程序社区化功能与wp2.6.x的完美整合）
 ucenter支持的各类应用程序中的用户、站内短消息、好友、积分、头像，可自动同步到wp2.6.x中。

 本程序基于comsenz 提供的ucenter开放的API接口进行开发，安装请参见作者个人站点。
有如下注意事项：
 * 1. 主要实现用户数据自动同步至wd，已用于实际站点并运行良好；
 * 2. 用户在ucenter应用中注册、登录、更改用户名、更改密码，wp数据表中数据均能同步；
 * 3. 请确保wp中用户最大id小于ucenter中最小id（在ucenter中多添几个用户，添至比wp多即可）；

 * @Author:	kolidon@gmail.com
 * @Author:	blog.treeber.com
 * @Site:	http://blog.treeber.com
 **/

define('UC_VERSION', '1.0.0');		//UCenter 版本标识

define('API_DELETEUSER', 1);		//用户删除 API 接口开关
define('API_RENAMEUSER', 1);		//用户改名 API 接口开关
define('API_UPDATEPW', 1);		//用户改密码 API 接口开关
define('API_GETTAG', 0);		//获取标签 API 接口开关
define('API_SYNLOGIN', 1);		//同步登录 API 接口开关
define('API_SYNLOGOUT', 1);		//同步登出 API 接口开关
define('API_UPDATEBADWORDS', 0);	//更新关键字列表 开关
define('API_UPDATEHOSTS', 1);		//更新域名解析缓存 开关
define('API_UPDATEAPPS', 1);		//更新应用列表 开关
define('API_UPDATECLIENT', 1);		//更新客户端缓存 开关
define('API_UPDATECREDIT', 0);		//更新用户积分 开关
define('API_GETCREDITSETTINGS', 1);	//向 UCenter 提供积分设置 开关
define('API_UPDATECREDITSETTINGS', 0);	//更新应用积分设置 开关

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');

//error_reporting(E_ALL);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());


define('S_ROOT', substr(dirname(__FILE__), 0, -3));
define('UC_CLIENT_ROOT1', S_ROOT.'./uc_client/');
include_once(S_ROOT.'./inc/db_conn.php');
include_once(UC_CLIENT_ROOT1.'./client.php');

//每次生成的值均不一，但均可通过验证
//echo wp_hash_password('admin');
//exit();
//var_dump($wpdb);

$code = $_GET['code'];
parse_str(uc_authcode($code, 'DECODE', UC_KEY), $get);

if(MAGIC_QUOTES_GPC) {
	$get = dstripslashes($get);
}

if(time() - $get['time'] > 3600) {
	exit('Authracation has expiried');
}
if(empty($get)) {
	exit('Invalid Request');
}
$action = $get['action'];
$timestamp = time();


if($action == 'test') {
	exit(API_RETURN_SUCCEED);
} elseif($action == 'deleteuser') {

	!API_DELETEUSER && exit(API_RETURN_FORBIDDEN);

	//删除用户 API 接口
	$uids = $get['ids'];

	//todo:: clean all the blog/comment, set their userid to 0

	//*********************
	$sql="delete from wiibbs_user where user_id in ($uid)";
	mysql_query($sql);

	exit(API_RETURN_SUCCEED);

} elseif($action == 'renameuser') {

	!API_RENAMEUSER && exit(API_RETURN_FORBIDDEN);

	//用户改名 API 接口
	$id = $get['uid'];
	$usernamenew = $get['newusername'];
	$activeuser = uc_get_user($id, 1);

	//todo, the very first,we need to syn all the user table to prevent the username or id collision
	//Now we imagine everything is ok

	//if wordpress user not exsits, add it
	//***************/
	//checkuserexists_user($activeuser);
	//$wpdb->query("update $wpdb->users set user_login='$usernamenew' WHERE id IN ($id);");
	$sql="update wiibbs_user set user_account='".$usernamenew."' where user_id in (".$id.")";
	mysql_query($sql);
	exit(API_RETURN_SUCCEED);

} elseif($action == 'updatepw') {

	!API_UPDATEPW && exit(API_RETURN_FORBIDDEN);

	//暂时无法修改，因ucenter在9月末新的修订版本中不再通知用户新的密码
	//不修改亦可
	$username = $get['username'];
	$password = $get['password'];
	$rand=rand(1000,9999);
	$md5Pw=md5(md5($password).$rand);
	//$activeuser = uc_get_user($username);
	//checkuserexists_user($activeuser);
	if(!$password){
		$sqlt="update wiibbs_user set user_password='".$md5Pw."',user_sort=".$rand." where user_account='".$username."'";
		mysql_query($sqlt);
	}



	exit(API_RETURN_SUCCEED);

} elseif($action == 'synlogin' && $_GET['time'] == $get['time']) {
	//echo "hello";
	!API_SYNLOGIN && exit(API_RETURN_FORBIDDEN);

	//同步登录 API 接口
	$id = intval($get['uid']);
	// is uer exists?
	$activeuser = uc_get_user($id, 1);
	

	header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
	 set_login($id, $activeuser);

	

} elseif($action == 'synlogout') {

	!API_SYNLOGOUT && exit(API_RETURN_FORBIDDEN);
	header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
}elseif ($action == 'deleteuser'){

	$uids = $get['ids'];
        if(!API_DELETEUSER)
        {
            return API_RETURN_FORBIDDEN;
        }

        if (delete_user($uids))
        {
            return API_RETURN_SUCCEED;
        }
}

function set_login($user_id = '', $user_name = '')
{
    if (empty($user_id))
    {
        return ;
    }
    else
    {
       $sql_r="select * from wiibbs_user where user_id=".$user_id;
	$rs=mysql.quert($sql);
	$row=mysql_fetch_array($rs);
        if ($row)
        {
           //操作自己网站
        }
        else
        {
            include_once(ROOT_PATH . 'uc_client/client.php');
            if($data = uc_get_user($user_name))
            {
                list($uid, $uname, $email) = $data;
				
				$reg_date = date('Y-m-d H:i:s');
              //$rand=rand(1000,9999);
				//$pw2=md5(md5($password).$rand);
				$sql="insert into wiibbs_user(user_id,user_account,user_email,user_regTime,user_sort,user_level,user_grade,user_board) values (".$uid.",'".$uname."','".$email."',".$reg_date.",'".$rand."','0',1,'|0|')";
				mysql_query($sql);
                set_login($uid);
            }
            else
            {
                return false;
            }
        }
    }
}

/**
 *  删除用户接口函数
 *
 * @access  public
 * @param   int $uids
 * @return  void
 */
function delete_user($uids = '')
{
    if (empty($uids))
    {
        return;
    }
    else
    {
        $uids = stripslashes($uids);
        $sql = "delete from wiibbs_user where user_id in ($uids) ";
        msyql_query($sql);
        return true;
    }
}
/**
 *  uc自带函数1
 *
 * @access  public
 * @param   string  $string
 *
 * @return  string  $string
 */

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

	$ckey_length = 4;

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}

/**
 *  uc自带函数2
 *
 * @access  public
 * @param   string  $string
 *
 * @return  string  $string
 */
function dsetcookie($var, $value, $life = 0, $prefix = 1) {
	global $cookiedomain, $cookiepath, $timestamp, $_SERVER;
	setcookie($var, $value,
		$life ? $timestamp + $life : 0, $cookiepath,
		$cookiedomain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
}

function dstripslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dstripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}

/**
 *  uc自带函数3
 *
 * @access  public
 * @param   string  $string
 *
 * @return  string  $string
 */
function _stripslashes($string)
{
    if(is_array($string))
    {
        foreach($string as $key => $val)
        {
            $string[$key] = _stripslashes($val);
        }
    }
    else
    {
        $string = stripslashes($string);
    }
    return $string;
}


