<?php
session_start();
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\"?>\n";
echo "<notifications>\n";

$loginUser = $_SESSION['username'];
$conn = mysqli_connect("localhost", "root","", "picture_social");

$sql = "select *, count(id) as sum from nofitication where id_user_no = '$loginUser' and status = 0 order by date desc";                      
$result = mysqli_query($conn, $sql, null);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $sql = "select * from users where username = '".$row['id_user']."'";
        $result1 = mysqli_query($conn, $sql, null);
        $row1 = mysqli_fetch_assoc($result1);
        
        echo "<idu>".$row1['name']."</idu>\n";
        echo "<idno>".$row['id']."</idno>\n";
        echo "<content>".$row['content']."</content>\n";
        echo "<link>".$row['link']."</link>\n";
        echo "<time>".$row["date"]."</time>\n";
        echo "<sum>".$row["sum"]."</sum>\n";
    }
}
mysqli_close($conn);
echo "</notifications>";                      
                       
?>