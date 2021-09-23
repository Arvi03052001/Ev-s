
<?php
    session_start();

    if( isset($_SESSION['user'])){
        header("Location: profile.php");
    }

    if( isset( $_POST["submit"] ) )
    {   

        function valid($data){
            $data=trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }

        $inuser = valid( $_POST["username"] );
        $inkey = valid( $_POST["password"] );

        include("connect.php");

        $query = "SELECT username, password, name, email, join_date FROM users WHERE username='$inuser'";

        $result = mysqli_query( $conn, $query);
        if(mysqli_error($conn)){
            echo "<script>window.alert('Something Goes Wrong. Try Again');</script>";
        }
        else if( mysqli_num_rows($result) > 0 ){
            while( $row = mysqli_fetch_assoc($result) ){
                $user = $row['username'];
                $pass = $row['password'];
                $name = $row['name'];
                $email = $row['email'];
                $date = $row['join_date'];
            }

            if( password_verify( $inkey, $pass ) ){
                $_SESSION['user'] = $user;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['date'] = $date;
                header('Location: index.php');
            }
            else{
                echo "<script>window.alert('Wrong Username or Password Combination. Try Again');</script>";
            }
        }
        else{
            echo "<script>window.alert('No Such User exist in database');</script>";
        }
        mysqli_close($conn);
    }
?>




<!DOCTYPE html>
<html>
    <head>
        <title> Compsoft.Tech </title>
        <link type="text/css" rel="stylesheet" href="./css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/our-official-logo-removebg-preview.png" >
    </head>
    <body id="_5">
        
        <!-- content -->
        <section>
        <div class="logincontainer">
            <div class="user signinbx">
                <div class="imgbx">
                    <img src="./images/carnoback.png">
                </div>
                <div class="formbx">
                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
                        <h2>Sign In</h2>
                        <input type="text" id="user" name="username" placeholder="UserName">
                        <input type="password" id="key" name="password" placeholder="Password">
                        <div class="buttons">
                        <input type="submit" value="Login" name="submit"></div>
                        <p class="signup" id="new">Don't have an account? <a href="signup.php">Sign up</a> </p> 
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div id="footer" style="padding:20px;">
            &copy; 2021 &bull; Compsoft Tech.
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-3.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
   
    
</html>