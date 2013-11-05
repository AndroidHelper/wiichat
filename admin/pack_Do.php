<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<?php
$act=sqlReplace(trim($_GET['act']));
switch($act)
{
	case 'down':
		$historyid=sqlReplace($_GET['id']);
		$sql="select * from wiichat_history where history_id=".$historyid;
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if($row)
		{
			$data=date('YmdHis',strtotime($rows['history_time']));
			$filename=$data.".txt";
			if(file_exists($filename))
			{
				unlink($filename);
			}
			$fp=fopen($filename,'x+');
			fwrite($fp,$row['history_content']);
			fclose($fp);
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".basename($filename)); 
			readfile($filename);
			unlink($filename);
		}else{
			alertInfo2('您要下载的内容不存在','',1);
		}
		break;
	case 'del':
		$historyid=sqlReplace($_GET['id']);
		$boardid=sqlReplace($_GET['borderid']);
		$sql="select * from wiichat_history where history_id=".$historyid;
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if($row)
		{
			$sql2="delete from wiichat_history where history_id=".$historyid;
			if(mysql_query($sql2))
			{
				alertInfo2('数据包删除成功','packList.php?id='.$boardid,0);
			}else{
				alertInfo2('数据包删除失败，原因sql异常','',1);
			}
		}else{
			alertInfo2('您要删除的数据包不存在','',1);
		}
		break;
	case 'delAll':
		$idlist=$_POST['id_list'];
		$boardid=sqlReplace(trim($_GET['boardid']));
		if(empty($idlist))
		{
			alertInfo2('请选择要删除的数据','',1);
		}else{
			foreach($idlist as $id);
			{
				$sql="delete from wiichat_history where history_id=".$id;
				if(!mysql_query($sql))
				{
					alertInfo2('数据包删除失败，原因sql异常','',1);
				}
			}
			alertInfo2('数据包删除成功','packList.php?id='.$boardid,0);
		}
		break;
}	
?>