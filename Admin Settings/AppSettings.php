<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["logedin"] == true) {
    require("../Connections/Db.php");
    $maintenanceUrl = $_POST["maintenanceUrl"];
    $appealUrl = $_POST["appealUrl"];
    $appVersion = $_POST["appVersion"];
    $updateURL = $_POST["updateURL"];
    $maintenanceMode = $_POST["maintenanceMode"];
    $otp = $_POST["otp"];
    $sqllogin = "SELECT * FROM `admin_login`";
    $resultLogin = mysqli_query($connection, $sqllogin);
    $dbotp = "";

    while ($row = mysqli_fetch_assoc($resultLogin)) {
        $dbotp = $row["otp"];
    }
    if ($dbotp == $otp) {

        if (isset($_FILES["apkFile"]) && $_FILES["apkFile"]["error"] == UPLOAD_ERR_OK) {
            $fileName = $_FILES["apkFile"]["name"];
            $fileTmpPath = $_FILES["apkFile"]["tmp_name"];
            $fileExt = explode(".", $fileName);
            $uploadDir = '../App/APK/';
            $destination = $uploadDir . "SolarisApk." . $fileExt[1];
            move_uploaded_file($fileTmpPath, $destination);
        }

        global $advatizingImg;
        global $sql;
        if (isset($_FILES["advertisingImageImg"]) && $_FILES["advertisingImageImg"]["error"] == UPLOAD_ERR_OK) {
            $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            $extratctPath = explode("/", $url);
            $imageUrl = $extratctPath[0] . "/" . $extratctPath[1] . "/" . $extratctPath[2] . "/App/AddImages/";
            $fileName = $_FILES["advertisingImageImg"]["name"];
            $fileTmpPath = $_FILES["advertisingImageImg"]["tmp_name"];
            $fileExt = explode(".", $fileName);
            $uploadDir = '../App/AddImages/';
            $destination = $uploadDir . "appAddImg." . $fileExt[1];
            $imageUpload = "http://" . $imageUrl . "appAddImg." . $fileExt[1];
            if (move_uploaded_file($fileTmpPath, $destination)) {
                $advatizingImg = $imageUpload;
            }
            $sql = "UPDATE `Admin` SET Value='$advatizingImg' WHERE ID=103;
            UPDATE `Admin` SET Value='$maintenanceUrl' WHERE ID=121;
            UPDATE `Admin` SET Value='$appealUrl' WHERE ID=123;
            UPDATE `Admin` SET Value='$updateURL' WHERE ID=120;
            UPDATE `Admin` SET Value='$maintenanceMode' WHERE ID=102;
            UPDATE `Admin` SET Value='$appVersion' WHERE ID=101";

        } else {
            $sql = "UPDATE `Admin` SET Value='$maintenanceUrl' WHERE ID=121;
            UPDATE `Admin` SET Value='$appealUrl' WHERE ID=123;
            UPDATE `Admin` SET Value='$updateURL' WHERE ID=120;
            UPDATE `Admin` SET Value='$maintenanceMode' WHERE ID=102;
            UPDATE `Admin` SET Value='$appVersion' WHERE ID=101";
        }
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