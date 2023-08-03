<?php session_start();
include './connection.php';
include './fun.php';
if(isset($_SESSION['user'])){ ?>
<?php
$sql = "SELECT * FROM userdata  WHERE email ='{$_SESSION['user_email']}' && id = {$_SESSION['user_id']} ";
// $sql = "SELECT * FROM `userdata` WHERE id = {$_SESSION['user_id']} && email = '{$_SESSION['user_email']}'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
}
?>
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
    <div class="dashboard_container pro_dash" id="pro_dash">
        <div class="dashboard_page_navbar"><?php include "./navbar.php"; ?></div>
        <div class="dashboard_ pro_dash" id="pro_dash">
            <div class="dashboard_menu">
                <!-- <div class="dashboard_logo">
                    <img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%" alt="">
                </div> -->
                <nav class="dashboard_nav">
                    <ul>
                        <li onclick="menu_option('profile')"><a class="active"><i class="ri-account-circle-fill"></i>Profile</a></li>
                        <li onclick="menu_option('file')"><a><i class="ri-file-fill"></i>My Files</a></li>
                        <li onclick="menu_option('password')"><a><i class="ri-lock-2-fill"></i>Password</a></li>
                        <li onclick="menu_option('subscription')"><a><i class="ri-price-tag-fill"></i>Subscription</a></li>
                        <li><a href="<?= base_url() ?>logout"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                        <li onclick="menu_option('delete')"><a><i class="ri-delete-bin-5-fill"></i>Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <div class="dashboard_pannel">
                <div class="profile">
                    <h1>Your profile</h1>
                    <div class="dashboard_pannel_content" id="dashboard_pannel_content">

                        <div class="user_detail">
                            <div class="_name_">
                                <div class="name_tag"><strong> Name :</strong></div>
                                <div class="name" id="name_display"><?= $row['name'] ?></div>
                                <div class="name_edit" onclick="edit_field('name')"><i class="ri-edit-box-line"></i></div>
                            </div>
                            <div class="_name_">
                                <div class="name_tag"><strong> Email :</strong></div>
                                <div class="name"><?= $row['email'] ?></div>
                                <div class="name_edit" onclick="edit_field('email')"><i class="ri-edit-box-line"></i></div>
                            </div>
                            <div class="_name_">
                                <div class="name_tag"><strong> Phone :</strong></div>
                                <div class="name"><?= $row['mobile'] ?></div>
                                <div class="name_edit" onclick="edit_field('mobile')"><i class="ri-edit-box-line"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form_update" id="Edit_Form">

                        <form method="post" id="formsubmit">
                            <div class="form-group" id="field_to_update">

                            </div>
                            <div class="form-group">
                                <label for="current">Enter Password</label>
                                <input type="text" placeholder="Enter Password" name="n_pass" id="n_pass" required />
                            </div>
                            <div class="form-group">
                                <button>Update</button>
                            </div>
                        </form>
                    </div>
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

        function edit_field(field) {
            if (field == 'name') {
                document.getElementById('Edit_Form').style.display = "block";
                document.getElementById('pro_dash').style.height = "auto";
                document.getElementById('field_to_update').innerHTML = '<label for="current" id="current_update_field">Update ' + field + '</label><input type="text" value="<?= $row['name'] ?>" placeholder="Update Field" name="c_pass" id="_update_field" required  />'
            } else if (field == 'email') {
                document.getElementById('Edit_Form').style.display = "block";
                document.getElementById('pro_dash').style.height = "auto";
                document.getElementById('field_to_update').innerHTML = '<label for="current" id="current_update_field">Update ' + field + '</label><input type="email" value="<?= $row['email'] ?>" placeholder="Update Field" name="c_pass" id="_update_field" required  />'
            } else if (field == 'mobile') {
                document.getElementById('Edit_Form').style.display = "block";
                document.getElementById('pro_dash').style.height = "auto";
                document.getElementById('field_to_update').innerHTML = '<label for="current" id="current_update_field">Update ' + field + '</label><input type="tel" value="<?= $row['mobile'] ?>" placeholder="Update Field" name="c_pass" id="_update_field" required  />'
            }
        }


        document.getElementById('formsubmit').addEventListener('submit', function(e) {
            e.preventDefault()
            var data = document.getElementById('_update_field').value;
            var pass = document.getElementById('n_pass').value;
            var identity = document.getElementById('current_update_field').innerText;
            const formdata = new FormData();
            formdata.append('columnName', identity)
            formdata.append('value', data)
            formdata.append('password', pass)
            fetch('<?= base_url() ?>update', {
                    method: 'POST',
                    body: formdata,
                }).then(res => res.json())
                .then(d => {
                    if (d['name'] && d['success']) {
                        document.getElementById('user_nav_name').innerHTML = '' + d['name'] + '<i class="ri-arrow-down-s-fill"></i>';
                        document.getElementById("name_display").innerHTML = d['name']
                        document.getElementById('success').style.cssText = "display: flex;background-color:cadetblue;";
                        document.getElementById('success').innerHTML = d['success'];
                        setTimeout(function() {
                            document.getElementById('success').style.cssText = "display: none;"
                        }, 1500)
                        document.getElementById('pro_dash').style.height = "100%";
                        document.getElementById('Edit_Form').style.display = "none";
                    } else if (d['success']) {
                        document.getElementById('success').style.cssText = "display: flex;background-color:cadetblue;";
                        document.getElementById('success').innerHTML = d['success'];
                        setTimeout(function() {
                            document.getElementById('success').style.cssText = "display: none;"
                        }, 1500)
                        document.getElementById('pro_dash').style.height = "100%";
                        document.getElementById('Edit_Form').style.display = "none";
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
<?php
}else{
    header("Location:".base_url()."signin");
}
?>