<?php
session_start();
include "includes/user_headfoot.php";

$json=file_get_contents("https://api.covid19india.org/state_district_wise.json");
$active=0;
$confirm=0;
$death=0;
$recover=0;
$a_active=0;
$a_recover=0;
$b_active=0;
$b_death=0;
$b_recover=0;
$dist="";

if(isset($_POST["Submit"]))
{
    $dist=$_POST["dist"];
    // Decode JSON data to PHP object
    $obj = json_decode($json,true);
    $state=$obj["Tamil Nadu"]["districtData"][$dist];
    // Loop through the object
        
    $_SESSION["active"]=$state["active"];
    $_SESSION["confirm"]=$state["confirmed"];
    $_SESSION["death"]=$state["deceased"];
    $_SESSION["recover"]=$state["recovered"];

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

    $_SESSION["District"]=$dist;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>District-Wise Cases</title>

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
  padding:15px;
}

.whole_container{
    width:85%;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
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
  padding:21px;
}

.active {width: <?php echo $b_active.'%' ?>; background-color: #F14D49;}
.recover {width: <?php echo $b_recover.'%' ?>; background-color: #50c878;}
.death {width: <?php echo $b_death.'%' ?>; background-color: #364242;}

</style>
</head>

<body>
<main>

<div style="margin: auto auto auto 10%;">
  <a href="download.php" style="float:right; font-size:18px;">Download</a>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <p style="font-size:23px;">Select District</p>
        <select name="dist" id="dist" style="font-size:15px;" required>
            <option>Choose...</option>
            <option name="Ariyalur">Ariyalur</option>
            <option name="Chengalpattu">Chengalpattu</option>
            <option name="Chennai">Chennai</option>
            <option name="Coimbatore">Coimbatore</option>
            <option name="Cuddalore">Cuddalore</option>
            <option name="Dharmapuri">Dharmapuri</option>
            <option name="Dindigul">Dindigul</option>
            <option name="Erode">Erode</option>
            <option name="Kallakurichi">Kallakurichi</option>
            <option name="Kancheepuram">Kancheepuram</option>
            <option name="Kanyakumari">Kanyakumari</option>
            <option name="Krishnagiri">Krishnagiri</option>
            <option name="Madurai">Madurai</option>
            <option name="Nagapattinam">Nagapattinam</option>
            <option name="Namakkal">Namakkal</option>
            <option name="Nilgiris">Nilgiris</option>
            <option name="Perambalur">Perambalur</option>
            <option name="Pudukkottai">Pudukkottai</option>
            <option name="Ramanathapuram">Ramanathapuram</option>
            <option name="Ranipet">Ranipet</option>
            <option name="Salem">Salem</option>
            <option name="Sivaganga">Sivaganga</option>
            <option name="Tenkasi">Tenkasi</option>
            <option name="Thanjavur">Thanjavur</option>
            <option name="Theni">Theni</option>
            <option name="Thiruvallur">Thiruvallur</option>
            <option name="Thiruvarur">Thiruvarur</option>
            <option name="Thoothukkudi">Thoothukkudi</option>
            <option name="Tiruchirappalli">Tiruchirappalli</option>
            <option name="Tirunelveli">Tirunelveli</option>
            <option name="Tirupathur">Tirupathur</option>
            <option name="Tiruppur">Tiruppur</option>
            <option name="Tiruvannamalai">Tiruvannamalai</option>
            <option name="Vellore">Vellore</option>
            <option name="Viluppuram">Viluppuram</option>
            <option name="Virudhunagar">Virudhunagar</option>
        </select>
            <input style="font-size:15px;" type="submit" value="Go" name="Submit">
    </form>
</div>
    <p style="text-align:center; font-size:35px;"><?php echo $dist ?> Cases</p>
    <div style="margin:auto 5% auto 10%;">
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
                <p style="text-align:left; font-size:30px; top:0">Pie Chart</p>
                <div class="piechart" style="float:left;"></div> 
            </div>
            <br>
            <div class="contain">
                <p style=" font-size:28px;">Bar Chart</p>
                <p style="font-size:20px;">ACTIVE</p>
                <div class="containerr">
                  <p style="float:right; font-size:13px;"><?php echo round($b_active)."%"; ?></p>
                  <div class="skills active"></div>
                </div><br><br>

                <p style="font-size:20px;">RECOVER</p>
                <div class="containerr">
                  <p style="float:right; font-size:13px;"><?php echo round($b_recover)."%"; ?></p>
                  <div class="skills recover"></div>
                </div><br><br>

                <p style="font-size:20px;">DEATH</p>
                <div class="containerr">
                    <p style="float:right; font-size:13px;"><?php echo round($b_death)."%"; ?></p>
                  <div class="skills death"></div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
