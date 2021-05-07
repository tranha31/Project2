<?php
session_start();
$u = $_SESSION['username'];

$ur = $_GET['user'];

$conn = mysqli_connect("localhost", "root","", "picture_social");

$sql = "select * from follow where id_follow = '$u' and id_followed='$ur'";
$result = mysqli_query($conn, $sql, null);
if(mysqli_num_rows($result) > 0){
    $sql = "delete from follow where id_follow = '$u' and id_followed='$ur'";
    mysqli_query($conn, $sql, null);
}
else{
    $sql = "insert into follow(id_follow, id_followed) values ('$u', '$ur')";
    mysqli_query($conn, $sql, null);
}

echo "<script>window.location.assign(\"user_1.php?user=.".$ur."\")</script>";

?>