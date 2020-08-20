<?php 
session_start();
include "includes/user_headfoot.php";

$servername = "kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "gux5fvna6rg9ojtw";
$password = "ilbs5whcyuonzg09";
$dbname = "f7j7r4crvmxu0dh9";

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

	.contain {
    	padding:1px;
    }

	.whole-contain{
		margin: auto auto 5% 13%; 
	}

</style>
</head>

<body>
<main>
	<nav>
		<a href="edit_profile.php" style="float:right; font-size:18px; margin:1% 5% auto;">Edit profile</a>
	</nav>
	<p style="color:green; font-size:18px;"><?php echo $_SESSION["success"]; ?></p>
    <div class="whole-contain" style="font-size:18px;">
		<h1 style="color:Black; text-align:left;">Profile</h1>
		<div class="contain" style="float:left; font-weight: bold;">
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
		<div class="contain" style="float:right; margin:auto 55% auto auto;">
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
