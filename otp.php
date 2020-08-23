<?php
session_start();

$otpError="";

$otpValue=(( isset($_REQUEST['otp']) AND $_REQUEST['otp']<>'' ) ? $_REQUEST['otp'] : '' );
$mobile=$_SESSION["mobile"];
        
### Check if OTP is matching or not
$APIKey='0a00bdc8-dbe1-11ea-9fa5-0200cd936042';
$OTPMessage="We have sent an OTP to $mobile,<br>Please enter the same below";

if ( $otpValue <> '') ### OTP value entered by user
  {
    $VerificationSessionId=$_REQUEST['VerificationSessionId'];
    $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/VERIFY/$VerificationSessionId/$otpValue"),false);
    $VerificationStatus= $API_Response_json -> Details;
                
    ### Check if OTP is matching
    if ( $VerificationStatus =='OTP Matched')
    {
      header("location:user.php");        
    }
    else
    {
      $otpError='Incorrect OTP';
    }
  }
else
{
  ### Send OTP
  $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/$mobile/AUTOGEN"),false);
  $VerificationSessionId= $API_Response_json->Details;
}



?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>OTP Authentication</title>

<style>
body {font-family: Times New Roman, Times, serif;}

header {
  background-color: #008080;
  padding: 53px;
  length:50px;
  left:50px;
}

.contain {
  padding:10px;
  margin:2% 43% auto;
}

buton {
  background-color:  #008080;
  color: white;
  padding: 10px;
  cursor: pointer;
  font-size:20px;
  color: White;
  display: inline-block;
	margin:10px;
	float:right;
}

buton:hover{
  opacity: 0.8;
}

nav a
{
  color: White;
  display: inline-block;
	margin:5px;
	float:right;
}

</style>
</head>
<body>

<header>
  <h1 style="color:White; text-align: center; font-size: 60px;">COVID DASHBOARD</h1>
  <nav>
    <a style="text-decoration:none;" href="front.php">Back</a>
  </nav>
</header>

<form  action="otp.php" method = "POST">
  <h2 style="text-align:center">OTP Verification</h2>
  <p id="otpMsg" style="color:blue; text-align:center; font-size:20px;"><?php echo $OTPMessage; ?></p>

  <div class="contain" style="float:center;">
    <label for="otp"><b>OTP</b></label><br><br>
    <input type="text" placeholder="Enter OTP" name="otp" required><br><br>
    <input type="hidden"  name="VerificationSessionId" value="<?php echo $VerificationSessionId; ?>" >

    <button type="submit" style="justify-content: center;" name="otp_submit">Login</button>

  </div>
</form>

<p id="passwordError" style="color:red; text-align:center; font-size:20px;"><?php echo $otpError; ?></p>

</body>
</html>
