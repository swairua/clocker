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
    //   echo $email;
    ?>
    <link rel="stylesheet" href="style.css">
    <?php
    echo '<div class="container alert alert-danger alert-dismissible c2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Access denied!</strong> You are not allowed to view this page.
            </div>';
  }else{
    //  print_r(getLogins());
    //  foreach ($uresults as $result) {
    //     echo $result['email']; 
    //     echo "<br>";
    // }   
      include 'connect.php';
      $usql = "SELECT * FROM users";    
      $uquery = mysqli_query($conn,$usql) or die(mysqli_error($conn));
    //   $uresults = mysqli_fetch_array($uquery);     
?>
<body>
<div class="container origi">
<div class="limit">
           
                      
               <div class="card" style="width: 100%;">
                <div class="card-body">
                    
                    <a href="reports.php" class="card-link">View reports</a>
                    <a href="register.php" class="card-link">Create user</a>
                    <!-- <a href="view_users.php" class="card-link">View users</a> -->
                    <a href="logoutindex.php" class="card-link">logout</a>
                </div>
                </div>
               
            
</div>
<table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table>
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>IP</th>
                <th>Status</th>
                <th>Date created</th>
                <!-- <th>Disable user</th> -->                
            </tr>
        </thead>
        <tbody>
            <?php
              $n=1;
              while($row = mysqli_fetch_assoc($uquery)) {
                $email2 = $row['email'];
            ?>
            <tr>
                <td><?=$n++; ?></td>
                <td><?=$row['firstname']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['ip']?></td>
                <td><?=$row['is_active']?></td>
                <td><?=$row['created_at']?></td> 
               
                <td><p><?php
                  if($row['is_active'] == '1'){
                      
                      ?>
                      <form method="POST" action="deactivate.php">
                      <input type='hidden' name='email' value='<?=$email2?>'>
                      <button type='submit' name='submit'>Deactivate</button>
                      </form>
                      
                <?php  }else{ ?>
                    <form method="POST" action="activate.php">
                      <input type='hidden' name='email' value='<?=$email2?>'>
                      <button type='submit' name='submit'>Activate</button>
                      </form>
               <?php }
                ?>
            </tr>
            <?php }?>         
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>IP</th>
                <th>Status</th>
                <th>Date created</th> 
                <th>Action</th>
                <!-- <th>Disable user</th>                -->
            </tr>
        </tfoot>
    </table>
    </div>
    </body>
    <?php } ?>
    <script>
            var minDate, maxDate; 
                // Custom filtering function which will search data in column four between two values
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        var min = minDate.val();
                        var max = maxDate.val();
                        var date = new Date( data[4] );                
                        if (
                            ( min === null && max === null ) ||
                            ( min === null && date <= max ) ||
                            ( min <= date   && max === null ) ||
                            ( min <= date   && date <= max )
                        ) {
                            return true;
                        }
                        return false;
                    }
                );                
                $(document).ready(function() {
                    // Create date inputs
                    minDate = new DateTime($('#min'), {
                        format: 'MMMM Do YYYY'
                    });
                    maxDate = new DateTime($('#max'), {
                        format: 'MMMM Do YYYY'
                    });                
                    // DataTables initialisation
                    var table = $('#example').DataTable();                
                    // Refilter the table
                    $('#min, #max').on('change', function () {
                        table.draw();
                    });
                });
    </script>