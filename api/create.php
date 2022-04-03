<?php 
	include '../connection.php';
	$api = new API($mysqli);

	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			$api->create_user($_POST);
			break;
		
		default:
			header('HTTP/1.0 405 Method Not Allowed');
			break;
	}

?>