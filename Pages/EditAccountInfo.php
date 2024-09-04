<?php
session_start();
if (isset($_SESSION["logedin"])) {



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["AccountSubmit"])) {
        include("../Connections/Db.php");
        $totalbalance = mysqli_real_escape_string($connection, $_POST['totalbalance']);
        $totalrefer = mysqli_real_escape_string($connection, $_POST['totalrefer']);
        $refincome = mysqli_real_escape_string($connection, $_POST['refincome']);
        $spin = mysqli_real_escape_string($connection, $_POST['spin']);
        $refercode = mysqli_real_escape_string($connection, $_POST['refercode']);
        $referby = mysqli_real_escape_string($connection, $_POST['referby']);
        $accountstatus = mysqli_real_escape_string($connection, $_POST['accountstatus']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);

        $userEmail = $_SESSION['user'];
        $sql = "UPDATE  `User` SET `Total_Balance`='$totalbalance',`Total_Refer`='$totalrefer',`Referral_Income`='$refincome',`Spin`='$spin',`Refer_Code`='$refercode',`Refer_by`='$referby',`Status`='$accountstatus',`Level`='$level'  WHERE `Email`='$userEmail'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION["successMsg"] = "User Updated successfully";
            header("location:./users.php");
        } else {
            // echo "Data not update";
            $_SESSION["error"] = "User Not Update";
            header("location:./profile.php");
        }

    }
} else {
    header("location:../index.php");
}
?>