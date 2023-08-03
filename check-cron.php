<?php
session_start();
include './fun.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'){


function Otp_Mail(){
     
    $email =  'deepakbaradwaj933@gmail.com';
    $domain = 'share_';
    $a = base64_encode($email);
    $identity = $domain . $a . '_rapidly';

    
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@sharerapidly.com';
    $mail->Password = 'Smile@1427';
    $mail->SMTPSecure = 'ssl';
    $mail->Port= 465;
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'deepakbaradwaj933@gmail.com';
    // $mail->Password = 'sjkosmmlnbabblmm';
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port= 465;
    // 
    $mail->setFrom('contact@sharerapidly.com', 'ShareRapidly');
    // $mail->setFrom('deepakbaradwaj933@gmail.com', 'ShareRapidly');
    
    $mail->addAddress($email);
    
    $mail->isHTML(true);
    
    $mail->Subject = 'Sharerapidly Reset Password Link';
    
    $mail->Body = "
    <html>
    <head>
    <title>OTP Verification</title>
    </head>
    <body>
    <table>
    <tr>
        <div style='width:600px;height:200px;background-color: rgb(42, 13, 61);padding:2%;box-sizing: border-box;'>
            <div style='width:100%;height:100%;'>
                <img src='https://sharerapidly.com/assets/images/logo.png' width='100%' height='100%' >
            </div>
        </div>
        <h3>Hello Deepak,</h3>
        <h3>Welcome to the fastest data sharing network.</h3>
        <h4>A quick and secure way to share your data</h4>
        <p>You will receive this main very hour</p>
        <strong>Thank You</strong>
    </tr>
    </table>
     </body>
    </html>
    ";
    
    $mail->send();
}

Otp_Mail();

}else{
    echo 'Not Working';
}
