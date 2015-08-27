
<?php


	//if the user already has this item in the cart
//then we want to make sure they can't add more
//than whats's in the database
//if we subtrect thair cart quantity againes the database quantity
//
for($i=0; $i<count($_SESSION['cart']); $i++ ) {
	//if the Id of this product is the same as one in the cart
	if ($row['id'] == $_SESSION['cart'][$i]['id'] ) {
		$newQuantity = $row['quantity'] -= $_SESSION['cart'][$i]['quantity'];
		$inCart = $_SESSION['cart'][$i]['quantity'];
		
	}
}

//if the $newQuantity variable doesn't exist
//create it and apply the default database quantity
if (!isset($newQuantity) ) {

	$newQuantity = $row['quantity'];
	
}


?>
<form action="index.php" method="post">
	<label for="quantity<?= $row['id'] ?>">Quantity: </label>
	<input id="quantity<?= $row['id'] ?>" name="quantity" type="number" name="quantity" min="1" max="<?= $newQuantity; ?>" value="1" >
	<input type="hidden" name="product-id" value="<?= $row['id'] ?>">
	<input type="submit" value="Add To Cart" name="add-to-cart">	
</form>

<?php

//
if(isset($inCart)){
	echo '<ul>';
	echo '<li>Already in cart</li>';
	echo '<li>in cart: '.$inCart.'</li>';
	echo '</ul>';
	unset($inCart);
}

unset($newQuantity);

?>
