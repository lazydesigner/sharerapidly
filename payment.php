<?php require_once 'config.php' ?>
<form action="<?php echo PAYPAL_URL; ?>" method="POST">
    <!-- Identify your bussiness so that you can collect the payment -->
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

    <!-- Specify a buy now button -->
    <input type="hidden" name="cmd" value="_xclick">

    <!-- Specify details about the item that buyers will purchase -->
    <input type="hidden" name="item_name" value="Share rapidly">
    <input type="hidden" name="item_number" value="1122">
    <input type="hidden" name="amount" value="10">
    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>" >

    <!-- Specify URLs -->
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>" >
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>" >

    <!-- Display the payment button -->
    <input type="submit" name="submit" style="border:0;" value="Buy Now" >
</form>