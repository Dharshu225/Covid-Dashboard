<?php
session_start();
include "includes/user_headfoot.php";

$active=0;
$confirm=0;
$death=0;
$recover=0;

$a_active=0;
$a_recover=0;

$json=file_get_contents("https://api.covidindiatracker.com/state_data.json");
$obj = json_decode($json,true);
foreach($obj as $key){
    if($key["state"]=="Tamil Nadu"){
      $_SESSION["active"]=$key["active"];
      $_SESSION["confirm"]=$key["confirmed"];
      $_SESSION["death"]=$key["deaths"];
      $_SESSION["recover"]=$key["recovered"];
    }
}
$active=$_SESSION["active"];
$confirm=$_SESSION["confirm"];
$death=$_SESSION["death"];
$recover=$_SESSION["recover"];

$_SESSION["a_active"]=($active/$confirm)*360;
$a_active=$_SESSION["a_active"];
$_SESSION["a_recover"]=(($recover/$confirm)*360)+$a_active;
$a_recover=$_SESSION["a_recover"];

$_SESSION["b_active"]=($active/$confirm)*100;
$_SESSION["b_recover"]=($recover/$confirm)*100;
$_SESSION["b_death"]=($death/$confirm)*100;

$b_active=$_SESSION["b_active"];
$b_recover=$_SESSION["b_recover"];
$b_death=$_SESSION["b_death"];

$_SESSION["District"]="TamilNadu";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>User Home</title>

<style>
body{
  margin:2% auto auto;
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

.piechart { 
    display: block; 
    width: 280px; 
    height: 280px; 
    border-radius: 50%; 
    background-image: conic-gradient( 
        #F14D49 <?php echo $a_active.'deg' ?>,
        #50c878 0 <?php echo $a_recover.'deg' ?>,  
        #364242 0); 
}

* {box-sizing: border-box}

.contain {
  width:40%;
  padding:15px;
}

.containn {
  padding:20px;
}

.whole_container{
    width:85%;
    display: flex;
    justify-content: space-between;
}


.containerr {
  width: 100%;
  float:left;
  height:10%;
  background-color: #ddd;
}

.skills {
  text-align: right;
  padding-top: 10px;
  padding-bottom: 10px;
  padding:19px;
}

.active {width: <?php echo $b_active.'%' ?>; background-color: #F14D49;}
.recover {width: <?php echo $b_recover.'%' ?>; background-color: #50c878;}
.death {width: <?php echo $b_death.'%' ?>; background-color: #364242;}


</style>

</head>

<body>
<main>
<nav>
  <a href="download.php" style="float:right; font-size:18px; margin:auto 5% auto; text-decoration:None;">Download</a>
</nav>
    <p style="text-align:left; font-size:32px; margin:1% 13% 2%;">Tamil Nadu Live Cases</p>
    <div style="margin:auto 10% auto 13%;">
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
        <div class="whole_container">
            <div class="containn">
                <p style="text-align:left; font-size:28px; top:0">Pie Chart</p>
                <div class="piechart" style="float:left;"></div> 
            </div>
            <div class="contain">
                <p style=" font-size:28px;">Bar Chart</p>
                <p style="font-size:20px;">ACTIVE</p>
                <div class="containerr">
                  <p style="float:right; font-size:15px;"><?php echo round($b_active)."%"; ?></p>
                  <div class="skills active"></div>
                </div><br><br>

                <p style="font-size:20px;">RECOVER</p>
                <div class="containerr">
                  <p style="float:right; font-size:15px;"><?php echo round($b_recover)."%"; ?></p>
                  <div class="skills recover"></div>
                </div><br><br>

                <p style="font-size:20px;">DEATH</p>
                <div class="containerr">
                  <p style="float:right; font-size:15px;"><?php echo round($b_death)."%"; ?></p>
                  <div class="skills death"></div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
