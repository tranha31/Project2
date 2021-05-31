<!doctype html>
<?php 
session_start(); 
$conn = mysqli_connect("localhost", "root","", "picture_social");
if(isset($_GET['no'])){
    $idno = $_GET['no'];
    $sql = "update nofitication set status = 1 where id = $idno";
    mysqli_query($conn, $sql, null);
}
?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type ="text/css" href="header_footer.css">
        <link rel="stylesheet" type="text/css" href="featured_photo.css">
    </head>

    <body>
        
        <?php 
    
            if(isset($_GET["id"])){
                $id_post = $_GET["id"];
            }
            
            $sql = "select * from post where id = ".$id_post;
            $result = mysqli_query($conn, $sql, null);
            $row = mysqli_fetch_assoc($result);
            
            $sql = "select * from picture where id_post = ".$id_post;
            $result = mysqli_query($conn, $sql, null);
            $row_1 = mysqli_fetch_assoc($result);
            
            $username = $row["id_user"];
        
            $sql = "select * from users where username = '".$username."'";
            $result = mysqli_query($conn, $sql, null);
            $row_2 = mysqli_fetch_assoc($result);
        
            $sql = "select * from avatar where id_user = '".$username."'";
            $result = mysqli_query($conn, $sql, null);
            $row_3 = mysqli_fetch_assoc($result);
        
            if(isset($_POST['edit'])){
                $content = $_POST['content'];
                $idc = $_POST['idcmt'];
            }
            else{
                $content = "";
            }
            if(isset($_POST['delete'])){
                $idcmt = $_POST['idcmt1'];
                $sql = "delete from comment where id = $idcmt";
                mysqli_query($conn, $sql, null);
            }
            if(isset($_POST['editP'])){
                $caption = $_POST['content'];
            }
            else{
                $caption = "";
            }
            if(isset($_POST['delete'])){
                $idp = $_POST['idpost1'];
                $sql = "delete from comment where id_post = $idpost";
                mysqli_query($conn, $sql, null);
                $sql = "delete from comment where id_post = $idpost";
                mysqli_query($conn, $sql, null);
                $sql = "delete from post where id = $idpost";
                mysqli_query($conn, $sql, null);
                ?>
        <script>
            window.location.assign("Feed.php");
        </script>
                <?php
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
                        $rows = mysqli_fetch_assoc($result);
                        ?>
                    <li>
                        <a class="user" href="user.php">
                            <img src="<?php echo $rows['link']?>" class="icon_h">
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
            
                <div id="picture" class="picture">
                    <?php 
                        echo "<img id=\"picture_1\" class = \"picture_1\" src = ".$row_1["link"].">"; 
                    
                    ?>
                </div>
                
                 <div class="content">
                    <div class="caption_1">
                        <ul style="list-style-type: none">
                            <li style="display: flex;">
                                <div id="cap_1" class="cap_1">
                                    <?php 
                                        echo "<p>".$row["caption"]."</p>";
                                    ?>
                                    
                                </div>
                            
                                <div id="cap_2" class="cap_2">
                                    
                                    <?php
                                    if(isset($_SESSION['username'])){
                                        if($row_3['id_user'] != $_SESSION['username']){
                                            $ur = $row_3['id_user'];
                                            echo "<a class=\"user_1\" href=\"user_1.php?user=$ur\"><img class =\"ava ava_user\" id=\"ava_user\" src=".$row_3["link"]."></a>";
                                        }
                                        else{
                                            echo "<a class=\"user_1\" href=\"user.php?\"><img class =\"ava ava_user\" id=\"ava_user\" src=".$row_3["link"]."></a>";
                                            
                                            if($content == ""){
                                            ?>
                                    
                                    <form class="edit" method="post" action="Featured_photo.php?id=<?php echo $id_post;?>">
                                                    <input name="idpost" type="hidden" value="<?php echo $id_post;?>">
                                                    <input name="content" type="hidden" value="<?php echo $row["caption"];?>">
                                                    <input type="submit" value="Edit" name="editP">
                                                </form>
                                                
                                                <form class="edit" method="post" action="Featured_photo.php?id=<?php echo $id_post;?>">
                                                    <input name="idpost1" type="hidden" value="<?php echo $id_post;?>">
                                                    <input type="submit" value="Delete" name="deleteP">
                                                </form>
                                            <?php
                                        }
                                        }
                                    }
                                    else{
                                        echo "<a class=\"user_1\" href=\"#\"><img class =\"ava ava_user\" id=\"ava_user\" src=".$row_3["link"]."></a>";
                                    }
                                        
                                    ?>
                                    
                                </div>
                            </li>
                            
                            <li style="display: flex">
                                <div id="cap_3" class="cap_3" style="display: flex;">
                                    
                                    <a id="vote" class="vote" href="vote.php?id=<?php echo $id_post;?>&s=1"><img id="vote_1" class="vote_1" src="../Picture/vote.png"></a>
                                    
                                    <?php 
                                        echo "<p id=\"count_vote\" class = \"count_vote\">".$row["vote"]."</p>";
                                    ?>
                                </div>
                            
                                
                            </li>
                        </ul>
                        
                    </div>
                    
                    <div id="comment" class="comment">
                        <?php 
                        if(isset($_SESSION['username'])){
                            $conn = mysqli_connect("localhost", "root","", "picture_social");
                            $sql = "select * from avatar where id_user ='".$_SESSION['username']."'";
                            
                            $result = mysqli_query($conn, $sql, null);
                            $u1 = mysqli_fetch_assoc($result);
                            
                            if($caption != ""){
                                ?>
                        <div id="my_cmt" class="my_cmt">
                                <a href="user.php" class="my_profile">
                                    <?php echo "<img class = \"ava\" src =\"".$u1["link"]."\">"; ?>
                                </a>
                            
                                <form method="post" action="ValidCmt.php?id=<?php echo $id_post; ?>&p=1" style="display:flex; width:100%;">
                                    <input id="my_cmt_1" class="my_cmt_1" type="text" name="comment" value="<?php echo $caption; ?>">
                            
                                    <button id="my_submit" class="my_submit"   onclick="">Send</button>
                                </form>
                            
                        </div>
                        <div id="all_cmt" class="all_cmt">
                        </div>
                                <?php
                                
                            }
                            else{
                            
                            
                            if($content != ""){
                                ?>
                            <div id="my_cmt" class="my_cmt">
                                <a href="user.php" class="my_profile">
                                    <?php echo "<img class = \"ava\" src =\"".$u1["link"]."\">"; ?>
                                </a>
                            
                                <form method="post" action="ValidCmt.php?id=<?php echo $id_post; ?>&s=1&idc=<?php echo $idc;?>" style="display:flex; width:100%;">
                                    <input id="my_cmt_1" class="my_cmt_1" type="text" name="comment" value="<?php echo $content; ?>">
                            
                                    <button id="my_submit" class="my_submit"   onclick="">Send</button>
                                </form>
                            
                            </div>
                            <div id="all_cmt" class="all_cmt">
                            </div>
                                <?php
                            }
                            else{
                                ?>
                            <div id="my_cmt" class="my_cmt">
                                <a href="user.php" class="my_profile">
                                    <?php echo "<img class = \"ava\" src =\"".$u1["link"]."\">"; ?>
                                </a>
                            
                                <form method="post" action="ValidCmt.php?id=<?php echo $id_post; ?>" style="display:flex; width:100%;">
                                    <input id="my_cmt_1" class="my_cmt_1" type="text" name="comment">
                            
                                    <button id="my_submit" class="my_submit"   onclick="">Send</button>
                                </form>
                            
                            </div>
                            
                            <div id="all_cmt" class="all_cmt">
                            <ul id="a_cmt" class="a_cmt" style="list-style-type: none">
                                <?php 
                                    $sql = "select * from comment where id_post = ".$id_post." order by publish desc";
                                    $result = mysqli_query($conn, $sql, null);
                                    while($row_4 = mysqli_fetch_assoc($result)){
                                        
                                        $sql_1 = "select * from avatar where id_user = '".$row_4["id_user"]."'";
                                        $result_1 = mysqli_query($conn, $sql_1, null);
                                        $row_5 = mysqli_fetch_assoc($result_1);
                                        
                                        echo "<li class=\"all_cmts\">";
                                        echo "<a class=\"proflie_user_1\" href=\"user_1.php?user=".$row_4['id_user']."\"><img class=\"ava\" src=".$row_5["link"]."></a>";
                                        echo "<div class=\"cmt_user\">";
                                        echo "<p>".$row_4["content"]."</p>";
                                        echo "</div>";
                                        if(isset($_SESSION['username'])){
                                            if($row_4['id_user'] == $_SESSION['username']){
                                                
                                                ?>
                                <div class="edit_delete">
                                                <form class="edit" method="post" action="Featured_photo.php?id=<?php echo $id_post;?>">
                                                    <input name="idcmt" type="hidden" value="<?php echo $row_4['id'];?>">
                                                    <input name="content" type="hidden" value="<?php echo $row_4["content"];?>">
                                                    <input type="submit" value="Edit" name="edit">
                                                </form>
                                                
                                                <form class="edit" method="post" action="Featured_photo.php?id=<?php echo $id_post;?>">
                                                    <input name="idcmt1" type="hidden" value="<?php echo $row_4['id'];?>">
                                                    <input type="submit" value="Delete" name="delete">
                                                </form>
                                </div>
                                                <?php
                                            }
                                        }
                                        echo "</li>";
                                    }
                                    
                                ?>
                               
                            </ul>
                        </div>
                            <?php
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
            function Display(){
                
                document.getElementById("comment").style.display = "flex";
                //document.getElementById("comment").style. = "flex";
            }    
            function Hiden(){
                document.getElementById("comment").style.display = "none";
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
    </body>
</html>