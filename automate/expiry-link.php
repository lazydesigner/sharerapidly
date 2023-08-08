<!-- wget -O /dev/null https://sharerapidly.com/automate/expiry-link.php/  In A minute  -->

<?php
include '../connection.php';
$presentDate = date('Y-m-d H:i:s');

// For Registered User
$sql = "SELECT * FROM `user_share` WHERE expiry <= '$presentDate' ";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {

        $sql1 = "DELETE FROM `user_share` WHERE id = " . $row['id'] . "";

        $result2 = mysqli_query($conn, $sql1);
        echo $result2;
        $unlink = '../' . $row['image_path'] . '';
        if (file_exists($unlink)) {
            if (unlink($unlink)) {
                echo json_encode(['status' => 200]);
            }
        }else{echo 'file not present';}
    }
} else {
    echo mysqli_error($conn);
}



// For Non Registered User
$sql2 = "SELECT * FROM `sharething` WHERE expiry <= '$presentDate' ";
if ($result2 = mysqli_query($conn, $sql2)) {
    while ($row = mysqli_fetch_assoc($result2)) {

        $sql1 = "DELETE FROM `sharething` WHERE id = " . $row['id'] . "";
                       
        $result2 = mysqli_query($conn, $sql1);
        echo $result2;
        $unlink = '../' . $row['image_path'] . '';
        if (file_exists($unlink)) {
            if (unlink($unlink)) {
                echo json_encode(['status' => 200]);
            }
        }else{echo 'file not present<br>';}
    }
} else {
    echo mysqli_error($conn);
}

?>