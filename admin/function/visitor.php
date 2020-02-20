<?php

	function insertIP(){
		if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']))
		{
			global $connection;

			$ip = getUserIPAdd();
			$iTime = $_SERVER['REQUEST_TIME'];
			$time = date("Y-m-d H:i:s", $iTime);
			$sUserAgent = $_SERVER['HTTP_USER_AGENT'];
			$today = date('Y-m-d H:i:s ', time());
			
			if(checkIP($ip,$time, $today, $sUserAgent) == true)
			{ 
				$query = "INSERT INTO visitors (ip_address, time, user_agent) VALUES (?,?,?)";

				$stmt = $connection->prepare($query);
				
				$stmt->bind_param('sss', $ip, $time, $sUserAgent);

				$stmt->execute();
				$stmt->close();

				$connection->close();	
			}
		}
	}
	
	function checkIP($ip, $date, $today, $userAgent)
	{
		global $connection;
		
		$query = "SELECT * FROM visitors WHERE ip_address = '$ip' AND user_agent = '$userAgent' order by id DESC limit 1";


		$result = $connection->query($query);

		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$address_date = $row['time'];
		
			$interval = date_diff(date_create($address_date), date_create($today));

			if($interval->format('%a') > 2)
			{
				return true;
			}
			else return false;
		}
		else return true;	
	}	

	function getUserIPAdd()
	{
		$ipAddress = '';

		if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		{
			$ipAddress = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			$ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		else
		{
			$ipAddress = $_SERVER["REMOTE_ADDR"];
		}

		return $ipAddress;
	}	

	function getIPInfo($ipaddresses=array())
	{
		$results = "";
		$count = 0;
		foreach ($ipaddresses as $ip) 
		{
			++$count;
			$query = @unserialize(file_get_contents("http://ip-api.com/php/".$ip));
			if($query && $query['status'] == "success")
			{
				$results .= "
				<tr>
					<td>{$count}</td>
					<td>{$query['country']}</td>
					<td>{$query['city']}</td>
					<td>{$query['regionName']}</td>
					<td>{$query['zip']}</td>
					<td>{$query['isp']}</td>
					<td><span class='badge badge-complete'>{$query['status']}</span></td>
			 	</tr>";
			}
		}

		return $results;
	}
?>