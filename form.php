<?php
$fname = "";
$lname = "";
$email = "";
$aadhar="";
$mob = "";
$age = "";
$gender = "";
$state = "";
$checked="checked";
$district = "";
$city = "";
$street = "";
$pin= "";
$psw = "";
$rpsw="";
$pass_request=0;
$pass_accept=0;
$pass_reject=0;
$request_date="None";
$accept_date="None";
$reject_date="None";
$travel="None";
$userEmail="";
$emailError="";
$mobError="";
$pinError="";
$pswError="";

include "dbb.php";
$dbb = new dbb();

if(isset($_POST["submit"])) 
{
	$valid = true;
	$fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email=$_POST["email"];
	$age = $_POST["age"];
	$gender = $_POST["gender"];
	$state = $_POST["state"];
	$district = $_POST["district"];
	$city = $_POST["city"];
	$street = $_POST["st"];
  
  if(isset($_POST["aadhar"]))
  {
    $user = $_POST["aadhar"];
    $where = "aadhar = '".$user. "'";
    $result = $dbb->Select('user', 'aadhar', $where);
    if($result)
    {
        $emailError='User Account Already Exisit';
        $valid=false;
    }
    else
    {
      $aadhar=$_POST["aadhar"];
    }
  }

  if(isset($_POST["rpsw"]))
  {
    if($_POST["psw"]!=$_POST["rpsw"])
    {
        $pswError='Confirm Password Incorrect!!!';
        $valid=false;
    }
    else
    {
      $psw=$_POST["psw"];
    }
  }

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
        $columns = "first_name, last_name,aadhar, email,mobile,age,gender,state,district,city,street,pin,passwordd,e_pass_requested,e_pass_accepted,e_pass_rejected,e_request_date,e_accept_date,e_reject_date,travel";
        $values = "'$fname','$lname','$aadhar','$email','$mob', '$age', '$gender', '$state','$district','$city','$street','$pin','$psw','$pass_request','$pass_accept','$pass_reject','$request_date','$accept_date','$reject_date','$travel'";
        $insertOutput = $dbb->Insert($table,$columns,$values);
        if($insertOutput)
        {
          echo 'Successfully Registered!!!';
          echo "<script>window.location = 'front.php';</script>";
        }
        else
        {
            echo "There is some error";
        }
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>New Registration Form</title>
<link rel="shortcut icon" href="includes/images/corona_icon.jpeg" type="image/x-icon">
	
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
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 15px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
input[type=radio]{
  padding:15px;
  margin:5px 15px;
}

input[type=text]:focus, input[type=password]:focus {
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

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" >
  <div class="container" >
  <a style="text-decoration:none; float:right;" href="front.php">Cancel</a>
    <h1 style="text-align:center">Create Account</h1>
    <hr>
    
	<label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" id="fname" value="<?php echo $fname ?>" required><br><br>
	
	<label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="<?php echo $lname ?>" required><br><br>

  <label for="aadhar"><b>Aadhar Number</b></label>
    <input type="text" placeholder="Enter Aadhar No." name="aadhar" id="aadhar" value="<?php echo $aadhar ?>" required><br><br>

	<label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php echo $email ?>" required>
    <p id="emailError" style="color:red; font-size:15px;"><?php echo $emailError; ?></p>
	
	<label for="mob"><b>Mobile Number</b></label>
    <input type="text" placeholder="Enter Mobile Number" name="mob" id="mob" value="<?php echo $mob ?>" required>
    <p id="mobError" style="color:red; font-size:15px;"><?php echo $mobError; ?></p>
	
	<label for="age"><b>Age</b></label>
    <input type="text" placeholder="Enter Age" name="age" id="age" value="<?php echo $age ?>" required><br><br>
	
	<label for="gender"><b>Gender</b></label><br>
    <input type="radio" name="gender" id="male" value="male"<?php if($gender == "Male")echo $checked; ?> required>
	<label for="male">Male</label><br>
    <input type="radio" id="female" name="gender" value="female"<?php if($gender == "Female")echo $checked; ?>>
    <label for="female">Female</label><br>
    <input type="radio" id="other" name="gender" value="other"<?php if($gender == "Other")echo $checked; ?>>
    <label for="other">Other</label><br><br>
		
    <label for="state"><b>State</b></label>
    <input type="text" placeholder="Enter State" name="state" id="state" value="<?php echo $state ?>" required><br><br>
	
	<label for="district"><b>District</b></label>
    <input type="text" placeholder="Enter District" name="district" id="district" value="<?php echo $district ?>" required><br><br>
	
	<label for="city"><b>City</b></label>
    <input type="text" placeholder="Enter City" name="city" id="city" value="<?php echo $city ?>" required><br><br>
	
	<label for="st"><b>Door No. & Street</b></label>
    <input type="text" placeholder="Enter Door No. & Street" name="st" id="st" value="<?php echo $street ?>" required><br><br>
	
	<label for="pin"><b>Pincode</b></label>
    <input type="text" placeholder="Enter Pincode" name="pin" id="pin" value="<?php echo $pin ?>" required>
    <p id="pinError" style="color:red; font-size:15px;"><?php echo $pinError; ?></p>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" value="<?php echo $psw ?>" required><br><br>

    <label for="rpsw"><b>Password</b></label>
    <input type="password" placeholder="Confirm Password" name="rpsw" id="rpsw" value="<?php echo $rpsw ?>" required>
    <p id="pswError" style="color:red; font-size:15px;"><?php echo $pswError; ?></p>
    <hr>

    <input class="registerbtn " type="submit"  name="submit" value="Register">
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="front.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
