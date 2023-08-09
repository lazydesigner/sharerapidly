<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'info@pksolutions.org'); 
define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', ''. get_home_url() .'success.php'); 
define('PAYPAL_CANCEL_URL', ''. get_home_url() .'cancel.php'); 
define('PAYPAL_NOTIFY_URL', ''. get_home_url() .'ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 

 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");