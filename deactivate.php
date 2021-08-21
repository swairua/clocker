<?php
include 'connect.php';
$email = '';

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    if(email){
      $sql = "UPDATE users SET is_active ='0' WHERE email='$email' ";
      $query = mysqli_query($conn,$sql);

      header('Location: view_users.php');
    }
}
?>