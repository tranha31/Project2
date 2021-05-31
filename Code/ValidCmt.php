<?php 
    session_start();
    $conn = mysqli_connect("localhost", "root","", "picture_social");
    $u = $_SESSION['username'];
    $cmt = $_POST['comment'];
    $id_post = $_GET['id'];
    $date = date('Y-m-d H:i:s');
    if(isset($_GET['s'])){
        $idc = $_GET['idc'];
        $sql = "update comment set content = '$cmt' where id = $idc";
        mysqli_query($conn, $sql, null);
        echo "<script>window.location.assign('Featured_photo.php?id=$id_post')</script>";
    }
    else if(isset($_GET['p'])){
        $sql = "update post set caption = '$cmt' where id = $id_post";
        mysqli_query($conn, $sql, null);
        echo "<script>window.location.assign('Featured_photo.php?id=$id_post')</script>";
    }
    else{
        $sql = "select * from post where id = $id_post";
        $result1 = mysqli_query($conn, $sql, null);
        $row = mysqli_fetch_assoc($result1);
        $id_u = $row['id_user'];
        
        $sql = "insert into comment(id_user, id_post, content, publish) values ('$u','$id_post','$cmt','$date')";
        mysqli_query($conn, $sql, null);
        
        $d = date('Y-m-d');
        $sql = "insert into nofitication(id_user, status, content, link, id_user_no, date) values ('$u', 0, 'comments your post', 'Featured_photo.php?id=$id','$id_u', '$d')";
        mysqli_query($conn, $sql, null);
        
        echo "<script>window.location.assign('Featured_photo.php?id=$id_post')</script>";
    }
    
         
        
?>