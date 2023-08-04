<?php include './fun.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Sharerapidly Contact Form</title>
    <style>
        header {
            background-color: rgb(42, 13, 61);
        }

        .contact-body {
            width: 100%;
            display: grid;
            place-items: center;
            padding: 5%;
        }

        .contact-form-group {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .contact-form-group input {
            display: block;
            width: 50%;
            height: 40px;
            padding: 1%;
            outline: 0;
            border: 1px solid lightgray;
            border-radius: 3px;
        }

        textarea {
            padding: 1%;
            width: 100%;
            outline: 0;
            border: 1px solid dodgerblue;
            border-radius: 3px;
        }

        input:focus {
            border: 1px solid dodgerblue;
        }

        textarea:not(:focus) {
            border: 1px solid lightgray;
        }

        .contact-form-group button {
            width: 100px;
        }

        .contact-form-group button span {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flyplan {
            color: red;
            font-size: xx-large;
            /* top: 10px;
            left: 30px; */
            animation: fly 10s linear infinite;
        }

        p {
            color: rgb(132, 132, 132);
            font-size: 18px;
        }

        @keyframes fly {
            0% {
                transform: translateY(25%);
            }

            25% {
                transform: translateY(-18%) rotate(4deg);
            }

            50% {
                transform: translateY(+26%) translateX(+26%) scale(.9, .7) skewX(10deg);
            }

            100% {
                transform: translateY(25%) rotateZ(10deg);
            }

        }
    </style>
</head>

<body>
    <div><?php include './navbar.php' ?></div>
    <div class="contact-body">
        <div class="contact">
            <h1 style="font-size: 2.5rem;">Contact Us</h1>
            <div>
                <p>If you have any questions please fill contact us Form or directly email us.</p>

                <p>All inquiries are responded to with in 24 to 48 hours on business days.</p>

                <p>You can directly email us at <a href="mailto:contact@sharerapidly.com">contact@sharerapidly.com </a> or send a request through the form below.</p>
            </div>
            <form action="" method="post">
                <div class="contact-form-group">
                    <input type="text" name="name" id="name" placeholder="Enter Your Name">
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                </div>
                <div class="contact-form-group">
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Enter Your Message" style="resize: none;"></textarea>
                </div>
                <div class="contact-form-group">
                    <button><span>Send <i class="ri-send-plane-fill flyplan"></i></span></button>
                </div>
            </form>
        </div>
    </div>
    <div><?php include './footer.php' ?></div>
    <script>
        document.getElementById('menu_').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'grid';
        })
        document.getElementById('close').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'none';
        })
    </script>
</body>

</html>