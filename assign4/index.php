<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	require 'core.php';
	require 'connect.php';
	if(loggedin())
	{
		include 'login.php';
	}
	else
		include 'loginform.php';
?>