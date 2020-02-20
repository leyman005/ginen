<?php
	session_start();
	require('../classes/Ticket.php');

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || (!isset($_SESSION['user_info']['user_id'])))
	{
		die('You are not authorized !!!');
	}
	$ticket = new Ticket();
	
	$assignTicket = $ticket->assignTicket($_POST['assign_id'], $_POST['ticket_id']);
	die(json_encode($assignTicket));
	
?>