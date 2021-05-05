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
                
                if($u && $p){
                    $conn = mysqli_connect("localhost", "root","", "picture_social");
                    $sql = "select * from users where username = '".$u."' and password = '".$p."'";
                    
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result) == 0){
                        echo "<script>alert(\"Username or Password is not correct, please try again\");</script>";
                    }
                    else{
                        $_SESSION['username'] = $u;
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
                        <button class="home" onclick="">
                            <img src="../Picture/home.png" class="icon_h">
                        </button>
                    </li>
                    <li>
                        <button class="feed" onclick="">
                            <img src="../Picture/feed.png" class="icon_h">
                        </button>

                    </li>
                </ul>
            </div>

            <div class="header_2">
                <ul style="list-style-type: none">
                    <li>
                        <button class="bell" onclick="">
                            <img src="../Picture/bell.png" class="icon_h">
                        </button>
                    </li>
                    <li>
                        <button class="login" onclick="">
                            <img src="../Picture/login.png" class="icon_h">
                        </button>
                    </li>
                    <li>
                        <button class="register" onclick="">
                            <img src="../Picture/register.png" class="icon_h">
                        </button>
                    </li>
                    <li>
                        <a href="#" id="user" style="color: white;" class="icon_h">aaa</a>
                    </li>
                    <li>
                        <button class="user" onclick="">
                            <img src="../Picture/tk.png" class="icon_h">
                        </button>
                    </li>
                </ul>
            </div>

        </div>
     <main>
        <div class="loginbox">
          
          <img src="..\Picture\avatar.png" class="avatar">
            <h1>Đăng nhập</h1>
            <form method="post" action="login.php">
                <p>Username</p>
                <input type="text" name="username" placeholder=" Username">
                <p>Password</p>
                <input type="password" name="password" placeholder=" Password">
                <input type="submit" name="login" value="Login">
                <a href="#">Quên mật khẩu?</a><br>
                <a href="#">Chưa có tài khoản?</a>
            </form>
        </div>
      </main>
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
    </body>
</html>
