<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) || isset($_GET['clearcart']) ) {

	// Create the cart
	$_SESSION['cart'] = [];

}

// Include the website header
include 'app/templates/header.php';

//display all the cart content
include 'app/templates/cart-contents.php';