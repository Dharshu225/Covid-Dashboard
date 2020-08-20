<?php 
session_start();
include "includes/head_foot.php";

$servername = "kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "gux5fvna6rg9ojtw";
$password = "ilbs5whcyuonzg09";
$dbname = "f7j7r4crvmxu0dh9";

$conn = new mysqli($servername, $username, $password, $dbname);

$email=$_SESSION["email"];
$sql="SELECT email,first_name,last_name,age,mobile,gender,street,city,state,district,pin,aadhar FROM user WHERE email='$email'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>Decision</title>

<style>

	body{
		padding-top: 115px;
	}

	.container{
		text-align:center;
    }

	nav a{
        color: White;
        display: inline-block;
		margin:5px;
		float:right;
    }

	.contain {
    	padding:10px;
    }

	.whole-contain{
		border:2px solid black;
		background-color:#fc2d61;
		margin: 1% 30% 5%; 
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
                <a style="text-decoration:none;" href="user.php">Back</a>
            </nav>
		</div>
    </div><br>
    <div class="whole-contain" style="font-size:18px;">
		<h1 style="color:Black; text-align:center; color:white;">Decision</h1>
		<div class="contain" style="float:left; font-weight: bold; margin:auto auto auto 8%">
			<p>Application Number</p>
			<p>Status of E-pass</p>
			<p>First Name</p>
			<p>Last Name</p>
			<p>Aadhar Number</p>
			<p>Mobile Number</p>
			<p>Age</p>
			<p>Gender</p>
			<p>Door No. & Street</p>
			<p>City</p>
			<p>District</p>
			<p>State</p>
			<p>Pincode</p>
			<p>From</p>
			<p>To</p>
			<p>Reason for Travel</p>
			<p>No. of Passengers</p>
			<p>Vehicle Type</p>
			<p>Vehicle Number</p>
			<p>Date</p>
			<p><?php if($_SESSION["provide"]==1){echo "Valid Till";} ?></p>
		</div>
		<div class="contain" style="float:right; margin:auto 7% auto auto;">
			<p><?php echo ": ".$row["aadhar"] ?></p>
			<p><?php if($_SESSION["provide"]==1) {echo ": E-pass is Provided";} else{echo ": E-pass is Declined";} ?></p>
			<p><?php echo ": ".$row["first_name"] ?></p>
			<p><?php echo ": ".$row["last_name"] ?></p>
			<p><?php echo ": ".$row["aadhar"] ?></p>
			<p><?php echo ": ".$row["mobile"] ?></p>
			<p><?php echo ": ".$row["age"] ?></p>
			<p><?php echo ": ".$row["gender"] ?></p>
			<p><?php echo ": ".$row["street"] ?></p>
			<p><?php echo ": ".$row["city"] ?></p>
			<p><?php echo ": ".$row["district"] ?></p>
			<p><?php echo ": ".$row["state"] ?></p>
			<p><?php echo ": ".$row["pin"] ?></p>
			<p><?php echo ": ".$_SESSION["from"] ?></p>
			<p><?php echo ": ".$_SESSION["to"] ?></p>
			<p><?php echo ": ".$_SESSION["reason"] ?></p>
			<p><?php echo ": ".$_SESSION["no_pass"] ?></p>
			<p><?php echo ": ".$_SESSION["veh_type"] ?></p>
			<p><?php echo ": ".$_SESSION["veh_no"] ?></p>
			<p><?php echo ": ".$_SESSION["date"] ?></p>
			<p><?php if($_SESSION["provide"]==1) {echo ": ".date('d-m-Y',$_SESSION['valid']);} ?></p>
		</div>
    </div>
</main>
</body>
</html>
