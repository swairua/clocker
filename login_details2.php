<?php

session_start();
include 'booty.php';
include 'connect.php';

$ip='';
$latitude='';
$longitude='';

if(isset($_POST['submit'])){
	
	$ip=$_POST['ip'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
    
	if(!empty($latitude) && (!empty($longitude))){
		$check_user = "SELECT * FROM users WHERE ip = '$ip' ";

        // print($check_user);
        
		$result = mysqli_query($conn,$check_user);
		$r=mysqli_fetch_array($result);
		$uid = $r['id'];
        $email = $r['email'];

		if($uid){
		
		$login_status = "SELECT * FROM login_status WHERE user_id='$uid' AND login_status='1' ";
		$login_result = mysqli_query($conn,$login_status);
		$rset = mysqli_fetch_array($login_result);		

        if(!$rset){	

		$_SESSION['ip'] = $ip;
		$_SESSION['latitude'] = $latitude;
		$_SESSION['longitude'] = $longitude;
        $_SESSION['email'] = $email;
		
		header('Location: success.php');

		}elseif($rset == '1'){

		$_SESSION['ip']=$ip;
		echo '<div class="container">  
			<div class="alert alert-primary alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>You are still in live session!</strong> Logout here. <a href="logoutindex.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Logut</a>
			</div>  
		</div>';		
		}
		else{
			echo 'Hello Budddy! You must be connected to the internet in order to continue with login';
		}	
			// echo $_SESSION['email'];
		}
	}
}
?>