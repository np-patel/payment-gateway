<table border="1">
<caption>Your cart Contents</caption>
<tr>
	<th>Product Name</th>
	<th>Quantity</th>
	<th>Individual Price</th>
	<th>Total Price</th>
	<th>Change Quantity</th>
</tr>

<?php
//loop through each item in the cart
foreach ($_SESSION['cart'] as $cartItem) :
?>
<tr>
	<td><?php echo $cartItem['name']; ?></td>
	<td><?php echo $cartItem['quantity']; ?></td>
	<td>$<?php echo number_format($cartItem['price'], 2); ?></td>
	<td>$<?php echo number_format($cartItem['quantity'] * $cartItem['price'], 2);?></td>
	<td></td>
</tr>


<?php endforeach; ?>

</table>

<a href="make-payment.php">Proceed to Payment</a>
