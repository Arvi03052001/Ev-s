<?php
    session_start();
    
    if( isset($_SESSION['user'])){
        header("Location: profile.php");
    }
    include('connect.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <title>Compsoft.Tech</title>
        <link rel="icon" href="images/our-official-logo-removebg-preview.png" >
    </head>
    <body id="_6">
        
        <!-- content -->
        
    <section>
    <div class="logincontainer" id="sf">
        <div class="user signupbx">
            <div class="formbx">
                <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
                    <h2>Create an Account</h2>
                    <input type="text" name="username" id="user" title="This will be your parmanent Id." placeholder="Create UserName" required>
                    <input type="email" name="email" id="mailbox" title="Your Email id is in safe hands." placeholder="Email Address" required>
                    <input type="password" name="password" id="key" title="Password must contain at least 8 characters including alphabets,numbers, and symbols." placeholder="Create Password" required>
                    <input name="name" id="name" type="text" title="Although, you will be called by your name only" placeholder="Enter your Full Name" required>
                    <input type="submit" name="submit" value="Sign Up">
                    <p class="signup">Already have an account? <a href="login.php" >Login</a> </p>
                </form>
            </div>
            <div class="imgbx">
                <img src="./images/carpark.png">
            </div>
        </div>
    </div>
                <div id="ta">
                <h1>Thank You For Registering With Us. </h1>
                <h2>Click Login and get Connected</h2>   
                <a href="login.php"><button class="thanksloginbtn">Login</button></a>
</section>
        
        <?php
        
            if( isset( $_POST["submit"] ) )
            {

                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }

                $username = valid( $_POST["username"] );
                $password = valid( $_POST["password"] );
                $password = password_hash($password, PASSWORD_DEFAULT);
                $name = valid( $_POST["name"] );
                $email = valid( $_POST["email"] );

                $query = "INSERT INTO users values( NULL, '$username', '$password', '$name', '$email', CURRENT_TIMESTAMP )";
                if(mysqli_error($conn)){
                    echo "<script>window.alert('Something Goes Wrong. Try Again');</script>";
                }
//                echo $query;
                else if( mysqli_query( $conn, $query) ){
                    echo "<style>#sf{display: none;} #ta{display:block;}</style>";
                }
                else{
//                    echo mysqli_error($conn);
                    echo "<script>window.alert('Username Already Exist !! Try Again');</script>";
                }
                mysqli_close($conn);
            }
        
        ?>
        
        <!-- Footer -->
        <div id="footer" style="padding:20px;">
            &copy; 2021 &bull; Compsoft Tech.
        </div>
        
        <!-- Sripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-3.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
    
</html>