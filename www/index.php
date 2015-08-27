<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) || isset($_GET['clearcart']) ) {

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

	$found = false;

	//see if the user adding same item to their cart
	for($i=0; $i<count($_SESSION['cart']); $i++ ) {
		//is the id of the product they are adding
		// the same as the id of this cart item?

		if ($_SESSION['cart'][$i]['id'] == $productID) {
			$found = true;
			//yes, they have already added this item to the cart
			//update the quantity
			$_SESSION['cart'][$i]['quantity'] += $_POST['quantity'];


		}
	}


	//Add the item to the cart only if the product was not found
	if ($found == false) {
		$_SESSION['cart'] [] = ['id'=>$productID,
								 'quantity'=> $_POST['quantity'],
								 'name'=> $result['name'],
								 'price'=> $result['price']
								 ];
		}
	}			

// Include the website header
include 'app/templates/header.php';

// Include the products list
include 'app/templates/product-list.php';

// Include the website footer
include 'app/templates/footer.php';