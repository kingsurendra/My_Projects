<?php

include('config.php');
error_reporting(0);
// Delete user

if (isset($_POST["delete"])) {
	# code...
	$userId = $_POST['id'];

	$sql =  $conn->prepare("DELETE FROM `users` WHERE id = $userId ");
	$sql->bind_param("i", $userId);
	$sql->execute();

	if ($sql == TRUE) echo "<script>alert('User Deleted successfully');</script>";
	else echo "<script>alert('User not deleted, please try again!');</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Techweblabs | View data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/teclogo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
	<style type="text/css">
		h3 {
	text-transform: uppercase;
	background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
}
	</style>
</head>
<body>

	<div class="container pt-5">
		<h3 class="text-center"><b>Techweblabs</b></h3>
	</div>
	<div class="container pr-5 pb-4">
		<a href="create.php" class="btn btn-primary float-right">Insert users</a>
	</div>
	<section class="container p-5">
		<div class="table-responsive">
			<table class="table">
					<thead>
						<tr>
							<th>S.no</th>
							<th>Name</th>
							<th>Email Id</th>
							<th>Phone Number</th>
							<th colspan="2" align="center">Action</th>
						</tr>		
					</thead>
					<tbody>
						<?php

						include('config.php');

						$sql = $conn->prepare("SELECT * FROM `users`");
						$sql->execute();
						$res = $sql->get_result();

						while ($result = $res->fetch_assoc()) {
							# code...
							?>
							<tr>
								<td><?php echo($result['id']);?></td>
								<td><?php echo($result['Name']);?></td>
								<td><?php echo($result['Email']);?></td>
								<td><?php echo($result['Phone']);?></td>
								<td><a  class="btn btn-success" href="update.php?id=<?php echo $result['id'];?>">Update</a></td>
								<form action="" method="post">
									<input type="hidden" name="id" value="<?php echo $result['id'];?>">
									<td><button type="submit" name="delete" class="btn btn-danger">Delete</button></td>
								</form>
							</tr>
						<?php
						}

						?>
					</tbody>
			</table>
		</div>
	</section>

</body>
</html>