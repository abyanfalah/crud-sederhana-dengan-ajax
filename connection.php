<?php
	$mysqli = new mysqli(
		'localhost',
		'abyan',
		'scootermania',
		'dummy'
	);

	$err = $mysqli->connect_error;
	$err ? die($err) : null ;

	function new_id(){
		global $mysqli;

		$id = 'U01';
		$last = $mysqli->query('select id from user order by id desc limit 1');
		if ($last->num_rows > 0) {
			$last = $last->fetch_object()->id;
			$new = substr($last, 1);
			$new += 1;
			$new = substr($last, 0, -(strlen($new))).$new;
			return $new;
		}else{
			return $id;
		}
	}

	class API
	{
		private $mysqli = false;
		public $table = 'dummy';
		
		function __construct($mysqli)
		{
			$this->mysqli = $mysqli;
		}

		public function create_user($data)
		{
			$query = "INSERT INTO user SET 
				id  ='".new_id()."', 
				name='".$data['name']."',
				dob ='".$data['dob']."'
			";

			if ($this->mysqli->query($query)) {
				$message = 'User created';
				$status = true;
			}else{
				$message = $this->mysqli->error;
				$status = false;
			}

			$res = [
				"message" => $message,
				"status" => $status
			];

			header('Content-Type: application/json');
			echo json_encode($res);
		}

		public function get_user($id = null)
		{
			$query = 'select * from user';

			if ($id) {
				$query .= ' where id = "'.$id.'"';
			}

			if ($result = $this->mysqli->query($query)) {
				$user = array();
				while ($data = $result->fetch_object()) {
					$user[] = $data;
				}
			}else{
				die("can't get user(s)");
				// die($query);
			}

			header('Content-Type: application/json');
			echo json_encode($user);
		}


	}



?>