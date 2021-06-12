
<?php session_start(); ?>

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
            if(isset($_GET['a'])){
                session_destroy();
            }
        ?>
        
        
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
            <div class="image">
                <div class="image_1" id="image_1">
                    <input type="file" name="input_p" id="file" onchange="return fileValidation()">
                </div>
                <div id="image_2" class="image_2">
                    
                </div>
            </div>
            
            <div class="button">
                <div class="select_b">
                    <button class="button_1" id="start" onclick="Start()">Start</button>
                    <button class="button_1" onclick="Remove()">Cancel</button>
<!--
                    <select style="text-align: center">
                        <option value="Medium" class="button_1">Medium</option>
                        <option value="High" class="button_2">High</option>
                    </select>
-->
                    
                </div>
                <div class="download_b">
                    <button class="button_1" id="download">Download</button>
                    
                    
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
                //console.log(filePath);
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                var image1 = /\.jpg$/i;
                var image2 = /\.jpeg$/i;
                var image3 = /\.png$/i;
                if(!allowedExtensions.exec(filePath)){
                    alert("Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.");
                    fileInput.value = "";
                    return false;
                }
                else{
                    if(fileInput.files && fileInput.files[0]){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            document.getElementById("image_1").innerHTML = '<img id="picture" src="'+e.target.result+'"/>';
                            
                        }; 
                        //reader.readAsBinaryString(fileInput.files[0]);
                        reader.readAsDataURL(fileInput.files[0]);
                        
                        if(image1.exec(filePath)){
                            console.log("jpg");
                            <?php $no = 23; ?>
                        }
                        else if(image2.exec(filePath)){
                            console.log("jpeg");
                            <?php $no = 23; ?>
                        }
                        else if(image3.exec(filePath)){
                            console.log("png");
                            <?php $no = 22; ?>
                        }
                    }
                }
            }
            
            
            
        </script>
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
        
<script>
    async function Start(){
        if(document.getElementById("picture")){
            alert("Please wait from 1 to 5 minutes!!");
            let imgs = document.getElementById("picture").src;
            //console.log("aaaa");
            //console.log(imgs);
            //console.log(document.getElementById("picture"));
            //console.log(base64ToArrayBuffer(imgs.slice(23)));
            let proxyUrl = "https://cors-anywhere.herokuapp.com/";
            let url = "http://localhost:5000/api/test";
            let req = new Request(url,{
                method : "POST",
//                body: JSON.stringify({
//                    //data: base64ToArrayBuffer(imgs.slice(23))
//                    data: imgs.slice(23)
//                }),
                body: imgs.slice(<?php echo $no;?>),
                headers:{
//                   "Access-Control-Allow-Origin": "http://localhost:5000/api/test",
//                    "Access-Control-Allow-Credentials" : "true",
                    "Content-type":"image/jpeg"
                    
                }
            });
            fetch(req)
                .then(function(response){
                    if(response.status != 200){
                        console.log("errorrr");
                        console.log(response.status);
                        return;
                    }
                response.json().then(function(data){
                    //console.log(data['image']);
                    var srcc = "data:image/png;base64,"
                    srcc = srcc+data['image'];
                    
                    document.getElementById("image_2").innerHTML = '<img id="picture2" src="'+srcc+'"/>';
                    document.getElementById("download").style.display = "flex";
           
                    
                });
            })
            
                
            /*fetch("http://192.168.1.10:5000/api/test", {
                method : "POST",
                //body : base64ToArrayBuffer(imgs.slice(23))
                /*body: JSON.stringify({
                    data: base64ToArrayBuffer(imgs.slice(23))
                }),*/
               /* headers:{
                    "Content-type":"image/jpeg"
                }
            })   
                .then(function(response){
                if(response.ok){
                    console.log("called api sucess");
                }else{
                    console.log("errorrrrrr");
                }
            })*/
            
//            document.getElementById("image_2").innerHTML = '<img id="picture2" src="'+imgs+'"/>';
//            document.getElementById("download").style.display = "flex";
           
        }
    }
    
    function base64ToArrayBuffer(base64) {
        var binary_string = window.atob(base64);
        var len = binary_string.length;
        var bytes = new Uint8Array(len);
        var BS = "";
        var f = "00000000";
        for (var i = 0; i < len; i++) {
            bytes[i] = binary_string.charCodeAt(i);
            var x = f + bytes[i].toString(2);
            //BS = BS + bytes[i].toString(2);
            BS = BS + x.slice(-8);
        }
        //console.log(BS);
        //return bytes;
        //return BS;
        return binary_string;
        
    }
    
    function Remove(){
        if(document.getElementById("picture")){
            let div2 = document.getElementById("image_2");
            let img = document.getElementById("picture2");
            div2.removeChild(img);
            div2.innerHTML = "";
            document.getElementById("download").style.display = "none";
            
            document.getElementById("image_1").removeChild(document.getElementById("picture"));
            document.getElementById("image_1").innerHTML = "<input type=\"file\" name=\"input_p\" id=\"file\" onchange=\"return fileValidation()\">";
        }
        
    }
</script>
<script src="js/FileSaver.min.js"></script>
<script>
    let btnDownload = document.getElementById("download");
    
    btnDownload.addEventListener('click', () =>{
        let img = document.getElementById("picture2");
        let imgPath = img.getAttribute('src');
        let fileName = getFileName(imgPath);
        saveAs(imgPath, fileName);
    });
    
    function getFileName(str){
        return str.substring(str.lastIndexOf('/')+1);
    }
</script>
    </body>
</html>