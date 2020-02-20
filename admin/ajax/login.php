<?php

	require('../classes/User.php');
	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST')
	{
		die('You are not authorized !!!');
	}

	$sUsername = htmlspecialchars(trim($_POST['txtusername']));
	$sPassword = htmlspecialchars(trim($_POST['txtpassword']));


	$user = new User();

	$user = $user->authenticateUser($sUsername, $sPassword);
	die(json_encode($user));
	
?>
