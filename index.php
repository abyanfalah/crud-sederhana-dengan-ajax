<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple jquery ajax</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
</head>
<body>
	<?php 
		include 'connection.php'; 
		// echo new_id();
	?>

	<div class="container">
		<div class="row">
			<div class="col">
				<div>
					<h3 class="d-inline-block">List of user</h3>
					<button id="btnAdd" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">+ Add user</button>
				</div>

				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>id</th>
							<th>name</th>
							<th>dob</th>
							<th colspan="2">option</th>
						</tr>
					</thead>

					<tbody id="userTable">
						<!-- data retrieved with ajax -->
					</tbody>
				</table>
			</div>		
		</div>
	</div>

	<?php 
		include 'modals/add.php';
		include 'modals/edit.php';

	?>


	<script type="text/javascript" src="assets/jquery.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>