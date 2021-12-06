<?php
session_start();
// $roll_number = $_SESSION['roll_num'];
include("database.php");

 if (isset($_POST['edit'])) 
 {
      $year_edit = $_POST['year_edit'];
      $sem_edit = $_POST['sem_edit'];
      $percent_edit = $_POST['percent_edit']; 
      $roll_num = $_POST['roll_num'];     
}

# Get deptname of student


if (isset($_POST['update_data'])) {

	$roll_num = $_POST['rollnum'];
	$year = $_POST['year'];
	$sem = $_POST['sem'];
	$percent = $_POST['percent'];

	$deptname = mysqli_query($conn, "select * from students where Rollnum = '$roll_num' ");
	$resultdeptname = mysqli_fetch_array($deptname);
	$dept = $resultdeptname['Deptname'];

	#Update Edited data
 	$stdData = mysqli_query($conn, "select * from updatedata where Rollnumber = '$roll_num' and Year = $year and Semester = $sem");
 	$result = mysqli_fetch_array($stdData);
 	if($result >= 1){
 	$sql = mysqli_query($conn, "update updatedata set Rollnumber = '$roll_num', Year = $year, Semester = $sem, Percentage = '$percent', Dept = '$dept' where Rollnumber = '$roll_num' and Year = $year and Semester = $sem " );

 		if ($sql) {
 		?>
 			<script type="text/javascript">
 				alert("Modified successfully. Wait for the approval by HOD.");
 			</script>
 			<meta http-equiv="refresh" content="0,url=/My Projects/TecStudentPortal/studentAccount.php">
 		<?php

 		}
 	}
 else{
 	#Insert Edited data

	$sql = mysqli_query($conn, "insert into updatedata values('$roll_num',$year,$sem,'$percent','$dept')");
	
if ($sql) {
	?>
 			<script type="text/javascript">
 				alert("Updated successfully. Wait for the approval by HOD.");
 			</script>
 			<meta http-equiv="refresh" content="0,url=/My Projects/TecStudentPortal/studentAccount.php">
 		<?php
}
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
<?php
include('header.php');
?>
<body>

<h4 class="text-center text-success mt-4 mb-4">Update your details</h4>

<form action="" method="post">
	<table align="center" class="text-center">
		<tr>
			<th>Year</th>
			<th>Semester</th>
			<th>Percentage</th>
		</tr>
		<tr>
			
			<td><input type="text" name="year" class="text-center" value="<?php echo "$year_edit";?>"></td>
			<td><input type="text" name="sem" class="text-center" value="<?php echo "$sem_edit";?>"></td>
			<td><input type="text" name="percent" class="text-center" value="<?php echo "$percent_edit";?>"></td>
			<td><input type="hidden" name="rollnum" class="text-center" value="<?php echo "$roll_num";?>"></td>

		</tr>

	</table>
	<button type="submit" name="update_data" class="mt-4 mb-4" style="outline: none;">Update</button>
</form>
<?php
include('footer.php');
?>
</body>
</html>
