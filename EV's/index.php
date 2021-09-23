<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
    session_start();
    include('connect.php');
        if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL){
            echo "<script>window.alert('Please Enter something.');</script>";
        }
        else{
            $que = "";
            if($_POST["nul"]==0){
                if(strpos($_POST["preby"],$_SESSION["user"]) === false)
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby=CONCAT(answeredby,', @ ".$_SESSION["user"]."') where question like '%".$_POST["question"]."%'";
                else
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            }
            else
                $que = "update quans set answer='".$_POST["answer"]."', answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            if(mysqli_query($conn,$que)){
                echo "<style>#searchbox{display: none;} #tb{display: block;}</style>";
            }
            else
                echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Compsoft.Tech </title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/cc3bf60691.js" crossorigin="anonymous"></script>

        <link rel="icon" href="images/our-official-logo-removebg-preview.png" >
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <style>
            textarea{
                display: none;
                width: 300px;
                height: 50px;
                background: #333;
                color: #ddd;
                padding: 10px;
                margin: 5px 0 -14px; 
            }
            .ans_sub{
                display: none;
                padding: 0 10px;
                height: 30px;
                line-height: 30px;
            }
            .pop{
                display: none;
                text-align: center;
                margin: 151.5px auto;
                font-size: 12px;
            }
            .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #16C195;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #16C195;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #16C195;
}
        </style>
    </head>
    <body id="_1">
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
            <div id="searchbox">
                <center>
                   <div class="indextit">
                       <h2>Become more</h2>
                       <h1>powerful</h1>
                       <h2> with just </h2>
                       <h1>one </h1>
                       <h2> line</h2>
                   </div>
                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data" >
                        <input name="text" id="search" type="text" title="Question your Answers" placeholder="Looking for Answers to Some Question, simply just search here... ">
                        <i class="material-icons" id="sign">search</i>
                        <input name="submit" type="submit" value="Search" class="up-in" id="qsearch">
                    </form>
                </center>
            </div>
            <div class="pop" id="ta">
                <h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:(</b>Sorry, Your search didn't match any documents.</h1>
            </div>
            <div class="pop" id="tb">
                <center><h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:)</b>Thank You For Your Answer.</h1></center>
            </div>
            <?php

                if(isset($_POST["submit"])) {
                    function valid($data){
                        $data = trim(stripslashes(htmlspecialchars($data)));
                        return $data;
                    }

                    function check($data){
                        $data = strtolower($data);
                        if( $data != "what" && $data != "how" && $data != "who" && $data != "whom" && $data != "when" && $data != "why" && $data != "which" && $data != "where" && $data != "whose" && $data != "is" && $data != "am" && $data != "are" && $data != "do" && $data != "don't" && $data != "does" && $data != "did" && $data != "done" && $data != "was" && $data != "were" && $data != "has" && $data != "have" && $data != "will" && $data != "shall" && $data != "the" && $data != "i" && $data != "a" && $data != "an" && $data != "we" && $data != "he" && $data != "she" && $data != "")
                            return 1;
                        return 0;
                    }
                    $text = valid($_POST["text"]);
                    if($text == NULL){
                        echo "<script>window.alert('Please Enter something to search.');</script>";
                    }
                    else{
                        $text = preg_replace("/[^A-Za-z0-9]/"," ",$text);
                        $words = explode(" ",$text);
                        $format = "select * from quans where question like '%";
                        $query = "";
                        foreach($words as $word){
                            if(check($word)){
                                if($query == "")
                                    $query = $format.$word."%'";
                                else
                                    $query .= " union ".$format.$word."%'";
                            }
                        }
                        if(!$query){
                            echo "<script>window.alert('Search appropriate question.');</script>";
                        }
                        else{
                            $r = mysqli_query($conn, $query);
                            if(mysqli_error($conn))
                                echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                            else if(mysqli_num_rows($r)>0) {
            ?>
                <style>.open{display: block;} </style>
                <center>
                    <div class='open' style='height: auto; margin: 60px auto -135px;'>
                        
                        <div id='topic'>
                            <h2 id='topic-head' style="font-weight: normal; border:none; font-size: 22px;">Your Search Results for '<?php echo $text; ?>' are :</h2>
                        </div>

            <?php $n = 1; $nul=0; while( $row = mysqli_fetch_assoc($r) ) { ?>
                        
                        <div id="qa-block">
                            <div class="question">
                                <div id="Q">Q.</div><?php echo $row["question"]."<small id='sml'>Asked By: @".$row['askedby']."</small>"; ?>
                            </div>
                            <div class="answer">
                                <?php
                                    if($row["answer"]){
                                        $nul=0;
                                        echo $row["answer"]."<br><small>Answered By: @".$row['answeredby']."</small>";
                                    }
                                    else{
                                        $nul=1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                ?>
                                <form id="f<?php echo $n; ?>" style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
<!--                                    <input type="button" value="Click here to answer." id="ans_b" >-->
                                    <label style="margin-bottom: -25px;"><a id="ans_b<?php echo $n; ?>" href="#area<?php echo $n; ?>"> <u>Submit your answer</u></a></label>
                                    <br>
                                    <script>
                                        $(function(){
                                            $('#ans_b<?php echo $n; ?>').click(function(e){
                                                e.preventDefault();
                                                $('#area<?php echo $n; ?>').css("display","block");
                                                $('#ar<?php echo $n; ?>').css("display","block");
                                                $('#f<?php echo $n; ?>').css("margin-bottom","0px");
                                            });
                                        });
                                    </script>
                                     <div class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $row['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $row['answeredby'] ?>">
                                    </br> 
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    
                                </form>
                                
       
                            </div>
                        </div>
                            <?php $n++; } ?>
                    </div>
                </center>
            <?php     
                        } // if for no. of rows
                        else{
                            echo "<style>#searchbox{display: none;} #ta{display: block;}</style>";
                        }
                        }
                    } // a non null if
                } // isset for submit
            ?>
        </div>
  
</body>
</html>