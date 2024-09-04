<?php
if (isset($_SESSION["invalidUser"])) {
    if (isset($_SESSION["invalidUser"]) && $_SESSION["invalidUser"] !== "") {
        $msg = $_SESSION["invalidUser"];
        echo '<div class="toastModal" style="--toasterModalBackColor:red;">
        <span> ' . $msg . '</span>
        <button onClick="ToasterCloser()" >&times;</button>
        </div>';
        unset($_SESSION["successMsg"]);
    }
} else {
    if (isset($_SESSION["successMsg"]) && $_SESSION["successMsg"] !== "") {
        $msg = $_SESSION["successMsg"];
        echo '<div class="toastModal" style="--toasterModalBackColor:red;">
        <span> ' . $msg . '</span>
        <button onClick="ToasterCloser()" >&times;</button>
        </div>';
        unset($_SESSION["successMsg"]);
        session_destroy();
    }

}

?>

<script src="../Assets/Scripts/index.js"></script>