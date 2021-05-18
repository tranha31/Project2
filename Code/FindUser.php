<?php session_start(); ?>
<!doctype html>

<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
        <link rel="stylesheet" type="text/css" href="Feed.css">
        <link rel="stylesheet" type="text/css" href="FindUser.css">
        
        <?php 
        if(!isset($_SESSION['username'])){
            echo "<script>alert(\"You must login first\");</script>";
            echo "<script>window.location.assign(\"Home.php\");</script>";
        }
        if(empty($_POST['Search'])){
            
            echo "<script>alert(\"You must enter the name you want to find\");</script>";
            echo "<script>window.location.assign(\"Feed.php\");</script>";
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
                        <a class="feed" href="Feed.css">
                            <img src="../Picture/feed.png" class="icon_h">
                        </a>
                        
                    </li>
                </ul>
            </div>
            
            <div class="header_2" id="header_2">
                <ul style="list-style-type: none" id="r_link">
                    <li id="notification_li">
                        <span id="notification_count">3</span>
                        <a class="bell" href="" id="notificationLink">
                            <img src="../Picture/bell.png" class="icon_h" id="icon_h">
                        </a>
                        <div id="notificationContainer">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" class="notifications"></div>
                            <div id="notificationFooter"><a href="#">See All</a></div>
                        </div>
                        
                    </li>
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
                    <li>
                        <a href="user.php" id="user" style="color: white;" class="icon_h">aaa</a>
                    </li>
                    <li>
                        <a class="user" href="user.php">
                            <img src="../Picture/tk.png" class="icon_h">
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        
        <div class="main">
            
            <form class="search" style="display: flex;" method="post" action="FindUser.php">
                <input type="text" name="Search" id="search_1" value="<?php echo $_POST['Search']; ?>">
                <button style="border:none; background:none;" type="submit" id="search_2"><img src="../Picture/find.png"></button>
            </form>
            
            <div class = "all_find">
                <?php 
                    $name = $_POST['Search'];
                    $find = explode(' ', $name);
                    foreach($find as $key => $value){
                        $conn = mysqli_connect("localhost", "root","", "picture_social");
                        $sql = "select * from users where name like'%".$value."%' and username != '".$_SESSION['username']."'";
                        
                        $result = mysqli_query($conn, $sql, null);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $s = "select * from avatar where id_user = '".$row['username']."'";
                                $result1 = mysqli_query($conn, $s, null);
                                $ava = mysqli_fetch_assoc($result1);
                                ?>
                                    <div class="users">
                                        <a href="user_1.php?user=<?php echo $row['username']?>" class="ava_user" id="user_1">
                                            <?php echo "<img id = \"profile_2\" src = ".$ava["link"].">"; ?>
                                        </a>
                                        <a href="user_1.php?user=<?php echo $row['username']?>" class="link_ava" id="link_a_1"><?php echo $row['name']; ?></a>
                                
                                    </div>  
                                <?php
                            }
                        }
                    }
                    
                ?>
                
                        
                  
            </div>
            
        </div>
            
            
        
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
        
        
                
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#notificationLink").click(function(){
                    $("#notificationContainer").fadeToggle(300);
                    $("#notification_count").fadeOut("slow");
                    return false;
                });
 
                //Document Click hiding the popup 
                $(document).click(function(){
                    $("#notificationContainer").hide();
                });
 
                //Popup on click
                $("#notificationContainer").click(function(){
                    return false;
                });
 
            });
        </script>
        
    </body>
</html>