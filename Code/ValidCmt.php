<?php 
    session_start();
    $conn = mysqli_connect("localhost", "root","", "picture_social");
    $u = $_SESSION['username'];
    $cmt = $_POST['comment'];
    $id_post = $_GET['id'];
    $date = date('Y-m-d H:i:s');

    $sql = "insert into comment(id_user, id_post, content, publish) values ('$u','$id_post','$cmt','$date')";
    mysqli_query($conn, $sql, null);
    
    echo "<script>window.location.assign('Featured_photo.php?id=$id_post')</script>";
         
        
?>