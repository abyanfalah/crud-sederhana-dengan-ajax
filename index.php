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
					<button class="btn btn-danger" id="btnTruncate">Truncate</button>
				</div>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>ID</th>
							<th>Name</th>
							<th>DOB</th>
							<th colspan="2" class="text-center">Option</th>
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