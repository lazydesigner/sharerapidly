<?php session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';
include './fun.php';

if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashboard.css">
        <title>DashBoard</title>
        <style>
            .dashboard_menu,
            header {
                background-color: rgb(42, 13, 61);
            }
        </style>
    </head>

    <body>
        <div class="success" id="success"></div>

        <div class="dashboard_container">
            <div class="dashboard_page_navbar"><?php include "./navbar.php"; ?></div>
            <div class="dashboard_">
                <div class="dashboard_menu">
                    <!-- <div class="dashboard_logo">
                <img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%" alt="">
            </div> -->
                    <nav class="dashboard_nav">
                        <ul>
                            <li onclick="menu_option('profile')"><a><i class="ri-account-circle-fill"></i>Profile</a></li>
                            <li onclick="menu_option('file')"><a><i class="ri-file-fill"></i>My Files</a></li>
                            <li onclick="menu_option('password')"><a class="active"><i class="ri-lock-2-fill"></i>Password</a></li>
                            <li onclick="menu_option('subscription')"><a><i class="ri-price-tag-fill"></i>Subscription</a></li>
                            <li><a href="<?= base_url() ?>logout"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                            <li onclick="menu_option('delete')"><a><i class="ri-delete-bin-5-fill"></i>Delete Account</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="dashboard_pannel">
                    <div class="password">
                        <h1>Change your password</h1>
                        <div class="dashboard_pannel_content" id="dashboard_pannel_content">
                            <form method="POST" id="form">
                                <div class="form-group">
                                    <label for="current">Current Password</label>
                                    <input type="password" placeholder="Enter Current Password" name="c_pass" id="c_pass" />
                                </div>
                                <div class="form-group">
                                    <label for="current">New Password</label><i id="ok_done" class="ri-checkbox-circle-fill ok_done"></i>
                                    <input type="text" placeholder="Enter New Password" name="n_pass" id="n_pass" />
                                    <p style="font-size:smaller;color:tomato;" id="error4"></p>
                                    </div>
                                <div class="form-group">
                                    <label for="current">Confirm New Password</label><i id="ok_done" class="ri-checkbox-circle-fill ok_done"></i>
                                    <input type="password" placeholder="Enter Confirm New Password" name="cn_pass" id="cn_pass" />
                                    <p class="cn_error" id="cn_error"></p>
                                </div>
                                <div class="form-group" style="margin-top: 5%;">
                                    <button class="dash_button" id="update_button"><i class="ri-save-2-line"></i>Update New Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class=""><?php include "./footer.php"; ?></div>
        <script>
            document.getElementById('n_pass').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error4').innerText = "Password field can't be empty";
            }else if(this.value.length < 8){
                document.getElementById('error4').innerText = "Password Must be of 8 character";
            }else{
                document.getElementById('error4').innerText = "";
            }
        })
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
                        document.getElementById('update_button').removeAttribute('disabled')
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
                if (!this.value == '') {
                    if (password == this.value) {
                        document.getElementById('cn_error').innerText = '';
                        document.getElementById('update_button').removeAttribute('disabled')
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
                } else {
                    document.getElementById('cn_error').innerText = '';
                    a = document.querySelectorAll("#ok_done");
                    for (var i in a) {
                        a[i].style.display = "none";
                    }
                }

            });

            document.getElementById('form').addEventListener('submit', function(e) {
                e.preventDefault()
                let pass = document.getElementById('c_pass').value;
                let pass1 = document.getElementById('n_pass').value;
                let pass2 = document.getElementById('cn_pass').value;
                if (pass1 == pass2) {
                    const formdata = new FormData();
                    formdata.append('columnName', 'update password')
                    formdata.append('old_password', pass)
                    formdata.append('new_password', pass1)
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
                            } else if (d['success']) {
                                document.getElementById('success').style.cssText = "display: flex;background-color:cadetblue;";
                                document.getElementById('success').innerHTML = d['success'];
                                window.location.href = "<?= base_url() . "signin" ?>";
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
        </script>

    </body>

    </html>
<?php
} else {
    header("Location:" . base_url() . "signin");
}
?>