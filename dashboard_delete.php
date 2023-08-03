<?php session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';
include './fun.php' ;

if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashboard.css">
    <title>Delete Your Account || sharerapidly</title>
    <style>
        .dashboard_menu,
        header {
            background-color: rgb(42, 13, 61);
        }
        .dashboard_container {
    height: 110%;
}
    </style>
</head>

<body>
    <div class="success" id="success"></div>
    <div class="dashboard_container">
        <div class="dashboard_page_navbar"><?php include "./navbar.php"; ?></div>
        <div class="dashboard_">
            <div class="dashboard_menu" id="dashboard_menu">
                <!-- <div class="dashboard_logo">
                <img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%" alt="">
            </div> -->
            <div class="dash_toggle" id="dash_toggle"><i class="ri-arrow-left-circle-line"></i></div>
                <nav class="dashboard_nav">
                    <ul>
                      <div>  <li onclick="menu_option('profile')"><a><i class="ri-account-circle-fill"></i>Profile</a></li>
                        <li onclick="menu_option('file')"><a><i class="ri-file-fill"></i>My Files</a></li>
                        <li onclick="menu_option('password')"><a><i class="ri-lock-2-fill"></i>Password</a></li>
                        <li onclick="menu_option('subscription')"><a><i class="ri-price-tag-fill"></i>Subscription</a></li></div>
                        <div><li><a href="<?= base_url() ?>logout"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                        <li onclick="menu_option('delete')"><a class="active"><i class="ri-delete-bin-5-fill"></i>Delete Account</a></li></div>
                    </ul>
                </nav>
            </div>
            <div class="dashboard_pannel">
            <div>
                    <div class="dash_toggle2" id="dash_toggle2"><i class="ri-arrow-right-circle-line"></i></div>
                </div>
                <div class="delete">
                    <h1>Delete your account</h1>
                    <!-- <p>By filling out the form below, you can entirely remove your sharerapidly.com account, along with all of your data and settings.</p> -->
                    <div class="warning">
                        <div class="warning_symbol"><i class="ri-alert-fill"></i></div>
                        <div class="warning_content">
                            <p>Attention! By completing the form below, you can permanently delete your sharerapidly.com account and all of your content. Once destroyed, your account cannot be recovered in any manner.</p>
                        </div>
                    </div>

                    <form method="POST" id="form">
                        <div class="form-group">
                            <label for="current">Email</label>
                            <input type="email" placeholder="Enter Your Email" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="current">Password</label><i id="ok_done" class="ri-checkbox-circle-fill"></i>
                            <input type="password" placeholder="Enter Password" name="n_pass" id="n_pass" />
                        </div>
                        <div class="form-group">
                            <label for="current">Confirm Password</label><i id="ok_done" class="ri-checkbox-circle-fill ok_done"></i>
                            <input type="text" placeholder="Enter Confirm Password" name="cn_pass" id="cn_pass" />
                            <p class="cn_error" id="cn_error"></p>
                        </div>
                        <div class="form-group" style="margin-top: 5%;">
                            <button class="dash_button" id="del_button" disabled><i class="ri-delete-bin-5-line" style="color: tomato;"></i>Delete</button>
                        </div>
                    </form>
                    <div class="dashboard_pannel_content" id="dashboard_pannel_content"></div>
                </div>
            </div>
        </div>
    </div>
    <div class=""><?php include "./footer.php"; ?></div>
    <script>
        function menu_option(option) {
            if (option == 'profile') {
                window.location.href = '<?= base_url() ?>account/profile';
            } else if (option == 'file') {
                window.location.href = '<?= base_url() ?>account/files';
            } else if (option == 'password') {
                window.location.href = '<?= base_url() ?>account/password';
            } else if (option == 'subscription') {
                window.location.href = '<?= base_url() ?>account/subscription';
            } else if (option == 'delete') {
                window.location.href = '<?= base_url() ?>account/delete';
            }
        }
        document.getElementById('n_pass').addEventListener('keyup', function(e) {
            e.preventDefault();
            var password = document.getElementById("cn_pass").value;
            if (!password == '') {
                if (password == this.value) {
                    document.getElementById('cn_error').innerText = '';
                    document.getElementById('del_button').removeAttribute('disabled')
                    a = document.querySelectorAll("#ok_done");
                    for (var i in a) {
                        a[i].style.display = "inline-block";
                    }
                } else {
                    document.getElementById('cn_error').innerText = "Confirm Password Does Not Match";
                    a = document.querySelectorAll("#ok_done");
                    for (var i in a) {
                        a[i].style.display = "none";
                    }
                }
            }

        });
        document.getElementById('cn_pass').addEventListener('keyup', function(e) {
            e.preventDefault();
            var password = document.getElementById("n_pass").value;
            if (!this.value=='') {
                if (password == this.value) {
                    document.getElementById('cn_error').innerText = '';
                    document.getElementById('del_button').removeAttribute('disabled')
                    a = document.querySelectorAll("#ok_done");
                    for (var i in a) {
                        a[i].style.display = "inline-block";
                    }
                } else {
                    document.getElementById('cn_error').innerText = "Confirm Password Does Not Match";
                    a = document.querySelectorAll("#ok_done");
                    for (var i in a) {
                        a[i].style.display = "none";
                    }
                }
            }else{document.getElementById('cn_error').innerText = '';}

        });

        document.getElementById('form').addEventListener('submit', function(e) {
            e.preventDefault()
            let pass1 = document.getElementById('n_pass').value;
            let pass2 = document.getElementById('cn_pass').value;
            if (pass1 == pass2) {
                let email = document.getElementById('email').value;
                const formdata = new FormData();
                formdata.append('columnName', 'delete user')
                formdata.append('value', email)
                formdata.append('password', pass1)
                fetch('<?= base_url() ?>update', {
                        method: 'POST',
                        body: formdata,
                    }).then(res => res.json())
                    .then(d => {
                        if (d['error']) {
                            document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                            document.getElementById('success').innerHTML = d['error'];
                            setTimeout(function() {
                                document.getElementById('success').style.cssText = "display: none;"
                            }, 1500)
                        }else{
                            window.location.href = "<?=base_url()."signin"?>";
                        }
                    })
            } else {
                document.getElementById('success').style.cssText = "display: flex;background-color:tomato;";
                document.getElementById('success').innerHTML = 'Password Does Not Match <i class="ri-emotion-unhappy-fill"></i>';
                setTimeout(function() {
                    document.getElementById('success').style.cssText = "display: none;"
                }, 1500)
            }

        })
        toggle1 = document.getElementById("dash_toggle")
        toggle2 = document.getElementById("dash_toggle2")

        toggle2.addEventListener('click',function(){
            document.getElementById("dashboard_menu").style.transform = 'translateX(0px)'
            toggle2.style.display='none'
            toggle1.style.display='block'
        })
        toggle1.addEventListener('click',function(){
            document.getElementById("dashboard_menu").style.transform = 'translateX(-260px)'
            toggle1.style.display='none'
            toggle2.style.display='block'
        })
        document.getElementById('menu_').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'grid';
        })
        document.getElementById('close').addEventListener('click', function() {
            document.getElementById('mobile_nav').style.display = 'none';
        })
    </script>

</body>

</html>
<?php
}else{
    header("Location:".base_url()."signin");
}
?>