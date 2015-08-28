<?php

// Start the session
session_start();

//get the config file
require '../config.php';

require 'app/PxPay_Curl.inc.php';

//create an instance of the library
$pxpay = new PxPay_Curl('https://sec.paymentexpress.com/pxpay/pxaccess.aspx', $PxPay_Userid, $PxPay_Key);

//Create a new request object
$request = new PxPayRequest();

//prepare the url to come back to once payment has been complete
$http_host = getenv('HTTP_HOST'); //localhost. if online than domain name

$folders = getenv('SCRIPT_NAME');
$urlToComeBackTo = 'http://'.$http_host.$folders;

//loopthrough cart and calculate the grand total
$grandTotal = 0;
foreach ($_SESSION['cart'] as $cartItem) {
	$grandTotal += $cartItem['quantity'] * $cartItem['price'];
}

//prepare data for PxPay 
$request->setAmountInput($grandTotal);
$request->setTxnType('Purchase'); //transaction type
$request->setCurrencyInput('NZD');
$request->setUrlFail( PROJECT_ROOT.'payment-response.php');
$request->setUrlSuccess( PROJECT_ROOT.'payment-response.php');
$request->setTxnData1('Nehal Patel');
$request->setTxnData2('20 Kent Terrace, Wellington, NZ');
$request->setTxnData3('Somthing else');

//Prepare the request string out of the request data
$requestString = $pxpay->makeRequest($request);

//send the request to be processed
$response = new MifMessage($requestString);

//extract the url so we can redirect the user
$urlToGoTo = $response->get_element_text('URI');

//redirect the user
header('Location: '.$urlToGoTo);