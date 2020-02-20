<?php
	require('../config/Connection.php');

	class Visitor {

		protected $connection;
		// public $aMessage = [];

		function __construct()
		{
			$this->connection = Connection::database();
		}

		function getVisitorsIP()
		{
			$startDate = date('Y-m-d');
		    $startDate = $startDate.' 00:00:00';
		    
		    $endDate = date('Y-m-d');
		    $endDate = $endDate.' 23:59:59';

			$sql = "SELECT * FROM visitors WHERE time BETWEEN '$startDate' AND '$endDate'";

			$stmt = $this->connection->query($sql);
			
			$resultsOfIP = array();

			while ($row = $stmt->fetch_object()) {
				$resultsOfIP[] = $row->ip_address;
			}
			return $resultsOfIP;
			$stmt->close();
		}
	}
?>