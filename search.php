<?php
session_start();

include "includes/head_foot.php";
include "dbb.php";

$dbb = new dbb();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid";

$conn = new mysqli($servername, $username, $password, $dbname);

$aadhar=$_SESSION["aadhar"];
$sql="SELECT user_id,first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date FROM user WHERE aadhar='$aadhar'";
$row=mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($row);

if(isset($_POST["delete"])) 
{
    $table = "user";
    $where = "user_id =".$_POST["delete"];
    $result = $dbb->Delete($table,$where);
    if ($result) 
    {
        echo "<script>alert('User details has been deleted');</script>";
        echo "<script>window.location = 'admin.php';</script>";
    }
    else 
    {
        echo "<script>alert('User details Deletion failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>Admin</title>

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

	#userdata{
		border-collapse:collapse;
	}

	#userdata tr:nth-child(even){
		background-color: #f2f2f2;
	}

	
	#userdata tr:hover{
		background-color: #ddd;
	}

	#userdata th{
		padding:12px;
		background-color: #4caf50;
		color:white;
	}

</style>
</head>

<body>
<main>
	<div class="fixed-header">
		<div class="container">
			<h1 style="color:White; text-align:center; font-size: 40px;">COVID DASHBOARD</h1>
            <nav>
                <a style="text-decoration:none;" href="front.php">Logout</a>
				<a style="text-decoration:none;" href="admin.php">Back</a>
				<a style="float:left; font-size:18px; float:left; color:white"><?php echo "Welcome " .$_SESSION["name"]. "!!!"; ?></a>
            </nav>
		</div>
    </div><br><br>
	<h1 style="color:Black; text-align:center;">User Database</h1>
    <div class="container" style="text-align:center; width:125%;">
		<table id="userdata" border="1" style="font-family: verdana; font-size:14px; margin: 1px 15px 1px 15px;" >
			<tr>
				<th>User id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Aadhar Number</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Age</th>
				<th>Gender</th>
				<th>State</th>
				<th>District</th>
				<th>City</th>
				<th>Street</th>
				<th>Pincode</th>
				<th>Password</th>
				<th>E-pass Requested</th>
				<th>E-pass Accepted</th>
				<th>E-pass Declined</th>
				<th>E-pass Requested Date</th>
				<th>E-pass Accepted Date</th>
				<th>E-pass Declined Date</th>
				<th>Cancel</th>
			</tr>
			<tr>
				<?php
					echo "<tr>";
					echo "<td>" .$result["user_id"]. "</td>";
					echo "<td>" .$result["first_name"]. "</td>";
					echo "<td>" .$result["last_name"]. "</td>";
					echo "<td>" .$result["aadhar"]. "</td>";
					echo "<td>" .$result["email"]. "</td>";
					echo "<td>" .$result["mobile"]. "</td>";
					echo "<td>" .$result["age"]. "</td>";
					echo "<td>" .$result["gender"]. "</td>";
					echo "<td>" .$result["state"]. "</td>";
					echo "<td>" .$result["district"]. "</td>";
					echo "<td>" .$result["city"]. "</td>";
					echo "<td>" .$result["street"]. "</td>";
					echo "<td>" .$result["pin"]. "</td>";
					echo "<td>" .$result["passwordd"]. "</td>";
					echo "<td>" .$result["e_pass_requested"]. "</td>";
					echo "<td>" .$result["e_pass_accepted"]. "</td>";
					echo "<td>" .$result["e_pass_rejected"]. "</td>";
					echo "<td>" .$result["e_request_date"]. "</td>";
					echo "<td>" .$result["e_accept_date"]. "</td>";
					echo "<td>" .$result["e_reject_date"]. "</td>";
					echo "<td><button type='submit' name ='delete' class = 'btn btn-danger deletebutton' value='".$result["user_id"]."'>Delete</button></td>";
					echo "</tr>";
				?>
		</table>
	</div>
	
</main>
</body>
</html>