<?php 
session_start();

$active=$_SESSION["active"];
$confirm=$_SESSION["confirm"];
$death=$_SESSION["death"];
$recover=$_SESSION["recover"];

$a_active=$_SESSION["a_active"];
$a_recover=$_SESSION["a_recover"];

$b_active=$_SESSION["b_active"];
$b_recover=$_SESSION["b_recover"];
$b_death=$_SESSION["b_death"];

$dist=$_SESSION["District"];

?>

<!DOCTYPE html> 
<html> 

<head> 
	<title> 
		Download
	</title> 
	
	<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> 
	</script> 
	
	<script src= "https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"> 
	</script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
	
    
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

* {box-sizing: border-box}

.contain {
  width:75%;
  padding:15px;
}

.whole_container{
    width:100%;
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

nav a{
	margin:5px;
	float:right;
}

</style>

</head> 

<body>
<nav>
    <a id="btn-Convert-Html2Image" href="#" style="text-decoration:None;">Download as image</a>
    
    <a id="pdf" href="#" style="text-decoration:None;">Download as pdf</a>
    
    <a href="user.php" style="text-decoration:None;">Back</a> 
</nav>
	<center> 
	
        <div id="html-content-holder" style=" 
                    color: black; width: 75%;padding-left: 25px; 
                    padding-top: 10px;"> 
            
            <strong style="font-size:35px; margin:1% auto 2% 10%;"> 
                Covid Dashboard 
            </strong> 
            
            <hr/> 
            
            <h3 style="font-size:30px "> 
                Covid-19 Live <?php echo $dist; ?> Cases 
            </h3> 
        
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
            <div class="whole_container" style="margin:1% auto 5%;">
                <div class="contain" style="text-align:left;">
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
        
        <script>
             $("#pdf").on('click', function() {
                let doc = new jsPDF('p','pt','a4');
                doc.addHTML(document.body,function() {
                    doc.save('CovidDashboard.pdf');
                });
            });

            $(document).ready(function() { 
            
                // Global variable 
                var element = $("#html-content-holder"); 
            
                // Global variable 
                var getCanvas; 
 
                    html2canvas(element, { 
                        onrendered: function(canvas) { 
                            getCanvas = canvas; 
                        } 
                    }); 

                $("#btn-Convert-Html2Image").on('click', function() { 
                    var imgageData = 
                        getCanvas.toDataURL("image/png"); 
                
                    // Now browser starts downloading 
                    // it instead of just showing it 
                    var newData = imgageData.replace( 
                    /^data:image\/png/, "data:application/octet-stream"); 
                
                    $("#btn-Convert-Html2Image").attr( 
                    "download", "CovidDashboard.jpg").attr( 
                    "href", newData); 
                }); 
            }); 
        </script> 
	</center> 
</body> 

</html>					 
