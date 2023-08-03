<?php session_start();
include './connection.php';
include './fun.php';

if(isset($_SESSION['user'])){ ?>
<?php

function formatBytes($bytes)
{
    if ($bytes > 0) {
        $i = floor(log($bytes) / log(1024));
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . '' . @$sizes[$i];
    } else {
        return 0;
    }
}
$sql = "SELECT * FROM userdata AS t1 INNER JOIN priceing AS t2 ON t1.plan = t2.plan_id WHERE t1.email ='{$_SESSION['user_email']}' && t1.id = {$_SESSION['user_id']} ";
// $sql = "SELECT * FROM `userdata` WHERE id = {$_SESSION['user_id']} && email = '{$_SESSION['user_email']}'";
$result = mysqli_query($conn, $sql);
if($result){
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
                        <li onclick="menu_option('password')"><a><i class="ri-lock-2-fill"></i>Password</a></li>
                        <li onclick="menu_option('subscription')"><a class="active"><i class="ri-price-tag-fill"></i>Subscription</a></li>
                        <li><a href="<?= base_url() ?>logout"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                        <li onclick="menu_option('delete')"><a><i class="ri-delete-bin-5-fill"></i>Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <div class="dashboard_pannel">
                <div class="plan">
                    <h1>Plan subscription details</h1>
                    <div class="dashboard_plan" id="dashboard_pannel_content">
                        <div class="current_plan">
                            <h2>Current Plan</h2>
                            <p><?= $row['plan_name'] ?></p>
                        </div>
                        <div class="max_upload_size">
                            <h2>Max Upload Size</h2>
                            <p><?= $row['total_storage'] ?></p>
                        </div>
                        <div class="max_storage">
                            <h2>Max Storage</h2>
                            <p><?= $row['upload_size'] ?></p>
                        </div>
                        <div class="storage">
                            <h2>Used Storage</h2>
                            <p><?=formatBytes($row['data_transfer'])?> / <?= $row['total_storage'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 2147483648 B  -->

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
    </script>

</body>

</html>
<?php
}else{
    header("Location:".base_url()."signin");
}
?>