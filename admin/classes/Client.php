<?php
	require('../config/Connection.php');

	class Client extends Connection{

		protected $connection;
		// public $aMessage = [];

		function __construct()
		{
			$this->connection = Connection::database();
		}

		function getClients()
		{
			$sql = "SELECT * FROM clients";

			$stmt = $this->connection->query($sql);
			
			return $stmt;
			$stmt->close();
		}

		function deleteClient($id)
		{
			$sql = "DELETE FROM clients WHERE client_id  = ?";

			$stmt = $this->connection->prepare($sql);

			$stmt->bind_param('s', $id);

			$stmt->execute();

			if($stmt)
			{
				return true;
			}
			
			$stmt->close();
		}

		function __destruct()
		{
			$this->connection->close();
		}
	}
?>