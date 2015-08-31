<?php

// Start the session
session_start();

//get the config file
require '../config.php';

//obtain the result from the address bar
$result = $_GET['result'];

require 'app/PxPay_Curl.inc.php';

//create an instance of the library
$pxpay = new PxPay_Curl('https://sec.paymentexpress.com/pxpay/pxaccess.aspx', $PxPay_Userid, $PxPay_Key);

//extract the result
//get the respones from the payment express
$response = $pxpay->getResponse($result);

echo '<pre>';
print_r($response);

$dbc = new mysqli('localhost', 'root', '', 'payment_gatway');

//If the transaction was a success
if($response->getSuccess() ){
	//success :)
	$customerName = $response->getTxnData1();
	$customerAddress = $response->getTxnData2();

	//mix the data
	$contact = $customerName."\n\n".$customerAddress;

	//filter the contect info
	$contact = $dbc->real_escape_string($contact);

	//create a new order
	$sql = "INSERT INTO orders VALUES(NULL, 'Approved', 'panding', '$contact', CURRENT_TIMESTAMP, NULL)";

	//run the sql
	$dbc->query($sql);

	//get the id of the new order
	$orderID = $dbc->insert_id;



	//loop through the cart contect
	foreach ($_SESSION['cart'] as $cartItem) {
		
		$productID = $cartItem['id'];
		$quantity = $cartItem['quantity'];
		$price = $cartItem['price'];

		//prepare the sql

		 $sql = "INSERT INTO ordered_products VALUES(NULL, $orderID, $productID, $quantity, $price)";

		

		//run the sql
		$dbc->query($sql);
	}


	//clear the cart

	$_SESSION['cart'] = [];

} else{
	//fail :(
}
