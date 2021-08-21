<?php
 session_start();
 include_once('functions.php');  
 $email=$_SESSION['email'];
 if(empty($email)){
     header('Location: index.php');
 }
 
 include 'booty.php';
 checkUsertype();
 if(checkUsertype() != 1){    
   ?>
   <link rel="stylesheet" href="style.css">
   <?php
   echo '<div class="container alert alert-danger alert-dismissible c2">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
               <strong>Access denied!</strong> You are not allowed to view this page.
           </div>';
 }else{
?>
<link rel="stylesheet" href="style.css">
<div class="d-flex justify-content-center align-items-center mt-5">
   
    <div class="card" style="width: 850px">
        <div class="limit">   
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        
                        <a href="reports.php" class="card-link">View reports</a>
                        <a href="register.php" class="card-link">Create user</a>
                        <a href="view_users.php" class="card-link">View users</a>
                        <a href="logoutindex.php" class="card-link">logout</a>
                    </div>
                    </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item text-center"> <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Register new user</a> </li>
            
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
             <form method="POST"  id="form-save">
                 
                <div class="form px-6 pt-5">
                 <input type="text" name="username" class="form-control" placeholder="Username">
                  <input type="text" name="firstname" class="form-control" placeholder="firstname"> 
                  <input type="text" name="phone" class="form-control" placeholder="Phone"> 
                  <input type="text" name="email" class="form-control" placeholder="Emails"> 
                  <input type="text" name="password" class="form-control" placeholder="Password">
                 <!-- <button type="submit" name="submit" class="btn btn-dark btn-block">Submit</button> -->
                 <div class="login-container-form-btn">
                    <div class="bb-login-form-btn">                        
                        <button class="btn btn-dark btn-block" id="save" type="button" name="save"> Update details </button>
                    </div>
                    <hr class="fullblack">
                    
                </div>
                <div id="msg"></div>
                </div>
             </form>
            </div>            
        </div>
    </div>
</div>
<?php } ?>

<script>
        $(document).on('click','#save',function(e) {
            var data = $("#form-save").serialize();           
            $.ajax({
                data: data,
                type: "post",
                url: "register_user.php",                
                success: function(data) { 
                        $('#msg').html(data).fadeIn('slow');
                        $('#msg').html("Thank you. completed successfully").fadeIn('slow') //also show a success message 
                        $('#msg').delay(5000).fadeOut('slow');
                    }                    
            });
            $("#form-save")[0].reset();            
        });
</script>