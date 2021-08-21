<?php
include 'connect.php';
$project_name='';
$project_description='';
$user_id='';

$project_name=$_POST['project_name'];
$project_description=$_POST['project_description'];
$user_id=$_POST['user_id'];

$psql= "INSERT INTO daily_tasks(user_id,project_name,project_description) VALUES('$user_id','$project_name','$project_description')";
$pquery= mysqli_query($conn,$psql);

if($pquery){
    echo 'Your data has been inserted successfully';
    
    header('Location: login_details.php');
}else{
    echo 'No data could be inserted';
}

?>