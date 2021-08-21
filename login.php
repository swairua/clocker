<?php session_start(); 
?>
<?php
  include 'booty.php'; 
?>
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>    
    #form1 {
     display:none;
}

</style>
<div class="limit">
    <div class="login-container">
        <div class="bb-login">
        <?php
        include 'connect.php';
            $lat=(isset($_GET['lat']))?$_GET['lat']:'';
            $long=(isset($_GET['long']))?$_GET['long']:'';
            $dsql = "SELECT * FROM office_location";
            $query = mysqli_query($conn,$dsql);
            $res = mysqli_fetch_array($query);
            $maxlat=$res['maxlat'];
            $minlat=$res['minlat'];
            $maxlong=$res['maxlong'];
            $minlong=$res['minlong'];
             
            // echo $maxlat;
            // echo '<br>';
            // echo $minlat;
            // echo '<br>';
            // echo $maxlong;
            // echo '<br>';
            // echo $minlong;
            // exit;

            if($lat > $maxlat){
                echo 'Hello Buddy. You are out of login zone';
            }elseif($lat < $minlat) {
                echo 'Hello Buddy. You are out of login zone';
            }elseif($long > $maxlong){
                echo 'Hello Buddy. You are out of login zone';
            }elseif($long < $minlong){
                echo 'Hello Buddy. You are out of login zone';
            }else {                         
        ?>
            <div>
            <span><img src="images/clock.jpg" style="width: 250px; margin-left: 38%"></span>
            </div>

            <?php
                   if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];                    
                    echo "<div class='alert alert-primary alert-dismissible' style='text-align: center; margin-bottom: 25px' role='alert'>
                            <p>You are logged in as ".$email."</p>
                            
                            <div class='bb-login-form-btn'>
                            <a href='logoutindex.php'><div class='bb-form-bgbtn'></div> <button class='bb-form-btn'> Clock out </button></a>
                            </div>                            
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            </div>";                    
                }else{                   
                 ?>
            
            <!-- <button type="button" id="formButton">Toggle Form!</button> -->
            <div class="login-container-form-btn">
                <div class="bb-login-form-btn">
                    <div class="bb-form-bgbtn"></div>
                    <input onclick="this.value='Enter your details below'" class="bb-form-btn" style="background-color: #a11d2b" type="button" value="Clock in" id="formButton" />
                </div>
            </div>
            <hr style="margin: 25px">
            <div style='text-align: center'>
            <i><b>Have no account? <a href="register2.php">Register here</a></b></i>
            </div>
          
            <form class="bb-form validate-form" method="POST" id="form1" action="login_details.php"> 
              
                <input type="hidden" name="latitude" value="<?php echo $lat; ?>">
                <input type="hidden" name="longitude" value="<?php echo $long; ?>">                
                <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">                 	
                <input class="input100" type="text" name="email"> <span class="bbb-input" data-placeholder="Email" required></span> </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password"> 
                <span class="btn-show-pass"> <i class="mdi mdi-eye show_password" id="togglePassword"></i> </span>
                <input class="input100" type="password" name="password" id="id_password"> <span class="bbb-input" data-placeholder="Password" required></span></div>
                <div class="field-group">
                <div>
                    <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="login-container-form-btn">
                    <div class="bb-login-form-btn">
                        <div class="bb-form-bgbtn"></div> <button class="bb-form-btn" type="submit" name="submit"> Submit </button>
                    </div>
                    <hr style="width: 100%; margin: 15px">
                    
                </div>
            </form>
              
                <?php  
            } 
            }?>
            </div>
    </div>
</div>
<script>
	const togglePassword = document.querySelector('#togglePassword');
	  const password = document.querySelector('#id_password');
	  togglePassword.addEventListener('click', function (e) {
	    // toggle the type attribute
	    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
	    password.setAttribute('type', type);
	    // toggle the eye slash icon
	    this.classList.toggle('fa-eye-slash');
	});
</script>
<script>
        $("#formButton").click(function(){
            $("#form1").toggle();
        });
</script>