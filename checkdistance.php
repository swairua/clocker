<?php


 include 'connect.php'; 

 $sql = "SELECT * FROM office_location";
 $q= mysqli_query($conn,$sql);
 $result=mysqli_fetch_array($q);

//  print_r($result);

$lat = $result['latitude'];
$long = $result['longitude'];

$maxlong = $long + 0.00090090;
$minlong = $long - 0.00090090;
$maxlat = $lat - 0.00090090;
$minlat = $lat + 0.00090090;

echo $maxlong;
echo '<br>';
echo $minlong;
echo '<br>';
echo $minlat;
echo '<br>';
echo $maxlat;

?>


<script>


var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  var crd = pos.coords;

  console.log('Your current position is:');
  console.log(`Latitude : ${crd.latitude}`);
  console.log(`Longitude: ${crd.longitude}`);
  console.log(`More or less ${crd.accuracy} meters.`);
}

function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error, options);

</script>
