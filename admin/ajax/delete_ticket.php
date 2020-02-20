<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();
	// // header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || (!isset($_POST)))
	{
		die('You are not authorized !!!');
	}

	if(!isset($_SESSION["user_info"]))
	{
		die('You are not authorized !!!');
	}

	require('../classes/Ticket.php');
	include '../function/function.php';

	$client = new Ticket();

	$id = clean_input($_POST["id"]);

	print_r(json_encode($client->deleteTicket($id)));
?>