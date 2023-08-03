<?php include './fun.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <title>sign form</title>
    <style>
        body,
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            height: 100%;
            display: grid;
            justify-content: center;
            align-items: center;
            background-image: url("<?= base_url() ?>assets/images/a.webp");
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        .form-container {
            width: 340px;
            ;
            border-radius: 0.75rem;
            /* background-image:url("./assets/images/a.webp"); */
            padding: 3rem;
            color: rgba(243, 244, 246, 1);
            background-color: #ffffff10;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .title {
            width: auto;


        }

        .form {
            margin-top: 1.5rem;
        }

        .input-group {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .input-group label {
            display: block;
            color: black;
            margin-bottom: 4px;
            font-size: larger;
        }

        .input-group input {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid rgba(55, 65, 81, 1);
            outline: 0;
            /* background-color: rgba(17, 24, 39, 1); */
            padding: 0.75rem 2%;
            color: black;
        }

        .input-group input:focus {
            border-color: rgba(167, 139, 250);
        }

        .forgot {
            display: flex;
            justify-content: flex-end;
            font-size: 0.75rem;
            line-height: 1rem;
            color: black;
            margin: 8px 0 14px 0;
        }

        .forgot a,
        .signup a {
            color: darkblue;
            text-decoration: none;
            font-size: 14px;
        }

        .signup a {
            font-size: 1rem;
        }

        .forgot a:hover,
        .signup a:hover {
            text-decoration: underline rgba(167, 139, 250, 1);
        }

        .sign {
            display: block;
            width: 100%;
            background-color: rgba(167, 139, 250, 1);
            padding: 0.75rem;
            text-align: center;
            color: rgba(17, 24, 39, 1);
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
        }

        .social-message {
            display: flex;
            align-items: center;
            padding-top: 1rem;
        }

        .line {
            height: 1px;
            flex: 1 1 0%;
            background-color: black;
        }

        .social-message .message {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            font-size: 1rem;
            line-height: 1.25rem;
            color: black;
            font-weight: 500;
        }

        .social-icons {
            display: flex;
            justify-content: center;
        }

        .social-icons .icon {
            border-radius: 0.125rem;
            padding: 0.75rem;
            border: none;
            background-color: transparent;
            margin-left: 8px;
        }

        .social-icons .icon svg {
            height: 1.25rem;
            width: 1.25rem;
            fill: black;
        }

        .signup {
            text-align: center;
            font-size: 1.5rem;
            line-height: 1rem;
            color: black;
            font-weight: 500;
        }

        .success {
            display: none;
            position: fixed;
            width: 500px;
            height: 60px;
            border-radius: 10px;
            margin: auto;
            top: 10%;
            left: 31%;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            z-index: 15;
        }
    </style>
</head>

<body>
    <div class="success" id="success"></div>
    <div class="container">
        <div class="form-container">
            <div><img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%"></div>
            <form class="form" id="form">
                <input type="text" name="username" id="login" value="login_" placeholder="" hidden>
                <div class="input-group">
                    <label for="username">Email</label>
                    <input type="email" name="username" id="email" placeholder="">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="">
                    <div class="forgot">
                        <a rel="noopener noreferrer" href="<?= base_url() ?>resetpassword">Forgot Password ?</a>
                    </div>
                </div>
                <button class="sign">Sign in</button>
            </form>
            <div class="social-message">
                <div class="line"></div>
                <p class="message">Login with social accounts</p>
                <div class="line"></div>
            </div>
            <div class="social-icons">
                <button aria-label="Log in with Google" class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2443" height="2500" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262" id="google">
                        <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                        <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                        <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                        <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                    </svg>
                    </svg>
                </button>
                <button aria-label="Log in with Twitter" class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Ebene 1" viewBox="0 0 1024 1024" id="facebook-logo-2019">
                        <path fill="#1877f2" d="M1024,512C1024,229.23016,794.76978,0,512,0S0,229.23016,0,512c0,255.554,187.231,467.37012,432,505.77777V660H302V512H432V399.2C432,270.87982,508.43854,200,625.38922,200,681.40765,200,740,210,740,210V336H675.43713C611.83508,336,592,375.46667,592,415.95728V512H734L711.3,660H592v357.77777C836.769,979.37012,1024,767.554,1024,512Z"></path>
                        <path fill="#fff" d="M711.3,660,734,512H592V415.95728C592,375.46667,611.83508,336,675.43713,336H740V210s-58.59235-10-114.61078-10C508.43854,200,432,270.87982,432,399.2V512H302V660H432v357.77777a517.39619,517.39619,0,0,0,160,0V660Z"></path>
                    </svg>
                </button>
                <!-- <button aria-label="Log in with GitHub" class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                        <path
                            d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.38-0.009-1.385-0.015-2.719-4.453 0.964-5.391-2.151-5.391-2.151-0.729-1.844-1.781-2.339-1.781-2.339-1.448-0.989 0.115-0.968 0.115-0.968 1.604 0.109 2.448 1.645 2.448 1.645 1.427 2.448 3.744 1.74 4.661 1.328 0.14-1.031 0.557-1.74 1.011-2.135-3.552-0.401-7.287-1.776-7.287-7.907 0-1.751 0.62-3.177 1.645-4.297-0.177-0.401-0.719-2.031 0.141-4.235 0 0 1.339-0.427 4.4 1.641 1.281-0.355 2.641-0.532 4-0.541 1.36 0.009 2.719 0.187 4 0.541 3.043-2.068 4.381-1.641 4.381-1.641 0.859 2.204 0.317 3.833 0.161 4.235 1.015 1.12 1.635 2.547 1.635 4.297 0 6.145-3.74 7.5-7.296 7.891 0.556 0.479 1.077 1.464 1.077 2.959 0 2.14-0.020 3.864-0.020 4.385 0 0.416 0.28 0.916 1.104 0.755 6.4-2.093 10.979-8.093 10.979-15.156 0-8.833-7.161-16-16-16z">
                        </path>
                    </svg>
                </button> -->
            </div>
            <p class="signup">Don't have an account?
                <a rel="noopener noreferrer" href="<?= base_url() ?>signup" class="">Sign up</a>
            </p>
        </div>
    </div>
    <script>
        document.getElementById('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formdata = new FormData();
            formdata.append('email', document.getElementById('email').value);
            formdata.append('password', document.getElementById('password').value);
            formdata.append('sign', document.getElementById('login').value)
            fetch('./cradential.php', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then((d) => {
                    if (d['success'] == 'login') {
                        window.location = '<?= base_url() ?>'
                    } else if (d['error']) {
                        document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                        document.getElementById('success').innerHTML = d['error'];
                        setTimeout(function() {
                            document.getElementById('success').style.cssText = "display: none;"
                        }, 1500)
                    }
                })
        })
    </script>
</body>

</html>