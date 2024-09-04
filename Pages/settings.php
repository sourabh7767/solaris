<div class="popupModal">
    <div class="modalBody">
        <div class="modalHeading">Confirm OTP</div>
        <input type="number" id="otpInputAdminSetting">
        <div class="modalAction">
            <button style="background-color: green !important;" onclick="modalConfirm()">Submit</button>
            <button onclick="modalCloser()">Cancel</button>
        </div>
    </div>
</div>
<div class="popupModal">
    <div class="modalBody">
        <div class="modalHeading">Confirm OTP</div>
        <input type="number" id="appSetting">
        <div class="modalAction">
            <button style="background-color: green !important;" onclick="submitAppSetting()">Submit</button>
            <button onclick="modalCloser()">Cancel</button>
        </div>
    </div>
</div>
<?php
session_start();
$adminData;
$result;

if (isset($_SESSION["logedin"])) {
    require("../Connections/Db.php");
    $sql = "SELECT * FROM `Admin`";
    $result = mysqli_query($connection, $sql);
    // while ($row = mysqli_fetch_assoc($result)) {}
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Settings</title>
    <link rel='icon' href='../Assets/Images/profile.png' type='image/png'>
    <link rel='stylesheet' href='https://admin.solarisbot.ai/Assets/Styles/styles.css'>
    <link rel='stylesheet' type='text/css'
    href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

</head>

<body>
    <div class='container'>
        <!-- Sidebar -->
        ";
require('../Bars/SideBar.php');
require("./Toaster.php");

echo "
        <!-- Main Content -->
        <div class='rightSlider'>
";

require('../Bars/TopBar.php');
echo "

<!-- Main Content -->

<div class='main' id='main'>

    <div class='dashboard' id='pages'>
        <div class='page-header'>
            <h3>Settings</h3>
        </div>

        <div class='settings-info'>
            <h2>App Settings</h2>
            <form id='appsettingForm'>
                <div class='form-group'>
                    <div class='form-group-pair'>
                        <label for='Adverstizing-Image'>Adverstizing Image</label>
                        ";

foreach ($row as $data) {
    if ($data["Name"] == "Advertising Image") {
        echo "<input type='text' id='Adverstizing-Image' readonly name='advertisingImg' value='" . $data["Value"] . "'/>";
    }
}
echo "
<input type='file' id='advertisingImageImg' name='advertisingImageImg' />

</div>
<div class='form-group-pair'>
    <label for='maintenance-Mode-Link'>Maintenance Mode Link</label>
    ";

foreach ($row as $data) {
    if ($data["Name"] == "Maintainence URL") {
        echo "<input type='text' id='Mantainance-Mode-Link' name='maintenanceUrl' value='" . $data["Value"] . "'/>";
        break;
    }
}

echo "
</div>
</div>
<div class='form-group'>
    <div class='form-group-pair'>
        <label for='Appeal-Link'>Appeal Link</label>
        ";
foreach ($row as $data) {
    if ($data["Name"] == "Appeal URL") {
        echo "<input type='text' id='Appeal-Link' name='appealUrl' value='" . $data["Value"] . "'/>";

    }
}
echo "
</div>
<div class='form-group-pair'>
    <label for='App-Version'>App Version</label>
    ";
foreach ($row as $data) {
    if ($data["Name"] == "App_Version") {
        echo "<input type='text' id='App-Version' name='appVersion' value='" . $data["Value"] . "'/>";
        break;
    }
}
?>
</div>
</div>
<div class='form-group'>
    <div class='form-group-pair'>
        <label for='UpdateURL'>Update URL</label>
        <?php
        foreach ($row as $data) {
            if ($data["Name"] == "Update URL") {
                echo "<input type='text' id='UpdateURL' name='updateURL' value='" . $data["Value"] . "' />";
                break;
            }
        }
        ?>
    </div>
    <div class='form-group-pair'>
        <label for='Maintainence_Mode'>Maintainence Mode</label>
        <?php
        foreach ($row as $data) {
            if ($data["Name"] == "Maintainence_Mode") {
                echo "
            <select name='maintenanceMode' value='" . $data["Value"] . "' id='maintenanceMode'>";
                if ($data["Value"] == "on") {
                    echo "
                <option value='on' >On</option>
                <option value='off'>Off</option>
                ";
                } else {
                    echo "
                <option value='off'>Off</option>
                <option value='on' >On</option>
                ";
                }
                echo "
            </select>";
            }
        }
        ?>
    </div>

</div>
<div class='form-group'>
    <div class='form-group-pair'>
        <label for='UpdateURL'>Upload Apk File</label>
        <?php
        foreach ($row as $data) {
            if ($data["Name"] == "Update URL") {
                echo "<input type='file' name='apkFile' />";
                break;
            }
        }
        ?>
    </div>
</div>
<div class='btn-container'>
    <button type='submit' name='appsetting'>Save</button>
</div>

</form>
</div>


<div class='settings-info'>
    <h2>Social Media Links</h2>
    <form id="socialMediaForm">

        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='WhatsApp-Link'>WhatsApp Link</label>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "WhatsApp Support") {
                        echo "<input type='text' id='WhatsApp-Link' name='whatsappUrl' value='" . $data["Value"] . "'>";
                        break;
                    }
                }
                echo "
            </div>
            <div class='form-group-pair'>
                <label for='Tiktok-Link'>Tiktok Link</label>
                "; ?>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "Tiktok Channel") {
                        echo "<input type='text' id='Tiktok-Link' name='tiktokUrl' value='" . $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Youtube-Link'>Youtube Link</label>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "Youtube Channel") {
                        echo "<input type='text' id='Youtube-Link' name='youtubeUrl' value='" . $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
            <div class='form-group-pair'>
                <label for='Instagram-Link'>Instagram Link</label>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "Instagram Channel") {
                        echo "<input type='text' id='Instagram-Link' name='instalUrl' value='" . $data["Value"] . "'>";
                        break;
                    }
                } ?>

            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Facebook-Link'>Facebook Link</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Facebook Channel") {
                        echo "<input type='text' id='Facebook-Link' name='facebookUrl' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>

            </div>
            <div class='form-group-pair'>
                <label for='Telegram-support'>Telegram Support</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Telegram Support") {
                        echo "<input type='text' id='Telegram-support' name='telegramUrl' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>

            </div>
        </div>
        <div class='form-group'>

            <div class='form-group-pair'>
                <label for='Facebook-Link'>Telegram Channel</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Telegram Channel") {
                        echo "<input type='text' id='Telegram_Channel' name='Telegram_Channel' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>

            </div>

            <div class='form-group-pair'>
                <label for='Telegram-support'>Tutorial Link</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Tutorial Link") {
                        echo "<input type='text' id='Tutorianl_Link' name='Tutorianl_Link' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>

            </div>

        </div>
        <div class='btn-container'>
            <button type='submit' name='socialMediaLinks'>Save</button>
        </div>

    </form>
</div>


<div class='settings-info'>
    <h2>Operation Settings</h2>
    <form id='operationSubmit'>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Operation-Time'>Operation Time</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Operation_Timer") {
                        echo "<input type='text' id='Operation-Time' name='optime' value='" . $data["Value"]
                            . "'>";
                        break;
                    }
                }
                ?>
            </div>
            <div class='form-group-pair'>
                <label for='Minimum-Operation'>Minimum Operation Blance</label>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "Minimum_OB") {
                        echo "<input type='text' id='Minimum-Operation' name='minimubOb' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Maximum-ROI'>Maximum ROI</label>
                <?php
                foreach ($row as $data) {
                    if ($data["Name"] == "ROI Max Value") {
                        echo "<input type='text' id='Maximum-ROI' name='maxRoi' value='" . $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
            <div class='form-group-pair'>
                <label for='Operation-Limit'>Operation Limit</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Operation_Limit") {
                        echo "<input type='text' id='Operation-Limit' name='opLimit' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>
            </div>
        </div>

        <div class='btn-container'>
            <button type='submit' name='operations'>Save</button>
        </div>

    </form>
</div>


<div class='settings-info'>
    <h2>Wallet Settings</h2>
    <form id='walletSubmit'>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Currency'>Deposit Currency</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Deposit Currency") {
                        echo "<input type='text' id='Deposit-Currency' name='depoCurrency' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                echo "
            </div>

            <div class='form-group-pair'>
                <label for='Deposit-Network'>Deposit Network</label>";
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Deposit Network") {
                        echo "<input type='text' id='Deposit-Network' name='depositNetwork' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Minimum_WB'>Minimum WB</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Minimum_WB") {
                        echo "<input type='text' id='Minimum_WB' name='Minimum_WB' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>
            </div>
            <div class='form-group-pair'>
                <label for='Minimun-Deposit'>Minimun Deposit</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Minimum Deposit") {
                        echo "<input type='text' id='Minimun-Deposit' name='minDeposit' value='" . $data["Value"]
                            . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Withdraw Network</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Withdraw Network") {
                        echo "<input type='text' id='Withdraw_Network' name='Withdraw_Network' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Withdraw Currency</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Withdraw Currency") {
                        echo "<input type='text' id='Withdraw_Currency' name='Withdraw_Currency' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Deposit Address</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Deposit_ Address") {
                        echo "<input type='text' id='Deposit-Address' name='depositAddress' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>

        <div class='btn-container'>
            <button type='submit' name='walletSetting'>Save</button>
        </div>

    </form>
</div>


<div class='settings-info'>
    <h2>Refferal Settings</h2>
    <form id='refferalSetting'>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Currency'>Bronze Deposit Commision</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Bronze Deposit Commision") {
                        echo "<input type='text' id='Bronze_Deposit_Commision' name='Bronze_Deposit_Commision' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>
            </div>

            <div class='form-group-pair'>
                <label for='Deposit-Network'>Silver Deposit Commission</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Silver Deposit Commission") {
                        echo "<input type='text' id='Silver_Deposit_Commission' name='Silver_Deposit_Commission' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Minimum_WB'>Gold Deposit Commission</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Gold Deposit Commission") {
                        echo "<input type='text' id='Gold_Deposit_Commission' name='Gold_Deposit_Commission' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                } ?>
            </div>
            <div class='form-group-pair'>
                <label for='Minimun-Deposit'>Bronze Operation Commission</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Bronze Operation Commission") {
                        echo "<input type='text' id='Bronze_Operation_Commission' name='Bronze_Operation_Commission' value='" . $data["Value"]
                            . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Silver Operation Commission</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Silver Operation Commission") {
                        echo "<input type='text' id='Silver_Operation_Commission' name='Silver_Operation_Commission' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Gold Opearation Commission</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Gold Opearation Commission") {
                        echo "<input type='text' id='Gold_Opearation_Commission' name='Gold_Opearation_Commission' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='Deposit-Address'>Spin Per Refer</label>
                <?php
                foreach ($row as $data) {
                    if
                    ($data["Name"] == "Spin Per Refer") {
                        echo "<input type='text' id='Spin_Per_Refer' name='Spin_Per_Refer' value='" .
                            $data["Value"] . "'>";
                        break;
                    }
                }
                ?>
            </div>
        </div>

        <div class='btn-container'>
            <button type='submit' name='walletSetting'>Save</button>
        </div>

    </form>
</div>


<div class='settings-info'>
    <h2>Update Profile Details</h2>
    <form id="profileUpdate" method="post">
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='updateemail'>Update Email</label>
                <input type='email' id='updateemail' placeholder="Enter your new email" name="adminemail" value=''>
            </div>

            <div class='form-group-pair'>
                <label for='updatepassword'>Update Password</label>
                <input type='password' id='updatepassword' placeholder="Please enter new Password " name="adminpassword"
                    value=''>
                <div class="viewPassword">
                    <input type='checkbox' id='viewPassword' />
                    <label for="viewPassword">Show Password</label>
                </div>
            </div>
        </div>
        <div class='form-group'>
            <div class='form-group-pair'>
                <label for='previousEmail'>Previous Email</label>
                <input type='email' id='previousEmail' readonly name="previousEmail" value='<?php
                $sql = "SELECT * FROM `admin_login`";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row["Email"];
                    }


                }

                ?>'>
            </div>
        </div>
        <div class='btn-container'>
            <button type='submit' name="updateProfile">Update Profile</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
<div class="loader" id="activeLoader">
    <svg version="1.1" id="L3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="40"
        width="40" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
        <circle fill="none" stroke="white" stroke-width="4" cx="50" cy="50" r="44" style="opacity:0.5;" />
        <circle fill="#fff" stroke="#e74c3c" stroke-width="3" cx="8" cy="54" r="6">
            <animateTransform attributeName="transform" dur="2s" type="rotate" from="0 50 48" to="360 50 52"
                repeatCount="indefinite" />

        </circle>
    </svg>
    <p>Please wait</p>
</div>
<script src="../Assets/Scripts/Settings.js"></script>
<script src="../Assets/Scripts/ToasterCOnfig.js"></script>

</body>

</html>";