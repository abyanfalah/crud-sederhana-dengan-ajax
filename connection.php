<?php
	//konfigurasi database disini
	$mysqli = new mysqli(
		'',//hostname
		'',//username
		'',//password
		''//database name
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
		public $table = 'user';
		
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

		public function update_user($data)
		{
			$id = $data['id'];
			$name = $data['name'];
			$dob = $data['dob'];

			$query = "update user set name ='".$name."', dob = '".$dob."' where id = '".$id."' ";

			if ($this->mysqli->query($query)) {
				$message = $id." successfully updated";
				$status = true;
			}else{
				$message = "failed to update $id";
				$status = false;
			}

			$res = [
				"message" => $message,
				"status" => $status
			];

			header('Content-Type: application/json');
			echo json_encode($res);
		}

		public function delete_user($data)
		{
			$id = $data['id'];
			if ($id) {
				$query = "delete from user where id = '".$id."'";
			}

			if ($this->mysqli->query($query)) {
				$message = "$id successfully deleted";
				$status = true;
			}else{
				$message = "failed to update $id";
				$status = false;	
			}

			$res = [
				"message" => $message,
				"status" => $status
			];

			header('Content-Type: application/json');
			echo json_encode($res);
		}


		// ================

		public function truncate()
		{
			if ($result = $this->mysqli->query('truncate'.$this->table)) {
				$message = 'truncated';
			}else{
				$message = 'failed to truncate';
			}
			echo $message;
		}


	}



?>
