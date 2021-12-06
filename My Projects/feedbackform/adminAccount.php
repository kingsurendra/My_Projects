<?php
session_start();
include('database.php');
$name =  $_SESSION["Name"];

$sql = mysqli_query($conn, "select department from admin where name = '$name' ");
$query = mysqli_fetch_array($sql);
$dept = $query['department'];

/*  Add Subjects */

if (isset($_POST['addsubjectssubmit'])) {
      
    $year = $_POST['year'];
    $sem = $_POST['semester'];
    $subject1 = $_POST['subject1'];
    $subject2 = $_POST['subject2'];
    $subject3 = $_POST['subject3'];
    $subject4 = $_POST['subject4'];
    $subject5 = $_POST['subject5'];
    $subject6 = $_POST['subject6'];

    $check = mysqli_query($conn, "select * from subjects where year = '$year' and semester = '$sem' ");
    $result = mysqli_fetch_array($check);


  if ($result < 1) 

    {

            $sql = mysqli_query($conn, "insert into subjects values('$dept','$year','$sem','$subject1','$subject2','$subject3','$subject4','$subject5','$subject6')");

            if ($sql) {
              echo "<script>alert('Uploaded successfully');</script>";
            }
            else{
              echo "<script>alert('Failed to upload, Pleaase try again');</script>";
            }
    }
    else{
      echo "<script>alert('Subjects are already alloted to ".$year."  ".$sem." semester ');</script>";
    }
}

/* Add Students */

if(isset($_POST['addstds'])){  
require('PHPExcel/Classes/PHPExcel.php');
require('PHPExcel/Classes/PHPExcel/IOFactory.php');

$file = $_FILES['file']['tmp_name'];  
$obj = PHPExcel_IOFactory::load($file);
foreach ($obj->getWorksheetIterator() as $sheet){
  $highestrow = $sheet->getHighestRow();
    for($i = 2;$i<=$highestrow;$i++){
      $rollnum = strtolower($sheet->getCellByColumnAndRow(0,$i)->getValue());
      $year = strtolower($sheet->getCellByColumnAndRow(1,$i)->getValue());
      $sem = strtolower($sheet->getCellByColumnAndRow(2,$i)->getValue());
      $dept = strtolower($sheet->getCellByColumnAndRow(3,$i)->getValue());

      $sqll = mysqli_query($conn, "select * from students where Rollnum = '$rollnum'");
      $results = mysqli_fetch_array($sqll);
      if($results >= 1){mysqli_query($conn,"update students set Rollnum = '$rollnum', Year = $year, Semester = $sem, department = '$dept' where Rollnum = '$rollnum' ");}
      else{mysqli_query($conn,"insert into students values('$rollnum',$year, $sem,'$dept')");  
    }}
    echo "<script>alert('Student data uploaded successfully');</script>";}
  }

/* Add faluty */

if(isset($_POST['addfac'])){  
require('PHPExcel/Classes/PHPExcel.php');
require('PHPExcel/Classes/PHPExcel/IOFactory.php');

$file = $_FILES['file']['tmp_name'];  
$obj = PHPExcel_IOFactory::load($file);
foreach ($obj->getWorksheetIterator() as $sheet){
  $highestrow = $sheet->getHighestRow();
    for($i = 2;$i<=$highestrow;$i++){
      $name = $sheet->getCellByColumnAndRow(0,$i)->getValue();
      $subject = $sheet->getCellByColumnAndRow(1,$i)->getValue();
    mysqli_query($conn,"insert into faculty values('$name','$subject')");}
}
echo "<script>alert('Faculty data uploaded successfully');</script>";
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/teclogo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php
include('header.php');
?>

<div style="display: flex;justify-content: space-between;">
<div align="left" class="ml-3">
  <a href="" data-toggle="modal" data-target="#selectoption" style="text-decoration: none;display: block;">Check Feedbacks</a>
</div>



<div align="right" class="mr-3">
	<a href="logout.php">Logout -></a>	
</div>
</div>

<div align="left" class="ml-3">
  <a href="" data-toggle="modal" data-target="#selectfac" style="text-decoration: none;color: green;">Feedback by Faculty</a>
</div>

<!-- Main body  -->

<h3 class="text-center mt-3">Welcome <?php echo "$name";?></h3>
<p class="container text-justify">Wishing you will be a successful person in life, that will be the best gift for us. So work hard and achieve your success. In your life, you will face many bad and hard times. Never lose hope in your bad time.</p>


<div align="center" class="mt-4 mb-4">
  <button class="btn btn-outline-success mr-4 mt-2" style="font-size: 20px;"><a href="" data-toggle="modal" data-target="#addfaculty" style="text-decoration: none;display: block;color: black;">Add Faculty</a></button>
	<button class="btn btn-outline-primary mt-2" style="font-size: 20px;"><a href="" data-toggle="modal" data-target="#addsubjects" style="text-decoration: none;display: block;color: black;">Add subjects</a></button>
   <button class="btn btn-outline-warning ml-4 mt-2" style="font-size: 20px;"><a href="" data-toggle="modal" data-target="#addstd" style="text-decoration: none;display: block;color: black;">Add Students</a></button>
</div>

<!-- Showing Results -->

<?php

if (isset($_POST['selectOption'])) {
  
  $year = $_POST['year'];
  $sem = $_POST['semester'];

  $query = mysqli_query($conn, "select * from score where year = $year and sem = $sem ");
  $check = mysqli_fetch_array($query);

  $sql = mysqli_query($conn, "select * from score where year = $year and sem = $sem  group by Subject ");

  if ($check < 1) {
    echo "<script>alert('No data found');</script>";
  }
else
{

?>
  <div class="container table-responsive">
  <table class="table">
    <thead>
      <tr class="text-center">
        <th style="color: red;">Subject</th>
        <th style="color: green;">Score</th>
        <th style="color: blue;">Remark</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $count = 0;
      
      while($row = mysqli_fetch_array($sql))
      {
          $subject = $row['Subject'];
          $score = $row['Score'];
         # $remark = $row['Remark'];
        
          $subaddcount = mysqli_query($conn, "select sum(Score) as Score from score where Subject = '$subject' ");
          $resultsubaddcount = mysqli_fetch_array($subaddcount);
          $resultsubaddcountscore = $resultsubaddcount['Score'];

          $subcount = mysqli_query($conn, "select count(Subject) as subcount from score where Subject = '$subject'");
          $resultsubcount = mysqli_fetch_array($subcount);
          $resultsubcountsub = $resultsubcount['subcount'];
          $count = $resultsubcount['subcount'];

          $totalScore = intval($resultsubaddcountscore / $resultsubcountsub);

        if($totalScore >= 80 and $totalScore <= 100)
        {
          $remark = "Excellent";
        }
        else if ($totalScore >= 60 and $totalScore < 80) {
          $remark = "Very Good";
          
        }
        else if ($totalScore >= 40 and $totalScore < 60) {
          $remark = "Good";
        }
        else if ($totalScore >= 20 and $totalScore < 40) {
          $remark = "Need to improve";
        }
        else if ($totalScore >= 10 and $totalScore < 20) {
          $remark = "Not bad";
        }

        else {
          $remark = "Bad";
        }


        echo "<tr class='text-center'>
              <td>$subject</td>
              <td>$totalScore</td>
              <td>$remark</td>
            </tr>";
        }
        echo "<script>alert('$count responces are recorded');</script>";
      }
    }

/* Filter by individual faculty */

if (isset($_POST['filterByFac'])) {
  
  $facultyName = $_POST['fac'];

  $query = mysqli_query($conn, "select * from score where facultyName = '$facultyName' ");
  $check = mysqli_fetch_array($query);
  $fname = $check['facultyName'];

  $sql = mysqli_query($conn, "select * from score where facultyName = '$facultyName' group by Subject ");

  if ($check < 1) {
    echo "<script>alert('No data found');</script>";
  }
else
{

?>
  <div class="container table-responsive">
    
  <table class="table">
    <p class="text-center">Faculty name: <?php echo "<span class='text-success' style='font-size:30px;'>$fname</span>";?></p>
    <thead>
      <tr class="text-center">
        <th style="color: red;">Subject</th>
        <th style="color: green;">Score</th>
        <th style="color: blue;">Remark</th>
      </tr>
    </thead>
    <tbody>
      <?php

      while($row = mysqli_fetch_array($sql))
      {
          $subject = $row['Subject'];
          $score = $row['Score'];
        #  $remark = $row['Remark'];
      
           $subaddcount = mysqli_query($conn, "select sum(Score) as Score from score where Subject = '$subject' ");
          $resultsubaddcount = mysqli_fetch_array($subaddcount);
          $resultsubaddcountscore = $resultsubaddcount['Score'];
          
          $subcount = mysqli_query($conn, "select count(Subject) as subcount from score where Subject = '$subject'");
          $resultsubcount = mysqli_fetch_array($subcount);
          $resultsubcountsub = $resultsubcount['subcount'];

          $totalScore = intval($resultsubaddcountscore / $resultsubcountsub);

        if($totalScore >= 80 and $totalScore <= 100)
        {
          $remark = "Excellent";
        }
        else if ($totalScore >= 60 and $totalScore < 80) {
          $remark = "Very Good";
          
        }
        else if ($totalScore >= 40 and $totalScore < 60) {
          $remark = "Good";
        }
        else if ($totalScore >= 20 and $totalScore < 40) {
          $remark = "Need to improve";
        }
        else if ($totalScore >= 10 and $totalScore < 20) {
          $remark = "Not bad";
        }
        
        else {
          $remark = "Bad";
        }



        echo "<tr class='text-center'>
              <td>$subject</td>
              <td>$totalScore</td>
              <td>$remark</td>
            </tr>";
        }
      }
    }

      ?>


<!-- <div align="center" class="mt-4 mb-4">
  <button class="btn btn-outline-warning" style="font-size: 20px;"><a href="" data-toggle="modal" data-target="#addstd" style="text-decoration: none;display: block;">Add Students</a></button>
</div> -->


<!--Add Faculty-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="addfaculty" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Add Faculty</h3>
        </div>
        <div class="modal-body">
    <form method="post" enctype="multipart/form-data">
        <div class="mt-3 mb-4">
        <label>Choose file</label>
        <input type="file" name="file" class="form-control" required> 
        </div>        
        <button type="submit" class="btn text-white" name="addfac">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>


<!--Add Students-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="addstd" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Add Students</h3>
        </div>
        <div class="modal-body">
    <form method="post" enctype="multipart/form-data">
        <div class="mt-3 mb-4">
        <label>Choose file</label>
        <input type="file" name="file" class="form-control" required> 
        </div>        

        <button type="submit" class="btn text-white" name="addstds">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>

<!--Filter feedback individually by faculty name -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="selectfac" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Select Faculty</h3>
        </div>
        <div class="modal-body">

    <form method="post">
        <div class="mt-3">
        <label for="fac">Choose Faculty</label>
        <select name="fac" id="fac" class="form-control" required  style="text-indent: 10px;">
          <option></option>
      <?php

        $sql = mysqli_query($conn, "select distinct Name from faculty");
        while ($row = mysqli_fetch_array($sql)) {
           $name = $row['Name'];
           $subject = $row['Subject']; 
            
            echo "<option>$name</option>";
      }  
      ?>
      </select>
        </div>        

        <button type="submit" class="btn text-white mt-4" name="filterByFac">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>


<!--Add Marks model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="selectoption" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Select option</h3>
        </div>
        <div class="modal-body">
          <form method="post">

        <div class="mt-3">
        <label for="year">Year</label>
        <select name="year" id="year" class="form-control" required  style="text-indent: 10px;">
          <option></option>
          <option>4</option>
          <option>3</option>
          <option>2</option>
          <option>1</option>
        </select>  
        </div>        

        <div class="mt-3 mb-4">
        <label for="semester">Semester</label>
        <select name="semester" id="semester" class="form-control" required  style="text-indent: 10px;">
          <option></option>
          <option>1</option>
          <option>2</option>
        </select>  
        </div>
        <button type="submit" class="btn text-white mt-4" name="selectOption">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>


<!--Add Subjects model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="addsubjects" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Add Subjects</h3>
        </div>
        <div class="modal-body">
          <form method="post">

        <div class="mt-3">
        <label for="year">Year</label>
        <select name="year" id="year" class="form-control" required  style="text-indent: 10px;">
          <option></option>
          <option>4</option>
          <option>3</option>
          <option>2</option>
          <option>1</option>
        </select>  
        </div>        

        <div class="mt-3">
        <label for="semester">Semester</label>
        <select name="semester" id="semester" class="form-control" required  style="text-indent: 10px;">
          <option></option>
          <option>1</option>
          <option>2</option>
        </select>  
        </div>

        <div class="mt-3">
        <label for="subject1">Subject 1</label>
        <input type="text" class="" id="subject1" required placeholder="Enter subject name" name="subject1" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject2">Subject 2</label>
        <input type="text" class="" id="subject2" required placeholder="Enter subject name" name="subject2" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject3">Subject 3</label>
        <input type="text" class="" id="subject3" required placeholder="Enter subject name" name="subject3" style="text-indent: 10px;">  
        </div>

        <div class="mt-3">
        <label for="subject4">Subject 4</label>
        <input type="text" class="" id="subject4" required placeholder="Enter subject name" name="subject4" style="text-indent: 10px;">  
        </div>

         <div class="mt-3">
        <label for="subject5">Subject 5</label>
        <input type="text" class="" id="subject5" required placeholder="Enter subject name" name="subject5" style="text-indent: 10px;">  
        </div>

        <div class="mt-3 mb-3">
        <label for="subject6">Subject 6</label>
        <input type="text" class="" id="subject6" required placeholder="Enter subject name" name="subject6" style="text-indent: 10px;">  
        </div>

        <button type="submit" class="btn text-white" name="addsubjectssubmit">Submit</button>
    </form>
        </div>
      </div> 
    </div>
  </div>
</div>

		</tbody>
	</table>
</div>

<?php
include('footer.php');
?>
</body>
</html>