<?php include './fun.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <title>Reset Password</title>
    <style>
        header {
            background-color: rgb(42, 13, 61);
        }

        .container_forget {
            width: 100%;
            height: 100%;
            display: grid;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .reset {
            width: 400px;
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

        .reset input {
            display: block;
            width: 350px;
            height: 40px;
            border-radius: 5px;
            border: 1px solid lightslategray;
            margin: auto;
            outline: 0;
            padding: 1%;
        }

        .reset_btn {
            margin: 5%;
            width: 150px;
        }
        .verify_ot{
            display: grid;
            place-items: center;
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

        .dot-spinner {
            --uib-size: 2.8rem;
            --uib-speed: .9s;
            --uib-color: #183153;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: var(--uib-size);
            width: var(--uib-size);
        }

        .dot-spinner__dot {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 100%;
            width: 100%;
        }

        .dot-spinner__dot::before {
            content: '';
            height: 20%;
            width: 20%;
            border-radius: 50%;
            background-color: var(--uib-color);
            transform: scale(0);
            opacity: 0.5;
            animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
            box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
        }

        .dot-spinner__dot:nth-child(2) {
            transform: rotate(45deg);
        }

        .dot-spinner__dot:nth-child(2)::before {
            animation-delay: calc(var(--uib-speed) * -0.875);
        }

        .dot-spinner__dot:nth-child(3) {
            transform: rotate(90deg);
        }

        .dot-spinner__dot:nth-child(3)::before {
            animation-delay: calc(var(--uib-speed) * -0.75);
        }

        .dot-spinner__dot:nth-child(4) {
            transform: rotate(135deg);
        }

        .dot-spinner__dot:nth-child(4)::before {
            animation-delay: calc(var(--uib-speed) * -0.625);
        }

        .dot-spinner__dot:nth-child(5) {
            transform: rotate(180deg);
        }

        .dot-spinner__dot:nth-child(5)::before {
            animation-delay: calc(var(--uib-speed) * -0.5);
        }

        .dot-spinner__dot:nth-child(6) {
            transform: rotate(225deg);
        }

        .dot-spinner__dot:nth-child(6)::before {
            animation-delay: calc(var(--uib-speed) * -0.375);
        }

        .dot-spinner__dot:nth-child(7) {
            transform: rotate(270deg);
        }

        .dot-spinner__dot:nth-child(7)::before {
            animation-delay: calc(var(--uib-speed) * -0.25);
        }

        .dot-spinner__dot:nth-child(8) {
            transform: rotate(315deg);
        }

        .dot-spinner__dot:nth-child(8)::before {
            animation-delay: calc(var(--uib-speed) * -0.125);
        }

        @keyframes pulse0112 {

            0%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }
        }

    </style>
</head>

<body>
    <?php include './navbar.php' ?>
    <div class="container_forget">
        <div style="position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;overflow:hidden;"><img src="<?= base_url() ?>assets/images/a.webp" id="desk_image" width="100%" height="100%" alt="No Image"></div>
        <div class="reset" id="reset">
            <div class="verify_ot" id="verify_ot">
                <h1>Enter Your Email</h1><input type="email" name="email" id="email" placeholder="Enter Your Email"><button id="reset_btn" class="reset_btn">Reset Password</button>
            </div>
        </div>
    </div>
    <?php include './footer.php' ?>


    <script>
        document.getElementById('reset_btn').addEventListener('click', function() {
            var email = document.getElementById('email').value;
            const formdata = new FormData();
            formdata.append('columnName', 'User_Exist');
            formdata.append('email', email);
            fetch('<?= base_url() ?>update', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then(d => {
                    if (d['success']) {
                        document.getElementById('verify_ot').innerHTML = '<h2>' + d['success'] + '</h2> <a href="<?= base_url() ?>signup"><button>SignUp</button></a>';
                    } else if (d['error']) {
                        document.getElementById('verify_ot').innerHTML='<div class="dot-spinner" style="margin-top:15%;"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div>';
                        fetch('<?= base_url() ?>resetpasswordlink', {
                            method: "POST",
                            body: formdata, 
                            credentials: 'include',
                        }).then(response => {
                            if (response.status == 200) {
                                document.getElementById('verify_ot').innerHTML = '<h2>A Password Reset Link Has Been sent To Your Email ' + email + ' .</h2>';
                            } else {
                                document.getElementById('verify_ot').innerHTML = '<h2> Email NOT SEND</h2>';
                                console.log(response)
                            }
                        })
                    }
                })


        })
    </script>

</body>

</html>