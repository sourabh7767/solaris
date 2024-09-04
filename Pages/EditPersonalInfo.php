<?php
session_start();
if (isset($_SESSION["logedin"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["personalInfo"])) {
        include("../Connections/Db.php");
        $name = mysqli_real_escape_string($connection, $_POST['userName']);
        $country = mysqli_real_escape_string($connection, $_POST['country']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $countrycode = mysqli_real_escape_string($connection, $_POST['countrycode']);
        $joindate = mysqli_real_escape_string($connection, $_POST['joindate']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $image = mysqli_real_escape_string($connection, $_POST['image']);
        $device_id = mysqli_real_escape_string($connection, $_POST['deviceId']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $pin = mysqli_real_escape_string($connection, $_POST['pin']);
        $userEmail = $_SESSION['user'];
        $sql = "UPDATE  `User` SET `Name`='$name',`Country`='$country',`Email`='$email',`Country_Code`='$countrycode',`Join_Time`='$joindate',`Phone`='$phone',`Device_Id`='$device_id',`Image`='$image',`Password`='$password',`PIN`='$pin'  WHERE `Email`='$userEmail'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION["successMsg"] = "User Updated successfully";
            header("location:./users.php");
        } else {
            $_SESSION["error"] = "User Not Update";
            header("location:./profile.php");
        }
    } else {
        $_SESSION["error"] = "User Not Update";
        header("location:./profile.php");

    }
} else {
    // header("location:../.php");
    header("location:./profile.php");
}
?>