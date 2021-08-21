<html>
<body onload="getLocation()"><!--onload="getLocation()" use it for on load page-->

<!-- <button onclick="getLocation()">Try It</button> -->

<script>

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(redirectToPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function redirectToPosition(position) {
        window.location='logout.php?lat='+position.coords.latitude+'&long='+position.coords.longitude;
    }
</script>

</body>
</html>