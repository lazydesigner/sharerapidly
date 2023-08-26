<?php 
session_start();
include '../fun.php';?>
<?php require_once './config.php'; ?>
<?php require_once '../connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Payment Accept</title>
</head>

<body>
    <h2>Your Payment For the balance amount for RAPID AUTO SHIPPING of $300.00</h2>
    <form action="<?php echo PAYPAL_URL; ?>" method="POST">
        <!-- Identify your bussiness so that you can collect the payment -->
        <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

        <!-- Specify a buy now button -->
        <input type="hidden" name="cmd" value="_xclick">

        <!-- Specify details about the item that buyers will purchase -->
        <input type="hidden" name="item_name" value="Standart Plan">
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="amount" value="300">
        <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

        <!-- Specify URLs -->
        <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
        <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

        <!-- Display the payment button -->
        <input type="submit" name="submit"  style="border:0;display:block; width:400px;height:60px;border-radius:5px;background-color:gold;font-weight:bold;cursor:pointer;" class="payment_btn" value="Pay With Paypal">

    </form>
</body>

</html>
