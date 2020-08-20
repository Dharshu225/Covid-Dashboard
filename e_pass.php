<?php
session_start();
include "includes/user_headfoot.php";
include "dbb.php";

$servername = "kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "gux5fvna6rg9ojtw";
$password = "ilbs5whcyuonzg09";
$dbname = "f7j7r4crvmxu0dh9";

$conn = new mysqli($servername, $username, $password, $dbname);

$dbb=new dbb();
$from="";
$to="";
$reason="";
$date="";
$valid="";
$error="";
$no_pass=1;
$veh_no="";
$veh_type="";
$request_date="None";
$accept_date="None";
$reject_date="None";
$travel="None";
$_SESSION["provide"]=0;
$_SESSION["decline"]=0;
$_SESSION["date"]="";
$_SESSION["valid"]="";

$email=$_SESSION["email"];
$sql="SELECT email,e_pass_requested,e_pass_accepted,e_pass_rejected FROM user WHERE email='$email'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$pass_request=$row["e_pass_requested"];
$pass_accept=$row["e_pass_accepted"];
$pass_reject=$row["e_pass_rejected"];

$table = "user";
$columns = "e_pass_requested,e_pass_accepted,e_pass_rejected";

if(isset($_POST["submit"]))
{
    $from=$_POST["from"];
    $to=$_POST["to"];
    $reason=$_POST["reason"];
    $no_pass=$_POST["no_pass"];
    $veh_no=$_POST["veh_no"];
    $veh_type=$_POST["veh_type"];
    $date=$_POST['date'];
    $_SESSION["from"]=$from;
    $_SESSION["to"]=$to;
    $_SESSION["reason"]=$reason;
    $_SESSION["no_pass"]=$no_pass;
    $_SESSION["veh_no"]=$veh_no;
    $_SESSION["veh_type"]=$veh_type;
    if($from!="Choose..." && $to!="Choose..." && $reason!="Choose..." && $veh_no!="" && $veh_type!="Choose..." && $date!="")
    {
        $temp=explode("-",$date);
        if(sizeof($temp)!=1)
        {
            if (($veh_type=="Bike (max : 1)" && ($no_pass=="Choose...")) || ($veh_type=="Car (max : 3)" && ($no_pass==2 || $no_pass==3)) || ($veh_type=="Van (max : 7)" && ($no_pass>=2 || $no_pass<=6)))
            {
                $json=file_get_contents("https://api.covid19india.org/state_district_wise.json");
                $obj = json_decode($json,true);
                $pass_request+=1;
                $_SESSION["date"]=$date;
                $request_date=$date;
                $_SESSION["request"]=$pass_request;
                $dist1=$obj["Tamil Nadu"]["districtData"][$from];
                $dist2=$obj["Tamil Nadu"]["districtData"][$to];
                if ($from!=$to)
                {
                    if($dist1["active"]<5000 && $dist2["active"]<5000)
                    {
                        $pass_accept+=1;
                        $_SESSION["provide"]=1;
                        $valid=mktime(0, 0, 0, $temp[1], $temp[0]+2, $temp[2]);
                        $_SESSION["valid"]=$valid;
                        $accept_date=$date;
                        $travel=$from."-".$to;
                        echo "<script>window.location = 'decision.php';</script>";

                    }
                    else
                    {
                        $pass_reject+=1;
                        $reject_date=$date;
                        $_SESSION["decline"]=1;
                        echo "<script>window.location = 'decision.php';</script>";
                    }
                }
                else
                {
                    $error='Entered Same District!!!';
                }
            }
            else
            {
                $error='Number Passengers are high';
            }
        }
        else
        {
            $error='Invalid Date';
        }
    }
    else
    {
        $error='All fields are Required!!!';
    }
    $table = "user";
    $columns = "e_pass_requested='$pass_request',e_pass_accepted='$pass_accept',e_pass_rejected='$pass_reject',e_request_date='$request_date', e_accept_date='$accept_date', e_reject_date='$reject_date', travel='$travel'";
    $where = "email='$email'";
    $insertOutput = $dbb->Update($table,$columns,$where);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<title>E-pass Registration</title>

<style>

    .whole_container{
        width:40%;
        display: flex;
    }

    .contain {
    padding:1px;
    }

    .contain select{
        width:80%;
    }

    select{
        width:100%;
    }

</style>
</head>

<body>
<main>
<h2 style="font-size:30px; text-align:left; margin:2% 13% 2%;">E-pass Registration</h2>
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <div class="whole_container" style="margin:auto 13% auto; float:left;">
            <div class="contain" style="float:left;">
                <label for="from" style="font-size:20px;">From</label><br><br>
                    <select name="from" id="from" style="font-size:15px;" required>
                        <option name="empty">Choose...</option>
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
                    </select><br><br>

                <label for="reason" style="font-size:20px;">Reason for Travel</label><br><br>
                    <select name="reason" id="reason" style="font-size:15px;" required>
                        <option name="Choose...">Choose...</option>
                        <option name="return">Return of Stranded People</option>
                        <option name="medical">Medical</option>
                        <option name="marriage">Marriage</option>
                        <option name="death">Death</option>
                        <option name="wrk">Work Related</option>
                    </select><br><br>
                
                <label for="veh_type" style="font-size:20px;">Vehicle Type</label><br><br>
                    <select name="veh_type" id="veh_type" style="font-size:15px;" required>
                        <option name="Choose...">Choose...</option>
                        <option name="bike">Bike (max : 1)</option>
                        <option name="car">Car (max : 3)</option>
                        <option name="van">Van (max : 7)</option>
                    </select>
                <p style="color:#708275; font-size:15px;"><?php echo "Including driver" ?></p>
                <label for="date" style="font-size:20px;">Date of Travel</label><br><br>
                <input type="text" placeholder="dd-mm-yyyy" name="date"></input>
            </div>

            <div class="containn" style="float:right; margin: auto auto auto 25%;">
                    <label for="to" style="font-size:20px;">To</label><br><br>
                    <select name="to" id="to" style="font-size:15px;" required>
                        <option name="Choose...">Choose...</option>
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
                    </select><br><br>
                
                <label for="no_pass" style="font-size:20px;">No. of Passengers</label><br><br>
                    <select name="no_pass" id="no_pass" style="font-size:15px;" required>
                        <option name="Choose...">Choose...</option>
                        <option name="2">2</option>
                        <option name="3">3</option>
                        <option name="4">4</option>
                        <option name="5">5</option>
                        <option name="6">6</option>
                    </select><br><br>

                <label for="veh_no" style="font-size:20px;">Vehicle Number</label><br><br>
                <input type="text" placeholder="TN00XX0000" name="veh_no"></input>
                <p style="color:#708275; font-size:15px;"><?php echo "Excluding Space" ?></p><br><br>
                <input style="font-size:15px;" type="submit" value="Submit" name="submit">
            </div>
        </div>
        <p id="error" style="color:red; font-size:20px; text-align:center;"><?php echo $error; ?></p><br><br>
    </form>
</main>
</body>
</html>
