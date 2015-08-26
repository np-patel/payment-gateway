<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) ) {

	// Create the cart
	$_SESSION['cart'] = [];

}

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'payment_gateway');

// Include the website header
include 'app/templates/header.php';

// Include the products list
include 'app/templates/product-list.php';

// Include the website footer
include 'app/templates/footer.php';