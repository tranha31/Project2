<?php 
session_start();    
?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
        <link rel="stylesheet" type="text/css" href="Feed.css">
    </head>
    
    
    
    <?php
    
        if(!isset($_SESSION['username'])){
            echo "<script>alert(\"You must login first\");</script>";
            echo "<script>window.location.assign(\"Home.php\");</script>";
        }
        
    ?>
    
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
                <div>
                    <input type="text" name="Search" id="search_1">
                    <button style="border:none; background:none;" type="submit" id="search_2"><img src="../Picture/find.png"></button>
                </div>
                
                
            </form>
            <?php 
                $conn = mysqli_connect("localhost", "root","", "picture_social");
                $u = $_SESSION['username'];
                $sql = "select * from avatar where id_user ='".$u."'";
                $result = mysqli_query($conn, $sql, null);
                $u1 = mysqli_fetch_assoc($result);
            ?>
            <form class="post" method="post" action="ValidPost.php" enctype="multipart/form-data">
                    <div class="up_nf" style="display: flex">
                    <a class="my_profile" href="user.php">
                        <?php echo "<img id = \"profile_2\" src = ".$u1["link"].">"; ?>
                    </a>
                    <textarea name="caption" rows="50" cols="50" style="resize: none"></textarea>
                    <input class="choose_pic" id="choose_p" type="file" onchange="return fileValidation()" name="image">
                    <div id="pic_1">
                    </div>
                
                    <a id="remove" onclick="Remove_p()" href="#">Remove</a>
                    <input id="submit" type="submit" name="submit" value="Post">
                </div>
            </form>
            
            
                <?php 
                    $sql = "select * from post where id_user = '$u' and publish_time >= (CURRENT_DATE()-30) order by publish_time desc";
                    $result = mysqli_query($conn, $sql, null);
                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $sql = "select * from picture where id_post=".$row["id"];
                            $result1 = mysqli_query($conn, $sql, null);
                            $row2 = mysqli_fetch_assoc($result1);
                            
                            $sql = "select * from avatar where id_user = '".$u."'";
                            $result1 = mysqli_query($conn, $sql, null);
                            $row3 = mysqli_fetch_assoc($result1);
                            
                            ?>
                           
                            <div id="picture" class="picture">
                                <img class="picture_1" src="<?php echo $row2['link']; ?>">
                            </div>
                
                            <div class="content">
                                <div class="caption_1">
                                    <ul style="list-style-type: none">
                                        <li style="display: flex;">
                                            <div id="cap_1" class="cap_1">
                                                <p><?php echo $row['caption']; ?></p>
                                            </div>
                                                            
                                            <div id="cap_2" class="cap_2">
                                                <a id="user_1" class="user_1" href="<?php echo "user.php";?>"><img class="ava ava_user" id="ava_user" src="<?php echo $row3['link']; ?>"></a>
                                            </div>
                                        </li>
                            
                                        <li style="display: flex">
                                            <div id="cap_3" class="cap_3" style="display: flex;">
                                                <a id="vote" class="vote" href="#"><img id="vote_1" class="vote_1" src="../Picture/vote.png"></a>
                                                <p id="count_vote" class="count_vote"><?php echo $row['vote']; ?></p>
                                            </div>
                            
                                            <div id="cap_4" class="cap_4">
                                                            
                                                <a id="cmt" class="cmt" href="<?php echo "Featured_photo.php?id=".$row['id']; ?>">Comments</a>
                                            </div>
                                        </li>
                                    </ul>
                        
                                </div>
                    
                            </div>
                            <?php
                            
                        }
                    }
                    
                
                    $sql = "select * from follow where id_follow = '".$u."'";
                    $result = mysqli_query($conn, $sql, null);
               
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $u1 = $row["id_followed"];
                            $sql = "select * from post where id_user = '".$u1."' and publish_time >= (CURRENT_DATE()-30) order by publish_time desc";
                            $result = mysqli_query($conn, $sql, null);
                            if(mysqli_num_rows($result) > 0){
                                while($row1 = mysqli_fetch_assoc($result)){
                                    $sql = "select * from picture where id_post=".$row1["id"];
                                    $result1 = mysqli_query($conn, $sql, null);
                                    $row2 = mysqli_fetch_assoc($result1);
                                    
                                    $sql = "select * from avatar where id_user = '".$u1."'";
                                    $result2 = mysqli_query($conn, $sql, null);
                                    $row3 = mysqli_fetch_assoc($result2);
                                    
                                    ?>
                                        <div id="picture" class="picture">
                                            <img class="picture_1" src="<?php echo $row2['link']; ?>">
                                        </div>
                
                                        <div class="content">
                                            <div class="caption_1">
                                                <ul style="list-style-type: none">
                                                    <li style="display: flex;">
                                                        <div id="cap_1" class="cap_1">
                                                            <p><?php echo $row1['caption']; ?></p>
                                                        </div>
                                                            
                                                        <div id="cap_2" class="cap_2">
                                                            <a id="user_1" class="user_1" href="<?php echo "user_1.php?&user=".$u1; ?>"><img class="ava ava_user" id="ava_user" src="<?php echo $row3['link']; ?>"></a>
                                                        </div>
                                                    </li>
                            
                                                    <li style="display: flex">
                                                        <div id="cap_3" class="cap_3" style="display: flex;">
                                                            <a id="vote" class="vote" href="#"><img id="vote_1" class="vote_1" src="../Picture/vote.png"></a>
                                                            <p id="count_vote" class="count_vote"><?php echo $row1['vote']; ?></p>
                                                        </div>
                            
                                                        <div id="cap_4" class="cap_4">
                                                            
                                                            <a id="cmt" class="cmt" href="<?php echo "Featured_photo.php?id=".$row1['id']; ?>">Comments</a>
                                                        </div>
                                                    </li>
                                                </ul>
                        
                                            </div>
                    
                                    </div>
                                <?php
                                }
                                
                            }
                        }
                    
                    }
                ?>
                
                
    
            
            
        </div>
            
        
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
        
        <script>
            function fileValidation(){
                var fileInput = document.getElementById("choose_p");
                var filePath = fileInput.value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if(!allowedExtensions.exec(filePath)){
                    alert("Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.");
                    fileInput.value = "";
                    return false;
                }
                else{
                    if(fileInput.files && fileInput.files[0]){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            document.getElementById("pic_1").style.display = "flex";
                            document.getElementById("pic_1").innerHTML = '<img  src="'+e.target.result+'"/>';
                            document.getElementById("remove").style.display = "flex";
                            document.getElementById("choose_p").style.display = "none";
                            document.getElementById("submit").style.display = "flex";
                        }; 
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            } 
            
        </script>
                
        <script>
            function Remove_p(){
                var obj1 = document.getElementById("choose_p");
                var obj2 = document.getElementById("remove");
                var obj3 = document.getElementById("pic_1");
                var obj4 = document.getElementById("submit");
                
                obj1.value = "";
                
                obj1.style.display = "flex";
                obj2.style.display = "none";
                obj3.style.display = "none";
                obj4.style.display = "none";
                
                
                
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
         
        
    </body>
</html>