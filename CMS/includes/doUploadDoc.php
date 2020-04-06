<?php

include ('functions.php');

if(isset($_POST['submit'])){
	addDoc($_POST['name'], $_POST['cat']);
}

?>