<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
// error_reporting(0);
include './fun.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <title>OTP Verification</title>
    <style>
        header {
            background-color: rgb(42, 13, 61);
        }

        .container_otp {
            width: 100%;
            height: 100%;
            display: grid;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .verify {
            width: auto;
            padding: 1%;
            height: 200px;
            border-radius: 5px;
            border: 1px solid lightgrey;
            text-align: center;
            color: #f3f4f6;
            background-color: #ffffff10;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px)
        }

        .verify input {
            display: block;
            width: 350px;
            height: 40px;
            border-radius: 5px;
            border: 1px solid lightslategray;
            margin: auto;
            outline: 0;
            padding: 1%;
        }

        .verify_btn {
            margin: 5%;
            width: 150px;
        }

        .success {
            display: none;
            position: fixed;
            width: 500px;
            height: 60px;
            border-radius: 10px;
            margin: auto;
            top: 10%;
            left: 30%;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .verify_ot {
            display: none;
        }

        .verify_ {
            display: block;
        }
    </style>
</head>

<body>

    <?php include './navbar.php'; ?>
    <div class="success" id="success"></div>
    <div class="container_otp">
        <div style="position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;overflow:hidden;"><img src="<?= base_url() ?>assets/images/a.webp" id="desk_image" width="100%" height="100%" alt="No Image"></div>
        <div class="verify" id="verify">
            <div class="verify_ot" id="verify_ot">
                <h1>Enter Your OTP</h1><input type="text" name="otp" id="otp" placeholder="Enter OTP"><button id="verify_btn" class="verify_btn" disabled>Verify</button>
            </div>
            <div class="verify_" id="verify_">
                <h1>OTP has been send to <?= $_POST['email'] ?></h1>
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>

    <script>
        IfUser()

        function IfUser() {
            const formdata = new FormData()
            formdata.append('columnName', 'User_Exist')
            formdata.append('email', '<?= $_POST['email'] ?>')
            formdata.append('name', '<?= $_POST['username'] ?>')
            fetch('<?= base_url() ?>update', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then(d => {
                    if (d['success']) {
                        document.getElementById('verify').style.width = '400px';
                        document.getElementById('verify_ot').style.cssText = ' display:block';
                        document.getElementById('verify_').style.cssText = ' display:none';
                        // User Does Not Exist
                        fetch('<?= base_url() ?>generate_otp', {
                            method: 'POST',
                            body: formdata,
                        }).then((res) => {
                            if (res.status == 200) {
                                document.getElementById('success').style.cssText = "display: flex;background-color:cadetblue;";
                                document.getElementById('success').innerHTML = 'OTP SENDED';
                                document.getElementById('verify_btn').removeAttribute('disabled')
                                setTimeout(function() {
                                    document.getElementById('success').style.cssText = "display: none;"
                                }, 2000)
                            } else {
                                document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                                document.getElementById('success').innerHTML = 'OTP FAILED SEND';
                                setTimeout(function() {
                                    document.getElementById('success').style.cssText = "display: none;"
                                }, 2000)
                            }
                        }).catch(error => console.log(error))
                    } else if (d['error']) {
                        document.getElementById('verify').innerHTML = '<h1><?= $_POST['email'] ?> Already Exist</h1><a href="<?= base_url() ?>signin"><button>SignIn</button></a>';
                    }
                })
        }


        document.getElementById('verify_btn').addEventListener('click', function(e) {
            e.preventDefault();
            var otp = document.getElementById("otp").value;
            const formdata = new FormData()
            formdata.append('otp', otp)
            if (otp == '') {
                document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                document.getElementById('success').innerHTML = 'PLEASE ENTER OTP';
                setTimeout(function() {
                    document.getElementById('success').style.cssText = "display: none;"
                }, 2000)
            } else {
                fetch('otp_', {
                        method: "POST",
                        // credentials: 'include',
                        body: formdata,
                    }).then(res => res.json())
                    .then((d) => {
                        if (d['verified']) {
                            document.getElementById('success').style.cssText = "display: flex;background-color:cadetblue;";
                            document.getElementById('success').innerHTML = d['verified'];
                            setTimeout(function() {
                                document.getElementById('success').style.cssText = "display: none;"
                            }, 2000)
                            Signup()
                        } else if (d['un_verified']) {
                            document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                            document.getElementById('success').innerHTML = d['un_verified'];
                            setTimeout(function() {
                                document.getElementById('success').style.cssText = "display: none;"
                            }, 2000)
                        }
                    })
            }
        })


        function Signup(){
                const formdata = new FormData();
                formdata.append('name', '<?= $_POST['username'] ?>');
                formdata.append('email','<?= $_POST['email'] ?>');
                formdata.append('mobile', <?= $_POST['mobile'] ?>);
                formdata.append('password', '<?= $_POST['password'] ?>');
                formdata.append('sign', 'signup_')
                fetch('./cradential.php', {
                        method: 'POST',
                        body: formdata,
                    }).then(res => res.json())
                    .then((d) => {
                        if (d['success']) {
                            formdata.set('sign', 'login_')
                            Login(formdata)
                        } else if (d['error']) {
                            console.log(d['error'])
                        }
                    })
        }


        function Login(formdata) {
            fetch('./cradential.php', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then((d) => {
                    if (d['success'] == 'login') {
                        window.location = '<?= base_url() ?>'
                    }
                })
        }
    </script>

</body>

</html>