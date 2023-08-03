<?php include './fun.php' ?>
<?php

$url = $_GET['email'];
$key = explode('_', $url);

$email =  base64_decode($key[1])




?>
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
            height: auto;
            border-radius: 5px;
            border: 1px solid lightgrey;
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

        .password {
            width: 100%;
        }

        .password h1 {
            text-align: center;
        }

        .form-group {
            margin: 5% 5%;
        }

        .ok_done {
            color: green;
            display: none;
        }
    </style>
</head>

<body>
    <?php include './navbar.php' ?>
    <div class="container_forget">
        <div style="position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;overflow:hidden;"><img src="<?= base_url() ?>assets/images/a.webp" id="desk_image" width="100%" height="100%" alt="No Image"></div>
        <div class="reset" id="reset">
            <div class="password" id="password">
                <h1>Reset your password</h1>
                <div class="dashboard_pannel_content" id="dashboard_pannel_content">
                    <form method="POST" id="form">
                        <div class="form-group">
                            <label for="current">New Password</label><i id="ok_done" class="ri-checkbox-circle-fill ok_done"></i>
                            <input type="text" placeholder="Enter New Password" name="n_pass" id="n_pass" />
                            <p id="error4"></p>
                        </div>
                        <div class="form-group">
                            <label for="current">Confirm New Password</label><i id="ok_done" class="ri-checkbox-circle-fill ok_done"></i>
                            <input type="password" placeholder="Enter Confirm New Password" name="cn_pass" id="cn_pass" />
                            <p class="cn_error" id="cn_error"></p>
                        </div>
                        <div class="form-group" style="margin-top: 5%;text-align:center;">
                            <button class="dash_button" id="new_button" disabled>Update New Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php' ?>
    <script>
        document.getElementById('n_pass').addEventListener('keyup', function(e) {
            console.log('bhyhtu')
            e.preventDefault();
            var password = document.getElementById("cn_pass").value;
            if (!password == '') {
                if (password == this.value) {
                    document.getElementById('cn_error').innerText = '';
                    document.getElementById('new_button').removeAttribute('disabled')
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
                    document.getElementById('new_button').removeAttribute('disabled')
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

        document.getElementById('n_pass').addEventListener('keyup',function(){
            if(this.value == ""){
                document.getElementById('error4').innerText = "Password field can't be empty"
            }else if(this.value.length < 8){
                document.getElementById('error4').innerText = "Password Must be of 8 character"
            }else{
                document.getElementById('error4').innerText = "";
                document.getElementById('new_button').removeAttribute('disabled')
            }
        })

        document.getElementById('new_button').addEventListener('click', function(e) {
            e.preventDefault()
            const formdata = new FormData();
            formdata.append('columnName', 'new password');
            formdata.append('email', '<?=$email ?>');
            formdata.append('password', document.getElementById('n_pass').value)
            fetch('<?= base_url() ?>update', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then(d => {
                    if(d['success']){
                        fetch('<?= base_url() ?>password_changed', {
                            method: "POST",
                            body: formdata, 
                            credentials: 'include',
                        }).then(response => {})
                        document.getElementById('password').innerHTML = "<div style='padding:5%;text-align:center;'><h1>"+d['success']+"</h1> <a href='<?= base_url()?>signin'><button>SignIn</button></a> </div>"; 
                    }else if(d['error']){
                        document.getElementById('password').innerText = d['error']
                    }
                })
        })
    </script>

</body>

</html>