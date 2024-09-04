<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $optime = $data["optime"];
    $minimubOb = $data["minimubOb"];
    $maxRoi = $data["maxRoi"];
    $opLimit = $data["opLimit"];
    $otp = $data["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";
    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }
    if ($dbotp == $otp) {
        $newOtp = rand(1000, 9999);
        $sql = "UPDATE `Admin` SET Value='$optime' WHERE `Name`='Operation_Timer';
            UPDATE `Admin` SET Value='$minimubOb' WHERE `Name`='Minimum_OB';
            UPDATE `Admin` SET Value='$maxRoi' WHERE `Name`='ROI Max Value';
            UPDATE `Admin` SET Value='$opLimit' WHERE `Name`='Operation_Limit';
            UPDATE `admin_login` SET otp='$newOtp' WHERE `slno`=1;
            ";
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