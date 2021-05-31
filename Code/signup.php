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
                if($_POST['name'] == null){
                    echo "<script>alert(\"Please enter your name\");</script>";
                }
                else{
                    $n = $_POST['name'];
                }
                if(isset($_POST['email'])){
                    $em = $_POST['email'];
                }
                else{
                    echo "<script>alert(\"Please enter your email\");</script>";
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
                if($u && $p){
                    $conn = mysqli_connect("localhost", "root","", "picture_social");
                    $sql = "select * from users where username = '".$u."'";
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result) > 0){
                        echo "<script>alert(\"Username is used, please try again\");</script>"; 
                    }
                    else{
                        $sql = "select * from users where email = '$em'";
                        $result = mysqli_query($conn, $sql, null);
                        if(mysqli_num_rows($result) > 0){
                            echo "<script>alert(\"Email was register!\");</script>";
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
                                $sql = "insert into users values ('".$u."','".$p."','".$n."',"."0, 0, '$em', '$verificationCode', 0)";
                                mysqli_query($conn, $sql, null);
                                
                                $sql = "insert into info(id_user, date_of_birth, sex, hobby, info_introduce) values('".$u."','".$dob."','".$sex."','".$st."','".$gt."')";
                                $result = mysqli_query($conn, $sql, null);
                                
                                $sql = "insert into avatar(id_user, link) values ('$u', '../Avatar/account.jpg')";
                                mysqli_query($conn, $sql, null);
                                
                                echo "<script>alert(\"Please check your email to verified account!\");window.location.assign(\"login.php\");</script>";
                            }
                            else{
                                die("Sending failed.");
                                echo "<script>window.location.assign(\"signup.php\");</script>";
                            }
                        }
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

        <main>
          <div class="container">
           
               <div class="register-form">
                   <form action="signup.php" method="post">
                       <h1>Register a new account</h1>
                       <div class="input-box">

                           <input type="text" name="username" placeholder="Username">
                       </div>
                       <div class="input-box">

                           <input type="password" name="password" placeholder="Password">
                       </div>
                       <div class="input-box">

                           <input type="text" name="name" placeholder="Account name">
                       </div>
                       <div class="input-box">

                           <input type="text" name="email" placeholder="Email">
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
                           <input type="submit" name="submit" value="Register">
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
</script>   
</html>
