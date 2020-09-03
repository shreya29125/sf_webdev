<?php
	ob_start();
	session_start();
	$current_file=$_SERVER['SCRIPT_NAME'];
	if(isset($_SERVER['HTTP_REFERER']))
		$http_referer=$_SERVER['HTTP_REFERER'];
	function loggedin()
	{
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
			return true;
		else 
			return false;
	}
	function getuserfield($field,$conn)
	{
		$userid=$_SESSION['user_id'];
		$result=$conn->prepare("SELECT $field from users WHERE id=:id");
		$result->bindValue(':id',$userid);
		$result->execute();
		$rows=$result->fetchALL();
		return $rows[0][$field];
	}
?>