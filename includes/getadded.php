<section class="blocks getadded">
    
    <h2 class="fooh3">Get Added!</h2>
    <form method="POST" action="../includes/sendmail.php">
        <label>Artist name or project name:</label><br>
		<input type="text" name="name" required><br>
		<label>E-mail:</label><br>
        <input type="email" name="epost"><br>
        <label>Country:</label><br>
        <input type="text" name="country"><br>
        <label>Type of music:</label><br>
        <input type="text" name="musictype"><br>
        <label>What package would you like to get?</label><br>
        <input type="text" name="package"><br>
        <label>What is your wallet address:</label><br>
        <input type="text" name="wallet" required><br>
        <label>A picture to represent you/project (URL):</label><br>
        <input type="text" name="picture" required><br>
        <label>Useful links:</label><br>
        <input type="text" name="links" required><br>
        <label>Additional information or questions:</label><br>
        <textarea name="content"></textarea><br>
        <input type="submit" name="skicka" id="skicka" value="Send"><br>
    </form>
    
</section>
<img src="http://dogecoin.com/imgs/dogecoin-300.png" class="dogecoinpic">