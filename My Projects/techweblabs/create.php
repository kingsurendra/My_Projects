<?php

// Creating and inserting data into database

include('config.php');
if (isset($_POST["submit"])) {
	# code...
	$name = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];

	$sql =  $conn->prepare("INSERT INTO `users`(`Name`, `Email`, `Phone`) VALUES (?,?,?)");
	$sql->bind_param("sss", $name, $email, $number);
	$sql->execute();

	if ($sql == TRUE)
    {
        ?>

        <script type="text/javascript">
            alert("User Inserted");
            setTimeout(function(){
            window.location.href = "index.php";
            },0);
        </script>

    <?php
    }
	else echo "<script>alert('Something went wrong, please try again!');</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Techweblabs | Create data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/teclogo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
	<style type="text/css">
		.model{
            box-shadow: 4px 3px 14px 7px lightgray;
            padding: 0;
            margin: 0; 
            /*position: relative;*/
            width: 400px;
            height: 370px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
         }
         .model1
         {
         	position: absolute;
            left: 50%;
            top: 57%;
            transform: translate(-50%, -50%);
         }
         input[type='text'],input[type='email']{
         	width: 70%;
         	border: none;
         	outline: none;

         	border-bottom: 1px solid gray;
         }
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
	<section class="container p-5">
		<div class="model col-10" style="border-radius: 20px;">
          
		<div class="">
            <h4 class="mb-4 mt-4 text-center text-grad">Insert user data</h4>
            <form action="" method="post" class="pl-5 pr-5 pb-5 pt-2">
                <div class="mb-4" align="center">
                    <input type="text" class="text-center mb-4 p-2" name="name" placeholder="Enter Name" required><br>
                    <input type="email" class="text-center mb-4 p-2" name="email" placeholder="Enter email id" required><br>
                    <input type="text" class="text-center mb-4 p-2" name="number" maxlength="10" minlength="10" placeholder="Enter Number" required>
                </div>

                <div align="center" class="mt-4 mb-4">
                    <input type="submit" class="btn btn-success p-2 pl-4 pr-4" name="submit" id="submit">
                </div>
            
            </form>
            </div>
        </div>
	</section>

</body>
</html>