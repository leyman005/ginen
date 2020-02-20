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

	require('../classes/Quotation.php');

	$quote = new Quotation();

	print_r(json_encode($quote->updateQuote($_POST['id'])));
?>