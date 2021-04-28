<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link rel="stylesheet" type="text/css" href="user.css">
    </head>

    <?php 
        if(isset($_GET['username'])){
            
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
                        <a class="home" href="#">
                            <img src="../Picture/home.png" class="icon_h">
                        </a>
                    </li>
                    <li>
                        <a class="feed" href="">
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
                        <a class="login" href="">
                            <img src="../Picture/login.png" class="icon_h">
                        </a>
                    </li>
                    <li>
                        <a class="register" href="">
                            <img src="../Picture/register.png" class="icon_h">
                        </a>
                    </li>
                    <li>
                        <a href="#" id="user" style="color: white;" class="icon_h">aaa</a>
                    </li>
                    <li>
                        <a class="user" href="">
                            <img src="../Picture/tk.png" class="icon_h">
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <main>
          <a class="login" href="">
              <img src="../Picture/back.png" class="icon_back">
          </a>
          <div class="userbox">
              <div class="vertical_line"></div>
              <div class="box_right">
                  <button class="button" onclick="">Change Avatar</button>
                  <button class="button" onclick="">Change Name</button>
                  <button class="button" onclick="">Change Username</button>
                  <button class="button" onclick="">Change Password</button>
              </div>
              <div class="box_left">
                  <h1 class="avatar_name">Taha</h1>
                  <img src="../Picture/avatar_user.png" class="avatar">
              </div>
              <button class="button_logout" onclick="">Log out</button>
              <a class="save" href="">
                  <img src="../Picture/save.png" class="icon_save">
              </a>
           </div>
        </main>

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
