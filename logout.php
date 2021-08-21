<?php
        session_start();
        include 'connect.php';
        $email=$_SESSION['email'];
        $latitude = $_GET['lat'];
        $longitude = $_GET['long'];        

        $isql = "SELECT * FROM users JOIN daily_logins ON users.id=daily_logins.user_id WHERE email='$email' ";
        $iquery = mysqli_query($conn,$isql);
        $r=mysqli_fetch_array($iquery);
        $user_id = $r['user_id'];

        $fquery="UPDATE daily_logins SET login_status='0' WHERE user_id='$user_id' ";        
        $q=mysqli_query($conn,$fquery);

        $sql3="INSERT INTO daily_logouts(user_id,latitude,longitude) VALUES('$user_id','$latitude','$longitude')";
        $q3=mysqli_query($conn,$sql3);

        session_destroy();
        unset($_SESSION['email']);
        header('location: index.php');   
?>