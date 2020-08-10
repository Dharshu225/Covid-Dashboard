<?php
session_start();
include "includes/user_headfoot.php";

$confirm=0;
$death=0;
$recover=0;

$a_active=0;
$a_recover=0;

$json=file_get_contents("https://api.covidindiatracker.com/state_data.json");
$obj = json_decode($json,true);
foreach($obj as $key){
    if($key["state"]=="Tamil Nadu"){
        $active=$key["active"];
        $confirm=$key["confirmed"];
        $death=$key["deaths"];
        $recover=$key["recovered"];
    }
}

$a_active=($active/$confirm)*360;
$a_recover=(($recover/$confirm)*360)+$a_active;

$b_active=($active/$confirm)*100;
$b_recover=($recover/$confirm)*100;
$b_death=($death/$confirm)*100;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>User Home</title>

<style>

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
  padding:25px;
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
  background-color: #ddd;
}

.skills {
  text-align: right;
  padding-top: 10px;
  padding-bottom: 10px;
  color: white;
}

.active {width: <?php echo $b_active.'%' ?>; background-color: #F14D49; padding:15px;}
.recover {width: <?php echo $b_recover.'%' ?>; background-color: #50c878; padding:15px;}
.death {width: <?php echo $b_death.'%' ?>; background-color: #364242; padding:15px;}


</style>

</head>

<body>
<main>
    <p style="text-align:center; font-size:30px;">TAMIL NADU CASES</p>
    <div style="margin:auto 10% auto 15%;">
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
                <div class="skills active"></div>
                </div><br><br>

                <p style="font-size:20px;">RECOVER</p>
                <div class="containerr">
                <div class="skills recover"></div>
                </div><br><br>

                <p style="font-size:20px;">DEATH</p>
                <div class="containerr">
                <div class="skills death"></div>
            </div>
        </div>
    </div>
</main>
</body>
</html>