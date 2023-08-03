<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

if(isset($_POST['otp'])){
    $otp = $_POST["otp"];
    if($_SESSION['otp'] == $otp){
        unset($_SESSION['otp']);
        echo json_encode(['verified'=>'OTP Verified Successfully']);
    }else{
        echo json_encode(['un_verified'=>' OTP Does not match ']);
    }
}


?>