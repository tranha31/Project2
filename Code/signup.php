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
                
                if($u && $p){
                    $conn = mysqli_connect("localhost", "root","", "picture_social");
                    $sql = "select * from users where username = '".$u."'";
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result) > 0){
                        echo "<script>alert(\"Username is used, please try again\");</script>"; 
                    }
                    else{
                        $sql = "insert into users values ('".$u."','".$p."','".$n."',"."0, 0)";
                        //echo $sql;
                        $result = mysqli_query($conn, $sql, null);
                        
                        $sql = "insert into info(id_user, date_of_birth, sex, hobby, info_introduce) values('".$u."','".$dob."','".$sex."','".$st."','".$gt."')";
                        //echo $sql;
                        $result = mysqli_query($conn, $sql, null);
                        
                        echo "<script>window.location.href=\"login.php\";</script>";
                        
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
          <div class="container">
           
               <div class="register-form">
                   <form action="signup.php" method="post">
                       <h1>Đăng ký tài khoản mới</h1>
                       <div class="input-box">

                           <input type="text" name="username" placeholder="Nhập username">
                       </div>
                       <div class="input-box">

                           <input type="password" name="password" placeholder="Nhập mật khẩu">
                       </div>
                       <div class="input-box">

                           <input type="text" name="name" placeholder="Nhập tên">
                       </div>
                       <div class="input-box">
                           <div class="col-6">
                               <label for="ngaysinh">Ngày sinh</label>
                               <br>
                               <input type="date" name="date_of_birth" id="ngaysinh"/>
                           </div>
                           <div class="col-6">
                               <label for="gioitinh">Giới tính</label>
                               <br>
                               <select id="gioitinh" name="sex">
                                   <option value="Nam">Nam</option>
                                   <option value="Nữ">Nữ</option>
                               </select>
                           </div>
                           <div class="clear"></div>
                       </div>
                       <div class="input-box">
                           <span>Sở thích</span>
                           <br>
                           <input type="checkbox" name="xemphim" id="xemphim">
                           <label for="xemphim">Xem phim</label>
                           <div class="margin_b"></div>
                           <input type="checkbox" id="nghenhac" name="nghenhac">
                           <label for="nghenhac">Nghe nhạc</label>
                           <div class="margin_b"></div>
                           <input type="checkbox" id="docsach" name="docsach">
                           <label for="docsach">Đọc sách</label>
                       </div>
                       <div class="input-box">
                           <label for="gioithieu">Giới thiệu bản thân</label>
                           <br>
                           <textarea cols="1000" rows="1000" name="gioithieu" id="gioithieu" style="resize:none; height:10vh;"></textarea>
                       </div>

                       <div class="btn-box">
                           <input type="submit" name="submit" value="Đăng ký">
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
