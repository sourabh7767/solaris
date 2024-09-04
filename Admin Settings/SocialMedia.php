<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");


    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $whatsappUrl = $data["whatsappUrl"];
    $tiktokUrl = $data["tiktokUrl"];
    $youtubeUrl = $data["youtubeUrl"];
    $instalUrl = $data["instalUrl"];
    $facebookUrl = $data["facebookUrl"];
    $telegramUrl = $data["telegramUrl"];

    $Telegram_Channel = $data["Telegram_Channel"];
    $Tutorianl_Link = $data["Tutorianl_Link"];

    $otp = $data["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";
    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }
    if ($dbotp == $otp) {
        $sql = "UPDATE `Admin` SET Value='$whatsappUrl' WHERE Name='WhatsApp Support';
            UPDATE `Admin` SET Value='$tiktokUrl' WHERE Name='Tiktok Channel';
            UPDATE `Admin` SET Value='$youtubeUrl' WHERE Name='Youtube Channel';
            UPDATE `Admin` SET Value='$instalUrl' WHERE Name='Instagram Channel';
            UPDATE `Admin` SET Value='$facebookUrl' WHERE Name='Facebook Channel';
            UPDATE `Admin` SET Value='$telegramUrl' WHERE Name='Telegram Support';
            UPDATE `Admin` SET Value='$Telegram_Channel' WHERE Name='Telegram Channel';
            UPDATE `Admin` SET Value='$Tutorianl_Link' WHERE Name='Tutorial Link';";
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