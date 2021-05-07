<?php session_start(); ?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link rel="stylesheet" type="text/css" href="user.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
        <link rel="stylesheet" type="text/css" href="Feed.css">
    </head>

    <?php 
        if(isset($_SESSION['username'])){
            
        }
        else{
            echo "<script>alert(\"You must login first\");</script>"; 
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

        <main>
            <?php 
                $conn = mysqli_connect("localhost", "root","", "picture_social");
                $u = $_SESSION['username'];
                $sql = "select * from users where username = '".$u."'";
                $result = mysqli_query($conn, $sql, null);
                $row = mysqli_fetch_assoc($result);
                
                $sql = "select * from avatar where id_user='$u'";
                
                $result = mysqli_query($conn, $sql, null);
                $row1 = mysqli_fetch_assoc($result);
            
                $sql = "select * from info where id_user='$u'";
           
                $result = mysqli_query($conn, $sql, null);
                $row2 = mysqli_fetch_assoc($result);
                
                if($row2['hobby'] != null){
                    $hobby = $row2['hobby'];
                }
                else{
                    $hobby = "";
                }
            
                if($row2['info_introduce'] != null){
                    $info = $row2['info_introduce'] ;
                }
                else{
                    $info = "";
                }
                
            ?>
          <div class="userbox">
              <div class="vertical_line"></div>
              <div class="box_right">
                  <button class="button" onclick="">Change Information</button>
                  <p>Date of birth: <?php echo $row2['date_of_birth']; ?></p>
                  <h4>Hobbies:</h4>
                  <?php
                  if($hobby != ""){
                      $h = explode('@', $hobby);
                      foreach($h as $k => $v){
                          echo "<p>$v</p>";
                      }
                  }
                  ?>
                  <h4>Introduce</h4>
                  <?php
                  if($info != ""){
                      echo "<p>$info</p>";
                  }
                  ?>
              </div>
              <div class="box_left">
                  <h1 class="avatar_name"><?php echo $row['name']; ?></h1>
                  <img src="<?php echo $row1['link']; ?>" class="avatar">
              </div>
              <button class="button_logout" onclick="Logout()">Log out</button>
              
           </div>
            
            <hr>
         <!--   <div class="all_p" >
            
            
            <?php 
            $sql = "select * from post where id_user = '$u' order by publish_time desc";
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
                    <div class="picture">       
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
                </div>    
                    <?php
                            
                    }
                }
                    
            
            ?>
            </div>-->
        </main>

        
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
            
            function Logout(){
                window.location.assign("Home.php?a=0");
            }
        </script>
    </body>
</html>
