<?php
/**
 * UCenter Ӧ�ó���ӿ� for wp2.6.x��discuz, xspace��comsenzϵ����������������wp2.6.x���������ϣ�
 ucenter֧�ֵĸ���Ӧ�ó����е��û���վ�ڶ���Ϣ�����ѡ����֡�ͷ�񣬿��Զ�ͬ����wp2.6.x�С�

 ���������comsenz �ṩ��ucenter���ŵ�API�ӿڽ��п�������װ��μ����߸���վ�㡣
������ע�����
 * 1. ��Ҫʵ���û������Զ�ͬ����wd��������ʵ��վ�㲢�������ã�
 * 2. �û���ucenterӦ����ע�ᡢ��¼�������û������������룬wp���ݱ������ݾ���ͬ����
 * 3. ��ȷ��wp���û����idС��ucenter����Сid����ucenter�ж������û���������wp�༴�ɣ���

 * @Author:	kolidon@gmail.com
 * @Author:	blog.treeber.com
 * @Site:	http://blog.treeber.com
 **/

define('UC_VERSION', '1.0.0');		//UCenter �汾��ʶ

define('API_DELETEUSER', 1);		//�û�ɾ�� API �ӿڿ���
define('API_RENAMEUSER', 1);		//�û����� API �ӿڿ���
define('API_UPDATEPW', 1);		//�û������� API �ӿڿ���
define('API_GETTAG', 0);		//��ȡ��ǩ API �ӿڿ���
define('API_SYNLOGIN', 1);		//ͬ����¼ API �ӿڿ���
define('API_SYNLOGOUT', 1);		//ͬ���ǳ� API �ӿڿ���
define('API_UPDATEBADWORDS', 0);	//���¹ؼ����б� ����
define('API_UPDATEHOSTS', 1);		//���������������� ����
define('API_UPDATEAPPS', 1);		//����Ӧ���б� ����
define('API_UPDATECLIENT', 1);		//���¿ͻ��˻��� ����
define('API_UPDATECREDIT', 0);		//�����û����� ����
define('API_GETCREDITSETTINGS', 1);	//�� UCenter �ṩ�������� ����
define('API_UPDATECREDITSETTINGS', 0);	//����Ӧ�û������� ����

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');

//error_reporting(E_ALL);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());


define('S_ROOT', substr(dirname(__FILE__), 0, -3));
define('UC_CLIENT_ROOT1', S_ROOT.'./uc_client/');
include_once(S_ROOT.'./inc/db_conn.php');
include_once(UC_CLIENT_ROOT1.'./client.php');

//ÿ�����ɵ�ֵ����һ��������ͨ����֤
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

	//ɾ���û� API �ӿ�
	$uids = $get['ids'];

	//todo:: clean all the blog/comment, set their userid to 0

	//*********************
	$sql="delete from wiibbs_user where user_id in ($uid)";
	mysql_query($sql);

	exit(API_RETURN_SUCCEED);

} elseif($action == 'renameuser') {

	!API_RENAMEUSER && exit(API_RETURN_FORBIDDEN);

	//�û����� API �ӿ�
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

	//��ʱ�޷��޸ģ���ucenter��9��ĩ�µ��޶��汾�в���֪ͨ�û��µ�����
	//���޸����
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

	//ͬ����¼ API �ӿ�
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
           //�����Լ���վ
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
 *  ɾ���û��ӿں���
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
 *  uc�Դ�����1
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
 *  uc�Դ�����2
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
 *  uc�Դ�����3
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


