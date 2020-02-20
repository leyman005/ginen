<?php
	require('../classes/User.php');
	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || !(isset($_POST)))
	{
		die('You are not authorized !!!');
	}

	if(!isset($_SESSION["user_info"]))
	{
		die('You are not authorized !!!');
	}


	$user = new User();

	$user = $user->getUser($_POST['id']);
	
	die(json_encode($user));
