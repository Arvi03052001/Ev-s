<?php
    session_start();
    if(! isset($_SESSION['user']))
        header("Location: login.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compsoft.Tech </title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link rel="icon" href="images/our-official-logo-removebg-preview.png" >
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
    </head>
    <body id="pro">
        <div class="nav">
        <div class="mainlogo"> <img src="images/our-official-logo-removebg-preview.png"></div>
        <div class="maintitle"><h2>Compsoft</h2></div>
        <a href="logout.php"><button class="logoutbtn">logout</button></a>
        <a href="profile.php"><button class="profilebtn" >Hi, <?php echo $_SESSION["user"]; ?></button></a>
        <a href="ask.php"><button class="askbtn">Ask</button></a>
        <a href="contacts.php"><button class="contacts">Contact</button></a>
        <a href="index.php"><button class="homebtn">Home</button></a>
</div>
        
        <!-- content -->
        <div id="content">
        <center>
            <h1 id="hea"><?php echo "Welcome ".$_SESSION["user"]; ?></h1>
            <div class="clearfix">
                <div id="hea-det">
                    <p id="first">N</p><p class="tit">ame: </p>
                    <p class="det"><?php echo $_SESSION["name"]; ?></p><br>
                    <p id="first">E</p><p class="tit">mail: </p>
                    <p class="det"><?php echo $_SESSION["email"]; ?></p><br>
                    <p id="first">J</p><p class="tit">oin Date: </p>
                    <p class="det"><?php echo $_SESSION["date"]; ?></p>
                </div>
                <div id="pic"></div>
            </div>
        </center>
        </div>
    
        <!-- Footer -->
        <div id="footer">
            &copy; 2021 &bull; Compsoft Tech.
        </div>
        
    </body>
    
</html>


