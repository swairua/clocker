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
    //   $usql = "SELECT * FROM daily_logins";    
    //   $uquery = mysqli_query($conn,$usql) or die(mysqli_error($conn));
    //   $uresults = mysqli_fetch_array($uquery);
    
      $master_sql = "SELECT firstname AS uname,email,daily_logins.created_at AS check_in, daily_logins.system_date AS sdate, daily_logouts.created_at AS check_out, daily_logins.week_day FROM users JOIN daily_logouts ON users.id=daily_logouts.user_id JOIN daily_logins ON daily_logouts.user_id=daily_logins.user_id GROUP BY email,sdate ORDER BY check_in ASC, check_out ASC";
      $master_query = mysqli_query($conn,$master_sql);
?>
<body>
<div class="container origi">
<div class="limit">
               <div class="card" style="width: 100%;">
                <div class="card-body">                    
                    <!-- <a href="reports.php" class="card-link">View reports</a> -->
                    <a href="register.php" class="card-link">Create user</a>
                    <a href="view_users.php" class="card-link">View users</a>
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
                <th>Email</th>
                <th>Clock in time</th>
                <th>Clock out time</th>
                <th>Weekday</th>
                <th>Session length(hrs)</th>
                <th>Day length</th>                
            </tr>
        </thead>
        <tbody>
            <?php
              $n=1;
              while($row = mysqli_fetch_assoc($master_query)) {

                  $in = strtotime($row['check_in']);
                  $out = strtotime($row['check_out']);
                  $duration = $out - $in;
                  $theday = $row['week_day'];
                  if($theday == "Saturday"){
                    $day_session = $duration / (4 * 60 * 60);
                    $totalhours = $duration / (60 * 60);
                  }else{
                    $day_session = $duration / (8 * 60 * 60);
                    $totalhours = $duration / (60 * 60);
                  }
            ?>
            <tr>
                <td><?=$n++; ?></td>
                <td><?=$row['uname']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['check_in']?></td>
                <td><?=$row['check_out']?></td> 
                <td><?=$row['week_day']?></td> 
                <td><?=$totalhours?></td> 
                <td><?=$day_session?></td>            
            </tr>
            <?php }?>         
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Clock in time</th>
                <th>Clock out time</th> 
                <th>Weekday</th>
                <th>Session length(hrs)</th>                 
                <th>Day length</th>             
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