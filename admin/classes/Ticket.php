<?php

require_once('../config/Connection.php');

class Ticket{

	protected $connection = null;
	public $aMessage = [];

	public function __construct()
	{
		$this->connection = Connection::database();
	}
	
	/**
	 * This function return all the components
	 * @author Manley Louis
	 * @return ticket components
	*/

	public function getComponents()
	{
		$sql = "SELECT * FROM ticket_component ORDER BY label ASC";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			return $stmt;
		}

		$stmt->close();
	}


	public function countTickets()
	{
		$sql = "SELECT COUNT(*) AS NumberOfUsers FROM users";

		$result = $this->connection->query($sql);
		
		return $this->aMessage['countUsers'] = $result->fetch_object();
	}

	public function getTickets()
	{

		$sql = "
		SELECT 
			a.*, t.ticket_id, t.title, t.description, t.created_date, t.priority, t.type, t.ticket_status, t.amount, 
			TIMESTAMPDIFF(day, DATE_FORMAT(t.created_date, '%Y-%m-%d'), CURDATE()) AS passed_days,
			t.resolution, t.ticket_component_ref, DATE_FORMAT(t.created_date, '%Y-%m-%d') AS formatted_date,
			TIMESTAMPDIFF(day, CURDATE(), DATE_ADD(DATE_FORMAT(t.created_date, '%Y-%m-%d'), INTERVAL t.timeline DAY)) AS remaining_days, t.timeline,
			DATE_ADD(DATE_FORMAT(t.created_date, '%Y-%m-%d'), INTERVAL t.timeline DAY) AS ticket_expired_date, t.created_by, ticket_component.label AS label, CONCAT(u.firstname, ' ', u.surname) AS fullname, u.user_id 
		FROM 
			`assign_ticket` a 
		INNER JOIN 
			(SELECT ticket_ref, MAX(assign_date) maxDate FROM assign_ticket GROUP BY ticket_ref) b ON a.ticket_ref = b.ticket_ref AND a.assign_date = b.maxDate
		LEFT JOIN 
			tickets t ON t.ticket_id = a.ticket_ref
		LEFT JOIN 
			ticket_component ON (ticket_component.ticket_component_id = t.ticket_component_ref) 
		LEFT JOIN 
			users u ON (u.user_id = a.user_ref)
		WHERE
			t.status = '1'
		";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			return $stmt;
		}
	
		$stmt->close();
	}

	public function getTicket($id)
	{
		
		$sql = "
			SELECT 
				t.ticket_id, t.title, t.description, t.created_date, t.priority, t.type, t.ticket_status, t.status, t.amount, 
				TIMESTAMPDIFF(day, DATE_FORMAT(t.created_date, '%Y-%m-%d'), CURDATE()) AS passed_days,
				t.resolution, t.ticket_component_ref, DATE_FORMAT(t.created_date, '%Y-%m-%d') AS formatted_date,
				TIMESTAMPDIFF(day, CURDATE(), DATE_ADD(DATE_FORMAT(t.created_date, '%Y-%m-%d'), INTERVAL t.timeline DAY)) AS remaining_days, t.timeline,
				DATE_ADD(DATE_FORMAT(t.created_date, '%Y-%m-%d'), INTERVAL t.timeline DAY) AS ticket_expired_date, t.created_by, ticket_component.label AS label,
				CONCAT(u.firstname, ' ', u.surname) AS fullname 
			FROM 
				tickets t 
			LEFT JOIN 
				ticket_component ON (ticket_component.ticket_component_id = t.ticket_component_ref) 
			LEFT JOIN 
	 			assign_ticket ON (assign_ticket.ticket_ref = t.ticket_id)
	 		LEFT JOIN 
	 			users u ON (u.user_id = assign_ticket.user_ref)
			WHERE 
				t.ticket_id = {$id} AND t.status = '1'
		";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			$result = $stmt->fetch_object();
			return $result;
		}

		$stmt->close();
	}

	public function deleteTicket($id)
	{

		$sql = "UPDATE tickets SET status = '0' WHERE ticket_id  = ?";

		$stmt = $this->connection->prepare($sql);
		$id = (int) $id;
		$stmt->bind_param('i', $id);

		$stmt->execute();

		if($stmt)
		{
			return $stmt->error;
		}
		
		$stmt->close();
	}

	public function addTicket($title, $desc, $priority, $type = "0", $assign = null, $duration = "7", $amount, $created_by, $component)
	{
		// If assigned to a user is true, check if trigger "assign_user_to_ticket" if not exists, create trigger 

		if($assign != "")
		{ 
			$assign = (int) $assign;

			$create_trigger_query = "CREATE TRIGGER assign_user_to_ticket AFTER INSERT ON tickets FOR EACH ROW INSERT INTO assign_ticket (ticket_ref, user_ref) VALUES(NEW.ticket_id, {$assign});";

			$this->connection->query("DROP TRIGGER IF EXISTS assign_user_to_ticket");

			$this->connection->query($create_trigger_query);
		}
		else
		{
			$this->connection->query("DROP TRIGGER IF EXISTS assign_user_to_ticket");
		}
		
			

		$sql = "INSERT INTO tickets (title, description, priority, type, timeline, amount, created_by, ticket_component_ref) VALUES (?,?,?,?,?,?,?,?)";

		$stmt = $this->connection->prepare($sql);

		$stmt->bind_param('sssssiss', $title, $desc, $priority, $type, $duration, $amount, $created_by, $component);
		
		

		$stmt->execute();

		if($stmt)
		{
			return $stmt;
		}
	
		$stmt->close();
	}

	public function updateTicket($id, $first, $surname, $email, $user, $pass = "", $active)
	{
		$column = '';
		$col_val = '';

		if(!empty($pass))
		{
			$column .= ',password = ?';
			$col_val  .= $this->hashPassword($pass);
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
		

		if($stmt)
		{
			return true;
		}
		else
		{
			return $this->connection->error;
		}

		$stmt->close();
	}

	public function assignTicket($ticket_ref, $ticket_id, $user_ref)
	{

		$sql = "INSERT INTO assign_ticket (ticket_ref, $user_ref) VALUES (?)";

		$stmt = $this->connection->prepare($sql);

		$stmt->bind_param('s',$ticket_ref);
		$stmt->execute();

		if($stmt->error == null)
		{
			// Now update ticke status
			$updateTicketStatus = $this->connection->query("UPDATE tickets  set status = '2' WHERE ticket_id={$ticket_id}");
			$this->aMessage['success'] = "Successfully Updated";
		}
	
		return $this->aMessage;
	}

	public function addTicketComment($ticket_ref, $assign_ticket_ref, $comment, $status = '1')
	{
		$updated_by = $_SESSION['user_info']['firstname'] . " " . $_SESSION['user_info']['surname']; 

		
		$assign = (int) $assign;

		$create_trigger_query = "CREATE TRIGGER assign_when_commenting BEFORE INSERT ON ticket_comments FOR EACH ROW INSERT INTO assign_ticket (ticket_ref, user_ref) VALUES(NEW.ticket_ref, NEW.assign_ticket_ref);";

		$this->connection->query("DROP TRIGGER IF EXISTS assign_when_commenting");

		$this->connection->query($create_trigger_query);
		

		$sql = "INSERT INTO ticket_comments (ticket_ref, assign_ticket_ref, comment, updated_by, status) VALUES (?,?,?,?,?)";

		$stmt = $this->connection->prepare($sql);

		$ticket_ref = (int) $ticket_ref;
		$assign_ticket_ref = (int) $assign_ticket_ref;

		$stmt->bind_param('iisss', $ticket_ref, $assign_ticket_ref, $comment, $updated_by, $status);
		$stmt->execute();

		if($stmt->error == null)
		{
			// Now update ticke status
		
			$this->aMessage['success'] = "Successfully Updated";
		}
			
		return $this->aMessage;
	}

	public function getTicketComments($ticket_ref)
	{
		
		$sql = "SELECT * FROM ticket_comments WHERE ticket_ref = {$ticket_ref}";
		
		$stmt = $this->connection->query($sql);
		
		if($stmt)
		{
			return $stmt;
		}

		$stmt->close();
	}
}