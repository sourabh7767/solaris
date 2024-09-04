<?php

$serverurl = "localhost";
$userName = "solaris_db";
$password = "solaris_db";
$dbName = "solaris_db";

$connection = mysqli_connect($serverurl, $userName, $password, $dbName);
if ($connection) {
    echo "";
} else {
    echo "Not Connected";
}

?>