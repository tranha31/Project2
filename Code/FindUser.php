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
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
        <link rel="stylesheet" type="text/css" href="Feed.css">
        <link rel="stylesheet" type="text/css" href="FindUser.css">
        
        <?php 
        if(!isset($_SESSION['username'])){
            echo "<script>alert(\"You must login first\");</script>";
            echo "<script>window.location.assign(\"Home.php\");</script>";
        }
        if(empty($_POST['Search'])){
            
            echo "<script>alert(\"You must enter the name you want to find\");</script>";
            echo "<script>window.location.assign(\"Feed.php\");</script>";
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
        
        <div class="main" id="m">
            
            <form class="search" style="display: flex;" method="post" action="FindUser.php">
                <input type="text" name="Search" id="search_1" value="<?php echo $_POST['Search']; ?>" >
                <button style="border:none; background:none;" type="submit" id="search_2"><img src="../Picture/find.png"></button>
            </form>
            
            <div class = "all_find" id="a1">
                <?php 
                    $name = $_POST['Search'];
                    $find = explode(' ', $name);
                    foreach($find as $key => $value){
                        $conn = mysqli_connect("localhost", "root","", "picture_social");
                        $sql = "select * from users where name like'%".$value."%' and username != '".$_SESSION['username']."'";
                        
                        $result = mysqli_query($conn, $sql, null);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $s = "select * from avatar where id_user = '".$row['username']."'";
                                $result1 = mysqli_query($conn, $s, null);
                                $ava = mysqli_fetch_assoc($result1);
                                ?>
                                    <div class="users">
                                        <a href="user_1.php?user=<?php echo $row['username']?>" class="ava_user" id="user_1">
                                            <?php echo "<img id = \"profile_2\" src = ".$ava["link"].">"; ?>
                                        </a>
                                        <a href="user_1.php?user=<?php echo $row['username']?>" class="link_ava" id="link_a_1"><?php echo $row['name']; ?></a>
                                
                                    </div>  
                                <?php
                            }
                        }
                    }
                    
                ?>
                
                        
                  
            </div>
            
        </div>
            
            
        
        <div class="footer">
            <a href="#" id="aboutus" style="color: gray">About us</a>
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
            
        var t;
        function startSearch(){
            if(t) window.clearTimeout(t);
            t = window.setTimeout("liveSearch()", 200);
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
        
        function liveSearch()
        
        {
            ajaxRequest = getXMLHttpRequest();
            if (!ajaxRequest) alert("Request error!");
            var myURL = "SearchAjax.php";
            var query = document.getElementById("search_1").value;
            
            myURL = myURL + "?query=" + query;
            console.log(myURL);
            ajaxRequest.onreadystatechange = ajaxResponse;
            ajaxRequest.open("GET", myURL);
            ajaxRequest.send(null);
        }
        function ajaxResponse() 
        {
            
            
            if (ajaxRequest.readyState != 4) 
            { return; }
            else {
                if (ajaxRequest.status == 200) 
                {
                   
                    var i, n, li, t;
                    var div = document.getElementById("m");
                    var div1 = document.getElementById("a1");
                    
                    div.removeChild(div1); 
                    div1 = document.createElement("div");
                    div1.id="a1";
                    div1.className = "all_find";
                    
                    
                    console.log(ajaxRequest.responseXML);
                    names=ajaxRequest.responseXML.getElementsByTagName("name");
                    ids = ajaxRequest.responseXML.getElementsByTagName("id");
                    avas = ajaxRequest.responseXML.getElementsByTagName("ava");
                    for (i = 0; i < names.length; i++)
                    {
                        d = document.createElement("div");
                        d.className = "users";
                        
                        a = document.createElement("a");  
                        n = names[i].firstChild.nodeValue;
                        ID = ids[i].firstChild.nodeValue;
                        ava = avas[i].firstChild.nodeValue;
                        
                        link = "user_1.php?user="+ID;
                        a.setAttribute('href', link);
                        a.className = "ava_user";
                        a.id = "user_1";
                        img = document.createElement("img");
                        img.id = "profile_2";
                        img.setAttribute('src', ava);
                        a.appendChild(img);
                        
                        a2 = document.createElement("a");
                        a2.id = "link_a_1";
                        a2.className = "link_ava";
                        a2.setAttribute('href', link);
                        a2.innerHTML = n;
                        
                        
                        d.appendChild(a);
                        d.appendChild(a2);
                        div1.appendChild(d);
                    }
                    
                    div.appendChild(div1);
                    
                }
                else {
                    alert("Request failed: " + ajaxRequest.statusText);
                }
            }
        }
        
        var obj = document.getElementById("search_1");
        obj.onkeydown = startSearch;
        </script>
        
<?php include("notification.php"); ?>
    </body>
</html>