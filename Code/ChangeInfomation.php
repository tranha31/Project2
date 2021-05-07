<?php session_start(); ?>
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
                
                if($_POST['password'] == null){
                    echo "<script>alert(\"Please enter your password\");</script>";
                }
                else{
                    $p = $_POST['password'];
                }
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
                
                $conn = mysqli_connect("localhost", "root","", "picture_social");
                
                $sql = "update users set password = '$p', name = '$n' where username='$u'";
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
                    <li id="notification_li">
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
          <div class="container">
           
               <div class="register-form">
                   <form action="signup.php" method="post">
                       <h1>Change information</h1>
                       <div class="input-box">

                           <input type="text" name="username" placeholder="<?php echo $_SESSION['username']; ?>" readonly="readonly">
                       </div>
                       <div class="input-box">

                           <input type="password" name="password" placeholder="Password">
                       </div>
                       <div class="input-box">

                           <input type="text" name="name" placeholder="Account name">
                       </div>
                       <div class="input-box">
                           <div class="col-6">
                               <label for="ngaysinh">Date of birth</label>
                               <br>
                               <input type="date" name="date_of_birth" id="ngaysinh"/>
                           </div>
                           <div class="col-6">
                               <label for="gioitinh">Gender</label>
                               <br>
                               <select id="gioitinh" name="sex">
                                   <option value="Nam">Male</option>
                                   <option value="Nữ">Female</option>
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
</html>
