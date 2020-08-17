<?php
include "includes/head_foot.php" ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width">

<style>

    body
    {
        padding-top: 120px;
    }

    .fixed-header{
		padding: 10px;
    }

    .navv a{
        color: White;
        display: inline-block;
		margin:5px;
		float:right;
    }

    .mySidenav a 
    {
        position: fixed;
        left: -125px;
        transition: 0.3s;
        padding: 15px;
        width: 150px;
        text-decoration: none;
        font-size: 20px;
        color: white;
        border-radius: 0 5px 5px 0;
        background-color: #008080;
    }

    .mySidenav a:hover 
    {
        left: 0;
    }

    #home {
        top: 270px;
    }

    #district {
        top: 330px;
    }

    #e_pass {
        top: 390px;
    }

    #profile {
        top: 450px;
    }

    #logout {
        top: 510px;
    }

</style>
</head>

<body>
<main>
    <div class="fixed-header">
		<div class="container">
            <img src="includes/images/corona_png.png" style="width:6%; margin:-10px 1% auto 1%; float:left;"></img>
			<h1 style="color:White; text-align:left; font-size: 40px;">COVID DASHBOARD</h1>
            <navv>
				<a style="font-size:18px; float:right; color:white"><?php echo "Welcome " .$_SESSION["name"]. "!!!"; ?></a>
            </navv>
		</div>
    </div>
    <div class="mySidenav">
        <a href="user.php" id="home">Home</a>
        <a href="district.php" id="district">View District</a>
        <a href="e_pass.php" id="e_pass">E_pass</a>
        <a href="profile.php" id="profile">Profile</a>
        <a href="front.php" id="logout">Logout</a>
    </div>
</main>
</body>
</html>
