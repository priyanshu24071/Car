<?php 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Hihellobye@7');
define('DB_NAME', 'carInfo');
// Connect to the database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo  "Connected";