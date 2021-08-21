<?php

 session_start();
 include 'connect.php'; 
 if(isset($_SESSION['email'])){
 $email = $_SESSION['email'];
}
//  $ip = $_SESSION['ip'];
 $email = $_SESSION['email'];
 $latitude = $_SESSION['latitude'];
 $longitude = $_SESSION['longitude'];

 if(!empty($email) || !empty($ip)){
    //  $action = 'login';

     $msql = "SELECT * FROM users WHERE email='$email' ";
    //  $msql = "SELECT * FROM users WHERE ip='$ip' ";
     $mquery = mysqli_query($conn,$msql);
     $results = mysqli_fetch_array($mquery);
     if(!isset($ip)){
         $ip = '';
     }

     $userid = $results['id'];
     $useremail = $results['email'];
     $week_day = date("l");

     $lsql = "INSERT INTO daily_logins(user_id,latitude,longitude,`week_day`,ip) VALUES('$userid','$latitude','$longitude','$week_day','$ip')"; 
     $lquery = mysqli_query($conn,$lsql);    
    ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

            <link rel="stylesheet" href="style.css">
             <?php
                $type = $results['type'];
                if($type !='1'){
             ?>
            <div class="limit">
                <div class="login-container">
                    <div class="bb-login">        
                        <form class="bb-form validate-form" method="POST" id="form-save"> <span class="bb-form-title p-b-26"> Describe your day's work </span> <span class="bb-form-title p-b-48"> <i class="mdi mdi-symfony"></i> </span>
                            <?php
                            echo "<div class='alert alert-primary alert-dismissible' style='text-align: center; margin-bottom: 25px' role='alert'>
                                    <p>You are logged in as ".$email."</p>
                                    
                                    <div class='bb-login-form-btn'>
                                    <a href='logoutindex.php'><div class='bb-form-bgbtn'></div> <button class='bb-form-btn'> Clock out </button></a>
                                    </div>                            
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                            ?>
                            <input type="hidden" name="user_id" value="<?=$userid;?>" />          
                            <div class="wrap-input100 validate-input" data-validate="Valid project name is: Project">                 	
                            <input class="input100" type="text" name="project_name"> <span class="bbb-input" data-placeholder="Project name"></span> </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter description">               
                            <input class="input100" type="text" name="project_description"> <span class="bbb-input" data-placeholder="Project description"></span> </div>
                            <div class="login-container-form-btn">
                                <div class="bb-login-form-btn">
                                    <div class="bb-form-bgbtn"></div>
                                    <button class="bb-form-btn" id="save" type="button" name="save"> Update project details </button>
                                </div>
                                <hr class="fullblack">
                                <div class="bb-login-form-btn">
                                    <div class="bb-form-bgbtn"></div>
                                    <button class="bb-form-btn" type="button" onclick="location.href='index.php';"> Skip update </button>
                                </div>
                            </div>
                            <div id="msg"></div>
                            <!-- <div class="text-center p-t-115"> <span class="txt1"> Don’t have an account? </span> <a class="txt2" href="#"> Sign Up </a> </div> -->
                        </form>            
                    </div>
                </div>
            <div class="card-body">
          <div class="wrapper text-center">        
        <button class="btn btn-outline-success hidden" id="btnLoginMain" onclick="showSwal('success-message')"></button>
    </div>
</div>
</div>
<?php }elseif($type = '1'){ ?>
           <div class="limit">
           <div class="login-container">
               <div class="bb-login">        
               <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Admin dashboard</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Register new users, view reports and more</h6>
                    <hr>
                    <p class="card-text">Navigate through the system by selecting your prefered panel using the action buttons provided</p>
                    <hr>
                    <a href="reports.php" class="card-link">View reports</a>

                    <a href="register.php" class="card-link">Create user</a>
                    <a href="view_users.php" class="card-link">View users</a>
                    <a href="logoutindex.php" class="card-link">logout</a>
                </div>
                </div>
               </div>
                    
               </div>
<?php }}else{
    header('Location: index.php');
}
?>
<script>
        (function($) {            
        showSwal = function(type) {
        'use strict';
        if (type === 'success-message') {
        swal({
        title: 'Congratulations!',
        text: 'Hi <?=$email?> You have been logged in into the system',
        type: 'success',
        button: {
        text: "Continue",
        value: true,
        visible: true,
        className: "btn btn-primary"        
        }
        })
        }else{
        swal("Error occured !");
        }
        }
        })(jQuery);

</script>

<script>
        window.onload=function(){
        $("#btnLoginMain").click();
        }
</script>

<script>
 $(document).on('click','#save',function(e) {
    var data = $("#form-save").serialize();
    $.ajax({
         data: data,
         type: "post",
         url: "project_details.php",
        //  success: function(data){
                      //alert(data);
              
        //     alert("Your information has been registered.", function() {
        //         window.location.href="index.php";
        //     });
                    
        //  }
        success: function(data) { 
                $('#msg').html(data).fadeIn('slow');
                $('#msg').html("Thank you. completed successfully").fadeIn('slow') //also show a success message 
                $('#msg').delay(5000).fadeOut('slow');
            }
	});
        $("#form-save")[0].reset();
});
</script>