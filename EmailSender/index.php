<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header("Access-Control-Allow-Origin: *");
require("../Connections/Db.php");
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == "GET") {

    $rawData = file_get_contents("php://input");
    $sql = "SELECT * FROM `admin_login`";
    $result = mysqli_query($connection, $sql);
    $otp = "";
    $email = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row["Email"];
    }
    $genOtp = rand(1000, 9999);
    $massage = "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Admin OTP Email</title>
        <style>
            @media only screen and (max-width: 600px) {
                .email-container {
                    width: 100% !important;
                    padding: 10px !important;
                }
    
                .otp-code {
                    font-size: 20px !important;
                    padding: 8px 16px !important;
                }
    
                .email-content h2 {
                    font-size: 22px !important;
                }
    
                .email-content p {
                    font-size: 14px !important;
                }
            }
        </style>
    </head>
    
    <body style='font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; margin: 0;'>
        <table class='email-container' width='100%' border='0' cellspacing='0' cellpadding='0'
            style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border: 1px solid #dddddd;'>
            <tr>
                <td class='email-content' style='text-align: center;'>
                    <h2 style='color: #333333; margin-top: 0;'>Setting Change Verification Code</h2>
                    <p style='color: #666666;'>Please use the following code to change admin settings</p>
                    <div style='margin: 20px 0; text-align: center;'>
                        <span class='otp-code'
                            style='display: inline-block; background-color: #bfcad6; color: #ffffff; font-size: 24px; font-weight: bold; padding: 10px 20px; border-radius: 4px; letter-spacing: 5px;'>
                           $genOtp
                        </span>
                    </div>
                    <p style='color: #666666;'>If you did not request an OTP, please ignore this email or contact support.
                    </p>
                    <p style='color: #666666; margin-top: 20px;'>Best regards,</p>
                    <p style='color: #666666;'>The Security Team</p>
                </td>
            </tr>
        </table>
    </body>
    
    </html>";

    if ($email != "" && $massage != "") {


        require 'vendor/autoload.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer();
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'ah9883195134@gmail.com';                     //SMTP username
            $mail->Password = 'wrhs pboa uifw rayl';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('ah9883195134@gmail.com', 'Admin Verification');
            $mail->addAddress($email, 'Admin');     //Add a recipient        
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Details Settings';
            $mail->Body = $massage;
            if ($mail->send()) {

                $sql = "UPDATE `admin_login` SET `admin_login`.`otp`='$genOtp'";
                $result = mysqli_query($connection, $sql);
                if ($result) {
                    echo json_encode(array("status" => "success"));
                }
            } else {
                echo json_encode(array("status" => "error"));
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "enter a email and masssege body";
    }

}