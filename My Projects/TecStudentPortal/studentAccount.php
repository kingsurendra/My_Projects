<?php
session_start();
error_reporting(0);
include('database.php');
$name =  $_SESSION["Name"];
$rollnum = $_SESSION["rollnum"];

          if (strlen($_SESSION['rollnum']) == 0) {header('location:index.php');}
?>
<?php
if(isset($_POST['addmarkssubmit']))
{
	$year = $_POST['year'];
	$sem = $_POST['semester'];
	
	$sub1 = $_POST['subject1'];
	$sub2 = $_POST['subject2'];
	$sub3 = $_POST['subject3'];
	$sub4 = $_POST['subject4'];
	$sub5 = $_POST['subject5'];
	$sub6 = $_POST['subject6'];
	$sub7 = $_POST['subject7'];
	$sub8 = $_POST['subject8'];

	$totalscore = $sub1 + $sub2 + $sub3 + $sub4 + $sub5 + $sub6 + $sub7 + $sub8;
	$percentage = $totalscore / 800 * 100;

	$sql = mysqli_query($conn, "select * from students where Rollnum = '$rollnum' ");
   $result = mysqli_fetch_array($sql);

   $deptname = $result['Deptname'];


   $insertintdb = mysqli_query($conn, "insert into pecentages values('$name','$rollnum','$deptname','$year','$sem','$percentage')");
   if ($insertintdb) {
   ?>
    		  <script type="text/javascript">
                alert("Data inserted successfully :)");
              </script>
     <?php
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

<!-- Check marks and logout  -->
<div style="display: flex;justify-content: space-between;">
<div align="left" class="ml-3">
	<form action="" method="post">
		<input type="submit" name="getResult" value="Check your Scores" style="border: none;background-color: white;outline: none;" class="text-primary"><hr style="width: 80px;border-bottom: 2px solid green; margin-top: 2px;" class="text-success">
	</form>	
</div>

<div align="right" class="mr-3">
  <a href="logout.php">Logout -></a>  
</div>

</div>
<!-- Main body  -->

<h3 class="text-center mt-4">Welcome <?php echo "$name";?></h3>
<p class="container text-justify">Wishing you will be a successful person in life, that will be the best gift for us. So work hard and achieve your success. In your life, you will face many bad and hard times. Never lose hope in your bad time.</p>

<div align="center" class="mt-4">
	<button id="addMarks"><a href="" data-toggle="modal" data-target="#addmarks" style="text-decoration: none;display: block;" onclick="add()">Add marks</a></button>
</div><br><br>


<!--Add Marks model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="addmarks" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Add Marks</h3>
        </div>
        <div class="modal-body">
          <form method="post">

        <div class="">
        <label for="year">Year</label>
         <select id="year" name="year" required class="form-control" style="text-indent: 10px;">
              <option></option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
           </select>
        </div>

        <div class="mt-3">
        <label for="sem">Semester</label>
         <select id="sem" name="semester" required class="form-control" style="text-indent: 10px;">
              <option></option>
              <option value="1">1</option>
              <option value="2">2</option>
           </select>
        </div>

        <p class="text-center mt-3">Enter marks of the subject</p>

        <div class="mt-3">
        <label for="subject1">Subject 1</label>
        <input type="text" class="" id="subject1" required placeholder="Enter subject1 score" name="subject1" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject2">Subject 2</label>
        <input type="text" class="" id="subject2" required placeholder="Enter subject2 score" name="subject2" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject3">Subject 3</label>
        <input type="text" class="" id="subject3" required placeholder="Enter subject3 score" name="subject3" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject4">Subject 4</label>
        <input type="text" class="" id="subject4" required placeholder="Enter subject4 score" name="subject4" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject5">Subject 5</label>
        <input type="text" class="" id="subject5" required placeholder="Enter subject5 score" name="subject5" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject6">Subject 6</label>
        <input type="text" class="" id="subject6" required placeholder="Enter subject6 score" name="subject6" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject7">Subject 7</label>
        <input type="text" class="" id="subject7" required placeholder="Enter Lab1 score" name="subject7" style="text-indent: 10px;">  
        </div>

        <div class="mt-3 mb-3">
        <label for="subject8">Subject 8</label>
        <input type="text" class="" id="subject8" required placeholder="Enter Lab2 score" name="subject8" style="text-indent: 10px;">  
        </div>
        <button type="submit" class="btn text-white" name="addmarkssubmit">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>

<!-- Showing Results -->

<?php

if (isset($_POST['getResult'])) {
	
	$query = mysqli_query($conn, "select * from pecentages where Rollnum = '$rollnum'");
	$check = mysqli_fetch_array($query);

	$sql = mysqli_query($conn, "select * from pecentages where Rollnum = '$rollnum'");

	if ($check < 1) {
		echo "<script>alert('You were not stored any data');</script>";
	}
else
{

?>
	<div class="container table-responsive">
	<table class="table">
		<thead>
			<tr class="text-center">
				<th style="color: red;">Year</th>
				<th style="color: green;">Semester</th>
				<th style="color: blue;">Percentage</th>
        <th>Remark</th>
			</tr>
		</thead>
		<tbody>
			<?php

			while($row = mysqli_fetch_array($sql))
			{
          $Rollnum = $row['Rollnum'];
				  $year = $row['year'];
				  $sem = $row['semester'];
				  $percentage = $row['Percentage'];
          $_SESSION['roll_num'] = $Rollnum;
				echo "<tr class='text-center'>
							<td>$year</td>
							<td>$sem</td>
							<td>$percentage</td>
              <td>
              <form action='updateStdData.php' method='post'>
                <input type='hidden' value='$row[Rollnum]' name='roll_num'>
                <input type='hidden' value='$row[year]' name='year_edit'>
                <input type='hidden' value='$row[semester]' name='sem_edit'>
                <input type='hidden' value='$row[Percentage]' name='percent_edit'>
                <input class='btn btn-primary' type='submit' name='edit' value='Edit'>
              </form>
              </td>
					  </tr>";
				}

			?>
		</tbody>
	</table>
</div>
<?php
}}

?>

<?php
include('footer.php');
?>
</body>
</html>