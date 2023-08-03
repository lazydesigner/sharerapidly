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

        .error {
            color: white;
        }

        .container {
            width: 100%;
            height: auto;
            display: grid;
            justify-content: center;
            align-items: center;
            background-image: url("<?= base_url() ?>assets/images/a.webp");
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
    <div class="container">
        <div class="form-container">
            <div class="logo"><img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%"></div>
            <form class="form" method="post" id="form">
                <input type="text" value="signup_" name="username" id="signup" placeholder="" hidden>
                <div class="input-group">
                    <label for="username">Name*</label>
                    <span class="error" id="error1"></span>
                    <input type="text" pattern="[A-Za-z]+" name="username" id="username" placeholder="">
                </div>
                <div class="input-group">
                    <label for="username">Mobile no*</label>
                    <span class="error" id="error2"></span>
                    <input type="tel" name="mobile" maxlength="13" minlength="10" id="mobile" placeholder="">
                </div>
                <div class="input-group">
                    <label for="username">Email*</label>
                    <span class="error" id="error3"></span>
                    <input type="text" name="email" id="email" placeholder="">
                </div>
                <div class="input-group">
                    <label for="password">Password*</label>
                    <span class="error" id="error4"></span>
                    <input type="password" name="password" id="password" placeholder="">
                    <div class="">
                <p style="margin: 0 0 15px 0;color:tomato;">* all fields are required</p>
                    </div>
                </div>
                <button class="sign">Sign up</button> 
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
            </div>
            <p class="signup">Already have an account?
                <a rel="noopener noreferrer" href="<?= base_url() ?>signin" class="">log in</a>
            </p>
        </div>
    </div>

    <script>

        document.getElementById('username').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error1').innerText = "Username field can't be empty"
            }else{
                document.getElementById('error1').innerText = ""
            }
        })
        document.getElementById('mobile').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error2').innerText = "Mobile field can't be empty"
            }else{
                document.getElementById('error2').innerText = ""
            }
        })
        document.getElementById('email').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error3').innerText = "Email field can't be empty"
            }else{
                document.getElementById('error3').innerText = ""
            }
        })
        document.getElementById('password').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error4').innerText = "Password field can't be empty"
            }else if(this.value.length < 8){
                document.getElementById('error4').innerText = "Password Must be of 8 character"
            }else{
                document.getElementById('error4').innerText = ""
            }
        })

        document.getElementById('form').addEventListener('submit', function(e) {
            if (document.getElementById('username').value == '') {
                e.preventDefault()
                document.getElementById('error1').innerText = "Username field can't be empty"
            } else if (document.getElementById('mobile').value == '') {
                e.preventDefault()
                document.getElementById('error2').innerText = "Mobile field can't be empty"
            } else if (document.getElementById('email').value == '') {
                e.preventDefault()
                document.getElementById('error3').innerText = "Email field can't be empty"
            } else if (document.getElementById('password').value == '') {
                e.preventDefault()
                document.getElementById('error4').innerText = "password field can't be empty"
            } else {
                document.getElementById('form').action = "<?= base_url() ?>otp_verification"
            }
        })

        // function Signup(){
        //     let name = document.getElementById('username').value
        //         const formdata = new FormData();
        //         formdata.append('name', name);
        //         formdata.append('email', document.getElementById('email').value);
        //         formdata.append('mobile', document.getElementById('mobile').value);
        //         formdata.append('password', document.getElementById('password').value);
        //         formdata.append('sign', document.getElementById('signup').value)
        //         fetch('./cradential.php', {
        //                 method: 'POST',
        //                 body: formdata,
        //             }).then(res => res.json())
        //             .then((d) => {
        //                 if (d['success']) {
        //                     formdata.set('sign', 'login_')
        //                     Login(formdata)
        //                 } else if (d['error']) {
        //                     console.log(d['error'])
        //                 }
        //             })
        //             .catch((error) => {
        //                 console.log(error)
        //             })
        // }


        // function Login(formdata) {
        //     fetch('./cradential.php', {
        //             method: 'POST',
        //             body: formdata,
        //         }).then(res => res.json())
        //         .then((d) => {
        //             if (d['success'] == 'login') {
        //                 window.location = '<?php // base_url() ?>'
        //             }
        //         })
        //         .catch((error) => {
        //             console.log(error)
        //         })
        // }
    </script>
</body>

</html>