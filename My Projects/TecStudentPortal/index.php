<?php
include('database.php');
error_reporting(0);
session_start();

/* Student registration  */
if(isset($_POST['student_registration']))
{	
	$name = $_POST['Name'];
	$rollNumber = strtolower($_POST['Rollnum']);
	$deptmt = str_split($rollNumber);
	$deptmts = $deptmt[7];
	$password = $_POST['Password'];
	$cpassword = $_POST['Cpassword'];

	if ($deptmts == 5) {
		$dept = 'cse';
	}
	else if ($deptmts == 4) {
		$dept = 'mec';
	}
	else if ($deptmts == 3) {
		$dept = 'ece';
	}
	else if ($deptmts == 2) {
		$dept = 'eee';
	}
	else if ($deptmts == 1) {
		$dept = 'civil';
	}


	$user = mysqli_query($conn, "select * from students where Rollnum = '$rollNumber'");
	$usercheck = mysqli_fetch_array($user);

	if ($usercheck >= 1) {
	 echo "<script>alert('Roll number already Exists. Please Login');</script>";
		 ?>
			 <meta http-equiv="refresh" content="0.3,url=/My Projects/TecStudentPortal/index.php">
	<?php
	}
else
{
	if ($password == $cpassword and $password < 8 and $cpassword < 8) {
		$sql = mysqli_query($conn, "insert into students values('$name','$rollNumber','$dept','$password','$cpassword')");
		if($sql)
		{
			$_SESSION['rollnum'] = $rollNumber;
			$_SESSION["Name"] = $name;
			?>
			<script type="text/javascript">alert("Registered Successfully.");</script>
			<meta http-equiv="refresh" content="0.1,url=/My Projects/TecStudentPortal/studentAccount.php"> 
			<?php
		}
	}
	else
	{
		echo "<script>alert('Make sure the password should contain atleast 8 characters');</script>";
	}

}	
}

# Hod Registration

if(isset($_POST['hod_registration']))
{
	$uname = $_POST['uname'];
	$password = $_POST['Password'];
	$cpassword = $_POST['Cpassword'];

	$user = mysqli_query($conn, "select * from admin where name = '$uname'");
	$usercheck = mysqli_fetch_array($user);

	if ($usercheck >= 1) {
	 echo "<script>alert('Department already Exists. Please Login');</script>";
		 ?>
			 <meta http-equiv="refresh" content="0.3,url=/My Projects/TecStudentPortal/index.php">
	<?php
	}
else
{
	if ($password == $cpassword and $password >= 8 and $cpassword >= 8) {
	$sql = mysqli_query($conn, "insert into admin values('$uname','$cpassword')");
	if($sql)
	{
		$_SESSION["name"] = $uname;
		?>
							<script type="text/javascript">
								alert("Registered Successfully.");
							</script>
						 <meta http-equiv="refresh" content="0.1,url=/My Projects/TecStudentPortal/hod.php"> 
			<?php
	}
}
	else
		echo "<script>alert('Make sure the password should contain atleast 8 characters');</script>";

}
}

/* Student Login */

if(isset($_POST['studentLogin']))
{
		$rollNumber = strtolower($_POST['rollnum']);
		$password = $_POST['password'];

		$sql = mysqli_query($conn, "select * from students where Rollnum = '$rollNumber' and Password = '$password' ");
		$result = mysqli_fetch_array($sql);

		$sqll = mysqli_query($conn, "select * from students where Rollnum = '$rollNumber' ");
		$sqllresult = mysqli_fetch_array($sqll);

		$studentRollnum =$result['Rollnum'];
		$studentPassword =$result['Password'];
		$studentName = $result['Name'];

				if ($sqlllresult >= 1) 
				{
						if($studentRollnum == $rollNumber && $studentPassword == $password)
							{
								$_SESSION["Name"] = $studentName;
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

				else{   echo "<script>alert('Roll number is not registered');</script>";
							 ?>
							<meta http-equiv="refresh" content="0.1,url=/My Projects/TecStudentPortal/index.php">
							<?php
					 }
}

/* Filter by Department */

if (isset($_POST['submit'])) {
	$dept = $_POST['deptname'];
	
		$sql = mysqli_query($conn, "select * from pecentages where Department = '$dept'");
		$result = mysqli_fetch_array($sql);

	 if ($result >= 1) 
	 {
			$_SESSION['Department'] = $dept;
			header('location:showresults.php');
	 }

	 else{   echo "<script>alert('No data found');</script>";
	 ?>
<meta http-equiv="refresh" content="0.3,url=/My Projects/TecStudentPortal/index.php">
<?php
		}

	}

	/* Filter by Year */

if (isset($_POST['getresult'])) {

	$year = $_POST['year'];
	$sql1 = mysqli_query($conn, "select * from pecentages where year = '$year'");
	$result1 = mysqli_fetch_array($sql1);

		 if ($result1 >= 1) 
	 {  
			$_SESSION['year'] = $year;
			header('location:showResultsByYear.php');
	 }

	 else{ echo "<script>alert('No data found');</script>";
?>
<meta http-equiv="refresh" content="0.3,url=/My Projects/TecStudentPortal/index.php">
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
					if($Name == $name && $Password == $password)
						header('location:adminAccount.php');
					else{?>
						<script type="text/javascript">
							alert("Roll number or password do not match");
						</script>
						<?php
							}}
/* HOD Login */

if(isset($_POST['hodLogin']))
{
		$name = strtolower($_POST['username']);
		$password = $_POST['password'];
		$sql = mysqli_query($conn, "select * from admin where name = '$name' and password = '$password' ");
		$result = mysqli_fetch_array($sql);
		$Password =$result['password'];
		$Name = $result['name'];
		if($Name == $name && $Password == $password)
		{
			$_SESSION['name'] = $name;
			header('location:hod.php');	
		}
		else
			echo "<script>alert('Username or password do not match');</script>";			
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
	<style type="text/css">   .passerror,.pwd_match{ display: none;}</style>
</head>
<body>
<?php
include('header.php');
?>

<h4 class="text-center text-success mt-4" style="letter-spacing: 1px;font-size: 27px;">Welcome to<br><strong>Tech Student portal</strong></h4>
<div class="container text-justify" style="text-indent: 20px;">
	Our management will always support and encourage students to enhance their skills and knowledge by means of good knowledged faculty. Theoratical knowledge(marks) is important, only to attend the interview whereas the practical knowledge is more more important to be success like getting job or doing something which improve your skills and level.
</div>

<!--Admin Login Button -->
<div align="right">
	 <a href="" data-toggle="modal" data-target="#admin_login"> <button name="adminLogin" id="adminlogin">Admin login</button></a>
</div>

<!--HOD Login Button -->
<div align="right">
	 <a href="" data-toggle="modal" data-target="#hod_login"> <button name="hodLogin" id="hodlogin">HOD login</button></a>
</div>

<!--Student Login Button -->
<div align="right">
	 <a href="" data-toggle="modal" data-target="#student_login"> <button name="studentLogin" id="studentLogin">Student login</button></a>
</div>

<!-- Filter By Departent -->
<div class="container mt-4">
		<div class="row ml-1 mr-1">
				<div class="mt-2">
					<a href="" data-toggle="modal" data-target="#filterDept" style="text-decoration: none;"><img src="images/department.jpg" width="100%" height="100%" alt="Departments Image"></a>
				</div>
				<div class="">
					 <a href="" data-toggle="modal" data-target="#filterDept" style="text-decoration: none;">
					<h5 class="container text-center mt-4">Filter the student by the individual Department</h5>
				</a>
				</div>
		</div>
</div>

<!-- Filter By Year -->
<div class="container mt-4 mb-4">
		<div class="row ml-1 mr-1">
				<div>
					<a href="" data-toggle="modal" data-target="#filterYear" style="text-decoration: none;">      
						<h5 class="container text-center mt-4">Filter the student by the individual Year</h5>
					</a>
				</div>

				<div class="mt-2 col-lg-6 col-12">
					<a href="" data-toggle="modal" data-target="#filterYear" style="text-decoration: none;">
					<img src="images/studentYear.png" width="100%" height="100%" alt="Student Year Image">
				</a>
				</div>
		</div>
</div>

<!--Filter Department model-->
<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="filterDept" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="mt-4 mb-3">
					<h4 class="modal-title text-center text-success">Filter by Department</h4>
				</div>
				<div class="modal-body">

					<form method="post">
							<div class="mb-4">
										<label for="deptname">Department</label>
										<select name="deptname" id="deptname" class="form-control" required>
											<option></option>
											<option value="cse">CSE</option>
											<option value="civil">CIVIL</option>
											<option value="eee">EEE</option>
											<option value="ece">ECE</option>
											<option value="mec">MECH</option>
										</select>
							</div>
						<button type="submit" class="btn text-white" name="submit" id="submit">Get result</button>
			 </form>
				</div>
			</div>
			
		</div>
	</div>
</div>

<!--Filter Year model-->
<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="filterYear" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="mt-4 mb-3">
					<h4 class="modal-title text-center text-success">Filter by Year</h4>
				</div>
				<div class="modal-body">
					<form method="post">
							<div class="mb-4">
										<label for="year"> Choose Year</label>
										<select name="year" id="year" class="form-control" required>
											<option></option>
											<option value="4">4</option>
											<option value="3">3</option>
											<option value="2">2</option>
											<option value="1">1</option>
										</select>
							</div>
						<button type="submit" class="btn text-white" name="getresult" id="getresult">Get result</button>
			 </form>
				</div>
			</div>
			
		</div>
	</div>
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
		 <!-- <p class="text-center mt-4">Lost your password lets! &nbsp; <a href="#" class="text-danger">Forgot Password</a></p> -->
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
<!-- 		 <p class="text-center mt-4">Lost your password lets! &nbsp; <a href="#" class="text-danger">Forgot Password</a></p> -->
				</div>
				<div class="text-center mb-3">
			<hr>Don't have an account <a href="" data-toggle="modal" data-target="#student_registration">Register Here</a>
				</div>
			</div>
			
		</div>
	</div>
</div>

<!--HOD Login model-->
<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="hod_login" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="mt-4 mb-3">
					<h3 class="modal-title text-center text-success">Head of the Department</h3>
				</div>
				<div class="modal-body">
					<form method="post">
				<div class="">
				<label for="username">Username</label>
				<input type="text" class="" id="username" placeholder="Enter Username" name="username" required style="text-indent: 10px;">
				<p class="text-danger"></p>          
				</div>
				<div class="">
					<label for="spwd">Password</label>
					<input type="password" class="" placeholder="Enter Password" id="spwd" name="password" required style="text-indent: 10px;">
					<p class="text-danger"></p>
				</div>
				<button type="submit" class="btn text-white" name="hodLogin">Login</button>
		</form>
				</div>
				<div class="text-center mb-3">
			<hr>Don't have an account <a href="" data-toggle="modal" data-target="#hod_registration">Register Here</a>
				</div>
			</div>
			
		</div>
	</div>
</div>

<!--Hod Registration model-->
<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="hod_registration" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="mt-4 mb-3">
					<h3 class="modal-title text-center text-success">Create Account</h3>
				</div>
				<div class="modal-body">
					<form method="post">

						<div class="mt-3">
					<label for="dept">Username</label>
					 <select id="dept" name="uname" class="form-control" style="text-indent: 10px;" required>
							<option></option>
							<option value="cse">CSE</option>
							<option value="civil">CIVIL</option>
							<option value="eee">EEE</option>
							<option value="ece">ECE</option>
							<option value="mec">MECH</option>
					 </select>
				</div>

				<div class="mt-3">
					<label for="pwd">Password</label>
					<input type="password" class="" placeholder="Your Password" id="pwd" name="Password" required style="text-indent: 10px;">
					 <p class="text-danger passerror">Your password must contain at least 8 characters includes one Capital letter, one small letter, one special character and one number.</p>
				</div>

				<div class="mt-3 mb-4">
					<label for="cpwd">Confirm Password</label>
					<input type="password" class="" placeholder="Confirm Password" id="cpwd" name="Cpassword" required style="text-indent: 10px;">
					<p class="text-danger pwd_match">Password do not match</p>
				</div>

				<button type="submit" class="btn text-white" name="hod_registration">Register</button>
		</form>
				</div>
			</div> 
		</div>
	</div>
</div>


<!--Student Registration model-->
<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="student_registration" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="mt-4 mb-3">
					<h3 class="modal-title text-center text-success">Student Registration</h3>
				</div>
				<div class="modal-body">
					<form method="post">

				<div class="">
				<label for="name">Name</label>
				<input type="text" class="" id="name" placeholder="Your name" name="Name" required style="text-indent: 10px;">          
				</div>

				<div class="mt-3">
				<label for="rollnum">Roll number</label>
				<input type="text" class="" id="rollnum" placeholder="Your roll number" name="Rollnum" minlength="10" maxlength="10" required style="text-indent: 10px;">  
				</div>

				<div class="mt-3">
					<label for="password">Password</label>
					<input type="password" class="" placeholder="Your Password" id="password" name="Password" required style="text-indent: 10px;">
					 <p class="text-danger passerror">Your password must contain at least 8 characters includes one Capital letter, one small letter, one special character and one number.</p>
				</div>

				<div class="mt-3 mb-4">
					<label for="cpassword">Confirm Password</label>
					<input type="password" class="" placeholder="Confirm Password" id="cpassword" name="Cpassword" required style="text-indent: 10px;">
					<p class="text-danger pwd_match">Password do not match</p>
				</div>

				<button type="submit" class="btn text-white" id="btndisable" name="student_registration">Register</button>
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