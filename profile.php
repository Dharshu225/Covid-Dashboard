<?php 
session_start();
include "includes/user_headfoot.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid";

$conn = new mysqli($servername, $username, $password, $dbname);

$email=$_SESSION["email"];
$sql="SELECT email,first_name,last_name,aadhar,age,mobile,gender,street,city,state,district,pin,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel FROM user WHERE email='$email'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION["success"]="";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>Profile</title>

<style>
    body{
        padding-top:135px;
    }

	.container{
		text-align:center;
    }

	nav a{
        color: White;
        display: inline-block;
		margin:7px;
		float:right;
    }

	.contain {
    	padding:10px;
    }

	.whole-contain{
		margin: auto 25% 5%; 
	}

</style>
</head>

<body>
<main>
	<div class="fixed-header">
		<div class="container">
			<h1 style="color:White; text-align:center; font-size: 40px;">COVID DASHBOARD</h1>
            <nav>
				<a style="float:left; font-size:18px; float:left; color:white"><?php echo "Welcome " .$_SESSION["name"]. "!!!"; ?></a>
                <a style="text-decoration:none;" href="edit_profile.php">Edit Profile</a>
            </nav>
		</div>
    </div>
	<p style="color:green; font-size:18px;"><?php echo $_SESSION["success"]; ?></p>
    <div class="whole-contain" style="font-size:18px;">
		<h1 style="color:Black; text-align:center;">Profile</h1>
		<div class="contain" style="float:left; font-weight: bold; margin:auto auto auto 8%">
			<p>First Name</p>
			<p>Last Name</p>
			<p>Aadhar Number</p>
            <p>Email</p>
			<p>Mobile Number</p>
			<p>Age</p>
			<p>Gender</p>
			<p>Door No. & Street</p>
			<p>City</p>
			<p>District</p>
			<p>State</p>
            <p>Pin</p>
			<p>E-pass Requested</p>
			<p>E-pass Accepted</p>
			<p>E-pass Declined</p>
			<p>Last e-pass Requested date</p>
			<p>Last e-pass Accepted date</p>
			<p>Last e-pass Declined date</p>
			<p>Last Travel</p>
		</div>
		<div class="contain" style="float:right; margin:auto 15% auto auto;">
			<p><?php echo ": ".$row["first_name"] ?></p>
			<p><?php echo ": ".$row["last_name"] ?></p>
			<p><?php echo ": ".$row["aadhar"] ?></p>
            <p><?php echo ": ".$row["email"] ?></p>
			<p><?php echo ": ".$row["mobile"] ?></p>
			<p><?php echo ": ".$row["age"] ?></p>
			<p><?php echo ": ".$row["gender"] ?></p>
			<p><?php echo ": ".$row["street"] ?></p>
			<p><?php echo ": ".$row["city"] ?></p>
			<p><?php echo ": ".$row["district"] ?></p>
			<p><?php echo ": ".$row["state"] ?></p>
			<p><?php echo ": ".$row["pin"] ?></p>
            <p><?php echo ": ".$row["e_pass_requested"] ?></p>
            <p><?php echo ": ".$row["e_pass_accepted"] ?></p>
            <p><?php echo ": ".$row["e_pass_rejected"] ?></p>
			<p><?php echo ": ".$row["e_request_date"] ?></p>
            <p><?php echo ": ".$row["e_accept_date"] ?></p>
            <p><?php echo ": ".$row["e_reject_date"] ?></p>
			<p><?php echo ": ".$row["travel"] ?></p>
		</div>
    </div>
</main>
</body>
</html>