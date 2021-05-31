<html>
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        
    </head>
    <body>
        
        <?php
        $conn = mysqli_connect("localhost", "root","", "picture_social");
        $ve = $_GET['code'];
        $sql = "select * from users where verificode = '$ve' and verify = 0";
        $result = mysqli_query($conn, $sql, null);
        if(mysqli_num_rows($result) > 0){
            $sql = "update users set verify = 1 where verificode = '$ve'";
            mysqli_query($conn, $sql, null);
            ?>
        <script>
            alert("Your account is valid!");
            window.location.assign("login.php");
        </script>
            <?php
        }
        else{
            ?>
        <script>
            alert("I think you're in the wrong place!!");
            window.location.assign("Home.php");
        </script>
        
            <?php
        }
        ?>
        
    </body>
</html>
