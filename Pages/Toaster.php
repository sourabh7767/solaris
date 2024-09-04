<?php
if (isset($_SESSION["successMsg"])) {
    if (isset($_SESSION["successMsg"]) && $_SESSION["successMsg"] !== "") {
        $msg = $_SESSION["successMsg"];
        echo '<div class="toastModal" style="--toasterModalBackColor:green;">
        <span> ' . $msg . '</span>
        <button onClick="ToasterCloser()" >&times;</button>
        </div>
        
        <script src="../Assets/Scripts/index.js"></script>';
        unset($_SESSION["successMsg"]);
    }
} else {
    if (isset($_SESSION["errorMsg"]) && $_SESSION["errorMsg"] !== "") {
        $msg = $_SESSION["errorMsg"];
        echo '<div class="toastModal" style="--toasterModalBackColor:green;">
        <span> ' . $msg . '</span>
        <button onClick="ToasterCloser()" >&times;</button>
        </div>
        
        <script src="../Assets/Scripts/index.js"></script>
        ';
        unset($_SESSION["errorMsg"]);
    }

}

?>

