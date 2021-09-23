<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['user']))
        header("location: login.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Compsoft.Tech</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/our-official-logo-removebg-preview.png" >
    </head>
    <body id="ask">
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
        <div id="askcontent">
            <div id="sf">
                <center>
                    <div class="plughead">
                        <h1>Change</h1>
                        <h2>the world</h2>
                        <h2>by one</h2>
                        <h1>question!</h1>
                        
                    </div>
        

                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">

                        <input name="question" type="text" title="Your Question..." placeholder="Waiting for plug!   Connect it fast....." id="question">
                        
                        <input name="submit" type="submit" class="up-in" id="ask_submit">
                    </form>
                </center>
            </div>
        </div>
        
        <div id="ask-ta">
            <h1>Thank You.<br>Stay tunned for updates.</h1>
        </div>
        
        <?php
        
            if( isset( $_POST["submit"] ) )
            {

                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }
                $question = valid( $_POST["question"] );
                
                //$no = valid( $_POST["cat"]);
                $question = addslashes($question);
                $q = "SELECT * FROM quans WHERE question = '$question'";
                $result = mysqli_query($conn,$q);
                if(mysqli_error($conn))
                    echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                    
                else if( mysqli_num_rows($result) == 0 ){
                    $query = "INSERT INTO quans VALUES(NULL, '$question', NULL,'".$_SESSION['user']."',NULL)";
                    $query1 = "INSERT INTO quacat SELECT q.id, c.name FROM quans as q, category as c WHERE q.question = '".$question."' AND c.name = '".$_POST['cat']."'";
                    mysqli_query( $conn, $query);
                    if(mysqli_query( $conn, $query1)){
                        echo "<style>#sf{display: none;} #ask-ta{display:block;}</style>";
                    }
                    else{
                        echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                    }
                }
                else{
                    echo "<script>window.alert('Question was already Asked. Search it on Home Page.');</script>";
                }
                
                mysqli_close($conn);
            }
        
        ?>
        
        <!-- Footer -->
        <div id="footer" style="padding:30px;">
            &copy; 2021 &bull; Compsoft Tech.
        </div>
        
        <!-- Sripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-3.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
    
</html>


