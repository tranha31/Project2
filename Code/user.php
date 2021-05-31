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
else{
    $u = $_SESSION['username'];
    if(isset($_POST['changeA'])){
        $img = $_FILES['image']['name'];
                
        $link = "../Avatar/".$img;
        if($img != ""){
            $sql = "update avatar set link = '$link' where id_user = '$u'";
            mysqli_query($conn, $sql, null);
            move_uploaded_file($_FILES['image']['tmp_name'], "../Avatar/$img");
        }
    }
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

        <div class="main">
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
                    $info = html_entity_decode($info);
                }
                else{
                    $info = "";
                }
            
                
            ?>
          <div class="userbox">
              <div class="box_left">
                  <div id="a1" class="avatar-box">
                    <img src="<?php echo $row1['link']; ?>" class="avatar" id="avatar1">
                    <h1 class="avatar_name"><?php echo $row['name']; ?></h1>
                  </div>
                  <div id="a2" class="avatar-box">
                        <form enctype="multipart/form-data" method="post" action="user.php">
                            <input type="file" name="image" id="file" onchange="return fileValidation()">
                            <div class="a">
                            <input type="submit" name="changeA" value="Save">
                            <button onclick="Cancel()">Cancel</button>
                            </div>
                            
                        </form>
                  </div>
                  <div class="b">
                  <button id="logout" class="button_logout" onclick="Logout()">Log out</button>
                  <button id="ava" class="button_logout" onclick="Avatar()">Avatar</button>
                  </div>
                  
              </div>
              <div class="vertical_line"></div>
              <div class="box_right">
                <div class="infor">
                      <h4>Date of birth: <?php echo $row2['date_of_birth']; ?></h4>
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
                <button class="button" onclick="Change()">Change Information</button>
              </div>
           </div>
            
            <hr>
            
            
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
            
            function Logout(){
                window.location.assign("Home.php?a=0");
            }
            function Change(){
                window.location.assign("ChangeInfomation.php");
            }
            
            function fileValidation(){
                var fileInput = document.getElementById("file");
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
                            document.getElementById("avatar1").src = e.target.result;
                        }; 
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
            function Cancel(){
                document.getElementById("avatar1").src = "<?php echo $row1['link'];?>";
                document.getElementById("a2").style.display = "none";
            }
            function Avatar(){
                document.getElementById("a2").style.display = "flex";
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
