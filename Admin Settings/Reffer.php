<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);


    $Bronze_Deposit_Commision = $data["Bronze_Deposit_Commision"];
    $Silver_Deposit_Commission = $data["Silver_Deposit_Commission"];
    $Gold_Deposit_Commission = $data["Gold_Deposit_Commission"];
    $Bronze_Operation_Commission = $data["Bronze_Operation_Commission"];
    $Silver_Operation_Commission = $data["Silver_Operation_Commission"];

    $Gold_Opearation_Commission = $data["Gold_Opearation_Commission"];
    $Spin_Per_Refer = $data["Spin_Per_Refer"];



    $otp = $data["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";
    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }
    if ($dbotp == $otp) {
        $newOtp = rand(1000, 9999);
        $sql = "UPDATE `Admin` SET Value='$Bronze_Deposit_Commision' WHERE `Name`='Bronze Deposit Commision';
            UPDATE `Admin` SET Value='$Silver_Deposit_Commission' WHERE `Name`='Silver Deposit Commission';
            UPDATE `Admin` SET Value='$Gold_Deposit_Commission' WHERE `Name`='Gold Deposit Commission';
            UPDATE `Admin` SET Value='$Bronze_Operation_Commission' WHERE `Name`='Bronze Operation Commission';
            UPDATE `Admin` SET Value='$Silver_Operation_Commission' WHERE `Name`='Silver Operation Commission';
            UPDATE `Admin` SET Value='$Gold_Opearation_Commission' WHERE `Name`='Gold Opearation Commission';
            UPDATE `Admin` SET Value='$Spin_Per_Refer' WHERE `Name`='Spin Per Refer';
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