<?php
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST')
	{
		header('location: ./');
	}
	if(!isset($_SESSION['user_info']))
	{
		header('location: ./');
	}

	require '../config/Connection.php';

	$connection = Connection::database();

	$sql = "SELECT count(id) AS visitors FROM visitors";


	$stmt = $connection->query($sql);

	// $stmt->execute();
	$visitors = [];
	$result = $stmt->fetch_object();
	$visitors['NumberOfVisitors'] = $result->visitors;
	die(json_encode($visitors));
	
?>