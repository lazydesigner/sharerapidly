<!-- wget -O /dev/null https://sharerapidly.com/automate/expiry-alert.php/   In every 1 minutes -->
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
$presentDate = date('Y-m-d H:i:s');

$previous_date =  date('Y-m-d H:i:s', strtotime($presentDate . ' -10 days'));
$One_day_before_previous_date =  date('Y-m-d H:i:s', strtotime($presentDate . ' -9 days'));

$day_of_expiry = date('Y-m-d H:i:s', strtotime($presentDate . ' 2 minutes'));
$query = "SELECT * FROM userdata INNER JOIN priceing ON userdata.plan = priceing.plan_id  WHERE `plan_end` BETWEEN '$presentDate.000000' AND '$day_of_expiry.000000'";
echo $query . '<br>';
// $query ="SELECT * FROM userdata WHERE plan_end BETWEEN ? AND ? ";
if ($res = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($res) > 0) {
        while($row = mysqli_fetch_assoc($res)){
            $update_query = "UPDATE userdata SET `plan` = 3, `plan_start`= '$previous_date', `plan_end` = '$One_day_before_previous_date', `data_transfer` = 0 WHERE `email` = '{$row['email']}' ";
            $res = mysqli_query($conn,$update_query);


            if($res){
                $update_query_file = "UPDATE user_share SET `link_status` = 'FALSE' WHERE user_id = {$row['id']}";
                $result = mysqli_query($conn,$update_query_file);
            }else{
                echo 'Plan Updated Successfully';
            }
            Otp_Mail($row['email'], $row['name'],$row['plan_name']);
        }
    } else {
        echo 'Mail Not Send' . '<br>';
    }
} else {
    echo mysqli_error($conn); 
}

function Otp_Mail($email,$name,$plan)
{


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

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'Sharerapidly Plan Expired!';

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
        <h3>Hello <span style='color:tomato;text-transform: capitalize;'>$name</span>,</h3>
        <h3>Your $plan Plan is Expired.</h3>
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
