<?php
session_start();

$mob = "";
$district = "";
$city = "";
$street = "";
$pin= "";
$user_email="";
$mobError="";
$pinError="";

include "dbb.php";
$dbb = new dbb();

if(isset($_POST["update"])) 
{
	$valid = true;
	$district = $_POST["district"];
	$city = $_POST["city"];
    $street = $_POST["st"];
    $user_email=$_SESSION["email"];

  if(preg_match("/^[6-9][0-9]{9}$/", ($_POST["mob"])))
    {
        $mob = $_POST["mob"];
    }
    else
    {
        $mobError='Invalid Mobile Number';
        $valid = false;
    }

  if(preg_match("/^[6][0-9]{5}$/", ($_POST["pin"])))
    {
      $pin = $_POST["pin"];
    }
    else
    {
      $pinError='Invalid Pincode';
      $valid = false;
    }

	if($valid)
    {
        $table = "user";
        $columns = "mobile = '$mob',district = '$district',city = '$city',street = '$street',pin = '$pin'";
        $where = "email='$user_email'";
        $insertOutput = $dbb->Update($table,$columns,$where);
        if($insertOutput)
        {
            $_SESSION["success"]="Updated Successfully!!!";
            echo "<script>window.location = 'profile.php';</script>";
        }
        else
        {
            echo "There is some error";
        }
    }
}

if(isset($_POST["cancel"])) 
{
    echo "<script>window.location = 'user.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Profile</title>
	
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */	
input[type=text]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 15px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus,{
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

</style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
  <div class="container">
  <a style="text-decoration:none; float:right;" href="profile.php">Cancel</a>
    <h1 style="text-align:center">Edit Profile</h1>
    <hr>
    
	<label for="mob"><b>Mobile Number</b></label>
    <input type="text" placeholder="Enter Mobile Number" name="mob" id="mob" value="<?php echo $mob ?>" required>
    <p id="mobError" style="color:red; font-size:15px;"><?php echo $mobError; ?></p>

	<label for="district"><b>District</b></label>
    <input type="text" placeholder="Enter District" name="district" id="district" value="<?php echo $district ?>" required><br>
	
	<label for="city"><b>City</b></label>
    <input type="text" placeholder="Enter City" name="city" id="city" value="<?php echo $city ?>" required><br>
	
	<label for="st"><b>Door No. & Street</b></label>
    <input type="text" placeholder="Enter Door No. & Street" name="st" id="st" value="<?php echo $street ?>" required><br>
	
	<label for="pin"><b>Pincode</b></label>
    <input type="text" placeholder="Enter Pincode" name="pin" id="pin" value="<?php echo $pin ?>" required>
    <p id="pinError" style="color:red; font-size:15px;"><?php echo $pinError; ?></p>

    <input class="registerbtn " type="submit"  name="update" value="Update">
  </div>
</form>

</body>
</html>
