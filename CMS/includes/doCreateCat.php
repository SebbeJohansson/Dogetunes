<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$description = mysql_real_escape_string(stripcslashes($_POST['description']));
	addCat($_POST['name'], $_POST['icon'], $description, $_POST['author']);
}

?>