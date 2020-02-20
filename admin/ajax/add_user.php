<?php

	session_start();
	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || (!isset($_POST)))
	{
		die('You are not authorized !!!');
	}

	if(!(isset($_SESSION["user_info"]))
	{
		die('You are not authorized !!!');
	}

	require('../classes/User.php');
	include '../function/function.php';


	$first = clean_input($_POST["first"]);
	$name = clean_input($_POST["name"]);
	$email = clean_input($_POST["email"]);
	$username = clean_input($_POST["username"]);
	$pass = clean_input($_POST["pass"]);
	$active = clean_input($_POST["active"]);

	$user = new User();

	print_r(json_encode($user->addUser($first, $name, $email, $username, $pass, $active)));
?>