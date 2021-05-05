<?php 
    session_start();
    $conn = mysqli_connect("localhost", "root","", "picture_social");
    $u = $_SESSION['username'];
    $caption = $_POST['caption'];

    
    $date = date('Y-m-d H:i:s');
    $img = $_FILES['image']['name'];
    
    $link = "../UploadPicture/".$img;
    

    $sql = "insert into post(id_user, caption, vote, publish_time) values ('$u','$caption',0,'$date')";
    mysqli_query($conn, $sql, null);
    
    $sql = "select * from post where id_user='$u' and publish_time='$date'";
    $result = mysqli_query($conn, $sql, null);
    $post = mysqli_fetch_assoc($result);
    $id_post = $post['id'];
    $sql = "insert into picture(id_post, id_user, link) values ($id_post,'$u','$link')";
    
    mysqli_query($conn, $sql, null);
    move_uploaded_file($_FILES['image']['tmp_name'], "../UploadPicture/$img");
    
    echo "<script>window.location.assign('Feed.php')</script>";
         
        
?>