<?php

include ('functions.php');

if(isset($_POST['submit'])){
	addUser($_POST['full_name'], $_POST['username'], $_POST['password'], $_POST['email']);
}

?>