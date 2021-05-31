<?php session_start();
$conn = mysqli_connect("localhost", "root","", "picture_social");
?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type ="text/css" href="signup.css">
        
        <?php
            if(isset($_POST['submit'])){
                $u =$_SESSION['username'];
                
                if($_POST['name'] == null){
                    echo "<script>alert(\"Please enter your name\");</script>";
                }
                else{
                    $n = $_POST['name'];
                }
                if($_POST['date_of_birth'] == null){
                    echo "<script>alert(\"Please choose your date of birth\");</script>";
                }
                else{
                    $dob = $_POST['date_of_birth'];
                }
                
                $sex = $_POST['sex'];
                
                if(isset($_POST['xemphim'])){
                    $xp = "Xem phim";
                    //$xp = "";
                }
                else{
                    $xp = "";
                }
                if(isset($_POST['nghenhac'])){
                    $nn = "Nghe nhạc";
                    //$nn = "";
                }
                else{
                    $nn = "";
                  
                }
                if(isset($_POST['docsach'])){
                    $ds = "Đọc sách";
                    //$ds = "";
                }
                else{
                    $ds = "";
                
                }
                $st = "".$xp."@".$nn."@".$ds;
                
                $gt = $_POST['gioithieu'];
                
                if($gt != ""){
                    $gt = addslashes($gt);
                    $gt = htmlspecialchars(htmlentities($gt));
                }
                $sql = "update users set name = '$n' where username='$u'";
                $result = mysqli_query($conn, $sql, null);
                
                $sql = "update info set date_of_birth = '$dob', sex = '$sex', hobby = '$st', info_introduce='$gt' where id_user='$u'";
                $result = mysqli_query($conn, $sql, null);
                
                echo "<script>window.location.assign(\"user.php\")</script>";
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

        <main>
          <div class="container">
              <?php
                $us = $_SESSION['username'];
                $sql = "select * from users where username = '$us'";
                $result = mysqli_query($conn, $sql, null);
                $row = mysqli_fetch_assoc($result);
              
                $sql = "select * from info where id_user = '$us'";
                $result1 = mysqli_query($conn, $sql, null);
                $row1 = mysqli_fetch_assoc($result1);
              
              ?>
           
               <div class="register-form">
                   <form action="ChangeInfomation.php" method="post">
                       <h1>Change information</h1>
                       <div class="input-box">

                           <input type="text" name="username" placeholder="<?php echo $_SESSION['username']; ?>" readonly="readonly">
                       </div>
                       <div class="input-box">

                           <input type="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" readonly="readonly">
                       </div>
                       <div class="input-box">

                           <input type="text" name="name" placeholder="Account name" value="<?php echo $row['name']; ?>">
                       </div>
                       <div class="input-box">
                           <div class="col-6">
                               <label for="ngaysinh">Date of birth</label>
                               <br>
                               <input type="date" name="date_of_birth" id="ngaysinh"/ value="<?php echo $row1['date_of_birth']; ?>" >
                           </div>
                           <div class="col-6">
                               <label for="gioitinh">Gender</label>
                               <br>
                               <select id="gioitinh" name="sex">
                                   <?php
                                   
                                   if($row1['sex'] == "Nữ"){
                                       ?>
                                   <option value="Nam">Male</option>
                                   <option value="Nữ" seleted>Female</option>
                                        <?php
                                   }
                                   else{
                                       ?>
                                   <option value="Nam" selected>Male</option>
                                   <option value="Nữ">Female</option>
                                        <?php
                                   }
                                   ?>
                                   
                               </select>
                           </div>
                           <div class="clear"></div>
                       </div>
                       <div class="input-box">
                           <span>Hobbies</span>
                           <br>
                           <input type="checkbox" name="xemphim" id="xemphim">
                           <label for="xemphim">Watch movies</label>
                           <div class="margin_b"></div>
                           <input type="checkbox" id="nghenhac" name="nghenhac">
                           <label for="nghenhac">Listen musics</label>
                           <div class="margin_b"></div>
                           <input type="checkbox" id="docsach" name="docsach">
                           <label for="docsach">Read books</label>
                       </div>
                       <div class="input-box">
                           <label for="gioithieu">Introduce yourself</label>
                           <br>
                           <textarea cols="1000" rows="1000" name="gioithieu" id="gioithieu" style="resize:none; height:10vh;"></textarea>
                       </div>

                       <div class="btn-box">
                           <input type="submit" name="submit" value="Submit">
                       </div>
                   </form>
               </div>
           </div>
        </main>

        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
    </body>
    
<script>
        var textareas = document.getElementsByTagName('textarea');
        var count = textareas.length;
        for(var i=0;i<count;i++){
            textareas[i].onkeydown = function(e){
                if(e.keyCode==9 || e.which==9){
                    e.preventDefault();
                    var s = this.selectionStart;
                    this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
                    this.selectionEnd = s+1; 
                }
            }
        }
    
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
</html>
