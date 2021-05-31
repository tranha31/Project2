<?php session_start(); ?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="login.css">
        
        <?php
            if(isset($_POST['login'])){
                if($_POST['username'] == null){
                    echo "<script>alert(\"Please enter your username\");</script>";
                }
                else{
                    $u =  $_POST['username'];
                }
                if($_POST['password'] == null){
                    echo "<script>alert(\"Please enter your password\");</script>";
                }
                else{
                    $p = $_POST['password'];
                }
                if($_POST['email'] == null){
                    echo "<script>alert(\"Please enter your email\");</script>";
                }
                else{
                    $em = $_POST['email'];
                }
                if($u && $p && $em){
                    $conn = mysqli_connect("localhost", "root","", "picture_social");
                    $sql = "select * from users where username = '".$u."' and email = '".$em."'";
                    
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result) == 0){
                        echo "<script>alert(\"Username or Email is not correct, please try again\");</script>";
                    }
                    else{
                            $verificationCode = md5(uniqid("validation", true));
                            $verificationLink = "http://localhost/Project2/Code/SignupControl.php?code=" . $verificationCode;
                    
                            $htmlStr = "";
                            $htmlStr .= "Hi " . $em."\n";
 
                            $htmlStr .= "Please click the link below to verify your subscription and have access to the download center.\n";
                            $htmlStr .= "$verificationLink"."\n";
 
                            $htmlStr .= "Kind regards,";
                    
                            $name = "UKnow";
                            $email_sender = "nhom8cnw@gmail.com";
                            $subject = "Verification Link | UKnow | Subscription";
                            $recipient_email = $em;
 
                            $headers  = "MIME-Version: 1.0rn";
                            $headers .= "Content-type: text/html; charset=iso-8859-1rn";
                            $headers .= "From: {$name} <{$email_sender}> n";
 
                            $body = $htmlStr;
                            $d = date('Y-m-d');
                            if( mail($recipient_email, $subject, $body, $headers) ){
                                $sql = "update users set password = '$p', verificode='$verificationCode', verify=0 where username = '$u'";
                                mysqli_query($conn, $sql, null);
                        
                                echo "<script>alert(\"Please check your email to verified account!\");window.location.assign(\"login.php\");</script>";
                            }
                            else{
                                die("Sending failed.");
                                echo "<script>window.location.assign(\"signup.php\");</script>";
                            }
                        echo "<script>window.location.href=\"Home.php\";</script>";
                        
                    }
                }
                
            }
        
        ?>
    </head>

    <body>
        <div class="header">
            <div class="header_1">
                <ul style="list-style-type: none">
                    <li>
                        <p style="display: inline;" class="tenweb">Ten trang web</p>
                    </li>
                    <li>
                        <a class="home" href="Home.php">
                            <img src="../Picture/home.png" class="icon_h">
                        </a>
                    </li>
                    <li>
                        <a class="feed" href="Feed.php">
                            <img src="../Picture/feed.png" class="icon_h">
                        </a>
                        
                    </li>
                </ul>
            </div>
            
            <div class="header_2" id="header_2">
                <ul style="list-style-type: none" id="r_link">
                    <!--<li id="notification_li">
                        <span id="notification_count">3</span>
                        <a class="bell" href="" id="notificationLink">
                            <img src="../Picture/bell.png" class="icon_h" id="icon_h">
                        </a>
                        <div id="notificationContainer">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" class="notifications">
                            </div>
                            <div id="notificationFooter"><a href="#">See All</a></div>
                        </div>
                        
                    </li>-->
                    <li>
                        <a class="login" href="login.php">
                            <img src="../Picture/login.png" class="icon_h">
                        </a>
                    </li>
                    <li>
                        <a class="register" href="signup.php">
                            <img src="../Picture/register.png" class="icon_h">
                        </a>
                    </li>

                </ul>
            </div>
            
        </div>
     <div id="main">
         
        <div class="loginbox">
          
          <img src="..\Picture\avatar.png" class="avatar">
            <h1>Login</h1>
            <form method="post" action="login.php">
                <p>Username</p>
                <input type="text" name="username" placeholder=" Username">
                <p>New Password</p>
                <input type="password" name="password" placeholder=" Password">
                <p>Email</p>
                <input type="password" name="email" placeholder=" Email">
                <input type="submit" name="login" value="Submit">
                <a href="login.php">Login</a>
            </form>
        </div>
      </div>
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
    </body>
</html>
