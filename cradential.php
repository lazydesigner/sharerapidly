<?php
include './connection.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ($_POST['sign'] == 'signup_') {
        if (!$_POST['name'] == '') { 
            if (!$_POST['email'] == '') {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (!$_POST['mobile'] == '') {
                        if (!$_POST['password'] == '') {
        
                            $login = "SELECT * FROM userdata WHERE email = '$email'";
                            $login_result = mysqli_query($conn, $login);
                            if (mysqli_num_rows($login_result) > 0) {
                                // email already exists in database 
                                echo json_encode(['error' => 'User With This Email(' . $email . ') already exist']);
                            } else {
                                //Create new account if user is not register
                                //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $password = hash('sha256', $_POST['password']);
                                // $password = $_POST['password'];
                                $sql = "INSERT INTO `userdata`( `name`,`email`,`mobile`,`password`) VALUES ('{$_POST['name']}','$email',{$_POST['mobile']},'$password') ";
                                if (mysqli_query($conn, $sql)) {
                                    echo json_encode(['success' => 'success', 'email' => $_POST['email'], 'password' => $_POST['password']]);
                                } else {
                                    echo json_encode(['error' => mysqli_error($conn)]);
                                }
                            }
                        } else {
                            echo json_encode(['error' => 'Password Field Is Required <i class="ri-emotion-unhappy-fill"></i>']);
                        }
                    } else {
                        echo json_encode(['error' => 'Mobile Field Is Required <i class="ri-emotion-unhappy-fill"></i>']);
                    }
    
                } else {
                    echo json_encode(['error' => 'Email Is Not Valid <i class="ri-mail-close-fill"></i>']);
                }
                
            } else {
                echo json_encode(['error' => 'Email Field Is Required <i class="ri-mail-close-fill"></i>']);
            }
        } else {
            echo json_encode(['error' => 'Name Field Is Required <i class="ri-emotion-unhappy-fill"></i>']);
        }
    } elseif ($_POST['sign'] == 'login_') {
        if (!$_POST['email'] == '') {
            if (!$_POST['password'] == '') {
                //If user is authorised login else show error
                // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // $password = $_POST['password'];
                $password = hash('sha256', $_POST['password']);
                $sql = "SELECT * FROM `userdata` WHERE `email` = '{$_POST['email']}' AND `password` = '$password' ";
                //sql query
                $result = mysqli_query($conn, $sql);
                // checking if user is present with this credential details
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Storing user data into session
                        session_start();
                        $_SESSION["user"] = $row['name'];
                        $_SESSION["user_id"] = $row['id'];
                        $_SESSION["user_email"] = $row['email'];
                        $_SESSION["password"] = $row['password'];
                        //Rediredting to home page
                        echo json_encode(['success' => 'login']);
                    }
                }else{
                    echo json_encode(['error'=>"Error! Email or Password Incorrect <i class='ri-emotion-unhappy-fill'></i>"]);
                }
            } else {
                echo json_encode(['error' => 'Password Field Is Required <i class="ri-emotion-unhappy-fill"></i>']);
            }
        } else {
            echo json_encode(['error' => 'Email Field Is Required <i class="ri-mail-close-fill"></i>']);
        }
    }
}
//UP230714V5656114