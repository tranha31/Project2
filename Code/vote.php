<?php
session_start();
$id = $_GET['id'];

if(!isset($_SESSION['username'])){
    ?>
<script>
    alert("You must login first!");
    window.location.assign("login.php");
</script>
    <?php
}
else{
    $u = $_SESSION['username'];
    $conn = mysqli_connect("localhost", "root","", "picture_social");
    $sql = "select * from vote where id_post = $id and id_user = '$u'";
    $result = mysqli_query($conn, $sql, null);
    if(mysqli_num_rows($result) == 0){
        $sql = "insert into vote(id_post, id_user) values($id, '$u')";
        mysqli_query($conn, $sql, null);
        
        $sql = "update post set vote = vote + 1 where id = $id";
        mysqli_query($conn, $sql, null);
        
        $sql = "select * from post where id = $id";
        $result1 = mysqli_query($conn, $sql, null);
        $row = mysqli_fetch_assoc($result1);
        $id_u = $row['id_user'];
        
        $d = date('Y-m-d');
        $sql = "insert into nofitication(id_user, status, content, link, id_user_no, date) values ('$u', 0, 'likes your post', 'Featured_photo.php?id=$id','$id_u','$d')";
        mysqli_query($conn, $sql, null);
        
        if(isset($_GET['s'])){
            ?>
            <script>
                window.location.assign("Featured_photo.php?id=<?php echo $id;?>");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                window.location.assign("Feed.php");
            </script>
            <?php
        }
        
    }
    else{
        $sql = "delete from vote where id_post = $id and id_user = '$u'";
        mysqli_query($conn, $sql, null);
        
        $sql = "update post set vote = vote - 1 where id = $id";
        mysqli_query($conn, $sql, null);
        
        if(isset($_GET['s'])){
            ?>
            <script>
                window.location.assign("Featured_photo.php?id=<?php echo $id;?>");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                window.location.assign("Feed.php");
            </script>
            <?php
        }
        
    }
    
}
?>