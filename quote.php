<?php

	if($_SERVER['REQUEST_METHOD'] !== 'POST')
	{
		header('location: ./');
	}
	if(!isset($_SESSION['user_info']))
	{
		header('location: ./');
	}
	include 'admin/config/Connection.php';

	$new_quote = false;

	$name = $email = $compny = $phone = $website = $body = "";

	if($_POST)
	{

		foreach ($_POST as $key => $value) {
			switch($key)
			{
				case 'txtemail' : 	$email = validate_email(clean_input($_POST['txtemail']));
				break;

				case 'txtname' :  	$name = clean_input($_POST['txtname']);
				break;

				case 'txtcompany' : $company = clean_input($_POST['txtcompany']);
				break;

				case 'txtphone' :  	$phone = clean_input($_POST['txtphone']);
				break;

				case 'txtsite' :  	$website = isset($_POST['txtsite']) ? htmlspecialchars(addslashes(trim($_POST['txtsite']))) : '';
				break;

				case 'txtbody' :  	$body = clean_input($_POST['txtbody']);
				break;

				default: header('Location: index.php?err=1/#section-5/');
			} 	
		} 
	}

	// if($_SESSION['token'] != $token)
	// {
	// 	header('location:admin/');
	// }

	function clean_input($value)
	{
		if(!empty($value))
		{	
			$value = trim($value);
			$value = addslashes($value);
			$value = htmlspecialchars($value);

			return $value;
		}
		
			header('Location: ./?err=1/#section-5/');
			exit();
		
	}

	function validate_email($string)
	{
		$string = filter_var($string, FILTER_VALIDATE_EMAIL);

		if($string)
		{
			return $string;
		}
		header('Location: ./?err=2/#section-5');
		die();
	}

	$connection = Connection::database();

	// Check if client exists
	$sql = "SELECT client_id FROM clients WHERE contact_name = ? OR email = ? OR telephone = ?";

	$stmt = $connection->prepare($sql);
	
	$stmt->bind_param('sss',$name, $email, $phone);
	$stmt->execute();

	$result = $stmt->get_result();


	if($result->num_rows == 1)
	{
		$new_quote = true;

		$row = $result->fetch_object();

		if(new_quote == true)
		{
			$ins = $connection->query("INSERT INTO quote_request VALUES (null, '{$name}', '{$company}', '{$phone}', '{$email}', '{$website}', '{$body}', $row->client_id, now(), null, '0', '0', null, null)");
		}
		
		if($ins)
		{
			header('Location: ./?quote=1/#section-5');
		}

		$new_quote = false;
	}
	else
	{ 
		$new_quote = true;
		if($new_quote == true)
		{
			$ins = $connection->query("INSERT INTO quote_request VALUES (null, '{$name}', '{$company}', '{$phone}', '{$email}', '{$website}', '{$body}', null, now(), null, '0', '0', null, null)");
		}

		if(@$ins)
		{
			header('Location: ./?quote=1/#section-5');
		}
		
		$new_quote = false;
	}
	
	$connection->close();
?>