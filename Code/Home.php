<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        
    </head>

    <body>
        <?php 
            $conn = mysqli_connect("localhost", "root","", "picture_social");
        ?>
        
        
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
                            <div id="notificationsBody" class="notifications">
                            </div>
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
        
        <div class="main">
            <div class="image">
                <div class="image_1" id="image_1">
                    <input type="file" name="input_p" id="file" onchange="return fileValidation()">
                </div>
                <div class="image_2">
                    
                </div>
            </div>
            
            <div class="button">
                <div class="select_b">
                    <button class="button_1" id="start" onclick="">Start</button>
                    <select style="text-align: center">
                        <option value="Medium" class="button_1">Medium</option>
                        <option value="High" class="button_2">High</option>
                    </select>
                    
                </div>
                <div class="download_b">
                    <button class="button_1" id="download" onclick="">Download</button>
                    <button class="button_1" id="share">Share</button>
                </div>
            </div>
            
            <div class="feature">
                <div class="feature_t">
                    <h3>Feature Photos</h3>
                </div>
                <div class="feature_img">
                    <?php 
                        if(!$conn){
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        else{
                            $sql = "Select * from post Order by vote desc limit 5";
                            $result = mysqli_query($conn, $sql, null);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_post = $row["id"];
                                    $sql_1 = "select * from picture where id_post = ".$id_post;
                                    $result_1 = mysqli_query($conn, $sql_1, null);
                                    $row_1 = mysqli_fetch_assoc($result_1);
                                    $link = $row_1["link"];
                                    echo "<a href='Featured_photo.php?id=".$id_post."' class = \"feature_image\"><img src =".$link."></a>";
                                        
                                    
                                }
                            }
                        }
                    ?>
                    
                </div>
                
            </div>
        </div>
        
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
        </div>
        
        <script>
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
                            document.getElementById("image_1").innerHTML = '<img  src="'+e.target.result+'"/>';
                        }; 
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
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