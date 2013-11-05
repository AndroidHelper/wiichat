<?php


    /**
     *  用户登录函数
     *
     * @access  public
     * @param   string  $username
     * @param   string  $password
     *
     * @return void
     */
	
    function login($username, $password)
    {
        list($uid, $uname, $pwd, $email, $repeat) = uc_call("uc_user_login", array($username, $password));
        $uname = addslashes($uname);
        if($uid > 0)
        {
            //检查用户是否存在,不存在直接放入用户表

			$sql2="select * from wiichat_user where user_id=".$uid;
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if ($row2){
				$uid_exist=$uid;
			
			}else{
				$uid_exist="";
			}
			
			$sql2="select * from wiichat_user where user_account='".$username."'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if($row2)
			{
				$sort=$row2['user_sort'];
				$name_exist=$row2['user_id'];
			}else{
				$sort="";
				$name_exist="";
			}
			
			$sql2="select * from wiichat_user where user_account='".$username."' and user_password='".md5(md5($password).$sort)."'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if($row2)
			{
				$user_exist=$row2['user_id'];
			}else{
				$user_exist="";
			}

            if (empty($user_exist))
            {
				
				 $sort=rand(1000,9999);
				if(empty($name_exist))
                {
                 
					if (empty($uid_exist)){
						$sqlStr="insert into wiichat_user(user_id,user_account,user_password,user_regtime,user_level,user_board,user_sort) values(".$uid.",'".$username."','".md5(md5($password).$sort)."','".date('Y-m-d H:i:s')."','0','|0|','".$sort."')";
						if (mysql_query($sqlStr)){
						}else{
								 $flag=4; //出现意外
								return $flag;
						
						}
					}else{
						$sqlStr="insert into wiichat_user(user_account,user_password,user_regtime,user_level,user_board,user_sort) values('".$username."','".md5(md5($password).$sort)."','".date('Y-m-d H:i:s')."','0','|0|','".$sort."')";
						if (mysql_query($sqlStr)){
						}else{
								  $flag=5; //出现意外
								return $flag;
						
						}
					}
                }
                else 
                {
                   
					$sqlStr="update wiichat_user set user_password='".md5(md5($password).$sort)."' where user_id=".$uid;
					if (!mysql_query($sqlStr)){
						  $flag=6;  //出现意外
							return $flag;
					}
                }
            }
			
           uc_call("uc_user_synlogin", array($uid));
		   $flag=3;  //登陆成功
            return $flag;
			
        }
        elseif($uid == -1)
        {
            $flag=1;  //用户名不正确
            return $flag;
        }
        elseif ($uid == -2)
        {
           $flag=2;  //密码不正确
            return $flag;
        }
        else
        {
             $flag=4;  //出现意外
            return $flag;
        }
    }

    /**
     * 用户退出
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function logout()
    {
        uc_call("uc_user_synlogout");   //同步退出
        return true;
    }

	

    /*添加用户*/
    function add_user($username, $password, $email,$mobile='')
    {
        /* 检测用户名 */
		$result=0;
        if (check_user($username))
        {
            $result=1; //用户已被注册
            return $result;
        }
        $uid = uc_call("uc_user_register", array($username, $password, $email));
		
        if ($uid <= 0)
        {
             $result=2; //注册失败
			  return $result;
        }
        else
        {
            $sql2="select * from wiichat_user where user_id=".$uid;
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if ($row2){
				$uid_exist=$uid;
			
			}else{
				$uid_exist="";
			}
			
			//注册成功，插入用户表
			$ip=$_SERVER['REMOTE_ADDR'];
            $reg_date = date('Y-m-d H:i:s');
			$rand=rand(1000,9999);
			$pw2=md5(md5($password).$rand);
			if (empty($uid_exist)){
				$sql="insert into wiichat_user(user_id,user_account,user_password,user_email,user_regTime,user_mobile,user_sort,user_level,user_board,user_ip) values (".$uid.",'".$username."','".$pw2."','".$email."','".$reg_date."','".$mobile."','".$rand."','0','|0|','".$ip."')";
				if (mysql_query($sql)){
			   
				 $flag=3; //注册成功
				  return $flag;
				}else{
				  $flag=4; //注册成功
				  return $flag;
				}
			}else{
				$sql="insert into wiichat_user(user_account,user_password,user_email,user_regTime,user_mobile,user_sort,user_level,user_board,user_ip) values ('".$username."','".$pw2."','".$email."','".$reg_date."','".$mobile."','".$rand."','0','|0|','".$ip."')";
				if (mysql_query($sql)){
			   
				 $flag=3; //注册成功
				  return $flag;
				}else{
				  $flag=4; //注册成功
				  return $flag;
				}

			}
        }
		
    }

    /**
     *  检查指定用户是否存在及密码是否正确
     *
     * @access  public
     * @param   string  $username   用户名
     *
     * @return  int
     */
    function check_user($username, $password = null)
    {
		$userdata = uc_call("uc_user_checkname", array($username));
        if ($userdata == 1)
        {
            return false;
        }
        else
        {
            return  true;
        }
    }


    




	    /**
     * 检测Email是否合法
     *
     * @access  public
     * @param   string  $email   邮箱
     *
     * @return  blob
     */

	
    /* 编辑用户信息 */
    function edit_user($cfg, $forget_pwd = '0')
    {   
        $real_username = $cfg['username'];
        $cfg['username'] = addslashes($cfg['username']);
        $set_str = '';
        $valarr =array('email'=>'user_email','mobile'=>'user_mobile','name'=>'user_name');
        foreach ($cfg as $key => $val)
        {
            if ($key == 'username' || $key == 'password' || $key == 'old_password' || $key =='email2')
            {
                continue;
            }
            $set_str .= $valarr[$key] . '=' . "'$val',";
        }
        $set_str = substr($set_str, 0, -1);
        if (!empty($set_str))
        {
            //$sql = "UPDATE " . $GLOBALS['ecs']->table('users') . " SET $set_str  WHERE user_name = '$cfg[username]'";
			$sql_r="update wiichat_user set $set_str  where user_account='$cfg[username]'";
			mysql_query($sql_r);
        }

        if (!empty($cfg['email']))
        {
			if($cfg['email']!=$cfg['email2'])
			{
				$ucresult = uc_call("uc_user_edit", array($cfg['username'], '', '', $cfg['email'], 1));
				if ($ucresult > 0 )
				{
					
					$sqlstr="update wiichat_user set user_email='".$cfg['email']."',user_mobile='".$cfg['mobile']."' where user_account='".$real_username."'";
					if(mysql_query($sqlstr)){
						$flag = 1; //修改email 成功
					}else{
						$flag = 2; //修改email 不成功
					}
					return $flag;
				}
				else
				{
					 $flag = 2; //修改email 不成功
					return $flag;
				}
			}
			return 1;
          
        }
        if (!empty($cfg['old_password']) && !empty($cfg['password']) && $forget_pwd == 0)
        {
           
			$ucresult = uc_call("uc_user_edit", array($real_username, $cfg['old_password'], $cfg['password'], ''));
            if ($ucresult > 0 )
            {
				//修改密码
				$rand=rand(1000,9999);
				$sql="update wiichat_user set user_password='".md5(md5($cfg['password']).$rand)."',user_sort=".$rand." where user_account='".$real_username."'";
				mysql_query($sql);
                 $flag = 3; //修改密码成功
				return $flag;
            }
            else
            {
                $flag = 4; //修改密码不成功
				return $flag;
            }
        }
        elseif (!empty($cfg['password']) && $forget_pwd == 1)
        {
            $ucresult = uc_call("uc_user_edit", array($real_username, '', $cfg['password'], '', '1'));
            if ($ucresult > 0 )
            {
                $rand=rand(1000,9999);
				$md5Pw=md5(md5($cfg['password']).$rand);
				$sqlt="update wiichat_user set user_password='".$md5Pw."',user_sort=".$rand." where user_account='".$real_username."'";
				mysql_query($sqlt);
				$flag=5;
				return $flag;
            }
        }

       
    }






/**
 * 调用UCenter的函数
 *
 * @param   string  $func
 * @param   array   $params
 *
 * @return  mixed
 */
function uc_call($func, $params=null)
{
    if (!function_exists($func))
    {
        include_once(path.'./uc_client/client.php');
    }

    $res = call_user_func_array($func, $params);


    return $res;
}

?>