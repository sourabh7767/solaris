<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);


    $depoCurrency = $data["depoCurrency"];
    $depositNetwork = $data["depositNetwork"];
    $Minimum_WB = $data["Minimum_WB"];
    $minDeposit = $data["minDeposit"];
    $depositAddress = $data["depositAddress"];



    $Withdraw_Network = $data["Withdraw_Network"];
    $Withdraw_Currency = $data["Withdraw_Currency"];



    $otp = $data["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";
    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }
    if ($dbotp == $otp) {
        $newOtp = rand(1000, 9999);
        $sql = "UPDATE `Admin` SET Value='$depoCurrency' WHERE `Name`='Deposit Currency';
            UPDATE `Admin` SET Value='$depositNetwork' WHERE `Name`='Deposit Network';
            UPDATE `Admin` SET Value='$Minimum_WB' WHERE `Name`='Minimum_WB';
            UPDATE `Admin` SET Value='$minDeposit' WHERE `Name`='Minimum Deposit';
            UPDATE `Admin` SET Value='$Withdraw_Network' WHERE `Name`='Withdraw Network';
            UPDATE `Admin` SET Value='$Withdraw_Currency' WHERE `Name`='Withdraw Currency';
            UPDATE `Admin` SET Value='$depositAddress' WHERE `Name`='Deposit_ Address';
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



?>