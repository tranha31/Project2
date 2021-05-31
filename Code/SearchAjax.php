<?php
session_start();
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\"?>\n";
echo "<names>\n";

if(!isset($query)){
    $query = $_GET['query'];
}
if($query != ""){
    $conn = mysqli_connect("localhost", "root","", "picture_social");
    $find = explode(' ', $query);
    $sql = "Select * from users where ";
    foreach($find as $key => $value){
        $sql = $sql."name like '%$value%' or ";
    }
    $sql = substr($sql, 0, -3);
    $sql = $sql."and username != '".$_SESSION['username']."'";
    
    $result = mysqli_query($conn, $sql, null);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $s = "select * from avatar where id_user = '".$row['username']."'";
            $result1 = mysqli_query($conn, $s, null);
            $ava = mysqli_fetch_assoc($result1);
            
            echo "<id>".$row['username']."</id>\n";
            echo "<name>".$row['name']."</name>\n";
            echo "<ava>".$ava['link']."</ava>\n";
        }
    }
    mysqli_close($conn);
}

echo '</names>';
?>