<?php
session_start();
include('database.php');

$rollnum = $_SESSION["rollnum"];

$sql = mysqli_query($conn, "select * from students where Rollnum = '$rollnum' ");
$query = mysqli_fetch_array($sql);
$dept = $query['Department'];
$year = $query['Year'];
$sem = $query['Semester'];

$subjects = mysqli_query($conn, "select * from subjects where department = '$dept' and year = '$year' and semester = '$sem' ");
$results = mysqli_fetch_array($subjects);
$sub1 = strtoupper($results['subject1']);
$sub2 = strtoupper($results['subject2']);
$sub3 = strtoupper($results['subject3']);
$sub4 = strtoupper($results['subject4']);
$sub5 = strtoupper($results['subject5']);
$sub6 = strtoupper($results['subject6']);


if (isset($_POST['addmarkssubmit']))
 {
      $a1 = $_POST['a1'];
      $a2 = $_POST['a2'];
      $a3 = $_POST['a3'];
      $a4 = $_POST['a4'];
      $a5 = $_POST['a5'];
      $a6 = $_POST['a6'];

      $b1 = $_POST['b1'];
      $b2 = $_POST['b2'];
      $b3 = $_POST['b3'];
      $b4 = $_POST['b4'];
      $b5 = $_POST['b5'];
      $b6 = $_POST['b6'];

      $c1 = $_POST['c1'];
      $c2 = $_POST['c2'];
      $c3 = $_POST['c3'];
      $c4 = $_POST['c4'];
      $c5 = $_POST['c5'];
      $c6 = $_POST['c6'];

      $d1 = $_POST['d1'];
      $d2 = $_POST['d2'];
      $d3 = $_POST['d3'];
      $d4 = $_POST['d4'];
      $d5 = $_POST['d5'];
      $d6 = $_POST['d6'];

      $e1 = $_POST['e1'];
      $e2 = $_POST['e2'];
      $e3 = $_POST['e3'];
      $e4 = $_POST['e4'];
      $e5 = $_POST['e5'];
      $e6 = $_POST['e6'];

      $f1 = $_POST['f1'];
      $f2 = $_POST['f2'];
      $f3 = $_POST['f3'];
      $f4 = $_POST['f4'];
      $f5 = $_POST['f5'];
      $f6 = $_POST['f6'];

      $g1 = $_POST['g1'];
      $g2 = $_POST['g2'];
      $g3 = $_POST['g3'];
      $g4 = $_POST['g4'];
      $g5 = $_POST['g5'];
      $g6 = $_POST['g6'];

      $h1 = $_POST['h1'];
      $h2 = $_POST['h2'];
      $h3 = $_POST['h3'];
      $h4 = $_POST['h4'];
      $h5 = $_POST['h5'];
      $h6 = $_POST['h6'];

      $j1 = $_POST['j1'];
      $j2 = $_POST['j2'];
      $j3 = $_POST['j3'];
      $j4 = $_POST['j4'];
      $j5 = $_POST['j5'];
      $j6 = $_POST['j6'];

      $i1 = $_POST['i1'];
      $i2 = $_POST['i2'];
      $i3 = $_POST['i3'];
      $i4 = $_POST['i4'];
      $i5 = $_POST['i5'];
      $i6 = $_POST['i6'];


      $subOneTotal = $a1 + $b1 + $c1 + $d1 + $e1 + $f1 + $g1 + $h1 + $i1 + $j1;
      $subTwoTotal = $a2 + $b2 + $c2 + $d2 + $e2 + $f2 + $g2 + $h2 + $i2 + $j2;
      $subThreeTotal = $a3 + $b3 + $c3 + $d3 + $e3 + $f3 + $g3 + $h3 + $i3 + $j3;
      $subFourTotal = $a4 + $b4 + $c4 + $d4 + $e4 + $f4 + $g4 + $h4 + $i4 + $j4;
      $subFiveTotal = $a5 + $b5 + $c5 + $d5 + $e5 + $f5 + $g5 + $h5 + $i5 + $j5;
      $subSixTotal = $a6 + $b6 + $c6 + $d6 + $e6 + $f6 + $g6 + $h6 + $i6 + $j6;

      $subscore1 = $subOneTotal / 50 * 100;
      $subscore2 = $subTwoTotal / 50 * 100;
      $subscore3 = $subThreeTotal / 50 * 100;
      $subscore4 = $subFourTotal / 50 * 100;
      $subscore5 = $subFiveTotal / 50 * 100;
      $subscore6 = $subSixTotal / 50 * 100;

      $query = mysqli_query($conn, "select * from score where rollnum = '$rollnum' and year = $year and sem = $sem ");
      $queryresult = mysqli_fetch_array($query);
      $rollnumber = $queryresult['rollnum'];
      $yearStd = $queryresult['year'];
      $semStd = $queryresult['sem'];
      if($rollnumber == $rollnum and $yearStd == $year and $semStd == $sem) {echo "<script>alert('Already submitted. Thanking you :)');</script>";}
      else{
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub1','$subscore1','$rollnum',$year,$sem)");
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub2','$subscore2','$rollnum',$year,$sem)");
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub3','$subscore3','$rollnum',$year,$sem)");
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub4','$subscore4','$rollnum',$year,$sem)");
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub5','$subscore5','$rollnum',$year,$sem)");
            $sql = mysqli_query($conn, "insert into score(Subject,Score,rollnum,year,sem) values ('$sub6','$subscore6','$rollnum',$year,$sem)");  
            if ($sql) {echo "<script>alert('Thanking you for your valuable feedback');</script>";}
          }

    $scr = mysqli_query($conn, "select * from score");
    while ($facname = mysqli_fetch_array($scr)) {
      $name = $facname['facultyName'];
      $subject = $facname['Subject'];
      $sql = mysqli_query($conn, "select * from faculty where Subject = '$subject' ");
      $sqlresult = mysqli_fetch_array($sql);
      $fname = $sqlresult['Name'];
      mysqli_query($conn, "update score set facultyName = '$fname' where Subject = '$subject' ");
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
  <link rel="stylesheet" type="text/css" href="styles.css">
   
</head>
<body>

<?php
include('header.php');
?>


<div align="right" class="mr-3">
	<a href="logout.php">Logout -></a>	
</div>
</div>
<!-- Main body  -->

<h3 class="text-center mt-4">Welcome <?php echo "Student";?> </h3>
<p class="container text-justify">Wishing you will be a successful person in life, that will be the best gift for us. So work hard and achieve your success. In your life, you will face many bad and hard times. Never lose hope in your bad time.</p>

<!-- Feed back form  -->

<?php

$sql = mysqli_query($conn, "select Rollnum,Year,Semester from students where Rollnum = '$rollnum' ");
$query = mysqli_fetch_array($sql);
$year = $query['Year'];
$sem = $query['Semester'];


$roll_num = mysqli_query($conn, "select rollnum,year,sem from score where rollnum = '$rollnum' and year = $year and sem = $sem ");
$result = mysqli_fetch_array($roll_num);
$Roll_num = $result['rollnum'];
$Year = $result['year'];
$Sem = $result['sem'];

  if ($Roll_num == $rollnum && $Sem == $sem) {
    echo "<h4 style='color:red;' class='text-center mb-4'>You have already submitted the form :)</h4>";
  }
  else
  {
?>
 <form method="post">

          <div class="container table-responsive">
            <table class="table table-bordered mt-4">
              <thead>
                <tr class="text-center">
                  <th>Query</th>
                  <th><?php echo "$sub1"; ?></th>
                  <th><?php echo "$sub2"; ?></th>
                  <th><?php echo "$sub3"; ?></th>
                  <th><?php echo "$sub4"; ?></th>
                  <th><?php echo "$sub5"; ?></th>
                  <th><?php echo "$sub6"; ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Basic concepts of topics are given in class/lab</td>
                  <td>
                   <select name="a1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="a2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="a3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="a4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select  name="a5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="a6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Comes prepared with the topics to the class/lab</td>
                  <td>
                   <select name="b1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="b2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="b3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="b4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="b5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="b6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Are you understand the class/lab</td>
                  <td>
                   <select name="c1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="c2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="c3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="c4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="c5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="c6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Does faculty speak in english and explain well in english in class/lab</td>
                  <td>
                   <select name="d1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="d2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="d3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="d4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="d5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="d6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Examples in each topic are worked over and explained in the class</td>
                  <td>
                   <select name="e1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="e2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="e3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="e4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="e5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="e6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Is faculty give notes in class/lab</td>
                  <td>
                   <select name="f1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="f2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="f3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="f4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="f5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="f6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Is lesson plan given in class/lab</td>
                  <td>
                   <select name="g1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="g2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="g3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="g4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="g5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="g6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Are assignments given as indicated in lesson plan in class/viva voice in lab</td>
                  <td>
                   <select name="h1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="h2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="h3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="h4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="h5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="h6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Does question bank given in the class/lab</td>
                  <td>
                   <select name="i1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="i2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="i3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="i4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="i5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="i6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Is faculty regular to class/lab</td>
                  <td>
                   <select name="j1" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="j2" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="j3" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                    <select name="j4" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="j5" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td>
                   <select name="j6" required>
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                </tr>


              </tbody>
            </table>
            
          </div>

       
        <button type="submit" class="btn text-white mb-4" name="addmarkssubmit">Submit</button>
    </form>


<!-- Showing Results -->

<?php
}

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
			</tr>
		</thead>
		<tbody>
			<?php

			while($row = mysqli_fetch_array($sql))
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
}}

?>

<?php
include('footer.php');
?>
</body>
</html>
