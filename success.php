<?php include './fun.php' ?>
<?php
session_start();
//Include Configuration File
include_once 'config.php';

//Inlcude Database Connection File
include_once 'connection.php';

//If Transaction Data is Available in the URL
if (!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])) {
    //Get Transaction Information from URL
    $item_number = $_GET['item_number'];
    $txn_id = $_GET['tx'];
    $payment_gross = $_GET['amt'];
    $currency_code = $_GET['cc'];
    $payment_status = $_GET['st'];


    //Get Product infomation from the database
    // $productResult = $conn->query("SELECT * FROM products WHERE id = ".$item_number);
    // $productRow = $productResult->fetch_assoc();

    //Check if transaction data exists with the same TXN ID
    $prevPaymentResult = $conn->query("SELECT * FROM payments WHERE txn_id = '" . $txn_id . "'");

    if ($prevPaymentResult->num_rows > 0) {
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $payment_id = $paymentRow['payment_id'];
        $payment_gross = $paymentRow['payment_gross'];
        $payment_status = $paymentRow['payment_status'];
    } else {
        //Insert transaction data into the database
        $insert = $conn->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status,user_payment_id) VALUES('" . $item_number . "','" . $txn_id . "','" . $payment_gross . "','" . $currency_code . "','" . $payment_status . "',{$_SESSION['user_id']})");
        $payment_id = $conn->insert_id;

        $presentDate = date('Y-m-d H:i:s');
        $expiryDate = date('Y-m-d H:i:s', strtotime($presentDate . ' +30 days'));

        if($payment_id){

            $plan_update = "UPDATE userdata SET plan = $item_number , plan_start = '$presentDate', plan_end = '$expiryDate',data_transfer = 0 WHERE email = '{$_SESSION["user_email"]}'";
            $query_update = mysqli_query($conn, $plan_update);
            if($query_update){
            }else{
                echo 'not updated'. mysqli_error($conn);
            }


        }
    }
} else {
    header('Location ' . base_url() . '');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment Status</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            justify-content: center;
        }

        .container .card {
            flex: 0 0 200px;
            margin: 10px;
            border: 1px solid #ccc;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .container img {
            width: 100%;
            height: 131px;
            background-size: cover;
            object-fit: cover;
        }

        .container .body {
            padding-bottom: 10px;
        }

        .container h5 {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #566270;
        }

        .container h6 {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
            color: #566270;
        }

        .status {
            background: #f8f8f8;
            border: 1px solid #ccc;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin: 50px 0;
        }

        .status .success {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
        }

        .status .error {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: red;
        }

        .container .main {
            width: 100%;
            text-align: center;
        }

        .status h4 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #0077ff;
        }

        .main p {
            font-size: 16px;
            color: #4b4b4b;
        }

        .btn-link {
            padding: 10px 15px;
            color: #0077ff;
            border: 1px solid #0077ff;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="status">
                <?php if (!empty($payment_id)) { ?>
                    <h1 class="success">Your Payment has been successful</h1>

                    <h4>Payment Information</h4>
                    <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
                    <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                    <p><b>Paid Amount:</b> $<?php echo $payment_gross; ?></p>
                    <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

                    <h4>Plan Information</h4>
                    <p><b>Plan Name : </b> ShareRapidly</p>
                    <p><b>Price : </b>$10</p>
                    <p><b>Plan Status : </b> Active</p>
                <?php } else { ?>
                    <h1 class="error">Your Payment has failed</h1>
                <?php } ?>
            </div>
            <a href="<?= base_url() ?>" class="btn-link">Back to Home</a>
        </div>
    </div>
</body>

</html>