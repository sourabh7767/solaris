<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);


    $adminemail = $data["adminemail"];
    $adminpassword = $data["adminpassword"];
    $previousEmail = $data["previousEmail"];
    $otp = $data["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";
    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }


    if ($adminpassword !== "" && $adminemail !== "") {
        if ($dbotp == $otp) {
            $newOtp = rand(1000, 9999);
            $hashPassword = password_hash($adminpassword, PASSWORD_DEFAULT);

            $sql = "UPDATE `admin_login` SET `Email`='$adminemail',`Password`='$hashPassword' WHERE `Email`='$previousEmail';
        UPDATE `admin_login` SET otp='$newOtp' WHERE `slno`=1;";
            $result = mysqli_multi_query($connection, $sql);

            if ($result) {
                echo json_encode(array("status" => "success"));
                mysqli_close($connection);
            } else {
                echo json_encode(array("status" => "error"));
                mysqli_close($connection);
            }
        }


    } else if ($adminpassword != "" && $adminemail == "") {
        if ($dbotp == $otp) {
            $newOtp = rand(1000, 9999);
            $hashPassword = password_hash($adminpassword, PASSWORD_DEFAULT);

            $sql = "UPDATE `admin_login` SET`Password`='$hashPassword' WHERE `Email`='$previousEmail';
        UPDATE `admin_login` SET otp='$newOtp' WHERE `slno`=1;";
            $result = mysqli_multi_query($connection, $sql);

            if ($result) {
                echo json_encode(array("status" => "success"));
                mysqli_close($connection);
            } else {
                echo json_encode(array("status" => "error"));
                mysqli_close($connection);
            }
        }
    } else {
        if ($dbotp == $otp) {
            $newOtp = rand(1000, 9999);
            $sql = "UPDATE `admin_login` SET `Email`='$adminemail' WHERE `Email`='$previousEmail';
        UPDATE `admin_login` SET otp='$newOtp' WHERE `slno`=1;";
            $result = mysqli_multi_query($connection, $sql);
            if ($result) {
                echo json_encode(array("status" => "success"));
                mysqli_close($connection);
            } else {
                echo json_encode(array("status" => "error"));
                mysqli_close($connection);
            }
        } else {
            echo json_encode(array("status" => "error"));
            mysqli_close($connection);

        }
    }


}



?>