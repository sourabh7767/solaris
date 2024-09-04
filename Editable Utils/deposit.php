<?php
session_start();
if (isset($_SESSION["logedin"])) {
    require("../Connections/Db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deposit"])) {
        $id = mysqli_real_escape_string($connection, $_POST['tid']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $amount = mysqli_real_escape_string($connection, $_POST['amount']);
        $status = mysqli_real_escape_string($connection, $_POST['status']);
        $hash = mysqli_real_escape_string($connection, $_POST['hash']);
        if ($status == "Completado") {
            global $referBy;
            global $referPersonLevel;
            global $bronze;  //admin db commision 
            global $silver; //admin db commision 
            global $gold; //admin db commision 
            global $totalReferalPercent;
            $usersql = "SELECT User.Refer_by FROM `User` WHERE `Email`='$email'";
            $userResult = mysqli_query($connection, $usersql);
            while ($row = mysqli_fetch_assoc($userResult)) {
                $referBy = $row["Refer_by"];
            }

            // fetch refer person
            $usersql = "SELECT * FROM `User` WHERE `Refer_Code`='$referBy'";
            $userResult = mysqli_query($connection, $usersql);

            while ($row = mysqli_fetch_assoc($userResult)) {
                $referPersonLevel = $row["Level"];
            }
            // admin level commission
            $admin = "SELECT * FROM `Admin` ";
            $admindb = mysqli_query($connection, $admin);

            while ($row = mysqli_fetch_assoc($admindb)) {
                switch ($row["ID"]) {
                    case 134:
                        $bronze = $row["Value"];
                        break;
                    case 136:
                        $silver = $row["Value"];
                        break;
                    case 138:
                        $gold = $row["Value"];
                        break;
                }
            }


            switch ($referPersonLevel) {
                case "Bronze":
                    $totalReferalPercent = $bronze;
                    break;
                case "Silver":
                    $totalReferalPercent = $silver;
                    break;
                case "Gold":
                    $totalReferalPercent = $gold;
                    break;
            }

            $commision = (($amount * $totalReferalPercent) / 100);

        
            $sql = "UPDATE  `Deposit` SET `Email`='$email',`ID`='$id',`Date`='$date',`Amount`='$amount',`Status`='$status'  WHERE `Email`='$email' AND `ID`='$id';
            UPDATE `User` SET Total_Balance=Total_Balance+$commision, Spin= Spin+1,Referral_Income=Referral_Income+$commision  WHERE `Refer_Code`='$referBy';
            UPDATE `User` SET Total_Balance=Total_Balance+$amount  WHERE `Email`='$email';
            UPDATE `Refer` SET Reward=Reward+$commision  WHERE `Email`='$email';";
            $result = mysqli_multi_query($connection, $sql);
            if ($result) {
                $_SESSION["successMsg"] = "Deposit Updated successfully";
                header("location:../Pages/deposits.php");
            } else {
                $_SESSION["error"] = "Deposit Not Update";
                header("location:../Pages/deposits.php");
            }
        } else {
            $totalB = 0;
            $getSql = "SELECT Total_Balance FROM `User` WHERE `Email`='$email'";
            $result = mysqli_query($connection, $getSql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalB += $row["Total_Balance"];
                }
                $totalB += $amount;
                echo $totalB;
                echo $totalB;
                $sql = "UPDATE  `Deposit` SET `Email`='$email',`ID`='$id',`Date`='$date',`Amount`=$amount,`Status`='$status',`Hash`='$hash'  WHERE `Email`='$email' AND `ID`='$id';
                        UPDATE  `User` SET `Total_Balance`='$totalB';";
                $update_result = mysqli_multi_query($connection, $sql);
                if ($update_result) {
                    $_SESSION["successMsg"] = "Deposit Updated successfully";
                    header("location:../Pages/deposits.php");

                }
            } else {
                $_SESSION["error"] = "Deposit Not Update";
                header("location:../Pages/deposits.php");
            }





        }
    }




} else {
    header("location:../index.php");
}







?>