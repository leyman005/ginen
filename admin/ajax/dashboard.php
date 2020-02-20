<?php

	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || (!isset($_POST)))
	{
		die('You are not authorized !!!');
	}

	require('../classes/User.php');

	$user = new User();
	$user->countUsers();

	die(json_encode($user->countUsers()));
?>