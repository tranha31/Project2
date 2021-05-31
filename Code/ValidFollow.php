<?php
session_start();
if(!isset($_SESSION['username'])){
    ?>
    <script>
        alert("You must login first");
        window.location.assign("login.php");
    </script>
    <?php
}
$u = $_SESSION['username'];

$ur = $_GET['user'];

$conn = mysqli_connect("localhost", "root","", "picture_social");

$sql = "select * from follow where id_follow = '$u' and id_followed='$ur'";
$result = mysqli_query($conn, $sql, null);
if(mysqli_num_rows($result) > 0){
    $sql = "delete from follow where id_follow = '$u' and id_followed='$ur'";
    mysqli_query($conn, $sql, null);
    $sql = "update users set number_of_follow = number_of_follow - 1 where username = '$u'";
    mysqli_query($conn, $sql, null);
}
else{
    $sql = "insert into follow(id_follow, id_followed) values ('$u', '$ur')";
    mysqli_query($conn, $sql, null);
    
    $d = date('Y-m-d');
    $sql = "insert into nofitication(id_user, status, content, link, id_user_no, date) values ('$u', 0, 'follows you', 'user_1.php?user=$u','$ur', '$d')";
    mysqli_query($conn, $sql, null);
    
    $sql = "update users set number_of_follow = number_of_follow + 1 where username = '$u'";
    mysqli_query($conn, $sql, null);
}

echo "<script>window.location.assign(\"user_1.php?user=".$ur."\")</script>";

?>