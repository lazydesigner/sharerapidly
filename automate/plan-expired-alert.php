<!-- wget -O /dev/null https://sharerapidly.com/automate/plan-expired-alert.php/       In A day-->
<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include '../fun.php';
include '../connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/src/Exception.php';
require '../phpMailer/src/PHPMailer.php';
require '../phpMailer/src/SMTP.php';

function Otp_Mail($email, $name)
{
}


$presentDate = date('Y-m-d H:i:s');
$day_of_expiry = date('Y-m-d H:i:s', strtotime($presentDate . ' 3 days'));
$query = "SELECT * FROM userdata INNER JOIN priceing ON userdata.plan = priceing.plan_id WHERE `plan_end` BETWEEN '$presentDate.000000' AND '$day_of_expiry.000000'";
echo $query . '<br>';
// $query ="SELECT * FROM userdata WHERE plan_end BETWEEN ? AND ? ";
if ($res = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo $row['email'] . '<br>';
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

            $mail->addAddress($row['email']);

            $mail->isHTML(true);

            $mail->Subject = 'Sharerapidly Plan Expiry Alert!';

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
                <h2>Hello <span style='color:tomato;text-transform: capitalize;'>{$row['name']}</span>,</h2>
                <h3>Your {$row['plan_name']} Plan is Expiring Soon.</h3>
                <h4>Renew Your Plan to continue your Awesome services By clicking the link below</h4>
                <p><strong><a href='https://sharerapidly.com/priceing' target='_blank'>Renew Now</a></strong></p>
                <strong>Thank You</strong>
            </tr>
            </table>
            </body>
            </html>
            ";

            $mail->send();
        }
    } else {
        echo 'Mail Not Send' . '<br>';
    }
} else {
    echo mysqli_error($conn);
}
