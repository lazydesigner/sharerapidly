<?php
include './connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';

// $query = "INSERT INTO  `customer_support`(name, email, message) VALUES ('{$_POST['name']}') ";

try {

    $query = $conn->prepare("INSERT INTO  `customer_support`(`name`, `email`, `message`) VALUES (?,?,?)");
    $query->bind_param('sss', $_POST['name'], $_POST['email'], $_POST['message']);
    $t = $query->execute();
    if ($t) {



        function Otp_Mail()
        {

            $email =  $_POST['email'];
            $name = $_POST['name'];

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            // $mail->Host = 'smtp.gmail.com';
            $mail->Host = 'smtp.titan.email';
            $mail->SMTPAuth = true;
            $mail->Username = 'contact@sharerapidly.com';
            $mail->Password = 'Smile@1427';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;  
            $mail->setFrom('contact@sharerapidly.com', 'ShareRapidly');
            // $mail->setFrom('deepakbaradwaj933@gmail.com', 'ShareRapidly');

            $mail->addAddress($email);
            $mail->addCC('deepakbaradwaj933@gmail.com');
            $mail->isHTML(true);

            $mail->Subject = 'Sharerapidly inquiry successfully submited';

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
        <h3>Hello $name,</h3>
        <h3>Welcome to the fastest data sharing network.</h3>
        <h4>Your inquiry has been received by us.</h4>
        <p>All inquiries are responded to you within 24 to 48 hours on business days.</p>
        <strong>Thank You</strong>
    </tr>
    </table>
     </body>
    </html>
    ";

            $mail->send();
            if (!$mail) {
                return false;
            } else {
                return true;
            }
        }

       $res =  Otp_Mail();

       if($res == 'true'){
        echo json_encode(['status'=>200]);
       }else{
        echo json_encode(['status'=>500]);
       }
    }
    $query->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['error' => $e]);
}
