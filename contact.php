<?php session_start(); include './fun.php' ?>
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
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }

        .contact-form-group input {
            display: block;
            width: 49%;
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

        .contact {
            display: block;
        }

        .animation {
            width: 300px;
            height: 100%;
            display: none;
        }
        @media screen and (max-width:770px) {
            .contact-form-group input {width: 49%;}
        }
        @media screen and (max-width:600px) {
            .contact-form-group input {width: 100%;}
        }
    </style>
</head>

<body>
    <div><?php include './navbar.php' ?></div>
    <div class="contact-body">
        <img src="https://lottie.host/8056dc47-663c-4e17-ace4-99e74d5090a1/6dSiJfdCgw.lottie" alt="">
        <div class="contact" id="contact">
            <h1 style="font-size: 2.5rem;">Contact Us</h1>
            <div>
                <p>If you have any questions please fill contact us Form or directly email us.</p>

                <p>All inquiries are responded to with in 24 to 48 hours on business days.</p>

                <p>You can directly email us at <a href="mailto:contact@sharerapidly.com">contact@sharerapidly.com </a> or send a request through the form below.</p>
            </div>
            <form method="post" id="contact-form">
                <div class="contact-form-group">
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
                </div>
                <div class="contact-form-group">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter Your Message" style="resize: none;" required></textarea>
                </div>
                <div class="contact-form-group">
                    <button><span>Send <i class="ri-send-plane-fill flyplan"></i></span></button>
                </div>
            </form>
        </div>
        <div class="animation" id="container">
        </div>
    </div>
    <div><?php include './footer.php' ?></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script>
        document.getElementById('menu_').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'grid';
        })
        document.getElementById('close').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'none';
        })

        const formData = new FormData();
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            formData.append('name', document.getElementById('name').value)
            formData.append('email', document.getElementById('email').value)
            formData.append('message', document.getElementById('message').value)
            document.getElementById('contact').style.display = 'none'
            document.getElementById('container').style.display = 'block'
            fetch('support', {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(d => {
                if (d['status'] == 200) {
                    this.reset()
                    document.getElementById('container').style.display = 'none'
                    document.getElementById('contact').style.display = 'block'
                }else{
                    alert("Error In Sending Mail")
                }
            })
        })
    </script>

    <script>
        var animation = bodymovin.loadAnimation({
            // animationData: { /* ... */ },
            container: document.getElementById('container'), // required
            path: 'assets/mail.json', // required
            renderer: 'svg', // required
            loop: true, // optional
            autoplay: true, // optional
        });
    </script>

</body>

</html>