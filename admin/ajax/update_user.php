<?php
	require('../classes/User.php');

	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || (!isset($_POST)))
	{
		die('You are not authorized !!!');
	}

	if(!isset($_SESSION["user_info"]))
	{
		die('You are not authorized !!!');
	}

	include '../function/function.php';

	$user_id = clean_input($_POST["user_id"]);
	$first = clean_input($_POST["first"]);
	$name = clean_input($_POST["name"]);
	$email = clean_input($_POST["email"]);
	$username = clean_input($_POST["user"]);
	$pass = clean_input($_POST["pass"]);
	$active = clean_input($_POST["active"]);

	$user = new User();
	
	die(json_encode($user->updateUser($user_id, $first, $name, $email, $username, $pass, $active)));
?>