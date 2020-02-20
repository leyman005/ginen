<?php
session_start();
require_once('../config/Connection.php');

class User{

	public $connection = null;
	public $aMessage = [];
	// public $user;
	// public $pass;

	public function __construct()
	{
		$this->connection = Connection::database();
	}
	
	/**
	 * This function check if user credentials exits, and return password
	 * @author Manley Louis
	 * @return user's database password
	*/

	public function authenticateUser($username, $password)
	{ 	
		$this->aMessage['error'] = false;
		$status = 
		$sql = "SELECT * FROM users WHERE username = ? AND status = '1' LIMIT 1";

		$stmt = $this->connection->prepare($sql);
		$stmt->bind_param('s', $username);
		$stmt->execute();

		$result = $stmt->get_result();
		
		if($result->num_rows === 0)
		{
			$this->aMessage['error'] = true;
		} 
		else
		{
			$rows = $result->fetch_object();

			if(!$this->verifyPassword($password, $rows->password))
			{
				$this->aMessage['error'] = true;
			}
			else
			{
				foreach ($rows as $key => $row) 
				{
					if($key === "token") continue;

					$_SESSION['user_info'][$key] = $row;
				}
			
				$token = $this->generateToken();

				$result = $this->connection->query("UPDATE `users` SET `token` = '$token' WHERE user_id = {$rows->user_id} ");

				unset($_SESSION['user_info']['token']);

				$_SESSION['user_info']['token'] = $token;
			}
		}

		if(!$this->aMessage['error'])
		{
			$this->aMessage['success'] = 'Welcome to Ginen system';	
		}
	
		$stmt->close();

		return $this->aMessage;

		$this->connection->close();
	}

	public function countUsers()
	{
		$sql = "SELECT COUNT(*) AS NumberOfUsers FROM users";

		$result = $this->connection->query($sql);
		
		return $this->aMessage['countUsers'] = $result->fetch_object();
	}

	function getUsers()
	{
		
		$sql = "SELECT user_id, concat(firstname, ' ', surname) AS fullname, email, username, password, status, create_at, manage, company_ref FROM users";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			return $stmt;
		}

		$stmt->close();
		$this->connection->close();
	}

	function getUser($id)
	{
		
		$sql = "SELECT user_id, firstname, surname, email, username, status, manage, company_ref FROM users WHERE user_id = {$id}";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			$result = $stmt->fetch_object();

			return $result;
		}
		else
		{
			return $this->connection->error;
		}

		$stmt->close();
		$this->connection->close();
	}

	function deleteUser($id)
	{
		$sql = "DELETE FROM users WHERE user_id  = ?";

		$stmt = $this->connection->prepare($sql);

		$stmt->bind_param('s', $id);

		$stmt->execute();

		if($stmt)
		{
			return true;
		}
		
		$stmt->close();
		$this->connection->close();
	}

	function addUser($first, $name, $email, $username, $pass, $active)
	{
	
		$sql = "INSERT INTO users (firstname, surname, email, username, password, status, company_ref) VALUES (?,?,?,?,?,?,1)";

		$stmt = $this->connection->prepare($sql);

		$password = $this->hashPassword($pass);

		$stmt->bind_param('ssssss', $first, $name, $email, $username, $password, $active);
		$stmt->execute();

		if($stmt)
		{
			return true;
		}
		
		$stmt->close();
		$this->connection->close();
	}

	function updateUser($id, $first, $surname, $email, $user, $pass = "", $active)
	{
		$column  = '';
		$col_val = '';

		if(!empty($pass))
		{
			$column 	.= ',password = ?';
			$col_val  	.= $this->hashPassword($pass);
		}
				
		$sql = "UPDATE users SET firstname = ?, surname = ?, username = ?, email = ?, status = ? {$column} WHERE user_id = {$id}";
	
		$stmt = $this->connection->prepare($sql);
		
		if(!empty($col_val))
		{
			$stmt->bind_param("ssssss", $first, $surname, $user, $email, $active, $col_val);
		}
		else
		{
			$stmt->bind_param("sssss", $first, $surname, $user, $email, $active);
		}
		$stmt->execute();
		

		if($stmt->error == NULL)
		{
			return true;
		}
		else
		{
			return $this->connection->error;
		}

		$stmt->close();
		$this->connection->close();
	}

	private function hashPassword($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}

	private function verifyPassword($password, $databaseHashPass)
	{
		return password_verify($password, $databaseHashPass);
	}

	private function generateToken()
	{
		return uniqid('', true);
	}

	public function checkToken()
	{
		$sql = "SELECT token FROM users WHERE user_id = ?";
		$stmt = $this->connection->prepare($sql);

		$stmt->bind_param('i', $_SESSION['user_info']['user_id']);
		$stmt->execute();

		$result = $stmt->get_result();
		$oRows = $result->fetch_object();

		if($_SESSION['user_info']['token'] != $oRows->token)
		{
			header('location: ../logout.php');
		}
	}
}