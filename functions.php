<?php //session_start();
//   include 'connect.php';
  if(isset($_SESSION['email'])){
      $email=$_SESSION['email'];
    //   echo $email;
  }

  function checkUsertype(){
    include 'connect.php';
      $sql = "SELECT * FROM users WHERE email = '".$_SESSION['email']."' ";
      $squery = mysqli_query($conn,$sql);
      $results = mysqli_fetch_array($squery);
      $resulttype = $results['type'];
      return $resulttype;
  }

  function getLogins(){
    include 'connect.php';
      $usql = "SELECT * FROM daily_logins JOIN users ON daily_logins.user_id=users.id ";
      $uquery = mysqli_query($conn,$usql);
      $uresults = mysqli_fetch_array($uquery); 
      return $uresults;
  }

  function getTheip(){
        // Declaring a variable to hold the IP
        // address getHostName() gets the name
        // of the local machine getHostByName()
        // gets the corresponding IP
        $localIP = getHostByName(getHostName());
        
        // Displaying the address 
        return $localIP;
  }  

?>