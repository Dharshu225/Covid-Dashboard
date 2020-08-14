<?php
session_start();

include "includes/head_foot.php";
include "dbb.php";

$dbb = new dbb();
$table = 'inactive';
$columns = "user_id,first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel";
$result = $dbb->Select($table,$columns);
$user_check="";
$user_delete="";

if(isset($_POST["save"]))
{
	$aadhar=$_POST["aadhar"];
	$_SESSION["aadhar"]=$aadhar;
	$where="aadhar=".$aadhar;
	$temp=$dbb->Select($table="inactive",$columns,$where);
	if($temp){
		echo "<script>window.location = 'search.php';</script>";
	}
	else{
		$user_check="No user found...";
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
				<a style="text-decoration:none;" href="admin.php">Home</a>
				<a style="float:left; font-size:18px; float:left; color:white"><?php echo "Welcome Dharsh!!!"; ?></a>
            </nav>
		</div>
    </div><br>
	<h1 style="color:Black; text-align:center;">Inactive User Database</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" >
		<div style="float:right; margin:auto 5% auto auto;">
			<input type="text" placeholder="Enter Aadhar Number" name="aadhar"></input>
			<input style="font-size:15px;" type="submit" value="Go" name="save">
			<p id="user_check" style="color:red; font-size:20px; text-align:center"><?php echo $user_check; ?></p>
		</div>
    </form>
    <div class="container" style="text-align:center; width:175%;">
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
					echo "</tr>";
					}
				?>
		</table>
		</form>
	</div>
	
</main>
</body>
</html>