<?php
echo '<p>
	
	
<form action="https://www.coinpayments.net/index.php" method="post">
 <input type="hidden" name="cmd" value="_donate">
 <input type="hidden" name="reset" value="1">
 <input type="hidden" name="merchant" value="';
	echo "{$result['merchant']}";
	echo '">
 <input type="hidden" name="item_name" value="Donate to ';
	echo "{$result['titel']}";
	echo '">
 <input type="hidden" name="currency" value="DOGE">
 <input type="hidden" name="amountf" value="100.00000000">
 <input type="hidden" name="allow_amount" value="1">
 <input type="hidden" name="want_shipping" value="0">
 <input type="hidden" name="success_url" value="https://sites.google.com/site/dogetunes/thankyou">
 <input type="hidden" name="cancel_url" value="https://sites.google.com/site/dogetunes/">
 <input type="hidden" name="allow_extra" value="0">
 <input type="image" src="https://www.coinpayments.net/images/pub/donate-med-grey.png" alt="Donate with CoinPayments.net">
</form>
<h2 class="buynow">Buy NOW:</h2>
<div class="infowrapper"><h3>Price - Ð'; echo "{$result['sellamount']} </h3>";echo '
<h3>Info - '; echo "{$result['item_name']} </h3></div>";echo '
<form action="https://www.coinpayments.net/index.php" method="post">
 <input type="hidden" name="cmd" value="_pay">
 <input type="hidden" name="reset" value="1">
 <input type="hidden" name="merchant" value="';
	echo "{$result['merchant']}";
	echo '">
 <input type="hidden" name="item_name" value="';
	echo "{$result['item_name']}";
	echo '">
 <input type="hidden" name="currency" value="DOGE">
 <input type="hidden" name="amountf" value="';
	echo "{$result['sellamount']}";
	echo '">
 <input type="hidden" name="quantity" value="1">
 <input type="hidden" name="allow_quantity" value="0">
 <input type="hidden" name="want_shipping" value="0">
 <input type="hidden" name="success_url" value="https://sites.google.com/site/dogetunes/thankyou">
 <input type="hidden" name="cancel_url" value="https://sites.google.com/site/dogetunes/">
 <input type="hidden" name="allow_extra" value="0">
 <input type="image" src="https://www.coinpayments.net/images/pub/buynow-med-grey.png" alt="Buy Now with CoinPayments.net">
</form>

	</p></div>
	';
        ?>