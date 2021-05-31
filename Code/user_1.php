<?php 
session_start(); 
$conn = mysqli_connect("localhost", "root","", "picture_social");
if(!isset($_SESSION['username'])){
    ?>
    <script>
        alert("You must login first");
        window.location.assign("login.php");
    </script>
    <?php
}
if(isset($_GET['no'])){
    $idno = $_GET['no'];
    $sql = "update nofitication set status = 1 where id = $idno";
    mysqli_query($conn, $sql, null);
}
?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="user.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
        <link rel="stylesheet" type="text/css" href="Feed.css">
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
                    <?php
                    if(isset($_SESSION['username'])){
                        $user = $_SESSION['username'];
                        $sql = "select * from avatar where id_user = '$user'";
                        $result = mysqli_query($conn, $sql, null);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                    <li>
                        <a class="user" href="user.php">
                            <img src="<?php echo $row['link']?>" class="icon_h">
                        </a>
                    </li>
                        <?php
                    }
                    ?>
                    <li id="notification_li">
                        <span id="notification_count">0</span>
                        <div class="bell" id="notificationLink" onclick="Notification()">
                            <img src="../Picture/bell.png" class="icon_h" id="icon_h">
                        </div>
                        <div id="notificationContainer">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" class="notifications">
                                <div id="no_content">
                                </div>
                            </div>
                            <div id="notificationFooter"><a href="#" onclick="Close()">Close</a></div>
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
                </ul>
            </div>

        </div>
        <?php
            if(isset($_GET['user'])){
                $ur = $_GET['user'];
            }
            else{
                echo "<script>alert(\"Error!!!!\")</script>";
                echo "<script>window.location.assign(\"Home.php\")</script>";
            }
            
            $conn = mysqli_connect("localhost", "root","", "picture_social");
            if(isset($_SESSION['username'])){
                $u = $_SESSION['username'];
            }
            else{
                $u = "";
            }
            
        
            $sql = "select * from avatar where id_user ='".$ur."'";
            $result = mysqli_query($conn, $sql, null);
            $row = mysqli_fetch_assoc($result);
        
            $sql = "select * from users where username ='".$ur."'";
            $result = mysqli_query($conn, $sql, null);
            $row1 = mysqli_fetch_assoc($result);
        
            $sql = "select * from info where id_user ='".$ur."'";
            $result = mysqli_query($conn, $sql, null);
            $row3 = mysqli_fetch_assoc($result);
            
            if($row3['hobby'] != null){
                $hobby = $row3['hobby'];
            }
            else{
                $hobby = "";
            }
            
            if($row3['info_introduce'] != null){
                $info = $row3['info_introduce'] ;
                $info = html_entity_decode($info);
            }
            else{
                $info = "";
            }
        ?>
        <div class="main">
          <div class="userbox">
              
              <div class="box_left">
                  <img src="<?php echo $row['link']; ?>" class="avatar">
                  <h1 class="avatar_name"><?php echo $row1['name']; ?></h1>
                  <a class="save" href="ValidFollow.php?user=<?php echo $ur;?>">
                  <img src="../Picture/plus-4-128.png" class="icon_save">
              </a>
              </div>
              <div class="vertical_line"></div>
              <div class="box_right">
                  <div class="infor">
                  <h4>Date of birth: <?php echo $row3['date_of_birth']; ?></h4>
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
                       echo "<pre id=\"introduce\">$info</pre>";
                  }
                  ?>
                  </div>
              </div>
              
           </div>
            <hr>
            
            
            <?php 
            $sql = "select * from post where id_user = '$ur' order by publish_time desc";
            $result = mysqli_query($conn, $sql, null);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql = "select * from picture where id_post=".$row["id"];
                    $result1 = mysqli_query($conn, $sql, null);
                    $row2 = mysqli_fetch_assoc($result1);
                            
                    $sql = "select * from avatar where id_user = '".$ur."'";
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
                    
            
            ?>
    
        </div>

        

        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            function Notification(){
                document.getElementById("notificationContainer").style.display="flex";
                document.getElementById("notificationContainer").style.flexDirection = "column";
            }
            function Close(){
                document.getElementById("notificationContainer").style.display="none";
            }
            function getXMLHttpRequest()

        {
            var request, err;
            try {
                request = new XMLHttpRequest(); 
            }
            catch(err) {
                try { // first attempt for Internet Explorer
                    request = new ActiveXObject("MSXML2.XMLHttp.6.0");
                }
                catch (err) {

                    try { // second attempt for Internet Explorer
                        request = new ActiveXObject("MSXML2.XMLHttp.3.0");
                    }
                    catch (err) {
                        request = false; // oops, can’t create one!
                    }
                }
            }
            return request;
        }
        </script>
        
<?php include("notification.php"); ?>
    </body>
</html>
