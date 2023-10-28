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
    <title>DashBoard</title>
    <style>
        .dashboard_menu,
        header {
            background-color: rgb(42, 13, 61);
        }
        body{user-select: none;}
        @media screen and (max-width:770px) {
         .dashboard_pannel { width: 72%; }}
    </style>
</head>

<body>

    <div class="dashboard_page_navbar"><?php include "./navbar.php"; ?></div>
    <div class="dashboard_container">
        <div class="dashboard_">
            <div class="dashboard_menu" id="dashboard_menu">
                <!-- <div class="dashboard_logo">
                    <img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%" alt="">
                </div> -->
                <div class="dash_toggle" id="dash_toggle"><i class="ri-arrow-left-circle-line"></i></div>
                <nav class="dashboard_nav">
                    <ul>
                        <div><li onclick="menu_option('profile')"><a><i class="ri-account-circle-fill"></i>Profile</a></li>
                        <li onclick="menu_option('file')"><a class="active"><i class="ri-file-fill"></i>My Files</a></li>
                        <li onclick="menu_option('password')"><a><i class="ri-lock-2-fill"></i>Password</a></li>
                        <li onclick="menu_option('subscription')"><a><i class="ri-price-tag-fill"></i>Subscription</a></li></div>
                        <div><li><a href="<?= base_url() ?>logout"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                        <li onclick="menu_option('delete')"><a><i class="ri-delete-bin-5-fill"></i>Delete Account</a></li></div>
                    </ul>
                </nav>
            </div>
            <div class="dashboard_pannel">
                <div>
                    <div class="dash_toggle2" id="dash_toggle2"><i class="ri-arrow-right-circle-line"></i></div>
                </div>
                <div class="files">
                    <div>
                        <h1>List Of Files</h1>
                    </div>
                    <div class="dashboard_files" id="dashboard_pannel_content">
                        <!-- <table class="table" style="position: sticky;top:0;background-color:white; margin-bottom:2px">
                            <thead class="thead">
                                <tr>
                                    <th>Name</th>
                                    <th>link</th>
                                    <th>Max Download</th>
                                    <th>created</th>
                                    <th>Expiry</th>
                                </tr>
                            </thead>
                        </table> -->
                        <table class="table">
                        <thead class="thead"  style="position: sticky;top:0;background-color:white; margin-bottom:2px">
                                <tr>
                                    <th>Name</th>
                                    <th>link</th>
                                    <th>Max Download</th>
                                    <th>created</th>
                                    <th>Expiry</th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                        <!-- </table> -->
                            <tbody>
                                <?php

                                $sql = "SELECT * FROM userdata AS t1 INNER JOIN user_share AS t2 ON t1.id = t2.user_id WHERE t1.email ='{$_SESSION['user_email']}' && t1.id = {$_SESSION['user_id']} ";
                                // $sql = "SELECT * FROM `userdata` WHERE id = {$_SESSION['user_id']} && email = '{$_SESSION['user_email']}'";
                                $result = mysqli_query($conn, $sql);
                                $samelink = "";
                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $timestamp = strtotime($row['expiry']);
                                            $normalTime = date("Y-m-d H:i:s", $timestamp);
                                            $timestamp2 = strtotime($row['created']);
                                            $normalTime2 = date("Y-m-d H:i:s", $timestamp2);
                                            if($row['link_status'] == 'TRUE'){
                                                
                                                if($samelink == $row['link']){
                                                   echo '
                                                <tr class="table_data">
                                                    <td>' . $row['image'] . '</td>
                                                    <td><a href="' . $row['link'] . '" target="_blank">' . $row['link'] . '</a></td>
                                                    <td>' . $row['download_count'] . '</td>
                                                    <td>' . $normalTime2 . '</td>
                                                    <td>' . $normalTime . '</td>
                                                </tr>
                                            ';
                                                    $samelink = $row['link'];
                                                    }                                                
                                            }else{
                                                echo '
                                                <tr class="table_data" style="color:grey;">
                                                    <td>' . $row['image'] . '</td>
                                                    <td><a href="' . $row['link'] . '" target="_blank" style="text-decoration: line-through;pointer-events: none;cursor: default;cursor: not-allowed;color:lightgrey;">' . $row['link'] . '</a></td>
                                                    <td>' . $row['download_count'] . '</td>
                                                    <td>' . $normalTime2 . '</td>
                                                    <td>' . $normalTime . '</td>
                                                </tr>
                                            ';
                                            }
                                           
                                        }
                                    } else {
                                        echo 'Not found' . mysqli_error($conn);
                                    }
                                } else {
                                    echo mysqli_error($conn);
                                }
                                ?>
                            </tbody>
                        </table>
                        
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
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>

</body>

</html>
<?php

function formatBytes($bytes)
{
    if ($bytes > 0) {
        $i = floor(log($bytes) / log(1024));
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . ' ' . @$sizes[$i];
    } else {
        return 0;
    }
}
}else{
    header("Location:".base_url()."signin");
}
?>
