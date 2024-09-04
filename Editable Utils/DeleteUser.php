<?php

require("../Connections/Db.php");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"])) {
    session_start();
    $user = $_GET["user"];
    $query = "DELETE FROM User WHERE `User`.`Email` ='$user';
    DELETE FROM Withdrawal WHERE `Withdrawal`.`Email` ='$user';
    DELETE FROM Deposit WHERE `Deposit`.`Email` ='$user';
    DELETE FROM Operation WHERE `Operation`.`Email` ='$user' ";
    $result = mysqli_multi_query($connection, $query);
    if ($result) {

        $_SESSION["successMsg"] = "User Deleted successfully";
        header("location:../Pages/users.php");
    } else {
        $_SESSION["errorMsg"] = "User Not deleted";
        header("location:../Pages/users.php");
    }






}


?>