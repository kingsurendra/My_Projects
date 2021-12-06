<?php
include('database.php');
session_start();

/* Student Login */

if(isset($_POST['studentLogin']))
{
    $rollNumber = strtolower($_POST['rollnum']);
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "select * from students where Rollnum = '$rollNumber'");
    $result = mysqli_fetch_array($sql);

    $studentRollnum =$result['Rollnum'];
  #  $studentPassword =$result['Password'];
    // $studentName = $result['Name'];
          
            if($studentRollnum == $rollNumber && $studentRollnum == $password)
              {
                 $_SESSION["rollnum"] =$rollNumber;
                header('location:studentAccount.php');
              }

          else{
                  ?>
                      <script type="text/javascript">
                        alert("Roll number or password do not match");
                      </script>
                <?php
              }
}



/* admin Login */

if(isset($_POST['adminLogin']))
{
    $name = strtolower($_POST['name']);
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "select * from admin where name = '$name' and password = '$password' ");
    $result = mysqli_fetch_array($sql);

    $Password =$result['password'];
    $Name = $result['name'];

        if ($result >= 1) 
        {
          
            if($Name == $name && $Password == $password)
              {
                $_SESSION["Name"] = $Name;
                header('location:adminAccount.php');
              }

          else{
                  ?>
                      <script type="text/javascript">
                        alert("Roll number or password do not match");
                      </script>
                <?php
              }
        }

        else{   echo "<script>alert('Name is not registered');</script>";
               ?>
              <meta http-equiv="refresh" content="0.1,url=/My Projects/feedbackform/index.php">
              <?php
           }
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Tech Feed back form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/teclogo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style type="text/css">   .passerror,.pwd_match{display: none;}</style>
</head>
<body>
<?php
include('header.php');
?>

<h4 class="text-center text-success mt-4 mb-4" style="letter-spacing: 1px;font-size: 27px;">Welcome to<br><strong>Tech student Feed back form</strong></h4>
<div class="container text-justify mb-4" style="text-indent: 20px;">
  The process used to collect the student’s feedback is manual and takes more time to complete its analysis and report generation. By this way it is easy and less process to get the score from student and calculate the faculty performance. Feedback from student is the power to change the learning environment or the learning procedure. 
  <div class="mt-2 mb-2 text-center" style="font-size: 24px;">
    Feedback is the breakfast of champions
  </div>
</div>

<!--Admin Login Button -->
<div align="right">
   <a href="" data-toggle="modal" data-target="#admin_login"> <button name="adminLogin" id="adminlogin">Admin login</button></a>
</div>

<!--Student Login Button -->
<div align="right">
   <a href="" data-toggle="modal" data-target="#student_login"> <button name="studentLogin" id="studentLogin">Student login</button></a>
</div>


<!--Admin Login model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="admin_login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Admin login</h3>
        </div>
        <div class="modal-body">
          <form method="post">
        <div class="">
        <label for="name">Name</label>
        <input type="text" class="" id="name" placeholder="Your Name" name="name" required style="text-indent: 10px;">
        <p class="text-danger"></p>          
        </div>
        <div class="">
          <label for="spwd">Password</label>
          <input type="password" class="" placeholder="Your Password" id="spwd" name="password" required style="text-indent: 10px;">
          <p class="text-danger"></p>
        </div>
        <button type="submit" class="btn text-white" name="adminLogin">Login</button>
    </form>
        </div>

      </div>
      
    </div>
  </div>
</div>


<!--Student Login model-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="student_login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="mt-4 mb-3">
          <h3 class="modal-title text-center text-success">Student login</h3>
        </div>
        <div class="modal-body">
          <form method="post">
        <div class="">
        <label for="rollnum">Roll number</label>
        <input type="text" class="" id="rollnum" placeholder="Your roll number" name="rollnum" maxlength="10" minlength="10" required style="text-indent: 10px;">
        <p class="text-danger"></p>          
        </div>
        <div class="">
          <label for="spwd">Password</label>
          <input type="password" class="" placeholder="Your Password" id="spwd" name="password" required style="text-indent: 10px;">
          <p class="text-danger"></p>
        </div>
        <button type="submit" class="btn text-white" name="studentLogin">Login</button>
    </form>
        </div>

      </div>
      
    </div>
  </div>
</div>

<?php
include('footer.php');
?>
</body>
</html>
<script type="text/javascript" src="js/validation.js"></script>