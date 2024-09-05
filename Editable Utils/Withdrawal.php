<?php
// alter withdrawal table 

// ALTER TABLE withdrawal
// ADD COLUMN transaction_fee DECIMAL(10, 2) DEFAULT 0.00,
// ADD COLUMN transaction_duration TINYINT DEFAULT 0;


session_start();
if ($_SESSION["logedin"] === true && isset($_SESSION["logedin"])) {

    require("../Connections/Db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["withdrawl"])) {
        $id = mysqli_real_escape_string($connection, $_POST['tid']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $amount = mysqli_real_escape_string($connection, $_POST['amount']);
        $status = mysqli_real_escape_string($connection, $_POST['status']);

        $hash = mysqli_real_escape_string($connection, $_POST['hash']);
        echo $status;
        if (strtolower(str_replace(" ", "", $status)) == "rechazado") {
            $feeSql = "SELECT Fee FROM Withdrawal WHERE ID='$id' ";
            $feeQuary = mysqli_query($connection, $feeSql);
            $fee;
            while ($row = mysqli_fetch_assoc($feeQuary)) {
                global $fee;
                $fee = $row["Fee"];
            }
            echo $fee;
            $sql = "UPDATE `User`,Withdrawal  SET User.Total_Balance=User.Total_Balance+$amount+$fee,Withdrawal.Email='$email',Withdrawal.ID='$id',Withdrawal.Date='$date',Withdrawal.Amount='$amount',Withdrawal.Status='$status',Withdrawal.Hash='$hash'
             WHERE User.Email='$email' AND Withdrawal.Email='$email' AND `ID`='$id';";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $_SESSION["successMsg"] = "Withdrawal Updated successfully";
                header("location:../Pages/withdraws.php");
            } else {
                $_SESSION["error"] = "Withdraw Not Update";
                header("location:../Pages/withdraws.php");
            }






        } else {
            $sql = "UPDATE  `Withdrawal` SET `Email`='$email',`ID`='$id',`Date`='$date',`Amount`='$amount',`Status`='$status',`Hash`='$hash'  WHERE `Email`='$email' AND `ID`='$id'";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $_SESSION["successMsg"] = "Withdrawal Updated successfully";
                header("location:../Pages/withdraws.php");
            } else {
                $_SESSION["error"] = "Withdraw Not Update";
                header("location:../Pages/withdraws.php");
            }
            echo "com";
        }
    }

} else {
    header("location:../index.php");
}






?>