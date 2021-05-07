<!doctype html>
<?php 
session_start();    
?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
    </head>

    <body>
        
        <?php 
    
            if(isset($_GET["id"])){
                $id_post = $_GET["id"];
            }
            $conn = mysqli_connect("localhost", "root","", "picture_social");
            $sql = "select * from post where id = ".$id_post;
            $result = mysqli_query($conn, $sql, null);
            $row = mysqli_fetch_assoc($result);
            
            $sql = "select * from picture where id = ".$id_post;
            $result = mysqli_query($conn, $sql, null);
            $row_1 = mysqli_fetch_assoc($result);
            
            $username = $row["id_user"];
        
            $sql = "select * from users where username = '".$username."'";
            $result = mysqli_query($conn, $sql, null);
            $row_2 = mysqli_fetch_assoc($result);
        
            $sql = "select * from avatar where id_user = '".$username."'";
            $result = mysqli_query($conn, $sql, null);
            $row_3 = mysqli_fetch_assoc($result);
        
            
        ?>
        
        
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
            
            
            <div class="main_1">
                <div id="picture" class="picture">
                    <?php 
                        echo "<img id=\"picture_1\" class = \"picture_1\" src = ".$row_1["link"].">"; 
                    
                    ?>
                </div>
                
                 <div class="content">
                    <div class="caption_1">
                        <ul style="list-style-type: none">
                            <li style="display: flex;">
                                <div id="cap_1" class="cap_1">
                                    <?php 
                                        echo "<p>".$row["caption"]."</p>";
                                    ?>
                                    
                                </div>
                            
                                <div id="cap_2" class="cap_2">
                                    
                                    <?php 
                                        echo "<a class=\"user_1\" href=\"#\"><img class =\"ava ava_user\" id=\"ava_user\" src=".$row_3["link"]."></a>";
                                    ?>
                                    
                                </div>
                            </li>
                            
                            <li style="display: flex">
                                <div id="cap_3" class="cap_3" style="display: flex;">
                                    
                                    <a id="vote" class="vote" href="#"><img id="vote_1" class="vote_1" src="../Picture/vote.png"></a>
                                    
                                    <?php 
                                        echo "<p id=\"count_vote\" class = \"count_vote\">".$row["vote"]."</p>";
                                    ?>
                                </div>
                            
                                
                            </li>
                        </ul>
                        
                    </div>
                    
                    <div id="comment" class="comment">
                        <?php 
                        if(isset($_SESSION['username'])){
                            $conn = mysqli_connect("localhost", "root","", "picture_social");
                            $sql = "select * from avatar where id_user ='".$_SESSION['username']."'";
                            
                            $result = mysqli_query($conn, $sql, null);
                            $u1 = mysqli_fetch_assoc($result);
                            
                            ?>
                            <div id="my_cmt" class="my_cmt">
                                <a href="#" class="my_profile">
                                    <?php echo "<img class = \"ava\" src =\"".$u1["link"]."\">"; ?>
                                </a>
                            
                                <form method="post" action="ValidCmt.php?id=<?php echo $id_post; ?>" style="display:flex; width:100%;">
                                    <input id="my_cmt_1" class="my_cmt_1" type="text" name="comment">
                            
                                    <button id="my_submit" class="my_submit"   onclick="">Send</button>
                                </form>
                            
                            </div>
                            <?php
                        }
                        ?>
                        
                        
                        <div id="all_cmt" class="all_cmt">
                            <ul id="a_cmt" class="a_cmt" style="list-style-type: none">
                                <?php 
                                    $sql = "select * from comment where id_post = ".$id_post." order by publish desc";
                                    $result = mysqli_query($conn, $sql, null);
                                    while($row_4 = mysqli_fetch_assoc($result)){
                                        $sql_1 = "select * from avatar where id_user = '".$row_4["id_user"]."'";
                                        $result_1 = mysqli_query($conn, $sql_1, null);
                                        $row_5 = mysqli_fetch_assoc($result_1);
                                        
                                        echo "<li class=\"all_cmts\">";
                                        echo "<a class=\"proflie_user_1\" href=\"#\"><img class=\"ava\" src=".$row_5["link"]."></a>";
                                        echo "<div class=\"cmt_user\">";
                                        echo "<p>".$row_4["content"]."</p>";
                                        echo "</div>";
                                        echo "</li>";
                                    }
                                    
                                ?>
                                
                                
                            </ul>
                        </div>
                        
                    </div>
                    
                    
                    
                </div>
            </div>
            
            
        
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
        
        <script>
            function Display(){
                
                document.getElementById("comment").style.display = "flex";
                //document.getElementById("comment").style. = "flex";
            }    
            function Hiden(){
                document.getElementById("comment").style.display = "none";
            }
        </script>
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
        </div>
    </body>
</html>