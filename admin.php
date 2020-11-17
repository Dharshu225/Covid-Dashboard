<?php
session_start();

include "includes/head_foot.php";
include "dbb.php";

$dbb = new dbb();
$table = 'user';
$columns = "user_id,first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel";
$result = $dbb->Select($table,$columns);
$user_check="";
$user_delete="";

if(isset($_POST["save"]))
{
	$aadhar=$_POST["aadhar"];
	$_SESSION["aadhar"]=$aadhar;
	$where="aadhar=".$aadhar;
	$temp=$dbb->Select($table,$columns,$where);
	if($temp){
		echo "<script>window.location = 'search.php';</script>";
	}
	else{
		$user_check="No user found...";
	}
}

if(isset($_POST["delete"])) 
{
	$servername = "kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	$username = "gux5fvna6rg9ojtw";
	$password = "ilbs5whcyuonzg09";
	$dbname = "f7j7r4crvmxu0dh9";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$user_id=$_POST["delete"];
	$sql="SELECT first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel FROM user WHERE user_id ='$user_id'";
	$res=mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);

		$fname = $row["first_name"];
		$lname = $row["last_name"];
		$email = $row["email"];
		$aadhar=$row["aadhar"];
		$mob = $row["mobile"];
		$age = $row["age"];
		$gender = $row["gender"];
		$state = $row["state"];
		$district = $row["district"];
		$city = $row["city"];
		$street = $row["street"];
		$pin= $row["pin"];
		$psw = $row["passwordd"];
		$pass_request=$row["e_pass_requested"];
		$pass_accept=$row["e_pass_accepted"];
		$pass_reject=$row["e_pass_rejected"];
		$request_date=$row["e_request_date"];
		$accept_date=$row["e_accept_date"];
		$reject_date=$row["e_reject_date"];
		$travel=$row["travel"];

		$table = "inactive";
        $columns = "first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel";
        $values = "'$fname','$lname','$aadhar','$email','$mob', '$age', '$gender', '$state','$district','$city','$street','$pin','$psw','$pass_request','$pass_accept','$pass_reject','$request_date','$accept_date','$reject_date','$travel'";
		$insertOutput = $dbb->Insert($table,$columns,$values);

	$sql1="DELETE FROM user WHERE user_id='$user_id'";
	$res = mysqli_query($conn, $sql1);
    if ($res) 
    {
		$user_delete='User details has been deleted successfully and Inserted to Inactive Users';
		$table = "user";
        $columns = "first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel";
		$result = $dbb->Select($table,$columns);
		header("location:inactive.php");
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
		margin:10px;
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
			<img src="includes/images/corona_png.png" style="width:6%; margin:-7px 1% auto 1%; float:left;"></img>
			<h1 style="color:White; text-align:left; font-size: 40px; margin:10% 1% auto 1%%; ">COVID DASHBOARD</h1>
            <nav>
                <a style="text-decoration:none;" href="front.php">Logout</a>
				<a style="text-decoration:none;" href="inactive.php">Inactive Users</a>
				<a style="text-decoration:none;" href="user.php">User Module</a>
				<a style="float:left; font-size:18px; float:left; color:white"><?php echo "Welcome " .$_SESSION["name"]. "!!!"; ?></a>
            </nav>
		</div>
    </div><br>
	<h1 style="color:Black; position:fixed; text-align:left; margin:30px 13% auto;">User Database</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" >
		<div style=" position:fixed; margin:3% 5% auto 75%;">
			<input type="text" placeholder="Enter Aadhar Number" name="aadhar"></input>
			<input style="font-size:15px;" type="submit" value="Go" name="save">
			<p id="user_check" style="color:red; font-size:20px; text-align:center"><?php echo $user_check; ?></p>
		</div>
    </form>
	<p id="user_check" style="color:green; font-size:20px; margin: auto auto auto 5%;"><?php echo $user_delete; ?></p>
    <div class="container" style="text-align:center; width:175%; margin: 6% 10px;">
    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" >
		<table id="userdata" border="1" style="font-family: verdana; font-size:14px; margin: 1px 15px 1px 10px;" >
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
				<th>Last Travel</th>
				<th>Remove</th>
			</tr>
			<tr>
				<?php
					for($index=0; $index<count($result); $index++)
					{
					echo "<tr>";
					echo "<td>" .$result[$index]["user_id"]. "</td>";
					echo "<td>" .$result[$index]["first_name"]. "</td>";
					echo "<td>" .$result[$index]["last_name"]. "</td>";
					echo "<td>" .$result[$index]["aadhar"]. "</td>";
					echo "<td>" .$result[$index]["email"]. "</td>";
					echo "<td>" .$result[$index]["mobile"]. "</td>";
					echo "<td>" .$result[$index]["age"]. "</td>";
					echo "<td>" .$result[$index]["gender"]. "</td>";
					echo "<td>" .$result[$index]["state"]. "</td>";
					echo "<td>" .$result[$index]["district"]. "</td>";
					echo "<td>" .$result[$index]["city"]. "</td>";
					echo "<td>" .$result[$index]["street"]. "</td>";
					echo "<td>" .$result[$index]["pin"]. "</td>";
					echo "<td>" .$result[$index]["passwordd"]. "</td>";
					echo "<td>" .$result[$index]["e_pass_requested"]. "</td>";
					echo "<td>" .$result[$index]["e_pass_accepted"]. "</td>";
					echo "<td>" .$result[$index]["e_pass_rejected"]. "</td>";
					echo "<td>" .$result[$index]["e_request_date"]. "</td>";
					echo "<td>" .$result[$index]["e_accept_date"]. "</td>";
					echo "<td>" .$result[$index]["e_reject_date"]. "</td>";
					echo "<td>" .$result[$index]["travel"]. "</td>";
					echo "<td><button type='submit' name ='delete' class = 'btn btn-danger deletebutton' value='".$result[$index]["user_id"]."'>Remove</button></td>";
					echo "</tr>";
					}
				?>
		</table>
		</form>
	</div>
	
</main>
</body>
</html>
