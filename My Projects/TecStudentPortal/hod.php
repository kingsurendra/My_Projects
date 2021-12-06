<?php
include('database.php');
session_start();
error_reporting(0);
$name = $_SESSION['name'];

if (strlen($_SESSION['name']) == 0) {
        # code...
            header('location:index.php');
      }

	# Delete result
if (isset($_POST['delete'])) {
      $year_edit = $_POST['year_edit'];
      $sem_edit = $_POST['sem_edit'];
      $RollNum = $_POST['rollnum']; 

      $delete = mysqli_query($conn, "delete from updatedata where Rollnumber = '$RollNum' and Year = '$year_edit' and Semester = '$sem_edit' ");
      if ($delete) {
      	# code...
      	echo "<script>alert('Student request deleted');</script>";
      }
}

	# Approve result
if (isset($_POST['approve'])) {
      $year_edit = $_POST['year_edit'];
      $sem_edit = $_POST['sem_edit'];
      $RollNum = $_POST['rollnum']; 
      $percent = $_POST['percent']; 

      $approve = mysqli_query($conn, "update pecentages set Rollnum = '$RollNum', year = $year_edit, semester = $sem_edit, Percentage = '$percent' where Rollnum = '$RollNum' and year = $year_edit and semester = $sem_edit ");

      if ($approve) {
      	# code...
      	echo "<script>alert('Student request approved');</script>";
      	mysqli_query($conn, "delete from updatedata where Rollnumber = '$RollNum' and Year = '$year_edit' and Semester = '$sem_edit' ");
      }
}

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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
include('header.php');
?>
<div align="right" class="mr-3">
	<a href="logout.php">Logout -></a>	
</div>
<h4 class="text-center mt-4 mb-4 text-success">Requests from students to update marks</h4>
<br>
<?php

$sql = mysqli_query($conn, "select * from updatedata where Dept = '$name' ");
$result = mysqli_query($conn, "select * from updatedata where Dept = '$name' ");
$Result = mysqli_fetch_array($result);

?>
<div class="table-responsive">
<table class="table table-hover">
	<tr class="text-center">
		<th style="color: red;">Rollnum</th>
		<th style="color: green;">Year</th>
		<th style="color: blue;">Semester</th>
		<th style="color: yellow;">Percentage</th>
		<th style="color: red;" colspan="2">Action</th>
	</tr>
	<tr>
		<?php
		if ($Result < 1) {
			echo "<td colspan='5' class='text-center'>No data found</td>";
		}
		else{
		while($row = mysqli_fetch_array($sql))
		{
			$rollnum = $row['Rollnumber'];
			$year = $row['Year'];
			$sem = $row['Semester'];
			$percentage = $row['Percentage'];
									  
			echo "<tr class='text-center'>
				  <td>$rollnum</td>
				  <td>$year</td>
				  <td>$sem</td>
				  <td>$percentage</td>
				  <form method='post'>
                	<input type='hidden' value='$row[Year]' name='year_edit'>
                	<input type='hidden' value='$row[Semester]' name='sem_edit'>
                	<input type='hidden' value='$row[Rollnumber]' name='rollnum'>
                	<input type='hidden' value='$row[Percentage]' name='percent'>

				  <td><input class='btn btn-primary' type='submit' name='approve' value='Approve'>
				  <input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>
				  </form>
				  </tr>";
		}
	}
		?>
	</tr>
</table>
</div>
<?php



?>
<?php
include('footer.php');
?>

</body>
</html>