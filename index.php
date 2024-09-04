<?php
session_start();
if (isset($_SESSION["logedin"])) {
    header("location:./Pages/dashboard.php");
} else {
    header("location:./Login/index.php");
}
?>