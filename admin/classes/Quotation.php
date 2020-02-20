<?php
	require('../config/Connection.php');

	class Quotation extends Connection{

		protected $connection;
		// public $aMessage = [];

		function __construct()
		{
			$this->connection = Connection::database();
		}

		function getQuote()
		{
			$sql = "SELECT 
							id, fullname, company_name, telephone, email, website, message, created_at, upload, IF(payment is null or payment = '0', 'Unpaid', 'Paid') AS payment, 
							IF(status='0', 'Pending', 'Processed') AS status, uploaded_date, payment_date
					FROM 
							quote_request
					";

			$stmt = $this->connection->query($sql);
			
			return $stmt;
			$stmt->close();
		}

		function deleteQuote()
		{
			$sql = "DELETE FROM quote_request WHERE id  = ?";

			$stmt = $this->connection->prepare($sql);

			$stmt->bind_param('s', $_POST['id']);

			$stmt->execute();

			if($stmt)
			{
				return true;
			}

			
			$stmt->close();
		}

		function getAllInfoQuote($id)
		{
			$allInformation = array();
			// $clients_infos = '';
			$sql = "SELECT * FROM quote_request WHERE id = ?";

			$stmt = $this->connection->prepare($sql);
			
			$stmt->bind_param('s', $id);
			$stmt->execute();

			$result = $stmt->get_result();

			if($result)
			{
				$quote_infos = $result->fetch_object();
			}			
			
			if($quote_infos->client_ref != '')
			{
				$sql = "SELECT * FROM clients WHERE client_id = {$quote_infos->client_ref}";
				$result = $this->connection->query($sql);

				$clients_infos = $result->fetch_object();
			}

			$sql = 
				'SELECT 
						concat(u.firstname, " ", u.surname) Fullname, c.* 
				 FROM  
				 		users u
				LEFT JOIN 
						company c 
				ON 
					c.company_id = u.company_ref
				WHERE
			
					u.user_id ='. $_SESSION["user_info"]["user_id"].'
				';

			$result = $this->connection->query($sql);

			$company_infos = $result->fetch_object();

			$allInformation['quote'] = $quote_infos;
			$allInformation['client'] = @$clients_infos;
			$allInformation['company'] = $company_infos;


			return json_encode($allInformation);

	
			$stmt->close();
		}

		function updateQuote($id, $invoice_file = "NULL", $payment = "0")
		{
			$sql = "UPDATE quote_request SET upload = ?, payment = ?, status = '1' WHERE id  = ?";
			
			$stmt = $this->connection->prepare($sql);

			$stmt->bind_param('sss', $invoice_file, $payment, $id);

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