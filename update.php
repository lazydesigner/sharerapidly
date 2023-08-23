    <?php
    session_start();

    ini_set('session.gc_maxlifetime', 3600);
    session_set_cookie_params(3600);
    include './connection.php';
    date_default_timezone_set('Asia/Kolkata');
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    if ($data['columnName'] == 'download_count') {
        $count =  $data['count'];
        $url = $data['url'];

        //update the count in database
        $id = explode('/', $url);
        $id = base64_decode($id[4]);

        if (isset($_SESSION['user'])) {
            $sql = "UPDATE user_share SET download_count='$count' WHERE identification = '$id'";
        } else {
            $sql = "UPDATE sharething SET download_count='$count' WHERE identification = '$id'";
        }
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {

            if (isset($_SESSION['user'])) {
                $sql = "SELECT download_count FROM user_share WHERE identification = '$id'";
            } else {
                $sql = "SELECT download_count FROM sharething WHERE identification = '$id'";
            }
            $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if ($res) {
                echo json_encode(['id' => $res["download_count"], 'spec' => 'download_count']);
            } else {
                echo json_encode(['id' => 'update data.', 'spec' => 'expiry']);
            }
        } else {
            echo json_encode(['id' => 'failed to update data.', 'spec' => 'download_count']);
        }
    } elseif ($data['columnName'] == 'expiry') {

        // delete from db if expiry date is passed
        $presentDate = date('Y-m-d H:i:s');
        $count =  $data['count'];
        $url = $data['url'];
        $id = explode('/', $url);
        $id = base64_decode($id[4]);
        $date = date('Y-m-d H:i:s', strtotime($presentDate . '+' . $count . ' days'));

        if (isset($_SESSION['user'])) {
            $sql = "UPDATE user_share SET expiry='$date' WHERE identification = '$id'";
        } else {
            $sql = "UPDATE sharething SET expiry='$date' WHERE identification = '$id'";
        }
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {
            echo json_encode(['id' => $count, 'spec' => 'expiry']);
        } else {
            echo json_encode(['id' => 'failed to update data.', 'spec' => 'expiry']);
        }
    } elseif ($_POST['columnName'] == 'Update name') {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['password'] == hash('sha256', $_POST['password'])) {
                $sql = "UPDATE `userdata` SET name='{$_POST['value']}'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['user'] = $_POST['value'];
                    echo json_encode(['success' => 'Update Successfully <i class="ri-emotion-laugh-line"></i>', 'name' => $_POST['value']]);
                } else {
                    echo json_encode(['error' => 'Update Unsuccessfully <i class="ri-emotion-unhappy-fill"></i>']);
                }
            } else {
                echo json_encode(['error' => 'Password is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
            }
        }
    } elseif ($_POST['columnName'] == 'Update email') {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['password'] == hash('sha256', $_POST['password'])) {
                $sql = "UPDATE userdata SET `email` = '{$_POST['value']}'";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($result) {
                    $_SESSION['user_email'] = $_POST['value'];
                    echo json_encode(['success' => 'Update Successfully <i class="ri-emotion-laugh-line"></i>']);
                } else {
                    echo json_encode(['error' => 'Update Unsuccessfully <i class="ri-emotion-unhappy-fill"></i>']);
                }
            } else {
                echo json_encode(['error' => 'Password is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
            }
        }
    } elseif ($_POST['columnName'] == 'Update mobile') {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['password'] == hash('sha256', $_POST['password'])) {
                $sql = "UPDATE userdata SET `mobile` = {$_POST['value']}";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($result) {
                    echo json_encode(['success' => 'Update Successfully <i class="ri-emotion-laugh-line"></i>']);
                } else {
                    echo json_encode(['error' => 'Update Unsuccessfully <i class="ri-emotion-unhappy-fill"></i>']);
                }
            } else {
                echo json_encode(['error' => 'Password is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
            }
        }
    } elseif ($_POST['columnName'] == 'delete user') {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['password'] == hash('sha256', $_POST['password'])) {
                if ($_SESSION['user_email'] == $_POST['value']) {
                    $sql = "DELETE FROM `userdata` WHERE id = {$_SESSION['user_id']}";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        session_unset();  # Unset all of the session variables
                        session_destroy(); // Destroying All Sessions of User.
                        echo json_encode(["success" => "Account Deleted Successfully <i class='ri-emotion-laugh-line'></i>"]);
                        // header("Location:" . base_url());
                    } else {
                        echo json_encode(['error' => 'Something Went Wrong Please Try Again <i class="ri-emotion-unhappy-fill"></i>']);
                    }
                } else {
                    echo json_encode(['error' => 'Email is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
                }
            } else {
                echo json_encode(['error' => 'Password is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
            }
        }
    } elseif ($_POST['columnName'] == 'update password') {
        if (isset($_SESSION['user'])) {

            $oldpassword = hash('sha256', $_POST['old_password']);
            $newpassword = hash('sha256', $_POST['new_password']);
            if ($_SESSION['password'] == $oldpassword) {
                $sql = "UPDATE userdata SET `password` = '$newpassword' WHERE id = {$_SESSION['user_id']}";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo json_encode(["success" => "Password is Successfully Changed <i class='ri-emotion-laugh-line'></i>"]);
                    session_unset();  # Unset all of the session variables
                    session_destroy(); // Destroying All Sessions of User.
                } else {
                    echo json_encode(['error' => 'Something Went Wrong Please Try Again <i class="ri-emotion-unhappy-fill"></i>']);
                }
            } else {
                echo json_encode(['error' => 'Password is Incorrect <i class="ri-emotion-unhappy-fill"></i>']);
            }
        }
    } elseif ($_POST['columnName'] == 'User_Exist') {
        $login = "SELECT * FROM userdata WHERE email = '{$_POST['email']}'";
        $login_result = mysqli_query($conn, $login);
        if (mysqli_num_rows($login_result) > 0) {
            // email already exists in database 
            echo json_encode(['error' => 'User With This Email (' . $_POST['email'] . ') already exist']);
        } else {
            echo json_encode(['success' => 'User does Not Exist ' . $_POST['email']]);
        }
    } else if ($_POST['columnName'] == 'new password') {
        $password = hash('sha256', $_POST['password']);
        $new = "UPDATE userdata SET `password` = '$password' WHERE `email` = '{$_POST['email']}'";
        $res = mysqli_query($conn,$new);
        if($res){
            echo json_encode(['success'=>'Password Updated Successfully']);
        }else{
            echo json_encode(['error'=>'Something went wrong please try later!']);
        }
    } else if ($data['columnName'] == 'file_protection') {
        $count = $data['protection'];
        $url = $data['url'];

        //update the count in database
        $id = explode('/', $url);
        $id = base64_decode($id[4]);
            $sql = "UPDATE user_share SET password_protected=$count WHERE identification = '$id'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {
            echo 'done';
        }else{
            echo 'error';
        }
    }else if ($data['columnName'] == 'file_password') {
        $url = $data['url'];
        $pass = $data['value'];
        //update the count in database  
        $id = explode('/', $url);
        $id = base64_decode($id[4]);
            $sql = "UPDATE user_share SET file_password = '$pass' WHERE identification = '$id'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {
            echo 'done';
        }else{
            echo 'error';
        }
    } else if ($data['columnName'] == 'file_password_check') {
        $url = $data['slug'];
        $pass = $data['password'];
        //update the count in database  
        $sql = "SELECT * FROM `user_share` WHERE identification = '$url'";
        $result = mysqli_query($conn, $sql)or die (mysqli_error($conn));
        while ($row=mysqli_fetch_assoc($result)){
            $pass_to_match = $row["file_password"];
            if($pass_to_match == $pass){
                echo json_encode(['status'=>200]);
            }else{
                echo json_encode(["status"=>513,"message"=>"Password does not match"]);
            }
        }
    } else {
        echo json_encode(['id' => 'Query Error', 'spec' => 'expiry']);
    }
    ?>