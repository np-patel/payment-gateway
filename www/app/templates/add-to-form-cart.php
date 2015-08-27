<form action="index.php" method="post" novalidate>
	<label for="quantity<?= $row['id'] ?>">Quantity: </label>
	<input id="quantity<?= $row['id'] ?>" name="quantity" type="number" name="quantity" min="1" max="<?= $row['quantity']; ?>" value="1" >
	<input type="hidden" name="product-id" value="<?= $row['id'] ?>">
	<input type="submit" value="Add To Cart" name="add-to-cart">	
</form>