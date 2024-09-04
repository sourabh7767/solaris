<?php

$serverurl = "localhost";
$userName = "root";
$password = "";
$dbName = "solarrvp_solarisapp";

$connection = mysqli_connect($serverurl, $userName, $password, $dbName);
if ($connection) {
    echo "";
} else {
    echo "Not Connected";
}

?>