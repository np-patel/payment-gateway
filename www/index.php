<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) ) {

	// Create the cart
	$_SESSION['cart'] = [];

}

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'payment_gatway');

//if the user has submited the "add-to-cart" button form
if (isset($_POST['add-to-cart']) ) {
	// print_r($_POST);
	// die();

	//filter the id
	$productID = $dbc->real_escape_string($_POST['product-id']);

	//find out info about product
	$sql= "SELECT name, price FROM products WHERE id = $productID";

	//run the sql
	$result = $dbc->query($sql);

	//validation

	//Convert in to associative array
	$result = $result->fetch_assoc();

	//Add the item to the cart
	$_SESSION['cart'] [] = ['id'=>$productID,
							 'quantity'=> $_POST['quantity'],
							 'name'=> $result['name'],
							 'price'=> $result['price']
							 ];
}

// Include the website header
include 'app/templates/header.php';

// Include the products list
include 'app/templates/product-list.php';

// Include the website footer
include 'app/templates/footer.php';