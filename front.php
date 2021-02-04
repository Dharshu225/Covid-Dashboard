<?php
session_start();
$servername = "kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "gux5fvna6rg9ojtw";
$password = "ilbs5whcyuonzg09";
$dbname = "f7j7r4crvmxu0dh9";

$conn = new mysqli($servername, $username, $password, $dbname);

$name="";
$psw="";
$pswError="";
$_SESSION["register"]="";

$active=0;
$confirm=0;
$death=0;
$recover=0;

$json=file_get_contents("https://api.covid19india.org/state_district_wise.json");
$obj = json_decode($json,true);
foreach($obj as $t1){
  $t2=$t1["districtData"];
    foreach($t2 as $key){
      $active+=$key["active"];
      $confirm+=$key["confirmed"];
      $death+=$key["deceased"];
      $recover+=$key["recovered"];
    }
}

if(isset($_POST["submit"])) 
{
  $name=$_POST["name"];
  $psw=$_POST["psw"];
  $sql="SELECT email,first_name,passwordd,mobile FROM user WHERE email='$name'";
  $result=mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $_SESSION["email"]=$name;
  $_SESSION["name"] = $row["first_name"];
  $_SESSION["mobile"]=$row["mobile"];
	
	if($name == "dharsh@gmail.com" && $psw == "Dharsh@225")
    {
      header("location:admin.php");
    }
    else
    {
      if($row["email"]==$name && $row["passwordd"]==$psw)
      {
        header("location:otp.php");
      }
      else
      {
        $pswError='Username or Password is Incorrect';
      }
    }
}

?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Covid Dashboard</title>
<link rel="shortcut icon" href="includes/images/corona_icon.jpeg" type="image/x-icon">

<style>
body {font-family: Times New Roman, Times, serif;}
.center {
  position: absolute;
  height:1px;
  left: 50%;
  text-align: center;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
header {
  background-color: #008080;
  padding: 53px;
  length:50px;
  left:50px;
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

button {
  background-color: white;
  color: blue;
  cursor: pointer;
  width: 50%;
  padding: 10px;
  border:white;
}

button:hover,buton:hover{
  opacity: 0.8;
}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 30%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
  img{
    width:15%;
  }
}

.grid-container {
  display: grid;
  grid-gap: 70px;
  grid-template-columns: 19% 19% 19% 19%;
  padding: 5px;
}

.grid-item {
  padding: 5px;
  font-size: 25px;
  text-align: center;
  color:white;
}

.grid-item:hover{
  opacity:0.8;
}

</style>
</head>
<body>

<header>
  <img src="includes/images/corona_png.png" style="width:10%; margin:1% 2% auto 2%; float:left;"></img>
  <h1 style="color:White;font-size: 60px; margin: 3% 25% 5%;">COVID DASHBOARD</h1>
  <buton onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</buton>
</header>
<p style="text-align:center; font-size:35px;">COVID-19 INDIA LIVE CASES</p>
<div style="margin:1% auto 5% auto; width:80%;">
  <div class="grid-container">
    <div class="grid-item" style="background-color: #e3b448; border: 1px solid #e3b448;">
      <p>Total</p>
      <?php echo $confirm ?>
    </div>
    <div class="grid-item" style="background-color:#F14D49; border: 1px solid #F14D49;">
      <p>Active</p>
      <?php echo $active ?>
    </div>
    <div class="grid-item" style="background-color:#50c878; border: 1px solid #50c878;">
      <p>Recovered</p>
      <?php echo $recover ?>
    </div>
    <div class="grid-item" style="background-color:#364242; border: 1px solid #364242;">
      <p>Death</p>
      <?php echo $death ?>
    </div>
  </div>
</div>
<p id="passwordError" style="color:red; text-align:center; font-size:20px;"><?php echo $pswError; ?></p>
<p style="text-align:right; font-size:20px;">Login for more details...</p>
<p style="color:green; text-align:center; font-size:20px;"><?php if($_SESSION["register"]!="") {echo $_SESSION["register"];} ?></p>

<div id="id01" class="modal">
  <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="container">
	  <h2 style="text-align:center">Login</h2>
      <label for="name"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="name" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" style="justify-content: center;" name="submit">Login</button>
	  
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" style="color:white;" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw"> <a href="form.php">New Registration</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>
</html>
