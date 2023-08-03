<?php include_once 'config.php';  ?>
<?php 
// include_once("db_connect.php");
//Set variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
//Test PayPal API URL
$paypal_email = 'sb-00eso26919621@business.example.com';
?>
<title> Paypal Integration in PHP</title>
<div class="container">
	<div class="col-lg-12">
	<div class="row">
		<?php
		// $sql = "SELECT * FROM products"; 
		// $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)); 
		// while( $row = mysqli_fetch_assoc($resultset) ) { 
		?>
			
			<div class="col-sm-4 col-lg-4 col-md-4" style="width:300px;height:300px;border:2px solid red;float:left;margin-left:20px">
			<div class="thumbnail"> 
			<img src="./assets/images/logo.png " />
			<div class="caption">
			<h4 class="pull-right">200</h4>
			<h4>Name: Sharerapidly</h4>	
			</div>	
 
 
			<form action="<?php echo $paypal_url; ?>" method="post">			
			<!-- Paypal business test account email id so that you can collect the payments. -->
			<input type="hidden" name="business" value="sb-oy6tn26635991@business.example.com">			
			<!-- Buy Now button. -->
			<input type="hidden" name="cmd" value="_xclick">			
			<!-- Details about the item that buyers will purchase. -->
			<input type="hidden" name="item_name" value="sharerapildy">
			<input type="hidden" name="item_number" value="2">
			<input type="hidden" name="amount" value="200">
				<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>">			
			<!-- URLs -->
			<input type='hidden' name='cancel_return' value='http://localhost/sharerapidly/cancel.php'>
			<input type='hidden' name='return' value='http://localhost/sharerapidly/success.php'>						
			<!-- payment button. -->
			<input type="image" name="submit" 
			src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
			<img alt=""  width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >    
			</form>
			</div>
			</div>
				
		<?php //} ?>
		</div>		
	</div>	
		
</div>