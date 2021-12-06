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
include("database.php");
if(isset($_POST['submit'])){

	
require('PHPExcel/Classes/PHPExcel.php');
require('PHPExcel/Classes/PHPExcel/IOFactory.php');

$file = $_FILES['file']['tmp_name'];	
$obj = PHPExcel_IOFactory::load($file);
foreach ($obj->getWorksheetIterator() as $sheet){
	$highestrow = $sheet->getHighestRow();
		for($i = 2;$i<=$highestrow;$i++){
			$name = $sheet->getCellByColumnAndRow(0,$i)->getValue();
			$rollnum = $sheet->getCellByColumnAndRow(1,$i)->getValue();
			$year = $sheet->getCellByColumnAndRow(2,$i)->getValue();
			$sem = $sheet->getCellByColumnAndRow(3,$i)->getValue();

		mysqli_query($conn,"insert into stddata values('$name','$rollnum',$year, $sem)");}

}
echo "<script>alert('Student data uploaded successfully');</script>";
}

?>


<?php
include('header.php');
?>

<div align="right" class="mr-3">
	<a href="logout.php">Logout -></a>	
</div>

<section class="mt-4 mb-4 container">
	<form method="post">
		<div class="container text-center">
			<h4 class="mb-1">Enter Rollnumber</h4>
		<input type="text" name="checkStudent" class="text-center" placeholder="Ex: 17hu1a0548" style="width: 200px;display: inline-flex;" required><br>
		<input type="submit" name="submitRollnum" value="Get data" class="mt-4 btn btn-outline-success">
	</div>
	</form>
</section>


<section class="mt-3 mb-2">
	<?php
	include("database.php");

		if(isset($_POST['submitRollnum']))
		{
			$rollnum = $_POST['checkStudent'];

			$sql = mysqli_query($conn, "select * from pecentages where Rollnum = '$rollnum' ");
			$result = mysqli_fetch_array($sql);

			if ($result < 1) {
				echo "<script>alert('Data not found');</script>";	
			}

			$name = $result['Name'];
			$rollnum = $result['Rollnum'];
			$department = $result['Department'];
			$sqlData = mysqli_query($conn, "select * from pecentages where Rollnum = '$rollnum' ");

				?>
<div class="table-responsive container">
	<div class="mb-3 mt-3" style="display: flex;justify-content: space-between;">
		<h5 class="text-left"><span style="color: red;">Student Name</span> : <?php echo " $name";?></h5> <h5 class="text-center"><span style="color: green;">Roll number</span> : <?php echo " $rollnum";?></h5> <h5 class="text-right"><span style="color: blue;">Department</span> : <?php echo " $department";?></h5>
	</div>
	<table class="table">
		<thead>
			<tr class="text-center">
				<th style="color: orange;">Year</th>
				<th style="color: pink;">Semester</th>
				<th style="color: yellow;">Percentage</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($row = mysqli_fetch_array($sqlData))
							{
								  $year = $row['year'];
								  $sem = $row['semester'];
								  $percentage = $row['Percentage'];
							

								echo "<tr class='text-center'>
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

		}

	?>
</section>



<section class="mt-4 mb-4 container">
<form method="post" action="" enctype="multipart/form-data">
<div class="text-center container" style="position: relative;top: 80px;">
	<h4 class="mb-4">Please select sheet</h4>
	<input type="file" name="file" class="form-control" style="width: 100%;" align="center" required><br>
	<input type="submit" name="submit" value="upload" class="btn btn-outline-success">
</div>
</form>
</section>

<br><br><br><br>

<?php
include('footer.php');
?>

</body>
</html>