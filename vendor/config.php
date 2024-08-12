<?php 
 
// Product Details 
$itemNumber = "DP12345"; 
$itemName = "Tshirt"; 
$itemPrice = 100000;  
$currency = "USD"; 
 
/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */ 
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AZb1iDj3b03mFUatb1f5xZm_Fr56fSZqai8unKkHkl1RXV-ogn7ByrcxNuQvwj4hmXoqVBQ3_fp5Lyx4'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EDg3YAtw7Q5B9EKf1jdhr29sIVYrwsgQQ-_YT8G_MniRGzbI22oCQ_vhBwMj2wQI_Y9IBtDLNiX33w6P'); 
define('PAYPAL_PROD_CLIENT_ID', 'Insert_Live_PayPal_Client_ID_Here'); 
define('PAYPAL_PROD_CLIENT_SECRET', 'Insert_Live_PayPal_Secret_Key_Here'); 
  
// Database configuration  
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'connectbd'); 
 
?>