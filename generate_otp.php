<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'){


function Generator_and_send(){
    $otp =  mt_rand(10000,99999);
    $_SESSION['otp'] = $otp;
    Otp_Mail($otp);
}

function Otp_Mail($otp){
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@sharerapidly.com';
    $mail->Password = 'Smile@1427';
    $mail->SMTPSecure = 'ssl';
    $mail->Port= 465;
    // 
    $mail->setFrom('contact@sharerapidly.com', 'ShareRapidly');
    
    $mail->addAddress($email);
    
    $mail->isHTML(true);
    
    $mail->Subject = 'Sharerapidly OTP Verification';
    
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
        <h3>Hello <span style='color:dodgerblue;'>$name</span> ,</h3>
        <h3>Welcome to the fastest data sharing network.</h3>
        <h4>A quick and secure way to share your data</h4>
        <p>Please Verify Your Email</p>
        <p style='width:100%;background-color:hotpink;'>Your OTP number : <b>$otp</b> </p>
        <strong>Thank You</strong>
    </tr>
    </table>
     </body>
    </html>
    ";
    
    $mail->send();
}
Generator_and_send();
}else{
    echo 'Not Working';
}
