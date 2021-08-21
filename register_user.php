<?php
include 'connect.php';

$username='';
$firstname='';
$phone='';
$email='';
$password='';
$ip= '';
	$username= $_POST['username'];
	$firstname=$_POST['firstname'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];
    $email=$_POST['email'];
	$ip = $_POST['ip'];
	$hash_pass=md5($password);
	$csql= "INSERT INTO users(username,firstname,phone,email,`password`,ip) VALUES('$username','$firstname','$phone','$email','$hash_pass','$ip')";  
	$cquery= mysqli_query($conn,$csql) or die(mysqli_error($conn));
?>