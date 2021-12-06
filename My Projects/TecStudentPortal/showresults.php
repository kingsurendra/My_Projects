<?php
session_start();
include('database.php');
	/* Filter by department */
	$dept = $_SESSION['Department'];
  $sql = mysqli_query($conn, "select * from pecentages where Department = '$dept' ORDER BY year desc ");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tech Student Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/teclogo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
</head>
<body>
<?php
include('header.php');
?>

<div class="table-responsive">
	<table class="table">
		<thead>
			<tr class="text-center">
				<th>Name</th>
				<th>RollNum</th>
				<th>Dept</th>
				<th>Year</th>
				<th>Semester</th>
				<th>Percentage</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($row = mysqli_fetch_array($sql))
							{
								  $name = $row['Name'];
								  $rollnum = $row['Rollnum'];
								  $department = $row['Department'];
								  $year = $row['year'];
								  $sem = $row['semester'];
								  $percentage = $row['Percentage'];
							

								echo "<tr class='text-center'>
											<td>$name</td>
											<td>$rollnum</td>
											<td>$department</td>
											<td>$year</td>
											<td>$sem</td>
											<td>$percentage</td>
									  </tr>";
						}
			?>
		</tbody>
	</table>
</div>
<?php
include('footer.php');
?>
</body>
</html>